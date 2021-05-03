<?php 

/**
 * Elementor Pro Helper Functions
 *
 */

namespace BuddyBossTheme;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}

use ElementorPro\Modules\ThemeBuilder\Module;

if ( !class_exists( '\BuddyBossTheme\ElementorHelperPro' ) ) {

    Class ElementorHelperPro {

        protected $_is_active = false;

        /**
         * Constructor
         */
        public function __construct () {
	        // Add locations.
	        add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );

	        // Override theme templates.
	        add_action( THEME_HOOK_PREFIX . 'header', array( $this, 'do_header' ), 0 );
	        add_action( THEME_HOOK_PREFIX . 'footer', array( $this, 'do_footer' ), 0 );
			add_action( THEME_HOOK_PREFIX . 'before_header', array( $this, 'remove_theme_header_class' ), 0 );

	        add_action( THEME_HOOK_PREFIX . '_template_parts_content_top', array( $this, 'do_template_parts' ), 0 );
        }
        
        public function set_active(){
            $this->_is_active = true;
        }

        public function is_active(){
            return $this->_is_active;
        }

	    /**
	     * Register Locations
	     *
	     * @param object $manager Location manager.
	     * @return void
	     */
	    public function register_locations( $manager ) {
		    $manager->register_all_core_location();
	    }

	    /**
	     * Template Parts Support
	     *
	     * @since 1.2.7
	     * @return void
	     */
	    function do_template_parts() {
		    // IS Single?
		    $did_location = Module::instance()->get_locations_manager()->do_location( 'single' );
		    if ( $did_location ) {
			    remove_action( THEME_HOOK_PREFIX . '_single_template_part_content', 'buddyboss_theme_single_template_part_content' );
		    }
	    }

	    /**
	     * Header Support
	     *
	     * @return void
	     */
	    public function remove_theme_header_class() {
		    $did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
		    if ( $did_location ) {
				add_filter('buddyboss_site_header_class', function(){ return 'elementor-header'; });
			}
	    }

	    /**
	     * Header Support
	     *
	     * @return void
	     */
	    public function do_header() {
		    $did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
		    if ( $did_location ) {
			    remove_action( THEME_HOOK_PREFIX . 'header', 'buddyboss_theme_header' );
			    remove_action( THEME_HOOK_PREFIX . 'header', 'buddyboss_theme_mobile_header' );
				remove_action( THEME_HOOK_PREFIX . 'header', 'buddyboss_theme_header_search' );
		    }
	    }

	    /**
	     * Footer Support
	     *
	     * @return void
	     */
	    public function do_footer() {
		    $did_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
		    if ( $did_location ) {
			    remove_action( THEME_HOOK_PREFIX . 'footer', 'buddyboss_theme_footer_area' );
		    }
	    }
    }
}