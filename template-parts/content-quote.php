<?php
/**
 * Template part for displaying quote content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */
?>

<?php
global $post;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( !is_single() ) { ?>
		<div class="post-inner-wrap">
		<?php } ?>

		<div class="entry-content-wrap">

			<?php
			if ( !is_singular() ) {
				echo '<span class="post-format-icon white"><i class="bb-icon-quote"></i></span>';
			}
			?>

			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				endif;
				?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				if ( is_singular() ) {
					the_content( sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'buddyboss-theme' ), array(
						'span' => array(
							'class' => array(),
						),
					)
					), get_the_title()
					) );
				} else {
					if ( function_exists( 'the_exceprt_quote' ) ) {
						the_exceprt_quote();
					} else {
						the_excerpt();
					}
				}
				?>
			</div><!-- .entry-content -->
		</div>

		<?php if ( !is_single() ) { ?>
		</div><!--Close '.post-inner-wrap'-->
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
//get_template_part( 'template-parts/author-box' );
