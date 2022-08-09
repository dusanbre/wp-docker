<?php

/** Register sidebars by running widebox_widgets_init() on the widgets_init hook. */
add_action('widgets_init', 'anps_widgets_init');
function anps_widgets_init()
{
  // Area 1, located at the top of the sidebar.
  register_sidebar(array(
    'name' => esc_html__('Sidebar', 'lapopsi'),
    'id' => 'primary-widget-area',
    'description' => esc_html__('The primary widget area', 'lapopsi'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => esc_html__('Secondary Sidebar', 'lapopsi'),
    'id' => 'secondary-widget-area',
    'description' => esc_html__('Secondary widget area', 'lapopsi'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));

  register_sidebar(array(
    'name' => esc_html__('Top bar left', 'lapopsi'),
    'id' => 'top-bar-left',
    'description' => esc_html__('Top bar supports Text, Search, Custom menu, Text and icon, Social icons and WPML language selector widgets.', 'lapopsi'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => esc_html__('Top bar right', 'lapopsi'),
    'id' => 'top-bar-right',
    'description' => esc_html__('Top bar supports Text, Search, Custom menu, Text and icon, Social icons and WPML language selector widgets.', 'lapopsi'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  /* Vertical menu sidebars */
  if (get_option('anps_global_menu_type', 'classic-layout') == 'vertical-layout') {
    register_sidebar(array(
      'name' => esc_html__('Vertical menu bottom widget', 'lapopsi'),
      'id' => 'vertical-bottom-widget',
      'description' => esc_html__('This widget area is only visible on large devices and only if the vertical menu is active.', 'lapopsi'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ));
  }
  /* Footer sidebars */
  $footer_columns = 1;
  switch (get_option('anps_footer_style', '4')) {
    case '2':
      $footer_columns = 2;
      break;
    case '3':
      $footer_columns = 3;
      break;
    case '4':
      $footer_columns = 4;
      break;
    case '4-lg':
      $footer_columns = 4;
      break;
    case '5':
      $footer_columns = 5;
      break;
  }
  for ($i = 1; $i <= $footer_columns; $i++) {
    register_sidebar(array(
      'name' => esc_html__('Footer', 'lapopsi') . ' ' . $i,
      'id' => "footer-{$i}",
      'description' => esc_html__('Footer', 'lapopsi') . ' ' . $i,
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ));
  }
  /* Copyright footer sidebars */
  $copyright_footer = get_option('anps_copyright_footer', '1');
  if ($copyright_footer == "1" || $copyright_footer == "0") {
    register_sidebar(array(
      'name' => esc_html__('Copyright footer 1', 'lapopsi'),
      'id' => 'copyright-1',
      'description' => esc_html__('Copyright footer 1', 'lapopsi'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ));
  } elseif ($copyright_footer == "2") {
    register_sidebar(array(
      'name' => esc_html__('Copyright footer 1', 'lapopsi'),
      'id' => 'copyright-1',
      'description' => esc_html__('Copyright footer 1', 'lapopsi'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Copyright footer 2', 'lapopsi'),
      'id' => 'copyright-2',
      'description' => esc_html__('Copyright footer 2', 'lapopsi'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ));
  }
  /* */
  register_sidebar(array(
    'name' => esc_html__('Large above menu', 'lapopsi'),
    'id' => 'large-above-menu',
    'description' => esc_html__('Large above menu.', 'lapopsi'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  /* Services left sidebar */
  register_sidebar(array(
    'name' => esc_html__('Left services sidebar', 'lapopsi'),
    'id' => 'left-services-sidebar',
    'description' => esc_html__('Sidebar on services page.', 'lapopsi'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  /* Services */
  register_sidebar(array(
    'name' => esc_html__('Services', 'lapopsi'),
    'id' => 'services',
    'description' => esc_html__('Sidebar on services page.', 'lapopsi'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  /* Blog */
  register_sidebar(array(
    'name' => esc_html__('Blog', 'lapopsi'),
    'id' => 'blog',
    'description' => esc_html__('Sidebar on blog page.', 'lapopsi'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}
