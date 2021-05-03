<?php
/**
 * The sidebar containing the WooCommerce widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */

?>

<?php if ( is_active_sidebar( 'woo_sidebar' ) ) : ?>
    <div id="secondary" class="widget-area sm-grid-1-1 wc-widget-area">
        <div class="wc-widget-area-expandable">
    	   <?php dynamic_sidebar( 'woo_sidebar' ); ?>
        </div>
    </div><!-- #secondary -->
<?php endif; ?>
