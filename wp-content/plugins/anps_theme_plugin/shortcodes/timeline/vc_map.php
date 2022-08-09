<?php
/* Timeline */
class WPBakeryShortCode_timeline extends WPBakeryShortCodesContainer {
    static function anps_timeline_func($atts, $content) {
        return anps_timeline_func($atts, $content);
    }
}
/* END Timeline */
/* Timeline item */
class WPBakeryShortCode_timeline_item extends WPBakeryShortCode {
    static function anps_timeline_item_func($atts, $content) {
        return anps_timeline_item_func($atts, $content);
    }
}
/* END Timeline item */
/* Timeline date */
class WPBakeryShortCode_timeline_date extends WPBakeryShortCode {
    static function anps_timeline_date_func($atts, $content) {
        return anps_timeline_date_func($atts, $content);
    }
}
/* END Timeline date */
/* VC Timeline (as parent) */
vc_map(array(
    'name' => esc_html__('Timeline', 'anps_theme_plugin'),
    'base' => 'timeline',
    'category' => 'Anps Shortcodes',
    'content_element' => true,
    'is_container' => true,
    'show_settings_on_create' => false,
    'as_parent' => array('only' => 'timeline_item,timeline_date'),
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'js_view' => 'VcColumnView',
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Style', 'js_composer' ),
            'value' => array(
                esc_html__( 'Style 1', 'js_composer' ) => 'style-1',
                esc_html__( 'Style 2', 'js_composer' ) => 'style-2',
            ),
            'admin_label' => true,
            'param_name' => 'style',
            'save_always' => true
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Shadow', 'anps_theme_plugin'),
            'param_name' => 'shadow',
            'value' => '',
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Background color', 'anps_theme_plugin'),
            'param_name' => 'bg_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Content background color', 'anps_theme_plugin'),
            'param_name' => 'content_bg_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Line color', 'anps_theme_plugin'),
            'param_name' => 'line_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Dot color', 'anps_theme_plugin'),
            'param_name' => 'dot_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
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
            'heading' => esc_html__('Date color', 'anps_theme_plugin'),
            'param_name' => 'date_color',
            'value' => '',
            'admin_label' => false,
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
        ),
    ),
));
/* END VC Timeline */
/* VC Timeline item (as child) */
vc_map( array(
    'name' => esc_html__('Timeline item', 'anps_theme_plugin'),
    'base' => 'timeline_item',
    'content_element' => true,
    'category' => 'Anps Shortcodes',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'as_child' => array('only' => 'timeline'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Subtitle', 'anps_theme_plugin'),
            'param_name' => 'subtitle',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Title', 'anps_theme_plugin'),
            'param_name' => 'title',
            'admin_label' => true
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Content', 'anps_theme_plugin'),
            'param_name' => 'content',
            'description' => esc_html__('Enter content.', 'anps_theme_plugin'),
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Date color', 'anps_theme_plugin'),
            'param_name' => 'date_color',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Title color', 'anps_theme_plugin'),
            'param_name' => 'title_color',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
            'admin_label' => false
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Indicator color', 'anps_theme_plugin'),
            'param_name' => 'indicator_color',
            'group' => esc_html__('Design Options', 'anps_theme_plugin'),
            'admin_label' => false
        ),
    )
));
/* END VC Timeline item */
/* VC Timeline date (as child) */
vc_map( array(
    'name' => esc_html__('Timeline date', 'anps_theme_plugin'),
    'base' => 'timeline_date',
    'content_element' => true,
    'category' => 'Anps Shortcodes',
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'as_child' => array('only' => 'timeline'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Text', 'anps_theme_plugin'),
            'param_name' => 'text',
            'value' => '',
            'admin_label' => true
        ),
    )
));
/* END VC Timeline date */