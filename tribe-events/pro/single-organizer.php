<?php
/**
 * Single Organizer Template
 * The template for an organizer. By default it displays organizer information and lists
 * events that occur with the specified organizer.
 *
 * This view contains the filters required to create an effective single organizer view.
 *
 * You can recreate an ENTIRELY new single organizer view by doing a template override, and placing
 * a Single_Organizer.php file in a tribe-events/pro/ directory within your theme directory, which
 * will override the /views/pro/single_organizer.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters (TO-DO)
 *
 * @package TribeEventsCalendarPro
 *
 * @version 4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$organizer_id = get_the_ID();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<div class="tribe-events-organizer">
			<h1 class="page-title"><?php echo __( 'Organizer', 'buddyboss-theme' ); ?></h1>
        
        <div class="bs-organizer-wrap">
    		
    		<div class="tribe-events-organizer-meta bs-organizer-meta tribe-clearfix">
                <p class="tribe-events-back">
    				<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php printf( __( '<i class="bb-icon-angle-left"></i> Back to %s', 'buddyboss-theme' ), tribe_get_event_label_plural() ); ?></a>
    			</p>
                <?php do_action( 'tribe_events_single_organizer_before_organizer' ) ?>
                <div class="bs-organizer-cols">
                    <div class="bs-organize-col bs-organize-col1">
                        <!-- Organizer Title -->
                        <div class="bs-organize-sq-fi"><?php echo tribe_event_featured_image( null, 'full' ) ?></div>
                        
                        <div class="bs-organize-sq-wr">
            				<?php do_action( 'tribe_events_single_organizer_before_title' ) ?>
            				<h2 class="tribe-organizer-name"><?php echo tribe_get_organizer( $organizer_id ); ?></h2>
                            <h4 class="tribe-organizer-label"><?php echo __( 'Organizer', 'buddyboss-theme' ); ?></h4>
            				<?php do_action( 'tribe_events_single_organizer_after_title' ) ?>
            
            				<!-- Organizer Meta -->
            				<?php do_action( 'tribe_events_single_organizer_before_the_meta' ); ?>
            				<?php echo tribe_get_organizer_details(); ?>
            				<?php do_action( 'tribe_events_single_organizer_after_the_meta' ) ?>
                            
                            <!-- Organizer Content -->
            				<?php if ( get_the_content() ) { ?>
            				<div class="tribe-organizer-description tribe-events-content">
            					<?php the_content(); ?>
            				</div>
            				<?php } ?>
                        </div>
                    </div>
                </div>
                <!-- .tribe-events-organizer-meta -->
                <?php do_action( 'tribe_events_single_organizer_after_organizer' ) ?>
            </div>
 			
            <div class="bs-organizer-up-events">
                <h4 class="bs-organizer-up-label"><?php echo __( 'Upcoming Events', 'buddyboss-theme' ); ?></h4>
    
        		<!-- Upcoming event list -->
        		<?php do_action( 'tribe_events_single_organizer_before_upcoming_events' ) ?>
        
        		<?php
        		// Use the tribe_events_single_organizer_posts_per_page to filter the number of events to get here.
        		echo tribe_organizer_upcoming_events( $organizer_id ); ?>
        
        		<?php do_action( 'tribe_events_single_organizer_after_upcoming_events' ) ?>
            </div>
        </div>

	</div><!-- .tribe-events-organizer -->
	<?php
	do_action( 'tribe_events_single_organizer_after_template' );
endwhile;
