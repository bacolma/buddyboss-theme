<div id="theme-hello-backdrop" style="display: none;"></div>

<div id="theme-hello-container" class="theme-hello-appboss" role="dialog" aria-labelledby="theme-hello-title" style="display: none;">
	<div class="theme-hello-header" role="document">
		<div class="theme-hello-close">
			<button type="button" class="close-modal button theme-tooltip" data-theme-tooltip-pos="down" data-theme-tooltip="<?php esc_attr_e( 'Close pop-up', 'buddyboss-theme' ); ?>">
				<?php esc_html_e( 'Close', 'buddyboss-theme' ); ?>
			</button>
		</div>

		<div class="theme-hello-title">
			<h1 id="theme-hello-title" tabindex="-1"><?php esc_html_e( 'Welcome to BuddyBoss', 'buddyboss-theme' ); ?></h1>
		</div>
	</div>

	<div class="theme-hello-content">

		<div class="video-wrapper">
			<div class="video-container">
				<iframe src="https://player.vimeo.com/video/338221385?byline=0&portrait=0&autoplay=1" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>

	</div>

	<div class="theme-hello-footer">
		<div class="theme-hello-social-cta">
			<p>
				<?php
				printf(
					__( '<span>Built by </span><a href="%s">BuddyBoss</a><span>.</span>', 'buddyboss-theme' ),
					esc_url( 'https://www.buddyboss.com/' )
				);
				?>
			</p>
		</div>

		<div class="theme-hello-social-links">
			<ul class="theme-hello-social">
				<li>
					<?php
					printf(
						'<a class="youtube theme-tooltip" data-theme-tooltip-pos="up" data-theme-tooltip="%1$s" href="%2$s"><span class="screen-reader-text">%3$s</span></a>',
						esc_attr( 'Follow BuddyBoss on YouTube', 'buddyboss-theme' ),
						esc_url( 'https://www.youtube.com/c/BuddybossWP' ),
						esc_html( 'Follow BuddyBoss on YouTube', 'buddyboss-theme' )
					);
					?>
				</li>

				<li>
					<?php
					printf(
						'<a class="twitter theme-tooltip" data-theme-tooltip-pos="up" data-theme-tooltip="%1$s" href="%2$s"><span class="screen-reader-text">%3$s</span></a>',
						esc_attr( 'Follow BuddyBoss on Twitter', 'buddyboss-theme' ),
						esc_url( 'https://twitter.com/BuddyBossWP' ),
						esc_html( 'Follow BuddyBoss on Twitter', 'buddyboss-theme' )
					);
					?>
				</li>

				<li>
					<?php
					printf(
						'<a class="facebook theme-tooltip" data-theme-tooltip-pos="up" data-theme-tooltip="%1$s" href="%2$s"><span class="screen-reader-text">%3$s</span></a>',
						esc_attr( 'Follow BuddyBoss on Facebook', 'buddyboss-theme' ),
						esc_url( 'https://facebook.com/BuddyBossWP/' ),
						esc_html( 'Follow BuddyBoss on Facebook', 'buddyboss-theme' )
					);
					?>
				</li>
			</ul>
		</div>
	</div>
</div>
