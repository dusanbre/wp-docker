<?php
if(!function_exists('anps_subscribe_func')) {
    function anps_subscribe_func($atts, $content) {
        extract(shortcode_atts( array(
            'input_position'  => '',
            'input_bg_color' => '',
            'icon_color' => '',
            'text_color' => '',
            'btn_bg' => '',
            'btn_bg_hover' => '',
            'btn_color_hover' => '',
        ), $atts ) );

        $style = anps_style_attr(array(
            'margin' => $input_position,
            '--input-bg-color' => $input_bg_color,
            '--icon-color' => $icon_color,
            '--text-color' => $text_color,
            '--btn-bg' => $btn_bg,
            '--btn-bg-hover' => $btn_bg_hover,
            '--btn-color-hover' => $btn_color_hover,
        ));

        $return = '<div' . $style . ' class="anps-subscribe">';
        $return .= do_shortcode("[newsletter_form default_css='false'][/newsletter_form]");
        $return .= '</div>';

        return $return;
    }
}
add_shortcode('anps_subscribe', 'anps_subscribe_func');
