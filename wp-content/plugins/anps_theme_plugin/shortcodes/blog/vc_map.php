<?php
vc_map( array(
    'name' => esc_html__('Blog', 'anps_theme_plugin'),
    'base' => 'blog',
    'category' => 'Anps Shortcodes',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'params' => array(
		array(
			'heading' => esc_html__('Categories', 'anps_theme_plugin'),
			'param_name' => 'category',
			'type' => 'anps_autocomplete',
			'term' => 'category',
			'description' => esc_html__('Show only posts from certain categories. By default all posts are shown.', 'anps_theme_plugin'),
		),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Posts per page', 'anps_theme_plugin'),
            'param_name' => 'per_page',
            'description' => esc_html__('Enter post per page.', 'anps_theme_plugin'),
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Order By', 'anps_theme_plugin'),
            'param_name' => 'orderby',
            'value' => array(
                esc_html__('Default', 'anps_theme_plugin') => '',
                esc_html__('Date', 'anps_theme_plugin')    => 'date',
                esc_html__('Id', 'anps_theme_plugin')      => 'ID',
                esc_html__('Title', 'anps_theme_plugin')   => 'title',
                esc_html__('Name', 'anps_theme_plugin')    => 'name',
                esc_html__('Author', 'anps_theme_plugin')  => 'author'
            ),
            'description' => esc_html__('Order by.', 'anps_theme_plugin'),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Order', 'anps_theme_plugin'),
            'param_name' => 'order',
            'value' => array(
                esc_html__('Default', 'anps_theme_plugin') => '',
                esc_html__('ASC', 'anps_theme_plugin')     => 'ASC',
                esc_html__('DESC', 'anps_theme_plugin')    => 'DESC'
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Columns', 'anps_theme_plugin'),
            'param_name' => 'columns',
            'value' => array(
                esc_html__('1 column', 'anps_theme_plugin')  => '1',
                esc_html__('2 columns', 'anps_theme_plugin') => '2',
                esc_html__('3 columns', 'anps_theme_plugin') => '3',
                esc_html__('4 columns', 'anps_theme_plugin') => '4'
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Style', 'anps_theme_plugin'),
            'param_name' => 'post_style',
            'value' => array(
                esc_html__('Style 1', 'anps_theme_plugin') => 'style-1',
                esc_html__('Style 2', 'anps_theme_plugin') => 'style-2',
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Layout', 'anps_theme_plugin'),
            'param_name' => 'layout',
            'value' => array(
                esc_html__('Image left of text', 'anps_theme_plugin')  => 'img-left',
                esc_html__('Image right of text', 'anps_theme_plugin') => 'img-right',
                esc_html__('Image above text', 'anps_theme_plugin')    => 'img-above'
            ),
            'dependency'  => array(
                'element' => 'columns',
                'value' => '1',
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Image size', 'anps_theme_plugin'),
            'param_name' => 'image_size',
            'value' => array(
                esc_html__('Cover', 'anps_theme_plugin')  => 'img-cover',
                esc_html__('Normal', 'anps_theme_plugin') => 'img-normal',
            ),
            'dependency'  => array(
                'element' => 'layout',
                'value' => array(
                    'img-left',
                    'img-right',
                ),
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Hide post content / excerpt', 'anps_theme_plugin'),
            'param_name' => 'hide_content',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Hide pagination', 'anps_theme_plugin'),
            'param_name' => 'hide_pagination',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Shadow', 'anps_theme_plugin'),
            'param_name' => 'shadow',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Ajax load more blog posts', 'anps_theme_plugin'),
            'param_name' => 'ajax_load_more',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Background color', 'anps_theme_plugin'),
            'param_name' => 'bg_color',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Link icon color', 'anps_theme_plugin'),
            'param_name' => 'link_icon_color',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Link icon background color', 'anps_theme_plugin'),
            'param_name' => 'link_icon_bg_color',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Link text color', 'anps_theme_plugin'),
            'param_name' => 'link_text_color',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
            'value' => '',
            'admin_label' => false,
        ),
    )
));
