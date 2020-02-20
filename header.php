<?php $graphics = get_field( 'graphics_fields', 'option' ); ?>
<?php $theme_colors = get_field( 'theme_colors', 'option' ); ?>
<?php
  $cl_bg = $theme_colors['background'] ? $theme_colors['background'] : '#fff';
  $cl_white = $theme_colors['white'] ? $theme_colors['white'] : '#fff';
  $cl_grey = $theme_colors['grey'] ? $theme_colors['grey'] : '#DBD5CE';
  $cl_muted = $theme_colors['muted'] ? $theme_colors['muted'] : 'rgba(0,0,0,0.3)';
  $cl_main = $theme_colors['main'] ? $theme_colors['main'] : 'rgba(0,0,0,0.9)';
  $cl_dark_btn = $theme_colors['dark_button'] ? $theme_colors['dark_button'] : '#171716';
  $cl_line = $theme_colors['line'] ? $theme_colors['line'] : '#BEB4A8';
  $cl_acc_1 = $theme_colors['accent_1'] ? $theme_colors['accent_1'] : '#e97956';
?>
<?php global $post_placeholder; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title(); ?></title>
  <link rel="icon" type="image/png" href="<?php echo $graphics['favicon']; ?>">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $graphics['apple_touch_icon']; ?>" type="image/x-icon">
  <style>
    :root {
      --cl-bg: <?php echo $cl_bg; ?>;
      --cl-white: <?php echo $cl_white; ?>;
      --cl-grey: <?php echo $cl_grey; ?>;
      --cl-muted: <?php echo $cl_muted; ?>;
      --cl-main: <?php echo $cl_main; ?>;
      --cl-dark-btn: <?php echo $cl_dark_btn; ?>;
      --cl-line: <?php echo $cl_line; ?>;
      --cl-acc-1: <?php echo $cl_acc_1; ?>;
    }
  </style>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="siteHeader" class="ss-header flex-align-center align-items-md-start">
  <div class="ss-header--container px-4 px-md-2 px-lg-4 container-fluid flex-align-center">
    <button id="navToggler" class="btn-toggler mr-3 d-md-none">
      <i class="sr-only">Toggle Navigation</i>
      <span class="btn-toggler--line l-1"></span>
      <span class="btn-toggler--line l-2"></span>
    </button>
    <a href="<?php echo get_home_url(); ?>" class="ss-header--logo d-inline-block">
      <img src="<?php echo $graphics['logo']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
    </a>
    <nav class="ss-header--nav d-none d-md-flex ml-md-2">
      <?php wp_nav_menu(
        array(
          'theme_location' => 'primary_desktop',
          'container'      => false,
          'menu_id'        => false,
          'menu_class'     => 'ss-header--menu flex-align-center ml-md-n2',
          'depth'          => 2,
          'fallback_cb'    => 'bs4navwalker::fallback',
          'walker'         => new bs4navwalker()
        )
      ); ?>
    </nav>
    <div class="ml-auto">
      <div class="ss-header--nav d-none pr-lg-2">
        <ul class="ss-header--menu">
          <li class="nav-item">
            <a href="javascript:" class="nav-link searchToggle">
              <svg class="svg-icon"><use xlink:href="#icon-search"></use></svg>
            </a>
          </li>
        </ul>    
      </div>  
			<?php if ( shortcode_exists( 'woocommerce_currency_switcher_link_list' ) ) { ?>
        <div class="ss-header--nav d-none d-md-inline-flex">
          <ul class="ss-header--menu">
            <li class="nav-item">
              <a href="javascript:" class="nav-link dropdownToggle">
                <span><?php echo get_woocommerce_currency(); ?></span>
              </a>
              <div class="ss-dropdown--menu dropdownMenu parent-width mod-currencies text-left">
								<?php echo do_shortcode( '[woocommerce_currency_switcher_link_list]' ); ?>
              </div>
            </li>
          </ul>
        </div>
			<?php } ?>

			<?php $translations = apply_filters( 'wpml_active_languages', null, 'orderby=id&order=desc' ); ?>
			<?php if ( $translations ) { ?>
        <nav class="ss-header--nav d-none d-md-inline-flex">
          <ul class="ss-header--menu">
            <li class="nav-item">
              <a href="javascript:" class="nav-link dropdownToggle">
                <span class="d-md-inline d-lg-none"><?php echo ICL_LANGUAGE_CODE; ?></span>
                <span class="d-none d-lg-inline"><?php echo ICL_LANGUAGE_NAME; ?></span>
              </a>
              <div class="ss-dropdown--menu dropdownMenu parent-width text-left">
								<?php foreach ( $translations as $lng ) { ?>
                  <a class="nav-link dropdown-item" href="<?php echo $lng['url']; ?>">
										<?php echo $lng['native_name']; ?>
                  </a>
								<?php } ?>
              </div>
            </li>
          </ul>
        </nav>
      <?php } ?>
      
      <a href="javascript:" class="searchToggle px-1 mr-2">
        <svg class="soc-icon"><use xlink:href="#icon-search"></use></svg>
      </a>

      <span id="cartDrawerToggler" class="ss-header--counter px-md-2 d-inline-block" role="button">
        <svg class="svg-icon mr-1"><use xlink:href="#icon-bag"></use></svg>
        <span class="d-none d-lg-inline">
          <?php _e( 'Bag', 'woocommerce' ); ?>
        </span>
        <span class="cartCount"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
      </span>
    </div>
  </div>

  <nav class="nav-drawer d-md-none">
    <div class="nav-drawer--body">
	    <?php wp_nav_menu(
		    array(
			    'theme_location' => 'primary_desktop',
			    'container'      => false,
			    'menu_id'        => false,
			    'menu_class'     => 'nav-menu ss-pad py-3 m-0',
			    'depth'          => 3,
			    'fallback_cb'    => 'ssNavwalker::fallback',
			    'walker'         => new ssNavwalker()
		    )
	    ); ?>

			<?php if ( shortcode_exists( 'woocommerce_currency_switcher_link_list' ) ) { ?>
        <ul class="nav-menu ss-pad pt-3 m-0">
          <li class="menu-item">
            <a href="javascript:" class="nav-item subMenuOpen">
							<?php echo get_woocommerce_currency(); ?>
              <span class="nav-arrow arrow-bottom ml-auto">
                <svg class="svg-icon">
                  <use xlink:href="#icon-arrow-bottom"></use>
                </svg>
              </span>
            </a>
            <ul class="ss-submenu py-2 px-3">
              <li class="menu-item mod-currencies">
								<?php echo do_shortcode( '[woocommerce_currency_switcher_link_list]' ); ?>
              </li>
            </ul>
          </li>
        </ul>
			<?php } ?>

			<?php $translations = apply_filters( 'wpml_active_languages', null, 'orderby=id&order=desc' ); ?>
			<?php if ( $translations ) { ?>
        <ul class="nav-menu ss-pad m-0">
          <li class="menu-item">
            <a href="javascript:" class="nav-item subMenuOpen">
							<?php echo ICL_LANGUAGE_NAME; ?>
              <span class="nav-arrow arrow-bottom ml-auto">
                <svg class="svg-icon">
                  <use xlink:href="#icon-arrow-bottom"></use>
                </svg>
              </span>
            </a>
            <ul class="ss-submenu py-2 px-3">
							<?php foreach ( $translations as $lng ) { ?>
                <li class="menu-item">
                  <a href="<?php echo $lng['url']; ?>">
										<?php echo $lng['native_name']; ?>
                  </a>
                </li>
							<?php } ?>
            </ul>
          </li>
        </ul>
			<?php } ?>
    </div>
  </nav>

  <aside class="cart-drawer">
    <div class="cart-drawer--header d-flex flex-wrap py-3 ss-p-x">
      <h3 class="txt-h3 mb-0 mr-auto"><?php _e( 'Cart', 'woocommerce' ); ?></h3>
      <button id="cartDrawerClose" class="btn-close">
        <i class="sr-only">Close Mini Cart</i>
        <span class="btn-close--line l-1"></span>
        <span class="btn-close--line l-2"></span>
      </button>
    </div>
    <div id="miniCart"><?php woocommerce_mini_cart(); ?></div>
  </aside>
  <div class="nav-drawer--backdrop d-md-none"></div>
  <div class="cart-drawer--backdrop"></div>

  <div class="search-box ss-p-x ss-p-y">
    <?php get_search_form( true ); ?>
  </div>
  <div class="search-box--backdrop"></div>
</header>
<main class="ss-main">