<?php
/**
 * Action to add custom content before the progress bar
 *
 * @since 3.0
 */

$context = ( isset($context) ? $context : 'learndash' );

do_action( 'learndash-progress-bar-before', $course_id, $user_id );
do_action( 'learndash-' . $context . '-progress-bar-before', $course_id, $user_id );

/**
 * In the topic context we're measuring progress through a lesson, not the course itself
 * @var [type]
 */
if( $context !== 'topic' ) {

    $progress_args = apply_filters( 'learndash_progress_args', array(
        'array'     =>  true,
        'course_id' => $course_id,
        'user_id'   =>  $user_id
    ), $course_id, $user_id, $context );

    $progress = apply_filters( 'learndash-' . $context . '-progress-stats', learndash_course_progress( $progress_args ) );

} else {
    global $post;
    $progress = apply_filters( 'learndash-' . $context . '-progress-stats', learndash_lesson_progress( $post, $course_id ) );
}

if($progress):
/**
 * This is just here for reference
 */ ?>
    <div class="ld-progress<?php if( $context === 'course' ):?> ld-progress-inline<?php endif; ?>">
        <?php if( $context == 'focus' ): ?>
            <div class="ld-progress-wrap">
        <?php endif; ?>
            <div class="ld-progress-heading">
                <?php if( $context === 'topic' ): ?>
                    <div class="ld-progress-label"><?php echo sprintf( esc_html_x( '%s Progress', 'Placeholder: Lesson Progress', 'buddyboss-theme' ), LearnDash_Custom_Label::get_label('lesson') ); ?></div>
                <?php endif; ?>
            </div>

            <div class="ld-progress-bar">
                <div class="ld-progress-bar-percentage ld-secondary-background" style="<?php echo esc_attr( 'width:' . $progress['percentage'] . '%' ); ?>"></div>
            </div>
            <div class="ld-progress-stats">
                <div class="ld-progress-percentage ld-secondary-color course-completion-rate"><?php echo sprintf( esc_html_x('%s%% Complete', 'placeholder: Progress percentage', 'buddyboss-theme'), $progress['percentage'] ); ?></div>
                <div class="ld-progress-steps">
                    <?php
                    if ( $context === 'course' || $context === 'focus' ):
                        $course_args     = array(
                            'course_id'     => $course_id,
                            'user_id'       => $user_id,
                            'post_id'       => $course_id,
                            'activity_type' => 'course',
                        );
                        $course_activity = learndash_get_user_activity( $course_args );
                        if( $course_activity && $context === 'course' ) {
	                        $date_time_display = get_date_from_gmt( date('Y-m-d H:i:s', $course_activity->activity_updated ), 'Y-m-d H:i:s' );
	                        echo sprintf( esc_html_x( 'Last activity on %s', 'Last activity date in infobar', 'buddyboss-theme' ), date_i18n( get_option( 'date_format' ), strtotime( $date_time_display ) ) );
                        } else {
	                        echo sprintf( __( '%s/%s Steps', 'buddyboss-theme' ), $progress['completed'], $progress['total'] );
                        }
                    endif;
                    ?>
                </div>
            </div> <!--/.ld-progress-stats-->
            <?php if( $context == 'focus' ): ?>
                </div> <!--/.ld-progress-wrap-->
            <?php endif; ?>
    </div> <!--/.ld-progress-->
<?php
endif;
/**
 * Action to add custom content before the course content progress bar
 *
 * @since 3.0
 */
do_action( 'learndash-progress-bar-after', $course_id, $user_id );
do_action( 'learndash-' . $context . '-progress-bar-after', $course_id, $user_id );
