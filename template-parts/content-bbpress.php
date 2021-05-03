<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	$class = '';
	if( bbp_is_single_forum() && bbp_has_forums() ) {
		$class = 'has-subforums';
	}
	?>

	<?php if ( bbp_is_single_forum() ) : ?>
		<header class="entry-header bb-single-forum <?php echo $class; ?>">
			<h1 class="entry-title"><?php bbp_forum_title(); ?></h1>
		</header> <!--.entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buddyboss-theme' ),
			'after'	 => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
			sprintf(
			wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
			__( 'Edit <span class="screen-reader-text">%s</span>', 'buddyboss-theme' ), array(
				'span' => array(
					'class' => array(),
				),
			)
			), get_the_title()
			), '<span class="edit-link">', '</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article>
