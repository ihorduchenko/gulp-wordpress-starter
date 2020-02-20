<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-checkout-review-order-table">

	<div class="border-top py-4">
		<a href="#collapseCheckoutCart" class="txt-h2 d-flex flex-wrap text-decoration-none pr-2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseCheckoutCart">
			<span><?php echo WC()->cart->get_cart_contents_count(); ?> <?php _e( 'Items in cart', 'woocommerce' ); ?></span>
			<span class="collapse-indicator ml-auto">↓</span>
		</a>
	</div>
	<div id="collapseCheckoutCart" class="collapse">
		<?php do_action( 'woocommerce_review_order_before_cart_contents' ); ?>
			<div class="cart-items border-top">
				<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
						$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$thumbnail_url_sm     = get_the_post_thumbnail_url($product_id, 'thumbnail') ? get_the_post_thumbnail_url($product_id, 'thumbnail') : get_the_post_thumbnail_url($product_id);
	          $thumbnail_url     = get_the_post_thumbnail_url($product_id);
						$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<div class="cart-item w-100 p-0 woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<a href="<?php echo esc_url( $product_permalink ); ?>"
								class="cart-item--thumb d-block bg-cover bgReplace"
								data-orig-bg="<?php echo $thumbnail_url; ?>"
								style="background-image: url(<?php echo $thumbnail_url_sm; ?>);">
								<span class="sr-only"><?php echo $product_name; ?></span>
							</a>
							<div class="cart-item--body d-inline-flex flex-wrap flex-column py-2 py-md-3 px-2 txt-tech">
								<h3 class="txt-tech w-100 mb-1"><?php echo $product_name; ?></h3>
								<div class="w-100 cl-muted">
									<?php echo $product_price; ?>
								</div>
								<div class="w-100 mt-auto">
									<?php esc_html_e( 'Size', 'woocommerce' ); ?>: <?php echo $_product -> get_attribute( 'pa_size' ); ?><br>
									<?php esc_html_e( 'Quantity', 'woocommerce' ); ?>: <?php echo $cart_item['quantity']; ?><br>
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
								</div>
							</div>
							<div class="cart-item--actions text-center py-3 d-none">
								<div class="test">
									<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="btn-close mod-small checkout-remove-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="sr-only">Remove item</i><span class="btn-close--line l-1"></span><span class="btn-close--line l-2"></span></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key ); ?>
								</div>
							</div>

							<div class="d-none product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
								<?php if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $_product->get_max_purchase_quantity(),
										'min_value'    => '0',
										'product_name' => $_product->get_name(),
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok. ?>
							</div>

							<div class="product-subtotal d-none" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
							</div>
						</div>
						<?php
					}
				} ?>
			</div>
		<?php do_action( 'woocommerce_review_order_after_cart_contents' ); ?>
	</div>

	<table class="shop_table mb-4">
		<tfoot>
			<tr class="cart-subtotal">
				<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>

			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

			<?php endif; ?>

			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th><?php echo esc_html( $fee->name ); ?></th>
					<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
				<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
							<th><?php echo esc_html( $tax->label ); ?></th>
							<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
						<td><?php wc_cart_totals_taxes_total_html(); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

			<tr class="order-total">
				<th><?php _e( 'Total', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</tfoot>
	</table>

</div>

