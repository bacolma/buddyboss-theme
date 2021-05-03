<?php
/**
 * The sidebar containing the search widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */

if ( !is_active_sidebar( 'search' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area sm-grid-1-1">
	<?php dynamic_sidebar( 'search' ); ?>
</div>