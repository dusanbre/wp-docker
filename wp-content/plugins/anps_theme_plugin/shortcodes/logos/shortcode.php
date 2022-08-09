<?php
/* Logos */
if(!function_exists('anps_logos_func')) {
    function anps_logos_func($atts, $content) {
        extract(shortcode_atts(array(
            'type'             => '',
            'shadow'           => '',
            'grayscale'        => '',
            'carousel'         => '',
            'carousel_speed'   => '',
            'carousel_offset'  => '',
            'background_color' => '',
        ), $atts));

        global $anps_options;

        $carousel = $carousel === 'true';

        if (intval($carousel_offset) . '' === $carousel_offset) {
            $carousel_offset .= 'px';
        }

        $anps_options = array(
            'background-color' => $background_color,
        );

        if (!$carousel_offset === '') {
            $anps_options['transform'] = "translateX({$carousel_offset})";
        }

        $class_name = 'anps-logos';
        $class_name .= ' anps-logos--' . $type;
        $class_name .= $shadow === 'true' ? ' anps-logos--shadow' : '';
        $class_name .= $grayscale === 'true' ? ' anps-logos--grayscale' : '';
        $class_name .= $carousel ? ' anps-logos--carousel' : ' anps-logos--grid';

        $columns = 'full';

        if (strpos($type, 'col-') !== false) {
            $columns = str_replace('col-', '', $type);
        }

        $style_outer_options = array();

        if ($columns === 'full' && $carousel) {
            $style_outer_options['animation'] = 'logos ' . ($carousel_speed/1000) . 's forwards linear infinite';
        }

        $style_outer = anps_style_attr($style_outer_options);

        $return = '';

        $return .= '<div class="' . $class_name . '">';
        $return .= '<div class="anps-logos__outer-wrap"' . $style_outer . '>';
            if ($carousel && $columns !== 'full') {
                $return .= '<div class="owl-carousel" data-col="' . $columns . '" data-speed="' . $carousel_speed . '">';
            }
            $return .= do_shortcode($content);
            if ($carousel && $columns !== 'full') {
                $return .= '</div>';
            }
            $return .= '</div>';
        $return .= '</div>';

        return $return;
    }
}
//single logo
if(!function_exists('anps_logo_func')) {
    function anps_logo_func($atts, $content) {
        extract( shortcode_atts( array(
            'link' => '',
            'img' => ''
        ), $atts ) );

        global $anps_options;

        $return = '';

        $style = array();
        if (isset($anps_options['transform']) && $anps_options['transform'] !== '') {
            $style['transform'] = $anps_options['transform'];
        }

        $style_wrap = anps_style_attr(array(
            'background-color' => $anps_options['background-color'],
        ));

        $return .= '<div' . anps_style_attr($style) . ' class="anps-logos__item">';
            if ($link !== '') {
                $return .= '<a' . $style_wrap . ' class="anps-logos__link" ' . anps_get_vc_link($link) . '>';
            } else {
                $return .= '<div' . $style_wrap . ' class="anps-logos__wrap">';
            }
            $return .= '<div class="anps-logos__img">' . wp_get_attachment_image($img, 'full') . '</div>';
            if ($link !== '') {
                $return .= '</a>';
            } else {
                $return .= '</div>';
            }
        $return .= '</div>';

        return $return;
    }
}
/* END Logos */
/* Load shortcodes */
if (is_plugin_active('js_composer/js_composer.php') && function_exists('vc_add_shortcode_param')) {
    add_shortcode('logos', array('WPBakeryShortCode_logos','anps_logos_func'));
    add_shortcode('logo', array('WPBakeryShortCode_anps_logo','anps_logo_func'));
} else {
    add_shortcode('logos', 'anps_logos_func');
    add_shortcode('logo', 'anps_logo_func');
}
