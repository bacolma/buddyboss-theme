<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'BuddyBoss_Updater_Admin' ) ):

	class BuddyBoss_Updater_Admin {

		/**
		 * Plugin options
		 *
		 * @var array
		 */
		public $options = array();
		private $network_activated = false,
			$plugin_slug = 'buddyboss-updater',
			$menu_hook = 'admin_menu',
			$settings_page = 'buddyboss-settings',
			$capability = 'manage_options',
			$form_action = 'options.php',
			$page_hook_suffix,
			$form_post_response,
			$plugin_settings_url,
			$packages = array(),
			$_saved_licenses = false,
			$_domain_name,
			$license_status_last_checked;

		/**
		 * Empty constructor function to ensure a single instance
		 */
		public function __construct() {
			// ... leave empty, see Singleton below
		}

		public static function instance() {
			static $instance = null;

			if ( null === $instance ) {
				$instance = new BuddyBoss_Updater_Admin;
				$instance->setup();
			}

			return $instance;
		}

		public function option( $key ) {
			$value = buddyboss_updater()->option( $key );

			return $value;
		}

		public function setup() {
			if ( ( ! is_admin() && ! is_network_admin() ) || ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$root_blog_id = 1;
			if ( function_exists( 'get_network' ) ) {
				$get_network = get_network();
				$root_blog_id = empty( $get_network->id ) ? 1 : absint( $get_network->id );
			}
			
			if ( function_exists( 'get_blog_option' ) ) {
			    $root_template = get_blog_option( $root_blog_id, 'template' );
            } else {
				$root_template = get_option( 'template' );
            }

			$this->_domain_name = $this->get_domain( $_SERVER['SERVER_NAME'] );

			$this->plugin_settings_url = admin_url( 'admin.php?page=' . $this->plugin_slug );

			$this->network_activated = $this->is_network_activated();

			//if the plugin is activated network wide in multisite, we need to override few variables
			if ( $this->network_activated && 'buddyboss-theme' === $root_template ) {
				// Main settings page - menu hook
				$this->menu_hook = 'network_admin_menu';

				// Main settings page - Capability
				$this->capability = 'manage_network_options';

				// Settins page - form's action attribute
				$this->form_action = 'edit.php?action=' . $this->plugin_slug;

				// Plugin settings page url
				$this->plugin_settings_url = network_admin_url( 'admin.php?page=' . $this->plugin_slug );
			}


			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( $this->menu_hook, array( $this, 'admin_menu' ) );

			if ( isset( $_GET['page'] ) && ( $_GET['page'] == $this->plugin_slug ) ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_css_js' ) );
			}

			add_action( 'wp_ajax_updater_bb_connect_received_message', array(
				$this,
				'updater_bb_connect_received_message'
			) );
		}

		public function admin_init() {
			$this->packages = apply_filters( 'bboss_licensed_packages', array() );
			$this->_get_saved_licenses();
			//$this->incative_packages = $this->_inactive_packages();

			add_action( 'admin_notices', array( $this, 'admin_notice' ) );

			$updatable_products = apply_filters( 'bboss_updatable_products', array() );
			if ( ! empty( $updatable_products ) ) {
				foreach ( $updatable_products as $product_key => $product ) {
					//create an object of updater class
					$type = isset( $product['type'] ) ? $product['type'] : 'plugin';
					new BBoss_Updates_Helper( $product_key, $product['path'], $product['id'], $type );
				}
			}
		}

		/**
		 * @param string $domain Pass $_SERVER['SERVER_NAME'] here
		 * @param bool $debug
		 *
		 * @return string
		 */
		public function get_domain( $domain, $debug = false ) {
			$original = $domain = strtolower( $domain );

			if ( filter_var( $domain, FILTER_VALIDATE_IP ) ) {
				return $domain;
			}

			$debug ? print( '<strong style="color:green">&raquo;</strong> Parsing: ' . $original ) : false;

			$arr = array_slice( array_filter( explode( '.', $domain, 4 ), function ( $value ) {
				return $value !== 'www';
			} ), 0 ); //rebuild array indexes

			if ( count( $arr ) > 2 ) {
				$count = count( $arr );
				$_sub  = explode( '.', $count === 4 ? $arr[3] : $arr[2] );

				$debug ? print( " (parts count: {$count})" ) : false;

				if ( count( $_sub ) === 2 ) { // two level TLD
					$removed = array_shift( $arr );
					if ( $count === 4 ) { // got a subdomain acting as a domain
						$removed = array_shift( $arr );
					}
					$debug ? print( "<br>\n" . '[*] Two level TLD: <strong>' . join( '.', $_sub ) . '</strong> ' ) : false;
				} elseif ( count( $_sub ) === 1 ) { // one level TLD
					$removed = array_shift( $arr ); //remove the subdomain

					if ( strlen( $_sub[0] ) === 2 && $count === 3 ) { // TLD domain must be 2 letters
						array_unshift( $arr, $removed );
					} else {
						// non country TLD according to IANA
						$tlds = array(
							'aero',
							'arpa',
							'asia',
							'biz',
							'cat',
							'com',
							'coop',
							'edu',
							'gov',
							'info',
							'jobs',
							'mil',
							'mobi',
							'museum',
							'name',
							'net',
							'org',
							'post',
							'pro',
							'tel',
							'travel',
							'xxx',
						);

						if ( count( $arr ) > 2 && in_array( $_sub[0], $tlds ) !== false ) { //special TLD don't have a country
							array_shift( $arr );
						}
					}
					$debug ? print( "<br>\n" . '[*] One level TLD: <strong>' . join( '.', $_sub ) . '</strong> ' ) : false;
				} else { // more than 3 levels, something is wrong
					for ( $i = count( $_sub ); $i > 1; $i -- ) {
						$removed = array_shift( $arr );
					}
					$debug ? print( "<br>\n" . '[*] Three level TLD: <strong>' . join( '.', $_sub ) . '</strong> ' ) : false;
				}
			} elseif ( count( $arr ) === 2 ) {
				$arr0 = array_shift( $arr );

				if ( strpos( join( '.', $arr ), '.' ) === false && in_array( $arr[0], array(
						'localhost',
						'test',
						'invalid'
					) ) === false ) { // not a reserved domain
					$debug ? print( "<br>\n" . 'Seems invalid domain: <strong>' . join( '.', $arr ) . '</strong> re-adding: <strong>' . $arr0 . '</strong> ' ) : false;
					// seems invalid domain, restore it
					array_unshift( $arr, $arr0 );
				}
			}

			$debug ? print( "<br>\n" . '<strong style="color:gray">&laquo;</strong> Done parsing: <span style="color:red">' . $original . '</span> as <span style="color:blue">' . join( '.', $arr ) . "</span><br>\n" ) : false;

			return join( '.', $arr );
		}

		function admin_css_js() {
			wp_enqueue_style( 'bboss_updater_admin', BUDDYBOSS_UPDATER_URL . 'assets/css/admin.css' );
			wp_enqueue_script( 'bboss_updater_admin', BUDDYBOSS_UPDATER_URL . 'assets/js/admin.js', array( 'jquery' ) );

			//@todo: change the url here
			$home_url = "https://www.buddyboss.com/";
			$data     = array(
				'connector_url'          => $home_url . "?bb_updater_init_connect=1",
				'connector_host'         => 'https://www.buddyboss.com/',//@todo: update this
				'nonce_received_message' => wp_create_nonce( 'updater_bb_connect_received_message' ),
			);
			wp_localize_script( 'bboss_updater_admin', 'BBOSS_UPDATER_ADMIN', $data );
		}

		/**
		 * Check if the plugin is activated network wide(in multisite).
		 *
		 * @return boolean
		 */
		private function is_network_activated() {
			$network_activated = false;
			if ( is_multisite() ) {
			    $network_activated = true;
			}

			return $network_activated;
		}

		public function admin_menu() {
			$this->page_hook_suffix = add_submenu_page(
				$this->settings_page, __( 'BuddyBoss License Keys', 'buddyboss-theme' ), __( 'License Keys', 'buddyboss-theme' ), $this->capability, $this->plugin_slug, array(
					$this,
					'options_page'
				)
			);

			add_action( 'load-' . $this->page_hook_suffix, array( $this, 'process' ) );
		}

		public function options_page() {
			$packages       = array();
			$this->packages = apply_filters( 'bboss_licensed_packages', $packages );

			include_once( 'views/admin.php' );
		}

		public function print_settings_tabs() {
			$active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : '';

			$is_first_tab = true;

			if ( empty( $this->packages ) ) {
				return;
			}

			foreach ( $this->packages as $package ) {
				$active = $active_tab == $package['id'] ? 'active' : '';
				if ( ! $active_tab && $is_first_tab ) {
					$active = 'active';
				}
				$is_first_tab = false;

				$dashicon_class = 'lock';

				$package_status = $this->get_package_status( $package['id'] );
				switch ( $package_status ) {
					case 'active':
						$dashicon_class = 'yes-alt';
						break;
					case 'inactive':
						$dashicon_class = 'warning';
						break;
					case 'active_indirect':
						$dashicon_class = 'yes-alt indirect';
						break;
				}

				$dashicon = "<span class='dashicons dashicons-{$dashicon_class}'></span>";
				echo '<li class="' . $active . '"><a href="?page=' . $this->plugin_slug . '&tab=' . $package['id'] . '">' . $dashicon . $package['name'] . '</a></li>';
			}
		}

		public function print_settings_content() {
			$active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : '';

			if ( ! $active_tab ) {
				//get first package. That becomes the active tab
				if ( ! empty( $this->packages ) ) {
					foreach ( $this->packages as $package ) {
						$active_tab = $package['id'];
						break;
					}
				}
			}

			if ( ! $active_tab ) {
				return;
			}

			$package = $this->packages[ $active_tab ];
			$license = $this->_get_license( $active_tab );
			include_once( 'views/package.php' );
		}

		public function process() {
			$active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : '';

			if ( ! $active_tab ) {
				//get first package. That becomes the active tab
				if ( ! empty( $this->packages ) ) {
					foreach ( $this->packages as $package ) {
						$active_tab = $package['id'];
						break;
					}
				}
			}

			if ( ! $active_tab ) {
				return;
			}

			if ( 'support' == $active_tab ) {
				//$this->update_settings_support();
			} else {
				if ( isset( $_POST['btn_submit'] ) ) {
					check_admin_referer( "bboss_licensing" );

					$package = $this->packages[ $active_tab ];
					$obj     = new BBoss_License_Helper( $package );

					$response = $obj->activate( @$_POST['license_key'], @$_POST['activation_email'] );
					if ( $response['status'] ) {
						$response['is_active']    = true;
						$this->form_post_response = array(
							'class' => 'updated fade',
							'text'  => $response['message'],
						);
					} else {
						$response['is_active']    = false;
						$this->form_post_response = array(
							'class' => 'error fade',
							'text'  => $response['message'],
						);
					}

					$package_product_keys = array();
					//get all product ids in the package
					foreach ( $package['products'] as $product_key => $product ) {
						$package_product_keys[] = $product_key;
					}

					$response['product_keys'] = $package_product_keys;

					$saved_licenses                   = $this->_get_saved_licenses();
					$saved_licenses[ $package['id'] ] = $response;

					$this->_update_saved_licenses( $saved_licenses );

					$current = get_site_transient( 'update_plugins' );	//Get the current update info
					$current->last_checked = 0;						//wp_update_plugins() checks this value when determining
					set_site_transient( 'update_plugins', $current );	//whether to actually check for updates, so we reset it to zero.
					wp_update_plugins();							//Run the internal plugin update check

					$current = get_site_transient( 'update_themes' );
					$current->last_checked = 0;
					set_site_transient( 'update_themes', $current );	//whether to actually check for updates, so we reset it to zero.
					wp_update_themes();
				}
			}
		}

		public function show_form_post_response() {
			if ( empty( $this->form_post_response ) ) {
				return;
			}

			echo "<div class='" . $this->form_post_response['class'] . "'><p>" . $this->form_post_response['text'] . "</p></div>";
		}

		/**
		 * Check if given products have an active license, a part of any of available packages.
		 *
		 * @param array $products
		 */
		public function show_partial_activations( $package ) {
			$status = $this->get_package_status( $package['id'] );
			if ( 'active' == $status ) {
				return;
			}

			$products           = $package['products'];
			$activated_products = array();
			if ( ! empty( $products ) ) {
				foreach ( $products as $product_id => $product_details ) {
					$active_license_details = $this->product_valid_license_details( $product_id );
					if ( ! empty( $active_license_details ) ) {
						$activated_products[ $product_id ] = array(
							'product' => $product_details,
							'license' => $active_license_details,
						);
					}
				}

				if ( ! empty( $activated_products ) ) {
					echo "<br><div class='bb_indirect_license'><i class='dashicons dashicons-lightbulb'></i> You already have a valid license key for " . count( $activated_products ) . " product(s) of this package:-<br>";
					foreach ( $activated_products as $activated_product ) {
						echo "<strong>" . $activated_product['product']['name'] . "</strong>: as part of <strong>" . $activated_product['license']['package']['name'] . "</strong>.<br>";
					}
					echo "<br>You can still activate the current package though.</div>";
				}
			}
		}

		public function get_package_status( $package_id ) {
			$status         = 'inactive';
			$saved_licenses = $this->_get_saved_licenses();
			if ( ! empty( $saved_licenses ) ) {
				foreach ( $saved_licenses as $p_id => $license_details ) {
					if ( $package_id == $p_id ) {
						if ( $license_details['is_active'] ) {
							$status = 'active';
						}
					}
				}
			}

			if ( $status == 'inactive' ) {
				//package is inactive but all the products of this package might be active as part of other packages
				//lets check that
				$package                = $this->packages[ $package_id ];
				$all_products_activated = true;
				foreach ( $package['products'] as $product_key => $pdetails ) {
					$active_license = $this->product_valid_license_key( $product_key );
					if ( ! $active_license ) {
						//this product is not active
						$all_products_activated = false;
						break;
					}
				}

				if ( $all_products_activated ) {
					$status = 'active_indirect';
				}
			}

			return $status;
		}

		protected function _get_license( $package_id ) {
			$license        = false;
			$saved_licenses = $this->_get_saved_licenses();
			if ( ! empty( $saved_licenses ) && isset( $saved_licenses[ $package_id ] ) ) {
				$license = $saved_licenses[ $package_id ];
			}

			return $license;
		}

		protected function _get_saved_licenses() {
			if ( ! $this->_saved_licenses ) {
			    if ( $this->network_activated ) {
				    $this->_saved_licenses = get_site_option( 'bboss_updater_saved_licenses' );
                } else {
				    $this->_saved_licenses = get_option( 'bboss_updater_saved_licenses' );
                }
			}

			return $this->_saved_licenses;
		}

		protected function _update_saved_licenses( $licenses ) {
			$this->_saved_licenses = $licenses;
			if ( $this->network_activated ) {
			    update_site_option( 'bboss_updater_saved_licenses', $licenses );
            } else {
			    update_option( 'bboss_updater_saved_licenses', $licenses );
            }
		}

		public function admin_notice() {
			if ( ! current_user_can( 'manage_options' ) || ( isset( $_GET['page'] ) && $this->plugin_slug == $_GET['page'] ) ) {
				return;
			}

			// #1. expired/deactivated licenses
			$notices = buddyboss_updater_plugin()->generate_notice_expired_licenses();
			if ( ! empty( $notices ) ) {
				$notice = '';
				foreach ( $notices as $m ) {
					$notice .= "<p>" . $m . "</p>";
				}

				echo "<div class='notice notice-warning is-dismissible'>" . $notice
				     . "<button type='button' class='notice-dismiss' onClick='BBossULDissmissNotice(this);'><span class='screen-reader-text'>" . __( 'Dismiss this notice.', 'buddyboss-theme' ) . "</span></button>"
				     . "</div>";
				?>
                <script type="text/javascript">
					function BBossULDissmissNotice(el) {
						$el = jQuery(el);
						$el.closest('.notice').remove();

						// jQuery.ajax({
						// 	method: "POST",
						// 	url: ajaxurl,
						// 	data: {action: "delete_notice_license_expiry"}
						// });
					}
                </script>
				<?php

			}

			// #2. inactive packages notification
			$has_inactive_packages = false;
			if ( ! empty( $this->packages ) ) {
				$saved_licenses = $this->_get_saved_licenses();
				if ( empty( $saved_licenses ) ) {
					//we have some buddyboss packages but no license info in db
					//display admin notice

					if ( $this->is_network_activated() ) {
						$url = network_admin_url( 'admin.php?page=' . $this->plugin_slug );
					} else {
						$url = admin_url( 'admin.php?page=' . $this->plugin_slug );
					}
					$settings_link = "<a href='" . $url . "'>" . __( 'activate your product licenses', 'buddyboss-theme' ) . "</a>";
					$notice        = sprintf( __( "<strong>Your BuddyBoss products are almost ready.</strong> To get started, please %s.", 'buddyboss-theme' ), $settings_link );

					echo "<div class='notice notice-error'><p>{$notice}</p></div>";

				} else {
					//for every package, check if an active license is there in db or not
					foreach ( $this->packages as $package_id => $package ) {

						if ( isset( $package['package'] ) && 'plugin' == $package['package'] && ! is_plugin_active( $package['path'] ) ) {
							continue;
						}

						if ( isset( $package['package'] ) && 'theme' == $package['package'] && $package['path'] != get_option( 'template' ) ) {
							continue;
						}

						$package_status = $this->get_package_status( $package_id );

						//break out when the first inactive package is found
						if ( 'inactive' == $package_status ) {

							if ( $this->is_network_activated() ) {
								$url = network_admin_url( 'admin.php?page=' . $this->plugin_slug . '&tab=' . $package_id );
							} else {
								$url = admin_url( 'admin.php?page=' . $this->plugin_slug . '&tab=' . $package_id );
							}

							//we have some buddyboss packages but no license info in db
							//display admin notice
							$settings_link = "Please click <a href='" . $url . "'>" . __( 'here', 'buddyboss-theme' ) . "</a> and update your license.";
							$notice        = sprintf( __( "This license for <strong>%s</strong> is invalid or incomplete. %s", 'buddyboss-theme' ), $package['name'], $settings_link );

							echo "<div class='notice notice-error'><p>{$notice}</p></div>";
						}
					}
				}
			}
		}

		protected function _inactive_packages() {
			if ( empty( $this->packages ) ) {
				return false;
			}

			$licenses = $this->_get_saved_licenses();
			if ( empty( $licenses ) ) {
				return array();
			} //

			$inactive_packages = array();

			foreach ( $this->packages as $package ) {
				if ( ! isset( $licenses[ $package['id'] ] ) || empty( $licenses[ $package['id'] ] ) ) {
					$inactive_packages[] = $package['id'];
				} else {
					if ( ! $licenses[ $package['id'] ]['is_active'] ) {
						$inactive_packages[] = $package['id'];
					}
				}
			}

			return $inactive_packages;
		}

		/**
		 * Given a product key, check for all active packages in db if the given product has a valid license
		 * and return one if found.
		 *
		 * A product can be part of more than one package.
		 *
		 * @param string $product_key
		 *
		 * @return string
		 */
		function product_valid_license_key( $product_key, $get_extra_info = false ) {
			$valid_license_key = '';

			//check every valid license in db and match for product key

			$saved_licenses = $this->_get_saved_licenses();
			if ( ! empty( $saved_licenses ) ) {
				foreach ( $saved_licenses as $package_id => $license_details ) {
					//parent plugin should be active as well
					if ( $license_details['is_active'] && isset( $this->packages[ $package_id ] ) && ! empty( $this->packages[ $package_id ] ) ) {
						if ( ! empty( $license_details['product_keys'] ) && is_array( $license_details['product_keys'] ) && in_array( $product_key, $license_details['product_keys'] ) ) {
							if ( $get_extra_info ) {
								$valid_license_key = array(
									'key'   => $license_details['license_key'],
									'email' => $license_details['activation_email'],
								);
							} else {
								$valid_license_key = $license_details['license_key'];
							}
							break;
						}
					}
				}
			}

			return $valid_license_key;
		}

		/**
		 * Given a product key, check for all active packages in db if the given product has a valid license
		 * and return one if found.
		 * Also return the details of the package which has the found license key.
		 *
		 * A product can be part of more than one package.
		 *
		 * @param string $product_key
		 *
		 * @return string
		 */
		function product_valid_license_details( $product_key ) {
			$valid_license = array();

			//check every valid license in db and match for product key
			//if( !empty( $software_ids ) && !empty( $this->_get_saved_licenses() ) ){
			$saved_licenses = $this->_get_saved_licenses();
			if ( ! empty( $saved_licenses ) ) {
				foreach ( $saved_licenses as $package_id => $license_details ) {
					if ( $license_details['is_active'] ) {
						if ( ! empty( $license_details['product_keys'] ) && is_array( $license_details['product_keys'] ) && in_array( $product_key, $license_details['product_keys'] ) ) {
							/**
							 * Use case: plugin A and pulgin B were activated. Plugin A's package allowed a valid license for plugin B.
							 * Now if plugin A is deactivated, then plugin B should also show no valid license.
							 */
							if ( ! empty( $this->packages[ $package_id ] ) ) {
								$valid_license['license_key'] = $license_details['license_key'];
								$valid_license['package']     = $this->packages[ $package_id ];
							}
							break;
						}
					}
				}
			}

			return $valid_license;
		}

		protected function _refetch_licenses() {
			//force check every license saved in db
			$saved_licenses = $this->_get_saved_licenses();
			if ( ! empty( $saved_licenses ) ) {
				$new_saved_licenses = array();

				foreach ( $saved_licenses as $package_id => $license_details ) {
					if ( ! $license_details['is_active'] ) {
						$new_saved_licenses[ $package_id ] = $license_details;
						//no need to check again
						continue;
					}

					$obj                               = new BBoss_License_Helper( false );
					$retval                            = $obj->refetch_license_status( $license_details );
					$license_details['is_active']      = isset( $retval['status'] ) ? $retval['status'] : false;
					$new_saved_licenses[ $package_id ] = $license_details;
				}

				$this->_update_saved_licenses( $new_saved_licenses );
			}

			$this->license_status_last_checked = current_time( 'mysql' );
		}


		public function bb_connect_ui() {
			include BUDDYBOSS_UPDATER_DIR . 'includes/views/connect.php';
		}

		public function updater_bb_connect_received_message() {
			check_ajax_referer( 'updater_bb_connect_received_message', 'nonce' );

			if ( ! current_user_can( 'manage_options' ) ) {
				die();
			}

			$retval            = array(
				'status'      => true,
				'message'     => 'Done',
				'redirect_to' => $this->plugin_settings_url
			);
			$retval['message'] = __( 'Your account was successfully connected. No new activations have been made. If you are attempting to activate a new license key, please make sure that the product is installed on your site, and that an active license key is available in your BuddyBoss.com account.', 'buddyboss-theme' );


			$licenses = @$_POST['licenses'];
			if ( ! empty( $licenses ) && ! empty( $this->packages ) ) {
				$output = $this->process_bulk( $licenses );
				if ( ! empty( $output ) ) {
					$retval = $output;
				}
			}

			die( wp_json_encode( $retval ) );
		}

		/**
		 * Method serves somewhat as an api.
		 * Other plugins( like oneclick installer ) can call this function.
		 *
		 * @param array $licenses associative array of all license details.
		 *
		 * @return array Description
		 */
		public function process_bulk( $licenses ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return false;
			}

			$retval            = array(
				'status'      => true,
				'message'     => 'Done',
				'redirect_to' => $this->plugin_settings_url
			);
			$retval['message'] = __( 'Your account was successfully connected. No new activations have been made. If you are attempting to activate a new license key, please make sure that the product is installed on your site, and that an active license key is available in your BuddyBoss.com account.', 'buddyboss-theme' );


			$licenses_updated          = array();
			$old_active_licenses_count = 0;//active licenses already in site's db

			if ( ! empty( $licenses ) && ! empty( $this->packages ) ) {
				//for each product, we'll check if there is a license key entered already in db and if that key is active.
				//if so, we will not overwrite it
				//else we'll do overwrite/do-a-new-entry license key for this product and save it in db
				$saved_licenses = $this->_get_saved_licenses();
				foreach ( $this->packages as $package_id => $package_details ) {
					$has_active_license = false;
					$chosen_license     = false;

					if ( ! empty( $saved_licenses ) && isset( $saved_licenses[ $package_id ] ) ) {
						if ( $saved_licenses[ $package_id ]['is_active'] ) {
							$has_active_license = true;
							$old_active_licenses_count ++;
						}
					}

					if ( ! $has_active_license ) {
						//search through $licenses and find the one for current package, if any
						foreach ( $licenses as $license ) {
							$software_product_id = $license['software_product_id'];
							//match it with software_id of all products in the current package
							foreach ( $package_details['products'] as $pid => $pdetails ) {
								if ( in_array( $software_product_id, $pdetails['software_ids'] ) ) {
									//match - this license belongs to current package
									$chosen_license = $license;
									break 2;
								}
							}
						}
					}

					if ( $chosen_license ) {
						//there is a new license valid for current package, lets activate it
						$obj      = new BBoss_License_Helper( $package_details );
						$response = $obj->activate( $chosen_license['license_key'], $chosen_license['activation_email'] );

						$response['is_active'] = $response['status'];

						$package_product_keys = array();
						//get all product ids in the package
						foreach ( $package_details['products'] as $product_key => $product ) {
							$package_product_keys[] = $product_key;
						}

						$response['product_keys']      = $package_product_keys;
						$saved_licenses[ $package_id ] = $response;

						$licenses_updated[] = $package_details['name'];
					}
				}

				$this->_update_saved_licenses( $saved_licenses );
			}

			if ( ! empty( $licenses_updated ) ) {
				$retval['message'] = sprintf( __( 'Congratulations! License keys for the following product(s) have been activated: %s', 'buddyboss-theme' ), implode( ', ', $licenses_updated ) );

				$current = get_site_transient( 'update_plugins' );	//Get the current update info
				$current->last_checked = 0;						//wp_update_plugins() checks this value when determining
				get_site_transient( 'update_plugins', $current );	//whether to actually check for updates, so we reset it to zero.
				wp_update_plugins();							//Run the internal plugin update check

				$current = get_site_transient( 'update_themes' );
				$current->last_checked = 0;
				get_site_transient( 'update_themes', $current );	//whether to actually check for updates, so we reset it to zero.
				wp_update_themes();

			} else {
				//no licenses updated
				//it can be becuase :

				//1. $licenses is empty
				if ( empty( $licenses ) ) {
					$retval['message'] = __( 'The connection was successful, however, no license key was activated. We could not find any active license in your account, for any of the installed BuddyBoss products.', 'buddyboss-theme' );
				}

				//2. $this->packages are empty
				if ( empty( $this->packages ) ) {
					$retval['message'] = __( 'Your account was successfully connected. No new activations have been made. If you are attempting to activate a new license key, please make sure that the product is installed on your site, and that an active license key is available in your BuddyBoss.com account.', 'buddyboss-theme' );
				}

				//3. no active licenses found
				if ( ! empty( $licenses ) && ! empty( $this->packages ) ) {
					if ( $old_active_licenses_count > 0 ) {
						$retval['message'] = __( 'Your account was successfully connected. No new activations have been made. If you are attempting to activate a new license key, please make sure that the product is installed on your site, and that an active license key is available in your BuddyBoss.com account.', 'buddyboss-theme' );
					} else {
						$retval['message'] = __( 'The connection was successful, however, no license key was activated. We could not find any active license in your account, for any of the installed BuddyBoss products.', 'buddyboss-theme' );
					}
				}
			}

			return $retval;
		}
	}

	// End class BuddyBoss_Updater_Admin

endif;

require_once( BUDDYBOSS_UPDATER_DIR . '/includes/vendor/license.php' );
