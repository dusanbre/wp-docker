<?php
if(!function_exists('anps_counter_func')) {
    $counter_number = 0;
    function anps_counter_func($atts, $content) {
        extract( shortcode_atts( array(
            'from' => '0',
            'to' => '500',
            'duration' => '5',
            'use_grouping' => 'true',
            'use_easing' => 'true',
            'separator' => ',',
            'decimal' => '.',
            'font_size' => '',
            'text_align' => '',
            'text_style' => '',
            'font_weight' => '',
            'line_height' => '',
            'color' => '',
            'spacing' => '',
        ), $atts ) );

        global $counter_number;
        $counter_number++;
        wp_enqueue_script('countto');

        $rstyle = anps_rstyle(array(
            'margin-bottom' => $spacing,
            'font-size'     => $font_size,
            'line-height'   => $line_height,
        ));
        
        $style = anps_style_attr(array(
            'text-align' => $text_align,
            'color' => $color,
            'font-weight' => $font_weight,
            'text-transform' => $text_style,
        ));

        return "<div
            $style
            $rstyle
            class='anps-counter'
            id='anps-counter-$counter_number'
            data-from='$from'
            data-to='$to'
            data-duration='$duration'
            data-use-grouping='$use_grouping'
            data-use-easing='$use_easing'
            data-separator='$separator'
            data-decimal='$decimal'
        >$from</div>";
    }
}
add_shortcode('counter', 'anps_counter_func');
