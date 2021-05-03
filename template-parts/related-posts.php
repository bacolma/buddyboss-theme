<?php
$related_posts = buddyboss_theme_get_option( 'blog_related_switch' );
?>

<?php if ( is_singular('post') && ! is_related_posts() && !empty( $related_posts ) ) : ?>
	<?php $posts_array = buddyboss_theme()->related_posts_helper()->get_related_posts(); ?>
	<?php if ( is_array( $posts_array ) && count( $posts_array ) > 0 ): ?>
	<div class="post-related-posts">
        <h4><?php _e( 'Related Articles', 'buddyboss-theme' ); ?></h4>
        <div class="post-grid bb-grid">
            <?php
            global $post, $is_related_posts;


            $posts_array = wp_list_pluck( $posts_array, 'ID' );
            $args = array(
                'post_type' => 'post',
                'post__in' => $posts_array,
                'post__not_in' => array( $post->ID ),
                'orderby' => 'post__in',
                'order' => 'ASC',
                'ignore_sticky_posts' => true,
            );
            $post_query = new WP_Query( $args );
            $is_related_posts = true;
            // The Loop
            if ( $post_query->have_posts() ) {
                while ( $post_query->have_posts() ) {
                    $post_query->the_post();
                    get_template_part( 'template-parts/content', 'related-posts' );
                }
                /* Restore original Post Data */
                wp_reset_postdata();
            }
            $is_related_posts = false;
            ?>
        </div>
	</div><!--.post-related-posts-->
	<?php endif; ?>
<?php endif; ?>
