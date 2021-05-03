<?php
/**
 * Day View Loop
 * This file sets up the structure for the day loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/loop.php
 *
 * @version 4.4
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $more, $post, $wp_query;
$more = false;
$current_timeslot = null;

?>

<div id="tribe-events-day" class="tribe-events-loop">
    <div class="tribe-events-day-time-slot">
        <h5></h5>
        <section class="bs-events-day-wrap bs-events-day-tag-wrap">
            <div>
                <!-- List Title -->
                <?php do_action( 'tribe_events_before_the_title' ); ?>
                <h2 class="tribe-events-page-title"><?php echo tribe_get_events_title() ?></h2>
                <?php do_action( 'tribe_events_after_the_title' ); ?>
            </div>
        </section>
    </div>
	<div class="tribe-events-day-time-slot">

	<?php while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'tribe_events_inside_before_loop' ); ?>

		<?php if ( $current_timeslot != $post->timeslot ) :
		$current_timeslot = $post->timeslot; ?>
	</div>
	<!-- .tribe-events-day-time-slot -->

	<div class="tribe-events-day-time-slot">
		<h5><?php echo $current_timeslot; ?></h5>
        <section class="bs-events-day-wrap">
		<?php endif; ?>

		<!-- Event  -->
		<div id="post-<?php the_ID() ?>" data-id="<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
			<?php
			$event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

			/**
			 * Filters the event type used when selecting a template to render
			 *
			 * @param $event_type
			 */
			$event_type = apply_filters( 'tribe_events_day_view_event_type', $event_type );

			tribe_get_template_part( 'day/single', $event_type );
			?>
		</div>

		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
        <?php if ( $current_timeslot != $post->timeslot ) : ?>
        </section>
		<?php endif; ?>
	<?php endwhile; ?>

	</div>
	<!-- .tribe-events-day-time-slot -->
</div><!-- .tribe-events-loop -->
