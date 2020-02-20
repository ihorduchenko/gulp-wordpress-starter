<nav class="ss-pagination bg-main ss-p-x ss-p-y">
  <?php $big = 999999999;
  $pages = paginate_links( 
    array(
      'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'    => '?paged=%#%',
      'current'   => max( 1, get_query_var( 'paged' ) ),
      'mid_size'  => 3,
      'prev_text' => '<',
      'next_text' => '>',
      'type'      => 'array'
    ) 
  ); ?>
  <?php if ( is_array( $pages ) ) { ?>
    <?php foreach ( $pages as $page ) { ?>
      <?php $page = str_replace( '/page/1', '', $page ); ?>
      <?php $page = str_replace( 'page-numbers', 'page-link', $page ); ?>
      <?php echo $page; ?>
    <?php } ?>
  <?php } ?> 
</nav>