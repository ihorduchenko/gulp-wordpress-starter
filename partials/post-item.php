<?php global $post_placeholder; ?>
<?php $thumb = get_the_post_thumbnail_url( $post->ID, 'full') ? get_the_post_thumbnail_url( $post->ID, 'full') : $post_placeholder; ?>
<?php $categories = wp_get_post_categories( $post->ID ); ?>

<?php if ( $categories ) { ?>
  <?php $first_id = $categories[0]; ?>
  <?php $first_cat = get_cat_name( $first_id ); ?>
<?php } ?>

<div class="col-md-4 tile-pad <?php echo $even_odd_class; ?>">
  <a href="<?php the_permalink(); ?>" class="d-block">
    <img class="w-100" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>">
  </a>
</div>
<div class="col-md-4 tile-pad <?php echo $even_odd_class; ?>">
  <div class="h-100 ss-p-x ss-p-y bg-main d-flex flex-wrap flex-column">
    <div class="w-100">
      <div class="ots-btn mb-2">
        <?php if ( $categories ) { echo $first_cat; } else { echo __( 'Blog', 'wp-gulp' ); } ?>
      </div>
    </div>
    <h2 class="txt-h3 mod-inherit w-100 mb-3">
      <a class="text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <div class="txt-tech mt-auto"><?php echo get_the_date('d.m.Y'); ?></div>
  </div>
</div>