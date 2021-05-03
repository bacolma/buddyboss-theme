<?php
/**
 * BuddyBoss Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BuddyBoss_Theme
 */
if ( !function_exists( 'buddyboss_theme_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function buddyboss_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BuddyBoss Theme, use a find and replace
		 * to change 'buddyboss-theme' to the name of your theme in all the template files.
		 */
		buddyboss_theme_load_textdomain();

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		//force add theme support for BP nouveau
		add_theme_support('buddypress-use-nouveau');

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		//@todo change this
		set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo' );

		// Adds wp_nav_menu() in two locations with BuddyPress deactivated.
		register_nav_menus( array(
			'buddypanel-loggedin'	 => __( 'BuddyPanel - Logged in users', 'buddyboss-theme' ),
			'buddypanel-loggedout'	 => __( 'BuddyPanel - Logged out users', 'buddyboss-theme' ),
			'header-menu'			 => __( 'Titlebar', 'buddyboss-theme' ),
			'header-my-account'		 => __( 'Profile Dropdown', 'buddyboss-theme' ),
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat',
		) );

		/*
		 * Enable support for WooCommerce
		 * See https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
		 */
		add_theme_support( 'woocommerce' );

		/*
		 * Job Manager Templates
		 */
		add_theme_support( 'job-manager-templates' );

		/*
		 * Remove Emoji Styles
		 */
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}

	add_action( 'after_setup_theme', 'buddyboss_theme_setup' );
}

if ( ! function_exists( 'buddyboss_theme_customize_register' ) ) {

    function buddyboss_theme_customize_register( $wp_customize ) {

        // Remove Logo section from customizer except when elementor pro is activated
        //if ( empty( buddyboss_theme()->elementor_pro_helper() ) ) {
	        $wp_customize->remove_section( 'logo' );
        //}
    }

	add_action( 'customize_register', 'buddyboss_theme_customize_register', 99 );
}

/**
 * Load the buddyboss translation file for current language.
 *
 * @since BuddyPress 1.0.2
 *
 * @see load_textdomain() for a description of return values.
 *
 * @return bool True on success, false on failure.
 */
function buddyboss_theme_load_textdomain() {
	$domain = 'buddyboss-theme';

	/**
	 * Filters the locale to be loaded for the language files.
	 *
	 * @since BuddyBoss 1.0.0
	 *
	 * @param string $value Current locale for the install.
	 */
	$mofile_custom = sprintf( '%s-%s.mo', $domain, apply_filters( 'buddyboss_theme_locale', get_locale() ) );

	/**
	 * Filters the locations to load language files from.
	 *
	 * @since BuddyBoss 1.0.0
	 *
	 * @param array $value Array of directories to check for language files in.
	 */
	$locations = apply_filters( 'buddyboss_theme_locale_locations', array(
		trailingslashit( WP_LANG_DIR . '/' . $domain  ),
		trailingslashit( WP_LANG_DIR ),
		trailingslashit( get_template_directory() . '/languages' ),
	) );

	// Try custom locations in WP_LANG_DIR.
	foreach ( $locations as $location ) {
		if ( load_textdomain( 'buddyboss-theme', $location . $mofile_custom ) ) {
			return true;
		}
	}

	// Default to WP and glotpress.
	return load_theme_textdomain( $domain );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buddyboss_theme_content_width() {
	$GLOBALS[ 'content_width' ] = apply_filters( THEME_HOOK_PREFIX . 'content_width', 640 );
}

add_action( 'after_setup_theme', 'buddyboss_theme_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function buddyboss_theme_scripts() {

	// Icons
	wp_enqueue_style( 'buddyboss-theme-icons', get_template_directory_uri() . '/assets/icons/bb-icons.css', '', buddyboss_theme()->version() );

	// Theme default font
	$custom_font = buddyboss_theme_get_option('custom_typography');
	if( !$custom_font ) {
		wp_enqueue_style( 'buddyboss-theme-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', '', buddyboss_theme()->version() );
	}

	/* Styles */
	$rtl_css = is_rtl() ? '-rtl' : '';
    $minified_css = buddyboss_theme_get_option( 'boss_minified_css' );
    $mincss = $minified_css ? '.min' : '';
    $minified_js = buddyboss_theme_get_option( 'boss_minified_js' );
    $minjs = $minified_js ? '.min' : '';
    wp_enqueue_style( 'buddyboss-theme-magnific-popup-css', get_template_directory_uri() . '/assets/css/vendors/magnific-popup.min.css', '', buddyboss_theme()->version() );
    wp_enqueue_style( 'buddyboss-theme-select2-css', get_template_directory_uri() . '/assets/css/vendors/select2.min.css', '', buddyboss_theme()->version() );
	wp_enqueue_style( 'buddyboss-theme-css', get_template_directory_uri() . '/assets/css' . $rtl_css . '/theme' . $mincss . '.css', '', buddyboss_theme()->version() );

	// BuddyPress
	if( buddyboss_is_bp_active() ) {
		wp_enqueue_style( 'buddyboss-theme-buddypress', get_template_directory_uri() . '/assets/css' . $rtl_css . '/buddypress' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

    // Forums
    if ( class_exists( 'bbPress' ) ) {
        wp_enqueue_style( 'buddyboss-theme-forums', get_template_directory_uri() . '/assets/css' . $rtl_css . '/bbpress' . $mincss . '.css', '', buddyboss_theme()->version() );
    }

    // LearnDash
    if ( class_exists( 'SFWD_LMS' ) ) {
        wp_enqueue_style( 'buddyboss-theme-learndash', get_template_directory_uri() . '/assets/css' . $rtl_css . '/learndash' . $mincss . '.css', '', buddyboss_theme()->version() );
    }

	// WooCommerce
    if ( function_exists( 'WC' ) ){
		wp_enqueue_style( 'buddyboss-theme-woocommerce', get_template_directory_uri() . '/assets/css' . $rtl_css . '/woocommerce' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

	// WP Job Manager
    if ( class_exists( 'WP_Job_Manager' ) ) {
        wp_enqueue_style( 'buddyboss-theme-wpjobmanager', get_template_directory_uri() . '/assets/css' . $rtl_css . '/jobmanager' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

	// WP Job Manager
    if ( class_exists( 'BP_Docs' ) ) {
        wp_enqueue_style( 'buddyboss-theme-docs', get_template_directory_uri() . '/assets/css' . $rtl_css . '/docs' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

	// Elementor
	if ( defined('ELEMENTOR_VERSION') ) {
        wp_enqueue_style( 'buddyboss-theme-elementor', get_template_directory_uri() . '/assets/css' . $rtl_css . '/elementor' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

	// Tribe Events Main
    if ( class_exists( 'Tribe__Events__Main' ) ) {
        wp_enqueue_style( 'buddyboss-theme-eventscalendar', get_template_directory_uri() . '/assets/css' . $rtl_css . '/eventscalendar' . $mincss . '.css', '', buddyboss_theme()->version() );
    }

    if ( class_exists( 'LifterLMS' ) ){
        wp_enqueue_style( 'buddyboss-theme-lifterlms', get_template_directory_uri() . '/assets/css' . $rtl_css . '/lifterlms' . $mincss . '.css', '', buddyboss_theme()->version() );
    }

    if ( class_exists( 'GamiPress' ) ){
        wp_enqueue_style( 'buddyboss-theme-gamipress', get_template_directory_uri() . '/assets/css' . $rtl_css . '/gamipress' . $mincss . '.css', '', buddyboss_theme()->version() );
    }

    if ( class_exists( 'BadgeOS' ) ){
        wp_enqueue_style( 'buddyboss-theme-badgeos', get_template_directory_uri() . '/assets/css' . $rtl_css . '/badgeos' . $mincss . '.css', '', buddyboss_theme()->version() );
    }

    if ( class_exists( 'BuddyForms' ) || class_exists( 'WPCF7' ) || class_exists( 'Easy_Digital_Downloads' ) || class_exists( 'GFForms' ) || class_exists( 'IT_Exchange' ) || class_exists( 'Ninja_Forms' ) || class_exists( 'WPForms' ) || class_exists( 'BuddyBoss_SAP_Plugin' ) ){
        wp_enqueue_style( 'buddyboss-theme-plugins', get_template_directory_uri() . '/assets/css' . $rtl_css . '/plugins' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

	if ( defined('MEPR_PLUGIN_NAME') ) {
		wp_enqueue_style( 'buddyboss-theme-memberpress', get_template_directory_uri() . '/assets/css' . $rtl_css . '/memberpress' . $mincss . '.css', '', buddyboss_theme()->version() );
	}
    
    if ( defined('PMPRO_VERSION') ) {
		wp_enqueue_style( 'buddyboss-theme-pmpro', get_template_directory_uri() . '/assets/css' . $rtl_css . '/pmpro' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

	if ( class_exists( 'WC_Vendors' ) ) {
		wp_enqueue_style( 'buddyboss-theme-wcvendors', get_template_directory_uri() . '/assets/css' . $rtl_css . '/wcvendors' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

	//Add CSS fixes for IE 11 and below
	if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
		wp_enqueue_style( 'buddyboss-theme-ie', get_template_directory_uri() . '/assets/css' . $rtl_css . '/ie' . $mincss . '.css', '', buddyboss_theme()->version() );
	}

	if ( ! is_plugin_active( 'buddyboss-platform/bp-loader.php' ) ) {
		wp_enqueue_script( 'buddyboss-theme-cookie-js', get_template_directory_uri() . '/assets/js/plugins/jquery-cookie' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	}

	/**
	 * Scripts
	 */
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'boss-menu-js', get_template_directory_uri() . '/assets/js/vendors/menu.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'boss-fitvids-js', get_template_directory_uri() . '/assets/js/vendors/fitvids.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'boss-slick-js', get_template_directory_uri() . '/assets/js/vendors/slick.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'boss-panelslider-js', get_template_directory_uri() . '/assets/js/vendors/panelslider.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'boss-sticky-js', get_template_directory_uri() . '/assets/js/vendors/sticky-kit.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'boss-icheck-js', get_template_directory_uri() . '/assets/js/vendors/icheck.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'boss-jssocials-js', get_template_directory_uri() . '/assets/js/vendors/jssocials.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'buddyboss-theme-main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), buddyboss_theme()->version(), true );
    wp_enqueue_script( 'boss-validate-js', get_template_directory_uri() . '/assets/js/vendors/validate.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
    wp_enqueue_script( 'boss-magnific-popup-js', get_template_directory_uri() . '/assets/js/vendors/magnific-popup.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
    wp_enqueue_script( 'select2-js', get_template_directory_uri() . '/assets/js/vendors/select2.full.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
    wp_enqueue_script( 'progressbar-js', get_template_directory_uri() . '/assets/js/vendors/progressbar.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'mousewheel-js', get_template_directory_uri() . '/assets/js/vendors/mousewheel.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	//Add polyfill for Event() constructor in IE 11 and below
	if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
		wp_enqueue_script( 'polyfill-event', get_template_directory_uri() . '/assets/js/vendors/polyfill-event.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	}
    // LearnDash
    if ( class_exists( 'SFWD_LMS' ) ) {
        wp_enqueue_script( 'buddyboss-theme-learndash-js', get_template_directory_uri() . '/assets/js/plugins/learndash' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
        wp_enqueue_script( 'buddyboss-theme-learndash-sidebar-js', get_template_directory_uri() . '/assets/js/plugins/learndash-sidebar' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
        $default = 'off';
        $video   = '';
        if ( is_singular( array( 'sfwd-lessons', 'sfwd-topic' ) ) && function_exists( 'learndash_get_setting' ) ) {
	        $lesson = learndash_get_setting( get_the_ID() );
	        if ( isset( $lesson ) && isset( $lesson[ 'lesson_video_enabled' ] ) && 'on' === $lesson[ 'lesson_video_enabled' ] ) {
		        $default = 'on';
		        if ( isset( $lesson['lesson_video_url'] )&& strpos( $lesson['lesson_video_url'], 'vimeo.com' ) !== false ) {
			        $video = 'vimeo';
		        }
	        }
        }
        $data     = array(
		    'hide_wrapper'              => is_singular( array( 'sfwd-lessons', 'sfwd-topic' ) ) ? 'hide' : 'show',
		    'video_progression_enabled' => $default,
		    'video_type'                => $video,
	    );
	    wp_localize_script( 'buddyboss-theme-learndash-js', 'BBTHEME_LEARNDASH_FRONT_VIDEO', $data );

    }
    if ( function_exists( 'WC' ) ){
        wp_enqueue_script( 'buddyboss-theme-woocommerce-js', get_template_directory_uri() . '/assets/js/plugins/bb-woocommerce' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	}
    if ( class_exists( 'WP_Job_Manager' ) ) {
        wp_enqueue_script( 'buddyboss-theme-wpjobmanager-js', get_template_directory_uri() . '/assets/js/plugins/bb-wpjobmanager' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
    }
    if ( class_exists( 'Tribe__Events__Main' ) ) {
        wp_enqueue_script( 'buddyboss-theme-tec-js', get_template_directory_uri() . '/assets/js/plugins/bb-tec' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
    }
    if ( class_exists( 'GamiPress' ) ){
        wp_enqueue_script( 'buddyboss-theme-gamipress-js', get_template_directory_uri() . '/assets/js/plugins/gamipress' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
    }
    if ( function_exists( 'buddyboss_global_search_init' ) || class_exists( 'WPForms' ) || class_exists( 'IT_Exchange' ) || class_exists( 'Ninja_Forms' ) || class_exists( 'WC_Vendors' )){
        wp_enqueue_script( 'buddyboss-theme-plugins-js', get_template_directory_uri() . '/assets/js/plugins/plugins' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( function_exists( 'bbpress' ) && ( function_exists( 'bp_is_active' ) && bp_is_active( 'forums' ) ) && ( ( function_exists( 'buddypress' ) && 'forum' == buddypress()->current_action ) || bbp_is_single_topic() || bp_current_action() == get_option( '_bbp_forum_slug' ) ) ) {
		wp_enqueue_script( 'draggabilly-js', get_template_directory_uri() . '/assets/js/vendors/draggabilly.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
		wp_enqueue_script( 'buddyboss-theme-bbp-scrubber-js', get_template_directory_uri() . '/assets/js/plugins/bbp-scrubber' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	}

	$show_notifications = buddyboss_theme_get_option( 'notifications' );
	$show_messages      = buddyboss_theme_get_option( 'messages' );

	wp_localize_script( 'buddyboss-theme-main-js', 'bs_data', apply_filters( 'buddyboss-theme-main-js-data', array(
		'jm_ajax'            => home_url( 'jm-ajax/' ),
		'ajaxurl'            => admin_url( 'admin-ajax.php' ),
		'show_notifications' => $show_notifications,
		'show_messages'      => $show_messages,
		'translation'        => array(
			"comment_posted"      => __( "Your comment has been posted.", 'buddyboss-theme' ),
			"comment_btn_loading" => __( "Please Wait...", 'buddyboss-theme' )
		)
	) ) );
}

add_action( 'wp_enqueue_scripts', 'buddyboss_theme_scripts' );

/**
 * Enqueue forums related js to support shortcodes
 */
function buddyboss_forums_scripts() {
	$minified_js = buddyboss_theme_get_option( 'boss_minified_js' );
	$minjs = $minified_js ? '.min' : '';
	wp_enqueue_script( 'draggabilly-js', get_template_directory_uri() . '/assets/js/vendors/draggabilly.min.js', array( 'jquery' ), buddyboss_theme()->version(), true );
	wp_enqueue_script( 'buddyboss-theme-bbp-scrubber-js', get_template_directory_uri() . '/assets/js/plugins/bbp-scrubber' . $minjs . '.js', array( 'jquery' ), buddyboss_theme()->version(), true );
}
add_action( 'bbp_enqueue_scripts', 'buddyboss_forums_scripts' );

function buddyboss_theme_admin_scripts() {
    $minified_js = buddyboss_theme_get_option( 'boss_minified_js' );
    $minjs = $minified_js ? '.min' : '';

    global $typenow, $current_screen;
    if( $typenow == 'sfwd-courses' ) {
        wp_enqueue_media();

        wp_register_script( 'buddyboss-theme-learndash-admin-js', get_template_directory_uri() . '/assets/js/plugins/learndash-admin' . $minjs . '.js', array( 'jquery' ) );
        wp_localize_script( 'buddyboss-theme-learndash-admin-js', 'meta_image',
            array(
                'title' => __( 'Choose or Upload an Image', 'buddyboss-theme' ),
                'button' => __( 'Use this image', 'buddyboss-theme' ),
            )
        );

        if ( class_exists( 'SFWD_LMS' ) ) {
			wp_enqueue_script( 'buddyboss-theme-learndash-admin-js' );
        }
    }

	if ( $typenow == 'page' ) {
		wp_register_script( 'buddyboss-theme-page-admin-js', get_template_directory_uri() . '/assets/js/page' . $minjs . '.js', [ 'jquery', 'wp-util' ] );
		wp_enqueue_script( 'buddyboss-theme-page-admin-js' );
	}
}

add_action( 'admin_enqueue_scripts', 'buddyboss_theme_admin_scripts' );

/**
 * Dequeue buddyforms dropzone styles.
 */
add_action( 'wp_print_styles', 'bb_deregister_styles', 100 );

function bb_deregister_styles() {
  wp_deregister_style( 'buddyforms-dropzone' );
  wp_deregister_style( 'buddyforms-dropzone-basic' );
}

/**
 * Set blog archive layout through theme options
 */
if ( !function_exists( 'set_blog_layout' ) ) {

	function set_blog_layout() {
        $bb_blog_layout = buddyboss_theme_get_option( 'blog_archive_layout' );
		if ( !empty( $bb_blog_layout ) ) {
			return $bb_blog_layout;
		} else {
			return 'standard';
		}
	}

	add_filter( 'bb_blog_type', 'set_blog_layout' );
}

/**
 * Set single blog post featured image layout through theme options
 */
if ( !function_exists( 'featured_img_layout' ) ) {

	function featured_img_layout() {
        $featured_img_style = buddyboss_theme_get_option( 'blog_featured_img' );
		if ( !empty( $featured_img_style ) ) {
			return $featured_img_style;
		} else {
			return 'default-fi';
		}
	}

	add_filter( 'bb_featured_type', 'featured_img_layout' );
}

/**
 * Set BuddyPanel position through theme options
 */
if ( !function_exists( 'bb_buddypanel_menu_atts' ) ) {

	function bb_buddypanel_menu_atts( $atts, $item, $args ) {
		if ( $args->theme_location == 'buddypanel-loggedin' || $args->theme_location == 'buddypanel-loggedout' ) {
			$atts[ 'class' ]			 = 'bb-menu-item';

            $header = buddyboss_theme_get_option( 'buddyboss_header' );
            if ( $header == '3' ) {
                $buddypanel_side = buddyboss_theme_get_option('buddypanel_position_h3');
            } else {
                $buddypanel_side = buddyboss_theme_get_option('buddypanel_position');
            }

            if( $buddypanel_side && $buddypanel_side == 'right' ) {
                $atts[ 'data-balloon-pos' ]	 = 'left';
    		} else {
                $atts[ 'data-balloon-pos' ]	 = 'right';
    		}
			$atts[ 'data-balloon' ]		 = $item->title;
		}

		return $atts;
	}

	add_filter( 'nav_menu_link_attributes', 'bb_buddypanel_menu_atts', 10, 3 );
}

if ( ! function_exists( 'buddyboss_theme_get_first_url_content' ) ) {
	/**
	 *
	 * @param string $post
	 *
	 * @return string
	 */
	function buddyboss_theme_get_first_url_content( $content ) {
		$content = preg_match_all( '/hrefs*=s*["\']([^"\']+)/', $content, $links );

		$first_url = "";
		if ( ! empty( $links ) ) {
			foreach ( $links[1] as $url ) {
				if ( ! empty( $url ) ) {
					$first_url = $url;
					break;
				}
			}
		}

		return $first_url;
	}
}


if ( ! function_exists( 'buddyboss_theme_pull_shortcode_from_content' ) ) {
	function buddyboss_theme_pull_shortcode_from_content( $content, $my_shortcode, $count = 1 ) {
		$pattern = get_shortcode_regex();

		preg_match_all( "/$pattern/s", $content, $matches );
		if ( ! empty( $matches ) ) {
			$retval = array();

			$all_shortcodes = $matches[0];
			foreach ( $all_shortcodes as $maybe_my_shortcode ) {
				//match current shortcode
				if ( strpos( $maybe_my_shortcode, '[' . $my_shortcode ) === 0 ) {
					$retval[] = $maybe_my_shortcode;
					if ( count( $retval ) >= (int) $count ) {
						break;
					}
				}
			}

			if ( ! empty( $retval ) && (int) $count === 1 ) {
				$retval = $retval[0];
			}

			return $retval;
		}

		return false;
	}
}

if ( ! function_exists( 'buddyboss_theme_get_elements_from_html_string' ) ) {
	function buddyboss_theme_get_elements_from_html_string( $html_string, $html_element ) {
		$domDoc = new DOMDocument;
		$domDoc->loadHTML( $html_string );

		return $domDoc->getElementsByTagName( $html_element );
	}
}

// default group avatar
if ( !function_exists( 'bb_change_default_group_avatar' ) ) {

	function bb_change_default_group_avatar() {
		return get_template_directory_uri() .'/assets/images/svg/group-default.svg';
	}

	//add_filter( 'bp_core_default_avatar_group', 'bb_change_default_group_avatar' );
	// This is disable to fix default avatar issue in BP emails.
}

// set SVG dimensions
if ( !function_exists( 'bb_fix_wp_get_attachment_image_svg' ) ) {

	function bb_fix_wp_get_attachment_image_svg() {
		if ( is_array( $image ) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1 ) {
			if( is_array( $size ) ) {
				$image[1] = $size[0];
				$image[2] = $size[1];
			} elseif( ( $xml = simplexml_load_file($image[0] ) ) !== false ) {
				$attr = $xml->attributes();
				$viewbox = explode(' ', $attr->viewBox);
				$image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
				$image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
			} else {
				$image[1] = $image[2] = null;
			}
		}

		return $image;
	}

	add_filter( 'bb_fix_wp_get_attachment_image_svg', 'fix_wp_get_attachment_image_svg', 10, 4 );
}

class BuddyBoss_BuddyPanel_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @since BuddyBossTheme 1.0.0
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Stick to bottom of the menu
		if ( isset( $item->stick_to_bottom ) && '1' == $item->stick_to_bottom ) {
			$classes[] = 'bp-menu-item-at-bottom';
        }

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$icon = false;
		if ( class_exists( 'Menu_Icons' ) || class_exists( 'Buddyboss_Menu_Icons' ) ) {
			$meta = Menu_Icons_Meta::get( $item->ID );
			$icon = Menu_Icons_Front_End::get_icon( $meta );
		}

		if ( ! $icon ) {
			$item->title = "<i class='bb-icon-file'></i><span class='link-text'>{$item->title}</span>";
		}


		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class BuddyBoss_SubMenuWrap extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='wrapper ab-submenu'><ul class='bb-sub-menu'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}

/**
 * WooCommerce 3.0 - setup
 */
if ( function_exists( 'WC' ) ){
    add_action( 'after_setup_theme', 'bb_wc_setup' );
}

function bb_wc_setup() {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

/**
 * Convert string to hax color
 *
 * @param $text
 *
 * @return string
 */
function textToColor( $text ) {
	$code    = dechex( crc32( trim( $text ) ) );
	$hexcode = substr( $code, 0, 6 );
	$rgb     = hex_2_RGB( '#' . $hexcode );
	$hsv     = RGB_2_HSV( $rgb['red'], $rgb['green'], $rgb['blue'] );
	// Transform the color tone to darker if lighter.
	if ( $hsv['S'] < 40 ) {
		$hsv['S'] = 40;
	}
	if ( $hsv['V'] > 75 ) {
		$hsv['V'] = 75;
	}
	$rgb   = HSV_2_RGB( $hsv );
	$color = rgb2hex( $rgb[0], $rgb[1], $rgb[2] );

	return $color;
}

/**
 * hex to rgb
 *
 */
function color2rgba( $color, $opacity = false ) {

	$default = 'rgb( 0, 0, 0 )';

	/**
	 * Return default if no color provided
	 */
	if( empty( $color ) ) {
        return $default;
	}

	/**
	 * Sanitize $color if "#" is provided
	 */
    if ( $color[0] == '#' ) {
    	$color = substr( $color, 1 );
    }

    /**
     * Check if color has 6 or 3 characters and get values
     */
    if ( strlen($color) == 6 ) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    /**
     * [$rgb description]
     * @var array
     */
    $rgb =  array_map( 'hexdec', $hex );

    /**
     * Check if opacity is set(rgba or rgb)
     */
    if( $opacity ) {
    	if( abs( $opacity ) > 1 )
    	$opacity = 1.0;
    	$output = 'rgba( ' . implode( "," ,$rgb ) . ',' . $opacity . ' )';
    } else {
    	$output = 'rgb( ' . implode( "," , $rgb ) . ' )';
    }

    /**
     * Return rgb(a) color string
     */
    return $output;
}

/**
 * rgb to hex
 *
 * @param $red
 * @param $green
 * @param $blue
 *
 * @return string
 */
function rgb2hex( $R, $G, $B ) {
	$color = sprintf("#%02x%02x%02x", $R, $G, $B);
	return $color;
}

/**
 * hex to rgb
 *
 * @param $hexStr
 * @param bool $returnAsString
 * @param string $seperator
 *
 * @return array|bool|string
 */
function hex_2_RGB( $hexStr, $returnAsString = false, $seperator = ',' ) {
	$hexStr   = preg_replace( "/[^0-9A-Fa-f]/", '', $hexStr ); // Gets a proper hex string
	$rgbArray = array();
	if ( strlen( $hexStr ) == 6 ) { //If a proper hex code, convert using bitwise operation. No overhead... faster
		$colorVal          = hexdec( $hexStr );
		$rgbArray['red']   = 0xFF & ( $colorVal >> 0x10 );
		$rgbArray['green'] = 0xFF & ( $colorVal >> 0x8 );
		$rgbArray['blue']  = 0xFF & $colorVal;
	} elseif ( strlen( $hexStr ) == 3 ) { //if shorthand notation, need some string manipulations
		$rgbArray['red']   = hexdec( str_repeat( substr( $hexStr, 0, 1 ), 2 ) );
		$rgbArray['green'] = hexdec( str_repeat( substr( $hexStr, 1, 1 ), 2 ) );
		$rgbArray['blue']  = hexdec( str_repeat( substr( $hexStr, 2, 1 ), 2 ) );
	} else {
		return false; //Invalid hex color code
	}

	return $returnAsString ? implode( $seperator, $rgbArray ) : $rgbArray; // returns the rgb string or the associative array
}

/**
 * rgb to hsv
 *
 * @param $R
 * @param $G
 * @param $B
 *
 * @return array
 */
function RGB_2_HSV( $R, $G, $B )  // RGB Values:Number 0-255
{                                 // HSV Results:Number 0-1
	$HSL = array();

	$var_R = ( $R / 255 );
	$var_G = ( $G / 255 );
	$var_B = ( $B / 255 );

	$var_Min = min( $var_R, $var_G, $var_B );
	$var_Max = max( $var_R, $var_G, $var_B );
	$del_Max = $var_Max - $var_Min;

	$V = $var_Max;

	if ( $del_Max == 0 ) {
		$H = 0;
		$S = 0;
	} else {
		$S = $del_Max / $var_Max;

		$del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		$del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		$del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;

		if ( $var_R == $var_Max ) {
			$H = $del_B - $del_G;
		} else if ( $var_G == $var_Max ) {
			$H = ( 1 / 3 ) + $del_R - $del_B;
		} else if ( $var_B == $var_Max ) {
			$H = ( 2 / 3 ) + $del_G - $del_R;
		}

		if ( $H < 0 ) {
			$H ++;
		}
		if ( $H > 1 ) {
			$H --;
		}
	}

	$HSL['H'] = round( $H * 360 );
	$HSL['S'] = round( $S * 100 );
	$HSL['V'] = round( $V * 100 );

	return $HSL;
}

/**
 * hsv tp rgb
 *
 * @param array $hsv
 *
 * @return array
 */
function HSV_2_RGB( $hsv ) {
	$iH = $hsv['H'];
	$iS = $hsv['S'];
	$iV = $hsv['V'];


	if($iH < 0)   $iH = 0;   // Hue:
	if($iH > 360) $iH = 360; //   0-360
	if($iS < 0)   $iS = 0;   // Saturation:
	if($iS > 100) $iS = 100; //   0-100
	if($iV < 0)   $iV = 0;   // Lightness:
	if($iV > 100) $iV = 100; //   0-100
	$dS = $iS/100.0; // Saturation: 0.0-1.0
	$dV = $iV/100.0; // Lightness:  0.0-1.0
	$dC = $dV*$dS;   // Chroma:     0.0-1.0
	$dH = $iH/60.0;  // H-Prime:    0.0-6.0
	$dT = $dH;       // Temp variable
	while($dT >= 2.0) $dT -= 2.0; // php modulus does not work with float
	$dX = $dC*(1-abs($dT-1));     // as used in the Wikipedia link
	switch(floor($dH)) {
		case 0:
			$dR = $dC; $dG = $dX; $dB = 0.0; break;
		case 1:
			$dR = $dX; $dG = $dC; $dB = 0.0; break;
		case 2:
			$dR = 0.0; $dG = $dC; $dB = $dX; break;
		case 3:
			$dR = 0.0; $dG = $dX; $dB = $dC; break;
		case 4:
			$dR = $dX; $dG = 0.0; $dB = $dC; break;
		case 5:
			$dR = $dC; $dG = 0.0; $dB = $dX; break;
		default:
			$dR = 0.0; $dG = 0.0; $dB = 0.0; break;
	}
	$dM  = $dV - $dC;
	$dR += $dM; $dG += $dM; $dB += $dM;
	$dR *= 255; $dG *= 255; $dB *= 255;
	return array( round( $dR ), round( $dG ), round( $dB ) );
}

/**
 * Function which will return the member id if $id > 0 then it will return the original displayed id
 * else it will return the member loop member id.
 *
 * @param $id
 *
 * @return integer
 */
function buddyboss_theme_member_loop_set_member_id ( $id ) {

	if ( $id > 0 ) {

		// This will fix the issues in theme members directory page & members connections tab send message issue.
		if ( is_user_logged_in() && bp_loggedin_user_id() === $id ) {
			if ( 'my-friends' === bp_current_action() && 'friends' === bp_current_component() ) {
				// This will fix the issues in theme members directory page & members connections tab send message issue.
				return bp_get_member_user_id();
			} elseif ( 'requests' === bp_current_action() && 'friends' === bp_current_component() ) {
				// This will fix the issues in theme members directory page & members connections tab send message issue.
				return bp_get_member_user_id();
			} else {
				return $id;
			}
		} else {
			return $id;
		}

	}

	// This will fix the issues in theme members directory page & members connections tab send message issue.
	return bp_get_member_user_id();
}

/**
 * Function which will return the false in even if user is in h/her own profile page in connections members listing.
 *
 * @param $my_profile
 *
 * @return bool
 */
function buddyboss_theme_member_loop_set_my_profile( $my_profile ) {

	if ( 'my-friends' === bp_current_action() && 'friends' === bp_current_component() ) {
		if ( $my_profile && bp_loggedin_user_id() === bp_displayed_user_id() ) {
			return false;
		}
	}
	if ( 'requests' === bp_current_action() && 'friends' === bp_current_component() ) {
		if ( $my_profile && bp_loggedin_user_id() === bp_displayed_user_id() ) {
			return false;
		}
	}
	return $my_profile;
}

/**
 * Update search input placeholder text
 */
if ( ! function_exists( 'buddyboss_search_input_placeholder_text' ) ) {
	function buddyboss_search_input_placeholder_text( $string ) {

		if ( function_exists( 'bp_is_search_autocomplete_enable' ) ) {
			if ( bp_is_active( 'search' ) && bp_is_search_autocomplete_enable() ) {
				$string = __( 'Start typing to search...', 'buddyboss-theme' );
			}
		}

		return $string;
	}
}

/**
 * Add option to stick BuddyPanel menus to bottom of menu
 */
if ( ! function_exists( 'buddyboss_theme_add_stick_to_bottom_field' ) ) {

	function buddyboss_theme_add_stick_to_bottom_field( $menu_item ) {
		$menu_item->stick_to_bottom = get_post_meta( $menu_item->ID, '_menu_item_stick_to_bottom', true );
		return $menu_item;
	}

	// add stick to bottom field to BuddyPanel menu
	add_filter( 'wp_setup_nav_menu_item', 'buddyboss_theme_add_stick_to_bottom_field' );
}

if ( ! function_exists( 'buddyboss_theme_update_stick_to_bottom_field' ) ) {

	function buddyboss_theme_update_stick_to_bottom_field( $menu_id, $menu_item_db_id, $args ) {
		// Check if element is properly sent
		if ( isset( $_REQUEST['menu-item-stick-to-bottom'][$menu_item_db_id]) ) {
			$subtitle_value = $_REQUEST['menu-item-stick-to-bottom'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_stick_to_bottom', $subtitle_value );
		} else {
			update_post_meta( $menu_item_db_id, '_menu_item_stick_to_bottom', '' );
        }
	}

	// save menu custom fields
	add_action( 'wp_update_nav_menu_item', 'buddyboss_theme_update_stick_to_bottom_field', 10, 3 );
}

if ( ! function_exists( 'buddyboss_theme_stick_to_bottom_field_walker' ) ) {

	function buddyboss_theme_stick_to_bottom_field_walker( $id, $item, $depth, $args ) {
		?>
		<div class="field-stick_to_bottom description-wide" data-id="<?php echo json_encode( $item->ID ); ?>">
			<p class="field-stick-to-bottom description">
                <label for="edit-menu-item-stick-to-bottom-<?php echo $item->ID; ?>">
                    <input type="checkbox" id="edit-menu-item-stick-to-bottom-<?php echo $item->ID; ?>" class="widefat code edit-menu-item-stick-to-bottom" name="menu-item-stick-to-bottom[<?php echo $item->ID; ?>]" <?php checked( $item->stick_to_bottom, '1' ); ?> value="1" />
	                <?php _e( 'Stick to Bottom', 'buddyboss-theme' ); ?>
                </label>
			</p>
		</div>
		<?php
	}

	add_action( 'wp_nav_menu_item_custom_fields', 'buddyboss_theme_stick_to_bottom_field_walker', 10, 4 );
}

if ( ! function_exists( 'buddyboss_theme_hide_stick_to_bottom_field' ) ) {

    function buddyboss_theme_hide_stick_to_bottom_field() {
        global $pagenow;

        if ( ! is_admin() || 'nav-menus.php' != $pagenow ) {
            return false;
        }

        ?>
        <script type="application/javascript">
            jQuery(document).ready(function(){
                var buddypanel_loggedin = jQuery('.menu-settings input[name="menu-locations[buddypanel-loggedin]"]:checked');
                var buddypanel_loggedout = jQuery('.menu-settings input[name="menu-locations[buddypanel-loggedout]"]:checked');

                if ( buddypanel_loggedin.length == 0 && buddypanel_loggedout.length == 0 ) {
                    jQuery('.field-stick_to_bottom').hide();
                }

            });
        </script>
        <?php
    }

	add_action( 'admin_print_footer_scripts', 'buddyboss_theme_hide_stick_to_bottom_field' );
}

if ( ! function_exists( 'buddyboss_theme_remove_filters_for_anonymous_class' ) ) {

	/**
     * Remove hook and filter from the class
     *
     * @since BuddyBoss Theme 1.1.6
     *
	 * @param $tag
	 * @param $class
	 * @param $method
	 */
	function buddyboss_theme_remove_filters_for_anonymous_class( $tag, $class, $method ) {
		$filters = $GLOBALS['wp_filter'][ $tag ];

		if ( empty ( $filters ) ) {
			return;
		}

		foreach ( $filters as $priority => $filter ) {
			foreach ( $filter as $identifier => $function ) {
				if ( is_array( $function )
				     and is_a( $function['function'][0], $class )
				         and $method === $function['function'][1]
				) {
					remove_filter(
						$tag,
						array( $function['function'][0], $method ),
						$priority
					);
				}
			}
		}
	}
}