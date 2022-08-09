<?php
if(!function_exists('anps_icon_func')) {
    function anps_icon_func($atts, $content) {
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
            'position' => '',
            'vertical_align' => '',
            'link' => '',
            'icon_size' => '',
            'icon_spacing' => '',
            'icon_mobile_above' => '',
            'container_size' => '',
            'color' => '',
            'shadow' => '',
            'overflow_hidden' => '',
            'css' => '',
        ), $atts ) );

        if ($icon_size === '' || $icon_size === '|||') {
            $icon_size = '|||30';
        }

        $return = '';
        $class_name = 'anps-icon__wrap';

        if ($shadow === 'true') {
            $class_name .= ' anps-icon--shadow';
        }

        if ($overflow_hidden === 'true') {
            $class_name .= ' anps-icon--overflow-hidden';
        }

        $rstyle = anps_rstyle(array(
            'font-size' => $icon_size,
            'width'     => $container_size,
            'height'    => $container_size,
            'margin-right' => $icon_spacing,
            'margin-bottom' => $icon_spacing,
            'margin-left' => $icon_spacing,
        ));

        $style = anps_style_attr(array(
            'color' => $color,
        ));

        $rstyle_img = anps_rstyle(array(
            'width'  => $icon_size,
            'height' => $icon_size,
        ));

        /* Initial load size */

        $icon_size_initial = explode('|', $icon_size);
        $icon_size_initial = $icon_size_initial[3];

        $style_img = anps_style_attr(array(
            'width'  => $icon_size_initial . 'px',
            'height' => $icon_size_initial . 'px',
        ));

        if ($css !== '') {
            preg_match('/\.([^\.]*)\{/', $css, $matches);
            $custom_class_name = $matches[1];
            $return .= '<style>' . esc_html($css) . '</style>';
            $class_name .= ' ' . $custom_class_name;
        }

        $icon_media = '';
        if ($image !== '') {
            $icon_media = '<div' . $rstyle_img . ' class="anps-icon__image">'.wp_get_attachment_image($image, 'full').'</div>';
        } elseif ($icon_type === 'anps_icons') {
            $svg = anps_svg(str_replace('anps-icon-', '', $icon_anps_icons), ANPS_PLUGIN_URL . 'icons/');
            $icon_media = '<div' . $rstyle_img . $style_img . ' class="anps-icon__image">' . $svg . '</div>';
        } else {
            vc_icon_element_fonts_enqueue($icon_type);
            $icon_type_name = 'icon_' . $icon_type;

            $icon_media = '<i class="anps-icon__icon ' . $$icon_type_name . '"></i>';
        }

        $class_icon_name = "anps-icon anps-icon--{$position} anps-icon--v-{$vertical_align}";

        if ($icon_mobile_above === 'true') {
            $class_icon_name .= ' anps-icon--mobile-above';
        }

        $return .= "<div class='$class_icon_name'>";
            if ($link) {
                $return .= "<div class='anps-icon__col anps-icon__col--icon'><a{$style}{$rstyle}" . anps_get_vc_link($link) . " class='{$class_name}'>{$icon_media}</a></div>";
            } else {
                $return .= "<div class='anps-icon__col anps-icon__col--icon'><div{$style}{$rstyle} class='{$class_name}'>{$icon_media}</div></div>";
            }
            if ($content !== '') {
                $return .= '<div class="anps-icon__col anps-icon__col--content">' . do_shortcode($content) . '</div>';
            }
        $return .= "</div>";

        return $return;
    }
}
add_shortcode('icon', 'anps_icon_func');
