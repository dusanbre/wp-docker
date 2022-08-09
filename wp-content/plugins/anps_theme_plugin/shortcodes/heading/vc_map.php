<?php
vc_map( array(
    'name' => esc_html__('Heading', 'anps_theme_plugin'),
    'base' => 'heading',
    'category' => 'Anps Shortcodes',
    'description' => esc_html__('Titles and important texts', 'anps_theme_plugin'),
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'params' => array(
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Text', 'anps_theme_plugin'),
            'param_name' => 'text',
            'value' => '',
            'admin_label' => true
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Element tag', 'anps_theme_plugin'),
            'param_name' => 'tag',
            'value' => array(
                esc_html__('h1', 'anps_theme_plugin')     => 'h1',
                esc_html__('h2', 'anps_theme_plugin')     => 'h2',
                esc_html__('h3', 'anps_theme_plugin')     => 'h3',
                esc_html__('h4', 'anps_theme_plugin')     => 'h4',
                esc_html__('h5', 'anps_theme_plugin')     => 'h5',
                esc_html__('strong', 'anps_theme_plugin') => 'strong',
                esc_html__('div', 'anps_theme_plugin')    => 'div',
                esc_html__('p', 'anps_theme_plugin')      => 'p',
            ),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text align', 'anps_theme_plugin'),
            'param_name' => 'text_align',
            'value' => array(
                esc_html__('Left', 'anps_theme_plugin')    => 'left',
                esc_html__('Center', 'anps_theme_plugin')  => 'center',
                esc_html__('Right', 'anps_theme_plugin')   => 'right',
                esc_html__('Justify', 'anps_theme_plugin') => 'justify',
            ),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Bottom spacing', 'anps_theme_plugin'),
            'param_name' => 'spacing',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Link', 'anps_theme_plugin'),
            'param_name' => 'link',
            'value' => '',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Extra class name', 'anps_theme_plugin'),
            'param_name' => 'class',
            'value' => '',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Element ID', 'anps_theme_plugin'),
            'param_name' => 'id',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Font size', 'anps_theme_plugin'),
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'param_name' => 'font_size',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Line height', 'anps_theme_plugin'),
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'param_name' => 'line_height',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Font weight', 'anps_theme_plugin'),
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'param_name' => 'font_weight',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text style', 'anps_theme_plugin'),
            'param_name' => 'text_style',
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'value' => array(
                esc_html__('Normal', 'anps_theme_plugin')     => '',
                esc_html__('Uppercase', 'anps_theme_plugin')  => 'uppercase',
                esc_html__('Lowercase', 'anps_theme_plugin')  => 'lowercase',
                esc_html__('Capitalize', 'anps_theme_plugin') => 'capitalize',
            ),
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Text color', 'anps_theme_plugin'),
            'group' => esc_html__('Text Options', 'anps_theme_plugin'),
            'param_name' => 'color',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__('CSS box', 'anps_theme_plugin'),
            'param_name' => 'css',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
    )
));