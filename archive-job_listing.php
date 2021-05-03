<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
                <div class="flex">
                    <?php echo '<h1 class="page-title">' . str_replace('Archives: ','',get_the_archive_title()) . '</h1>'; ?>
                </div>
			</header><!-- .page-header -->

            <?php echo do_shortcode( '[jobs]' ); ?>

            <?php
		else :
			get_template_part( 'template-parts/content', 'none' );
			?>

		<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php
get_footer();
