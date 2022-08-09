<?php
class WPBakeryShortCode_Icon extends WPBakeryShortCodesContainer {}

vc_map( array(
    'name' => esc_html__('Icon', 'anps_theme_plugin'),
    'base' => 'icon',
    'content_element' => true,
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'category' => 'Anps Shortcodes',
    'is_container' => true,
    'params' => array(
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
            'admin_label' => true,
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
            'admin_label' => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Position', 'anps_theme_plugin'),
            'param_name' => 'position',
            'value' => array(
                esc_html__('Left', 'anps_theme_plugin') => 'left',
                esc_html__('Right', 'anps_theme_plugin') => 'right',
                esc_html__('Center', 'anps_theme_plugin') => 'center',
                esc_html__('Left of content', 'anps_theme_plugin') => 'left-content',
                esc_html__('Right of content', 'anps_theme_plugin') => 'right-content',
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Vertical align', 'anps_theme_plugin'),
            'param_name' => 'vertical_align',
            'value' => array(
                esc_html__('Top', 'anps_theme_plugin') => 'top',
                esc_html__('Bottom', 'anps_theme_plugin') => 'bottom',
                esc_html__('Middle', 'anps_theme_plugin') => 'middle',
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Link', 'anps_theme_plugin'),
            'param_name' => 'link',
            'admin_label' => true,
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Icon size', 'anps_theme_plugin'),
            'param_name' => 'icon_size',
            'admin_label' => true,
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Icon container size', 'anps_theme_plugin'),
            'param_name' => 'container_size',
            'admin_label' => true,
            'value' => '',
        ),
        array(
            'type' => 'anps_input',
            'heading' => esc_html__('Icon spacing', 'anps_theme_plugin'),
            'param_name' => 'icon_spacing',
            'admin_label' => true,
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
            'heading' => esc_html__('Overflow hidden', 'anps_theme_plugin'),
            'param_name' => 'overflow_hidden',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Put icon above on mobile', 'anps_theme_plugin'),
            'param_name' => 'icon_mobile_above',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon color', 'anps_theme_plugin'),
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
    ),
    'js_view' => 'VcColumnView',
));
