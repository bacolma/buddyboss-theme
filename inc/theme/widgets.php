<?php

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Boss_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops				 = array(
			'classname'						 => 'bb_widget_recent_posts',
			'description'					 => __( 'Your site\'s most recent Posts. Option to display post featured image.', 'buddyboss-theme' ),
			'customize_selective_refresh'	 => true,
		);
		parent::__construct( 'boss-recent-posts', __( '(BB) Recent Posts', 'buddyboss-theme' ), $widget_ops );
		$this->alt_option_name	 = 'bb_widget_recent_posts';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( !isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		$title = (!empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : __( 'Recent Posts', 'buddyboss-theme' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number		 = (!empty( $instance[ 'number' ] ) ) ? absint( $instance[ 'number' ] ) : 5;
		if ( !$number )
			$number		 = 5;
		$show_date	 = isset( $instance[ 'show_date' ] ) ? $instance[ 'show_date' ] : false;
        $show_image	 = isset( $instance[ 'show_image' ] ) ? $instance[ 'show_image' ] : true;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'		 => $number,
			'no_found_rows'			 => true,
			'post_status'			 => 'publish',
			'ignore_sticky_posts'	 => true
		) ) );

		if ( $r->have_posts() ) :
			?>
			<?php echo $args[ 'before_widget' ]; ?>
			<?php
			if ( $title ) {
				echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
			}
			?>
			<ul class="bb-recent-posts">
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li>
						<?php if ( $show_image && has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'buddyboss-theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="entry-media entry-img">
								<?php the_post_thumbnail(); ?>
							</a>
                        <?php } ?>
						<div class="">
							<h4><a href="<?php the_permalink(); ?>" class="bb-title"><?php echo wp_trim_words( the_title( '', '', false ), 6, '&hellip;' ); ?></a></h4>
							<?php if ( $show_date ) : ?>
								<span class="post-date"><?php echo get_the_date(); ?></span>
							<?php endif; ?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $args[ 'after_widget' ]; ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance				 = $old_instance;
		$instance[ 'title' ]	 = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'number' ]	 = (int) $new_instance[ 'number' ];
		$instance[ 'show_date' ] = isset( $new_instance[ 'show_date' ] ) ? (bool) $new_instance[ 'show_date' ] : false;
        $instance[ 'show_image' ] = isset( $new_instance[ 'show_image' ] ) ? (bool) $new_instance[ 'show_image' ] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title		 = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$number		 = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 5;
		$show_date	 = isset( $instance[ 'show_date' ] ) ? (bool) $instance[ 'show_date' ] : false;
        $show_image	 = isset( $instance[ 'show_image' ] ) ? (bool) $instance[ 'show_image' ] : true;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'buddyboss-theme' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'buddyboss-theme' ); ?></label></p>
            
        <p><input class="checkbox" type="checkbox"<?php checked( $show_image ); ?> id="<?php echo $this->get_field_id( 'show_image' ); ?>" name="<?php echo $this->get_field_name( 'show_image' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e( 'Display post featured image?', 'buddyboss-theme' ); ?></label></p>
		<?php
	}

}

/**
 * Core class used to implement a Follow us widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Boss_Follow_Us extends WP_Widget {

	/**
	 * Sets up a new Follow Us widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops				 = array(
			'classname'						 => 'widget_follow_us',
			'description'					 => __( 'Follow Us Links', 'buddyboss-theme' ),
			'customize_selective_refresh'	 => true,
		);
		parent::__construct( 'boss-follow-us', __( '(BB) Follow Us', 'buddyboss-theme' ), $widget_ops );
		$this->alt_option_name	 = 'widget_follow_us';
	}

	/**
	 * Outputs the content for the current Follow Us widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Follow Us widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( !isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		$title = (!empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : __( 'Follow', 'buddyboss-theme' );

		// Social Links
		$facebook	 = (!empty( $instance[ 'facebook' ] ) ) ? $instance[ 'facebook' ] : '';
		$twitter	 = (!empty( $instance[ 'twitter' ] ) ) ? $instance[ 'twitter' ] : '';
		$google		 = (!empty( $instance[ 'google' ] ) ) ? $instance[ 'google' ] : '';
		$youtube	 = (!empty( $instance[ 'youtube' ] ) ) ? $instance[ 'youtube' ] : '';
		$instagram	 = (!empty( $instance[ 'instagram' ] ) ) ? $instance[ 'instagram' ] : '';
		$linkedin	 = (!empty( $instance[ 'linkedin' ] ) ) ? $instance[ 'linkedin' ] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args[ 'before_widget' ];

		if ( $title ) {
			echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
		}

		echo '<div class="bb-follow-links">';

		if ( !empty( $facebook ) ) {
			echo '<a href="' . $facebook . '" target="_blank"><i class="bb-icon-rounded-facebook"></i></a>';
		}

		if ( !empty( $twitter ) ) {
			echo '<a href="' . $twitter . '" target="_blank"><i class="bb-icon-rounded-twitter"></i></a>';
		}

		if ( !empty( $google ) ) {
			echo '<a href="' . $google . '" target="_blank"><i class="bb-icon-rounded-google-plus"></i></a>';
		}

		if ( !empty( $youtube ) ) {
			echo '<a href="' . $youtube . '" target="_blank"><i class="bb-icon-youtube-logo"></i></a>';
		}

		if ( !empty( $instagram ) ) {
			echo '<a href="' . $instagram . '" target="_blank"><i class="bb-icon-rounded-instagram"></i></a>';
		}

		if ( !empty( $linkedin ) ) {
			echo '<a href="' . $linkedin . '" target="_blank"><i class="bb-icon-rounded-linkedin"></i></a>';
		}

		echo '</div>';

		echo $args[ 'after_widget' ];
	}

	/**
	 * Handles updating the settings for the current Follow Us widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance				 = $old_instance;
		$instance[ 'title' ]	 = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'facebook' ]	 = esc_url_raw( $new_instance[ 'facebook' ] );
		$instance[ 'twitter' ]	 = esc_url_raw( $new_instance[ 'twitter' ] );
		$instance[ 'google' ]	 = esc_url_raw( $new_instance[ 'google' ] );
		$instance[ 'youtube' ]	 = esc_url_raw( $new_instance[ 'youtube' ] );
		$instance[ 'instagram' ] = esc_url_raw( $new_instance[ 'instagram' ] );
		$instance[ 'linkedin' ]  = esc_url_raw( $new_instance[ 'linkedin' ] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Follow Us widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title		 = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$facebook	 = isset( $instance[ 'facebook' ] ) ? esc_url( $instance[ 'facebook' ] ) : '';
		$twitter	 = isset( $instance[ 'twitter' ] ) ? esc_url( $instance[ 'twitter' ] ) : '';
		$google		 = isset( $instance[ 'google' ] ) ? esc_url( $instance[ 'google' ] ) : '';
		$youtube	 = isset( $instance[ 'youtube' ] ) ? esc_url( $instance[ 'youtube' ] ) : '';
		$instagram	 = isset( $instance[ 'instagram' ] ) ? esc_url( $instance[ 'instagram' ] ) : '';
		$linkedin	 = isset( $instance[ 'linkedin' ] ) ? esc_url( $instance[ 'linkedin' ] ) : '';
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook Link:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="url" value="<?php echo $facebook; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter Link:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="url" value="<?php echo $twitter; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e( 'Google Link:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" type="url" value="<?php echo $google; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube Link:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="url" value="<?php echo $youtube; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram Link:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="url" value="<?php echo $instagram; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'LinkedIn Link:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="url" value="<?php echo $linkedin; ?>" /></p>
		<?php
	}

}

/**
 * Core class used to implement a Post Author widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Boss_Post_Author extends WP_Widget {

	/**
	 * Sets up a new Post Author widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops				 = array(
			'classname'						 => 'widget_post_author',
			'description'					 => __( 'Post author widget, only visible on single post.', 'buddyboss-theme' ),
			'customize_selective_refresh'	 => true,
		);
		parent::__construct( 'boss-post-author', __( '(BB) Post Author', 'buddyboss-theme' ), $widget_ops );
		$this->alt_option_name	 = 'widget_post_author';
	}

	/**
	 * Outputs the content for the Post Author widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Post Author widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( !isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		$title = (!empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : __( 'About Author', 'buddyboss-theme' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		if ( is_single() ) :

			echo $args[ 'before_widget' ];

			if ( $title ) {
				echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
			}
			?>
			<div class="post-author-box">
				<div class="post-author-head">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
						<span class="post-author"><?php the_author(); ?></span>
					</a>
				</div>
				<div class="author-desc-wrap">
					<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
				</div>
				<div class="social-networks-wrap">
					<?php echo bp_get_user_social_networks_urls( get_the_author_meta( 'ID' ) ); ?>
				</div>
			</div>
			<?php
			echo $args[ 'after_widget' ];

		endif;
	}

	/**
	 * Handles updating the settings for the current Post Author widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance			 = $old_instance;
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Post Author widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$profile_setting_page = admin_url('admin.php?page=bp-profile-setup');
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'buddyboss-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<?php echo sprintf( __( 'To display social links in this widget, go to <a href="%s">Profile Fields</a> and add the "Social Networks" profile field. This widget will then display the social networks added to the post author\'s profile.', 'buddyboss-theme' ), $profile_setting_page) ?>
		</p>
		<?php
	}

}

/**
 * Registers all Custom Widgets
 */
function buddyboss_theme_custom_register_widgets() {
	
	register_widget( 'Boss_Widget_Recent_Posts' );
	register_widget( 'Boss_Follow_Us' );
	register_widget( 'Boss_Post_Author' );
	
}

add_action( 'widgets_init', 'buddyboss_theme_custom_register_widgets' );
