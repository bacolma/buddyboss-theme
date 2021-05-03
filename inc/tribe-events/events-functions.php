<?php
/**
 * Functions which enhance the events calendar by hooking into tribe events
 *
 * @package BuddyBoss_Theme
 */


add_filter( 'tribe_events_ical_export_text', 'bs_tribe_ical_export_custom_text' );
function bs_tribe_ical_export_custom_text() {
  return __( 'Export Events', 'buddyboss-theme' );
}
