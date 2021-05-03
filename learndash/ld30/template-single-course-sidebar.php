<?php
global $wpdb;
$is_enrolled         = false;
$current_user_id     = get_current_user_id();
$course_price        = learndash_get_course_meta_setting( $course_id, 'course_price' );
$course_price_type   = learndash_get_course_meta_setting( $course_id, 'course_price_type' );
$course_button_url   = learndash_get_course_meta_setting( $course_id, 'custom_button_url' );
$paypal_settings     = LearnDash_Settings_Section::get_section_settings_all( 'LearnDash_Settings_Section_PayPal' );
$course_video_embed  = get_post_meta( $course_id, '_buddyboss_lms_course_video', true );
$course_certificate  = learndash_get_course_meta_setting( $course_id, 'certificate' );
$courses_progress    = buddyboss_theme()->learndash_helper()->get_courses_progress( $current_user_id );
$course_progress     = isset( $courses_progress[ $course_id ] ) ? $courses_progress[ $course_id ] : null;
$course_progress_new = buddyboss_theme()->learndash_helper()->ld_get_progress_course_percentage( get_current_user_id(), $course_id );
$admin_enrolled      = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Section_General_Admin_User', 'courses_autoenroll_admin_users' );
$lesson_count        = learndash_get_lesson_list( $course_id, array( 'num' => - 1 ) );
$course_pricing      = learndash_get_course_price( $course_id );
$has_access          = sfwd_lms_has_access( $course_id, $current_user_id );
$file_info           = pathinfo( $course_video_embed );

if( buddyboss_theme_get_option( 'learndash_course_participants', null, true ) ) {
	$course_members_count = buddyboss_theme()->learndash_helper()->buddyboss_theme_ld_course_enrolled_users_list( $course_id );
	$members_arr          = learndash_get_users_for_course( $course_id, array( 'number' => 5 ), false );

	if ( ( $members_arr instanceof WP_User_Query ) && ( property_exists( $members_arr, 'results' ) ) && ( ! empty( $members_arr->results ) ) ) {
		$course_members = $members_arr->get_results();
	} else {
		$course_members = array();
	}
}

if ( '' != $course_video_embed ) {
	$thumb_mode = 'thumbnail-container-vid';
} else {
	$thumb_mode = 'thumbnail-container-img';
}

if ( sfwd_lms_has_access( $course->ID, $current_user_id ) ) {
	$is_enrolled = true;
} else {
	$is_enrolled = false;
}
?>

<div class="bb-single-course-sidebar bb-preview-wrap">
    <div class="bb-ld-sticky-sidebar">
        <div class="widget bb-enroll-widget">
            <div class="bb-enroll-widget flex-1 push-right">
                <div class="bb-course-preview-wrap bb-thumbnail-preview">
                    <div class="bb-preview-course-link-wrap">
                        <div class="thumbnail-container <?php echo $thumb_mode; ?>">
                            <div class="bb-course-video-overlay">
                                <div>
                                    <span class="bb-course-play-btn-wrapper"><span
                                                class="bb-course-play-btn"></span></span>
                                    <div><?php _e( 'Preview this', 'buddyboss-theme' ); ?> <?php echo LearnDash_Custom_Label::get_label( 'course' ); ?></div>
                                </div>
                            </div>
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
							?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bb-course-preview-content">
				<?php if ( buddyboss_theme_get_option( 'learndash_course_participants', null, true ) && ! empty( $course_members ) ) { ?>
                    <div class="bb-course-member-wrap flex align-items-center">
                        <span class="bb-course-members"> <?php
	                        $count = 0;
	                        foreach ( $course_members as $course_member ) :
		                        if ( $count > 2 ) {
			                        break;
		                        } ?>
                                <img class="round"
                                     src="<?php echo get_avatar_url( (int) $course_member, array( 'size' => 96 ) ); ?>"
                                     alt=""/><?php
		                        $count ++;
	                        endforeach; ?>
						</span>

						<?php
						if ( $course_members_count > 3 ) { ?>
                            <span class="members">
                            <span class="members-count-g"><?php
							_e( '+', 'buddyboss-theme' );
							echo $course_members_count - 3; ?>
                            </span><?php
							_e( 'enrolled', 'buddyboss-theme' ); ?>
                            </span><?php
						}
						?>
                    </div>
				<?php } ?>

                <div class="bb-course-status-wrap">
					<?php
					do_action( 'learndash-course-infobar-status-cell-before', get_post_type(), $course_id, $current_user_id );
					$progress = learndash_course_progress( array(
						'user_id'   => $current_user_id,
						'course_id' => $course_id,
						'array'     => true,
					) );

					$status = ( $progress['percentage'] == 100 ) ? 'completed' : 'notcompleted';

					if ( $progress['percentage'] > 0 && $progress['percentage'] !== 100 ) {
						$status = 'progress';
					}

					if ( is_user_logged_in() && isset( $has_access ) && $has_access ) { ?>

                        <div class="bb-course-status-content">
						<?php learndash_status_bubble( $status ); ?>
                        </div><?php

					} elseif ( $course_pricing['type'] !== 'open' ) {

						echo '<div class="bb-course-status-content">';
						echo '<div class="ld-status ld-status-incomplete ld-third-background">' . __( 'Not Enrolled', 'buddyboss-theme' ) . '</div>';
						echo '</div>';

					}
					do_action( 'learndash-course-infobar-status-cell-after', get_post_type(), $course_id, $current_user_id ); ?>
                </div>

                <div class="bb-button-wrap">
					<?php
					$resume_link = '';

					if ( empty( $course_progress ) && $course_progress < 100 ) {
						$btn_advance_class = 'btn-advance-start';
						$btn_advance_label = sprintf( __( 'Start %s', 'buddyboss-theme' ), LearnDash_Custom_Label::get_label( 'course' ) );
						$resume_link       = buddyboss_theme()->learndash_helper()->boss_theme_course_resume( $course_id );
					} elseif ( $course_progress == 100 ) {
						$btn_advance_class = 'btn-advance-completed';
						$btn_advance_label = __( 'Completed', 'buddyboss-theme' );
					} else {
						$btn_advance_class = 'btn-advance-continue';
						$btn_advance_label = __( 'Continue', 'buddyboss-theme' );
						$resume_link       = buddyboss_theme()->learndash_helper()->boss_theme_course_resume( $course_id );
					}

					$login_model = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'login_mode_enabled' );
					$login_url   = apply_filters( 'learndash_login_url', ( $login_model === 'yes' ? '#login' : wp_login_url( get_the_permalink( $course_id ) ) ) );

					if ( $course_price_type == 'open' || $course_price_type == 'free' ) {
						if ( apply_filters( 'learndash_login_modal', true, $course_id, $current_user_id ) && ! is_user_logged_in() && $course_price_type != 'open' ):
							?>
                        <div class="learndash_join_button <?php echo $btn_advance_class; ?>">
                            <a href="<?php echo esc_url( $login_url ); ?>"
                               class="btn-advance"><?php echo __( 'Login to Enroll', 'buddyboss-theme' ); ?></a>
                            </div><?php
						else:
							if ( $course_price_type == 'free' && false === $is_enrolled ) {
								$button_text = LearnDash_Custom_Label::get_label( 'button_take_this_course' );
								?>
                            <div class="learndash_join_button <?php echo $btn_advance_class; ?>">
                                <form method="post">
                                    <input type="hidden" value="<?php echo $course_id; ?>" name="course_id"/>
                                    <input type="hidden" name="course_join"
                                           value="<?php echo wp_create_nonce( 'course_join_' . get_current_user_id() . '_' . $course_id ); ?>"/>
                                    <input type="submit" value="<?php echo $button_text; ?>" class="btn-join"
                                           id="btn-join"/>
                                </form>
                                </div><?php
							} else {
								?>
                                <div class="learndash_join_button <?php echo $btn_advance_class; ?>">
                                    <a href="<?php echo esc_url( $resume_link ); ?>"
                                       class="btn-advance"><?php echo $btn_advance_label; ?></a>
                                </div>
								<?php
							}
						endif;

						if ( $course_price_type == 'open' ) {
							?>
                            <span class="bb-course-type bb-course-type-open"><?php _e( 'Open Registration', 'buddyboss-theme' ); ?></span><?php
						} else {
							?>
                            <span class="bb-course-type bb-course-type-free"><?php _e( 'Free', 'buddyboss-theme' ); ?></span><?php
						}
					} elseif ( $course_price_type == 'closed' ) {
						$learndash_payment_buttons = learndash_payment_buttons( $course );
						if ( empty( $learndash_payment_buttons ) ):
							if ( false === $is_enrolled ) {
								echo '<span class="ld-status ld-status-incomplete ld-third-background ld-text">' . __( 'This course is currently closed', 'buddyboss-theme' ) . '</span>';
								if ( ! empty( $course_price ) ) {
									echo '<span class="bb-course-type bb-course-type-paynow">' . wp_kses_post( $course_pricing['price'] ) . '</span>';
								}
							} else { ?>
                                <div class="learndash_join_button <?php echo $btn_advance_class; ?>">
                                    <a href="<?php echo esc_url( $resume_link ); ?>"
                                       class="btn-advance"><?php echo $btn_advance_label; ?></a>
                                </div>
								<?php
							}
						else:
							?>
                            <div class="learndash_join_button <?php echo 'btn-advance-continue '; ?>"> <?php
								echo $learndash_payment_buttons; ?>
                            </div>
							<?php
							if ( ! empty( $course_price ) ) {
								echo '<span class="bb-course-type bb-course-type-paynow">' . wp_kses_post( $course_pricing['price'] ) . '</span>';
							}
						endif;
					} elseif ( $course_price_type == 'paynow' || $course_price_type == 'subscribe' ) {
						if ( false === $is_enrolled ) {
							$meta                = get_post_meta( $course_id, '_sfwd-courses', true );
							$course_price_type   = @$meta['sfwd-courses_course_price_type'];
							$course_price        = @$meta['sfwd-courses_course_price'];
							$course_no_of_cycles = @$meta['sfwd-courses_course_no_of_cycles'];
							$course_price        = @$meta['sfwd-courses_course_price'];
							$custom_button_url   = @$meta['sfwd-courses_custom_button_url'];
							$custom_button_label = @$meta['sfwd-courses_custom_button_label'];

							if ( $course_price_type == 'subscribe' && $course_price == '' ) {
								if ( empty( $custom_button_label ) ) {
									$button_text = LearnDash_Custom_Label::get_label( 'button_take_this_course' );
								} else {
									$button_text = esc_attr( $custom_button_label );
								}
								$join_button = '<div class="learndash_join_button"><form method="post">
								<input type="hidden" value="' . $course->ID . '" name="course_id" />
								<input type="hidden" name="course_join" value="' . wp_create_nonce( 'course_join_' . get_current_user_id() . '_' . $course->ID ) . '" />
								<input type="submit" value="' . $button_text . '" class="btn-join" id="btn-join" /></form></div>';
								echo $join_button;
							} else {
								echo learndash_payment_buttons( $course );
							}
						} else {
							?>
                        <div class="learndash_join_button <?php echo $btn_advance_class; ?>">
                            <a href="<?php echo esc_url( $resume_link ); ?>"
                               class="btn-advance"><?php echo $btn_advance_label; ?></a>
                            </div><?php
						}

						if ( apply_filters( 'learndash_login_modal', true, $course_id, $user_id ) && ! is_user_logged_in() ):
							echo '<span class="ld-status">' . __( 'or ', 'buddyboss-theme' ) . '<a class="ld-login-text" href="' . esc_attr( $login_url ) . '">' . __( 'Login', 'buddyboss-theme' ) . '</a></span>';
						endif;

						if ( false === $is_enrolled ) {
							if ( $course_price_type == 'paynow' ) {
								?><span class="bb-course-type bb-course-type-paynow">
								<?php
								echo wp_kses_post( '<span class="ld-currency">' . learndash_30_get_currency_symbol() . '</span> ' );
								echo wp_kses_post( $course_pricing['price'] ); ?></span>
								<?php
							} else {
								$course_price_billing_p3 = get_post_meta( $course_id, 'course_price_billing_p3', true );
								$course_price_billing_t3 = get_post_meta( $course_id, 'course_price_billing_t3', true );
								if ( $course_price_billing_t3 == 'D' ) {
									$course_price_billing_t3 = 'day(s)';
								} elseif ( $course_price_billing_t3 == 'W' ) {
									$course_price_billing_t3 = 'week(s)';
								} elseif ( $course_price_billing_t3 == 'M' ) {
									$course_price_billing_t3 = 'month(s)';
								} elseif ( $course_price_billing_t3 == 'Y' ) {
									$course_price_billing_t3 = 'year(s)';
								}
								?>
                                <span class="bb-course-type bb-course-type-subscribe">
								<?php
								if ( '' === $course_price && $course_price_type == 'subscribe' ) {
									?>
                                    <span class="bb-course-type bb-course-type-subscribe"><?php _e( 'Free', 'buddyboss-theme' ); ?></span>
									<?php
								} else {
									echo wp_kses_post( '<span class="ld-currency">' . learndash_30_get_currency_symbol() . '</span> ' );
									echo wp_kses_post( $course_pricing['price'] );
								}

								$recuring = ( '' === $course_price_billing_p3 ) ? 0 : $course_price_billing_p3;

								//if ( !empty( $course_price_billing_p3 ) ) { ?>
                                    <span class="course-bill-cycle"> / <?php echo $recuring . ' ' . $course_price_billing_t3; ?> </span><?php
									//} ?>
							</span>
								<?php
							}
						}
					} ?>
                </div>

				<?php
				$topics_count = 0;
				foreach ( $lesson_count as $lesson ) {
					$lesson_topics = learndash_get_topic_list( $lesson->ID );
					if ( $lesson_topics ) {
						$topics_count += sizeof( $lesson_topics );
					}
				}

				//course quizzes
				$course_quizzes       = learndash_get_course_quiz_list( $course_id );
				$course_quizzes_count = sizeof( $course_quizzes );

				//lessons quizzes
				if ( is_array( $lesson_count ) || is_object( $lesson_count ) ) {
					foreach ( $lesson_count as $lesson ) {
						$quizzes       = learndash_get_lesson_quiz_list( $lesson->ID, null, $course_id );
						$lesson_topics = learndash_topic_dots( $lesson->ID, false, 'array', null, $course_id );
						if ( $quizzes & ! empty( $quizzes ) ) {
							$course_quizzes_count += count( $quizzes );
						}
						if ( $lesson_topics && ! empty( $lesson_topics ) ) {
							foreach ( $lesson_topics as $topic ) {
								$quizzes = learndash_get_lesson_quiz_list( $topic, null, $course_id );
								if ( ! $quizzes || empty( $quizzes ) ) {
									continue;
								}
								$course_quizzes_count += count( $quizzes );
							}
						}
					}
				}

				if ( sizeof( $lesson_count ) > 0 || $topics_count > 0 || $course_quizzes_count > 0 || $course_certificate ) { ?>
                    <div class="bb-course-volume">
                    <h4><?php echo LearnDash_Custom_Label::get_label( 'course' ); ?> <?php _e( 'Includes',
							'buddyboss-theme' ); ?></h4>
                    <ul class="bb-course-volume-list">
						<?php if ( sizeof( $lesson_count ) > 0 ) { ?>
                            <li>
                                <i class="bb-icons bb-icon-book"></i><?php echo sizeof( $lesson_count ); ?> <?php echo sizeof( $lesson_count ) > 1 ? LearnDash_Custom_Label::get_label( 'lessons' ) : LearnDash_Custom_Label::get_label( 'lesson' ); ?>
                            </li>
						<?php } ?>
						<?php if ( $topics_count > 0 ) { ?>
                            <li>
                                <i class="bb-icons bb-icon-text"></i><?php echo $topics_count; ?> <?php echo $topics_count != 1 ? LearnDash_Custom_Label::get_label( 'topics' ) : LearnDash_Custom_Label::get_label( 'topic' ); ?>
                            </li>
						<?php } ?>
						<?php if ( $course_quizzes_count > 0 ) { ?>
                            <li>
                                <i class="bb-icons bb-icon-question-thin"></i><?php echo $course_quizzes_count; ?> <?php echo $course_quizzes_count != 1 ? LearnDash_Custom_Label::get_label( 'quizzes' ) : LearnDash_Custom_Label::get_label( 'quiz' ); ?>
                            </li>
						<?php } ?>
						<?php if ( $course_certificate ) { ?>
                            <li>
                                <i class="bb-icons bb-icon-badge"></i><?php echo LearnDash_Custom_Label::get_label( 'course' ); ?> <?php _e( 'Certificate',
									'buddyboss-theme' ); ?></li>
						<?php } ?>
                    </ul>
                    </div><?php
				} ?>
            </div>
        </div>
    </div>
</div>

<div class="bb-modal bb_course_video_details mfp-hide">
	<?php
	if ( $course_video_embed !== '' ) :
		if ( wp_oembed_get( $course_video_embed ) ) : ?><?php echo wp_oembed_get( $course_video_embed ); ?><?php elseif ( isset( $file_info['extension'] ) && $file_info['extension'] === 'mp4' ) : ?>
            <video width="100%" controls>
                <source src="<?php echo $course_video_embed; ?>" type="video/mp4">
				<?php _e( 'Your browser does not support HTML5 video.', 'buddyboss-theme' ); ?>
            </video>
		<?php
		else :
			_e( 'Video format is not supported, use Youtube video or MP4 format.', 'buddyboss-theme' );
		endif;
	endif; ?>
</div>
