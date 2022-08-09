<?php
class WPBakeryShortCode_Content_Over_Img extends WPBakeryShortCodesContainer {}

vc_map( array(
   'name' => esc_html__('Content over image', 'anps_theme_plugin'),
   'base' => 'content_over_img',
   'content_element' => true,
   'is_container' => true,
   'js_view' => 'VcColumnView',
   'icon' => plugin_dir_url(__FILE__).'vc_icon.png',
   'category' => 'Anps Shortcodes',
   'params' => array(
       array(
         'type' => 'dropdown',
         'heading' => esc_html__('Image location', 'anps_theme_plugin'),
         'param_name' => 'image_location',
         'value' => array(
                    esc_html__('Left', 'anps_theme_plugin')=>'left',
                    esc_html__('Right', 'anps_theme_plugin')=>'right'
             ),
         'save_always' => true,
         'admin_label' => false
       ),
       array(
         'type' => 'attach_image',
         'heading' => esc_html__('Background image', 'anps_theme_plugin'),
         'param_name' => 'image',
         'admin_label' => false
       ),
   )
) );