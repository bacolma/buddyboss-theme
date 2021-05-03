<?php 
$related_posts = buddyboss_theme_get_option( 'blog_related_switch' );
?>

<?php if ( is_single() && ! is_related_posts() && !empty( $related_posts ) ) : ?>
	<div class="post-related-jobs">
        <h4><?php _e( 'Related Jobs', 'buddyboss-theme' ); ?></h4>
		<?php
		global $post, $is_related_posts;

		$posts_array = buddyboss_theme()->related_posts_helper()->get_related_posts();
		$posts_array = wp_list_pluck( $posts_array, 'ID' );

		$args = array(
			'post_type' => 'job_listing',
			'post__in' => $posts_array,
			'post__not_in' => array( $post->ID ),
			'orderby' => 'post__in',
			'order' => 'ASC',
			'ignore_sticky_posts' => true,
		);

		$post_query = new WP_Query( $args );
		$is_related_posts = true;

		// The Loop
		if ( $post_query->have_posts() ) { ?>
			<ul class="job_listings job_listings_grid">
			<?php
				while ( $post_query->have_posts() ) {
					$post_query->the_post();
					get_template_part( 'template-parts/content', 'job_related' );
				}
				/* Restore original Post Data */
				wp_reset_postdata(); ?>
			</ul><?php
		}

		$is_related_posts = false;
		?>
	</div>
<?php endif; ?>
