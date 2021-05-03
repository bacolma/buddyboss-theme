<?php
if ( ! class_exists( 'BBoss_Updates_Helper' ) ) {
	class BBoss_Updates_Helper {

		public
			$api_url = 'http://update.buddyboss.com/',
			$product_key,
			$plugin_id,
			$plugin_path,
			$plugin_slug,
			$license_key;

		//these should be false, unless api site requires http authentication, as in case of our dev sites.
		//@todo set these to false( or update values if required ) on live site.
		protected
			$_is_http_auth_req = false,
			$_http_username = '',
			$_http_password = '';

		protected $_site_domain = '';

		function __construct( $product_key, $plugin_path, $plugin_id, $product_type = 'plugin' ) {
			$this->product_key = $product_key;
			$this->plugin_path = $plugin_path;
			$this->plugin_id   = $plugin_id;

			$this->api_url = trailingslashit( $this->api_url );

			$this->api_url .= $product_type;

			$this->_site_domain = $this->get_domain();

			$license_obj       = BuddyBoss_Updater_Admin::instance();
			$this->license_key = $license_obj->product_valid_license_key( $this->product_key, true );

			if ( 'plugin' == $product_type ) {
				if ( strstr( $plugin_path, '/' ) ) {
					list ( $t1, $t2 ) = explode( '/', $plugin_path );
				} else {
					$t2 = $plugin_path;
				}
				$this->plugin_slug = str_replace( '.php', '', $t2 );

				add_filter( 'pre_set_site_transient_update_plugins', array( &$this, 'check_for_update' ) );
				add_filter( 'site_transient_update_plugins', array( &$this, 'check_for_package' ) );
				add_filter( 'plugins_api', array( &$this, 'plugin_api_call' ), 10, 3 );
			}

			if ( 'theme' == $product_type ) {
				$this->plugin_slug = $this->plugin_path;

				add_filter( 'pre_set_site_transient_update_themes', array( &$this, 'check_for_update_theme' ) );
				add_filter( 'site_transient_update_themes', array( &$this, 'check_for_package' ) );
			}
			// This is for testing only!
			//set_site_transient( 'update_plugins', null );

			// Show which variables are being requested when query plugin API
			//add_filter( 'plugins_api_result', array(&$this, 'debug_result'), 10, 3 );
		}

		function check_for_package( $transient ) {
			global $pagenow;
			if ( $this->product_key == 'BBOSS_UPDATER' ) {
				return $transient;
			}
			$updatable_packages = apply_filters( 'bboss_updatable_products', array() );
			if ( ! empty( $updatable_packages ) ) {
				foreach ( $updatable_packages as $updatable_package ) {
					if ( $this->plugin_id == $updatable_package['id'] ) {

						/**
						 * Updating the product url in transient to show proper changelog
						 * This releases_link key is only exists in themes as plugin change log is display from the readme file.
						 *
						 * Change the releases link of BuddyBoss, Boss and OneSocial Themes
						 */
						if (isset( $updatable_package['releases_link'] )
							&& in_array( $updatable_package['id'], array( 867, 44, 170 ) )
							&& ! empty( $transient->response[ $this->plugin_path ]['new_version'] )  ) {
							$transient->response[ $this->plugin_path ]['url'] = $updatable_package['releases_link']. str_replace( '.', '-', $transient->response[ $this->plugin_path ]['new_version'] );
						}

						/**
						 * Check to see if the Product has valid licence key
						 */
						$license_obj        = BuddyBoss_Updater_Admin::instance();
						$active_license_key = $license_obj->product_valid_license_key( $this->product_key );

						if ( empty( $active_license_key ) ) {

							$update_core_page = false;
							if ( ! empty( $pagenow ) && 'update-core.php' == $pagenow ) {
								$update_core_page = true;
							}

							if ( isset( $transient->response[ $this->plugin_path ] ) && is_object( $transient->response[ $this->plugin_path ] ) && ! is_array( $transient->response[ $this->plugin_path ] ) ) {
								if ( $update_core_page ) {
									unset( $transient->response[ $this->plugin_path ] );
								} else {
									$transient->response[ $this->plugin_path ]->package = false;
								}
							}

							if ( isset( $transient->response[ $this->plugin_path ] ) && ! is_object( $transient->response[ $this->plugin_path ] ) && is_array( $transient->response[ $this->plugin_path ] ) ) {
								if ( $update_core_page ) {
									unset( $transient->response[ $this->plugin_path ] );
								} else {
									$transient->response[ $this->plugin_path ]['package'] = false;
								}
							}
						}
					}
				}
			}

			return $transient;
		}

		function check_for_update_theme( $transient ) {
			if ( empty( $transient->checked ) ) {
				return $transient;
			}

			$request_args = array(
				'id'      => $this->plugin_id,
				'slug'    => $this->plugin_slug,
				'version' => $transient->checked[ $this->plugin_path ],
			);

			if ( empty( $this->license_key ) ) {
				$license_obj       = BuddyBoss_Updater_Admin::instance();
				$this->license_key = $license_obj->product_valid_license_key( $this->product_key, true );
			}

			//check if license is active
			if ( ! empty( $this->license_key['key'] ) && ! empty( $this->license_key['email'] ) ) {
				$request_args['license_key']      = $this->license_key['key'];
				$request_args['activation_email'] = $this->license_key['email'];
				$request_args['instance']         = $this->_site_domain;
			}

			$request_string = $this->prepare_request( 'theme_update', $request_args );

			$raw_response = wp_remote_post( $this->api_url, $request_string );

			$response = null;
			if ( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) ) {
				$response = unserialize( $raw_response['body'] );
			}

			//Feed the candy !
			if ( is_array( $response ) && ! empty( $response ) ) {
				//add license keys info into download url
				$args = array( 'domain' => $this->_site_domain );

				if ( ! empty( $this->license_key['key'] ) && ! empty( $this->license_key['email'] ) ) {
					$args['license_key']      = $this->license_key['key'];
					$args['activation_email'] = $this->license_key['email'];
					$args['instance']         = $this->_site_domain;
					$response['package']        = add_query_arg( $args, $response['package'] );
				} else if ( $this->product_key == 'BBOSS_UPDATER' ) {
					$response['package'] = add_query_arg( $args, $response['package'] );
				} else {
					$response['package'] = false;
				}

				// Feed the update data into WP updater
				$transient->response[ $this->plugin_path ] = $response;
			}

			return $transient;
		}

		function check_for_update( $transient ) {
			if ( empty( $transient->checked ) ) {
				return $transient;
			}

			/**
			 * Some plugins like seedprod-pro, wp-analytify-pro, uncanny-toolkit-pro etc explicitly set
			 * their corresponding value in $transient->checked array.
			 * Doing that, wipes out other records from that array, for reasons not known yet.
			 * This causes 'version' => $transient->checked[$this->plugin_path],' to return null and so, api query always returns
			 * with the message that there is an update available.
			 *
			 * To fix that, we need to get version number differently, by directly reading the plugin file.
			 */

			$current_version = isset( $transient->checked[ $this->plugin_path ] ) ? $transient->checked[ $this->plugin_path ] : false;
			if ( ! $current_version ) {
				$plugin_data = get_plugin_data( trailingslashit( WP_PLUGIN_DIR ) . $this->plugin_path, false, false );
				if ( ! empty( $plugin_data ) && isset( $plugin_data['Version'] ) ) {
					$current_version = $plugin_data['Version'];
				}
			}

			if ( ! $current_version ) {
				return $transient;
			}

			$request_args = array(
				'id'      => $this->plugin_id,
				'slug'    => $this->plugin_slug,
				'version' => $current_version,
			);

			if ( empty( $this->license_key ) ) {
				$license_obj       = BuddyBoss_Updater_Admin::instance();
				$this->license_key = $license_obj->product_valid_license_key( $this->product_key, true );
			}

			//check if license is active
			if ( ! empty( $this->license_key['key'] ) && ! empty( $this->license_key['email'] ) ) {
				$request_args['license_key']      = $this->license_key['key'];
				$request_args['activation_email'] = $this->license_key['email'];
				$request_args['instance']         = $this->_site_domain;
			}

			$request_string = $this->prepare_request( 'update_check', $request_args );
			$raw_response   = wp_remote_post( $this->api_url, $request_string );

			$response = null;
			if ( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) ) {
				$response = unserialize( $raw_response['body'] );
			}

			if ( is_object( $response ) && ! empty( $response ) ) {
				//add license keys info into download url
				$args = array( 'domain' => $this->_site_domain );

				if ( ! empty( $this->license_key['key'] ) && ! empty( $this->license_key['email'] ) ) {
					$args['license_key']      = $this->license_key['key'];
					$args['activation_email'] = $this->license_key['email'];
					$args['instance']         = $this->_site_domain;
					$response->package        = add_query_arg( $args, $response->package );
				} else if ( $this->product_key == 'BBOSS_UPDATER' ) {
					$response->package = add_query_arg( $args, $response->package );
				} else {
					$response->package = false;
				}

				$response->plugin = $this->plugin_path;
				// Feed the update data into WP updater
				$transient->response[ $this->plugin_path ] = $response;
				//return $transient;
			}

			// Check to make sure there is not a similarly named plugin in the wordpress.org repository
			if ( isset( $transient->response[ $this->plugin_path ] ) ) {
				if ( strpos( $transient->response[ $this->plugin_path ]->package, 'wordpress.org' ) !== false ) {
					unset( $transient->response[ $this->plugin_path ] );
				}
			}

			return $transient;
		}

		function plugin_api_call( $def, $action, $args ) {
			if ( ! isset( $args->slug ) || $args->slug != $this->plugin_slug ) {
				return $def;
			}

			$plugin_info  = get_site_transient( 'update_plugins' );
			$request_args = array(
				'id'      => $this->plugin_id,
				'slug'    => $this->plugin_slug,
				'version' => ( isset( $plugin_info->checked ) ) ? $plugin_info->checked[ $this->plugin_path ] : 0
				// Current version
			);

			if ( empty( $this->license_key ) ) {
				$license_obj       = BuddyBoss_Updater_Admin::instance();
				$this->license_key = $license_obj->product_valid_license_key( $this->product_key, true );
			}

			if ( ! empty( $this->license_key['key'] ) && ! empty( $this->license_key['email'] ) ) {
				$request_args['license_key']      = $this->license_key['key'];
				$request_args['activation_email'] = $this->license_key['email'];
				$request_args['instance']         = $this->_site_domain;
			}

			$request_string = $this->prepare_request( $action, $request_args );
			$raw_response   = wp_remote_post( $this->api_url, $request_string );

			if ( is_wp_error( $raw_response ) ) {
				$res = new WP_Error( 'plugins_api_failed', __( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>', 'buddyboss-theme' ), $raw_response->get_error_message() );
			} else {
				$res = unserialize( $raw_response['body'] );
				if ( $res === false ) {
					$res = new WP_Error( 'plugins_api_failed', __( 'An unknown error occurred', 'buddyboss-theme' ), $raw_response['body'] );
				}
			}

			return $res;
		}

		function prepare_request( $action, $args ) {
			global $wp_version;

			$retval = array(
				'body'       => array(
					'action'  => $action,
					'request' => serialize( $args ),
					'api-key' => md5( home_url() ),
					'domain'  => $this->_site_domain,
				),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
			);

			if ( $this->_is_http_auth_req ) {
				$headers           = array( 'Authorization' => 'Basic ' . base64_encode( "{$this->_http_username}:{$this->_http_password}" ) );
				$retval['headers'] = $headers;
			}

			//timeout for localhost
			$retval['timeout'] = 50;

			return $retval;
		}

		function debug_result( $res, $action, $args ) {
			echo '<pre>' . print_r( $res, true ) . '</pre>';

			return $res;
		}

		public function get_domain() {
			$home_url = "";

			//1. multisite - only the root domain
			if ( is_multisite() ) {
				$home_url = network_home_url();
			} else {
				$home_url = home_url();
			}

			$home_url = untrailingslashit( $home_url );
			$home_url = str_replace( array( 'http://', 'https://', 'www.' ), array( '', '', '' ), $home_url );

			return $home_url;
		}

	}
}
