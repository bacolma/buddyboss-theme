<?php
/**
 * Displays a lesson.
 *
 * Available Variables:
 *
 * $course_id 		: (int) ID of the course
 * $course 		: (object) Post object of the course
 * $course_settings : (array) Settings specific to current course
 * $course_status 	: Course Status
 * $has_access 	: User has access to course or is enrolled.
 *
 * $courses_options : Options/Settings as configured on Course Options page
 * $lessons_options : Options/Settings as configured on Lessons Options page
 * $quizzes_options : Options/Settings as configured on Quiz Options page
 *
 * $user_id 		: (object) Current User ID
 * $logged_in 		: (true/false) User is logged in
 * $current_user 	: (object) Currently logged in user object
 *
 * $quizzes 		: (array) Quizzes Array
 * $post 			: (object) The lesson post object
 * $topics 		: (array) Array of Topics in the current lesson
 * $all_quizzes_completed : (true/false) User has completed all quizzes on the lesson Or, there are no quizzes.
 * $lesson_progression_enabled 	: (true/false)
 * $show_content	: (true/false) true if lesson progression is disabled or if previous lesson is completed.
 * $previous_lesson_completed 	: (true/false) true if previous lesson is completed
 * $lesson_settings : Settings specific to the current lesson.
 *
 * @since 3.0
 *
 * @package LearnDash\Lesson
 */
$in_focus_mode = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'focus_mode_enabled' );
add_filter( 'comments_array', 'learndash_remove_comments', 1, 2 );
$lesson_data             = $post;
if ( empty( $course_id ) ) {
	$course_id = learndash_get_course_id( $lesson_data->ID );
	if ( empty( $course_id ) ) {
		$course_id = (int) buddyboss_theme()->learndash_helper()->ld_30_get_course_id( $lesson_data->ID );
    }
}
$lession_list            = learndash_get_lesson_list( $course_id, array('num' => -1 ) );
//$content                 = $lesson_data->post_content;
$lesson_topics_completed = learndash_lesson_topics_completed( $post->ID );
$content_urls            = buddyboss_theme()->learndash_helper()->buddyboss_theme_ld_custom_pagination( $course_id, $lession_list );
$pagination_urls         = buddyboss_theme()->learndash_helper()->buddyboss_theme_custom_next_prev_url( $content_urls );
if ( empty( $course ) ) {
    if ( empty( $course_id ) ) {
	    $course = learndash_get_course_id( $lesson_data->ID );
    } else {
	    $course = get_post( $course_id );
    }
}
?>

<div id="learndash-content" class="container-full">

    <div class="bb-grid grid">
        <?php if ( ! empty( $course ) ) :
            include locate_template('/learndash/ld30/learndash-sidebar.php');
        endif;
        ?>

        <div id="learndash-page-content">
            <div class="learndash-content-body">
                <?php
                $lesson_no    = 1;
    			foreach ( $lession_list as $les ) {
    				if ( $les->ID == $post->ID ) {
    					break;
    				}
    				$lesson_no ++;
    			}
                ?>

                <div class="<?php echo esc_attr( learndash_the_wrapper_class() ); ?>">

                    <?php
                     /**
                      * Action to add custom content before the lesson
                      *
                      * @since 3.0
                      */
                     do_action( 'learndash-lesson-before', get_the_ID(), $course_id, $user_id );
                    ?>
                    <div id="learndash-course-header" class="bb-lms-header">
                        <div class="bb-ld-info-bar">
                            <?php
                            learndash_get_template_part( 'modules/infobar.php', array(
                                'context'   =>  'lesson',
                                'course_id' =>  $course_id,
                                'user_id'   =>  $user_id,
                            ), true );
                            ?>
                        </div>
                        <div class="flex bb-position">
                            <div class="sfwd-course-position">
                                <span class="bb-pages"><?php echo LearnDash_Custom_Label::get_label( 'lesson' ); ?> <?php echo $lesson_no; ?> <span class="bb-total"><?php _e( 'of', 'buddyboss-theme' ); ?> <?php echo sizeof( $lession_list ); ?></span></span>
                            </div>
                            <div class="sfwd-course-nav">
                                <div class="bb-ld-status">
                                <?php
                                    $status = ( learndash_is_item_complete() ? 'complete' : 'incomplete' );
                                    learndash_status_bubble( $status );
                                ?>
                                </div>
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
    				                if ( isset( $pagination_urls['prev'] ) && $pagination_urls['prev'] != '' ) {
    					                echo $pagination_urls['prev'];
    				                } else {
                                        echo '<span class="prev-link empty-post"></span>';
                                    }
                                    ?>
                    				<?php if ( (isset( $pagination_urls['next'] ) && apply_filters( 'learndash_show_next_link', learndash_is_lesson_complete( $user_id, $post->ID ),  $user_id, $post->ID ) && $pagination_urls['next'] != '') || (isset( $pagination_urls['next'] ) && $course_settings['course_disable_lesson_progression'] === 'on' && $pagination_urls['next'] != '') ) {
                    				    echo $pagination_urls['next'];
                                    } else {
                                        echo '<span class="next-link empty-post"></span>';
                                    }
                                    ?>
                    			</div>
                            </div>
                        </div>
                        <div class="lms-header-title">
                            <h1><?php the_title(); ?></h1>
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
                        /**
                         * If the user needs to complete the previous lesson display an alert
                         *
                         */
                        if( @$lesson_progression_enabled && ! @$previous_lesson_completed ):
                            $previous_item = learndash_get_previous( $post );
                            learndash_get_template_part('modules/messages/lesson-progression.php', array(
                                'previous_item' => $previous_item,
                                'course_id'     => $course_id,
                                'context'       => 'topic',
                                'user_id'       => $user_id
                            ), true );
                        endif;
                        if ( $show_content ) :
                            /**
                             * Content and/or tabs
                             */
                            learndash_get_template_part( 'modules/tabs.php', array(
                                'course_id' => $course_id,
                                'post_id'   => get_the_ID(),
                                'user_id'   => $user_id,
                                'content'   => $content,
                                'materials' => $materials,
                                'context'   => 'lesson'
                            ), true );
                            /**
                             * Display Lesson Assignments
                             */
                            if( lesson_hasassignments($post) && !empty($user_id) ):
                                /**
                                 * Action to add custom content before the lesson assignment
                                 *
                                 * @since 3.0
                                 */
                                do_action( 'learndash-lesson-assignment-before', get_the_ID(), $course_id, $user_id );
                                learndash_get_template_part(
                                    'assignment/listing.php',
                                    array(
                                        'course_step_post'  => $post,
                                        'user_id'           => $user_id,
                                        'course_id'         => $course_id
                                    ), true );
                                /**
                                 * Action to add custom content after the lesson assignment
                                 *
                                 * @since 3.0
                                 */
                                do_action( 'learndash-lesson-assignment-after', get_the_ID(), $course_id, $user_id );
                            endif;
                            /**
                             * Lesson Topics or Quizzes
                             */
                        	if( !empty($topics) || !empty($quizzes) ):
                                /**
                                 * Action to add custom content before the course certificate link
                                 *
                                 * @since 3.0
                                 */
                                do_action( 'learndash-lesson-content-list-before', get_the_ID(), $course_id, $user_id );
                                global $post;
                                $lesson = array(
                                    'post'  => $post
                                );
                                learndash_get_template_part( 'lesson/listing.php', array(
                                    'course_id' => $course_id,
                                    'lesson'    => $lesson,
                                    'topics'    => $topics,
                                    'quizzes'   => $quizzes,
                                    'user_id'   => $user_id,
                                ), true );
                                /**
                                 * Action to add custom content before the course certificate link
                                 *
                                 * @since 3.0
                                 */
                                do_action( 'learndash-lesson-content-list-after', get_the_ID(), $course_id, $user_id );
                        	endif;
                        endif; // end $show_content
                        /**
                         * Set a variable to switch the next button to complete button
                         * @var $can_complete [bool] - can the user complete this or not?
                         */
                        $can_complete = false;
                        if( $all_quizzes_completed && $logged_in && !empty($course_id) ):
                            $can_complete = apply_filters( 'learndash-lesson-can-complete', true, get_the_ID(), $course_id, $user_id );
                        endif;
                        learndash_get_template_part(
                        		'modules/course-steps.php',
                        		array(
                        			'course_id'          => $course_id,
                        			'course_step_post'   => $post,
                        			'user_id'            => $user_id,
                        			'course_settings'    => isset( $course_settings ) ? $course_settings : array(),
                                    'can_complete'       => $can_complete,
                                    'context'            => 'lesson'
                        		),
                                true
                        	);
                        /**
                         * Action to add custom content after the lesson
                         *
                         * @since 3.0
                         */
                        do_action( 'learndash-lesson-after', get_the_ID(), $course_id, $user_id ); ?>

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
