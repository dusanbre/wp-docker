<?php
if(!function_exists('anps_side_by_side_func')) {
    function anps_side_by_side_func($atts, $content) {
        extract( shortcode_atts( array(
            'align'          => '',
            'vertical_align' => '',
            'spacing'        => '',
        ), $atts ) );

        global $anps_sbs_rstyle;

        $anps_sbs_rstyle = anps_rstyle(array(
            'padding-left' => $spacing,
            'padding-top' => $spacing,
        ));

        $class = 'side-by-side';
        $class .= ' side-by-side--' . $align;
        $class .= ' side-by-side--' . $vertical_align;

        $return = '';
        $return .= '<div class="' . $class . '">';
        $return .= do_shortcode($content);
        $return .= '</div>';

        return $return;
    }
}
add_shortcode('side_by_side', 'anps_side_by_side_func');

if(!function_exists('anps_side_by_side_item_func')) {
    function anps_side_by_side_item_func($atts, $content) {
        global $anps_sbs_rstyle;

        return '<div' . $anps_sbs_rstyle . ' class="side-by-side__item">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('side_by_side_item', 'anps_side_by_side_item_func');
