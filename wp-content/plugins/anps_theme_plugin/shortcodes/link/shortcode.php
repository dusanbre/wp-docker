<?php
if(!function_exists('anps_link_func')) {
    function anps_link_func($atts, $content) {
        extract( shortcode_atts( array(
            'icon_type' => '',
            'icon_fontawesome' => '',
            'icon_openiconic' => '',
            'icon_typicons' => '',
            'icon_entypo' => '',
            'icon_linecons' => '',
            'icon_monosocial' => '',
            'icon_anps_icons' => '',
            'image' => '',
            'icon_container' => '',
            'icon_container_size' => '',
            'link' => '',
            'text' => '',
            'icon_bg_color' => '',
            'icon_color' => '',
            'text_color' => '',
            'text_color_hover' => '',
            'icon_color_hover' => '',
            'icon_bg_color_hover' => '',
            'center_aligment' => '',
        ), $atts ) );

        $return = '';
        $icon_container = $icon_container === 'true';
        $icon_media = '';
        $icon_wrap_class = 'anps-link__icon-wrap';
        $icon_wrap_class .= !$icon_container ? ' anps-link__icon-wrap--no-bg' : '';

        $style_icon = anps_style_attr(array(
            'color' => $icon_color,
        ));

        $style_icon_wrap = anps_style_attr(array(
            'background-color' => $icon_bg_color,
        ));

        $rstyle_icon_wrap = anps_rstyle(array(
            'width' => $icon_container_size,
            'height' => $icon_container_size,
        ));

        $style_text = anps_style_attr(array(
            'color' => $text_color,
        ));

        $style_text_hover = anps_hover_style(array(
            'color' => $text_color_hover,
        ));

        $style_icon_hover = anps_hover_style(array(
            'color' => $icon_color_hover,
        ));

        $style_icon_wrap_hover = anps_hover_style(array(
            'background-color' => $icon_bg_color_hover,
        ));

        $icon_type_name = 'icon_' . $icon_type;

        if ($image !== '') {
            $icon_media = wp_get_attachment_image($image, 'full');
        } elseif ($icon_type === 'anps_icons') {
            $svg = anps_svg(str_replace('anps-icon-', '', $icon_anps_icons), ANPS_PLUGIN_URL . 'icons/');
            $icon_media = '<div' . $style_icon . $style_icon_hover . ' class="anps-link__icon">' . $svg . '</div>';
        } else {
            if (function_exists('vc_icon_element_fonts_enqueue')) {
                vc_icon_element_fonts_enqueue($icon_type);
                $icon_media = '<i' . $style_icon . $style_icon_hover . ' class="anps-link__icon ' . $$icon_type_name . '"></i>';
            }
        }

        $link_class = 'anps-link';

        if ($text_color_hover === '' && $icon_color_hover === '') {
            $link_class .= ' anps-link--hover';
        }
        
        if($center_aligment != '') {
            $link_class .= ' anps-link--center';
        }

        $return .= '<a class="' . $link_class . '"' . anps_get_vc_link($link) . '>';
            if ($$icon_type_name !== '') {
                if ($icon_container) {
                    $return .= '<span' . $style_icon_wrap . $style_icon_wrap_hover . $rstyle_icon_wrap . ' class="' . $icon_wrap_class . '">';
                }
                $return .= $icon_media;
                if ($icon_container) {
                    $return .= '</span>';
                }
            }
            $return .= '<span' . $style_text . $style_text_hover . ' class="anps-link__text">' . $text . '</span>';
        $return .= '</a>';

        return $return;
    }
}
add_shortcode('anps_link', 'anps_link_func');
