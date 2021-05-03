<?php
/**
 * Displays a user's profile.
 *
 * Available Variables:
 *
 * $user_id 		: Current User ID
 * $current_user 	: (object) Currently logged in user object
 * $user_courses 	: Array of course ID's of the current user
 * $quiz_attempts 	: Array of quiz attempts of the current user
 * $shortcode_atts 	: Array of values passed to shortcode
 *
 * @since 3.0
 *
 * @package LearnDash\User
 */


global $learndash_assets_loaded;
$shortcode_data_json = htmlspecialchars( json_encode( $shortcode_atts ) );

/**
 * Logic to load assets as needed
 * @var [type]
 */

if ( !isset($learndash_assets_loaded['scripts']['learndash_template_script_js']) ):
	$filepath = SFWD_LMS::get_template( 'learndash_template_script.js', null, null, true );
	if ( !empty( $filepath ) ):
		wp_enqueue_script( 'learndash_template_script_js', learndash_template_url_from_path( $filepath ), array( 'jquery' ), LEARNDASH_SCRIPT_VERSION_TOKEN, true );
		$learndash_assets_loaded['scripts']['learndash_template_script_js'] = __FUNCTION__;

		$data = array();
		$data['ajaxurl'] = admin_url('admin-ajax.php');
		$data = array( 'json' => json_encode( $data ) );
		wp_localize_script( 'learndash_template_script_js', 'sfwd_data', $data );
	endif;
endif;


/**
 * We don't want to include this if this is a paginated view as we'll end up with duplicates
 *
 * @var $_GET['action'] (string) 	is set to ld30_ajax_pager if paginating
 */
if( !isset($_GET['action']) || $_GET['action'] !== 'ld30_ajax_pager' ):
	LD_QuizPro::showModalWindow();
endif; ?>

<div class="<?php learndash_the_wrapper_class(); ?>">
    <div id="ld-profile" data-shortcode_instance="<?php echo $shortcode_data_json; ?>">
        <?php
        /**
         * If the user wants to include the summary, they use the shortcode attr summary="true"
         * @var [type]
         */
        if( isset($shortcode_atts['show_header']) && $shortcode_atts['show_header'] == 'yes' ): ?>
            <div class="ld-profile-summary">
                <div class="ld-profile-card">
                    <div class="ld-profile-avatar">
                        <?php echo wp_kses_post( get_avatar( $user_id, 300 ) ); ?>
                    </div> <!--/.ld-profile-avatar-->
                    <?php
                    if( !empty($current_user->user_lastname) || !empty($current_user->user_firstname) ): ?>
                        <div class="ld-profile-heading">
                            <?php echo esc_html( $current_user->user_firstname . ' ' . $current_user->user_lastname ); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    if( current_user_can('read') && isset($shortcode_atts['profile_link']) && true === $shortcode_atts['profile_link'] && apply_filters( 'learndash_show_profile_link', $shortcode_atts['profile_link'] ) ): ?>
        				<a class="ld-profile-edit-link" href='<?php echo get_edit_user_link(); ?>'><?php esc_html_e( 'Edit profile', 'buddyboss-theme' ); ?></a>
                    <?php endif; ?>
                </div> <!--/.ld-profile-card-->
                <div class="ld-profile-stats">
                    <?php
					$user_stats = learndash_get_user_stats( $user_id );

                    $ld_profile_stats = array(
                        array(
                            'title' =>  LearnDash_Custom_Label::get_label( 'courses' ) ,
                            'value' =>  $user_stats['courses'],
                        ),
                        array(
                            'title' =>  __( 'Completed', 'buddyboss-theme' ),
                            'value' =>  $user_stats['completed'],
                        ),

                        array(
                            'title' => __( 'Certificates', 'buddyboss-theme' ),
                            'value' => $user_stats['certificates'],
                        )
                    );

					if( isset($shortcode_atts['course_points_user']) && $shortcode_atts['course_points_user'] == 'yes' ) {
						$ld_profile_stats[] = array(
		                            'title' => esc_html__( 'Points', 'buddyboss-theme' ),
		                            'value' => $user_stats['points']
		                        );
					}

                    foreach( $ld_profile_stats as $stat ): ?>
                        <div class="<?php echo esc_attr( 'ld-profile-stat ld-profile-stat-' . sanitize_title($stat['title']) ); ?>">
                            <strong><?php echo esc_html($stat['value']); ?></strong>
                            <span><?php echo esc_html($stat['title']); ?></span>
                        </div> <!--/.ld-profile-stat-->
                    <?php
                    endforeach; ?>
                </div> <!--/.ld-profile-stats-->
            </div>
        <?php endif; ?>

        <div class="ld-item-list ld-course-list">

            <div class="ld-section-heading">
                <h3><?php printf( esc_html_x( 'Your %s', 'Profile Course Content Label', 'buddyboss-theme' ), esc_attr( LearnDash_Custom_Label::get_label( 'courses' ) ) ); ?></h3>
                <div class="ld-item-list-actions">
                    <div class="ld-search-prompt" data-ld-expands="ld-course-search">
                        <?php echo esc_html__( 'Search', 'buddyboss-theme' ); ?> <span class="ld-icon-search ld-icon"></span>
                    </div> <!--/.ld-search-prompt-->
                    <div class="ld-expand-button" data-ld-expands="ld-main-course-list" data-ld-expand-text="<?php echo esc_attr_e( 'Expand All', 'buddyboss-theme' ); ?>" data-ld-collapse-text="<?php echo esc_attr_e( 'Collapse All', 'buddyboss-theme' ); ?>">
                        <span class="ld-icon-arrow-down ld-icon"></span>
                        <span class="ld-text"><?php echo esc_html_e( 'Expand All', 'buddyboss-theme' ); ?></span>
                    </div> <!--/.ld-expand-button-->
                </div> <!--/.ld-course-list-actions-->
            </div> <!--/.ld-section-heading-->
            <?php
            learndash_get_template_part( 'shortcodes/profile/search.php', array(
                'user_id'       => $user_id,
                'user_courses'  => $user_courses
            ), true ); ?>

            <div class="ld-item-list-items" id="ld-main-course-list" data-ld-expand-list="true">

                <?php
                if( !empty($user_courses) ):
                    foreach( $user_courses as $course_id ):

                        learndash_get_template_part( 'shortcodes/profile/course-row.php', array(
                            'user_id'        => $user_id,
                            'course_id'      => $course_id,
                            'quiz_attempts'  => $quiz_attempts,
                            'shortcode_atts' => $shortcode_atts
                        ), true );

                    endforeach;
				else:

					$alert = array(
                        'icon'    => 'alert',
                        // translators: placeholder: Courses.
				        'message' => sprintf( esc_html_x( 'No %s found', 'placeholder: Courses', 'buddyboss-theme' ), esc_html( LearnDash_Custom_Label::get_label('courses') ) ),
				        'type'    => 'warning',
				    );
					learndash_get_template_part( 'modules/alert.php', $alert, true );

				endif; ?>

            </div> <!--/.ld-course-list-items-->

        </div> <!--/ld-course-list-->

        <?php
		learndash_get_template_part(
			'modules/pagination',
			array(
				'pager_results'	=>	$profile_pager,
				'pager_context'	=>	'profile',
				'search' 		=> ( isset($_GET['ld-profile-search']) ? $_GET['ld-profile-search'] : false )
			), true );
		/*
        echo SFWD_LMS::get_template(
        	'learndash_pager.php',
        	array(
        	'pager_results' => $profile_pager,
        	'pager_context' => 'profile'
        	)
        ); */ ?>

    </div> <!--/#ld-profile-->

</div> <!--/.ld-course-wrapper-->
<?php
if ( apply_filters('learndash_course_steps_expand_all', $shortcode_atts['expand_all'], 0, 'profile_shortcode' ) ): ?>
	<script>
		jQuery(document).ready(function() {
			setTimeout(function() {
				jQuery(".ld-item-list-actions .ld-expand-button").trigger('click');
			}, 1000 );
		});
	</script>
<?php
endif;
