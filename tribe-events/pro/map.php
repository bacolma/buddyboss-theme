<?php
/**
 * Map View Template
 * The wrapper template for map view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/map.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php do_action( 'tribe_events_before_template' ); ?>

<!-- List Title -->
<?php do_action( 'tribe_events_before_the_title' ); ?>
<h2 class="tribe-events-page-title"><?php _e( 'Events', 'buddyboss-theme' ); ?></h2>
<?php do_action( 'tribe_events_after_the_title' ); ?>

<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

<div class="bs-map-wrap">
    <!-- Google Map Container -->
    <?php tribe_get_template_part( 'pro/map/gmap-container' ) ?>
    
    <!-- Main Events Content -->
    <?php tribe_get_template_part( 'pro/map/content' ) ?>
</div>

<div class="tribe-clear"></div>

<?php
do_action( 'tribe_events_after_template' );
