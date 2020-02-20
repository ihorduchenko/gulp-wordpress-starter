<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<section class="py-4">
	<div class="container-fluid px-0 px-md-3">
    <nav class="woo-page--nav txt-h2 mb-4">
      <?php wp_nav_menu(
        array(
          'theme_location'  => 'checkout',
          'container'       => false,
          'menu_id'         => false,
          'menu_class'      => '',
          'depth'           => 1
        )
      ); ?>
    </nav>
		<div class="woo-page--row row">
			<div class="col-12 woo-page--left mb-5">
				<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
					<?php do_action( 'woocommerce_before_cart_table' ); ?>

					<div class="cart woocommerce-cart-form__contents border-top">
            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
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
                  <div class="cart-item--actions text-center py-3">
                    <div class="product-remove">
                      <?php
                      echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="remove_from_cart_button btn-close mod-small" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="sr-only">Remove item</i><span class="btn-close--line l-1"></span><span class="btn-close--line l-2"></span></a>',
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

            <?php do_action( 'woocommerce_cart_contents' ); ?>

              <div class="actions mt-5">

                <?php if ( wc_coupons_enabled() ) { ?>
                  <div class="coupon row align-items-center">
                    <div class="col-8">
                      <input type="text" name="coupon_code" class="input-text ss-input" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Promocode', 'woocommerce' ); ?>" />
                    </div>
                    <div class="col-4">
                      <button type="submit" class="ss-btn ss-btn--muted ss-btn--big auto-width w-100" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
	                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                  </div>
                <?php } ?>

                <button type="submit" class="ss-btn ss-btn-main d-none" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                <?php do_action( 'woocommerce_cart_actions' ); ?>

                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
              </div>

            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</div>
					<?php do_action( 'woocommerce_after_cart_table' ); ?>
				</form>
			</div>
			<div class="col-12 woo-page--right">
        <?php
          /**
           * Cart collaterals hook.
           *
           * @hooked woocommerce_cross_sell_display
           * @hooked woocommerce_cart_totals - 10
           */
          do_action( 'woocommerce_cart_collaterals' );
        ?>
			</div>
		</div>
	</div>
</section>

<?php do_action( 'woocommerce_after_cart' ); ?>
