<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
    
    <h4 class="pr-sub-heading"><?php echo __( 'Specs', 'buddyboss-theme' ); ?></h4>
    
    <?php if ( $product->has_dimensions() ) : ?>
		<span class="dimensions_wrapper pr-atts-row">
			<span class="pr-atts-title"><?php _e( 'Dimensions:', 'buddyboss-theme' ) ?></span>
			<span class="product_dimensions"><?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?></span>
		</span>
	<?php endif; ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper pr-atts-row"><span class="pr-atts-title"><?php esc_html_e( 'SKU:', 'buddyboss-theme' ); ?></span> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'buddyboss-theme' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in pr-atts-row">' . _n( '<span class="pr-atts-title">Category:</span>', '<span class="pr-atts-title">Categories:</span>', count( $product->get_category_ids() ), 'buddyboss-theme' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as pr-atts-row">' . _n( '<span class="pr-atts-title">Tag:</span>', '<span class="pr-atts-title">Tags:</span>', count( $product->get_tag_ids() ), 'buddyboss-theme' ) . ' ', '</span>' ); ?>
    
    <?php
    $availability = $product->get_availability(); 
    if ( ! empty( $availability['availability'] ) ) { ?>
        <span class="sku_wrapper pr-atts-row"><span class="pr-atts-title"><?php echo __( 'Availability:', 'buddyboss-theme' ); ?></span><?php echo wc_get_stock_html( $product ); ?></span>
    <?php } ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>

<?php
$attributes = $product->get_attributes();
?>
<?php foreach ( $attributes as $attribute ) : ?>
    <?php
    $values = array();
    
    if ( $attribute->is_taxonomy() ) {
        $attribute_taxonomy = $attribute->get_taxonomy_object();
    	$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );
    }
    ?>
<?php endforeach; ?>
