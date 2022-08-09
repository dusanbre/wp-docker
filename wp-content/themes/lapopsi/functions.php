<?php
if (!defined('ABSPATH')) {
    die();
}

//Constants
$theme = wp_get_theme('lapopsi');
define('ANPS_THEME_VERSION', $theme->get('Version'));

/* Include plugin functions */
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
/* Content width */
if (!isset($content_width)) {
    $content_width = get_option('anps_container_width', '1170') * 1;
}

/* Basic support for Gutenberg */
add_theme_support('wp-block-styles');
add_theme_support('align-wide');
add_theme_support('editor-styles');
add_theme_support('responsive-embeds');

add_theme_support('editor-color-palette', array(
  array(
    'name' => __('Primary', 'lapopsi'),
    'slug' => 'primary',
    'color' => '#383e48',
  ),
  array(
    'name' => __('Secondary', 'lapopsi'),
    'slug' => 'secondary',
    'color' => '#d7f4fe',
  ),
  array(
    'name' => __('Light', 'lapopsi'),
    'slug' => 'light',
    'color' => '#ffffff',
  ),
  array(
    'name' => __('Gray', 'lapopsi'),
    'slug' => 'gray',
    'color' => '#878a9d',
  ),
));



add_theme_support('editor-font-sizes', array(
  array(
    'name' => __('H1', 'lapopsi'),
    'size' => 40,
    'slug' => 'anps-h1'
  ),
  array(
    'name' => __('H2', 'lapopsi'),
    'size' => 36,
    'slug' => 'anps-h2'
  ),
  array(
    'name' => __('H3', 'lapopsi'),
    'size' => 32,
    'slug' => 'anps-h3'
  ),
  array(
    'name' => __('H4', 'lapopsi'),
    'size' => 22,
    'slug' => 'anps-h4'
  ),
  array(
    'name' => __('H5', 'lapopsi'),
    'size' => 20,
    'slug' => 'anps-h5'
  ),

));

/* Title tag theme support */
add_theme_support('title-tag');

/* Custom header theme support */
add_theme_support('custom-header');

/* Custom background theme support */
add_theme_support('custom-background');

/* Image sizes */
add_theme_support('post-thumbnails');

add_image_size('anps-gallery-thumb', 280, 210, true);
add_image_size('anps-featured', 722, 368, true);
add_image_size('anps-portfolio', 359, 283, true);
add_image_size('anps-team', 500, 500, true);
add_image_size('anps-blog', 720, 461, true);

/* Include helper.php */
include_once get_template_directory() . '/anps-framework/helpers.php';
/*
 * Include sidebar generator
 * hide sidebar generator on team custom post type
 */
if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins'))) && anps_get_current_post_type() != 'team') {
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/sidebar_generator.php';
}
if (is_admin()) {
  /* Checking google fonts subsets for each font in admin */
    include_once(get_template_directory() . '/anps-framework/classes/gfonts_ajax.php');
  /* Add custom fields to menus */
    include_once(get_template_directory() . '/anps-framework/classes/AnpsAdminMenu.php');
}
/* Widgets */
if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/widgets/widgets.php';
}
include_once get_template_directory() . '/anps-framework/widgets.php';
/* Shortcodes */
if (function_exists('anps_portfolio')) {
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/shortcodes/shortcodes.php';
}
/* Include Customizer class */
include_once(get_template_directory() . '/anps-framework/classes/AnpsCustomizer.php');
/* END Include Customizer class */

/* On setup theme */
add_action('after_switch_theme', 'anps_register_custom_fonts');
function anps_register_custom_fonts()
{
    if (!isset($_GET['stylesheet'])) {
        $_GET['stylesheet'] = '';
    }
    $theme = wp_get_theme($_GET['stylesheet']);
    if (!isset($_GET['activated'])) {
        $_GET['activated'] = '';
    }
    if ($_GET['activated'] == 'true' && $theme->get_template() == 'lapopsi') {
        include_once get_template_directory() . '/anps-framework/classes/AnpsOptions.php';
        include_once get_template_directory() . '/anps-framework/classes/AnpsStyle.php';
      /* Add google fonts*/
        if (get_option('anps_google_fonts', '') == '') {
            $anps_style->update_gfonts(false);
        }
      /* Add custom fonts to options */
        $anps_style->update_custom_fonts();
      /* Add default fonts */
        if (get_option('font_type_1', '') == '') {
            update_option("font_type_1", "Montserrat");
        }
        if (get_option('font_type_2', '') == '') {
            update_option("font_type_2", "Nunito");
        }
        if (get_option('font_type_navigation', '') == '') {
            update_option("font_type_navigation", "Montserrat");
        }
    }
    $fonts_installed = get_option('fonts_intalled');

    if ($fonts_installed == 1) {
        return;
    }

  /* Get custom font */
    include_once get_template_directory() . '/anps-framework/classes/AnpsStyle.php';
    $fonts = $anps_style->get_custom_fonts();
  /* Update custom font */
    foreach ($fonts as $name => $value) {
        $arr_save[] = array('value' => $value, 'name' => $name);
    }
    update_option('anps_custom_fonts', $arr_save);
    update_option('fonts_intalled', 1);
}
/* Show excerpt by default */
add_filter('default_hidden_meta_boxes', 'anps_hide_meta_box', 10, 2);
function anps_hide_meta_box($hidden, $screen)
{
  //make sure we are dealing with the correct screen
    if ('post' == $screen->base) {
      //lets hide everything
        $hidden = array('slugdiv', 'postcustom', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
    }
    return $hidden;
}
/* END Show excerpt by default */
if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/team_meta.php';
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/portfolio_meta.php';
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/metaboxes.php';
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/page_meta.php';
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/featured_video_meta.php';
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/header_options_meta.php';
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/blank_page_meta.php';
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/footer_banner_options_meta.php';
    include_once WP_PLUGIN_DIR . '/anps_theme_plugin/meta/gallery_images.php';
}
//install paralax slider
include_once(get_template_directory() . '/anps-framework/install_plugins.php');
function anps_add_editor_styles()
{
    add_editor_style('css/editor-styles.css');
}
add_action('admin_init', 'anps_add_editor_styles');
/* PHP header() NO ERRORS */
if (is_admin()) {
    add_action('init', 'anps_do_output_buffer');
}
function anps_do_output_buffer()
{
    ob_start();
}
/* Infinite scroll 08.07.2013 */
function anps_infinite_scroll_init()
{
    add_theme_support('infinite-scroll', array(
    'type'       => 'click',
    'footer_widgets' => true,
    'container'  => 'section-content',
    'footer'     => 'site-footer',
    ));
}
add_action('init', 'anps_infinite_scroll_init');

function anps_scripts_and_styles()
{
    wp_enqueue_style("font-awesome", get_template_directory_uri() . "/css/font-awesome.min.css");
    wp_enqueue_style("owl-css", get_template_directory_uri() . "/js/owlcarousel/assets/owl.carousel.min.css");

    $rtl_suffix = '';

    if (is_rtl()) {
        $rtl_suffix = '-rtl';
    }

    wp_enqueue_style("bootstrap", get_template_directory_uri()  . '/css/bootstrap' . $rtl_suffix . '.css');
    wp_enqueue_style("pikaday", get_template_directory_uri()  . "/css/pikaday.css");
    wp_enqueue_style("anps-core", get_template_directory_uri()  . '/css/core' . $rtl_suffix . '.css');
    wp_enqueue_style("anps-components", get_template_directory_uri()  . '/css/components' . $rtl_suffix . '.css');
    wp_enqueue_style("anps-buttons", get_template_directory_uri()  . "/css/button.css");
    wp_enqueue_style("swipebox", get_template_directory_uri()  . "/css/swipebox.css");
    if (is_rtl()) {
        wp_enqueue_style("anps-rtl", get_template_directory_uri()  . '/css/rtl.css');
    }


    wp_enqueue_script("modernizr", get_template_directory_uri()  . "/js/modernizr.js", array('jquery'), false, true);
    wp_enqueue_script("countup", get_template_directory_uri()  . "/js/countup.min.js", array('jquery'), false, true);
    wp_enqueue_script("moment", get_template_directory_uri()  . "/js/moment.js", array('jquery'), false, true);
    wp_enqueue_script("pikaday", get_template_directory_uri()  . "/js/pikaday.js", array('jquery'), false, true);
    wp_enqueue_script("swipebox", get_template_directory_uri()  . "/js/jquery.swipebox.js", array('jquery'), false, true);
    wp_enqueue_script("bootstrap", get_template_directory_uri()  . "/js/bootstrap/bootstrap.min.js", array(), false, true);
    wp_enqueue_script("owlcarousel", get_template_directory_uri() . "/js/owlcarousel/owl.carousel.min.js", array("jquery"), false, true);


    $google_maps_api = get_option('anps_google_maps', '');

    if ($google_maps_api != '') {
        $google_maps_api = '?key=' . $google_maps_api;
    }

    wp_register_script("gmap3-link", "https://maps.google.com/maps/api/js" . $google_maps_api, '', false, true);
    wp_register_script("gmap3", get_template_directory_uri()  . "/js/gmap3.min.js", array('jquery'), false, true);
    wp_enqueue_script("isotope", get_template_directory_uri()  . "/js/isotope.min.js", array('jquery'), false, true);
    wp_enqueue_script("countdown", get_template_directory_uri()  . "/js/jquery.countdown.min.js", array('jquery'), false, true);
    wp_enqueue_script("doubleTap", get_template_directory_uri()  . "/js/doubletaptogo.js", array('jquery'), false, true);
    wp_register_script('froogaloop2', 'https://f.vimeocdn.com/js/froogaloop2.min.js', array('jquery'), false, true);
    wp_register_script('waypoints-theme', get_template_directory_uri()  . '/js/waypoints/jquery.waypoints.min.js', array('jquery'), false, true);
    wp_enqueue_script('flexibility', get_template_directory_uri()  . '/js/flexibility.js', array('jquery'), false, true);
    wp_enqueue_script("functions", get_template_directory_uri()  . "/js/functions.js", array('jquery', 'isotope', 'pikaday', 'swipebox', 'countup', 'moment', 'flexibility', 'bootstrap', 'modernizr', 'countdown', 'owlcarousel', 'doubleTap'), ANPS_THEME_VERSION, true);
    wp_localize_script('functions', 'anps', array(
    'reset_button' => esc_html__('Reset', 'lapopsi'),
    'home_url' => esc_url(home_url('/')),
    'search_placeholder' => esc_html__('Search...', 'lapopsi'),
    'ajaxurl' => admin_url('admin-ajax.php'),
    ));
  //ajax load more
    $all_posts = wp_count_posts()->publish;
    $posts_per_page = get_option('posts_per_page');
    $page_number_max = ceil($all_posts / $posts_per_page);
    wp_enqueue_script('anps-ajax-load-more', get_template_directory_uri() . '/js/ajaxloadmore.js', array('jquery'));
    wp_localize_script('anps-ajax-load-more', 'anps_load', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'anps_current_page' => 1,
    'anps_max_pages' => $page_number_max,
    ));


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (get_option('font_source_1', "Google fonts") == 'Google fonts') {
        $font1_subset = get_option("font_type_1_subsets", array("latin", "latin-ext"));
        $font1_implode_subset = implode(",", $font1_subset);
        wp_enqueue_style("font-type-1", 'https://fonts.googleapis.com/css?family=' . get_option('font_type_1', 'Montserrat') . ':400italic,400,500,600,700,300&subset=' . $font1_implode_subset);
    }

    if (get_option('font_source_2', "Google fonts") == 'Google fonts' && get_option('font_type_1', 'Montserrat') != get_option('font_type_2', 'Nunito')) {
        $font2_subset = get_option("font_type_2_subsets", array("latin", "latin-ext"));
        $font2_implode_subset = implode(",", $font2_subset);
        wp_enqueue_style("font-type-2", 'https://fonts.googleapis.com/css?family=' . get_option('font_type_2', 'Nunito') . ':400italic,400,500,600,700,300&subset=' . $font2_implode_subset);
    }

    if (get_option('font_source_navigation', "Google fonts") == 'Google fonts' && get_option('font_type_1', 'Montserrat') != get_option('font_type_navigation', "Montserrat")) {
        $font3_subset = get_option("font_type_navigation_subsets", array("latin", "latin-ext"));
        $font3_implode_subset = implode(",", $font3_subset);
        wp_enqueue_style("font-type-navigation", 'https://fonts.googleapis.com/css?family=' . get_option('font_type_navigation', 'Montserrat') . ':400italic,400,500,600,700,300&subset=' . $font3_implode_subset);
    }

    wp_enqueue_style("theme-main-style", get_bloginfo('stylesheet_url'));
    wp_enqueue_style("theme-wordpress-style", get_template_directory_uri() . "/css/wordpress.css");

    ob_start();
    anps_custom_styles();
    $custom_css = ob_get_clean();

    $custom_css = trim(preg_replace('/\s+/', ' ', $custom_css));
    wp_add_inline_style('theme-wordpress-style', $custom_css);
    wp_enqueue_style("custom", get_template_directory_uri() . '/custom.css');
}
add_action('wp_enqueue_scripts', 'anps_scripts_and_styles');

load_theme_textdomain('lapopsi', get_template_directory() . '/languages');

/* Admin only scripts */

function anps_load_custom_wp_admin_scripts($hook)
{
    $rtl_suffix = '';

    if (is_rtl()) {
        $rtl_suffix = '-rtl';
    }

  /* Overwrite VC styling */
    wp_register_style("fontawesome", get_template_directory_uri() . "/css/font-awesome.min.css");

    wp_enqueue_style("vc-custom", get_template_directory_uri() . '/css/vc_custom.css');
    wp_register_style("anps-buttons", get_template_directory_uri()  . "/css/button.css");

    $screen = get_current_screen();

    if ($screen->id !== 'toplevel_page_revslider') {
        wp_enqueue_style("anps-iconpicker-css", get_template_directory_uri()  . "/anps-framework/css/iconpicker.css");
        wp_enqueue_script('anps-iconpicker-js', get_template_directory_uri() . "/anps-framework/js/iconpicker.js", array('jquery'), false, true);
        wp_localize_script('anps-iconpicker-js', 'anps_iconpicker', array(
        'search_text' => esc_html__('Search', 'lapopsi'),
        ));
    }
    wp_enqueue_script('wp-backend', get_template_directory_uri() . "/anps-framework/js/wp_backend.js", array('jquery'), false, true);
    wp_localize_script('wp-backend', 'anps', array(
    'ajaxurl' => admin_url('admin-ajax.php')
    ));

    wp_register_script("ace-editor", get_template_directory_uri()  . "/js/ace.min.js", array('jquery'), '', true);
    wp_register_script('wp-colorpicker', get_template_directory_uri() . "/anps-framework/js/wp_colorpicker.js", array('wp-color-picker'), false, true);
    wp_register_style('anps-sidebar-generator', get_template_directory_uri() . "/anps-framework/css/sidebar-generator.css");
    wp_register_script('anps-sidebar-generator', get_template_directory_uri() . "/anps-framework/js/sidebar-generator.js");
    wp_localize_script('anps-sidebar-generator', 'ajaxObject', array('url' => admin_url('admin-ajax.php')));

    wp_register_style("anps-colorpicker", get_template_directory_uri() . '/anps-framework/css/colorpicker.css');
    wp_register_script("anps-colorpicker-theme", get_template_directory_uri() . "/anps-framework/js/colorpicker.js");
    wp_register_script("anps-colorpicker-custom", get_template_directory_uri() . "/anps-framework/js/colorpicker_custom.js");
    wp_register_script("anps-button-maker", get_template_directory_uri() . "/anps-framework/js/button-maker.js", array('jquery'), false, true);

    wp_register_script('my-upload', get_template_directory_uri() . '/anps-framework/js/upload_image.js', array('jquery', 'media-upload', 'thickbox'));
    wp_register_script('anps-upload', get_template_directory_uri() . '/anps-framework/js/upload.js', array('jquery', 'media-upload', 'thickbox'));
    wp_register_style("bootstrap", get_template_directory_uri()  . "/css/bootstrap.css");
    wp_register_style("anps-conponents", get_template_directory_uri()  . "/css/components.css");
    wp_enqueue_style("anps-admin-styles", get_template_directory_uri() . '/css/theme-options' . $rtl_suffix . '.css');
    wp_enqueue_script("matchheight", get_template_directory_uri()  . "/js/jquery.matchHeight.js", array('jquery'), false, true);
    wp_enqueue_style("selectize", get_template_directory_uri() . '/css/selectize.css');
    wp_enqueue_script('selectize', get_template_directory_uri() . "/js/selectize.min.js", array('jquery'), false, true);
    wp_register_script("vue", get_template_directory_uri() . '/js/vue.min.js', array('jquery'));
    wp_register_script("anps-pattern", get_template_directory_uri() . "/anps-framework/js/pattern.js");
    wp_register_script("clipboard", get_template_directory_uri() . '/anps-framework/js/clipboard.min.js', array('jquery'));
    wp_register_script("anps-theme-options", get_template_directory_uri() . '/anps-framework/js/theme-options.js', array('jquery'));
    wp_localize_script('anps-theme-options', 'anps', array(
    'theme_url'    => get_template_directory_uri(),
    'warning_text' => esc_html__('WARNING: You have already insert dummy content and by inserting it again, you will have duplicate content.\r\n\We recommend doing this ONLY if something went wrong the first time and you have already cleared the content.', 'lapopsi'),
    ));
}
add_action('admin_enqueue_scripts', 'anps_load_custom_wp_admin_scripts');


/*************************/
/*WOOCOMMERCE*/
/*************************/
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_theme_support('woocommerce');
    if (get_option('anps_product_zoom', '1') == '1') {
        add_theme_support('wc-product-gallery-zoom');
    }
    if (get_option('anps_product_lightbox', '1') == '1') {
        add_theme_support('wc-product-gallery-lightbox');
    }
    add_theme_support('wc-product-gallery-slider');

  /* Remove breadcrumbs */
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

  /* Remove page title */
    add_filter('woocommerce_show_page_title', '__return_false');

  /* Remove sidebar */
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10, 0);

  /* Wrap result count and order in .before-loop */
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 0);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30, 0);
    add_action('woocommerce_before_shop_loop', 'anps_before_shop_loop', 20);

    function anps_before_shop_loop()
    {
        echo '<div class="before-loop">';
        woocommerce_result_count();
        woocommerce_catalog_ordering();
        echo '</div>';
    }

    function filter_woocommerce_pagination_args($array)
    {
        $array['prev_text'] = '<i class="fa fa-angle-left"></i> ' . esc_html__('Previous', 'lapopsi');
        $array['next_text'] = esc_html__('Next', 'lapopsi') . ' <i class="fa fa-angle-right"></i>';
        return $array;
    };


    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

  // add the filter
    add_filter('woocommerce_pagination_args', 'filter_woocommerce_pagination_args', 10, 1);
}
/*************************/
/*END WOOCOMMERCE*/
/*************************/
/*chrome admin menu fix*/
function anps_chromefix_inline_css()
{
    wp_add_inline_style('wp-admin', '#adminmenu { transform: translateZ(0); }');
}
add_action('admin_enqueue_scripts', 'anps_chromefix_inline_css');

/* Set Revolution Slider as Theme */
if (function_exists('set_revslider_as_theme')) {
    add_action('init', 'anps_set_rev_as_theme');
    function anps_set_rev_as_theme()
    {
        set_revslider_as_theme();
    }
}

/* Remove Newsletter styling */

add_filter('newsletter_enqueue_style', '__return_false');

/* Google Maps admin notice */

if (get_option('anps_google_maps', '') === '' && get_option('anps_ga_notice', 'on') === 'on') {
    function anps_google_api_notice()
    {
        ?>
    <div class="notice-warning anps-notice settings-error notice is-dismissible" data-anps-notice="">
      <p><strong><?php esc_html_e('Missing Google Maps API key', 'lapopsi'); ?></strong></p>
      <p><?php esc_html_e('As of June 2016 Google Maps no longer support keyless access and requires an API Key to work. You will need to generate an API key on the Google API Console website and insert the API key under our options.', 'lapopsi'); ?></p>
      <p><a class="button-secondary skip" href="<?php echo admin_url('themes.php?page=anps_plugin_options&sub_page=google_maps'); ?>"><?php esc_html_e('Go to Google Maps settings', 'lapopsi'); ?></a></p>
    </div>
        <?php
    }
    add_action('admin_notices', 'anps_google_api_notice');
}

function anps_dismiss_notice()
{
    update_option('anps_ga_notice', 'off');
    exit;
}
add_action('wp_ajax_anps_dismiss_notice', 'anps_dismiss_notice');

/* Add font size select */

if (!function_exists('anps_mce_buttons')) {
    function anps_mce_buttons($buttons)
    {
        array_unshift($buttons, 'fontsizeselect');
        return $buttons;
    }
}
add_filter('mce_buttons_2', 'anps_mce_buttons');

if (!function_exists('anps_mce_text_sizes')) {
    function anps_mce_text_sizes($initArray)
    {
        $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
        return $initArray;
    }
}
add_filter('tiny_mce_before_init', 'anps_mce_text_sizes');

function anps_vc_border_radius()
{
    return array(
    '' => __('None', 'lapopsi'),
    '1px' => '1px',
    '2px' => '2px',
    '3px' => '3px',
    '4px' => '4px',
    '5px' => '5px',
    '6px' => '6px',
    '7px' => '7px',
    '8px' => '8px',
    '9px' => '9px',
    '10px' => '10px',
    '15px' => '15px',
    '20px' => '20px',
    '25px' => '25px',
    '30px' => '30px',
    '35px' => '35px',
    '100%' => '100%',
    );
}
add_filter('vc_css_editor_border_radius_options_data', 'anps_vc_border_radius');

function anps_svg($name, $path = null)
{
    if ($path === null) {
        $path = get_template_directory_uri() . '/images/svgs/';
    }
    $icon = wp_remote_get($path . $name . '.svg');
    if (!is_wp_error($icon)) {
        return $icon['body'];
    }
}


/** Add Gutenberg editor styles */
function apns_block_editor_style_override()
{
    $rtl_suffix = is_rtl() ? '-rtl' : '';
    wp_enqueue_style('anps_block_editor_style', get_template_directory_uri() . '/css/block-editor-style' . $rtl_suffix . '.css', array('wp-block-editor'));

  // Load google font if needed
    $fonts = array();
    if (get_option('font_source_1') === 'Google fonts' || empty(get_option('font_source_1'))) {
        $fonts[] = urldecode(get_option('font_type_1', 'Montserrat'));
    }
    if (get_option('font_source_2') === 'Google fonts' || empty(get_option('font_source_1'))) {
        $fonts[] = urldecode(get_option('font_type_2', 'Nunito'));
    }
    $google_fonts = anps_get_google_fonts_uri(array_unique($fonts));
    wp_enqueue_style('editor_google_fonts', $google_fonts, array(), null);

  // Load CSS from theme configuration
    $theme_css = anps_custom_block_editor_styles();
    wp_add_inline_style('anps_block_editor_style', $theme_css);
}
add_action('enqueue_block_editor_assets', 'apns_block_editor_style_override');

/** Disable widgets block support */
function disable_widgets_block_support()
{
    remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'disable_widgets_block_support');
