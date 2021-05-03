<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// check if class exists or not.
if ( ! class_exists( 'Buddyboss_Menu_Icons' ) ) {
	/**
	 * Main plugin class
	 */
	final class Buddyboss_Menu_Icons {

		const VERSION = '1.0.0';

		/**
		 * Holds the instance
		 *
		 * Ensures that only one instance of Buddyboss_Menu_Icons exists in memory at any one
		 * time and it also prevents needing to define globals all over the place.
		 *
		 * TL;DR This is a static property property that holds the singleton instance.
		 *
		 * @var Buddyboss_Menu_Icons object
		 * @static
		 */
		private static $instance;

		/**
		 * Notices (array)
		 *
		 * @since 1.0.0
		 * @var array
		 */
		public $notices = array();

		/**
		 * Holds plugin data
		 *
		 * @access protected
		 * @since 1.0.0
		 * @var    array
		 */
		protected static $data;

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @return Buddyboss_Menu_Icons The *Singleton* instance.
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
				self::$instance->setup();
			}

			return self::$instance;
		}

		/**
		 * Setup Menu Icon.
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function setup() {

			self::$instance->setup_constants();

			// Init hook.
			add_action( 'init', array( $this, 'init' ), 10 );
			add_action( 'admin_notices', array( $this, 'admin_notices' ), 15 );
			add_action( 'network_admin_notices', array( $this, 'admin_notices' ), 15 );
			add_action( 'admin_init', array( $this, 'prevent_activating_menu_icons' ) );
		}

		/**
		 * Prevent Menu Icons plugin activation
		 *
		 * @since 1.0.0
		 */
		public function prevent_activating_menu_icons() {
			global $pagenow;

			if ( $pagenow == 'plugins.php' ) {

				if ( isset( $_GET['action'] ) && $_GET['action'] == 'activate' && isset( $_GET['plugin'] ) ) {

					if ( $_GET['plugin'] == Buddyboss_Menu_Icons::get( 'menu_icons_basename' ) ) {
						wp_redirect( self_admin_url( 'plugins.php?prevent_activating_menu_icons=1' ), 301 );
						exit;
					}

				}

				if ( isset( $_GET['prevent_activating_menu_icons'] ) ) {
					$this->prevented_activating_menu_icons_notice();
				}
			}
		}

		/**
		 * Show a notice that an attempt to activate Menu Icons plugin was blocked.
		 *
		 * @since 1.0.0
		 */
		public function prevented_activating_menu_icons_notice() {

			$this->add_admin_notice( 'prompt_activate_error', 'error', __( '<p><strong>Menu Icons can\'t be activated.</strong></p> <p>The BuddyBoss Themes can\'t work while Menu Icons plugin is active.</p>', 'buddyboss-theme' ) );
		}

		/**
		 * Init the plugin after plugins_loaded so environment variables are set.
		 *
		 * @since 2.1.1
		 */
		public function init() {

			// Don't hook anything else in the plugin if we're in an incompatible environment.
			if ( $this->get_environment_warning() ) {
				return;
			}

			$vendor_file = dirname( __FILE__ ) . '/vendor/autoload.php';

			if ( is_readable( $vendor_file ) ) {
				require_once $vendor_file;
			}
			// Load Icon Picker.
			if ( ! class_exists( 'Icon_Picker' ) ) {
				$ip_file = self::$data['dir'] . 'includes/library/icon-picker/icon-picker.php';

				if ( file_exists( $ip_file ) ) {
					require_once $ip_file;
				} else {
					$this->add_admin_notice( 'prompt_activate_error', 'error', __( '<p>Looks like BuddyBoss Menu Icons was installed via Composer. Please activate Icon Picker first.</p>', 'buddyboss-theme' ) );

					return;
				}
			}
			Icon_Picker::instance();

			add_filter( 'themeisle_sdk_products', array( 'Buddyboss_Menu_Icons', 'kucrut_register_sdk' ), 10, 1 );

			require_once self::$data['dir'] . 'includes/library/compat.php';
			require_once self::$data['dir'] . 'includes/library/functions.php';
			require_once self::$data['dir'] . 'includes/meta.php';

			Menu_Icons_Meta::init();

			add_action( 'icon_picker_init', array( __CLASS__, '_init' ), 9 );
		}

		/**
		 * Check plugin environment.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return bool
		 */
		public function get_environment_warning() {
			// Flag to check whether plugin file is loaded or not.
			$warning = false;

			// Load plugin helper functions.
			if ( ! function_exists( 'is_plugin_active' ) ) {
				require_once ABSPATH . '/wp-admin/includes/plugin.php';
			}

			// Check for if Menu Icon plugin activate or not.
			$is_active = is_plugin_active( Buddyboss_Menu_Icons::get( 'menu_icons_basename' ) ) ? true : false;

			if ( ! empty( $is_active ) ) {

				deactivate_plugins( Buddyboss_Menu_Icons::get( 'menu_icons_basename' ) );

				$plugins_url  = is_network_admin() ? network_admin_url( 'plugins.php' ) : admin_url( 'plugins.php' );
				$link_plugins = sprintf( "<a href='%s'>%s</a>", $plugins_url, __( 'deactivate', 'buddyboss-theme' ) );
				// Show admin notice.
				$this->add_admin_notice( 'prompt_activate_error', 'error', sprintf( __( '<p><strong>Menu Icons is deactivate.</strong></p> <p>BuddyBoss Themes can\'t work while Menu Icons plugin is active. So Menu Icons is been deactivated</p>', 'buddyboss-theme' ), $link_plugins ) );
				$warning = true;
			}

			return $warning;
		}


		/**
		 * Setup constants.
		 *
		 * @since Menu Icons  1.0.0
		 * @access  private
		 */
		private function setup_constants() {

			self::$data = array(
				'dir'                 => get_template_directory() . '/inc/plugins/buddyboss-menu-icons/',
				'url'                 => get_template_directory_uri() . '/inc/plugins/buddyboss-menu-icons/',
				'types'               => array(),
				'menu_icons_basename' => 'menu-icons/menu-icons.php',
			);


			$this->public_data = self::$data;
		}


		/**
		 * Get plugin data
		 *
		 * @since Menu Icons 1.0.0
		 *
		 * @param  string $name
		 *
		 * @return mixed
		 */
		public static function get( $name = null ) {
			if ( is_null( $name ) ) {
				return self::$data;
			}

			if ( isset( self::$data[ $name ] ) ) {
				return self::$data[ $name ];
			}

			return null;
		}


		public function kucrut_register_sdk( $products ) {

			$products[] = __FILE__;

			return $products;
		}

		/**
		 * Initialize
		 *
		 * 1. Get registered types from Icon Picker
		 * 2. Load settings
		 * 3. Load front-end functionalities
		 *
		 * @since Menu Icons  0.1.0
		 * @since Menu Icons  0.9.0  Hook into `icon_picker_init`.
		 * @wp_hook action icon_picker_init
		 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference
		 */
		public static function _init() {
			/**
			 * Allow themes/plugins to add/remove icon types
			 *
			 * @since 0.1.0
			 *
			 * @param array $types Icon types
			 */
			self::$data['types'] = apply_filters(
				'menu_icons_types',
				Icon_Picker_Types_Registry::instance()->types
			);

			// Nothing to do if there are no icon types registered.
			if ( empty( self::$data['types'] ) ) {
				if ( WP_DEBUG ) {
					trigger_error( esc_html__( 'Menu Icons: No registered icon types found.', 'buddyboss-theme' ) );
				}

				return;
			}

			// Load settings.
			require_once self::$data['dir'] . 'includes/settings.php';
			Menu_Icons_Settings::init();

			// Load front-end functionalities.
			if ( ! is_admin() ) {
				require_once self::$data['dir'] . '/includes/front.php';
				Menu_Icons_Front_End::init();
			}

			do_action( 'menu_icons_loaded' );
		}

		/**
		 * Allow this class and other classes to add notices.
		 *
		 * @param string $slug Notice Slug.
		 * @param string $class Notice Class.
		 * @param string $message Notice Message.
		 */
		public function add_admin_notice( $slug, $class, $message ) {
			$this->notices[ $slug ] = array(
				'class'   => $class,
				'message' => $message,
			);
		}

		/**
		 * Display admin notices.
		 */
		public function admin_notices() {
			$allowed_tags = array(
				'a'      => array(
					'href'  => array(),
					'title' => array(),
				),
				'strong' => array(),
				'p'      => array(),
			);
			foreach ( (array) $this->notices as $notice_key => $notice ) {
				echo "<div class='" . esc_attr( $notice['class'] ) . "'><p>";
				echo wp_kses( $notice['message'], $allowed_tags );
				echo '</p></div>';
			}
		}

	}


	/**
	 * Loads a single instance of Buddyboss_Menu_Icons.
	 *
	 * This follows the PHP singleton design pattern.
	 *
	 * Use this function like you would a global variable, except without needing
	 * to declare the global.
	 *
	 * @example <?php $buddyboss_menu_icons = Buddyboss_Menu_Icons(); ?>
	 *
	 * @since Menu Icons  1.0.0
	 *
	 * @return object Buddyboss_Menu_Icons
	 */
	function buddyboss_menu_icons() {
		return Buddyboss_Menu_Icons::get_instance();
	}

	buddyboss_menu_icons();
}