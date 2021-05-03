<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="MyAccount-content--dashboard">
    <div class="wc-MyAccount-sub-heading">
        <h2>
        <?php
        printf(
    		__( 'Hello %1$s', 'buddyboss-theme' ),
    		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
    		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
    	);
        ?>
        </h2>
        <p>
        <?php
        printf(
    		__( 'not %1$s? <a href="%2$s">Log out</a>', 'buddyboss-theme' ),
    		esc_html( $current_user->display_name ),
    		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
    	);
        ?>
        </p>


        <p>
            <?php
		    printf(
			    __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'buddyboss-theme' ),
			    esc_url( wc_get_endpoint_url( 'orders' ) ),
			    esc_url( wc_get_endpoint_url( 'edit-address' ) ),
			    esc_url( wc_get_endpoint_url( 'edit-account' ) )
		    );
		    ?>
        </p>
    </div>
    <div class="wc-MyAccount-inner-content">
        
        <div class="wc-MyAccount-dashboard-block">
        <?php
        
        $my_orders_columns = apply_filters( 'woocommerce_my_account_my_orders_columns', array(
        	'order-number'  => __( 'Order', 'buddyboss-theme' ),
        	'order-date'    => __( 'Date', 'buddyboss-theme' ),
        	'order-status'  => __( 'Status', 'buddyboss-theme' ),
        	'order-total'   => __( 'Total', 'buddyboss-theme' ),
        	'order-actions' => '&nbsp;',
        ) );
        
        $customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
        	'numberposts' => 3,
        	'meta_key'    => '_customer_user',
        	'meta_value'  => get_current_user_id(),
        	'post_type'   => wc_get_order_types( 'view-orders' ),
        	'post_status' => array_keys( wc_get_order_statuses() ),
        ) ) );
        
        if ( $customer_orders ) : ?>
            <div class="wc-MyAccount-sub-heading">
                <h2><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Recent orders', 'buddyboss-theme' ) ); ?></h2>
            </div>
        	
            <div class="wc-MyAccount-inner-content">
            	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table account-orders-table-dashboard">
            
            		<thead>
            			<tr>
            				<?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
            					<th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
            				<?php endforeach; ?>
            			</tr>
            		</thead>
            
            		<tbody>
            			<?php 
                            $i = 0;
                            foreach ( $customer_orders as $customer_order ) :
                            if($i >= 3) {
                                break;
                            } else {
            				$order      = wc_get_order( $customer_order );
            				$item_count = $order->get_item_count();
            				?>
            				<tr class="order">
            					<?php foreach ( $my_orders_columns as $column_id => $column_name ) : ?>
            						<td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
            							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
            								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>
            
            							<?php elseif ( 'order-number' === $column_id ) : ?>
            								<span>
            									<?php echo _x( '#', 'hash before order number', 'buddyboss-theme' ) . $order->get_order_number(); ?>
            								</span>
            
            							<?php elseif ( 'order-date' === $column_id ) : ?>
            								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>
            
            							<?php elseif ( 'order-status' === $column_id ) : ?>
            								<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
            
            							<?php elseif ( 'order-total' === $column_id ) : ?>
            								<?php
            								/* translators: 1: formatted order total 2: total order items */
            								printf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'buddyboss-theme' ), $order->get_formatted_order_total(), $item_count );
            								?>
            
            							<?php elseif ( 'order-actions' === $column_id ) : ?>
            								<?php
            								$actions = wc_get_account_orders_actions( $order );
            								
            								if ( ! empty( $actions ) ) {
            									foreach ( $actions as $key => $action ) {
            										echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
            									}
            								}
            								?>
            							<?php endif; ?>
            						</td>
            					<?php endforeach; ?>
            				</tr>
            			<?php 
                        $i++;
                        } 
                        ?>     
                        <?php endforeach; ?>
            		</tbody>
            	</table>
            </div>
        <?php endif; ?>
        </div>
        
        <?php
        $customer_id = get_current_user_id();
        $user = get_userdata( $customer_id );

        if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
        	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
        		'billing' => __( 'Billing address', 'buddyboss-theme' ),
        		'shipping' => __( 'Shipping address', 'buddyboss-theme' ),
        	), $customer_id );
        } else {
        	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
        		'billing' => __( 'Billing address', 'buddyboss-theme' ),
        	), $customer_id );
        }
        
        $oldcol = 1;
        $col    = 1;
        ?>
        <div class="wc-DashBoard-address-wrapper">
            <?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
            	<div class="u-columns woocommerce-Addresses col2-set addresses">
            <?php endif; ?>
            
            <?php foreach ( $get_addresses as $name => $title ) : ?>
            
            	<div class="u-column<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?> col-<?php echo ( ( $oldcol = $oldcol * -1 ) < 0 ) ? 1 : 2; ?> woocommerce-Address">
            		<header class="woocommerce-Address-title title">
            			<h3><?php echo $title; ?></h3>
                        <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php _e( 'Edit', 'buddyboss-theme' ); ?></a>
            		</header>
            		<address><?php
            			$address = wc_get_account_formatted_address( $name );
            			echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'buddyboss-theme' );
            		?></address>
            	</div>
            
            <?php endforeach; ?>
            
            <?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
            	</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
