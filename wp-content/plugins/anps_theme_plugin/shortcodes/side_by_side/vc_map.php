<?php
class WPBakeryShortCode_Side_By_Side extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_Side_By_Side_Item extends WPBakeryShortCodesContainer {}

vc_map( array(
    'name' => esc_html__('Side-by-side', 'anps_theme_plugin'),
    'base' => 'side_by_side',
    'content_element' => true,
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'category' => 'Anps Shortcodes',
    'is_container' => true,
    'as_parent' => array('only' => 'side_by_side_item'),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align', 'anps_theme_plugin'),
            'param_name' => 'align',
            'value' => array(
                esc_html__('Left', 'anps_theme_plugin') => 'left',
                esc_html__('Right', 'anps_theme_plugin') => 'right',
                esc_html__('Center', 'anps_theme_plugin') => 'center',
                esc_html__('Space between', 'anps_theme_plugin') => 'space_between',
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
            'type' => 'anps_input',
            'heading' => esc_html__('Spacing', 'anps_theme_plugin'),
            'param_name' => 'spacing',
            'admin_label' => true,
        ),
    ),
    'js_view' => 'VcColumnView',
));


vc_map( array(
    'name' => esc_html__('Side-by-side item', 'anps_theme_plugin'),
    'base' => 'side_by_side_item',
    'content_element' => true,
    'is_container' => true,
    'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
    'category' => 'Anps Shortcodes',
    'as_child' => array('only' => 'side_by_side'),
    'params' => array(

    ),
    'js_view' => 'VcColumnView',
));
