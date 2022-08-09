<?php
function anps_rstyle($styles) {
    $return = '';

    foreach($styles as $property => $values) {
        if ($values !== '') {
            $return .= "{$property}:{$values};";
        }
    }

    if ($return !== '') {
        $return = " data-rstyle=\"$return\"";
    }

    return $return;
}

if(!function_exists('anps_heading_func')) {
    function anps_heading_func( $atts,  $content ) {
        extract( shortcode_atts( array(
            'text'        => '',
            'tag'         => '',
            'class'       => '',
            'id'          => '',
            'spacing'     => '',
            'font_size'   => '',
            'text_align'  => '',
            'font_weight' => '',
            'line_height' => '',
            'color'       => '',
            'link'        => '',
            'text_style'  => '',
            'css'         => '',
        ), $atts ) );
        $text = str_replace("``", '"',$text);
        if (strpos($text, '<br') === false) {
            $text = nl2br($text);
        }

        $rstyle = anps_rstyle(array(
            'margin-bottom' => $spacing,
            'font-size'     => $font_size,
            'line-height'   => $line_height,
        ));
        
        $style = anps_style_attr(array(
            'text-align' => $text_align,
        ));
        
        $style_el = anps_style_attr(array(
            'color' => $color,
            'font-weight' => $font_weight,
            'text-transform' => $text_style,
        ));

        if ($id !== '') {
            $id = " id=\"$id\"";
        }

        $return = '';
        $class_name = 'anps-heading';
        $class_name_el = $class;

        if ($css !== '') {
            preg_match('/\.([^\.]*)\{/', $css, $matches);
            $custom_class_name = $matches[1];
            $return .= '<style>' . esc_html($css) . '</style>';
            $class_name_el .= ' ' . $custom_class_name;
        }

        $el_start = "<span{$style_el}{$rstyle} class=\"{$class_name_el} anps-heading__text\">";
        $el_end = '</span>';

        if ($link !== '') {
            $el_start = '<a' . $style_el . $rstyle . ' class="' . $class_name_el . ' anps-heading__link" ' . anps_get_vc_link($link) . '>';
            $el_end = "</a>";
        }

        
        $return .= "<{$tag} class=\"{$class_name}\"{$style}{$id}>{$el_start}{$text}{$el_end}</{$tag}>";

        return $return;
    }
}
add_shortcode('heading', 'anps_heading_func');