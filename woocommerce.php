<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();
?>

<?php 
    if ( is_active_sidebar( 'woo_sidebar' ) ) { 
        $wc_side_bar = "has-wc-sidebar";
    } else {
        $wc_side_bar = "no-wc-sidebar";
    }
?>

<div id="primary" class="content-area bb-grid-cell <?php echo $wc_side_bar; ?>">
	<main id="main" class="site-main">

        <?php
        do_action( 'woocommerce_before_main_content' );
        
        woocommerce_content();

        do_action( 'woocommerce_after_main_content' );
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar( 'woocommerce' ); ?>

<?php
get_footer();
