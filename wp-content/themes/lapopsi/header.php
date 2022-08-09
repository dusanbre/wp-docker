<?php if (!defined('ABSPATH')) {
  die();
} ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if (get_option('anps_mobile_toolbar_color', '') != '') : ?>
    <meta name="theme-color" content="#<?php echo get_option('anps_mobile_toolbar_color'); ?>">
  <?php endif; ?>

  <?php if (get_option('anps_home_screen_icon', '') != '') : ?>
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url(get_option('anps_home_screen_icon')); ?>">
  <?php endif; ?>

  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php anps_include_favicon(); ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php anps_body_style(); ?>>
  <?php wp_body_open(); ?>
  <?php anps_inline_svgs(); ?>

  <?php if (get_option('anps_global_search_icon_mobile', '1') == '1' || get_option('anps_global_search_icon', '1') == '1') : ?>
    <?php anps_mobile_search(); ?>
  <?php endif; ?>

  <div class="site">
    <div class="site-wrap">

      <?php
      //blank page header value
      $header_value;
      if ($post) {
        $header_value = get_post_meta($post->ID, $key = 'anps_blank_page_disable_header', $single = true);
      }
      //check if it is disabled header
      if (!isset($header_value) || $header_value != 'on') {
        // Get header
        get_template_part('templates/template-header', get_option('anps_menu_type', 'top'));
      }

      anps_mobile_menu();

      ?>
      <?php if (is_front_page() && get_option('anps_slider_home_page', '') != '') {
        echo do_shortcode("[rev_slider alias='" . get_option('anps_slider_home_page', '') . "']");
      } ?>
      <main class="site-main">
        <?php
        //check if it is disabled header
        if (!isset($header_value) || $header_value != 'on') {
          get_template_part('templates/template', 'page-title');
          get_template_part('templates/template', 'breadcrumbs');
        }
        ?>
        <div class="container content-container">
          <div class="row">
