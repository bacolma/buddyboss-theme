<?php
/**
 * Displays a quiz.
 *
 * Available Variables:
 *
 * $course_id       : (int) ID of the course
 * $course      : (object) Post object of the course
 * $course_settings : (array) Settings specific to current course
 * $course_status   : Course Status
 * $has_access  : User has access to course or is enrolled.
 *
 * $courses_options : Options/Settings as configured on Course Options page
 * $lessons_options : Options/Settings as configured on Lessons Options page
 * $quizzes_options : Options/Settings as configured on Quiz Options page
 *
 * $user_id         : (object) Current User ID
 * $logged_in       : (true/false) User is logged in
 * $current_user    : (object) Currently logged in user object
 * $post            : (object) The quiz post object
 * $lesson_progression_enabled  : (true/false)
 * $show_content    : (true/false) true if user is logged in and lesson progression is disabled or if previous lesson and topic is completed.
 * $attempts_left   : (true/false)
 * $attempts_count : (integer) No of attempts already made
 * $quiz_settings   : (array)
 *
 * Note:
 *
 * To get lesson/topic post object under which the quiz is added:
 * $lesson_post = !empty($quiz_settings["lesson"])? get_post($quiz_settings["lesson"]):null;
 *
 * @since 2.1.0
 *
 * @package LearnDash\Quiz
 */
global $post;
if ( empty( $course_id ) ) {
	$course_id = buddyboss_theme()->learndash_helper()->ld_30_get_course_id( $post->ID );
}
//$content             = $post->post_content;
$lession_list        = learndash_get_lesson_list( $course_id, array('num' => -1 ) );
$course_quizzes_list = learndash_get_course_quiz_list( $course_id, $user_id );
$content_urls        = buddyboss_theme()->learndash_helper()->buddyboss_theme_ld_custom_pagination( $course_id, $lession_list, $course_quizzes_list );
$quiz_urls           = buddyboss_theme()->learndash_helper()->buddyboss_theme_ld_custom_quiz_count( $course_id, $lession_list, $course_quizzes_list );
$pagination_urls     = buddyboss_theme()->learndash_helper()->buddyboss_theme_custom_next_prev_url( $content_urls );
$current_quiz_ke     = buddyboss_theme()->learndash_helper()->buddyboss_theme_ld_custom_quiz_key( $quiz_urls );
$topics              = array();
$course              = get_post( $course_id );
$course_settings     = learndash_get_setting( $course );
if ( empty( $course ) ) {
	$course = get_post( $course_id );
}
?>

<div id="learndash-content" class="container-full">

    <div class="bb-grid grid">
        <?php
        if ( ! empty( $course ) ) :
	        include locate_template('/learndash/ld30/learndash-sidebar.php');
        endif;
        ?>

        <div id="learndash-page-content">
            <div class="learndash-content-body">

                <div class="<?php echo esc_attr( learndash_the_wrapper_class() ); ?>">

                    <?php
                 /**
                  * Action to add custom content before the quiz content starts
                  *
                  * @since 3.0
                  */
                 do_action( 'learndash-quiz-before', get_the_ID(), $course_id, $user_id );
                 ?>
                    <div id="learndash-course-header" class="bb-lms-header quiz-fix">
                        <div class="flex bb-position">
                            <div class="sfwd-course-position">
                                <span class="bb-pages"><?php echo LearnDash_Custom_Label::get_label( 'quiz' ); ?> <?php echo $current_quiz_ke; ?> <span class="bb-total"><?php _e( 'of', 'buddyboss-theme' ); ?> <?php echo count( $quiz_urls ); ?></span></span>
                            </div>
                            <div class="sfwd-course-nav">
                                <?php
                                $expire_date_calc    = ld_course_access_expires_on( $course_id, $user_id );
                                $courses_access_from = ld_course_access_from( $course_id, $user_id );
                                $expire_access_days  = learndash_get_setting( $course_id, 'expire_access_days' );
                                $date_format         = get_option( 'date_format' );
                                $expire_date         = date_i18n( $date_format, $expire_date_calc );
                                $current             = time();
                                $expire_string       = ( $expire_date_calc > $current ) ? __( 'Expires at', 'buddyboss-theme' ) : __( 'Expired at', 'buddyboss-theme' );
                                if ( $expire_date_calc > 0 && abs( intval( $expire_access_days ) )  > 0 && ( !empty( $user_id ) ) ) { ?>
                                <div class="sfwd-course-expire">
                                    <span data-balloon-pos="up" data-balloon="<?php echo $expire_string; ?>"><i class="bb-icons bb-icon-watch-alarm"></i><?php echo $expire_date; ?></span>
                                </div>
                                <?php } ?>
                                <div class="learndash_next_prev_link">
                    				<?php
                    				if ( $pagination_urls['prev'] != '' ) {
                    					echo $pagination_urls['prev'];
                    				} else {
                    					echo '<span class="prev-link empty-post"></span>';
                    				}
                    				?>
                    				<?php if ( $pagination_urls['next'] != '' || ( isset( $course_settings['course_disable_lesson_progression'] ) && $course_settings['course_disable_lesson_progression'] === 'on' && $pagination_urls['next'] != '') ) {
                    					echo $pagination_urls['next'];
                    				} else {
                    					echo '<span class="next-link empty-post"></span>';
                    				}
                    				?>
                                </div>
                            </div>
                        </div>
                        <div class="lms-header-title">
                            <h1><?php echo $post->post_title; ?></h1>
                        </div>
                        <?php
                        global $post;
                        $course_post = learndash_get_setting( $post, 'course' );
                        $course_data = get_post( $course_post );
                        $author_id = $course_data->post_author;
                        learndash_get_template_part( 'template-course-author.php', array(
                            'user_id'   => $author_id
                        ), true );
                        ?>
                    </div>

                 <div class="learndash_content_wrap">

                    <?php
                    learndash_get_template_part( 'modules/infobar.php', array(
                         'context'   =>  'quiz',
                         'course_id' =>  $course_id,
                         'user_id'   =>  $user_id
                     ), true );
                    if( !empty($lesson_progression_enabled) ):
                    	$last_incomplete_step = is_quiz_accessable( null, $post, true );
                    	if ( 1 !== $last_incomplete_step ):
                            /**
                             * Action to add custom content before the quiz progression
                             *
                             * @since 3.0
                             */
                            do_action( 'learndash-quiz-progression-before', get_the_ID(), $course_id, $user_id );
                    		if ( is_a( $last_incomplete_step, 'WP_Post' ) ) {
                                learndash_get_template_part('modules/messages/lesson-progression.php', array(
                                    'previous_item' => $last_incomplete_step,
                                    'course_id'     => $course_id,
                                    'user_id'       => $user_id,
                                    'context'       => 'quiz'
                                ), true );
                    		}
                            /**
                             * Action to add custom content after the quiz progress
                             *
                             * @since 3.0
                             */
                            do_action( 'learndash-quiz-progression-after', get_the_ID(), $course_id, $user_id );
                    	endif;
                    endif;
                     if( $show_content ):
                         /**
                          * Content and/or tabs
                          */
                         learndash_get_template_part( 'modules/tabs.php', array(
                             'course_id' => $course_id,
                             'post_id'   => get_the_ID(),
                             'user_id'   => $user_id,
                             'content'   => $content,
                             'materials' => $materials,
                             'context'   => 'quiz'
                         ), true );
                        if ( $attempts_left ):
                            /**
                             * Action to add custom content before the actual quiz content (not WP_Editor content)
                             *
                             * @since 3.0
                             */
                            do_action( 'learndash-quiz-actual-content-before', get_the_ID(), $course_id, $user_id );
                            echo $quiz_content;
                            /**
                             * Action to add custom content after the actual quiz content (not WP_Editor content)
                             *
                             * @since 3.0
                             */
                            do_action( 'learndash-quiz-actual-content-after', get_the_ID(), $course_id, $user_id );
                        else:
                            /**
                             * Display an alert
                             */
                             /**
                              * Action to add custom content before the quiz attempts alert
                              *
                              * @since 3.0
                              */
                             do_action( 'learndash-quiz-attempts-alert-before', get_the_ID(), $course_id, $user_id );
                            learndash_get_template_part( 'modules/alert.php', array(
                                'type'      =>  'warning',
                                'icon'      =>  'alert',
                                'message' => sprintf( esc_html_x( 'You have already taken this %1$s %2$d time(s) and may not take it again.', 'placeholders: quiz, attempts count', 'buddyboss-theme' ), learndash_get_custom_label_lower('quiz'), $attempts_count )
                            ), true );
                            /**
                             * Action to add custom content after the quiz attempts alert
                             *
                             * @since 3.0
                             */
                            do_action( 'learndash-quiz-attempts-alert-after', get_the_ID(), $course_id, $user_id );
                        endif;
                    endif;
                    /**
                     * Action to add custom content before the quiz content starts
                     *
                     * @since 3.0
                     */
                    do_action( 'learndash-quiz-after', get_the_ID(), $course_id, $user_id ); ?>

                    <?php
                    $focus_mode         = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'focus_mode_enabled' );
                    $post_type          = get_post_type( $post->ID );
                    $post_type_comments = learndash_post_type_supports_comments( $post_type );
                    if ( is_user_logged_in() && 'yes' === $focus_mode && comments_open() ) {
	                    learndash_get_template_part( 'focus/comments.php',
		                    array(
			                    'course_id' => $course_id,
			                    'user_id'   => $user_id,
			                    'context'   => 'focus'
		                    ),
		                    true );
                    } elseif ( $post_type_comments == true ) {
	                    if ( comments_open() ) :
		                    comments_template();
	                    endif;
                    }
                    ?>

                    </div><?php /* .learndash_content_wrap */ ?>

                </div> <!--/.learndash-wrapper-->

            </div><?php /* .learndash-content-body */ ?>
        </div><?php /* #learndash-page-content */ ?>
    </div>

</div>
