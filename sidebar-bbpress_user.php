<?php
/**
 * The sidebar containing the bbPress user profile widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */

?>

<!-- if there are widgets in the Forums sidebar -->
<?php if ( is_active_sidebar( 'bbpress_user_profile' ) ) : ?>

	<div id="secondary" class="widget-area bbpress-widget-area-sidebar" role="complementary">
		<?php dynamic_sidebar( 'bbpress_user_profile' ); ?>
	</div><!-- #secondary -->

<?php endif; ?>
