<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.3
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

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
        		<div class="tribe-event-schedule-details">
        			<?php echo tribe_events_event_schedule_details() ?>
        		</div>
                
                <!-- Event Title -->
                <?php do_action( 'tribe_events_before_the_event_title' ) ?>
                <h2 class="tribe-events-list-event-title">
                	<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
                		<?php the_title() ?>
                	</a>
                </h2>
                <?php do_action( 'tribe_events_after_the_event_title' ) ?>
                
                <!-- Event Meta -->
                <?php do_action( 'tribe_events_before_the_meta' ) ?>
                <div class="tribe-events-event-meta">
                	<div class="author <?php echo esc_attr( $has_venue_address ); ?>">
                
                		<?php if ( $venue_details ) : ?>
                			<!-- Venue Display Info -->
                			<div class="tribe-events-venue-details">
                			<?php
                				$address_delimiter = empty( $venue_address ) ? ' ' : ', ';
                
                				// These details are already escaped in various ways earlier in the process.
                				echo implode( $address_delimiter, $venue_details );
                
                				if ( tribe_show_google_map_link() ) {
                					echo tribe_get_map_link_html();
                				}
                			?>
                			</div> <!-- .tribe-events-venue-details -->
                		<?php endif; ?>
                
                	</div>
                </div><!-- .tribe-events-event-meta -->
                <?php do_action( 'tribe_events_after_the_meta' ) ?>
            </div>
            
            <!-- Event Cost -->
            <?php if ( tribe_get_cost() ) : ?>
            	<div class="tribe-events-event-cost">
            		<span class="ticket-cost"><?php echo tribe_get_cost( null, true ); ?></span>
            		<?php
            		/**
            		 * Runs after cost is displayed in list style views
            		 *
            		 * @since 4.5
            		 */
            		do_action( 'tribe_events_inside_cost' )
            		?>
            	</div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Event Content -->
    <?php do_action( 'tribe_events_before_the_content' ); ?>
    <div class="tribe-events-list-event-description tribe-events-content description entry-summary">
    	<?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?>
    	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'buddyboss-theme' ) ?> &raquo;</a>
    </div><!-- .tribe-events-list-event-description -->
    <?php
    do_action( 'tribe_events_after_the_content' );
    ?>
</div>
