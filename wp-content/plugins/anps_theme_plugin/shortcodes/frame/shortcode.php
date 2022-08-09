<?php
/* Frame container */
if(!function_exists('anps_frame_container_func')) {
    function anps_frame_container_func( $atts,  $content) {
        extract( shortcode_atts( array(
            'style'          => '',
            'container'      => '',
            'bg_color'       => '',
            'frame_bg_color' => '',
            'frame_color'    => '',
            'bottom_spacing' => '',
            'class_name'     => '',
        ), $atts ));

        $style_attr = anps_style_bg_color($bg_color);

        $style_attr_svg = anps_style_attr(array(
            'fill' => $frame_color,
            'color' => $frame_bg_color,
        ));

        $class_name = 'anps-frame';
        $class_name .= ' anps-frame--style-' . esc_attr($style);
        $class_name .= $bottom_spacing === 'true' ? ' anps-frame--spacing' : '';

        $return = '<div' . $style_attr . ' class="' . $class_name . '">';
            $return .= '<div class="anps-frame__container">' . do_shortcode($content) . '</div>';
            $return .= '<div class="anps-frame__img"' . $style_attr_svg . '>' . anps_svg('frame-' . $style) . '</div>';
        $return .= '</div>';

        return $return;
    }
}
add_shortcode('frame_container', 'anps_frame_container_func');
