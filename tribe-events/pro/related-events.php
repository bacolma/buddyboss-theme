<?php
/**
 * Related Events Template
 * The template for displaying related events on the single event page.
 *
 * You can recreate an ENTIRELY new related events view by doing a template override, and placing
 * a related-events.php file in a tribe-events/pro/ directory within your theme directory, which
 * will override the /views/pro/related-events.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters
 *
 * @package TribeEventsCalendarPro
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$posts = tribe_get_related_posts();

if ( is_array( $posts ) && ! empty( $posts ) ) : ?>

<h3 class="tribe-events-related-events-title"><?php printf( __( 'Related %s', 'buddyboss-theme' ), tribe_get_event_label_plural() ); ?></h3>

<ul class="tribe-related-events tribe-clearfix">
	<?php foreach ( $posts as $post ) : ?>
	<li>
		<?php $thumb = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail( $post->ID, 'large' ) : '<div class="bs-events-related-placeholder"></div>'; ?>
		<div class="tribe-related-events-thumbnail">
			<a href="<?php echo esc_url( tribe_get_event_link( $post ) ); ?>" class="url" rel="bookmark"><?php echo $thumb ?></a>
		</div>
		<div class="tribe-related-event-info">
            <div class="bs-event-heading">
                <div class="tribe-event-schedule-short">
                    <div class="bs-schedule-short-date">
                        <span class="bs-schedule-short-m"><?php echo tribe_get_start_date($post->ID, true, 'M'); ?></span>
                        <span class="bs-schedule-short-d"><?php echo tribe_get_start_date($post->ID, true, 'j'); ?></span>
                    </div>
                </div>
                <div class="tribe-event-schedule-long">
                    <div class="bs-tribe-events-single-heading">
                        <div class="bs-tribe-related-events-schedule-details">
                        <?php
            				if ( $post->post_type == Tribe__Events__Main::POSTTYPE ) {
            					echo tribe_events_event_schedule_details( $post );
            				}
            			?>
                        </div>
                        <h3 class="tribe-related-events-title"><a href="<?php echo tribe_get_event_link( $post ); ?>" class="tribe-event-url" rel="bookmark"><?php echo get_the_title( $post->ID ); ?></a></h3>
                        <div class="bs-related-location">
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
		</div>
	</li>
	<?php endforeach; ?>
</ul>
<?php
endif;
