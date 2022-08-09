<?php
vc_map( array(
    'name' => esc_html__('Empty space', 'anps_theme_plugin'),
    'base' => 'anps_empty_space',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'category' => 'Anps Shortcodes',
    'params' => array(
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Size', 'anps_theme_plugin'),
            'param_name' => 'size',
        ),
    ),
));
