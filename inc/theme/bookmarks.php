<?php 
// Bookmarks Shortcode
if ( !function_exists( 'buddyboss_theme_bookmark_posts' ) ) {

	function buddyboss_theme_bookmark_posts() {
		$blog_type	 = 'standard'; // standard, grid, masonry
		$blog_type	 = apply_filters( 'bb_blog_type', $blog_type );

		$class = '';

		if ( 'masonry' === $blog_type ) {
			$class = 'bb-masonry';
		} elseif ( 'grid' === $blog_type ) {
			$class = 'bb-grid';
		} else {
			$class = 'bb-standard';
		}

		echo '<div class="post-grid ' . $class . '">';

		if ( 'masonry' === $blog_type ) {
			echo '<div class="bb-masonry-sizer"></div>';
		}

		get_template_part( 'template-parts/bookmarks-shortcode' );

		echo '</div>';
	}

	add_shortcode( 'bookmarks', 'buddyboss_theme_bookmark_posts' );
}
