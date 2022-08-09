<?php
vc_map( array(
    'name' => esc_html__('Counter', 'anps_theme_plugin'),
    'base' => 'counter',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'category' => 'Anps Shortcodes',
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('From', 'anps_theme_plugin'),
            'param_name' => 'from',
            'value' => '',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('To', 'anps_theme_plugin'),
            'param_name' => 'to',
            'value' => '',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Duration', 'anps_theme_plugin'),
            'param_name' => 'duration',
            'value' => '5',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Decimal', 'anps_theme_plugin'),
            'param_name' => 'decimal',
            'value' => '.',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Separator', 'anps_theme_plugin'),
            'param_name' => 'separator',
            'value' => ',',
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
    )
));
