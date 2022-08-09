<?php
if(!function_exists('anps_info_table_func')) {
    function anps_info_table_func($atts, $content) {
        extract( shortcode_atts( array(
            'anps_padding' => '',
            'spacing' => '',
            'title_color' => '',
            'text_color' => '',
            'font_size_title' => '',
            'font_size_text' => '',
            'font_weight_title' => '',
            'font_weight_text' => '',
            'css' => '',
        ), $atts ) );

        global $anps_itable_spacing, $anps_itable_title_color, $anps_itable_text_color, $anps_itable_font_size_title, $anps_itable_font_size_text, $anps_itable_font_weight_title, $anps_itable_font_weight_text;

        $anps_itable_spacing = $spacing;
        $anps_itable_title_color = $title_color;
        $anps_itable_text_color = $text_color;
        $anps_itable_font_size_title = $font_size_title;
        $anps_itable_font_weight_title = $font_weight_title;
        $anps_itable_font_size_text = $font_size_text;
        $anps_itable_font_weight_text = $font_weight_text;

        $class_name = 'anps-itable';

        $rstyle = anps_rstyle(array(
            'padding' => $anps_padding,
        ));

        if ($css !== '') {
            preg_match('/\.([^\.]*)\{/', $css, $matches);
            $custom_class_name = $matches[1];
            //$return .= '<style>' . esc_html($css) . '</style>';
            $class_name .= ' ' . $custom_class_name;
        }

        ob_start();

        ?>
        <div<?php echo $rstyle; ?> class="<?php echo esc_attr($class_name); ?>">
            <?php echo do_shortcode($content); ?>
        </div>
        <?php

        return ob_get_clean();
    }
}
add_shortcode('info_table', 'anps_info_table_func');

if(!function_exists('anps_info_table_item_func')) {
    function anps_info_table_item_func($atts, $content) {
        extract( shortcode_atts( array(
            'title' => '',
            'text' => '',
        ), $atts ) );

        ob_start();

        global $anps_itable_spacing, $anps_itable_title_color, $anps_itable_text_color, $anps_itable_font_size_title, $anps_itable_font_size_text, $anps_itable_font_weight_title, $anps_itable_font_weight_text;

        $rstyle_title = anps_rstyle(array(
            'padding-bottom' => $anps_itable_spacing,
            'font-size' => $anps_itable_font_size_title,
        ));

        $rstyle_text = anps_rstyle(array(
            'padding-bottom' => $anps_itable_spacing,
            'font-size' => $anps_itable_font_size_text,
        ));


        $style_title = anps_style_attr(array(
            'color' => $anps_itable_title_color,
            'font-weight' => $anps_itable_font_weight_title,
        ));

        $style_text = anps_style_attr(array(
            'color' => $anps_itable_text_color,
            'font-weight' => $anps_itable_font_weight_text,
        ));

        ?>
        <div class="anps-itable-item">
            <div<?php echo $rstyle_title; ?><?php echo $style_title; ?> class="anps-itable-item__title">
                <?php echo esc_html($title); ?>
            </div>
            <div<?php echo $rstyle_text; ?><?php echo $style_text; ?> class="anps-itable-item__text">
                <?php echo esc_html($text); ?>
            </div>
        </div>
        <?php

        return ob_get_clean();
    }
}
add_shortcode('info_table_item', 'anps_info_table_item_func');
