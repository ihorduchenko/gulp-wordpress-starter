<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

  <div id="product-accordion" class="ss-accordion mb-3">
    <?php $i = 1; ?>
	  <?php foreach ( $tabs as $key => $tab ) : ?>
      <div class="ss-accordion--tab">
        <div class="ss-accordion--header" id="heading0<?php echo $i; ?>">
          <button class="ss-accordion--header-toggle txt-h2 w-100"
                  data-toggle="collapse" data-target="#collapse0<?php echo $i; ?>"
                  aria-expanded="false" aria-controls="collapse0<?php echo $i; ?>">
	          <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
          </button>
        </div>

        <div id="collapse0<?php echo $i; ?>" class="collapse" aria-labelledby="heading0<?php echo $i; ?>" data-parent="#product-accordion">
          <div class="ss-accordion--body txt-tech">
	          <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
          </div>
        </div>
      </div>
      <?php $i++; ?>
	  <?php endforeach; ?>
  </div>

<?php endif; ?>
