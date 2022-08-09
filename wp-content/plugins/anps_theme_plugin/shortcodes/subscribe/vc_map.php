<?php
vc_map( array(
   'name' => esc_html__('Subscribe', 'anps_theme_plugin'),
   'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
   'base' => 'anps_subscribe',
   'category' => 'Anps Shortcodes',
   'params' => array(
       array(
           'type' => 'dropdown',
           'heading' => esc_html__('Position', 'anps_theme_plugin'),
           'param_name' => 'input_position',
           'value' => array(
               esc_html__('Left', 'anps_theme_plugin')    => '0',
               esc_html__('Center', 'anps_theme_plugin')  => '0 auto',
               esc_html__('Right', 'anps_theme_plugin')   => '0 0 0 auto',
           ),
           'save_always' => true,
           'admin_label' => true
       ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Input field background color', 'anps_theme_plugin'),
            'param_name' => 'input_bg_color',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon color', 'anps_theme_plugin'),
            'param_name' => 'icon_color',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Text color', 'anps_theme_plugin'),
            'param_name' => 'text_color',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button background color', 'anps_theme_plugin'),
            'param_name' => 'btn_bg',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button background hover color', 'anps_theme_plugin'),
            'param_name' => 'btn_bg_hover',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button color', 'anps_theme_plugin'),
            'param_name' => 'btn_color_hover',
            'admin_label' => false
        ),
    )
));
