<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package BuddyBoss_Theme
 */

get_header();

$blog_type = 'standard'; // standard, grid, masonry.
$class = 'bb-standard';
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
				<?php
					/* translators: %s: search query. */
					printf( esc_html__( "Showing results for '%s'", 'buddyboss-theme' ), '<span>' . get_search_query() . '</span>' );
					?>
					</h1>
			</header><!-- .page-header -->

			<div class="post-grid <?php echo esc_attr( $class ); ?>">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', apply_filters( 'bb_blog_content', get_post_format() ) );

				endwhile;
				?>
			</div>

			<?php
			buddyboss_pagination();

		else :
			get_template_part( 'template-parts/content', 'none' );
			?>

		<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar('search'); ?>

<?php
get_footer();
