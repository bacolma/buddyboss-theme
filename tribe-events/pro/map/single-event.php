<?php
/**
 * Map View Single Event
 * This file contains one event in the map
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/map/single_event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $post;

$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue         = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';
?>

<div class="bs-tribe-events-col bs-tribe-events-col-first">
    <!-- Event Image -->
    <?php if (has_post_thumbnail( ) ) {
        echo tribe_event_featured_image( null, 'medium' );
    } else {
        echo '<div class="bs-events-post-placeholder"></div>';
    } 
    ?>
</div>
<div class="bs-tribe-events-col bs-tribe-events-col-last">

    <div class="bs-event-heading">
        <div class="tribe-event-schedule-short">
            <div class="bs-schedule-short-date">
                <span class="bs-schedule-short-m"><?php echo tribe_get_start_date(null, true, 'M'); ?></span>
                <span class="bs-schedule-short-d"><?php echo tribe_get_start_date(null, true, 'j'); ?></span>
            </div>
        </div>
        <div class="tribe-event-schedule-long">
            <div class="bs-tribe-events-single-heading">
                <!-- Schedule & Recurrence Details -->
            	<div class="published time-details">
            		<?php echo tribe_events_event_schedule_details() ?>
            	</div>
                
                <!-- Event Title -->
                <?php do_action( 'tribe_events_before_the_event_title' ) ?>
                
                <!-- Event Distance -->
                <?php echo tribe_event_distance(); ?>
                
                <h2 class="tribe-events-map-event-title">
                	<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
                		<?php the_title() ?>
                	</a>
                </h2>
                <?php do_action( 'tribe_events_after_the_event_title' ) ?>
                
                <!-- Event Meta -->
                <?php do_action( 'tribe_events_before_the_meta' ) ?>
                <div class="tribe-events-event-meta <?php echo esc_attr( $has_venue . $has_venue_address ); ?>">
                
                	<?php if ( $venue_details ) : ?>
                		<!-- Venue Display Info -->
                		<div class="tribe-events-venue-details">
                			<?php echo implode( ', ', $venue_details ); ?>
                		</div> <!-- .tribe-events-venue-details -->
                	<?php endif; ?>
                
                </div><!-- .tribe-events-event-meta -->
                <?php do_action( 'tribe_events_after_the_meta' ) ?>
            </div>
            <!-- Event Cost -->
            <?php if ( tribe_get_cost() ) : ?>
            	<div class="tribe-events-event-cost">
            		<span><?php echo tribe_get_cost( null, true ); ?></span>
            	</div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Event Content -->
    <?php do_action( 'tribe_events_before_the_content' ) ?>
    <div class="tribe-events-map-event-description tribe-events-content description entry-summary">
    	<?php echo tribe_events_get_the_excerpt() ?>
    	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'buddyboss-theme' ) ?> &raquo;</a>
    </div><!-- .tribe-events-map-event-description -->
    <?php
    do_action( 'tribe_events_after_the_content' );
    ?>
</div>
