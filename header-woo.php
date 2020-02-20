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
$cl_acc_1 = $theme_colors['accent-1'] ? $theme_colors['accent-1'] : '#e97956';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
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
  <header class="woo-header d-flex bg-white align-items-center">
    <div class="ss-pad w-100">
      <a href="<?php echo get_home_url(); ?>" class="ss-header--logo d-inline-block">
        <img src="<?php echo $graphics['logo']; ?>" alt="<?php echo get_bloginfo('name'); ?>">
      </a>
    </div>
  </header>
