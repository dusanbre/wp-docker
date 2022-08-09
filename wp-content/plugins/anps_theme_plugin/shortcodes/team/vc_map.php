<?php
vc_map( array(
   'name' => esc_html__('Team', 'anps_theme_plugin'),
   'base' => 'team',
   'category' => 'Anps Shortcodes',
   'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
   'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Number of columns', 'anps_theme_plugin'),
            'param_name' => 'columns',
            'value' => array(
                esc_html__('2', 'anps_theme_plugin') => '2',
                esc_html__('3', 'anps_theme_plugin') => '3',
                esc_html__('4', 'anps_theme_plugin') => '4',
                esc_html__('5', 'anps_theme_plugin') => '5',
                esc_html__('6', 'anps_theme_plugin') => '6',
            ),
            'save_always' => true,
		),
		array(
            'type' => 'dropdown',
            'heading' => esc_html__('Layout type', 'anps_theme_plugin'),
            'param_name' => 'layout_type',
            'value' => array(
				esc_html__('Grid', 'anps_theme_plugin') => 'grid',
                esc_html__('Carousel', 'anps_theme_plugin') => 'carousel',
            ),
            'description' => esc_html__('Order by.', 'anps_theme_plugin'),
            'save_always' => true,
		),
		array(
			'heading' => esc_html__('Team members', 'anps_theme_plugin'),
			'param_name' => 'filter',
			'type' => 'anps_autocomplete',
			'post_type' => 'team',
			'description' => esc_html__('Show only certain team members. By default all team members are shown.', 'anps_theme_plugin'),
		),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Order members by', 'anps_theme_plugin'),
            'param_name' => 'orderby',
            'value' => array(
				esc_html__('Default', 'anps_theme_plugin') => '',
                esc_html__('Id', 'anps_theme_plugin')      => 'ID',
                esc_html__('Date', 'anps_theme_plugin')    => 'date',
                esc_html__('Title', 'anps_theme_plugin')   => 'title',
                esc_html__('Name', 'anps_theme_plugin')    => 'name',
                esc_html__('Author', 'anps_theme_plugin')  => 'author'
            ),
            'description' => esc_html__('Order by.', 'anps_theme_plugin'),
            'save_always' => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Order', 'anps_theme_plugin'),
            'param_name' => 'order',
            'value' => array(
                esc_html__('Ascending', 'anps_theme_plugin')  => 'ASC',
                esc_html__('Descending', 'anps_theme_plugin') => 'DESC',
            ),
            'save_always' => true,
        ),
		array(
            'type' => 'dropdown',
            'heading' => esc_html__('Member image type', 'anps_theme_plugin'),
            'param_name' => 'image_type',
            'value' => array(
				esc_html__('Square', 'anps_theme_plugin') => 'square',
                esc_html__('Circle', 'anps_theme_plugin') => 'circle',
            ),
            'description' => esc_html__('Order by.', 'anps_theme_plugin'),
            'save_always' => true,
		),
		array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Background color', 'anps_theme_plugin'),
            'param_name' => 'background_color',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Name color', 'anps_theme_plugin'),
            'param_name' => 'name_color',
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
            'type' => 'checkbox',
            'heading' => esc_html__('Shadow', 'anps_theme_plugin'),
            'param_name' => 'shadow',
            'value' => '',
            'admin_label' => false
        ),
    ),
));