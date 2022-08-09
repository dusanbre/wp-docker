<?php
if (!defined('ABSPATH')) {
  die();
}

/* Body classes */
if (!function_exists('anps_body_classes')) {
  function anps_body_classes($class)
  {
    if (anps_is_vertical()) {
      $class[] = anps_is_vertical();
    }
    if (anps_is_sticky()) {
      $class[] = anps_is_sticky();
    }
    if (anps_footer_style()) {
      $class[] = anps_footer_style();
    }
    if (anps_header_margin()) {
      $class[] = anps_header_margin();
    }
    if (anps_is_boxed()) {
      $class[] = anps_is_boxed();
    }
    if (anps_sidebar_hide()) {
      $class[] = 'sidebar-hide';
    }
    if (anps_sidebar_after()) {
      $class[] = 'sidebar-after';
    }
    return $class;
  }
}
add_filter('body_class', 'anps_body_classes');

if (!function_exists('anps_sidebar_hide')) {
  function anps_sidebar_hide()
  {
    $value_sidebar_hide = get_post_meta(get_queried_object_id(), 'anps_mobile_sidebar_hide', true);
    if (isset($value_sidebar_hide) && $value_sidebar_hide != '') {
      return true;
    }
    if (is_single()) {
      return get_option('anps_post_sidebar_hide', '0') === '1';
    } else {
      return get_option('anps_page_sidebar_hide', '0') === '1';
    }

    return false;
  }
}

if (!function_exists('anps_sidebar_after')) {
  function anps_sidebar_after()
  {
    $value_sidebar_after = get_post_meta(get_queried_object_id(), 'anps_mobile_sidebar_after', true);
    if (isset($value_sidebar_after) && $value_sidebar_after != '') {
      return true;
    }
    if (is_single()) {
      return get_option('anps_post_sidebar_after', '0') === '1';
    } else {
      return get_option('anps_page_sidebar_after', '0') === '1';
    }

    return false;
  }
}

/* Inline SVGs */
if (!function_exists('anps_inline_svgs')) {
  function anps_inline_svgs()
  {
    get_template_part('includes/svg', 'images');
  }
}

/*boxed*/
if (!function_exists('anps_is_boxed')) {
  function anps_is_boxed()
  {
    $class = '';
    $is_boxed = get_option('anps_is_boxed', '0');
    $layout = get_option('anps_global_menu_type', '');

    if ($is_boxed == '1' && $layout != 'vertical-layout') {
      $class .= ' boxed';
      if (get_option('anps_custom_pattern') != '0') {
        $class .= ' pattern-' . get_option('anps_pattern');
      }
    }
    return $class;
  }
}
//anps_is_boxed();
if (!function_exists('anps_body_style')) {
  function anps_body_style()
  {
    $style = "style='";
    if (get_option('anps_is_boxed', '0') == '1' && get_option('anps_global_menu_type', '') != 'vertical-layout' && get_option('anps_pattern') == '0') {

      if (get_option('anps_type') == 'custom-color') {
        $style .= 'background-color:#' . get_option('anps_bg_color', 'fff') . ';';
      }

      if (get_option('anps_type') != 'custom-color') {
        $style .= 'background-image:url(' . get_option('anps_custom_pattern', '') . ');';
      }

      if (get_option('anps_type') == 'stretched') {
        $style .= ' background-repeat: no-repeat;';
        $style .= ' background-size: cover;';
      }
      $style .= "'";
      echo wp_kses($style, array(
        'style' => array()
      ));
    }
  }
}


/* Logo (global, sticky, mobile) */
if (!function_exists('anps_logo')) {
  function anps_logo()
  {
    $page_logo = get_post_meta(get_queried_object_id(), $key = 'anps_full_screen_logo', $single = true);
    $sticky_page_logo = get_post_meta(get_queried_object_id(), $key = 'anps_page_sticky_logo', $single = true);
    $mobile_page_logo = get_post_meta(get_queried_object_id(), $key = 'anps_page_mobile_logo', $single = true);
    $sticky_logo_option = get_option('anps_sticky_logo', '');
    $mobile_logo_option = get_option('anps_mobile_logo', '');
    $front_logo = get_option('anps_front_logo', '');
    $front_mobile_logo = get_option('anps_front_mobile_logo', '');
    $global_logo = get_option('anps_logo', '');
    $text_logo = get_option('anps_text_logo', '');
    $logo_alt = get_bloginfo('name');
    $data = '';
    /* Logo */
    if ($global_logo == '') {
      $global_logo = get_template_directory_uri() . '/images/logo.svg';
    }
    if (isset($page_logo) && ($page_logo != '0' && $page_logo != '')) {
      $big_logo = $page_logo;
      $big_logo_height = get_option('anps_logo_height', '');
    } elseif (is_front_page() && $front_logo != '') {
      $big_logo = $front_logo;
      $big_logo_height = get_option('anps_front_logo_height', '');
    } elseif ($text_logo != '') {
      $big_logo = $text_logo;
    } else {
      $big_logo = $global_logo;
      $big_logo_height = get_option('anps_logo_height', '');
    }
    /* Sticky logo */
    $sticky_logo_height = '';
    if (isset($sticky_page_logo) && ($sticky_page_logo != '0' && $sticky_page_logo != '')) {
      $sticky_logo = $sticky_page_logo;
    } elseif (anps_is_transparent() && get_option('anps_sticky_transparent_logo', '') != '') {
      $sticky_logo = get_option('anps_sticky_transparent_logo', '');
      $sticky_logo_height = get_option('anps_sticky_transparent_logo_height', '');
    } elseif (anps_is_transparent() && get_option('anps_sticky_logo', '') != '') {
      $sticky_logo = $sticky_logo_option;
      $sticky_logo_height = get_option('anps_sticky_logo_height', '');
    } elseif (get_option('anps_sticky_logo', '') != '') {
      $sticky_logo = $sticky_logo_option;
      $sticky_logo_height = get_option('anps_sticky_logo_height', '');
    } else {
      $sticky_logo = $big_logo;
    }
    /* Mobile logo */
    if (is_front_page() && $front_mobile_logo != '') {
      $mobile_logo = $front_mobile_logo;
    } elseif (isset($mobile_page_logo) && ($mobile_page_logo != '0' && $mobile_page_logo != '')) {
      $mobile_logo = $mobile_page_logo;
    } elseif (get_option('anps_mobile_logo', '') != '') {
      $mobile_logo = $mobile_logo_option;
    } else {
      $mobile_logo = $big_logo;
    }
    /* Logo height */
    $style_height_logo = '';
    if ($big_logo_height != '') {
      $style_height_logo = " style='height:" . $big_logo_height . "px;'";
    }
    /* Sticky logo height */
    $style_height_sticky_logo = '';
    if ($sticky_logo_height != '') {
      $style_height_sticky_logo = " style='height:" . $sticky_logo_height . "px;'";
    }
    if ($big_logo != $text_logo) {
      $data .= "<span class='anps-logo__main'><img src='$big_logo' alt='$logo_alt' class='logo-img'$style_height_logo></span>";
      $data .= "<span class='anps-logo__sticky'><img src='$sticky_logo' alt='$logo_alt' class='logo-img'$style_height_sticky_logo></span>";
      $data .= "<span class='anps-logo__mobile'><img src='$mobile_logo' alt='$logo_alt' class='logo-img'></span>";
    } else {
      $data .= "<span class='logo-wrap'>" . str_replace('\\"', '"', $text_logo) . "</span>";
      $data .= "<span class='logo-sticky'>" . str_replace('\\"', '"', $text_logo) . "</span>";
      $data .= "<span class='logo-mobile'>" . str_replace('\\"', '"', $text_logo) . "</span>";
    }
    return $data;
  }
}
/* Page title */
if (!function_exists('anps_page_title')) {
  function anps_page_title()
  {
    if (is_home()) {
      echo get_the_title(get_option('page_for_posts'));
    } else if (is_day()) {
      echo esc_html__('Daily Archives', 'lapopsi') . ': ' . get_the_date();
    } else if (is_month()) {
      echo esc_html__('Monthly Archives', 'lapopsi') . ': ' . get_the_time('F');
    } else if (is_year()) {
      echo esc_html__('Yearly Archives', 'lapopsi') . ': ' . get_the_time('Y');
    } else if (is_search()) {
      echo esc_html__('Search results for', 'lapopsi') . ' "' . get_search_query() . '"';
    } else if (is_tag()) {
      echo esc_html__('Posts tagged', 'lapopsi') . ' "' . single_tag_title('', false) . '"';
    } else if (is_category() || (function_exists('is_product_category') && is_product_category())) {
      echo single_cat_title('', false);
    } else if (function_exists('is_shop') && is_shop()) {
      echo get_the_title(get_option('woocommerce_shop_page_id'));
    } else if (is_404()) {
      echo esc_html__('Page not found', 'lapopsi');
    } else if (is_author()) {
      echo esc_html__('Articles posted by', 'lapopsi') . ' ' . get_the_author();
    } elseif (is_archive()) {
      post_type_archive_title();
    } else {
      echo get_the_title();
    }
  }
}
/* Header image, video, gallery (blog) */
if (!function_exists('anps_header_media')) {
  function anps_header_media($id, $image_size)
  {
    /*
         * check for gallery
         * check for video
         * check for featured image
         */
    $header_media = '';
    if (get_post_meta($id, $key = 'gallery_images', $single = true)) {
      /* Get all images and unset the empty one */
      $gallery_images = explode(",", get_post_meta($id, $key = 'gallery_images', $single = true));
      $header_media = '<div class="post-carousel owl-carousel">';
      foreach ($gallery_images as $key => $item) {
        $image_src = wp_get_attachment_image_src($item, 'full');
        $image_title = get_the_title($item);
        if ($item == '') {
          unset($gallery_images[$key]);
        }
        $header_media .= "<div class='item'><a href='" . esc_url(get_the_permalink()) . "'><img alt='$image_title' src='$image_src[0]'></a></div>";
      }
      $header_media .= '</div>';
    } elseif (get_post_meta($id, $key = 'anps_featured_video', $single = true)) {
      $header_media = do_shortcode("[vc_video link='" . esc_attr(get_post_meta($id, $key = 'anps_featured_video', $single = true)) . "']");
    } elseif (has_post_thumbnail($id)) {
      /* anps_num_sidebars() */
      $header_media = "<a href='" . esc_url(get_the_permalink()) . "'>";
      $header_media .= get_the_post_thumbnail($id, $image_size, array());
      $header_media .= "</a>";
    }
    $allowed_tags = wp_kses_allowed_html('post');
    echo wp_kses($header_media, $allowed_tags);
  }
}
if (!function_exists('anps_get_attachment_caption')) {
  function anps_get_attachment_caption($id)
  {
    $caption = '';
    $image = get_post($id);

    if ($image->post_excerpt !== '') {
      $caption = $image->post_excerpt;
    } else if ($image->post_title !== '') {
      $caption = $image->post_title;
    }

    return $caption;
  }
}
/* Header image, video, gallery (blog, portfolio) */
if (!function_exists('anps_header_media_single')) {
  function anps_header_media_single($id)
  { ?>
    <!-- Code for gallery images -->
    <?php if (get_post_meta($id, $key = 'gallery_images', $single = true)) : ?>
      <?php
      /* Get all images and unset the empty one */
      $gallery_images = explode(",", get_post_meta($id, $key = 'gallery_images', $single = true));
      foreach ($gallery_images as $key => $item) {
        if ($item == '') {
          unset($gallery_images[$key]);
        }
      }
      ?>
      <div class="gallery-fs">
        <!-- First image -->
        <figure>
          <?php
          $image_src_first = wp_get_attachment_image_src($gallery_images[0], 'full');
          $image_alt_first = get_post_meta($gallery_images[0], '_wp_attachment_image_alt', true);
          ?>
          <?php echo '<img src="' . esc_url($image_src_first[0]) . '" alt="' . esc_attr($image_alt_first) . '">'; ?>
          <figcaption><?php echo anps_get_attachment_caption($gallery_images[0]); ?></figcaption>
        </figure>
        <div class="gallery-fs-nav">
          <a href="<?php echo esc_url($image_src_first[0]); ?>" class="gallery-fs-fullscreen"><i class="fa fa-arrows-alt"></i></a>
        </div>
        <!-- If there is more than 1 image, thumbnails gallery code s-->
        <?php if (count($gallery_images) > 1) : ?>
          <div class="gallery-fs-thumbnails gallery-fs-thumbnails-col-5 owl-carousel">
            <?php $i = 0;
            foreach ($gallery_images as $item) : ?>
              <?php
              $image_src_full = wp_get_attachment_image_src($item, 'full');
              $image_title = get_the_title($item);
              ?>
              <a href="<?php echo esc_url($image_src_full[0]); ?>" data-caption="<?php echo anps_get_attachment_caption($item); ?>" title="<?php echo esc_attr($image_title); ?>" <?php if ($i == 0) : ?>class="selected" <?php endif; ?>>
                <?php echo wp_get_attachment_image($item, 'anps-gallery-thumb'); ?>
              </a>
            <?php $i++;
            endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- If there is no gallery, than show video (if exists) -->
    <?php elseif (get_post_meta($id, $key = 'anps_featured_video', $single = true)) : ?>
      <div class="shadow">
        <!-- We are using visual composer shortcode -->
        <?php echo do_shortcode("[vc_video link='" . esc_attr(get_post_meta($id, $key = 'anps_featured_video', $single = true)) . "']") ?>
      </div>
      <!-- If no gallery, no video, show feature image  -->
    <?php elseif (has_post_thumbnail($id)) : ?>
      <?php
      $image = get_post_thumbnail_id($id);
      $image_title = get_post($image);
      ?>
      <div class="gallery-fs">
        <figure>
          <?php the_post_thumbnail($id); ?>
          <figcaption><?php echo esc_html($image_title->post_title); ?></figcaption>
        </figure>
        <div class="gallery-fs-nav">
          <a href="<?php echo wp_get_attachment_url(get_post_thumbnail_id($id)); ?>" class="gallery-fs-fullscreen"><i class="fa fa-arrows-alt"></i></a>
        </div>
      </div>
      <?php endif;
  }
}
/* Custom favicon */
if (!function_exists('anps_include_favicon')) {
  function anps_include_favicon()
  {
    if (!function_exists('has_site_icon') || !has_site_icon()) :
      if (get_option('anps_favicon', "") != "") : ?>
        <link rel="shortcut icon" href="<?php echo esc_url(get_option('anps_favicon')); ?>" type="image/x-icon" />
    <?php endif;
    endif;
  }
}
/* Check if it is sticky */
if (!function_exists('anps_is_sticky')) {
  function anps_is_sticky()
  {
    $class = '';
    if (get_option('anps_sticky_menu', '1') == '1' && get_option('anps_global_menu_type', 'classic-layout') != 'vertical-layout') {
      wp_enqueue_script('waypoints-theme');
      $class .= ' stickyheader';
    }
    if (get_option('anps_sticky_menu_mobile', '1') == '1' && get_option('anps_global_menu_type', 'classic-layout') != 'vertical-layout') {
      wp_enqueue_script('waypoints-theme');
      $class .= ' sticky-mobile';
    }
    return $class;
  }
}

/* Check for header/footer margin */
if (!function_exists('anps_header_margin')) {
  function anps_header_margin()
  {
    $class = '';
    $header_margin = get_post_meta(get_queried_object_id(), $key = 'anps_header_options_header_margin', $single = true);
    $footer_margin = get_post_meta(get_queried_object_id(), $key = 'anps_header_options_footer_margin', $single = true);
    if (isset($header_margin) && $header_margin == 'on') {
      $class .= ' header-spacing-off';
    }
    if (isset($footer_margin) && $footer_margin == 'on') {
      $class .= ' footer-spacing-off';
    }
    return $class;
  }
}

/* Return prefooter banner content */
if (!function_exists('anps_prefooter_banner_content')) {
  function anps_prefooter_banner_content()
  {
    $prefooter_banner_page = get_post_meta(get_queried_object_id(), $key = 'anps_footer_banner_page', $single = true);
    if (get_option('anps_global_footer_banner', 0) > 0 || $prefooter_banner_page > 0) {
      $banner_page_id =  get_option('anps_global_footer_banner');
      if ($prefooter_banner_page > 0) {
        $banner_page_id = $prefooter_banner_page;
      }
      $page_content = get_page($banner_page_id);
      $data = '';
      if (isset($page_content)) {
        $data .= '<div class="container">';
        $data .= do_shortcode($page_content->post_content);
        $vc_style = get_post_meta($banner_page_id, $key = '_wpb_shortcodes_custom_css', $single = true);
        $data .= "<style id='prefooter-style'>$vc_style</style>";
        $data .= '</div>';
      }
      return $data;
    }
  }
}
if (!function_exists('anps_is_transparent')) {
  function anps_is_transparent()
  {
    $id = get_queried_object_id();
    if (function_exists('is_shop') && (is_shop() || is_product())) {
      $id = get_option('woocommerce_shop_page_id');
    }

    $is_disabled = get_post_meta($id, $key = 'anps_disable_heading', $single = true);

    $full_screen = get_post_meta($id, $key = 'anps_page_heading_full', $single = true);
    $full_screen = str_replace('on', 'large', $full_screen);

    if ($full_screen === '') {
      $full_screen = get_option('anps_page_header_style', 'normal');
    }

    if (is_front_page() && get_option('anps_front_transparent_header') === '1') {
      return true;
    } else if ($is_disabled === '1' || get_option('anps_heading_status') === '') {
      return false;
    } else if ($full_screen === 'large') {
      return true;
    }

    return false;
  }
}
if (!function_exists('anps_transparent_class')) {
  function anps_transparent_class($el)
  {
    if (anps_is_transparent()) {
      return esc_attr(" {$el}--transparent");
    }
  }
}
/* Check for menu centered
 * 1) check if it is front page and is enable on front page (theme options) and it is classic menu type top
 * 2) check if it is enabled checkbox front page and enabled checkbox set as global
 * 3) check if global menu center is enabled and global checkbox is not enabled and classic menu type is top
 * 4) check if global menu center is enabled and global checkbox is not enabled and is not front page and classic menu type is bottom
 */
if (!function_exists('anps_menu_is_centered')) {
  function anps_menu_is_centered()
  {
    //front page
    $menu_centered_front = get_option('anps_front_menu_center', '0');
    $default_front_value = ' anps-header--right';
    if ($menu_centered_front == 0 && get_option('anps_home_classic_menu_type', 'top') == 'style2') {
      $default_front_value = ' anps-header--left';
    } elseif ($menu_centered_front == 1) {
      $default_front_value = ' anps-header--center';
    } elseif ($menu_centered_front == 2) {
      $default_front_value = ' anps-header--left';
    } elseif ($menu_centered_front == 3) {
      $default_front_value = ' anps-header--right';
    }
    //global checkbox + global transparent
    $global_checkbox = get_option('anps_set_settings_as_global_header', '0');
    $global_menu_center_checkbox = get_option('anps_global_menu_center', '0');
    $default_global_value = ' anps-header--right';
    if ($global_menu_center_checkbox == 0 && get_option('anps_home_classic_menu_type', 'top') == 'style2') {
      $default_global_value = ' anps-header--left';
    } elseif ($global_menu_center_checkbox == 1) {
      $default_global_value = ' anps-header--center';
    } elseif ($global_menu_center_checkbox == 2) {
      $default_global_value = ' anps-header--left';
    } elseif ($global_menu_center_checkbox == 3) {
      $default_global_value = ' anps-header--right';
    }
    if (get_option('anps_global_menu_type', 'classic-layout') == 'classic-layout') {
      if (is_front_page() && get_option('anps_home_classic_menu_type', 'top') == 'top') {
        return " $default_front_value";
      } elseif (is_front_page() && get_option('anps_home_classic_menu_type', 'top') == 'top-fullwidth-menu') {
        return " $default_front_value";
      } elseif ($global_checkbox == '1') {
        return " $default_front_value";
      } elseif ($global_checkbox == '' && get_option('anps_home_classic_menu_type', 'top') == 'top') {
        return " $default_global_value";
      } elseif ($global_checkbox == '' && get_option('anps_home_classic_menu_type', 'top') == 'top-fullwidth-menu') {
        return " $default_global_value";
      } elseif ($global_checkbox == '' && !is_front_page() && get_option('anps_home_classic_menu_type', 'top') == 'bottom') {
        return " $default_global_value";
      }
    }
    return '';
  }
}
/* Check if header type = vertical, than add class vertical to body */
if (!function_exists('anps_is_vertical')) {
  function anps_is_vertical()
  {
    //blank page header value
    $header_value = get_post_meta(get_the_ID(), $key = 'anps_blank_page_disable_header', $single = true);
    if (!isset($header_value) || $header_value != 'on') {
      if (get_option('anps_menu_type') == 'vertical') {
        return ' vertical-menu';
      }
    }
  }
}
/* Check if header type = bellow menu, than add class bottom */
if (!function_exists('anps_is_bellowmenu')) {
  function anps_is_bellowmenu()
  {
    if (get_option('anps_menu_type', 'top') == 'bottom' && is_front_page()) {
      return ' anps-header--bottom';
    }
    return '';
  }
}
/* Video types (for header) */
if (!function_exists('anps_heading_video')) {
  function anps_heading_video($video)
  {
    if (strpos($video, 'vimeo') !== false) {
      $video_explode = explode('/', $video);
      $count = count($video_explode) - 1;
      wp_enqueue_script('froogaloop2');
      return "<iframe id='vimeoplayer' src='https://player.vimeo.com/video/" . esc_attr($video_explode[$count]) . "?api=1&player_id=vimeoplayer&title=0&byline=0&portrait=01&autoplay=1&loop=1' width='500' height='281' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
    } elseif (strpos($video, 'youtube') !== false) {
      $video_explode = explode('v=', $video);
      return "<iframe id='ytplayer' src='https://www.youtube.com/embed/" . esc_attr($video_explode[1]) . "?enablejsapi=1&autoplay=1&controls=0&showinfo=0&loop=1&playlist=" . esc_attr($video_explode[1]) . "'></iframe>";
    } else {
      return "<video src='" . esc_url($video) . "' autoplay loop></video>";
    }
  }
}
/* adds fixed-footer class if it is selected in theme options */
if (!function_exists('anps_footer_style')) {
  function anps_footer_style()
  {
    if (get_option('anps_fixed_footer', '') === '1') {
      return ' fixed-footer';
    }
    return '';
  }
}
/* Menu and above navigation sidebar */
if (!function_exists('anps_get_menu')) {
  function anps_get_menu()
  {
    ?>
    <?php
    //above nav bar
    $above_nav_bar_global = get_option('anps_global_above_nav_bar', '1');
    $above_nav_bar_site = get_post_meta(get_queried_object_id(), $key = 'anps_header_options_above_menu', $single = true);
    /*
            * 1) chcek if above nav global is on AND page above nav is default
            * 2) check if page above nav is on
            * 3) check if above nav global is on AND page above nav is empty
            */
    if ((isset($above_nav_bar_site) && $above_nav_bar_site == '0' && $above_nav_bar_global == '1') || (isset($above_nav_bar_site) && $above_nav_bar_site == '2') || (isset($above_nav_bar_site) && $above_nav_bar_site == '' && $above_nav_bar_global == '1')) {
      $above_nav_bar = '1';
    } else {
      $above_nav_bar = '0';
    }
    /*
            * above navigation sidebar have to be enabled (theme options -> header options)
            * above-navigation-bar sidebars must be enabled
            * menu style has to be different than style2
            */
    if (($above_nav_bar == '1') && is_active_sidebar('above-navigation-bar') && get_option('anps_home_classic_menu_type', 'top') != 'style2') : ?>
      <div class="above-nav-bar">
        <?php dynamic_sidebar('above-navigation-bar'); ?>
      </div>
    <?php endif;
    $locations = get_theme_mod('nav_menu_locations');

    /* Check if menu is selected */
    $walker = '';
    $menu = '';
    $locations = get_theme_mod('nav_menu_locations');

    if ($locations && isset($locations['primary'])) {
      $menu = $locations['primary'];
      if ((isset($_GET['page']) && $_GET['page'] == 'one-page')) {
        $menu = 21;
      }
      if (get_option('anps_global_menu_walker', '1') == '1' && !is_customize_preview()) {
        $walker = new anps_menu_walker();
      }
    }

    echo '<nav class="anps-main-nav">';
    wp_nav_menu(array(
      'container' => false,
      'menu_class' => 'anps-main-menu',
      'menu_id' => 'anps-main-menu',
      'echo' => true,
      'before' => '',
      'after' => '',
      'link_before' => '',
      'items_wrap' => _anps_additional_menu_items(),
      'link_after' => '',
      'depth' => 0,
      'walker' => $walker,
      'menu' => $menu
    ));
    echo '</nav>';
  }
}

if (!function_exists('anps_get_menu_button')) {
  function anps_get_menu_button()
  {
    $data = '';
    if (get_option('anps_menu_type', 'top') == 'top-fullwidth-menu') {
      $data .= '<div class="menu-search-fullwidth-menu"><button class="menu-search-toggle menu-search-toggle--sm"><i class="fa fa-search"></i></button></div>';
    }
    $data .= '<button class="anps-menu-toggle"><i class="fa fa-bars"></i></button>';
    echo wp_kses($data, array(
      'div' => array(
        'class' => array(),
      ),
      'button' => array(
        'class' => array(),
      ),
      'i' => array(
        'class' => array(),
      ),
    ));
  }
}
/* For header type logo in the middle */
if (!function_exists('anps_menu_logo_center')) {
  function anps_menu_logo_center()
  {
    $locations = get_theme_mod('nav_menu_locations');
    ?>
    <div class="site-nav-wrap site-nav-wrap-left">
      <nav class="site-navigation site-navigation-left">
        <div class="mobile-wrap-left">
          <button class="burger"><span class="burger-top"></span><span class="burger-middle"></span><span class="burger-bottom"></span></button>
          <?php
          $location_left = '';
          if ($locations && isset($locations['primary'])) {
            $location_left = $locations['primary'];
          }
          wp_nav_menu(array(
            'container' => false,
            'menu_class' => 'main-menu',
            'menu_id' => 'left-menu',
            'echo' => true,
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'depth' => 0,
            'menu' => $location_left
          ));
          ?>
        </div>
      </nav>
    </div>

    <div class="logo">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <?php
        echo wp_kses(anps_logo(), array(
          'span' => array(
            'class' => array(),
            'style' => array(),
          ),
          'img' => array(
            'class' => array(),
            'src' => array(),
            'style' => array(),
            'alt' => array(),
          )
        ));
        ?>
      </a>
    </div>

    <div class="site-nav-wrap site-nav-wrap-right">
      <nav class="site-navigation site-navigation-right">
        <div class="mobile-wrap-right">
          <?php
          $location_right = '';
          if ($locations && isset($locations['anps_right'])) {
            $location_right = $locations['anps_right'];
          }
          wp_nav_menu(array(
            'container' => false,
            'menu_class' => 'main-menu',
            'menu_id' => 'right-menu',
            'echo' => true,
            'before' => '',
            'after' => '',
            'link_before' => '',
            'items_wrap' => _anps_additional_menu_items(),
            'link_after' => '',
            'depth' => 0,
            'menu' => $location_right
          ));
          ?>
        </div>
      </nav>
    </div>
  <?php
  }
}

function _anps_additional_menu_items()
{
  /* Check if search on desktop is enabled */
  $woocommerce_cart_page = get_option('anps_shopping_cart_header', 'hide');

  $data = '';
  $data .= '<ul id="%1$s" class="%2$s">%3$s';
  if (get_option('anps_global_search_icon', '1') == '1') {
    $data .= '<li class="menu-search">';
    $button_class = 'menu-search-toggle';
    if (get_option('anps_global_search_icon', '1') === '1') {
      $button_class .= ' menu-search-toggle--lg';
    }
    if (get_option('anps_global_search_icon_mobile', '1') === '1' && get_option('anps_menu_type', 'top') != 'top-fullwidth-menu') {
      $button_class .= ' menu-search-toggle--sm';
    }
    $data .= '<button class="' . $button_class . '"><i class="fa fa-search"></i></button>';
    $data .= '<div class="menu-search-form hide">';
    $data .= "<form method='get' action='" . urldecode(home_url("/")) . "'>";
    $data .= "<input class='menu-search-field' name='s' type='text' placeholder='" . esc_attr__('Search...', 'lapopsi') . "'>";
    $data .= '</form>';
    $data .= '</div>';
    $data .= '</li>';
  }

  if (get_option('anps_menu_type', 'top') !== 'top-fullwidth-menu') {
    $data .= anps_menu_button();
  }

  /* menu cart */
  $data .= anps_menu_cart();
  /* END menu cart */
  $data .= '</ul>';
  return $data;
}

if (!function_exists('anps_menu_button')) {
  function anps_menu_button($tag = 'li', $class = 'menu-button')
  {
    if (get_option('anps_menu_button', '') == '1') {
      $target = get_option('anps_menu_button_target', '_self');
      if ($target !== '0') {
        $target = ' target="' . $target . '"';
      } else {
        $target = '';
      }
      $data_pp = '';

      $link = get_option('anps_menu_button_url', '');

      $data = "<{$tag} class=\"{$class}\">";
      if (!$link) {
        $data .= '<button class="' . anps_get_menu_btn_class('menu') . '"' . $data_pp . '> ' . get_option('anps_menu_button_text', '') . '</button>';
      } else {
        $data .= '<a href="' . esc_url($link) . '"' . $target . ' class="' . anps_get_menu_btn_class('menu') . '"' . $data_pp . '> ' . get_option('anps_menu_button_text', '') . '</a>';
      }
      $data .= "</{$tag}>";

      return $data;
    }
  }
}

//hex2rgba
if (!function_exists('anps_hex2rgba')) {
  function anps_hex2rgba($color)
  {
    if (strlen($color) == 6) {
      list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
      list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
      return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    return "rgba($r, $g, $b, 0.8)";
  }
}

function anps_products_per_page()
{
  return get_option('anps_products_per_page', '12');
}
add_filter('loop_shop_per_page', 'anps_products_per_page', 20);

/* Mini cart */
if (!function_exists('anps_mini_cart')) {
  function anps_mini_cart()
  {
    if (function_exists('woocommerce_mini_cart')) {
      ob_start();
      woocommerce_mini_cart();
      $mini_cart = ob_get_clean();
      $data = sprintf(
        '<a class="mini-cart-link" href="%s" ><i class="fa fa-shopping-basket"></i><span class="mini-cart-number">%d</span></a>
          <div class="mini-cart-content">%s</div>',
        wc_get_cart_url(),
        WC()->cart->get_cart_contents_count(),
        $mini_cart
      );
      return $data;
    }
  }
}
/** Mini cart AJAX */
add_filter('woocommerce_add_to_cart_fragments', 'anps_woocommerce_add_to_cart_fragments');
if (!function_exists('anps_woocommerce_add_to_cart_fragments')) {
  function anps_woocommerce_add_to_cart_fragments($fragments)
  {
    global $woocommerce;
    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    $fragments['#anps-mini-cart'] = sprintf(
      '<li class="mini-cart" id="anps-mini-cart">
              <a class="mini-cart-link" href="%s" ><i class="fa fa-shopping-basket"></i><span class="mini-cart-number">%d</span></a>
              <div class="mini-cart-content">%s</div>
          </li>',
      wc_get_cart_url(),
      $woocommerce->cart->cart_contents_count,
      $mini_cart
    );
    return $fragments;
  }
}
/* Demo notice */
function anps_demo_notice($notice)
{
  echo '<div class="demo_store_wrapper"><div class="container">' . $notice . '</div></div>';
}
add_filter('woocommerce_demo_store', 'anps_demo_notice');

if (!function_exists('anps_menu_cart')) {
  function anps_menu_cart()
  {
    $woocommerce_cart_page = get_option('anps_shopping_cart_header', 'hide');
    $data = '';
    /*
         * 1) if enabled everywhere (themeoptions)
         * 2) if enabled only on shop (themeoptions) and page is woocommerce page
         */
    if (function_exists('woocommerce_mini_cart') && ($woocommerce_cart_page == 'always' || (is_woocommerce() && $woocommerce_cart_page == 'shop_only'))) {
      $data .= '<li class="mini-cart" id="anps-mini-cart">';
      $data .= anps_mini_cart();
      $data .= '</li>';
    }
    /* END if */
    return $data;
  }
}

/* WooCommerce checkout button */

function anps_woo_order_btn_html($btn)
{
  return str_replace('class="', 'class="' . anps_get_default_btn_class('md'), $btn);
}
add_filter('woocommerce_order_button_html', 'anps_woo_order_btn_html');

/* WooCommerce add to crat */

function anps_loop_add_to_cart_link($btn)
{
  $more_btn = '<a class="anps-product-more button" href="' . esc_url(get_the_permalink()) . '">' . __('View product', 'lapopsi') . '</a>';

  return $btn . $more_btn;
}
add_filter('woocommerce_loop_add_to_cart_link', 'anps_loop_add_to_cart_link');

/* MegaMenu Walker class */
class anps_menu_walker extends Walker_Nav_Menu
{
  function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
  {
    $append = "";
    $prepend = "";
    if (get_post_meta($item->ID, 'anps-megamenu', true) == '1') {
      $megamenu_wrapper_class = ' megamenu-wrapper';
      unset($item->classes[0]);
    } else {
      $megamenu_wrapper_class = '';
    }

    $indent = ($depth) ? str_repeat("\t", $depth) : '';
    $class_names = $value = '';
    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
    $class_names = ' class="' . esc_attr($class_names . $megamenu_wrapper_class) . '"';

    $output .= $indent . '<li' . $value . $class_names . '>';
    $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url)        ? ' href="'   . esc_url($item->url) . '"' : '';

    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));

    /* Description */
    $description  = !empty($item->description) ? '<span class="menu-item-desc">' . esc_attr($item->description) . '</span>' : '';
    $description = do_shortcode($description);
    if ($depth > 0) {
      $description = "";
    }
    /* END Description */
    $locations = get_theme_mod('nav_menu_locations');
    if ($locations['primary']) {
      $item_output = "";
      $item_output = $args->before;
      $item_output .= '<a' . $attributes . '>';

      $item_output .= $args->link_before . $prepend . apply_filters('the_title', $item->title, $item->ID) . $append;
      $item_output .= '</a>';
      $item_output .= $description . $args->link_after;
      $item_output .= $args->after;
      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth = 0, $args, $args, $current_object_id = 0);
    }
  }
}
if (!function_exists('anps_mobile_search')) {
  function anps_mobile_search()
  {
  ?>
    <div class="site-search">
      <div class="container">
        <form method="get" id="searchform-header" class="site-search__form" action="<?php echo urldecode(home_url('/')); ?>">
          <input class="site-search__field" name="s" type="text" placeholder="<?php esc_attr_e('Search...', 'lapopsi'); ?>" />
          <button type="submit" class="site-search__submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>
  <?php
  }
}
//get post_type
if (!function_exists('anps_get_current_post_type')) {
  function anps_get_current_post_type()
  {
    if (is_admin()) {
      global $post, $typenow, $current_screen;
      //we have a post so we can just get the post type from that
      if ($post && $post->post_type) {
        return $post->post_type;
      }
      //check the global $typenow - set in admin.php
      elseif ($typenow) {
        return $typenow;
      }
      //check the global $current_screen object - set in sceen.php
      elseif ($current_screen && $current_screen->post_type) {
        return $current_screen->post_type;
      }
      //lastly check the post_type querystring
      elseif (isset($_REQUEST['post_type'])) {
        return sanitize_key($_REQUEST['post_type']);
      } elseif (isset($_REQUEST['post'])) {
        return get_post_type($_REQUEST['post']);
      }
      //we do not know the post type!
      return null;
    }
  }
}
/* Comments */
if (!function_exists('anps_comment')) {
  function anps_comment($comment, $args, $depth)
  {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
  ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <div id="div-comment-<?php comment_ID() ?>" class="comment__wrap">
        <div class="comment__avatar">
          <?php echo get_avatar($comment, 86); ?>
        </div>

        <div class="comment__content">
          <div class="comment-meta">
            <strong class="comment-meta__author"><?php comment_author_link(); ?></strong>
            <span class="comment-meta__author-badge"><?php esc_html_e('Author', 'lapopsi'); ?></span>
            <span class="comment-meta__date"><?php comment_date(); ?></span>
          </div>
          <div class="comment__text">
            <?php comment_text(); ?>

            <?php if ($comment->comment_approved == '0') : ?>
              <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'lapopsi'); ?></em>
            <?php endif; ?>
          </div>

          <?php
          $args_reply = array(
            'add_below' => 'comment',
            'depth' => $depth,
          );
          $args_reply = array_merge($args, $args_reply);

          comment_reply_link($args_reply);

          edit_comment_link();
          ?>
        </div>
      </div>
    <?php
  }
}
/* If user is admin, he will see theme options */
if (!function_exists('anps_theme_options_add_page')) {
  function anps_theme_options_add_page()
  {
    if (current_user_can('manage_options')) {
      add_theme_page(esc_html__('Theme Options', 'lapopsi'), esc_html__('Theme Options', 'lapopsi'), 'read', 'theme_options', 'anps_theme_options_do_page');
    }
    //if plugin enabled add plugin options
    if (current_user_can('manage_options') && function_exists('anps_portfolio')) {
      add_theme_page(esc_html__('Plugin Options', 'lapopsi'), esc_html__('Plugin Options', 'lapopsi'), 'read', 'anps_plugin_options', 'anps_plugin_options_do_page');
    }
  }
}
add_action('admin_menu', 'anps_theme_options_add_page');
/* Load admin_view.php page */
if (!function_exists('anps_theme_options_do_page')) {
  function anps_theme_options_do_page()
  {
    include_once get_template_directory() . '/anps-framework/views/admin_view.php';
  }
}
/* Custom styles for buttons */
if (!function_exists('anps_custom_styles_buttons')) {
  function anps_custom_styles_buttons()
  {
    return;
  }
}
/*Get content for pages, posts and add the correct wrapper around it*/
if (!function_exists('anps_the_content')) {
  function anps_the_content($content = null)
  {
    $num_of_sidebars = 0;
    if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
      $num_of_sidebars = anps_num_sidebars();
    }
    $class = '';

    $class_size = ' col-md-' . (12 - $num_of_sidebars * 3);

    if (function_exists('is_account_page') && is_account_page() && is_user_logged_in()) {
      $class_size = '';
    }

    if ($num_of_sidebars > 0) {
      $class = 'page-content';
    }
    ?>
      <div class="<?php echo esc_attr($class . $class_size); ?>">
        <div class="page-content-wrap">
          <?php
          if ($content == null) {
            the_content();
          } else {
            echo esc_html($content);
          }
          ?>
        </div>
        <?php
        wp_link_pages(array(
          'before'           => '<div class="nav-links-sm">' . __('Pages:', 'lapopsi'),
          'after'            => '</div>',
          'next_or_number'   => 'number',
          'separator'        => ' ',
          'pagelink'         => '%',
        ));

        if ((comments_open() || get_comments_number()) && get_option('anps_page_comments', '1') == '1') {
          comments_template();
        }
        ?>
      </div>
    <?php
  }
}
/* Get custom font extenstion */
if (!function_exists('anps_getExtCustomFonts')) {
  function anps_getExtCustomFonts($font)
  {
    $dir = get_template_directory() . '/fonts';
    if ($handle = opendir($dir)) {
      $arr = array();
      //Get all files and store it to array
      while (false !== ($entry = readdir($handle))) {
        $explode_font = explode('.', $entry);
        if (strtolower($font) == strtolower($explode_font[0])) {
          //Allow only .eot, .woff, .woff2, .otf and .ttf
          if (strtolower($explode_font[1]) == "eot" || strtolower($explode_font[1]) == "woff" || strtolower($explode_font[1]) == "otf" || strtolower($explode_font[1]) == "ttf" || strtolower($explode_font[1]) == "woff2") {
            $arr[] = $entry;
          }
        }
      }
      closedir($handle);
      return $arr;
    }
  }
}
/* Load custom font (CSS) */
if (!function_exists('anps_custom_font')) {
  function anps_custom_font($font)
  {
    $font_family = esc_attr($font);
    $font_has_eot = false;
    $font_count  = count(anps_getExtCustomFonts($font));
    $i           = 0;
    $prefix      = 'url("' . get_template_directory_uri() . '/fonts/';
    $font_src = '';
    $font_srcs   = '';

    foreach (anps_getExtCustomFonts($font) as $item) {
      $explode_item = explode('.', $item);

      $name = $explode_item[0];
      $extension = $explode_item[1];
      $separator = ',';

      if (++$i == $font_count) {
        $separator = ';';
      }

      switch ($extension) {
        case 'eot':
          $font_srcs .= $prefix . $name . '.eot?#iefix") format("embedded-opentype")' . $separator;
          $font_has_eot = true;
          break;
        case 'woff':
          $font_srcs .= $prefix . $name . '.woff") format("woff")' . $separator;
          break;
        case 'otf':
          $font_srcs .= $prefix . $name . '.otf") format("opentype")' . $separator;
          break;
        case 'ttf':
          $font_srcs .= $prefix . $name . '.ttf") format("ttf")' . $separator;
          break;
        case 'woff2':
          $font_srcs .= $prefix . $name . '.woff2") format("woff2")' . $separator;
          break;
      }
    } /* end foreach */

    if ($font_has_eot) {
      $font_src = 'src: url("' . get_template_directory_uri() . '/fonts/' . $font_family . '.eot);';
    }
    ?>
      @font-face {
      font-family: "<?php echo esc_attr($font_family); ?>";
      <?php echo strip_tags($font_src); ?>
      src: <?php echo strip_tags($font_srcs); ?>
      }
  <?php
  }
}
/* Sets the post excerpt length (default 40) */
add_filter('excerpt_length', 'anps_excerpt_length');
if (!function_exists('anps_excerpt_length')) {
  function anps_excerpt_length($length)
  {
    return get_option('anps_excerpt_length', '40');
  }
}
/* Replaces default excerpt more text with an ellipsis */
add_filter('excerpt_more', 'anps_excerpt_more');
if (!function_exists('anps_excerpt_more')) {
  function anps_excerpt_more($more)
  {
    return ' &hellip;';
  }
}
if (!function_exists('anps_post_meta')) {
  function anps_post_meta($single = '', $post_id = '', $class = '')
  {
    $meta = '';
    if ($single) {
      $single = '_single';
    }

    /* Author */
    if (get_option('anps_post_meta_author' . $single, '1') == '1') {
      $author_id = get_post_field('post_author', $post_id);
      $meta .= '<li class="post-meta__item author vcard">
                <span>' . esc_html__('posted by', 'lapopsi') . '</span> <span class="fn">' . get_the_author_meta('display_name', $author_id) . '</span>
            </li>';
    }

    /* Date */
    if (get_option('anps_post_meta_date' . $single, '1') == '1') {
      $meta .= "<li class='post-meta__item'>
                <time datetime='" . get_the_time("Y-m-d h:s") . "'>" . get_the_time(get_option("date_format")) . "</time>
            </li>";
    }

    /* Comments */
    if (get_option('anps_post_meta_comments' . $single, '1') == '1') {
      ob_start();
      comments_number();
      $comments = ob_get_clean();

      $meta .= "<li class='post-meta__item'>
                " . $comments . "
            </li>";
    }

    /* Categories */
    if ($single == '' && (get_option('anps_post_meta_categories', '1') == '1')) {
      $category_list = get_the_category_list(', ');
      $meta .= '<li class="post-meta__item">';
      $meta .= $category_list;
      $meta .= '</li>';
    }

    if ($meta != '') {
      $meta = "<ul class='post-meta$class'>" . $meta . "</ul>";
    }
    //escaped above in code
    return $meta;
  }
}
/* Add dropcaps option to TinyMCE, */
function anps_add_buttons($plugin_array)
{
  $plugin_array['anps'] = get_template_directory_uri() . '/anps-framework/js/tinymce_extend.js';
  return $plugin_array;
}
add_filter("mce_external_plugins", "anps_add_buttons");
/* Add background option to TinyMCE */
if (!function_exists('anps_tinymce_add_buttons')) {
  function anps_tinymce_add_buttons($buttons)
  {
    $new_buttons = array();
    $counter = 0;

    foreach ($buttons as $button) {
      $new_buttons[$counter++] = $button;

      /* Add the color right after color option */
      if ($button == 'forecolor') {
        $new_buttons[$counter++] = 'backcolor';
      }
    }

    /* Dropcap */

    array_push($new_buttons, 'dropcap');

    return $new_buttons;
  }
}
add_filter("mce_buttons_2", "anps_tinymce_add_buttons");
/* After setup theme */
if (!function_exists('anps_setup')) {
  function anps_setup()
  {
    // This theme uses post thumbnails
    add_theme_support('post-thumbnails');
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // This theme uses wp_nav_menu() in one location.
    if (get_option('anps_home_classic_menu_type', 'top') == 'style4') {
      register_nav_menus(array(
        'primary' => esc_html__('Left Navigation', 'lapopsi'),
        'anps_right' => esc_html__('Right Navigation', 'lapopsi'),
      ));
    } else {
      register_nav_menus(array(
        'primary' => esc_html__('Primary Navigation', 'lapopsi'),
      ));
    }
  }
}
add_action('after_setup_theme', 'anps_setup');
/* Remove WooCommerce styling */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');
/* Change comment form position (WordPress 4.4) */
function anps_comment_field_to_bottom($fields)
{
  $comment_field = $fields['comment'];
  unset($fields['comment']);
  $fields['comment'] = $comment_field;
  return $fields;
}
add_filter('comment_form_fields', 'anps_comment_field_to_bottom');
/* Change WooCommerce loop title */
function woocommerce_template_loop_product_title()
{
  echo '<a href="' . esc_url(get_the_permalink()) . '"><h3 class="product-title">' . get_the_title() . '</h3></a>';
}
/* Custom styles */
include_once get_template_directory() . '/anps-framework/custom_styles.php';
/* Wrap font with quotes */
if (!function_exists('anps_wrap_font')) {
  function anps_wrap_font($font)
  {
    $temp = explode(', ', $font);
    $return = '';

    if (count($temp) > 1) {
      foreach ($temp as $name) {
        if ($return === '') {
          $return .= "'$name'";
        } else {
          $return .= ", $name";
        }
      }
    } else {
      $return = "'$font'";
    }

    return $return;
  }
}

/* Style attribute helper functions */
function anps_style_bg_color($color)
{
  return anps_style_attr(array('background-color' => $color));
}
function anps_style_color($color)
{
  return anps_style_attr(array('color' => $color));
}
function anps_style_attr($styles)
{
  $return = '';

  foreach ($styles as $property => $value) {
    if ($value !== '' && $value !== ' ') {
      $return .= $property . ': ' . $value . '; ';
    }
  }

  if ($return !== '') {
    $return = ' style="' . $return . '"';
  }

  return $return;
}

function anps_hover_style($styles)
{
  $styles_new = array();

  foreach ($styles as $name => $val) {
    if ($val !== '') {
      $styles_new[$name] = $val;
    }
  }

  if (count($styles_new) > 0) {
    return ' data-hstyle=\'' . json_encode($styles_new) . '\'';
  }

  return '';
}

function anps_get_vc_link($link)
{
  $link_data = ' href="#"';

  if ($link !== '') {
    $link_data_temp = explode('|', str_replace('url', 'href', $link));

    $link_data = '';

    foreach ($link_data_temp as $link_attribute) {
      $link_attribute = explode(':', $link_attribute);

      if (isset($link_attribute[0]) && isset($link_attribute[1])) {
        $link_data .= ' ' . $link_attribute[0] . '="' . rawurldecode($link_attribute[1]) . '"';
      }
    }
  }

  return $link_data;
}

if (!function_exists('anps_mobile_menu')) {
  function anps_mobile_menu()
  {
    $menu = '';
    $locations = get_theme_mod('nav_menu_locations');

    if ($locations && isset($locations['primary'])) {
      $menu = $locations['primary'];
    }

    echo '<nav class="anps-mobile-menu">';
    echo '<div class="anps-menu-toggle__button">';
    echo '<button class="anps-menu-toggle anps-menu-toggle--sidebar"><i class="fa fa-close"></i></button>';
    echo '</div>';
    wp_nav_menu(array(
      'container' => false,
      'menu_class' => 'main-menu',
      'menu_id' => 'main-menu',
      'echo' => true,
      'before' => '',
      'after' => '',
      'link_before' => '',
      'items_wrap' => _anps_additional_menu_items(),
      'link_after' => '',
      'depth' => 0,
      'menu' => $menu,
    ));
    if (get_option('anps_menu_type') == 'top-fullwidth-menu') {
      echo anps_menu_button('div', 'menu-button');
    }
    echo '</nav>';
  }
}

function anps_get_the_btn($id)
{
  $buttons_data = json_decode(stripslashes(get_option('anps-buttons', '{"defaultButton":0,"secondaryButton":1,"buttons":[{"name":"Main button","type":"gradient","normalStyle":{"color":"ffffff","background-color-1":"53caf2","background-color-2":"17c5ff","border-radius":"5","box-shadow":""},"hoverStyle":{},"id":0},{"name":"Normal button","type":"normal","normalStyle":{"background-color":"eceff4","border-radius":"5","box-shadow":"","color":"878a9d"},"hoverStyle":{"background-color":"e2e5eb","color":"6a6e85"},"id":1},{"name":"Border button","type":"border","normalStyle":{"color":"383e48","background-color":"","border-color":"3acbfd","border-radius":"5","border-width":"2"},"hoverStyle":{"background-color":"","border-color":"3acbfd","color":"3acbfd"},"id":2},{"name":"Text button","type":"text","normalStyle":{"color":"383e48"},"hoverStyle":{"color":"3acbfd"},"id":3}],"menuButton":2}')));
  $buttons = $buttons_data->buttons;

  $default_button = '';

  foreach ($buttons as $button) {
    if ($button->id == $id) {
      $default_button = $button;
    }
  }

  return $default_button;
}

function anps_get_default_btn()
{
  $buttons_data = json_decode(stripslashes(get_option('anps-buttons', '{"defaultButton":0,"secondaryButton":1,"buttons":[{"name":"Main button","type":"gradient","normalStyle":{"color":"ffffff","background-color-1":"53caf2","background-color-2":"17c5ff","border-radius":"5","box-shadow":""},"hoverStyle":{},"id":0},{"name":"Normal button","type":"normal","normalStyle":{"background-color":"eceff4","border-radius":"5","box-shadow":"","color":"878a9d"},"hoverStyle":{"background-color":"e2e5eb","color":"6a6e85"},"id":1},{"name":"Border button","type":"border","normalStyle":{"color":"383e48","background-color":"","border-color":"3acbfd","border-radius":"5","border-width":"2"},"hoverStyle":{"background-color":"","border-color":"3acbfd","color":"3acbfd"},"id":2},{"name":"Text button","type":"text","normalStyle":{"color":"383e48"},"hoverStyle":{"color":"3acbfd"},"id":3}],"menuButton":2}')));

  if (!empty($buttons_data)) {
    return anps_get_the_btn($buttons_data->defaultButton);
  }
}

function anps_get_secondary_btn()
{
  $buttons_data = json_decode(stripslashes(get_option('anps-buttons', '{"defaultButton":0,"secondaryButton":1,"buttons":[{"name":"Main button","type":"gradient","normalStyle":{"color":"ffffff","background-color-1":"53caf2","background-color-2":"17c5ff","border-radius":"5","box-shadow":""},"hoverStyle":{},"id":0},{"name":"Normal button","type":"normal","normalStyle":{"background-color":"eceff4","border-radius":"5","box-shadow":"","color":"878a9d"},"hoverStyle":{"background-color":"e2e5eb","color":"6a6e85"},"id":1},{"name":"Border button","type":"border","normalStyle":{"color":"383e48","background-color":"","border-color":"3acbfd","border-radius":"5","border-width":"2"},"hoverStyle":{"background-color":"","border-color":"3acbfd","color":"3acbfd"},"id":2},{"name":"Text button","type":"text","normalStyle":{"color":"383e48"},"hoverStyle":{"color":"3acbfd"},"id":3}],"menuButton":2}')));

  if (!empty($buttons_data)) {
    return anps_get_the_btn($buttons_data->secondaryButton);
  }
}

function anps_get_menu_btn()
{
  $buttons_data = json_decode(stripslashes(get_option('anps-buttons', '{"defaultButton":0,"secondaryButton":1,"buttons":[{"name":"Main button","type":"gradient","normalStyle":{"color":"ffffff","background-color-1":"53caf2","background-color-2":"17c5ff","border-radius":"5","box-shadow":""},"hoverStyle":{},"id":0},{"name":"Normal button","type":"normal","normalStyle":{"background-color":"eceff4","border-radius":"5","box-shadow":"","color":"878a9d"},"hoverStyle":{"background-color":"e2e5eb","color":"6a6e85"},"id":1},{"name":"Border button","type":"border","normalStyle":{"color":"383e48","background-color":"","border-color":"3acbfd","border-radius":"5","border-width":"2"},"hoverStyle":{"background-color":"","border-color":"3acbfd","color":"3acbfd"},"id":2},{"name":"Text button","type":"text","normalStyle":{"color":"383e48"},"hoverStyle":{"color":"3acbfd"},"id":3}],"menuButton":2}')));

  $id = get_queried_object_id();
  if (function_exists('is_shop') && (is_shop() || is_product())) {
    $id = get_option('woocommerce_shop_page_id');
  }

  $anps_page_menu_button = get_post_meta($id, 'anps_page_menu_button', true);

  if (!empty($buttons_data)) {
    if ($anps_page_menu_button !== '' && !is_search() && !is_404()) {
      return anps_get_the_btn($anps_page_menu_button);
    } else if (property_exists($buttons_data, 'menuButton')) {
      return anps_get_the_btn($buttons_data->menuButton);
    } else {
      return anps_get_the_btn($buttons_data->defaultButton);
    }
  }
}

function anps_get_default_btn_class($size)
{
  $default_btn = anps_get_default_btn();

  if (!empty($default_btn)) {
    return 'anps-btn anps-btn--' . $size . ' anps-btn--style-' . $default_btn->id . ' anps-btn--' . $default_btn->type;
  } else {
    return false;
  }
}

function anps_get_secondary_btn_class($size)
{
  $secondary_btn = anps_get_secondary_btn();

  if (!empty($secondary_btn)) {
    return 'anps-btn anps-btn--' . $size . ' anps-btn--style-' . $secondary_btn->id . ' anps-btn--' . $secondary_btn->type;
  } else {
    return false;
  }
}

function anps_get_menu_btn_class($size)
{
  $menu_btn = anps_get_menu_btn();

  if (!empty($menu_btn)) {
    return 'anps-btn anps-btn--' . $size . ' anps-btn--style-' . $menu_btn->id . ' anps-btn--' . $menu_btn->type;
  } else {
    return false;
  }
}

function anps_style_fallback()
{
  $css_variables = anps_style_options();
  $request = wp_remote_get(get_template_directory_uri() . '/css/style-fallback.css');
  $css = wp_remote_retrieve_body($request);

  foreach ($css_variables as $name => $value) {
    $css = str_replace("var(--{$name})", $value, $css);
  }

  die($css);
}

add_action('wp_ajax_anps_style_fallback', 'anps_style_fallback');
add_action('wp_ajax_nopriv_anps_style_fallback', 'anps_style_fallback');

function anps_color($color)
{
  if ($color === '') {
    return '';
  }

  return strpos($color, 'rgb') !== false ? esc_attr($color) : '#' . esc_attr($color);
}

function anps_style_options()
{
  $id = get_queried_object_id();
  if (function_exists('is_shop') && is_shop()) {
    $id = get_option('woocommerce_shop_page_id');
  }

  $anps_page_bg = anps_color(get_option('anps_page_bg_color', 'ffffff'));
  $anps_meta_color_page = get_post_meta(get_the_ID(), 'anps_color_page', true);
  if ($anps_meta_color_page !== '') {
    $anps_page_bg = $anps_meta_color_page;
  }

  $page_title = anps_color(get_option('anps_page_title', 'ffffff'));

  $page_title_lg = get_post_meta($id, $key = 'anps_page_heading_full', $single = true);
  $page_title_lg = str_replace('on', 'large', $page_title_lg);

  if ($page_title_lg === '' || $page_title_lg === false) {
    $page_title_lg = get_option('anps_page_header_style', 'normal');
  }

  $page_title_meta_name = $page_title_lg === 'large' ? 'anps_full_color_title' : 'anps_color_title';
  $page_title_meta = get_post_meta($id, $key = $page_title_meta_name, $single = true);
  if ($page_title_meta !== '' && $page_title_meta !== false) {
    $page_title = $page_title_meta;
  }

  $hmain_bg = anps_color(get_option('anps_header_main_bg_color', '171d2f'));

  $menu_color = anps_color(get_option('anps_menu_text_color', '565656'));
  $menu_color_hover = anps_color(get_option('anps_menu_text_hover_color', '000000'));
  $menu_active_color = anps_color(get_option('anps_menu_text_active_color', '2dc1f3'));
  $top_bar_color = anps_color(get_option('anps_top_bar_color', '878a9d'));
  $menu_bar_height = get_option('anps_menu_height', '90') . 'px';
  $hbar_bg = anps_color(get_option('anps_menu_bg_color', 'ffffff'));
  $hbar_bg2 = anps_color(get_option('anps_menu_bg_color2', ''));

  if ($hbar_bg !== $hbar_bg2 && $hbar_bg2 !== '') {
    $hbar_bg = 'linear-gradient(90deg, ' . $hbar_bg . ', ' . $hbar_bg2 . ')';
  }

  if (anps_is_transparent()) {
    $menu_color_transparent = anps_color(get_option('anps_menu_transparent_text_color', ''));
    if ($menu_color_transparent != '') {
      $menu_color = $menu_color_transparent;
    }

    $menu_color_hover_transparent = anps_color(get_option('anps_menu_transparent_text_hover_color', ''));
    if ($menu_color_hover_transparent != '') {
      $menu_color_hover = $menu_color_hover_transparent;
    }

    $menu_active_transparent = anps_color(get_option('anps_menu_transparent_active', ''));
    if ($menu_active_transparent !== '' && $menu_active_transparent !== false) {
      $menu_active_color = $menu_active_transparent;
    }

    $menu_bar_height_transparent = get_option('anps_menu_transparent_height', '');
    if ($menu_bar_height_transparent != '') {
      $menu_bar_height = $menu_bar_height_transparent . 'px';
    }

    $top_bar_color_transparent = anps_color(get_option('anps_menu_transparent_topbar_color', ''));
    if ($top_bar_color_transparent != '') {
      $top_bar_color = $top_bar_color_transparent;
    }

    $transparent_bg = anps_color(get_option('anps_menu_transparent_bg_color', ''));
    $transparent_bg2 = anps_color(get_option('anps_menu_transparent_bg2_color', ''));

    $hbar_bg = $transparent_bg;
    if ($transparent_bg !== $transparent_bg2 && $transparent_bg2 !== '') {
      $hbar_bg = 'linear-gradient(90deg, ' . $transparent_bg . ', ' . $transparent_bg2 . ')';
    }
  }

  if ($page_title_lg === 'large') {
    if ($page_title_meta !== '' && $page_title_meta !== false) {
      $menu_color = $page_title;
    }
    $menu_color_hover_meta = get_post_meta($id, $key = 'anps_full_hover_color', $single = true);
    if ($menu_color_hover_meta !== '' && $menu_color_hover_meta !== false) {
      $menu_color_hover = $menu_color_hover_meta;
    }
    $top_bar_color = get_post_meta($id, $key = 'anps_full_color_top_bar', $single = true);
  }

  $page_header_bg1 = anps_color(get_option('anps_page_header_background_color1', '2cc7fc'));
  $page_header_bg2 = anps_color(get_option('anps_page_header_background_color2', '049ef4'));

  $page_header_bg = $page_header_bg1;

  if ($page_header_bg2 !== $page_header_bg1 && $page_header_bg2 !== '') {
    $page_header_bg = 'linear-gradient(90deg, ' . $page_header_bg1 . ', ' . $page_header_bg2 . ')';
  }

  $sticky_bg = anps_color(get_option('anps_sticky_bg', 'fff'));
  $sticky_bg2 = anps_color(get_option('anps_sticky_bg2', ''));

  if ($sticky_bg !== $sticky_bg2 && $sticky_bg2 !== '') {
    $sticky_bg = 'linear-gradient(90deg, ' . $sticky_bg . ', ' . $sticky_bg2 . ')';
  }

  return array(
    /* Main theme colors */
    'anps-text-color' => anps_color(get_option('anps_text_color', '878a9d')),
    'anps-page-bg' => esc_attr($anps_page_bg),
    'anps-secondary' => anps_color(get_option('anps_secondary_color', 'd7f4fe')),
    'anps-secondary-background' => anps_color(get_option('anps_secondary_background_color', '3acbfd')),
    'anps-primary' => anps_color(get_option('anps_primary_color', 'fc6c5f')),
    'anps-headings' => anps_color(get_option('anps_headings_color', '000000')),

    /* Typography Options */
    'anps-menu-font-size' => get_option('anps_menu_font_size', '16') . 'px',
    'anps-submenu-font-size' => get_option('anps_submenu_font_size', '14') . 'px',
    'anps-top-bar-font-size' => get_option('anps_top_bar_font_size', '13') . 'px',

    /* Header Options */
    'anps-breadcrumbs-color' => anps_color(get_option('anps_breadcrumbs_text_color', '999cab')),
    'anps-breadcrumbs-border-color' => anps_color(get_option('anps_breadcrumbs_border_color', 'e7e7e7')),
    'anps-breadcrumbs-bg-color' => anps_color(get_option('anps_breadcrumbs_bg_color', 'fff')),

    'anps-main-space-top' => get_option('anps_main_space_top', '70') . 'px',
    'anps-main-space-bottom' => get_option('anps_main_space_bottom', '70') . 'px',

    'anps-top-bar-color' => $top_bar_color,
    'anps-top-bar-bg-color' => anps_color(get_option('anps_top_bar_bg_color', '252e42')),
    'anps-top-bar-height' => get_option('anps_top_bar_height', '50') . 'px',

    'anps-menu-mobile-icons' => anps_color(get_option('anps_menu_mobile_icons', '202431')),

    'anps-submenu-bg-color' => anps_color(get_option('anps_submenu_background_color', 'ffffff')),
    'anps-submenu-color' => anps_color(get_option('anps_submenu_text_color', '8c8c8c')),
    'anps-submenu-color--active' => anps_color(get_option('anps_submenu_text_active_color', '000000')),
    'anps-submenu-color--hover' => anps_color(get_option('anps_submenu_text_hover_color', '000000')),

    'anps-page-title' => $page_title,
    'anps-page-header-bg' => $page_header_bg,
    'anps-page-header-height' => get_option('anps_page_header_height', '110') . 'px',
    'anps-page-header-lg-height' => get_option('anps_page_header_lg_height', '370') . 'px',

    'anps-menu-color' => $menu_color,
    'anps-menu-color--hover' => $menu_color_hover,
    'anps-menu-color--active' => $menu_active_color,

    'anps-header-search-text-color' => anps_color(get_option('anps_header_search_text_color', '000')),
    'anps-header-search-background-color' => anps_color(get_option('anps_header_search_background_color', '888')),

    'anps-hmain-bg' => $hmain_bg,

    /* Menu bar */
    'anps-hbar-bg' => $hbar_bg,
    'anps-hbar-height' => $menu_bar_height,
    'anps-hbar-height--sticky' => get_option('anps_menu_sticky_height', '74') . 'px',
    'anps-hbar-m-height' => get_option('anps_menu_mobile_height', '74') . 'px',
    'anps-hbar-m-height--sticky' => get_option('anps_menu_sticky_mobile_height', '60') . 'px',

    /* Sticky */
    'anps-sticky-bg' => $sticky_bg,
    'anps-sticky-color' => anps_color(get_option('anps_sticky_color', '565656')),
    'anps-sticky-color--hover' => anps_color(get_option('anps_sticky_color_hover', '000000')),
    'anps-sticky-color--active' => anps_color(get_option('anps_sticky_color_active', '2dc1f3')),

    /* Footer Options */
    'anps-footer-hover-color' => anps_color(get_option('anps_footer_hover_color', '')),
    'anps-footer-heading-color' => anps_color(get_option('anps_footer_heading_text_color', '383e48')),

    /* Menu Options */
    'anps-menu-spacing' => get_option('anps_menu_spacing', '15') . 'px',

    /* Popup background */
    'anps-whitelist-token-overlay-bg-color' => anps_hex2rgba(get_option('anps_whitelist_token_overlay_bg_color', 'fff')),
  );
}

function anps_menu_shadow()
{
  return get_option('anps_menu_shadow', '1') === '1' ? ' anps-header--shadow' : '';
}

function anps_menu_border()
{
  return get_option('anps_page_header_divider', '1') === 'border' ? ' anps-header--border' : '';
}

function anps_header_full_width()
{
  return get_option('anps_header_full_width', '1') === '1' ? ' anps-header--full-width' : '';
}

function anps_is_empty_style($value)
{
  return $value !== '' && $value !== ' ' && $value !== 'px' && $value !== '#';
}

//Ajax load more posts
function anps_ajax_load_more()
{
  $current_page = 1;
  if (isset($_POST['current_page']) && $_POST['current_page'] > 0) {
    $current_page = $_POST['current_page'];
  }
  $args = array(
    'per_page' => get_option('posts_per_page'),
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged' => $current_page + 1
  );
  $posts = new WP_Query($args);

  $post_text = "";
  if ($posts->have_posts()) :
    WPBMap::addAllMappedShortcodes();
    global $counter_blog;
    $counter_blog = 1;
    while ($posts->have_posts()) :
      set_query_var('ajax_load_more', '1');
      set_query_var('post_style', 'style-2');
      set_query_var('image_size', 'img-normal');
      $posts->the_post();
      ob_start();
      get_template_part('templates/content-blog');
      $counter_blog++;
      $post_text .= ob_get_clean();
    endwhile;
    wp_reset_postdata();
  endif;
  $allowed_tags = wp_kses_allowed_html('post');
  echo wp_kses($post_text, $allowed_tags);
  die();
}
add_action('wp_ajax_anps_load_more', 'anps_ajax_load_more');
add_action('wp_ajax_nopriv_anps_load_more', 'anps_ajax_load_more');
