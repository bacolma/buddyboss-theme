<?php 

/**
 * Elementor Pro Helper Functions
 *
 */

namespace BuddyBossTheme;

// If plugin - 'Beaver Themer' not exist then return.
if ( ! class_exists( 'FLThemeBuilderLoader' ) || ! class_exists( 'FLThemeBuilderLayoutData' ) ) {
	return;
}

if ( ! class_exists( '\BuddyBossTheme\BeaverThemerHelper' ) ) {

    Class BeaverThemerHelper {

        protected $_is_active = false;

        /**
         * Constructor
         */
        public function __construct () {
			add_action( 'after_setup_theme', array( $this, 'header_footer_support' ) );
			add_action( 'wp', array( $this, 'theme_header_footer_render' ) );
			add_filter( 'fl_theme_builder_part_hooks', array( $this, 'register_part_hooks' ) );
        }

        public function set_active(){
            $this->_is_active = true;
        }

        public function is_active(){
            return $this->_is_active;
        }

		/**
		 * Function to add Theme Support
		 *
		 */
		function header_footer_support() {

			add_theme_support( 'fl-theme-builder-headers' );
			add_theme_support( 'fl-theme-builder-footers' );
			add_theme_support( 'fl-theme-builder-parts' );
		}

		/**
		 * Function to update BuddyBoss header/footer with Beaver template
		 *
		 */
		function theme_header_footer_render() {

			// Get the header ID.
			$header_ids = \FLThemeBuilderLayoutData::get_current_page_header_ids();

			// If we have a header, remove the theme header and hook in Theme Builder's.
			if ( ! empty( $header_ids ) ) {
				remove_action( THEME_HOOK_PREFIX . 'header', 'buddyboss_theme_header' );
				remove_action( THEME_HOOK_PREFIX . 'header', 'buddyboss_theme_mobile_header' );
				remove_action( THEME_HOOK_PREFIX . 'header', 'buddyboss_theme_header_search' );
				add_action( THEME_HOOK_PREFIX . 'header', 'FLThemeBuilderLayoutRenderer::render_header' );
				add_filter('buddyboss_site_header_class', function(){ return 'beaver-header'; });

				add_filter('body_class', function (array $classes) {
					if (in_array('sticky-header', $classes)) {
					  unset( $classes[array_search('sticky-header', $classes)] );
					}
					return $classes;
				});
			}

			// Get the footer ID.
			$footer_ids = \FLThemeBuilderLayoutData::get_current_page_footer_ids();

			// If we have a footer, remove the theme footer and hook in Theme Builder's.
			if ( ! empty( $footer_ids ) ) {
				remove_action( THEME_HOOK_PREFIX . 'footer', 'buddyboss_theme_footer_area' );
				add_action( THEME_HOOK_PREFIX . 'footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
			}

			// BB Themer Support.
			$template_ids = \FLThemeBuilderLayoutData::get_current_page_content_ids();

			if ( ! empty( $template_ids ) ) {

				$template_id   = $template_ids[0];
				$template_type = get_post_meta( $template_id, '_fl_theme_layout_type', true );

				if( 'archive' === $template_type ) {
					remove_filter( 'post_class', 'bb_set_row_post_class', 10, 3 );
				}

				if ( 'archive' === $template_type || 'singular' === $template_type || '404' === $template_type ) {}
			}
		}

		/**
		 * Function to BuddyBoss Theme parts
		 *
		 */
		function register_part_hooks() {

			return array(
				array(
					'label' => 'Page',
					'hooks' => array(
						THEME_HOOK_PREFIX . 'before_page'   => __( 'Before Page', 'buddyboss-theme' ),
						THEME_HOOK_PREFIX . 'after_page'	=> __( 'After Page', 'buddyboss-theme' ),
					),
				),
				array(
					'label' => 'Header',
					'hooks' => array(
						THEME_HOOK_PREFIX . 'before_header' => __( 'Before Header', 'buddyboss-theme' ),
						THEME_HOOK_PREFIX . 'after_header'  => __( 'After Header', 'buddyboss-theme' ),
					),
				),
				array(
					'label' => 'Content',
					'hooks' => array(
						THEME_HOOK_PREFIX . 'before_content'    => __( 'Before Content', 'buddyboss-theme' ),
						THEME_HOOK_PREFIX . 'after_content'		=> __( 'After Content', 'buddyboss-theme' ),
					),
				),
				array(
					'label' => 'Footer',
					'hooks' => array(
						THEME_HOOK_PREFIX . 'before_footer' => __( 'Before Footer', 'buddyboss-theme' ),
						THEME_HOOK_PREFIX . 'after_footer'  => __( 'After Footer', 'buddyboss-theme' ),
					),
				)
			);
		}
    }
}