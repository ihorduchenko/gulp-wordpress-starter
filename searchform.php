<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 */
?>

<form role="search" method="get" class="ss-searchform row no-gutters" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="ss-searchform--input col-8 col-xl-9">
		<input type="search" class="ss-input w-100" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo __( 'Search', 'wp-gulp' ); ?>" />
	</div>	
	<div class="ss-searchform--btn col-4 col-xl-3">
		<button type="submit" class="ss-btn ss-btn--dark ss-btn--big auto-width w-100">
			<?php echo __( 'Search', 'wp-gulp' ); ?>
		</button>
	</div>
</form>
