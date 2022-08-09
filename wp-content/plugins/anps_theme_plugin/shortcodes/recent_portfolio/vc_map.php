<?php
vc_map( array(
    'name' => esc_html__('Recent portfolio', 'anps_theme_plugin'),
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'base' => 'recent_portfolio',
    'category' => 'Anps Shortcodes',
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Number of blog posts', 'anps_theme_plugin'),
            'param_name' => 'number',
            'value' => '',
            'description' => esc_html__('Enter number of recent blog posts. If you want to display all posts, leave this field empty.', 'anps_theme_plugin'),
            'admin_label' => true
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Columns', 'anps_theme_plugin'),
            'param_name' => 'number_in_row',
            'value' => array(
                '3' => '3',
                '4' => '4',
            ),
            'std' => '4',
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Slider', 'anps_theme_plugin'),
            'param_name' => 'slider',
            'value' => array(
                esc_html__('Enable', 'anps_theme_plugin') => '1',
                esc_html__('Disable', 'anps_theme_plugin') => '0'
            ),
            'std' => '4',
            'save_always' => true,
            'admin_label' => true
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Show slider navigation', 'anps_theme_plugin'),
            'param_name' => 'slider_nav',
            'value' => '',
            'std' => 'true',
            'admin_label' => false,
            'dependency' => array(
                'element' => 'slider',
                'value' => '1',
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Content length', 'anps_theme_plugin'),
            'param_name' => 'content_length',
            'value' => '',
            'description' => esc_html__('Content length (default 130).', 'anps_theme_plugin'),
            'admin_label' => true
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Show meta content', 'anps_theme_plugin'),
            'param_name' => 'show_meta',
            'value' => '',
            'std' => 'true',
            'admin_label' => false
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Category id/s', 'anps_theme_plugin'),
            'param_name' => 'cat_ids',
            'value' => '',
            'description' => esc_html__('Enter category id/s. Example: 1,2,3', 'anps_theme_plugin'),
            'admin_label' => true
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Title color', 'anps_theme_plugin'),
            'param_name' => 'title_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Text color', 'anps_theme_plugin'),
            'param_name' => 'text_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Link color', 'anps_theme_plugin'),
            'param_name' => 'link_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Link icon color', 'anps_theme_plugin'),
            'param_name' => 'link_icon_color',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
            'value' => '',
            'admin_label' => false,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Link icon background color', 'anps_theme_plugin'),
            'param_name' => 'link_icon_bg_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Hide post title', 'anps_theme_plugin'),
            'param_name' => 'hide_title',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Hide post content', 'anps_theme_plugin'),
            'param_name' => 'hide_content',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Hide post button', 'anps_theme_plugin'),
            'param_name' => 'hide_content_button',
            'value' => '',
            'admin_label' => false
        ),
    )
));
