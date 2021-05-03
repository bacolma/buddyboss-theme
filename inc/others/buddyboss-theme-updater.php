<?php
/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * * Register licensed ID for BuddyBoss theme
 *
 * @since 2.6.0
 *
 * @param string $packages Full path to the target mofile.
 *
 * @return string $packages
 */
function buddyboss_theme_register_licensed_package( $packages = array() ) {
	$this_package                = array(
		'id'       => 'buddyboss_theme',
		'name'     => __( 'BuddyBoss Theme', 'buddyboss-theme' ),
		'products' => array(
			// key should be unique for every individual buddyboss product
			// and if product X is included in 2 different packages, key for product X must be same in both packages.
			'BB_THEME' => array(
				'software_ids' => array( 'BB_THEME_1S', 'BB_THEME_5S', 'BB_THEME_10S' ),
				'name'         => 'BuddyBoss Theme',
			),
		),
	);
	$packages['buddyboss_theme'] = $this_package;
	return $packages;
}
add_filter( 'bboss_licensed_packages', 'buddyboss_theme_register_licensed_package' );

/**
 * * Register licensed ID for BuddyBoss theme
 *
 * @since 2.6.0
 *
 * @param string $products Full path to the target mofile.
 *
 * @return string $products
 */
function buddyboss_theme_register_updatable_product( $products ) {
	// key should be exactly the same as product key above.
	$products['BB_THEME'] = array(
		'path'          => basename( get_template_directory() ),
		'id'            => 867,
		'software_ids'  => array( 'BB_THEME_1S', 'BB_THEME_5S', 'BB_THEME_10S' ),
		'type'          => 'theme',
		'releases_link' => 'https://www.buddyboss.com/resources/buddyboss-theme-releases/',
	);
	return $products;
}
add_filter( 'bboss_updatable_products', 'buddyboss_theme_register_updatable_product' );
