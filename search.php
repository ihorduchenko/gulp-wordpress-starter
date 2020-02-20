<?php
/* The template for displaying search results pages. */
get_header(); ?>

<div class="row no-gutters products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
  
  <div class="product-col mod-filters">
    <aside class="filters-sidebar h-100 bg-white ss-p-x ss-p-y d-flex flex-wrap flex-column">
      <h1 class="txt-h3 mb-4 w-100 text-center text-md-left badged-text"
      data-badge="<?php echo __( 'Results for:', 'wp-gulp' ); ?>">
        <?php echo get_search_query(); ?>
      </h1>
      <?php get_search_form( true ); ?>
    </aside>
  </div>

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <div <?php wc_product_class( 'product-col', $product ); ?>>
        <?php	get_template_part('partials/product-tile'); ?>
      </div>
    <?php endwhile; ?>
    <div class="col-12">
      <?php get_template_part( 'partials/pagination' ); ?>
    </div>
  <?php else : ?>
    <div class="product-col">
      <div class="product-tile h-100 ss-p-big">
        <h2 class="txt-h2">
          <?php echo __( 'No products found', 'wp-gulp' ); ?>
        </h2>
      </div>
    </div>
  <?php endif; ?>

</div>

<?php get_footer(); ?>