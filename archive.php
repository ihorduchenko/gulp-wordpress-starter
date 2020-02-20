<?php get_header();
$tax_obj = get_queried_object(); 
$tax = get_taxonomy( $tax_obj->taxonomy ); 
$tax_labels = get_taxonomy_labels( $tax ); ?>

<section class="blog-page bg-white">
  <div class="row no-gutters">
    <div class="col-md-4">
      <aside class="filters-sidebar h-100 bg-white ss-p-x ss-p-y">
        <h1 class="txt-h-span mb-4 w-100 text-center text-md-left"><?php echo $tax_obj->name; ?></h1>
		    <?php	get_template_part('partials/blog-sidebar'); ?>
      </aside>
    </div>
    <?php if ( have_posts() ): ?>
      <?php $i = 1; ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php if ( $i % 2 == 0 ) { ?>
          <?php $even_odd_class = 'even'; ?>
        <?php } else { ?>
          <?php $even_odd_class = 'odd'; ?>
        <?php } ?>

        <?php include( locate_template( 'partials/post-item.php', false, false ) ); ?>
        <?php if ( $i % 2 == 0 ) { ?>
          <div class="col-md-4"></div>
          <div class="col-md-4"></div>
        <?php } ?>
        <?php $i++; ?>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-md-4">
        <h2 class="txt-tech my-5"><?php echo __( 'No Content Found', 'wp-gulp' ); ?></h2>
      </div>
    <?php endif; ?>
    <div class="col-12">
      <?php get_template_part( 'partials/pagination' ); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
