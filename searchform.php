<?php
/**
 * The template for displaying search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package BuddyBoss_Theme
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'buddyboss-theme' ); ?></span>
		<input type="search" class="search-field-top" placeholder="<?php echo esc_attr( apply_filters( 'search_placeholder', __( 'Search', 'buddyboss-theme' ) ) ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_e( 'Search', 'buddyboss-theme' ); ?>" />
</form>
