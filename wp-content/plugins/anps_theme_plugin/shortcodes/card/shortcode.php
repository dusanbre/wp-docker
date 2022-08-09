<?php
/* Card container */
if(!function_exists('anps_card_container_func')) {
    function anps_card_container_func( $atts,  $content ) {
        extract( shortcode_atts( array(
            'link'         => '',
            'shadow'       => '',
            'image'        => '',
            'anps_padding' => '',
            'css'          => '',
        ), $atts ) );

        $class_name = 'anps-box';
        $return = '';

        $rstyle = anps_rstyle(array(
            'padding' => $anps_padding,
        ));

        if ($css !== '') {
            preg_match('/\.([^\.]*)\{/', $css, $matches);
            $custom_class_name = $matches[1];
            $return .= '<style>' . esc_html($css) . '</style>';
            $class_name .= ' ' . $custom_class_name;
        }

        if ($shadow === 'true') {
            $class_name .= ' anps-box--shadow';
        }

        $return .= '<div class="' . $class_name . '">';
            if(!$link) {
                $return .= '<div class="anps-box__img">';
                    $return .= wp_get_attachment_image($image, 'full');
                $return .= '</div>';
            } else {
                $return .= '<a' . anps_get_vc_link($link) . ' class="anps-box__img">';
                    $return .= wp_get_attachment_image($image, 'full');
                $return .= '</a>';
            }
            $return .= '<div' . $rstyle . ' class="anps-box__wrap">';
                $return .= do_shortcode($content);
            $return .= '</div>';
        $return .= '</div>';

        return $return;
    }
}
add_shortcode('card_container', 'anps_card_container_func');
