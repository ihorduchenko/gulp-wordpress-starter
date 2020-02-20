<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>

	<?php global $post_placeholder; ?>
	<?php $prod_id = $product->get_id(); ?>
	<?php $bp_feat_img = get_the_post_thumbnail_url( $prod_id, 'full') ? get_the_post_thumbnail_url( $prod_id, 'full') : $post_placeholder; ?>
	<?php $bp_feat_thumb = get_the_post_thumbnail_url( $prod_id, 'thumbnail') ? get_the_post_thumbnail_url( $prod_id, 'thumbnail') : $post_placeholder; ?>

	<div class="ss-megamenu--product">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>" 
			class="ss-megamenu--product-img d-block bg-cover bgReplace"
			data-orig-bg="<?php echo $bp_feat_img; ?>"
			style="background-image: url(<?php echo $bp_feat_thumb; ?>);">
			<span class="sr-only"><?php echo wp_kses_post( $product->get_name() ); ?></span>
		</a>
		
		<div class="ss-megamenu--product-content col-auto txt-tech pl-3 ss-p-y">
			<h3 class="txt-tech mb-1">
				<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
					<?php echo wp_kses_post( $product->get_name() ); ?>
				</a>
			</h3>
			<div class="ots-btn"><?php echo $product->get_price_html(); ?></div>
		</div>
	</div>

	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
