<?php

namespace BuddyBossTheme;

if ( !class_exists( '\BuddyBossTheme\BaseTheme' ) ) {

	Class BaseTheme {
		# --------- Constants ------------------

		const VERSION	 = '0.1';
		const NAME	 = 'BuddyBoss Theme';

		# --------- Variables ------------------

		/**
		 * @var string parent/main theme path
		 */
		protected $_tpl_dir;

		/**
		 * @var string parent theme url
		 */
		protected $_tpl_url;

		/**
		 * @var string includes path
		 */
		protected $_inc_dir;

		/**
		 * @var array modules array
		 */
		protected $_mods;
		protected $_buddypress_helper	    = false;
		protected $_bbpress_helper		    = false;
		protected $_learndash_helper	    = false;
		protected $_woocommerce_helper	    = false;
		protected $_related_posts_helper    = false;
		protected $_elementor_helper        = false;
		protected $_elementor_helper_pro    = false;
		protected $_beaver_themer_helper    = false;
		protected $_admin				    = false;

		/**
		 * Text Domain of Plugin Scope
		 *
		 * @var string
		 */
		public $lang_domain    = 'buddyboss-theme';

		# ---------- Properties ------------------

		/**
		 * @return string parent/main theme path
		 */
		public function tpl_dir() {
			return $this->_tpl_dir;
		}

		public function tpl_url() {
			return $this->_tpl_url;
		}

		public function inc_dir() {
			return $this->_inc_dir;
		}

		/**
		 * Get the instance of BuddyPressHelper class
		 *
		 * @return bool
		 */
		public function buddypress_helper() {
			return $this->_buddypress_helper;
		}

		/**
		 * Get the instance of BBPressHelper class
		 *
		 * @return bool
		 */
		public function bbpress_helper() {
			return $this->_bbpress_helper;
		}

		public function learndash_helper() {
			return $this->_learndash_helper;
		}

		public function woocommerce_helper() {
			return $this->_woocommerce_helper;
		}

		public function related_posts_helper() {
			return $this->_related_posts_helper;
		}

		public function elementor_helper() {
			return $this->_elementor_helper;
		}

		public function elementor_pro_helper() {
			return $this->_elementor_helper_pro;
		}

		public function beaver_themer_helper() {
			return $this->_beaver_themer_helper;
		}

		/**
		 * Get the instance of \BuddyBossTheme\Admin class
		 *
		 * @return bool
		 */
		public function admin() {
			return $this->_admin;
		}

		/**
		 * Get the version number of theme. This is used while enqueueing scripts and styles. Usefule for cache busting.
		 *
		 * @todo Find a way to read it from readme.txt instead of using hardcoded value.
		 *
		 * @return string version number of theme
		 */
		public function version() {
			$theme = wp_get_theme( 'buddyboss-theme' );
			return $theme[ 'Version' ];
		}

		# ---------- Constructor ------------------

		/**
		 * Get the instance of this class.
		 *
		 * @static \BuddyBossTheme\BaseTheme $instance
		 * @return \BuddyBossTheme\BaseTheme
		 */
		public static function instance() {
			static $instance = null;

			if ( null === $instance ) {
				$instance = new \BuddyBossTheme\BaseTheme();
			}

			return $instance;
		}

		/**
		 * Constructor
		 */
		private function __construct() {
			/**
			 * Globals, constants, theme path etc
			 */
			$this->_setup_globals();

			/**
			 * Load required theme files
			 */
			$this->_do_includes();

			/**
			 * Actions/filters
			 */
			$this->_setup_actions_filters();
		}

		# ---------- Setup --------------------

		/**
		 * Setup config/global/constants etc variables
		 */
		private function _setup_globals() {
			// Get theme path
			$this->_tpl_dir = get_template_directory();

			// Get theme url
			$this->_tpl_url = get_template_directory_uri();

			// Get includes path
			$this->_inc_dir = $this->_tpl_dir . '/inc';

			if ( !defined( 'BUDDYBOSS_DEBUG' ) ) {
				define( 'BUDDYBOSS_DEBUG', false );
			}

			if ( !defined( 'THEME_TEXTDOMAIN' ) ) {
				define( 'THEME_TEXTDOMAIN', $this->lang_domain );
			}

			if ( !defined( 'THEME_HOOK_PREFIX' ) ) {
				define( 'THEME_HOOK_PREFIX', 'buddyboss_theme_' );
			}
		}

		/**
		 * Includes
		 */
		protected function _do_includes() {

			// Add Redux Framework
			//if( is_admin() ) {
				require_once( $this->_inc_dir . '/admin/admin-init.php' );
			//}

			require_once( $this->_inc_dir . '/compatibility/incompatible-themes-helper.php' );


			require_once( $this->_inc_dir . '/admin/options/setting-options.php' );

			// Theme suff
			// Wherever possible, we'll put related functions in a separate file, instead of dumping them all in functions.php
			// E.g: all login/logout related functions can go in login.php, all adminbar related functions can go in adminbar.php and so on.
			require_once( $this->_inc_dir . '/theme/functions.php' );
			require_once( $this->_inc_dir . '/theme/template-functions.php' );
			require_once( $this->_inc_dir . '/theme/shortcodes.php' );
			require_once( $this->_inc_dir . '/theme/bookmarks.php' );
			require_once( $this->_inc_dir . '/theme/sidebars.php' );
			require_once( $this->_inc_dir . '/theme/widgets.php' );
			require_once( $this->_inc_dir . '/theme/login.php' );
			require_once( $this->_inc_dir . '/theme/admin-bar.php' );
			require_once( $this->_inc_dir . '/theme/multi-post-thumbnails.php' );

			// BuddyPress Helper
			require_once( $this->_inc_dir . '/plugins/buddypress-helper.php' );
			$this->_buddypress_helper = new \BuddyBossTheme\BuddyPressHelper();

			// bbPress Helper
            require_once( $this->_inc_dir . '/plugins/bbpress-helper.php' );
			$this->_bbpress_helper = new \BuddyBossTheme\BBPressHelper();

			// LearnDash Helper
			if ( class_exists( 'SFWD_LMS' ) ) {
				// LearnDash Helper
				require_once( $this->_inc_dir . '/plugins/learndash-helper.php' );
				require_once( $this->_inc_dir . '/plugins/learndash-compat.php' );
                $this->_learndash_helper = new \BuddyBossTheme\LearndashHelper();
			}

			// Elementor Helper
            if( defined('ELEMENTOR_VERSION') ) {
                require_once($this->_inc_dir . '/plugins/elementor-helper.php');
                $this->_elementor_helper = new \BuddyBossTheme\ElementorHelper();
	            // If plugin - 'Elementor' not exist then return.
	            if ( class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
		            require_once($this->_inc_dir . '/plugins/elementor-helper-pro.php');
		            $this->_elementor_helper_pro = new \BuddyBossTheme\ElementorHelperPro();
	            }
            }

			// Beaver Themer compatibility requires PHP 5.3 for anonymus functions.
			if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
				if ( class_exists( 'FLThemeBuilderLoader' ) || class_exists( 'FLThemeBuilderLayoutData' ) ) {
					require_once($this->_inc_dir . '/plugins/beaver-themer-helper.php');
					$this->_beaver_themer_helper = new \BuddyBossTheme\BeaverThemerHelper();
				}
			}

            // Contextual Related Posts
			require_once( $this->_inc_dir . '/plugins/related-posts-helper.php' );
			$this->_related_posts_helper = new \BuddyBossTheme\RelatedPostsHelper();

			// Others
			require_once( $this->_inc_dir . '/others/utility.php' );
			require_once( $this->_inc_dir . '/others/debug.php' );

			// Allow automatic updates from buddyboss servers
			require_once( $this->_inc_dir . '/others/buddyboss-theme-updater.php' );
			//new \buddyboss_updater_theme( 'http://update.buddyboss.com/theme', basename( get_template_directory() ), 867 );

			// Maintenance Mode
			require_once( $this->_inc_dir . '/maintenance-mode/maintenance-mode.php' );

			// WooCommerce helpers and widgets
			if ( function_exists( 'WC' ) ){
				require_once( $this->_inc_dir . '/plugins/woocommerce-helper.php' );
				$this->_woocommerce_helper = new \BuddyBossTheme\WooCommerceHelper();
			}

            // The Events Calendar
            require_once( $this->_inc_dir . '/tribe-events/events-functions.php' );

			require_once( $this->_inc_dir . '/plugins/buddyboss-menu-icons/menu-icons.php' );
		}

		/**
		 * Actions and filters
		 */
		protected function _setup_actions_filters() {

			if ( is_admin() ) {
				add_action( 'after_setup_theme', array( $this, 'include_buddyboss_updater' ) );
			}

			if ( BUDDYBOSS_DEBUG ) {
				add_action( 'bp_footer', 'buddyboss_dump_log' );
			}
		}

		public function include_buddyboss_updater() {
			global $pagenow;

			if ( ! function_exists( 'buddyboss_updater_init' ) && ! ( 'plugins.php' == $pagenow && ( isset( $_GET['action'] ) && 'activate' == $_GET['action'] ) ) ) {
				require_once( $this->_inc_dir . '/lib/buddyboss-updater/buddyboss-updater.php' );
			}
		}

	}

}
