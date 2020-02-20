<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
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
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

  <div class="cart-drawer--body rtl-trick">
    <div class="rtl-reset">
      <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
        <?php
          do_action( 'woocommerce_before_mini_cart_contents' );

          foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
              $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
              $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
              $thumbnail_url_sm     = get_the_post_thumbnail_url($product_id, 'thumbnail') ? get_the_post_thumbnail_url($product_id, 'thumbnail') : get_the_post_thumbnail_url($product_id);
	            $thumbnail_url     = get_the_post_thumbnail_url($product_id);
              $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
              $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
              ?>
              <li class="cart-item w-100 p-0 woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                
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
              </li>
              <?php
            }
          }

          do_action( 'woocommerce_mini_cart_contents' );
        ?>
      </ul>
    </div>
  </div>

	<p class="d-none woocommerce-mini-cart__total total"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="d-none woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>
  <div class="cart-drawer--footer mt-auto w-100 py-3 ss-p-x">
    <a href="<?php echo wc_get_cart_url(); ?>" class="ss-btn ss-btn--dark ss-btn--big w-100"><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></a>
  </div>

<?php else : ?>

	<p class="py-3 px-2 px-md-4"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?> 
