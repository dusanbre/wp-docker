<?php
/* Box container */
if(!function_exists('anps_box_container_func')) {
    function anps_box_container_func( $atts,  $content ) {
        extract( shortcode_atts( array(
            'shadow'  => '',
            'anps_padding' => '',
            'css'     => '',
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

        $return .= '<div class="' . $class_name . '"><div' . $rstyle . ' class="anps-box__wrap">' . do_shortcode($content) . '</div></div>';

        return $return;
    }
}
add_shortcode('box_container', 'anps_box_container_func');
