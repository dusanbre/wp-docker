<?php
class WPBakeryShortCode_Frame_Container extends WPBakeryShortCodesContainer {}

/* VC Frame container */
vc_map( array(
    'name' => esc_html__('Frame', 'anps_theme_plugin'),
    'base' => 'frame_container',
    'content_element' => true,
    'description' => esc_html__('Add a frame around the content', 'anps_theme_plugin'),
    'category' => 'Anps Shortcodes',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'show_settings_on_create' => false,
    'is_container' => true,
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Style', 'anps_theme_plugin'),
            'param_name' => 'style',
            'value' => array(
                esc_html__('Style 1', 'anps_theme_plugin') => '1',
                esc_html__('Style 2', 'anps_theme_plugin') => '2',
                esc_html__('Style 3', 'anps_theme_plugin') => '3',
                esc_html__('Style 4', 'anps_theme_plugin') => '4',
                esc_html__('Style 5', 'anps_theme_plugin') => '5',
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Background color', 'anps_theme_plugin'),
            'param_name' => 'bg_color',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Frame color', 'anps_theme_plugin'),
            'param_name' => 'frame_color',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Frame background color', 'anps_theme_plugin'),
            'param_name' => 'frame_bg_color',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Add bottom spacing', 'anps_theme_plugin'),
            'param_name' => 'bottom_spacing',
            'admin_label' => false,
        ),
    ),
    'js_view' => 'VcColumnView'
) );
