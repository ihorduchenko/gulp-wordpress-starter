<?php
/* Template Name: Woocommerce page */
get_header( 'woo' ); ?>

<main class="woo-page bg-white">
	<div class="ss-pad py-4">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>

<?php get_footer( 'woo' ); ?>
