<?php 

show_admin_bar(false);

// Posts placeholder
$post_placeholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAAEsBAMAAAAfmfjxAAAAKlBMVEXp6enExMTGxsbHx8fZ2dnf39/c3Nzk5OTT09PMzMzn5+fQ0NDX19fh4eEFEelpAAAB0klEQVR42u3aMW4TQRSA4QUBDjYUL7YBCxpoUlBFFIECyREcwD4AUrhBQgdVLHEB38AFBRFNUlIg4YoWbkTGlmw3XrlCO8P3VdP+0j69WWkqAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADKsvdiFy+rxrsRO6ka72bsYr9qPCFNI6RpUsjnt7Um2YSMqlrjbEJOhDTIfxAyKyPk9vdXv4oImUR0RwWE3ItrBwWEnKWQxwWEzCM5zT/kKpKRkH+oPmRSyqc1Th2DAoa9k0L6BYS005AMCwipvky7P7K9orQ3i1qf8r00dnqFXOOPY1REyP2IoyJCLiIGsxJC0jY/LyDkVlzrFRByFsko+5D2NJKD9V97piF7kWyM++Q8z5D3sXRZLX2LR1mGtJ7G0pNqoTWN+JljyEUsrEb/Y2rKMWSyCnm42PKH6TjML+ROrAxmq4np5RfyIdYu03JcGuYWslwi63Gfx9KD3EL2YtPJ1/Uxs5BxbOpfrY95hbQOY5tRViF3Y6t+ViHz2Gr/d0Yh76LG64xC3kSN7mk+IfWO/hQSMjguJCSjRzVCmkRI0whpmmJCinmJ3Xm2i+cVAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAALfwEnxqkaaKFxqwAAAABJRU5ErkJggg==';


// Remove unnecessary content from head
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_post_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Register ACF options page
if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page( array(
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme settings',
		'menu_slug'  => 'theme-settings',
		'capability' => 'manage_options',
		'redirect'   => false
	) );
}

$languages = array( 'en', 'ru' );

foreach ( $languages as $lang ) {
	acf_add_options_sub_page( array(
		'page_title' => "Theme Settings (${lang})",
		'menu_title' => "Theme Settings (${lang})",
		'menu_slug'  => "options-${lang}",
		'post_id'    => $lang,
		'parent'     => $option_page['menu_slug']
	) );
}

// Add theme support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_post_type_support( 'page', 'excerpt' );

// Styles / Scripts
function theme_enqueue_styles() {
	wp_deregister_script( 'jquery' );
	
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/dist/css/index.min.css', NULL, '1.0', 'all' ); 
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/style.css', NULL, '1.0', 'all' ); 

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/jquery.js', NULL, '1.0.0', true );
	wp_enqueue_script( 'ots-vendors', get_template_directory_uri() . '/dist/js/vendor.min.js', 'jquery', '1.0.0', true );
	wp_enqueue_script( 'ots-custom', get_template_directory_uri() . '/dist/js/index.min.js', 'jquery', '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Remove unnecessary styles
function project_dequeue_unnecessary_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'select2' );
	wp_dequeue_style( 'bodhi-svgs-attachment' );
	wp_dequeue_style( 'sb-font-awesome' );
	wp_dequeue_style( 'wc-block-style' );
	wp_dequeue_style( 'woocommerce-layout' );
	wp_dequeue_style( 'woocommerce-smallscreen' );
	wp_dequeue_style( 'woocommerce-general' );
}
add_action( 'wp_print_styles', 'project_dequeue_unnecessary_styles' );

// Registration of menu locations
function register_my_menus() {
	register_nav_menus(
		array(
			'primary_desktop' => 'Primary menu',
			'footer_1' => 'Footer menu 1',
			'footer_2' => 'Footer menu 2',
			'checkout' => 'Checkout menu'
		)
	);
}
add_action( 'init', 'register_my_menus' );

// Include custom Bootstrap 4 navwalker
require_once('bs4navwalker.php');
require_once('ss_navwalker.php');

// Remove <p> and <br /> from Contact Form 7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

// Remove related products, Upsell and Tabs, and move tabs underneath excerpt
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 25 );

// Remove product meta and sharing
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Remove Woocommerce CSS
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Remove "Additional information" tab and add "Shipping & Returns" single product tab
function woo_remove_product_tabs( $tabs ) {
	unset( $tabs['additional_information'] );
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function shipping_returns_tab_content() {
	$shipping_and_returns_tab = get_field('shipping_and_returns_product_tab', ICL_LANGUAGE_CODE);
	echo $shipping_and_returns_tab['content'];
}

function shipping_returns_product_tab( $tabs ) {
	$shipping_and_returns_tab = get_field('shipping_and_returns_product_tab', ICL_LANGUAGE_CODE);
	$tabs['shipping_returns_tab'] = array(
		'title'    => $shipping_and_returns_tab['title'],
		'callback' => 'shipping_returns_tab_content',
		'priority' => 50,
	);
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'shipping_returns_product_tab' );

// Replace options dropdown into custom radiobuttons
function variation_radio_buttons($html, $args) {
	$args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
		'options'          => false,
		'attribute'        => false,
		'product'          => false,
		'selected'         => false,
		'name'             => '',
		'id'               => '',
		'class'            => '',
		'show_option_none' => __('Choose an option', 'woocommerce'),
	));

	if(false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
		$selected_key     = 'attribute_'.sanitize_title($args['attribute']);
		$args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
	}

	$options               = $args['options'];
	$product               = $args['product'];
	$attribute             = $args['attribute'];
	$name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
	$id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
	$class                 = $args['class'];
	$show_option_none      = (bool)$args['show_option_none'];
	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');

	if(empty($options) && !empty($product) && !empty($attribute)) {
		$attributes = $product->get_variation_attributes();
		$options    = $attributes[$attribute];
	}

	$radios = '<div class="variation-radios">';
	if(!empty($options)) {
		if($product && taxonomy_exists($attribute)) {
			$terms = wc_get_product_terms($product->get_id(), $attribute, array(
				'fields' => 'all',
			));

			foreach($terms as $term) {
				if(in_array($term->slug, $options, true)) {
					$radios .= '<div class="ss-radio mod-text d-inline-block btn-link mr-4"><input id="'.esc_attr($name).'_'.esc_attr($term->slug).'" type="radio" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).'><label for="'.esc_attr($name).'_'.esc_attr($term->slug).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name)).'</label></div>';
				}
			}
		} else {
			foreach($options as $option) {
				$checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
				$radios    .= '<div class="ss-radio mod-text d-inline-block btn-link mr-4"><input type="radio" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.'><label for="'.sanitize_title($option).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $option)).'</label></div>';
			}
		}
	}
	$radios .= '</div>';

	return $html.$radios;
}
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'variation_radio_buttons', 20, 2);

// Remove count and sorting from shop loop
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30 );

// Refresh cart items count in header
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start(); ?> 

	<span class="cartCount"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
	<?php
	$fragments['span.cartCount'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

// Refresh Mini Cart on Ajax
function woocommerce_minicart_refresh( $fragments ) {
	global $woocommerce;

	ob_start(); ?> 

	<div id="miniCart">
		<?php woocommerce_mini_cart(); ?> 
	</div>
	<?php
	$fragments['#miniCart'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_minicart_refresh' );

// Ajaxify cart
function woocommerce_ajax_add_to_cart() {
	$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
	$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
	$variation_id = absint($_POST['variation_id']);
	$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	$product_status = get_post_status($product_id);

	if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
		do_action('woocommerce_ajax_added_to_cart', $product_id);
		WC_AJAX :: get_refreshed_fragments();
	} else {
		$data = array(
				'error' => true,
				'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
		echo wp_send_json($data);
	}
	wp_die();
}
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

// Shop & Blog sidebars
if ( function_exists('register_sidebar') ) {
	register_sidebar(
		array(
			'name' => 'Shop sidebar (color)',
			'id' => 'shop-sidebar-color',
			'before_widget' => '<div class="ss-accordion--tab">',
			'after_widget' => '</div></div></div>',
			'before_title' => '<div class="ss-accordion--header" id="heading-colors"><button class="ss-accordion--header-toggle txt-h2 w-100" data-toggle="collapse" data-target="#toggle-colors" aria-expanded="false" aria-controls="toggle-colors">',
			'after_title' => '</button></div><div id="toggle-colors" class="collapse" aria-labelledby="heading-colors" data-parent="#shop-accordion"><div class="ss-accordion--body sidebar-filters">',
		)
	);

	register_sidebar(
		array(
			'name' => 'Shop sidebar (size)',
			'id' => 'shop-sidebar-size',
			'before_widget' => '<div class="ss-accordion--tab">',
			'after_widget' => '</div></div></div>',
			'before_title' => '<div class="ss-accordion--header" id="heading-sizes"><button class="ss-accordion--header-toggle txt-h2 w-100" data-toggle="collapse" data-target="#toggle-sizes" aria-expanded="false" aria-controls="toggle-sizes">',
			'after_title' => '</button></div><div id="toggle-sizes" class="collapse" aria-labelledby="heading-sizes" data-parent="#shop-accordion"><div class="ss-accordion--body sidebar-filters">',
		)
	);

	register_sidebar(
		array(
			'name' => 'Shop sidebar (price)',
			'id' => 'shop-sidebar-price',
			'before_widget' => '<div class="ss-accordion--tab">',
			'after_widget' => '</div></div></div>',
			'before_title' => '<div class="ss-accordion--header" id="heading-prices"><button class="ss-accordion--header-toggle txt-h2 w-100" data-toggle="collapse" data-target="#toggle-prices" aria-expanded="false" aria-controls="toggle-prices">',
			'after_title' => '</button></div><div id="toggle-prices" class="collapse" aria-labelledby="heading-prices" data-parent="#shop-accordion"><div class="ss-accordion--body sidebar-filters">',
		)
	);

	register_sidebar(
		array(
			'name' => 'Blog sidebar (categories)',
			'id' => 'blog-sidebar-categories',
			'before_widget' => '',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="txt-h2">',
			'after_title' => '</h3><div class="sidebar-filters">',
		)
	);
}

// Force search page to show only products post type
function search_products_only( $query ) {
	if( ! is_admin() && is_search() && $query->is_main_query() ) {
		$query->set( 'post_type', 'product' );
  }
}
add_action( 'pre_get_posts', 'search_products_only' );