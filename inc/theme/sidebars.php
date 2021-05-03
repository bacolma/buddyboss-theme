<?php

if ( !function_exists( 'buddyboss_widgets_init' ) ) {

	/**
	 * Registers all of our widget areas.
	 *
	 * @since Boss 1.0.0
	 */
	function buddyboss_widgets_init() {
		// Blog sidebar
		register_sidebar( array(
			'name'			 => __( 'Blog Sidebar', 'buddyboss-theme' ),
			'id'			 => 'sidebar',
			'description'	 => __( 'Widgets in this area will be shown on blog posts and archives.', 'buddyboss-theme' ),
			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</aside>',
			'before_title'	 => '<h2 class="widget-title">',
			'after_title'	 => '</h2>'
		) );

		// Pages sidebar
		register_sidebar( array(
			'name'			 => __( 'Page Sidebar', 'buddyboss-theme' ),
			'id'			 => 'page',
			'description'	 => __( 'Widgets in this area will be shown on Pages.', 'buddyboss-theme' ),
			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</aside>',
			'before_title'	 => '<h2 class="widget-title">',
			'after_title'	 => '</h2>'
		) );

        if ( function_exists('bp_is_active') ) {
			if ( bp_is_active( 'activity' ) ) {
        		// Located in the Activity Directory left column. Left column only appears if widgets are added.
        		register_sidebar( array(
        			'name'			 => __( 'Activity &rarr; Directory Left', 'buddyboss-theme' ),
        			'id'			 => 'activity_left',
        			'description'	 => __( 'Widgets in this area will be shown on the News Feed page.', 'buddyboss-theme' ),
        			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
        			'after_widget'	 => '</aside>',
        			'before_title'	 => '<h2 class="widget-title">',
        			'after_title'	 => '</h2>'
        		) );

        		// Located in the Activity Directory right column. Right column only appears if widgets are added.
        		register_sidebar( array(
        			'name'			 => __( 'Activity &rarr; Directory Right', 'buddyboss-theme' ),
        			'id'			 => 'activity_right',
        			'description'	 => __( 'Widgets in this area will be shown on the News Feed page.', 'buddyboss-theme' ),
        			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
        			'after_widget'	 => '</aside>',
        			'before_title'	 => '<h2 class="widget-title">',
        			'after_title'	 => '</h2>'
        		) );
            }

            // Located in the Members Directory right column. Right column only appears if widgets are added.
    		register_sidebar( array(
    			'name'			 => __( 'Members &rarr; Directory', 'buddyboss-theme' ),
    			'id'			 => 'members',
				'description'	 => __( 'Widgets in this area will be shown on the Members directory.', 'buddyboss-theme' ),
    			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
    			'after_widget'	 => '</aside>',
    			'before_title'	 => '<h2 class="widget-title">',
    			'after_title'	 => '</h2>'
    		) );

    		// Located in the Individual Member Profile right column. Right column only appears if widgets are added.
    		register_sidebar( array(
    			'name'			 => __( 'Members &rarr; Single Profile', 'buddyboss-theme' ),
    			'id'			 => 'profile',
				'description'	 => __( 'Widgets in this area will be shown on individual member profiles.', 'buddyboss-theme' ),
    			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
    			'after_widget'	 => '</aside>',
    			'before_title'	 => '<h2 class="widget-title">',
    			'after_title'	 => '</h2>'
    		) );

			if ( bp_is_active( 'activity' ) ) {
				register_sidebar( array(
					'name'			 => __( 'Members &rarr; User Activity', 'buddyboss-theme' ),
					'id'			 => 'user_activity',
					'description'	 => __( 'Widgets in this area will be shown on the user activity page.', 'buddyboss-theme' ),
					'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'	 => '</aside>',
					'before_title'	 => '<h2 class="widget-title">',
					'after_title'	 => '</h2>'
				) );
            }

            if ( bp_is_active( 'groups' ) ) {
                // Located in the Groups Directory right column. Right column only appears if widgets are added.
        		register_sidebar( array(
        			'name'			 => __( 'Groups &rarr; Directory', 'buddyboss-theme' ),
        			'id'			 => 'groups',
					'description'	 => __( 'Widgets in this area will be shown on the Groups directory.', 'buddyboss-theme' ),
        			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
        			'after_widget'	 => '</aside>',
        			'before_title'	 => '<h2 class="widget-title">',
        			'after_title'	 => '</h2>'
        		) );

        		// Located in the Individual Group right column. Right column only appears if widgets are added.
        		register_sidebar( array(
        			'name'			 => __( 'Groups &rarr; Single Group', 'buddyboss-theme' ),
        			'id'			 => 'group',
					'description'	 => __( 'Widgets in this area will be shown on individual groups.', 'buddyboss-theme' ),
        			'before_widget'	 => '<aside id="%1$s" class="widget %2$s"><div class="inner">',
        			'after_widget'	 => '</div></aside>',
        			'before_title'	 => '<h2 class="widget-title">',
        			'after_title'	 => '</h2>'
        		) );

        		// Located in the Individual Group right column. Right column only appears if widgets are added.
        		register_sidebar( array(
        			'name'			 => __( 'Groups &rarr; Group Activity', 'buddyboss-theme' ),
        			'id'			 => 'group_activity',
					'description'	 => __( 'Widgets in this area will be shown on group activity.', 'buddyboss-theme' ),
        			'before_widget'	 => '<aside id="%1$s" class="widget %2$s"><div class="inner">',
        			'after_widget'	 => '</div></aside>',
        			'before_title'	 => '<h2 class="widget-title">',
        			'after_title'	 => '</h2>'
        		) );
            }
        }
        
        if ( function_exists('is_bbpress') ) {
    		// Located in the Forums Directory right column. Left column only appears if widgets are added.
    		register_sidebar( array(
    			'name'			 => __( 'Forums &rarr; Directory & Single', 'buddyboss-theme' ),
    			'id'			 => 'forums',
				'description'	 => __( 'Widgets in this area will be shown on Forum Discussions Directory and single pages.', 'buddyboss-theme' ),
    			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
    			'after_widget'	 => '</aside>',
    			'before_title'	 => '<h2 class="widget-title">',
    			'after_title'	 => '</h2>'
    		) );
        }

		// Dedicated sidebar for WooCommerce
        if ( class_exists( 'WooCommerce' ) ) {
            register_sidebar( array(
    			'name'			 => __( 'WooCommerce &rarr; Shop', 'buddyboss-theme' ),
    			'id'			 => 'woo_sidebar',
				'description'	 => __( 'Widgets in this area will be shown on Shop Directory.', 'buddyboss-theme' ),
    			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
    			'after_widget'	 => '</aside>',
    			'before_title'	 => '<h2 class="widget-title">',
    			'after_title'	 => '</h2>',
    		) );
        }

        // LearnDash
        if ( class_exists( 'SFWD_LMS' ) ) {
            register_sidebar( array(
    			'name'			 => __( 'LearnDash &rarr; Courses', 'buddyboss-theme' ),
    			'id'			 => 'learndash_sidebar',
				'description'	 => __( 'Widgets in this area will be shown on courses page.', 'buddyboss-theme' ),
    			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
    			'after_widget'	 => '</aside>',
    			'before_title'	 => '<h2 class="widget-title">',
    			'after_title'	 => '</h2>',
    		) );
        }

		$footer_widgets = buddyboss_theme_get_option( 'footer_widgets' );
		$footer_widgets_columns = buddyboss_theme_get_option( 'footer_widget_columns' );

		if( $footer_widgets ) {
			for( $count = 1; $count <= $footer_widgets_columns; $count++ ) {
				register_sidebar( array(
					'name'           => sprintf( __( 'Footer #%s', 'buddyboss-theme' ), $count ),
					'id'			 => 'footer-'.$count,
					'description'	 => sprintf( __( 'The footer widget area %s. Only appears if widgets are added.', 'buddyboss-theme' ), $count ),
					'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'	 => '</aside>',
					'before_title'	 => '<h2 class="widget-title">',
					'after_title'	 => '</h2>'
				) );
			}
		}

		// Search Page Sidebar
		register_sidebar( array(
			'name'			 => __( 'Search Results', 'buddyboss-theme' ),
			'id'			 => 'search',
			'description'	 => __( 'The search widget area. Only appears if widgets are added.', 'buddyboss-theme' ),
			'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</aside>',
			'before_title'	 => '<h2 class="widget-title">',
			'after_title'	 => '</h2>'
		) );
	}

	add_action( 'widgets_init', 'buddyboss_widgets_init' );
}