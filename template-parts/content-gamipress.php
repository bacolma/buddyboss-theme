<?php
/**
 * Template part for displaying posts
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

	<div class="entry-content-wrap">
		<?php 
		if ( has_post_format( 'link' ) && ( !is_singular() || is_related_posts() ) ) {
			echo '<span class="post-format-icon"><i class="bb-icon-link-1"></i></span>';
		}

		if ( has_post_format( 'quote' ) && ( !is_singular() || is_related_posts() ) ) {
			echo '<span class="post-format-icon white"><i class="bb-icon-quote"></i></span>';
		}
		?>

		<header class="entry-header">
			<?php
			if ( is_singular() && ! is_related_posts() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				$prefix = "";
				if( has_post_format( 'link' ) ){
					$prefix = __( '[Link]', 'buddyboss-theme' );
					$prefix .= " ";//whitespace
				}
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $prefix, '</a></h2>' );
			endif;
			?>

			<?php if( has_post_format( 'link' ) && function_exists( 'buddyboss_theme_get_first_url_content' ) && ( $first_url = buddyboss_theme_get_first_url_content( $post->post_content ) ) != "" ):?>
			<p class="post-main-link"><?php echo $first_url;?></p>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( !is_singular() || is_related_posts() ) { ?>
			<div class="entry-content">
				<?php 
				if( empty($post->post_excerpt) ) {
					the_excerpt();
				} else {
					echo bb_get_excerpt($post->post_excerpt, 150);
				}
				?>
			</div>
		<?php } ?>

		<?php if ( is_single() && ! is_related_posts() ) { ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<figure class="entry-media entry-img bb-vw-container1">
					<?php the_post_thumbnail( 'large' ); ?>
				</figure>
			<?php } ?>
		<?php } ?>

		<?php if ( is_singular() && ! is_related_posts() ) { ?>
			<div class="entry-content">
			<?php
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
			?>
			</div><!-- .entry-content -->
		<?php } ?>
	</div>

	<?php if ( !is_single() || is_related_posts() ) { ?>
		</div><!--Close '.post-inner-wrap'-->
	<?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->