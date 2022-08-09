<?php
/* Remove Default VC values */
$vc_values = array(
    'vc_gmaps',
);
foreach ($vc_values as $vc_value) {
    vc_remove_element($vc_value);
}
/* Add anps style to backend vc_tta_tabs dropdown */
vc_add_param('vc_btn', array(
    "name" => esc_html__("Anps button styles", 'anps_theme_plugin'),
    "type" => "dropdown",
    "heading" => esc_html__( 'Anps button style', 'js_composer' ),
    'param_name' =>'anps_style',
        'value' => array(
            esc_html__( 'Normal', 'js_composer' ) => 'btn-normal',
            esc_html__( 'Gradient', 'js_composer' ) => 'btn-gradient',
            esc_html__( 'Dark', 'js_composer' ) => 'btn-dark',
            esc_html__( 'Light', 'js_composer' ) => 'btn-light',
            esc_html__( 'Minimal', 'js_composer' ) => 'btn-minimal',
        ),
    'dependency' => array(
        'element' => 'style',
        'value' => array( 'anps' ),
    ),
    'weight' => 1,
    'description' => esc_html__( 'Styling can be defined in theme options.', 'js_composer' )
    )
);

vc_add_param('vc_btn', array(
        "name" => esc_html__("Button shadow", 'anps_theme_plugin'),
        'type' => 'checkbox',
        'heading' => esc_html__( 'Add shadow?', 'js_composer' ),
        'param_name' => 'add_shadow',
        'dependency' => array(
            'element' => 'style',
            'value' => array( 'anps' ),
        ),
        'weight' => 1,
    )
);
/* Remove vc notifications and set as theme */
function anps_vcSetAsTheme() {
    vc_set_as_theme(true);
}
add_action( 'vc_before_init', 'anps_vcSetAsTheme' );
/* Include custom categories */
vc_add_shortcode_param('blog_categories', 'anps_blog_categories_settings_field');
vc_add_shortcode_param('portfolio_categories', 'anps_portfolio_categories_settings_field');
vc_add_shortcode_param('all_pages', 'anps_all_pages_settings_field');
vc_add_shortcode_param('anps_buttons', 'anps_buttons_field');
vc_add_shortcode_param('anps_tags', 'anps_tags_field', get_template_directory_uri().'/js/anps-tags.js');
vc_add_shortcode_param('anps_autocomplete', 'anps_autocomplete_field', get_template_directory_uri().'/js/anps-autocomplete.js');
vc_add_shortcode_param('anps_input', 'anps_input_field', get_template_directory_uri().'/js/anps-input.js');

/* List parameters for Text block */
vc_add_params('vc_column_text', array(
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Icon library', 'js_composer' ),
        'value' => array(
            esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
            esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
            esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
            esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
            esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
            esc_html__( 'Mono Social', 'js_composer' ) => 'monosocial',
        ),
        'admin_label' => true,
        'param_name' => 'icon_type',
        'description' => esc_html__( 'Select icon library.', 'js_composer' ),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
        'save_always' => true
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'js_composer' ),
        'param_name' => 'icon_fontawesome',
        'value' => '',
        'settings' => array(
            'emptyIcon' => true,
            'iconsPerPage' => 4000,
        ),
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'fontawesome',
        ),
        'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
        'admin_label' => false,
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'js_composer' ),
        'param_name' => 'icon_openiconic',
        'settings' => array(
            'type' => 'openiconic',
            'iconsPerPage' => 4000,
        ),
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'openiconic',
        ),
        'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'js_composer' ),
        'param_name' => 'icon_typicons',
        'settings' => array(
            'type' => 'typicons',
            'iconsPerPage' => 4000,
        ),
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'typicons',
        ),
        'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'js_composer' ),
        'param_name' => 'icon_entypo',
        'settings' => array(
            'type' => 'entypo',
            'iconsPerPage' => 4000,
        ),
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'entypo',
        ),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'js_composer' ),
        'param_name' => 'icon_linecons',
        'settings' => array(
            'type' => 'linecons',
            'iconsPerPage' => 4000,
        ),
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'linecons',
        ),
        'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'js_composer' ),
        'param_name' => 'icon_monosocial',
        'settings' => array(
            'type' => 'monosocial',
            'iconsPerPage' => 4000,
        ),
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'monosocial',
        ),
        'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__('Icon color', 'anps_theme_plugin'),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
        'param_name' => 'icon_color',
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__('Font size', 'anps_theme_plugin'),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
        'param_name' => 'font_size',
        'description' => esc_html__('Font size in px.', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__('Padding between icon and text', 'anps_theme_plugin'),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
        'param_name' => 'padding_icon_text',
        'description' => esc_html__('Padding between icon and texte in px.', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__('Padding between list items top', 'anps_theme_plugin'),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
        'param_name' => 'padding_li_top',
        'description' => esc_html__('Padding between list items top in px.', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__('Padding between list items bottom', 'anps_theme_plugin'),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
        'param_name' => 'padding_li_bottom',
        'description' => esc_html__('Padding between list items bottom in px.', 'anps_theme_plugin'),
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__('Line height', 'anps_theme_plugin'),
        'group' => esc_html__('List Design', 'anps_theme_plugin'),
        'param_name' => 'line_height',
        'description' => esc_html__('Line height in em.', 'anps_theme_plugin'),
    ),
));
