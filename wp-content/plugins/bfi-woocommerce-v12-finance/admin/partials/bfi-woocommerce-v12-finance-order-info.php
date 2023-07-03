<?php
/**
 * Display the V12 Finance Details in the view order screen
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/admin/partials
 */
?>
<ul id="v12-status">
	<li><strong><?php echo __( 'V12 Application Status', 'woocommerce_v12retailfinance' ); ?>:</strong>
		<?php echo $v12_status; ?>
		<?php if ( ! in_array($v12_status, array('PaymentProcessed', 'Cancelled') ) ): ?>
			(<a href="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=order_list_v12_status_update&order_id=' . $the_order->id ), 'order-list-v12-status-update' ); ?>"><?php echo __( 'Check V12 Finance Status', 'woocommerce_v12retailfinance' ); ?></a>)
		<?php endif; ?>
	</li>
	<li><strong><?php echo __( 'V12 Application ID', 'woocommerce_v12retailfinance' ); ?>:</strong> <?php echo $order->v12_application_id; ?></li>
	<li><strong><?php echo __( 'Application GUID', 'woocommerce_v12retailfinance' ); ?>:</strong> <?php echo $order->v12_application_guid; ?></li>
	<li><strong><?php echo __( 'Finance Product', 'woocommerce_v12retailfinance' ); ?>:</strong> <?php echo $product->name; ?></li>
	<li><strong><?php echo __( 'Deposit Amount', 'woocommerce_v12retailfinance' ); ?>:</strong> <?php echo strip_tags( wc_price( $order->v12_deposit, array( 'currency' => $order->get_order_currency() ) ) ); ?></li>
</ul>
