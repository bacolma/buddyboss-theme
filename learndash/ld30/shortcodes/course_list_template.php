<?php
/**
 * Template part for displaying LearnDash Course Grid [ld_course_list]
 *
 * @link https://www.learndash.com/add-on/course-grid/
 *
 * @package BuddyBoss_Theme
 */
?>

<?php

if ( function_exists( 'is_plugin_active' ) && is_plugin_active('learndash-course-grid/learndash_course_grid.php') && isset( $shortcode_atts['course_grid'] ) && '' !== $shortcode_atts['course_grid'] ) {

	$col   = empty( $shortcode_atts['col'] ) ? LEARNDASH_COURSE_GRID_COLUMNS :intval( $shortcode_atts['col'] );
	$col   = $col > 6 ? 6 : $col;
	$smcol = $col == 1 ? 1 : $col / 2;
	$col   = 12 / $col;
	$smcol = intval( ceil( 12 / $smcol ) );
	$col   = is_float( $col ) ? number_format( $col, 1 ) : $col;
	$col   = str_replace( '.', '-', $col );

	global $post; $post_id = $post->ID;

	$course_id = $post_id;
	$user_id   = get_current_user_id();

	$cg_short_description = get_post_meta( $post->ID, '_learndash_course_grid_short_description', true );
	$enable_video = get_post_meta( $post->ID, '_learndash_course_grid_enable_video_preview', true );
	$button_text  = get_post_meta( $post->ID, '_learndash_course_grid_custom_button_text', true );

	if ( isset( $shortcode_atts['course_id'] ) ) {
		$button_link = learndash_get_step_permalink( get_the_ID(), $shortcode_atts['course_id'] );
	} else {
		$button_link = get_permalink();
	}

	$button_link = apply_filters( 'learndash_course_grid_custom_button_link', $button_link, $post_id );

	$button_text = isset( $button_text ) && ! empty( $button_text ) ? $button_text : __( 'See more...', 'buddyboss-theme' );
	$button_text = apply_filters( 'learndash_course_grid_custom_button_text', $button_text, $post_id );

	$options = get_option( 'sfwd_cpt_options' );
	$currency_setting = class_exists( 'LearnDash_Settings_Section' ) ? LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Section_PayPal', 'paypal_currency' ) : null;
	$currency = '';

	if ( isset( $currency_setting ) || ! empty( $currency_setting ) ) {
		$currency = $currency_setting;
	} elseif ( isset( $options['modules'] ) && isset( $options['modules']['sfwd-courses_options'] ) && isset( $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'] ) ) {
		$currency = $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'];
	}

	if ( class_exists( 'NumberFormatter' ) ) {
		$locale = get_locale();
		$number_format = new NumberFormatter( $locale . '@currency=' . $currency, NumberFormatter::CURRENCY );
		$currency = $number_format->getSymbol( NumberFormatter::CURRENCY_SYMBOL );
	}

	/**
	 * Currency symbol filter hook
	 *
	 * @param string $currency Currency symbol
	 * @param int    $course_id
	 */
	$currency = apply_filters( 'learndash_course_grid_currency', $currency, $course_id );

	$course_options = get_post_meta($post_id, "_sfwd-courses", true);
	$price = $course_options && isset($course_options['sfwd-courses_course_price']) ? $course_options['sfwd-courses_course_price'] : __( 'Free', 'buddyboss-theme' );
	$price_type = $course_options && isset( $course_options['sfwd-courses_course_price_type'] ) ? $course_options['sfwd-courses_course_price_type'] : '';
	if ( ! empty( $cg_short_description ) ) {
		$short_description = $cg_short_description;
	} else {
		$short_description = isset( $course_options['sfwd-courses_course_short_description'] ) ? $course_options['sfwd-courses_course_short_description'] : '';
	}

	/**
	 * Filter: individual grid class
	 *
	 * @param int 	$course_id Course ID
	 * @param array $course_options Course options
	 * @var string
	 */
	$grid_class = apply_filters( 'learndash_course_grid_class', '', $course_id, $course_options );

	$has_access   = sfwd_lms_has_access( $course_id, $user_id );
	$is_completed = learndash_course_completed( $user_id, $course_id );

	$price_text = '';

	if ( is_numeric( $price ) && ! empty( $price ) ) {
		$price_format = apply_filters( 'learndash_course_grid_price_text_format', '{currency}{price}' );

		$price_text = str_replace(array( '{currency}', '{price}' ), array( $currency, $price ), $price_format );
	} elseif ( is_string( $price ) && ! empty( $price ) ) {
		$price_text = $price;
	} elseif ( empty( $price ) ) {
		$price_text = __( 'Free', 'buddyboss-theme' );
	}

	$class       = 'ld_course_grid_price';
	$ribbon_text = get_post_meta( $post->ID, '_learndash_course_grid_custom_ribbon_text', true );
	$ribbon_text = isset( $ribbon_text ) && ! empty( $ribbon_text ) ? $ribbon_text : '';

	if ( $has_access && ! $is_completed && $price_type != 'open' && empty( $ribbon_text ) ) {
		$class .= ' ribbon-enrolled';
		$ribbon_text = __( 'Enrolled', 'buddyboss-theme' );
	} elseif ( $has_access && $is_completed && $price_type != 'open' && empty( $ribbon_text ) ) {
		$class .= '';
		$ribbon_text = __( 'Completed', 'buddyboss-theme' );
	} elseif ( $price_type == 'open' && empty( $ribbon_text ) ) {
		if ( is_user_logged_in() && ! $is_completed ) {
			$class .= ' ribbon-enrolled';
			$ribbon_text = __( 'Enrolled', 'buddyboss-theme' );
		} elseif ( is_user_logged_in() && $is_completed ) {
			$class .= '';
			$ribbon_text = __( 'Completed', 'buddyboss-theme' );
		} else {
			$class .= ' ribbon-enrolled';
			$ribbon_text = '';
		}
	} elseif ( $price_type == 'closed' && empty( $price ) ) {
		$class .= ' ribbon-enrolled';

		if ( is_numeric( $price ) ) {
			$ribbon_text = $price_text;
		} else {
			$ribbon_text = '';
		}
	} else {
		if ( empty( $ribbon_text ) ) {
			$class .= ! empty( $course_options['sfwd-courses_course_price'] ) ? ' price_' . $currency : ' free';
			$ribbon_text = $price_text;
		} else {
			$class .= ' custom';
		}
	}

	/**
	 * Filter: individual course ribbon text
	 *
	 * @param string $ribbon_text Returned ribbon text
	 * @param int    $course_id   Course ID
	 * @param string $price_type  Course price type
	 */
	$ribbon_text = apply_filters( 'learndash_course_grid_ribbon_text', $ribbon_text, $course_id, $price_type );

	if ( '' == $ribbon_text ) {
		$class = '';
	}

	/**
	 * Filter: individual course ribbon class names
	 *
	 * @param string $class     	 Returned class names
	 * @param int    $course_id 	 Course ID
	 * @param array  $course_options Course's options
	 * @var string
	 */
	$class = apply_filters( 'learndash_course_grid_ribbon_class', $class, $course_id, $course_options );

	$thumb_size = isset( $shortcode_atts['thumb_size'] ) && ! empty( $shortcode_atts['thumb_size'] ) ? $shortcode_atts['thumb_size'] : 'course-thumb';


	/**
	 * Display class if course is paid, and content is enabled
	 */
	$course_price        = trim( learndash_get_course_meta_setting( get_the_ID(), 'course_price' ) );
	$course_price_type   = learndash_get_course_meta_setting( get_the_ID(), 'course_price_type' );

	/**
	 * Display class if content is disabled
	 */
	$class_price_type = '';
	if ( !empty( $course_price ) && ( $course_price_type == 'paynow' || $course_price_type == 'subscribe' || $course_price_type == 'closed' ) && ( $shortcode_atts['show_content'] == 'true' ) ) {
		$class_price_type = 'bb-course-paid';
	}

	/**
	 * Display class if course has content disabled
	 */
	$class_content_type = '';
	if ( $shortcode_atts['show_content'] != 'true' ) {
		$class_content_type = 'bb-course-no-content';
	}

	$course_pricing = learndash_get_course_price( get_the_ID() );

	$types_array 	= ['sfwd-lessons', 'sfwd-topic', 'sfwd-quiz', 'sfwd-assignment', 'sfwd-essays', 'sfwd-courses'];
    $post_type 		= get_post_type( get_the_ID() );
    $ribbon_title	= '';
    if( $post_type == 'sfwd-lessons' ){
    	$ribbon_title 	=	LearnDash_Custom_Label::get_label( 'lessons' );

    } else if( $post_type == 'sfwd-topic' ){
    	$ribbon_title 	=	LearnDash_Custom_Label::get_label( 'topic' );

    } else if( $post_type == 'sfwd-quiz' ){
    	$ribbon_title 	=	LearnDash_Custom_Label::get_label( 'quiz' );

    } else if( $post_type == 'sfwd-assignment' ){
    	$ribbon_title 	=	LearnDash_Custom_Label::get_label( 'assignment' );

    } else if( $post_type == 'sfwd-essays' ){
    	$ribbon_title 	=	LearnDash_Custom_Label::get_label( 'essays' );

    } else if( $post_type == 'sfwd-courses' ){
    	$ribbon_title 	=	LearnDash_Custom_Label::get_label( 'courses' );

    }
	?>
    <div class="ld_course_grid col-sm-<?php echo $smcol; ?> col-md-<?php echo $col; ?> <?php echo esc_attr( $grid_class ); ?> bb-course-item-wrap">

        <div class="bb-cover-list-item <?php echo $class_price_type; ?> <?php echo $class_content_type; ?>">
			<?php if ( $shortcode_atts['show_thumbnail'] == 'true' ) : ?>

                    <div class="bb-course-cover">
                        <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="bb-cover-wrap">
							<?php
							$progress = learndash_course_progress( array(
								'user_id'   => get_current_user_id(),
								'course_id' => get_the_ID(),
								'array'     => true
							) );

							$status = ( $progress['percentage'] == 100 ) ? 'completed' : 'notcompleted';

							if( $progress['percentage'] > 0 && $progress['percentage'] !== 100 ) {
								$status = 'progress';
							}

							if( is_user_logged_in() && isset($has_access) && $has_access ) {

								if ( ( $course_pricing['type'] === 'open' && $progress['percentage'] === 0 ) || ( $course_pricing['type'] !== 'open' && $has_access && $progress['percentage'] === 0 ) ) {

									echo '<div class="ld-status ld-status-progress ld-primary-background">' .sprintf( esc_html_x('Start %s ', 'Start ribbon', 'buddyboss-theme'), $ribbon_title ) . '</div>';

								} else {

									learndash_status_bubble($status);

								}

							} elseif ( $course_pricing['type'] == 'free' ) {

								echo '<div class="ld-status ld-status-incomplete ld-third-background">' . __( 'Free', 'buddyboss-theme' ) . '</div>';

							} elseif ( $course_pricing['type'] !== 'open' ) {

								echo '<div class="ld-status ld-status-incomplete ld-third-background">' . __( 'Not Enrolled', 'buddyboss-theme' ) . '</div>';

							} elseif ( $course_pricing['type'] === 'open' ) {

								echo '<div class="ld-status ld-status-progress ld-primary-background">' .
									__( 'Start ', 'buddyboss-theme' ) .
									sprintf( __( '%s', 'buddyboss-theme' ), LearnDash_Custom_Label::get_label( 'course' ) ) .
								'</div>';

							}
							?>

							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							} ?>
                        </a>
                    </div>

			<?php endif; ?>

			<?php if ( $shortcode_atts['show_content'] != 'true' ) : ?>
				<style type="text/css">
					.bb-card-course-details {
						display: none !important;
					}
				</style>
			<?php endif; ?>

                <div class="bb-card-course-details">
					<?php
					$lession_list  = learndash_get_lesson_list( get_the_ID() );
					$lesson_count  = learndash_get_lesson_list( get_the_ID(), array( 'num' => -1 ) );
					$lessons_count = sizeof( $lession_list );
					$total_lessons = (
						$lessons_count > 1
						? sprintf(
							__( '%1$s %2$s', 'buddyboss-theme' ),
							$lessons_count,
							LearnDash_Custom_Label::get_label( 'lessons' )
						)
						: sprintf(
							__( '%1$s %2$s ', 'buddyboss-theme' ),
							$lessons_count,
							LearnDash_Custom_Label::get_label( 'lesson' )
						)
					);

					if( $lessons_count > 0 ) {
						echo '<div class="course-lesson-count">' . $total_lessons . '</div>';
					} else {
						echo '<div class="course-lesson-count">' . __( '0 ', 'buddyboss-theme' ) . sprintf( __( '%s', 'buddyboss-theme' ), LearnDash_Custom_Label::get_label( 'lessons' ) ) . '</div>';
					}
					?>
                    <h2 class="bb-course-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if( buddyboss_theme_get_option('learndash_course_author') ) { ?>
						<?php SFWD_LMS::get_template('course_list_course_author', compact( 'post' ), true ); ?>
					<?php } ?>
					<?php if ( isset( $shortcode_atts['progress_bar'] ) && $shortcode_atts['progress_bar'] == 'true' ) : ?>
                        <div class="course-progress-wrap">
							<?php learndash_get_template_part( 'modules/progress.php', array(
								'context'   =>  'course',
								'user_id'   =>  get_current_user_id(),
								'course_id' =>  get_the_ID()
							), true ); ?>
                        </div>
					<?php endif;

					$course_price        = trim( learndash_get_course_meta_setting( get_the_ID(), 'course_price' ) );
					$course_price_type   = learndash_get_course_meta_setting( get_the_ID(), 'course_price_type' );
					$course_pricing      = learndash_get_course_price( get_the_ID() );
					// Price
					if ( !empty( $course_price ) ) { ?>
                        <div class="bb-course-footer bb-course-pay">
                        <span class="course-fee">
                        <?php
                        if( $course_pricing['type'] !== 'closed' ):
	                        echo wp_kses_post( '<span class="ld-currency">' . learndash_30_get_currency_symbol() . '</span> ' );
                        endif;
                        ?>
                        <?php echo wp_kses_post($course_pricing['price']); ?>
                    </span>
                        </div><?php
					}

					?>

                </div><!-- .entry-header -->

        </div><!-- #post-## -->
    </div>
	<?php
} else {

	global $post;

	$course_id = $shortcode_atts['course_id'];

	if ( is_user_logged_in() ) {
		$cuser   = wp_get_current_user();
		$user_id = $cuser->ID;
	} else {
		$user_id = false;
	} ?>

    <div class="learndash-wrapper">
        <div class="ld-item-list">
            <div class="ld-item-list-item">
                <div class="ld-item-list-item-preview">
                    <a class="ld-item-name ld-primary-color-hover" href="<?php echo esc_attr( learndash_get_step_permalink( get_the_ID() ) ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                </div>
            </div>
        </div>

		<?php
		switch ( get_post_type() ) {

			case( 'sfwd-courses' ):

				$wrapper = array(
					'<div class="learndash-wrapper">
                        <div class="ld-item-list">',
					'</div>
                    </div>'
				);

				$output = learndash_get_template_part( '/course/partials/row.php',
					array(
						'course_id' => $course_id,
						'user_id'   => $user_id
					) );


				break;

			case( 'sfwd-lessons' ):

				global $course_lessons_results;

				if ( isset( $course_lessons_results['pager'] ) ):
					learndash_get_template_part( 'modules/pagination.php',
						array(
							'pager_results' => $course_lessons_results['pager'],
							'pager_context' => 'course_lessons'
						),
						true );
				endif;

				break;

			case( 'sfwd-topic' ):

				$wrapper = array(
					'<div class="learndash-wrapper">
                    <div class="ld-item-list">',
					'</div>
                </div>'
				);

				$output = learndash_get_template_part( '/topic/partials/row.php',
					array(
						'topic'     => $post,
						'course_id' => $course_id,
						'user_id'   => $user_id
					) );

				break;
		} ?>
    </div>

	<?php
}
