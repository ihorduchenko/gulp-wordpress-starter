<?php global $post_placeholder; ?>
<?php $id = $post->ID; ?>
<?php $prod = wc_get_product( $id ); ?>
<?php $price = wc_price( $prod->get_price() ); ?>

<?php $thumb_sm = get_the_post_thumbnail_url( $id, 'thumbnail') ? get_the_post_thumbnail_url( $id, 'thumbnail') : $post_placeholder; ?>
<?php $thumb = get_the_post_thumbnail_url( $id, 'large') ? get_the_post_thumbnail_url( $id, 'large') : $post_placeholder; ?>

<?php $img_gallery = $prod->get_gallery_image_ids(); ?>
<?php $sec_id = $img_gallery[0]; ?>
<?php $sec_thumb = wp_get_attachment_image_url( $sec_id, 'large' ); ?>
<?php $sec_thumb_sm = get_the_post_thumbnail_url( $sec_id, 'thumbnail') ? get_the_post_thumbnail_url( $sec_id, 'thumbnail') : $post_placeholder; ?>

<article class="product-tile h-100">
  <a href="<?php the_permalink(); ?>" class="product-tile--img d-block tile-138">
    <span class="product-tile--img-orig d-block bgReplace bg-cover h-100"
      data-orig-bg="<?php echo $thumb; ?>"
      style="background-image: url(<?php echo $thumb_sm; ?>)">
      <span class="sr-only"><?php the_title(); ?></span>
    </span>
	  <?php if ( $sec_id ) { ?>
      <span class="product-tile--img-sec d-block bgReplace bg-cover h-100"
        data-orig-bg="<?php echo $sec_thumb; ?>"
        style="background-image: url(<?php echo $sec_thumb_sm; ?>)">
        <span class="sr-only"><?php the_title(); ?></span>
      </span>
    <?php } ?>
  </a>
  <div class="product-tile--holder ss-p-x ss-p-y w-100">

    <h2 class="txt-tech product-tile--title mb-1">
      <a href="<?php the_permalink(); ?>" class="text-decoration-none">
		    <?php the_title(); ?>
      </a>
    </h2>
    <div class="ots-btn"><?php echo $price; ?></div>
  </div>
</article>