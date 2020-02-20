<?php 
/* Template Name: Main page */
get_header(); ?>
<?php $thumbnail = get_the_post_thumbnail_url( $id, 'full'); ?>

<!-- Flexible page blocks -->
<?php if( have_rows('fields') ): ?>
  <?php while ( have_rows('fields') ) : the_row(); ?> 

    <?php if( get_row_layout() == 'hero_layout' ): ?>
      <?php $sec_hero = get_sub_field('hero'); ?>

      <?php if( $sec_hero ) { ?>
        <!-- Hero section -->
        <?php $title = $sec_hero['title']; ?> 
        <?php $color = $sec_hero['text_color'] ? $sec_hero['text_color'] : 'rgba(0, 0, 0, 0.9);'; ?> 
        <?php $h_link = $sec_hero['link']; ?> 
        <?php $ban_img_thumb = $sec_hero['image']['sizes']['thumbnail'] ? $sec_hero['image']['sizes']['thumbnail'] : $sec_hero['image']['url']; ?> 
        <?php $ban_img = $sec_hero['image']['url']; ?>

        <section class="hero">
          <?php if ( $title && $h_link ) { ?>
          <?php $h_link_url = $h_link['url'];
            $h_link_title = $h_link['title'];
            $h_link_target = $h_link['target'] ? $h_link['target'] : '_self'; ?>
            <a href="<?php echo $h_link_url; ?>" 
              class="hero-content text-decoration-none ss-p-y px-4"
              target="<?php echo $h_link_target; ?>">
              <div class="w-100">
                <h1 class="hero-title txt-h3 mb-2" style="color: <?php echo $color; ?>;">   
                  <?php echo $title; ?>
                </h1>
                <span class="ots-btn"><?php echo $h_link_title; ?></span>
              </div>
            </a>
          <?php } ?>
          <a href="<?php echo $h_link_url; ?>" class="hero-bg d-block bg-cover bgReplace" data-orig-bg="<?php echo $ban_img; ?>"
          style="background-image: url(<?php echo $ban_img_thumb; ?>);">
            <span class="sr-only"><?php the_title(); ?></span>
          </a>
        </section>

        <!-- END Hero section -->
      <?php } ?>

    <?php elseif( get_row_layout() == 'products_layout' ): ?>

      <?php $sec_products = get_sub_field('products_block'); ?> 
      <?php if( $sec_products ) { ?>
        <!-- Products section -->
        <?php $products = $sec_products['products']; ?> 

        <?php if( $products ): ?>
          <section class="sec-products productsSlider">
            <div class="swiper-container">
              <div class="swiper-wrapper">
                <?php foreach( $products as $post): ?>
                  <?php setup_postdata( $post ); ?>
                    <div class="swiper-slide">
                      <?php	get_template_part('partials/product-tile'); ?>
                    </div>
                  <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
              </div>
            </div>
          </section>
        <?php endif; ?>
        <!-- END Products section -->
      <?php } ?>

    <?php elseif( get_row_layout() == 'sticky_banner_layout' ): ?>

			<?php $stick_banner = get_sub_field('sticky_banner'); ?>

			<?php if( $stick_banner ) { ?>
        <!-- Sticky banner section -->
				<?php $img_pos = $stick_banner['image_position']; ?>
        <?php $img_thumb = $stick_banner['image']['sizes']['thumbnail'] ? $stick_banner['image']['sizes']['thumbnail'] : $stick_banner['image']['url']; ?> 
				<?php $img = $stick_banner['image']['url']; ?>
				<?php $title_badge = $stick_banner['title_badge']; ?>
				<?php $title = $stick_banner['title']; ?>
        <?php $sb_link = $stick_banner['link']; ?>
        <?php $show_form = $stick_banner['with_subscribe_form']; ?>
				<?php $subscribe_form = $stick_banner['subscribe_form']; ?>
				<?php $show_caption = $stick_banner['show_caption']; ?>
				<?php $caption = $stick_banner['caption']; ?>
				<?php $offset_class = ''; ?>

        <?php if( $img_pos === 'right' ) {
          $offset_class = ' order-md-last';
        }; ?>
        <section class="banner-stick">
          <div class="row no-gutters">
				    <?php if( $img ) { ?>
              <?php $img_width = $stick_banner['image']['width']; ?>
              <?php $img_height = $stick_banner['image']['height']; ?>
              <?php $img_ratio = $img_height / $img_width * 100; ?>
              <div class="col-md-6<?php echo $offset_class; ?>">
                <a href="<?php if( $sb_link ) { echo $sb_link['url']; } else { echo 'javascript:'; }; ?>" class="d-block h-100 bg-cover bgReplace" 
                  data-orig-bg="<?php echo $img; ?>"
                  style="background-image: url(<?php echo $img_thumb; ?>); padding-bottom: <?php echo $img_ratio; ?>%;">
                  <span class="sr-only"><?php echo $title; ?></span>
                </a>
              </div>
				    <?php } ?>
            <div class="col-md-6">
              <div class="banner-stick--content ss-p-x ss-p-y h-100 d-flex flex-center flex-column">
                <?php if( !$show_form ) { ?>
                  <?php if( $sb_link ) { ?>
                    <?php $sb_link_url = $sb_link['url'];
                    $sb_link_title = $sb_link['title'];
                    $sb_link_target = $sb_link['target'] ? $sb_link['target'] : '_self'; ?>
                    <a href="<?php echo esc_url( $sb_link_url ); ?>" class="banner-stick--content-link">
                      <span class="sr-only"><?php echo esc_html( $sb_link_title ); ?></span>
                    </a>
                  <?php } ?>  
                <?php } ?>
				        <?php if( $title ) { ?>
                  <h2 class="<?php if( !$show_form ) { ?>banner-stick--title <?php } ?>badged-text mt-md-n3 pt-md-3 w-100 txt-h3" data-badge="<?php echo $title_badge; ?>">
                    <?php echo $title; ?>
                    <?php if( !$show_form ) { ?>
                      <span class="d-none d-md-block py-5"></span>
                    <?php } ?>
                  </h2>
                <?php } ?>
                <?php if( $show_form ) { ?>
                  <div class="mt-auto txt-tech w-100 py-3">
                    <div class="subscribe-form">
                      <?php echo do_shortcode( '[mc4wp_form id="'.$subscribe_form.'" ]' ); ?>
                    </div>
                  </div>
                <?php } ?>
				        <?php if( $show_caption ) { ?>
                  <div class="<?php if( !$show_form ) { ?>mt-3<?php } ?> txt-tech w-100">
	                  <?php echo $caption; ?>
                  </div>
				        <?php } else { ?>
					        <?php if( $sb_link ) { ?>
						        <?php $sb_link_url = $sb_link['url'];
						        $sb_link_title = $sb_link['title'];
						        $sb_link_target = $sb_link['target'] ? $sb_link['target'] : '_self'; ?>
                    <div class="<?php if( !$show_form ) { ?>mt-auto<?php } ?> txt-tech w-100 relative-index-1">
                      <a href="<?php echo esc_url( $sb_link_url ); ?>" class="text-decoration-none"
                         target="<?php echo esc_attr( $sb_link_target ); ?>">
		                    <?php echo esc_html( $sb_link_title ); ?>
                      </a>
                    </div>
				          <?php } ?>
				        <?php } ?>
              </div>
            </div>
          </div>
        </section>

        <!-- END Sticky banner section -->
			<?php } ?>

		<?php elseif( get_row_layout() == 'text_banner_layout' ): ?>

			<?php $text_banner = get_sub_field('text_banner'); ?>

			<?php if( $text_banner ) { ?>
        <!-- Text banner section -->
				<?php $tb_img_pos = $text_banner['image_position']; ?>
        <?php $tb_img_thumb = $text_banner['image']['sizes']['thumbnail'] ? $text_banner['image']['sizes']['thumbnail'] : $text_banner['image']['url']; ?> 
				<?php $tb_img = $text_banner['image']['url']; ?>
				<?php $tb_text = $text_banner['text']; ?>
				<?php $tb_hide_mob = $text_banner['hide_on_mobile']; ?>
				<?php $tb_offset_class = ''; ?>

				<?php if( $tb_img_pos === 'right' ) {
					$tb_offset_class = ' order-md-last';
				}; ?>
        <section class="banner-text<?php if ( $tb_hide_mob ) { ?> d-none d-md-block<?php } ?>">
          <div class="row no-gutters">
						<?php if( $tb_img ) { ?>
              <div class="col-md-6<?php echo $tb_offset_class; ?>">
                <a href="<?php echo $tb_link['url']; ?>" class="d-block tile-40 h-100 bg-cover bgReplace" 
                  data-orig-bg="<?php echo $tb_img; ?>"
                  style="background-image: url(<?php echo $tb_img_thumb; ?>);">
                </a>
              </div>
						<?php } ?>
            <div class="col-md-6">
              <?php if( $tb_text ) { ?>
                <div class="ss-p-x ss-p-y txt-p-big"> 
                  <?php echo $tb_text; ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </section>

        <!-- END Text banner section -->
      <?php } ?>
      
		<?php elseif( get_row_layout() == '2_banners_layout' ): ?>

			<?php $sec_two = get_sub_field('2_banners'); ?>

      <?php if( $sec_two ) { ?>
        <!-- Hero section -->
        <?php $title_1 = $sec_two['title_1']; ?> 
        <?php $color_1 = $sec_two['text_color_1'] ? $sec_two['text_color_1'] : 'rgba(0, 0, 0, 0.9);'; ?> 
        <?php $h_link_1 = $sec_two['link_1']; ?> 
        <?php $ban_img_thumb_1 = $sec_two['image_1']['sizes']['thumbnail'] ? $sec_two['image_1']['sizes']['thumbnail'] : $sec_two['image_1']['url']; ?> 
        <?php $ban_img_1 = $sec_two['image_1']['url']; ?>

        <?php $title_2 = $sec_two['title_2']; ?> 
        <?php $color_2 = $sec_two['text_color_2'] ? $sec_two['text_color_2'] : 'rgba(0, 0, 0, 0.9);'; ?> 
        <?php $h_link_2 = $sec_two['link_2']; ?> 
        <?php $ban_img_thumb_2 = $sec_two['image_2']['sizes']['thumbnail'] ? $sec_two['image_2']['sizes']['thumbnail'] : $sec_two['image_2']['url']; ?> 
        <?php $ban_img_2 = $sec_two['image_2']['url']; ?>

        <section class="two-banners">
          <?php if ( $title_1 && $h_link_1 ) { ?>
            <div class="two-banners--col">
              <?php $h_link_url_1 = $h_link_1['url'];
              $h_link_title_1 = $h_link_1['title'];
              $h_link_target_1 = $h_link_1['target'] ? $h_link_1['target'] : '_self'; ?>
              <a href="<?php echo $h_link_url_1; ?>" 
                class="two-banners--content text-decoration-none ss-p-y px-4"
                target="<?php echo $h_link_target_1; ?>">
                <div class="w-100">
                  <h1 class="two-banners--title txt-h3 mb-2" style="color: <?php echo $color_1; ?>;">   
                    <?php echo $title_1; ?>
                  </h1>
                  <span class="ots-btn"><?php echo $h_link_title_1; ?></span>
                </div>
              </a>
              
              <a href="<?php echo $h_link_url_1; ?>" class="two-banners--bg d-block bg-cover bgReplace" data-orig-bg="<?php echo $ban_img_1; ?>"
              style="background-image: url(<?php echo $ban_img_thumb_1; ?>);">
                <span class="sr-only"><?php the_title(); ?></span>
              </a>
            </div>
          <?php } ?>
          <?php if ( $title_2 && $h_link_2 ) { ?>
            <div class="two-banners--col">
              <?php $h_link_url_2 = $h_link_2['url'];
              $h_link_title_2 = $h_link_2['title'];
              $h_link_target_2 = $h_link_2['target'] ? $h_link_2['target'] : '_self'; ?>
              <a href="<?php echo $h_link_url_1; ?>" 
                class="two-banners--content text-decoration-none ss-p-y px-4"
                target="<?php echo $h_link_target_2; ?>">
                <div class="w-100">
                  <h1 class="two-banners--title txt-h3 mb-2" style="color: <?php echo $color_2; ?>;">   
                    <?php echo $title_2; ?>
                  </h1>
                  <span class="ots-btn"><?php echo $h_link_title_2; ?></span>
                </div>
              </a>
              
              <a href="<?php echo $h_link_url_2; ?>" class="two-banners--bg d-block bg-cover bgReplace" data-orig-bg="<?php echo $ban_img_2; ?>"
              style="background-image: url(<?php echo $ban_img_thumb_2; ?>);">
                <span class="sr-only"><?php the_title(); ?></span>
              </a>
            </div>
          <?php } ?>
        </section>

        <!-- END Hero section -->
      <?php } ?>

    <?php endif; ?>

  <?php endwhile; ?>

<?php else : ?>

  <!-- Show Gutenberg content if no flexible content detected -->
  <section class="py-5">
    <div class="container-fluid ss-pad">
      <div class="row justify-content-center">
        <div class="col-md-7">
          <h1 class="txt-h1"><?php the_title(); ?></h1>
          <div class="txt-tech pt-5"><?php the_content(); ?></div>
        </div>
      </div>
    </div>
  </section>
  <!-- END Show Gutenberg content if no flexible content detected -->

<?php endif; ?>
<!-- END Flexible page blocks -->

<?php get_footer(); ?>