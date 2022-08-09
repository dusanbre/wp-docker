<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsFramework.php');
class AnpsStyle extends AnpsFramework
{

  public $error = null;

  /* Update google fonts */
  public function update_gfonts($redirect = true)
  {
    // Get google fonts
    $gfonts = wp_remote_get('https://astudio.si/preview/gfonts/get_fonts.php');
    if (is_wp_error($gfonts)) {
      return null;
    } else {
      $json_data = json_decode($gfonts['body'], true);
      $this->set_option($json_data['items'], 'google_fonts');
      if ($redirect) {
        header("Location: themes.php?page=theme_options&sub_page=theme_style_google_font");
      }
    }
  }


  /* Upload custom font */
  public function upload_font()
  {
    if (!isset($_FILES['font']['error'])) {
      $this->error = __('Invalid upload!', 'lapopsi');
      return;
    }
    switch ($_FILES['font']['error']) {
      case UPLOAD_ERR_OK:
        break;
      default:
        $this->error = __('Invalid upload!', 'lapopsi');
        return;
    }

    $explode_file_upload = explode(".", $_FILES['font']['name']);
    if ($explode_file_upload[1] !== 'zip') {
      $this->error = __('Only ZIP uploads are supported!', 'lapopsi');
      return;
    }

    $fonts_zip_target = get_template_directory() . '/fonts/' . $_FILES['font']['name'];
    if (file_exists($fonts_zip_target)) {
      $this->error = __('File with same name already exists.', 'lapopsi');
      return;
    }

    // Change upload directory
    add_filter('upload_dir', array($this, 'upload_directory'));

    $movefile = wp_handle_upload($_FILES['font'], array('test_form' => false));
    if (isset($movefile['error']) && !empty($movefile['error'])) {
      $this->error = $movefile['error'];
      return;
    }

    $zip = new ZipArchive();
    $x = $zip->open($fonts_zip_target);
    if ($x === true) {
      $zip->extractTo(get_template_directory() . '/fonts');
      $zip->close();
      unlink($fonts_zip_target);
    }

    $this->update_custom_fonts();
    header("Location: themes.php?page=theme_options&sub_page=theme_style_custom_font");
  }

  /* Get all files and save it to options */
  public function update_custom_fonts()
  {
    $dir = get_template_directory() . '/fonts';
    $fonts = array();
    if ($handle = opendir($dir)) {
      while (($entry = readdir($handle)) !== false) {
        if (is_dir("{$dir}/${entry}")) continue;
        $parts = explode('.', $entry);
        $fonts[$parts[0]] = $parts[0];
      }
      closedir($handle);
    }
    $this->set_option($fonts, 'custom_fonts');
  }

  /* Get all files and save it to options */
  public function get_custom_fonts()
  {
    $dir = get_template_directory() . '/fonts';
    if ($handle = opendir($dir)) {
      $arr = array();
      // Get all files and store it to array
      while (false !== ($entry = readdir($handle))) {
        $arr[$entry] = $entry;
      }
      closedir($handle);
      // Remove . and ..
      unset($arr['.'], $arr['..'], $arr['justvectorv2'], $arr['glyphicons-halflings'], $arr['fontawesome-webfont']);

      // Prepare array to update options
      $fonts = array();
      foreach ($arr as $item) {
        $exploded_item = explode(".", $item);
        $fonts[$exploded_item[0]] = $exploded_item[0];
      }
    }
    return $fonts;
  }

  /* New upload directory */
  public function upload_directory($upload)
  {
    $upload['subdir'] = '/fonts';
    $upload['path'] = get_template_directory() . $upload['subdir'];
    $upload['url'] = get_template_directory_uri() . $upload['subdir'];
    $upload['error'] = $upload['error'];

    return $upload;
  }

  /* Get all fonts */
  public function all_fonts()
  {
    $fonts['System fonts'] = array(
      array('value' => 'Arial, Helvetica, sans-serif', 'name' => 'Arial'),
      array('value' => 'Arial+Black, Gadget, sans-serif', 'name' => 'Arial black'),
      array('value' => 'Comic+Sans+MS, cursive, sans-serif', 'name' => 'Comic Sans MS'),
      array('value' => 'Courier+New, Courier, monospace', 'name' => 'Courier New'),
      array('value' => 'Georgia, serif', 'name' => 'Georgia'),
      array('value' => 'Impact, Charcoal, sans-serif', 'name' => 'Impact'),
      array('value' => 'Lucida+Console, Monaco, monospace', 'name' => 'Lucida Console'),
      array('value' => 'Lucida+Sans+Unicode, "Lucida Grande", sans-serif', 'name' => 'Lucida Sans Unicode'),
      array('value' => 'Palatino+Linotype, Book+Antiqua, Palatino, serif', 'name' => 'Palatino Linotype'),
      array('value' => 'Tahoma, Geneva, sans-serif', 'name' => 'Tahoma'),
      array('value' => 'Trebuchet+MS, Helvetica, sans-serif', 'name' => 'Trebuchet MS'),
      array('value' => 'Times+New+Roman, Times, serif', 'name' => 'Times New Roman'),
      array('value' => 'Verdana, Geneva, sans-serif', 'name' => 'Verdana')
    );
    $fonts['Custom fonts'] = get_option($this->prefix . 'custom_fonts');
    $fonts['Google fonts'] = get_option($this->prefix . 'google_fonts');
    return $fonts;
  }

  /* Save fonts options */
  public function anps_save_fonts()
  {
    $names = array('font_type_1', 'font_type_2', 'font_type_navigation');
    foreach ($_POST as $name => $value) {
      if (!in_array($name, $names)) {
          update_option($name, $value);
      } else {
        $fonts = explode('|', $value);
        update_option($name, $fonts[0]);
        update_option(str_replace('type', 'source', $name), $fonts[1]);
      }
    }
    header("Location: themes.php?page=theme_options&sub_page=theme_style&sub_page=typography");
  }
}
$anps_style = new AnpsStyle();
