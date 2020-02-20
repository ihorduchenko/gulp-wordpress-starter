<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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

<?php if(count($_GET)) { ?>
  <?php $parameters = $_GET; ?>
  <?php $parameters_disallowed = array( 'product-page' ); ?>
  <?php foreach( $parameters_disallowed as $key ){
    unset( $parameters[$key] );
  } ?>
  <?php $parameters_length = count( $parameters ); ?>
<?php } ?>

<div class="row no-gutters products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
  <div class="product-col mod-filters">
    <aside class="filters-sidebar h-100 bg-white ss-p-x ss-p-y d-md-flex flex-wrap flex-column">
      <?php if ( ! is_shop() ) { ?>
        <div class="w-100 mb-3">
          <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="ots-btn">
            <?php echo __( '< Shop all', 'wp-gulp' ); ?>
          </a>
        </div>
      <?php } ?>
      <h1 class="txt-h3 mb-4 w-100 text-center text-md-left">
        <?php woocommerce_page_title(); ?>
      </h1>
      <div class="d-md-none text-center mb-3">
        <a href="#collapseSidebar" class="btn-link no-line" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSidebar">
          <?php echo __( 'Open filters', 'wp-gulp' ); ?>
        </a>
      </div>
      <div id="collapseSidebar" class="collapse mob-only w-100">
        <div class="w-100">
          <?php	get_template_part('partials/shop-sidebar'); ?>
        </div>
        <?php if( $parameters_length ) { ?>
          <div class="text-right d-md-none">
            <div class="text-left txt-p-big mb-2">
              <?php $c = 1; ?>
              <?php foreach ($parameters as $key => $value) { ?>
                <?php echo $key; ?>
                <?php if ( strpos( $key, 'filter_' ) !== false ) { ?><span class="text-capitalize"><?php echo $value; ?><?php if ( $c < $parameters_length ) { echo ', '; } ?></span><?php } ?>
              <?php $c++; ?>
              <?php } ?>
            </div>
            <a class="btn-link no-line" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">X <?php echo __( 'Clear filters', 'wp-gulp' ); ?></a>
          </div>
        <?php } ?>
      </div>
      <?php if( $parameters_length ) { ?>
        <div class="mt-auto w-100 d-none d-md-block">
          <div class="text-left txt-p-big mb-2">
            <?php $c = 1; ?>
            <?php foreach ($parameters as $key => $value) { ?>
              <?php if ( strpos( $key, 'filter_' ) !== false ) { ?><span class="text-capitalize"><?php echo $value; ?><?php if ( $c < $parameters_length ) { echo ', '; } ?></span><?php } ?>
            <?php $c++; ?>
            <?php } ?>
          </div>
          <a class="btn-link no-line" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">X <?php echo __( 'Clear filters', 'wp-gulp' ); ?></a>
        </div>
      <?php } ?>
    </aside>
  </div>
