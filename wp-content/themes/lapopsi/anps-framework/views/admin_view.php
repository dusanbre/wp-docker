<?php
/* Check for theme updates */
$notify = "";

wp_enqueue_style('fontawesome');
wp_enqueue_style('bootstrap');
wp_enqueue_style('anps-admin-styles');
wp_enqueue_script('clipboard');
wp_enqueue_script('anps-theme-options');
wp_enqueue_style('anps-buttons');
?>
<div class="anps-admin">
  <?php $themever = wp_get_theme(get_template());
  $version = $themever["Version"]; ?>
  <ul class="anps-admin-menu">
    <li>
      <a class="anpslogo hidden-sm hidden-xs hidden-md" href="https://anpsthemes.com" target="_blank">&nbsp;</a>
      <h2 class="hidden-sm hidden-md hidden-xs small_lh"><?php esc_html_e("Theme Options", 'lapopsi'); ?><br /><span class="version"><?php echo esc_html__('Version', 'lapopsi') . ': ' . esc_attr($version); ?></span></h2>
    </li>
    <li>
      <a class="anpslogo-mobile hidden-lg " href="https://anpsthemes.com" target="_blank" class="hidden-md hidden-xs small_lh"><i><img src=" <?php echo get_template_directory_uri() . '/anps-framework/images/anpslogo-mobile.png'; ?>" /></i></a>
    </li>
    <li><a <?php if (!isset($_GET['sub_page']) || $_GET['sub_page'] == "main_colors") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=main_colors"><i class="fa fa-tint"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Main Theme Colors", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "typography") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=typography"><i class="fa fa-text-height"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Typography", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "button_maker") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=button_maker"><i class="fa fa-text-height"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Button Maker", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_google_font") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_google_font"><i class="fa fa-google"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Update Google Fonts", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_custom_font") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_custom_font"><i class="fa fa-text-height"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Custom Fonts", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_style_custom_css") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=theme_style_custom_css"><i class="fa fa-code"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Custom CSS", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options"><i class="fa fa-columns"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Page Layout", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_page_setup") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_page_setup"><i class="fa fa-cog"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Page Setup", 'lapopsi'); ?></span></a></li>

    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "header") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=header"><i class="fa fa-bars"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Header Options", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "footer") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=footer"><i class="fa fa-level-down"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Footer Options", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "woocommerce") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=woocommerce"><i class="fa fa-shopping-basket"></i><span class="hidden-sm hidden-xs hidden-md">WooCommerce</span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "options_media") echo 'id="selected-menu-subitem"'; ?> href="themes.php?page=theme_options&sub_page=options_media"><i class="fa fa-picture-o"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Logos & Media", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "dummy_content") echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=dummy_content"><i class="fa fa-dropbox"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Demo Content", 'lapopsi'); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "theme_upgrade") echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=theme_upgrade"><i class="fa fa-cloud-download"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Theme Update", 'lapopsi');
                                                                                                                                                                                                                                                                      echo wp_kses($notify, array("span" => array("class" => array()))); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "import_export") echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=import_export"><i class="fa fa-file-code-o"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Import/Export", 'lapopsi');
                                                                                                                                                                                                                                                                    echo wp_kses($notify, array("span" => array("class" => array()))); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "import_export_widgets") echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=import_export_widgets"><i class="fa fa-file-code-o"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("Import/Export Widgets", 'lapopsi');
                                                                                                                                                                                                                                                                                    echo wp_kses($notify, array("span" => array("class" => array()))); ?></span></a></li>
    <li><a <?php if (isset($_GET['sub_page']) && $_GET['sub_page'] == "system_req") echo 'id="selected-menu-item"'; ?> href="themes.php?page=theme_options&sub_page=system_req"><i class="fa fa-cogs"></i><span class="hidden-sm hidden-xs hidden-md"><?php esc_html_e("System Requirements", 'lapopsi');
                                                                                                                                                                                                                                                      echo wp_kses($notify, array("span" => array("class" => array()))); ?></span></a></li>
  </ul>

  <?php
  if (!isset($_GET['sub_page'])) {
    $_GET['sub_page'] = '';
  }
  ?>
  <div class="anps-admin-content <?php echo esc_attr($_GET['sub_page']); ?>">
    <?php
    switch ($_GET['sub_page']) {
      case 'typography':
        include_once(get_template_directory() . '/anps-framework/views/typography_view.php');
        break;
      case 'button_maker':
        include_once(get_template_directory() . '/anps-framework/views/button_maker_view.php');
        break;
      case 'options':
        include_once(get_template_directory() . '/anps-framework/views/options_page_layout_view.php');
        break;
      case 'options_page':
        include_once(get_template_directory() . '/anps-framework/views/options_page_layout_view.php');
        break;
      case 'options_page_setup':
        include_once(get_template_directory() . '/anps-framework/views/options_page_setup_view.php');
        break;
      case 'header':
        include_once(get_template_directory() . '/anps-framework/views/header_view.php');
        break;
      case 'footer':
        include_once(get_template_directory() . '/anps-framework/views/footer_view.php');
        break;
      case 'woocommerce':
        include_once(get_template_directory() . '/anps-framework/views/woocommerce_view.php');
        break;
      case 'options_media':
        include_once(get_template_directory() . '/anps-framework/views/options_media_view.php');
        break;
      case 'dummy_content':
        include_once(get_template_directory() . '/anps-framework/views/dummy_view.php');
        break;
      case 'theme_upgrade':
        include_once(get_template_directory() . '/anps-framework/views/theme_upgrade_view.php');
        break;
      case 'theme_style_google_font':
        include_once(get_template_directory() . '/anps-framework/views/update_google_font_view.php');
        break;
      case 'theme_style_custom_font':
        include_once(get_template_directory() . '/anps-framework/views/update_custom_font_view.php');
        break;
      case 'theme_style_custom_css':
        include_once(get_template_directory() . '/anps-framework/views/custom_css_view.php');
        break;
      case 'import_export':
        include_once(get_template_directory() . '/anps-framework/views/import_export_view.php');
        break;
      case 'import_export_widgets':
        include_once(get_template_directory() . '/anps-framework/views/import_export_widgets_view.php');
        break;
      case 'system_req':
        include_once(get_template_directory() . '/anps-framework/views/system_req_view.php');
        break;
      default:
        include_once(get_template_directory() . '/anps-framework/views/main_colors_view.php');
    }
    ?>
  </div>
</div>

<div class="empty-space"></div>
