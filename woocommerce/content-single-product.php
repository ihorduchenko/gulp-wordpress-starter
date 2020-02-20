<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$p_id = $product->ID;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<?php global $post_placeholder; ?>
<?php $feat_img = get_the_post_thumbnail_url( $p_id, 'full') ? get_the_post_thumbnail_url( $p_id, 'full') : $post_placeholder; ?>
<?php $feat_thumb = get_the_post_thumbnail_url( $p_id, 'medium') ? get_the_post_thumbnail_url( $p_id, 'medium') : $post_placeholder; ?>
<?php $img_gallery = $product->get_gallery_image_ids(); ?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
  <section class="product-page bg-white<?php if ( $img_gallery ) { ?> mod-thumbs<?php } ?>">
    <div class="ss-pad d-md-none text-center py-3">
      <h2 class="txt-h3 mb-3"><?php the_title(); ?></h2>
      <div class="ots-btn">
        <?php echo $product->get_price_html(); ?>
      </div>
    </div>
    <div class="row no-gutters">

      <?php if ( $img_gallery ) { ?>
        <div class="product-thumbs d-none d-md-block">
          <aside class="sticky-sidebar sticky-md">
            <a class="d-block" href="#product-image-feat">
              <img class="w-100" src="<?php echo $feat_thumb; ?>" alt="<?php the_title(); ?> image featured">
            </a>
            <?php $i = 1; ?>
            <?php foreach( $img_gallery as $img_id ) { ?>
              <?php $thumbnail_url = wp_get_attachment_image_url( $img_id, 'medium' ); ?>
                <a class="d-block" href="#product-image-#<?php echo $i; ?>">
                  <img class="w-100" src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?> image <?php echo $i; ?>">
                </a>
              <?php $i++; ?>
            <?php } ?>
          </aside>
        </div>
      <?php } ?>

      <div class="product-images d-none d-md-block">
        <div class="anchor-el">
          <div id="product-image-feat" class="anchor-el--target"></div>
          <img class="w-100" src="<?php echo $feat_img; ?>" alt="<?php the_title(); ?> image featured">
        </div>
        <?php if ( $img_gallery ) { ?>
          <?php $i = 1; ?>
          <?php foreach( $img_gallery as $img_id ) { ?>
            <?php $full_url = wp_get_attachment_image_url( $img_id, 'full' ); ?>
            <div class="anchor-el">
              <div id="product-image-#<?php echo $i; ?>" class="anchor-el--target"></div>
              <img class="w-100" src="<?php echo $full_url; ?>" alt="<?php the_title(); ?> image <?php echo $i; ?>">
            </div>
            <?php $i++; ?>
          <?php } ?>
        <?php } ?>
      </div>

      <div class="productGallery w-100 d-md-none">
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img class="w-100" src="<?php echo $feat_img; ?>" alt="<?php the_title(); ?> image featured">
            </div>
				    <?php if ( $img_gallery ) { ?>
					    <?php $i = 1; ?>
					    <?php foreach( $img_gallery as $img_id ) { ?>
						    <?php $full_url = wp_get_attachment_image_url( $img_id, 'full' ); ?>
                <div class="swiper-slide">
                  <img class="w-100" src="<?php echo $full_url; ?>" alt="<?php the_title(); ?> image <?php echo $i; ?>">
                </div>
						    <?php $i++; ?>
					    <?php } ?>
				    <?php } ?>
          </div>
          <div class="swiper-button-prev slider-arrow prev"></div>
          <div class="swiper-button-next slider-arrow next"></div>
        </div>
      </div>

      <div class="product-info px-4">
        <aside class="sticky-sidebar sticky-md py-4 pb-md-5">
          <h1 class="txt-h3 mb-3 d-none d-md-block"><?php the_title(); ?></h1>
	        <?php
	        /**
	         * Hook: woocommerce_single_product_summary.
	         *
	         * @hooked woocommerce_template_single_title - 5
	         * @hooked woocommerce_template_single_rating - 10
	         * @hooked woocommerce_template_single_price - 10
	         * @hooked woocommerce_template_single_excerpt - 20
	         * @hooked woocommerce_template_single_add_to_cart - 30
	         * @hooked woocommerce_template_single_meta - 40
	         * @hooked woocommerce_template_single_sharing - 50
	         * @hooked WC_Structured_Data::generate_product_data() - 60
	         */
	        do_action( 'woocommerce_single_product_summary' ); ?>
	        <?php
	        /**
	         * Hook: woocommerce_after_single_product_summary.
	         *
	         * @hooked woocommerce_output_product_data_tabs - 10
	         * @hooked woocommerce_upsell_display - 15
	         * @hooked woocommerce_output_related_products - 20
	         */
	        do_action( 'woocommerce_after_single_product_summary' ); ?>
        </aside>
      </div>

      <?php $rel_ids = wc_get_related_products($p_id, 4, array($p_id)); ?>
      <?php if ( $rel_ids ) : ?>
        <div class="product-related col-12 bg-main productsSlider">
          <div class="ss-pad product-related--head ss-p-y">
            <h2 class="txt-h3 mb-5"> 
              <?php echo __( 'You also may like', 'wp-gulp' ); ?>
            </h2>
          </div>
          <div class="swiper-container">
            <div class="swiper-wrapper">
              <?php foreach( $rel_ids as $post): ?>
                <?php $post_object = get_post( $post );
                setup_postdata( $GLOBALS['post'] =& $post_object ); ?>
                <div class="swiper-slide">
                  <?php	get_template_part('partials/product-tile'); ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>

  </section>
</div>

<?php $size_chart = get_field( 'size_chart', ICL_LANGUAGE_CODE ); ?>
<?php if ( $size_chart ) { ?>
  <div class="modal fade" id="sizeChart" tabindex="-1" role="dialog" aria-labelledby="sizeChartLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 px-md-5 pt-md-5" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="txt-h3 mb-0" id="sizeChartLabel">
            <?php echo $size_chart['caption']; ?>
          </h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <i class="sr-only">Close</i>
            <span class="btn-close--line l-1"></span>
            <span class="btn-close--line l-2"></span>
          </button>
        </div>
        <div class="modal-body p-0 size-table">
          <div class="overflow-auto">
	          <?php echo $size_chart['table_html']; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>