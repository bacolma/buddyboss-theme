<?php
/**
 * Maintenance mode template that's shown to logged out users.
 */
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<link rel="profile" href="http://gmpg.org/xfn/11">

        <?php
        $rtl_css = is_rtl() ? '-rtl' : ''; 
        $minified_css = buddyboss_theme_get_option( 'boss_minified_css' );
        $mincss = $minified_css ? '.min' : '';
        ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css<?php echo $rtl_css; ?>/maintenance<?php echo $mincss; ?>.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/icons/bb-icons.css" />

		<title><?php _e('Down for Maintenance | ', 'buddyboss-theme'); ?><?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>

		<?php do_action( 'bb_maintenance_head' ); ?>
	</head>

	<body>
		<?php get_template_part( 'template-parts/content', 'maintenance' ); ?>
		<?php do_action( 'bb_maintenance_footer' ); ?>
	</body>
</html>
