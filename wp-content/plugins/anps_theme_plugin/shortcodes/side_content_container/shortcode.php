<?php
/* Side content container */
if(!function_exists('anps_side_content_container_func')) {
    function anps_side_content_container_func( $atts,  $content ) {
        extract( shortcode_atts( array(
            'shadow'  => '',
            'anps_padding' => '',
            'css'     => '',
        ), $atts ) );

        $return = '';

        $return .= '<div class="anps-side-container">';
            $return .= do_shortcode("[box_container css=\"{$css}\" anps_padding=\"{$anps_padding}\" shadow=\"{$shadow}\"]{$content}[/box_container]");
        $return .= '</div>';

        return $return;
    }
}
add_shortcode('side_content_container', 'anps_side_content_container_func');
