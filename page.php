<?php get_header();?>

<?php if ( is_woocommerce() ) { ?>

	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	endif; ?>

<?php } else { ?>
	<section class="py-5">
		<div class="container mod-content ss-pad">
			<h1 class="txt-h3 text-center mb-5"><?php the_title(); ?></h1>
			<div class="editor-content">
				<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
				endif; ?>
			</div>
		</div>
	</section>

<?php } ?>

<?php get_footer();?>