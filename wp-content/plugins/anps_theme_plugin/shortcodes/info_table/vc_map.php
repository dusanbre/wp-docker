<?php
class WPBakeryShortCode_Info_Table extends WPBakeryShortCodesContainer {}

vc_map( array(
    'name' => esc_html__('Info table', 'anps_theme_plugin'),
    'base' => 'info_table',
    'content_element' => true,
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'category' => 'Anps Shortcodes',
    'is_container' => true,
    'as_parent' => array('only' => 'info_table_item'),
    'params' => array(
        /* Parent Options */
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Padding', 'anps_theme_plugin'),
            'param_name' => 'anps_padding',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Title font size', 'anps_theme_plugin'),
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'param_name' => 'font_size_title',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title font weight', 'anps_theme_plugin'),
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'param_name' => 'font_weight_title',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Text font size', 'anps_theme_plugin'),
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'param_name' => 'font_size_text',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Text font weight', 'anps_theme_plugin'),
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'param_name' => 'font_weight_text',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Item spacing', 'anps_theme_plugin'),
            'param_name' => 'spacing',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Title color', 'anps_theme_plugin'),
            'param_name' => 'title_color',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Text color', 'anps_theme_plugin'),
            'param_name' => 'text_color',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__('CSS box', 'anps_theme_plugin'),
            'param_name' => 'css',
            'group' => esc_html__('Design options', 'anps_theme_plugin'),
        ),
    ),
    'js_view' => 'VcColumnView',
));


vc_map( array(
    'name' => esc_html__('Info table item', 'anps_theme_plugin'),
    'base' => 'info_table_item',
    'content_element' => true,
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'category' => 'Anps Shortcodes',
    'as_child' => array('only' => 'info_table'),
    'params' => array(
        /* Child Options */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title', 'anps_theme_plugin'),
            'param_name' => 'title',
            'value' => '',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Text', 'anps_theme_plugin'),
            'param_name' => 'text',
            'value' => '',
            'admin_label' => true
        ),
    ),
));
