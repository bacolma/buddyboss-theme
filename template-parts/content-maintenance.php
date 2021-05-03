<?php
/**
 * Template part for displaying maintenance content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

$maintenance_title = buddyboss_theme_get_option( 'maintenance_title' );
$maintenance_desc = buddyboss_theme_get_option( 'maintenance_desc' );
$maintenance_image_switch = buddyboss_theme_get_option( 'maintenance_image_switch' );
$maintenance_image = buddyboss_theme_get_option( 'maintenance_image' );

$maintenance_countdown = buddyboss_theme_get_option( 'maintenance_countdown' );
$maintenance_time = buddyboss_theme_get_option( 'maintenance_time' );

$maintenance_subscribe = buddyboss_theme_get_option( 'maintenance_subscribe' );
$maintenance_subscribe_title = buddyboss_theme_get_option( 'maintenance_subscribe_title' );
$maintenance_subscribe_shortcode = buddyboss_theme_get_option( 'maintenance_subscribe_shortcode' );

$maintenance_social_networks = buddyboss_theme_get_option( 'maintenance_social_networks' );

$social_network_twitter = buddyboss_theme_get_option( 'social_network_twitter' );
$social_network_facebook = buddyboss_theme_get_option( 'social_network_facebook' );
$social_network_google = buddyboss_theme_get_option( 'social_network_google' );
$social_network_instagram = buddyboss_theme_get_option( 'social_network_instagram' );
$social_network_youtube = buddyboss_theme_get_option( 'social_network_youtube' );

$contact_button = buddyboss_theme_get_option( 'contact_button' );
$contact_button_text = buddyboss_theme_get_option( 'contact_button_text' );
?>

<div id="page" class="site">

	<div id="content" class="site-content maintenance-content">

		<header class="page-header">
			<h1 class="page-title"><?php echo $maintenance_title; ?></h1>
			<p class="desc"><?php echo $maintenance_desc; ?></p>
		</header><!-- .page-header -->

		<div class="page-content">
			<?php if( $maintenance_image_switch ) { ?>
				<figure class="bb-maintenance-img">
					<?php
					if( isset( $maintenance_image['url'] ) ) {
					    $image = $maintenance_image['url'];
                        echo '<img src="'. $image .'" alt="" />';
					} else {
						echo '<img src="'. get_template_directory_uri().'/assets/images/svg/maintenance-img.svg" alt="" />';
					}
					?>
				</figure>
			<?php } ?>
			
			<?php if( $maintenance_countdown && !empty( $maintenance_time ) ) { ?>
				<div id="clockdiv" data-date="<?php echo $maintenance_time; ?>">
					<div>
					  <span class="days"></span>
					  <div class="smalltext">Days</div>
					</div><div>
					  <span class="hours"></span>
					  <div class="smalltext">Hours</div>
					</div><div>
					  <span class="minutes"></span>
					  <div class="smalltext">Minutes</div>
					</div><div>
					  <span class="seconds"></span>
					  <div class="smalltext">Seconds</div>
					</div>
				</div>
			<?php } ?>

			<?php if( $maintenance_subscribe ) { ?>
				<div class="bb-subscribe-form-wrap">
					<h3><?php echo $maintenance_subscribe_title; ?></h3>
					<?php echo do_shortcode( $maintenance_subscribe_shortcode ); ?>
				</div>
			<?php } ?>

			<div class="bb-social-icons">
				<?php if( !empty($social_network_twitter) ) { ?>
					<a href="<?php echo $social_network_twitter; ?>" target="_blank"><i class="bb-icon-rounded-twitter"></i></a>
				<?php } ?>
					
				<?php if( !empty($social_network_facebook) ) { ?>
					<a href="<?php echo $social_network_facebook; ?>" target="_blank"><i class="bb-icon-rounded-facebook"></i></a>
				<?php } ?>
					
				<?php if( !empty($social_network_google) ) { ?>
					<a href="<?php echo $social_network_google; ?>" target="_blank"><i class="bb-icon-rounded-google-plus"></i></a>
				<?php } ?>
                
                <?php if( !empty($social_network_instagram) ) { ?>
					<a href="<?php echo $social_network_instagram; ?>" target="_blank"><i class="bb-icon-rounded-instagram"></i></a>
				<?php } ?>
					
				<?php if( !empty($social_network_youtube) ) { ?>
					<a href="<?php echo $social_network_youtube; ?>" target="_blank"><i class="bb-icon-youtube-logo"></i></a>
				<?php } ?>

			</div>

			<?php
			if( !empty( $contact_button ) ) {
				echo '<p class="desc">'. $contact_button_text .'</p>';
			} ?>
		</div><!-- .page-content -->

	</div>

</div>

<?php if( $maintenance_countdown && !empty( $maintenance_time ) ) { ?>
	<script>
		function getTimeRemaining(endtime) {
			var t = Date.parse(endtime) - Date.parse(new Date());
			var seconds = Math.floor((t / 1000) % 60);
			var minutes = Math.floor((t / 1000 / 60) % 60);
			var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
			var days = Math.floor(t / (1000 * 60 * 60 * 24));
			return {
			  'total': t,
			  'days': days,
			  'hours': hours,
			  'minutes': minutes,
			  'seconds': seconds
			};
		}

		function initializeClock(id, endtime) {
			var clock = document.getElementById(id);
			var daysSpan = clock.querySelector('.days');
			var hoursSpan = clock.querySelector('.hours');
			var minutesSpan = clock.querySelector('.minutes');
			var secondsSpan = clock.querySelector('.seconds');

			function updateClock() {
			  var t = getTimeRemaining(endtime);
			  var appendZero = ( t.days < 10 ) ? '0' : '';

			  daysSpan.innerHTML = appendZero + t.days;
			  hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
			  minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
			  secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

			  if (t.total <= 0) {
				clearInterval(timeinterval);
			  }
			}

			updateClock();
			var timeinterval = setInterval(updateClock, 1000);
		}

		var clockDiv = document.getElementById('clockdiv');
		var curDate = new Date(Date.parse(new Date()) + 1000);
		var deadLine = new Date(clockDiv.getAttribute('data-date'));

		if( curDate > deadLine ) {
			deadLine = curDate;
		}

		initializeClock('clockdiv', deadLine);
	</script>
<?php } ?>
