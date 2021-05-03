<?php
$footer_widgets = buddyboss_theme_get_option( 'footer_widgets' );
$footer_widgets_columns = buddyboss_theme_get_option( 'footer_widget_columns' );
$footer_copyright = buddyboss_theme_get_option( 'footer_copyright' ); ?>

<?php if ( $footer_widgets ) {
	if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' )  || is_active_sidebar( 'footer-5' ) ) : ?>
		<div class="footer-widget-area bb-footer">
			<div class="container">
				<div class="bb-grid">
					<?php if ( is_active_sidebar('footer-1') && $footer_widgets_columns >= '1' ) : ?>
						<div class="footer-widget area-1">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div><!-- .footer-widget -->
					<?php endif; ?>

					<?php if ( is_active_sidebar('footer-2') && $footer_widgets_columns >= '2' ) : ?>
						<div class="footer-widget area-2">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div><!-- .footer-widget -->
					<?php endif; ?>

					<?php if ( is_active_sidebar('footer-3') && $footer_widgets_columns >= '3' ) : ?>
						<div class="footer-widget area-3">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div><!-- .footer-widget -->
					<?php endif; ?>

					<?php if ( is_active_sidebar('footer-4') && $footer_widgets_columns >= '4' ) : ?>
						<div class="footer-widget area-4">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div><!-- .footer-widget -->
					<?php endif; ?>

					<?php if ( is_active_sidebar('footer-5') && $footer_widgets_columns >= '5' ) : ?>
						<div class="footer-widget area-5">
							<?php dynamic_sidebar( 'footer-5' ); ?>
						</div><!-- .footer-widget -->
					<?php endif; ?>
				</div>
			</div><!-- .widget-area -->
		</div>
	<?php endif;
} ?>

<?php if ( $footer_copyright ) { ?>
	<footer class="footer-bottom bb-footer style-<?php echo buddyboss_theme_get_option( 'footer_style' ); ?>">
		<div class="container flex">
			<?php
			$copyright_text = buddyboss_theme_get_option( 'copyright_text' );
			$footer_menu = buddyboss_theme_get_option( 'footer_menu' );
			$footer_secondary_menu = buddyboss_theme_get_option( 'footer_secondary_menu' );
			$footer_socials = buddyboss_theme_get_option( 'boss_footer_social_links' );
			$footer_description = buddyboss_theme_get_option( 'footer_description' );
			$footer_tagline = buddyboss_theme_get_option( 'footer_tagline' );

			if( !empty( $copyright_text ) || !empty( $footer_menu ) ) {
				echo '<div class="footer-bottom-left">';

				if( buddyboss_theme_get_option( 'footer_style' ) == '2' ) {
					$logo_id = buddyboss_theme_get_option( 'footer_logo', 'id' );
					$logo = ( $logo_id ) ? wp_get_attachment_image( $logo_id, 'full' ) : get_bloginfo( 'name' );
					?>
					<div class="footer-logo-wrap">
						<a class="footer-loto" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php echo $logo; ?>
						</a><?php

						if( !empty( $footer_tagline ) ) {
							echo '<span class="footer-tagline">' . $footer_tagline . '</span>';
						} ?>
					</div><?php
				}

				if( !empty( $footer_menu ) && buddyboss_theme_get_option( 'footer_style' ) == '1' ) {
					wp_nav_menu( array(
						'menu' 		=> $footer_menu,
						'container'	=> false,
						'menu_class'=> 'footer-menu',
						'depth' => 1)
					);
				}

				if( !empty( $footer_secondary_menu ) ) {
					echo '<div class="footer-copyright-wrap">';
				}
				
				if( !empty( $copyright_text ) ) { ?>
					<div class="copyright"><?php echo do_shortcode( $copyright_text ); ?></div><?php
				}

				if( !empty( $footer_secondary_menu ) ) {
					wp_nav_menu( array(
						'menu' 		=> $footer_secondary_menu,
						'container'	=> false,
						'menu_class'=> 'footer-menu secondary',
						'depth' => 1)
					);
				}
				
				if( !empty( $footer_secondary_menu ) ) {
					echo '</div>';
				}

				echo '</div>';
			}
			
			$container_set = false;
			if( !empty( $footer_socials ) || !empty( $footer_description ) ) {
				echo '<div class="footer-bottom-right push-right">';

					foreach ( $footer_socials as $network => $url ) {
						if ( ! empty( $url ) ) {
							if ( ! $container_set ) {
								echo '<ul class="footer-socials">';
								$container_set = true;
							}
							if ( 'email' === $network ) {
								echo '<li><a href="mailto:' . sanitize_email( $url ) . '" target="_top"><i class="bb-icon-rounded-' . $network . '"></i></a></li>';
							} else {
								echo '<li><a href="' . esc_url( $url ) . '" target="_blank"><i class="bb-icon-rounded-' . $network . '"></i></a></li>';
                            }
						}
					}
					
					if( $container_set ){
						echo '</ul>';
					}

					if ( !empty( $footer_description ) ) {
						echo '<div class="footer-desc">' . wpautop( do_shortcode( $footer_description ) ) . '</div>';
					}

				echo '</div>';
			}
			?>
		</div>
	</footer>
<?php } ?>