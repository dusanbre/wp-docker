<?php
if(!function_exists('anps_empty_space_func')) {
    function anps_empty_space_func($atts, $content) {
        extract( shortcode_atts( array(
            'size' => '',
        ), $atts ) );

        $rstyle = anps_rstyle(array(
            'height' => $size,
        ));

        return "<div{$rstyle} class='anps-empty-space'></div>";
    }
}
add_shortcode('anps_empty_space', 'anps_empty_space_func');
