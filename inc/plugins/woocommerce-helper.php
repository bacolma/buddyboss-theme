<?php 

/**
 * WooCommerce Helper Functions
 *
 */

namespace BuddyBossTheme;

if ( !class_exists( '\BuddyBossTheme\WooCommerceHelper' ) ) {

    Class WooCommerceHelper {

        protected $_is_active = false;

        /**
         * Constructor
         */
        public function __construct () {

        	//WooCommerce start wrapper
//	        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
//	        add_action( 'woocommerce_before_main_content', array( $this, 'theme_wrapper_start' ), 10 );
//
//	        //WooCommerce end wrapper
//	        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
//	        add_action( 'woocommerce_after_main_content', array( $this, 'theme_wrapper_end' ), 10 );
//
//	        add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
//
//	        //WooCommerce 3.0 - setup
//	        add_action( 'after_setup_theme', array( $this, 'setup' ) );
//
//	        //Reposition WooCommerce breadcrumb
//	        add_action( 'woocommerce_before_main_content', array( $this, 'remove_breadcrumb' ) );
//	        add_action( 'woo_custom_breadcrumb', array( $this, 'custom_breadcrumb' ) );
//
//	        //WooCommerce - Customizing checkout fields
//	        add_filter( 'woocommerce_checkout_fields' , array( $this, 'override_checkout_fields' ) );
//
//	        //WooCommerce - Reorder woocommerce_single_product_summary content
//	        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//	        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );
//
//	        add_action( 'woocommerce_before_shop_loop', array( $this, 'before_shop_loop' ), 40 );
//
//	        //WooCommerce - Change priority of tabs on product page
//	        add_filter( 'woocommerce_product_tabs', array( $this, 'reorder_tabs' ), 98 );
//	        //WooCommerce - Change review tab title
//	        add_filter( 'woocommerce_product_tabs', array( $this, 'rename_reviews_tab' ), 98 );
//
//	        add_filter( 'body_class', array( $this, 'sidebar_body_class' ) );

	        add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'header_cart_fragment' ) );

	        /**
	         * Remove the error when user reset the account details
	         */
	        add_filter( 'woocommerce_save_account_details_required_fields', array( $this, 'remove_non_require_fields' ) );

	        // Remove WooCommerce Membership Plugin restrict content on the blog page.
	        add_action( 'wp_head', array( $this, 'woocommerce_remove_membership_post_restrictions' ), 1 );

        }

	    /**
	     * Remove WooCommerce Membership Plugin restrict content on the blog page.
	     *
	     */
	    public function woocommerce_remove_membership_post_restrictions() {

		    $page_for_posts = get_option( 'page_for_posts' );
		    $blog_page      = get_queried_object_id();

		    if ( function_exists( 'wc_memberships' ) && isset( $blog_page ) && '' !== $blog_page && (int) $page_for_posts === $blog_page ) {
			    remove_action( 'the_post',
				    array(
					    wc_memberships()->get_restrictions_instance()->get_posts_restrictions_instance(),
					    'restrict_post',
				    ),
				    0 );
		    }
	    }

	    /**
	     * Unset the account_display_name fields
	     *
	     * @param $fields
	     *
	     * @return mixed
	     */
	    public function remove_non_require_fields( $fields ) {
		    if ( isset( $fields['account_display_name'] ) ) {
			    unset( $fields['account_display_name'] );
		    }

		    return $fields;
	    }
        
        public function set_active(){
            $this->_is_active = true;
        }

        public function is_active(){
            return $this->_is_active;
        }

	    function setup() {
		    add_theme_support( 'wc-product-gallery-zoom' );
		    add_theme_support( 'wc-product-gallery-lightbox' );
		    add_theme_support( 'wc-product-gallery-slider' );
	    }

	    function theme_wrapper_start() {
		    echo '<div id="primary" class="content-area">';
	    }

	    function theme_wrapper_end() {
		    echo '</div>';
	    }

	    function related_products_args( $args ) {
		    $args['posts_per_page'] = 3; // 3 related products
		    $args['columns'] = 3; // arranged in 3 columns
		    return $args;
	    }

	    function remove_breadcrumb(){
		    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	    }

	    function custom_breadcrumb(){
		    woocommerce_breadcrumb();
	    }

	    function override_checkout_fields( $fields ) {
		    $fields['billing']['billing_first_name']['placeholder'] = __( 'First name', 'buddyboss-theme' );
		    $fields['billing']['billing_last_name']['placeholder'] = __( 'Last name', 'buddyboss-theme' );
		    $fields['billing']['billing_company']['placeholder'] = __( 'Company name', 'buddyboss-theme' );
		    $fields['billing']['billing_city']['placeholder'] = __( 'Town / City', 'buddyboss-theme' );
		    $fields['billing']['billing_postcode']['placeholder'] = __( 'Postcode / ZIP', 'buddyboss-theme' );
		    $fields['billing']['billing_phone']['placeholder'] = __( 'Phone', 'buddyboss-theme' );
		    $fields['billing']['billing_email']['placeholder'] = __( 'Email address', 'buddyboss-theme' );
		    $fields['billing']['billing_state']['placeholder'] = __( 'State / County', 'buddyboss-theme' );

		    $fields['shipping']['shipping_first_name']['placeholder'] = __( 'First name', 'buddyboss-theme' );
		    $fields['shipping']['shipping_last_name']['placeholder'] = __( 'Last name', 'buddyboss-theme' );
		    $fields['shipping']['shipping_company']['placeholder'] = __( 'Company name', 'buddyboss-theme' );
		    $fields['shipping']['shipping_city']['placeholder'] = __( 'Town / City', 'buddyboss-theme' );
		    $fields['shipping']['shipping_state']['placeholder'] = __( 'State / County', 'buddyboss-theme' );
		    $fields['shipping']['shipping_postcode']['placeholder'] = __( 'Postcode / ZIP', 'buddyboss-theme' );

		    return $fields;
	    }

	    function before_shop_loop() {
		    wc_get_template( 'loop/bs-ctrls.php' );
	    }

	    function reorder_tabs( $tabs ) {
		    $tabs['reviews']['priority'] = 15;
		    return $tabs;
	    }

	    function rename_reviews_tab( $tabs ) {
		    global $product;
		    $check_product_review_count = $product->get_review_count();
		    if ( $check_product_review_count == 0 ) {
			    $tabs['reviews']['title'] = __( 'Reviews', 'buddyboss-theme' );
		    } else {
			    $tabs['reviews']['title'] = __( 'Reviews', 'buddyboss-theme' ) . ' (' . $check_product_review_count . ')';
		    }

		    return $tabs;
	    }

	    function header_cart_fragment( $fragments ) {
		    ob_start();
		    get_template_part( 'template-parts/cart-dropdown' );
		    $fragments['div.header-cart-link-wrap'] = ob_get_clean();
		    return $fragments;
	    }

    }

}