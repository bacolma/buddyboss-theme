<?php 

/**
 * Elementor Helper Functions
 *
 */

namespace BuddyBossTheme;

if ( !class_exists( '\BuddyBossTheme\ElementorHelper' ) ) {

    Class ElementorHelper {

        protected $_is_active = false;

        /**
         * Constructor
         */
        public function __construct () {
	        add_action( 'elementor/preview/init', array( $this, 'buddyboss_elementor_preview' ) );
        }
        
        public function set_active(){
            $this->_is_active = true;
        }

        public function is_active(){
            return $this->_is_active;
        }

        /**
         * This function will be called when elementor preview page will initiate.
         * @param $instance Elementor Previewer Instance
         */
        function buddyboss_elementor_preview($instance) {
            add_filter("get_post_metadata", array($this, 'buddyboss_add_preview_template_support'), 99, 4);
        }

        /**
         * By default Elementor doesn't care about what template type you have selected.
         * So on that case it never works with custom theme.
         * So We will be using the template settings from last revision post of particular CPT type.
         *
         * @param $value
         * @param $post_id
         * @param $meta_key
         * @param $single
         * @return mixed
         */
        function buddyboss_add_preview_template_support($value, $post_id, $meta_key, $single) {

            if ( ! $post = get_post() ) {
                return $value;
            }

            if ( empty( $_REQUEST['elementor-preview'] ) ||
                $post->ID != $post_id ||
                '_wp_page_template' != $meta_key ||
                'revision' == $post->post_type ||
                $post_id != $_REQUEST['elementor-preview']
            ) {
                return $value;
            }

            $revisions = wp_get_post_autosave( $post_id );

            $revision_id = false;

            if($revisions){
                $revision_id = $revisions->ID;
            }

            if(!$revision_id) {
                return $value;
            }

            $value = get_post_meta($revision_id,"_wp_page_template",true);

            return $value;
        }
    }
}