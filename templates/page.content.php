<?php 
/* Template Name: Content page */
get_header(); ?>

<section class="py-5">
  <div class="ss-pad">
    <div class="px-0 container mod-content">
      <h1 class="txt-h3 text-center mb-5"><?php the_title(); ?></h1>
    </div>
  </div>
  <?php if ( get_field('show_custom_content') ) { ?>
    <!-- Flexible page blocks -->
    <?php if( have_rows('sections') ): ?>
      <?php while ( have_rows('sections') ) : the_row(); ?> 

        <?php if( get_row_layout() == 'editor_layout' ): ?>
          <?php $sec_editor = get_sub_field('editor_section'); ?>
          <div class="py-5 ss-pad">
            <div class="px-0 container mod-content editor-content">
              <?php echo $sec_editor['editor']; ?>
            </div>
          </div>
        <?php elseif( get_row_layout() == 'image_layout' ): ?>
          <?php $sec_image = get_sub_field('image_section'); ?>
          <figure class="mb-0">
            <img class="w-100" src="<?php echo $sec_image['image']; ?>" alt="">
            <?php if ( $sec_image['caption'] ) { ?>
              <figcaption class="pt-3 text-center txt-tech cl-muted"><?php echo $sec_image['caption']; ?></figcaption>
            <?php } ?>
          </figure>
        <?php elseif( get_row_layout() == 'video_layout' ): ?>
          <?php $sec_video = get_sub_field('video_section'); ?>
          <div class="ss-pad py-5">
            <div class="px-0 container mod-content">
            <div class="embed-video">
              <?php echo $sec_video['video']; ?>
            </div>
            </div>
          </div>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php else : ?>

      <!-- Show Gutenberg content if no flexible content detected -->
      <div class="ss-pad">
        <div class="py-md-5 px-0 container mod-content">
          <div class="editor-content">
            <?php if ( have_posts() ) :
              while ( have_posts() ) : the_post();
                the_content();
              endwhile;
            endif; ?>
          </div>
        </div>
      </div>
      <!-- END Show Gutenberg content if no flexible content detected -->

    <?php endif; ?>
    <!-- END Flexible page blocks -->
  <?php } else { ?>
    <!-- Show Gutenberg content -->
    <div class="ss-pad">
      <div class="py-md-5 px-0 container mod-content">
        <div class="editor-content">
          <?php if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif; ?>
        </div>
      </div>
    </div>
    <!-- END Show Gutenberg content -->
  <?php } ?>
</section>

<?php get_footer(); ?>