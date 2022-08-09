<?php
/* Logos */
class WPBakeryShortCode_logos extends WPBakeryShortCodesContainer {
    static function anps_logos_func($atts, $content) {
        return anps_logos_func($atts, $content);
    }
}
/* END Logos */
/* Logo */
class WPBakeryShortCode_anps_logo extends WPBakeryShortCode {
    static function anps_logo_func($atts, $content) {
        return anps_logo_func($atts, $content);
    }
}
/* END Logo */
/* VC logos (as parent) */
vc_map(array(
    'name' => esc_html__('Logos', 'anps_theme_plugin'),
    'base' => 'logos',
    'as_parent' => array('only' => 'logo'),
    'content_element' => true,
    'is_container' => true,
    'show_settings_on_create' => false,
    'category' => 'Anps Shortcodes',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'js_view' => 'VcColumnView',
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Type', 'anps_theme_plugin'),
            'param_name' => 'type',
            'value' => array(
                esc_html__('Full width', 'anps_theme_plugin') => 'fullwidth',
                esc_html__('3 columns', 'anps_theme_plugin') => 'col-3',
                esc_html__('4 columns', 'anps_theme_plugin') => 'col-4',
                esc_html__('5 columns', 'anps_theme_plugin') => 'col-5',
                esc_html__('6 columns', 'anps_theme_plugin') => 'col-6',
            ),
            'save_always' => true,
            'admin_label' => false,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Shadow', 'anps_theme_plugin'),
            'param_name' => 'shadow',
            'admin_label' => false,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Black and white color effect', 'anps_theme_plugin'),
            'param_name' => 'grayscale',
            'admin_label' => false,
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Enable carousel', 'anps_theme_plugin'),
            'param_name' => 'carousel',
            'admin_label' => false,
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Carousel speed', 'anps_theme_plugin'),
            'param_name' => 'carousel_speed',
            'admin_label' => false,
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Carousel offset', 'anps_theme_plugin'),
            'param_name' => 'carousel_offset',
            'admin_label' => false,
            'dependency' => array(
                'element' => 'type',
                'value'   => 'fullwidth',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Background color', 'anps_theme_plugin'),
            'param_name' => 'background_color',
            'value' => '',
            'admin_label' => false
        ),
    ),
));
/* END VC logos*/
/* VC logo (as child) */
vc_map(array(
    'name' => esc_html__('Logo', 'anps_theme_plugin'),
    'base' => 'logo',
    'content_element' => true,
    'category' => 'Anps Shortcodes',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'as_child' => array('only' => 'logos'),
    'params' => array(
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Image', 'anps_theme_plugin'),
            'param_name' => 'img',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Image url', 'anps_theme_plugin'),
            'param_name' => 'url',
            'admin_label' => false
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Link', 'anps_theme_plugin'),
            'param_name' => 'link',
            'admin_label' => true
        ),
    ),
));
/* END VC logo */
