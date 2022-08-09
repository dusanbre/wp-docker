<?php
vc_map( array(
    'name' => esc_html__('Button', 'anps_theme_plugin'),
    'base' => 'button',
    'category' => 'Anps Shortcodes',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Text', 'anps_theme_plugin'),
            'param_name' => 'content',
            'admin_label' => false
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Link', 'anps_theme_plugin'),
            'param_name' => 'link',
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Size', 'anps_theme_plugin'),
            'param_name' => 'size',
            'value' => array(
                esc_html__('Small', 'anps_theme_plugin')  => 'sm',
                esc_html__('Medium', 'anps_theme_plugin') => 'md',
                esc_html__('Large', 'anps_theme_plugin')  => 'lg'
            ),
            'save_always' => true,
            'admin_label' => false
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Align', 'js_composer' ),
            'value' => array(
                esc_html__( 'Left', 'js_composer' )   => 'left',
                esc_html__( 'Right', 'js_composer' )  => 'right',
                esc_html__( 'Center', 'js_composer' ) => 'center',
            ),
            'admin_label' => false,
            'param_name' => 'align',
            'save_always' => true
        ),
        array(
            'type' => 'anps_buttons',
            'heading' => esc_html__('Style', 'anps_theme_plugin'),
            'param_name' => 'style_button',
            'save_always' => true,
            'admin_label' => false
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Width', 'anps_theme_plugin'),
            'param_name' => 'width',
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
            'admin_label' => false,
            'param_name' => 'icon_type',
            'description' => esc_html__( 'Select icon library.', 'js_composer' ),
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
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Custom icon image', 'anps_theme_plugin'),
            'param_name' => 'image',
            'description' => esc_html__('Upload a custom image icon.', 'anps_theme_plugin'),
            'admin_label' => false,
        ),
    )
));
