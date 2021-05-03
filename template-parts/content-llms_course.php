<?php
/**
 * Template part for displaying courses
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

	<?php if ( !is_single() || is_related_posts() ) { ?>
	<div class="post-inner-wrap">
		<?php } ?>

		<?php
		if ( ( !is_single() || is_related_posts() ) && function_exists( 'buddyboss_theme_entry_header' ) ) {
			buddyboss_theme_entry_header( $post );
		}
		?>

		<div class="llms-course-entry-content-wrap">

			<?php if ( !is_singular() || is_related_posts() ) { ?>
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
			<?php } ?>

			<?php if ( is_single() && ! is_related_posts() ) { ?>
				<div class="bb-vw-container bb-llms-banner">

					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'large', array('class' => 'banner-img') );
					} ?>

					<div class="bb-course-banner-info container">
						<div class="bb-course-banner-inner">

							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

							<?php if( buddyboss_theme_get_option('learndash_course_author') ) { ?>
							<div class="bb-course-single-meta flex align-items-center">
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
									<span class="author-name"><?php the_author(); ?></span>
								</a>

								<span class="meta-saperator">&middot;</span>

								<span class="course-date"><?php echo get_the_date(); ?></span>
							</div>
							<?php } ?>

						</div>
					</div>
				</div>
			<?php } ?>

			<div class="bb-grid">
				<div class="bb-llms-content-wrap">
					<?php
					if ( is_singular() && ! is_related_posts() ) {
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
					}
					?>
				</div>
			</div>
		</div>

		<?php if ( !is_single() || is_related_posts() ) { ?>
	</div><!--Close '.post-inner-wrap'-->
<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->
