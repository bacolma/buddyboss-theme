<?php
/**
 * Photo View Single Event
 * This file contains one event in the photo view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/photo/single_event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $post;

?>

<div class="tribe-events-photo-event-wrap">

    <?php if (has_post_thumbnail( ) ) {
        echo tribe_event_featured_image( null, 'medium' );
    } else {
        echo '<div class="bs-events-post-placeholder"></div>';
    } 
    ?>

	<div class="tribe-events-event-details tribe-clearfix">
    
        <div class="bs-event-heading">
            <div class="tribe-event-schedule-short">
                <div class="bs-schedule-short-date">
                    <span class="bs-schedule-short-m"><?php echo tribe_get_start_date(null, true, 'M'); ?></span>
                    <span class="bs-schedule-short-d"><?php echo tribe_get_start_date(null, true, 'j'); ?></span>
                </div>
            </div>
            <div class="tribe-event-schedule-long">
                <div class="bs-tribe-events-single-heading">
                    <!-- Event Meta -->
            		<?php do_action( 'tribe_events_before_the_meta' ); ?>
            		<div class="tribe-events-event-meta">
            			<div class="tribe-event-schedule-details">
            				<?php if ( ! empty( $post->distance ) ) : ?>
            					<strong>[<?php echo tribe_get_distance_with_unit( $post->distance ); ?>]</strong>
            				<?php endif; ?>
            				<?php echo tribe_events_event_schedule_details(); ?>
            			</div>
            		</div><!-- .tribe-events-event-meta -->
            		<?php do_action( 'tribe_events_after_the_meta' ); ?>
                    
                    <!-- Event Title -->
            		<?php do_action( 'tribe_events_before_the_event_title' ); ?>
            		<h2 class="tribe-events-list-event-title">
            			<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
            				<?php the_title(); ?>
            			</a>
            		</h2>
            		<?php do_action( 'tribe_events_after_the_event_title' ); ?>
                    <div class="bs-photo-location">
                    <?php 
                    $venue_details = tribe_get_venue_details($post->ID);
                    if ( $venue_details ) : ?>
            			<!-- Venue Display Info -->
            			<div class="tribe-events-venue-details">
            			<?php
            				//$address_delimiter = empty( $venue_address ) ? ' ' : ', ';
            				echo $venue_details[address];
            			?>
            			</div> <!-- .tribe-events-venue-details -->
            		<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="tribe-events-list-photo-description tribe-events-content">
			<?php echo tribe_events_get_the_excerpt() ?>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ) ?>

	</div><!-- /.tribe-events-event-details -->

</div><!-- /.tribe-events-photo-event-wrap -->
