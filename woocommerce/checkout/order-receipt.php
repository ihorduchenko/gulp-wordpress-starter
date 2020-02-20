<?php
/**
 * Checkout Order Receipt Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-receipt.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="container-fluid px-0 px-md-3">

	<div class="woo-page--row row">
		<div class="col-12 woo-page--left mb-5">
			
			<div class="py-4">
				<h3 class="txt-h3 mb-2"><?php _e( 'Order Information', 'woocommerce' ); ?></h3>
				<div class="txt-p">
					<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details list-reset">

						<li class="woocommerce-order-overview__order order">
							<?php _e( 'Order number:', 'woocommerce' ); ?>
							<strong><?php echo $order->get_order_number(); ?></strong>
						</li>

						<li class="woocommerce-order-overview__date date">
							<?php _e( 'Date:', 'woocommerce' ); ?>
							<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
						</li>

						<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
							<li class="woocommerce-order-overview__email email">
								<?php _e( 'Email:', 'woocommerce' ); ?>
								<strong><?php echo $order->get_billing_email(); ?></strong>
							</li>
						<?php endif; ?>

						<li class="woocommerce-order-overview__total total">
							<?php _e( 'Total:', 'woocommerce' ); ?>
							<strong><?php echo $order->get_formatted_order_total(); ?></strong>
						</li>

						<?php if ( $order->get_payment_method_title() ) : ?>
							<li class="woocommerce-order-overview__payment-method method">
								<?php _e( 'Payment method:', 'woocommerce' ); ?>
								<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
							</li>
						<?php endif; ?>

					</ul>
				</div>
			</div>

			<?php $data_ship = $order->data['shipping']; ?>
			<?php $data_bill = $order->data['billing']; ?>

			<div class="py-4">
				<h3 class="txt-h3 mb-2"><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
				<div class="txt-p">
					<?php echo $data_ship['postcode']; ?><br>
					<?php echo $data_ship['address_1']; ?> <?php echo $data_ship['address_2']; ?><br>
					<?php echo $data_ship['city']; ?>, <?php echo $data_ship['country']; ?>
				</div>
			</div>

			<div class="py-4">
				<h3 class="txt-h3 mb-2"><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
				<div class="txt-p">
					<?php echo $data_bill['postcode']; ?><br>
					<?php echo $data_bill['address_1']; ?> <?php echo $data_ship['address_2']; ?><br>
					<?php echo $data_bill['city']; ?>, <?php echo $data_bill['country']; ?>
				</div>
			</div>

			<div class="py-4">
				<h3 class="txt-h3 mb-2"><?php _e( 'Contact', 'woocommerce' ); ?></h3>
				<div class="txt-p">
					<?php echo $data_ship['first_name']; ?> <?php echo $data_ship['last_name']; ?><br>
					<?php echo $data_bill['email']; ?><br>
					<?php echo $data_bill['phone']; ?>
				</div>
			</div>

			<div class="py-4 text-md-center">
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-link no-line"><?php esc_html_e( 'Edit', 'woocommerce' ); ?></a>
			</div>

		</div>

		<div class="col-12 woo-page--right pt-4">
			<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
			<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
			<div class="payment-proceed">
				<?php do_action( 'woocommerce_receipt_' . $order->get_payment_method(), $order->get_id() ); ?>
			</div>
		</div>

	</div>
</div>
<div class="clear"></div>