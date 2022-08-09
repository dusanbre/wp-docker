<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsFramework.php');
class AnpsDummy extends AnpsFramework
{

  public function select()
  {
    return get_option('anps_dummy');
  }

  public function save()
  {
    include_once(get_template_directory() . '/anps-framework/classes/AnpsImport.php');
    remove_image_size('anps-gallery-thumb');
    remove_image_size('anps-featured');
    remove_image_size('anps-portfolio');
    remove_image_size('anps-team');
    remove_image_size('thumbnail');
    remove_image_size('medium');
    remove_image_size('large');
    $date = explode("/", date("Y/m"));
    $dummy_xml = "dummy1";
    if (isset($_POST['dummy1'])) {
      $dummy_xml = "dummy1";
      $menu_num = 1;
    } elseif (isset($_POST['dummy2'])) {
      $dummy_xml = "dummy2";
      $menu_num = 1;
    } elseif (isset($_POST['dummy3'])) {
      $dummy_xml = "dummy3";
      $menu_num = 2;
    } elseif (isset($_POST['dummy4'])) {
      $dummy_xml = "dummy4";
      $menu_num = 2;
    } elseif (isset($_POST['dummy5'])) {
      $dummy_xml = "dummy5";
      $menu_num = 4;
    }

    $import_dir = get_template_directory() . "/anps-framework/classes/importer/{$dummy_xml}";

    /* Import theme options */
    $anps_import_export->import_theme_options($import_dir . '/anps-theme-options.json');

    /* Import dummy xml */
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/importer/wordpress-importer.php';
    $parse = new ANPS_Import();
    $parse->import($import_dir . '/dummy.xml');
    global $wp_rewrite;
    $first_id = get_page_by_title("Home")->ID;

    /* Post meta on blog */
    update_option('anps_post_meta_categories', '');
    update_option('anps_post_meta_author', '');

    update_option('page_on_front', $first_id);
    update_option('show_on_front', 'page');
    update_option('rss_use_excerpt', 1);
    update_option('permalink_structure', '/%postname%/');
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();

    /* Set menu as primary */
    $menu_id = wp_get_nav_menus();
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu_id[$menu_num]->term_id;
    set_theme_mod('nav_menu_locations', $locations);
    update_option('menu_check', true);

    /* Install all widgets */
    $anps_import_export->import_widgets_data($import_dir . "/anps-widgets.txt");

    /* Add revolution slider demo data */
    $this->__add_revslider($import_dir . "/home.zip");
  }
  protected function __add_revslider($zip)
  {
    /* Check if slider is installed */
    if (class_exists('RevSlider', false)) {
      $slider = new RevSlider();
      $slider->importSliderFromPost(true, true, $zip);
    } else {
      echo "Revolution slider is not active. Demo data for revolution slider can't be inserted.";
    }
  }
}
$anps_dummy = new AnpsDummy();
