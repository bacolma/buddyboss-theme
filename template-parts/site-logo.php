<?php
// Site Logo
$show		 = buddyboss_theme_get_option( 'logo_switch' );
$logo_id	 = buddyboss_theme_get_option( 'logo', 'id' );
$logo		 = ( $show && $logo_id ) ? wp_get_attachment_image( $logo_id, 'full', '', array( 'class' => 'bb-logo' ) ) : get_bloginfo( 'name' );

// This is for better SEO
$elem = ( is_front_page() && is_home() ) ? 'h1' : 'h2';
?>

<div id="site-logo" class="site-branding">
	<<?php echo $elem; ?> class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php echo $logo; ?>
		</a>
	</<?php echo $elem; ?>>
</div>