<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BuddyBoss_Theme
 */
get_header();

$title       = sprintf( _x( '%s', '404 page title', 'buddyboss-theme' ), buddyboss_theme_get_option( '404_title' ) );
$desc        = sprintf( _x( '%s', '404 page description', 'buddyboss-theme' ), buddyboss_theme_get_option( '404_desc' ) );
$img         = buddyboss_theme_get_option( '404_image' );
$button_text = sprintf( _x( '%s', '404 page button text', 'buddyboss-theme' ), buddyboss_theme_get_option( '404_button_text' ) );
$button_link = buddyboss_theme_get_option( '404_button_link' );

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<section class="error-404 not-found text-center">
			<header class="page-header">
				<h1 class="page-title"><?php echo $title; ?></h1>
				<p class="desc"><?php echo $desc; ?></p>
			</header><!-- .page-header -->

			<div class="page-content">
				<figure class="bb-img-404">
					<?php
					if( $img['url'] ) {
                        echo '<img src="'. $img['url'] .'" alt="404" />';
					} else {
						echo '<img src="'. get_template_directory_uri().'/assets/images/svg/404-img.svg" alt="404" />';
					}
					?>
				</figure>

				<?php
				if( !empty($button_text) || !empty($button_link) ) {
					echo '<p><a class="button" href="'.$button_link.'">' . $button_text . '</a></p>';
				} ?>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
