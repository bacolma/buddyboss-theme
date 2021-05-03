<?php
/**
 * Template part for displaying course list item
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */
?>

<?php
global $post, $wpdb;

$is_enrolled         = false;
$current_user_id     = get_current_user_id();
$cats                = wp_get_post_terms( get_the_ID(), 'ld_course_category' );
$lession_list        = learndash_get_lesson_list( get_the_ID() );
$lesson_count        = learndash_get_lesson_list( get_the_ID(), array( 'num' => - 1 ) );
$paypal_settings     = LearnDash_Settings_Section::get_section_settings_all( 'LearnDash_Settings_Section_PayPal' );
$course_price        = trim( learndash_get_course_meta_setting( get_the_ID(), 'course_price' ) );
$course_price_type   = learndash_get_course_meta_setting( get_the_ID(), 'course_price_type' );
$course_button_url   = learndash_get_course_meta_setting( get_the_ID(), 'custom_button_url' );
$courses_progress    = buddyboss_theme()->learndash_helper()->get_courses_progress( $current_user_id );
$course_progress     = isset( $courses_progress[ get_the_ID() ] ) ? $courses_progress[ get_the_ID() ] : null;
$course_status       = learndash_course_status( get_the_ID(), $current_user_id );
$grid_col            = is_active_sidebar( 'learndash_sidebar' ) ? 3 : 4;
$course_progress_new = buddyboss_theme()->learndash_helper()->ld_get_progress_course_percentage( get_current_user_id(), get_the_ID() );
$admin_enrolled      = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Section_General_Admin_User', 'courses_autoenroll_admin_users' );
$course_pricing      = learndash_get_course_price( get_the_ID() );
$has_access          = sfwd_lms_has_access( get_the_ID(), $current_user_id );


if ( sfwd_lms_has_access( get_the_ID(), $current_user_id ) ) {
	$is_enrolled = true;
} else {
	$is_enrolled = false;
}

// if admins are enrolled
if ( current_user_can( 'administrator' ) && $admin_enrolled === 'yes' ) {
	$is_enrolled = true;
}

$class = '';
if ( ! empty( $course_price ) && ( $course_price_type == 'paynow' || $course_price_type == 'subscribe' || $course_price_type == 'closed' ) ) {
	$class = 'bb-course-paid';
}
?>

<li class="bb-course-item-wrap">

    <div class="bb-cover-list-item <?php echo $class; ?>">
        <div class="bb-course-cover">
            <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="bb-cover-wrap">
				<?php
				$progress = learndash_course_progress( array(
					'user_id'   => $current_user_id,
					'course_id' => get_the_ID(),
					'array'     => true,
				) );

				$status = ( $progress['percentage'] == 100 ) ? 'completed' : 'notcompleted';

				if ( $progress['percentage'] > 0 && $progress['percentage'] !== 100 ) {
					$status = 'progress';
				}

				if ( is_user_logged_in() && isset( $has_access ) && $has_access ) {

					if ( ( $course_pricing['type'] === 'open' && $progress['percentage'] === 0 ) || ( $course_pricing['type'] !== 'open' && $has_access && $progress['percentage'] === 0 ) ) {

						echo '<div class="ld-status ld-status-progress ld-primary-background">' .
							__( 'Start ', 'buddyboss-theme' ) .
							sprintf( __( '%s', 'buddyboss-theme' ), LearnDash_Custom_Label::get_label( 'course' ) ) .
						'</div>';

					} else {

						learndash_status_bubble( $status );

					}

				} elseif ( $course_pricing['type'] == 'free' ) {

					echo '<div class="ld-status ld-status-incomplete ld-third-background">' . __( 'Free', 'buddyboss-theme' ) . '</div>';

				} elseif ( $course_pricing['type'] !== 'open' ) {

					echo '<div class="ld-status ld-status-incomplete ld-third-background">' . __( 'Not Enrolled',
							'buddyboss-theme' ) . '</div>';

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

        <div class="bb-card-course-details">
			<?php
			$lessons_count = sizeof( $lesson_count );
			$total_lessons = (
				$lessons_count > 1
				? sprintf(
					__( '%1$s %2$s', 'buddyboss-theme' ),
					$lessons_count,
					LearnDash_Custom_Label::get_label( 'lessons' )
				)
				: sprintf(
					__( '%1$s %2$s', 'buddyboss-theme' ),
					$lessons_count,
					LearnDash_Custom_Label::get_label( 'lesson' )
				)
			);

			if ( $lessons_count > 0 ) {
				echo '<div class="course-lesson-count">' . $total_lessons . '</div>';
			} else {
				echo '<div class="course-lesson-count">' .
					sprintf( __( '0 %s', 'buddyboss-theme' ), LearnDash_Custom_Label::get_label( 'lessons' ) ) .
				'</div>';
			}
			?>
            <h2 class="bb-course-title">
                <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

			<?php if ( buddyboss_theme_get_option( 'learndash_course_author' ) ) { ?><?php SFWD_LMS::get_template( 'course_list_course_author',
				compact( 'post' ),
				true ); ?><?php } ?>

			<?php
			if ( is_user_logged_in() && isset( $has_access ) && $has_access ) { ?>

                <div class="course-progress-wrap">

					<?php learndash_get_template_part( 'modules/progress.php',
						array(
							'context'   => 'course',
							'user_id'   => $current_user_id,
							'course_id' => get_the_ID(),
						),
						true ); ?>

                </div>

			<?php } else { ?>
                <div class="bb-course-excerpt">
					<?php echo get_the_excerpt( get_the_ID() ); ?>
                </div>
			<?php }

			// Price
			if ( ! empty( $course_price ) && empty( $is_enrolled ) ) { ?>
                <div class="bb-course-footer bb-course-pay">
                <span class="course-fee">
                        <?php
                        if ( $course_pricing['type'] !== 'closed' ):
	                        echo wp_kses_post( '<span class="ld-currency">' . learndash_30_get_currency_symbol() . '</span> ' );
                        endif;
                        ?><?php echo wp_kses_post( $course_pricing['price'] ); ?>
                    </span>
                </div><?php
			}
			?>
        </div>
    </div>
</li>
