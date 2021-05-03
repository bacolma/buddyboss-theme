<?php
/**
 * The sidebar containing the LearnDash widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */

?>

<?php if ( is_active_sidebar( 'learndash_sidebar' ) ) : ?>
    <div id="secondary" class="widget-area sm-grid-1-1" role="complementary">
        <?php dynamic_sidebar( 'learndash_sidebar' ); ?>
	</div>
<?php endif; ?>
