<?php
/* Timeline */
if(!function_exists('anps_timeline_func')) {
    function anps_timeline_func($atts, $content) {
        extract( shortcode_atts( array(
            'style'  => 'style-1',
            'shadow' => '',
            'bg_color' => '',
            'content_bg_color' => '',
            'line_color' => '',
            'dot_color' => '',
            'title_color' => '',
            'text_color' => '',
            'date_color' => '',
        ), $atts ) );

        global $anps_timeline_data_counter,
               $anps_timeline_style,
               $anps_timeline_colors;
        $anps_timeline_data_counter = 0;
        $anps_timeline_style = $style;
        $anps_timeline_colors = array(
            'dot' => $dot_color,
            'content_bg' => $content_bg_color,
            'text' => $text_color,
            'date' => $date_color,
            'title' => $title_color,
        );
        $return = '';

        $class = 'anps-timeline';
        $class .= ' anps-timeline--' . $style;
        if ($shadow === 'true') {
            $class .= ' anps-timeline--shadow';
        }

        $style = anps_style_bg_color($bg_color);
        $style_line = anps_style_bg_color($line_color);

        $return .= '<div' . $style . ' class="' . $class . '">';
            $return .= '<div class="anps-timeline-line"' . $style_line . '></div>';
            $return .= do_shortcode($content);
        $return .= '</div>';
        
        if ($style === 'style-1') {
            $return .= '</div>';
        }

        return $return;
    }
}
/* END Timeline */
/* Timeline Item */
if(!function_exists('anps_timeline_item_func')) {
    function anps_timeline_item_func($atts, $content) {
        extract( shortcode_atts( array(
            'title'    => '',
            'subtitle' => '',
        ), $atts ) );

        global $anps_timeline_colors;

        $style = anps_style_attr(array(
            'background-color' => $anps_timeline_colors['content_bg'],
            'color' => $anps_timeline_colors['text'],
        ));
        $style_dot = anps_style_bg_color($anps_timeline_colors['dot']);
        $style_title = anps_style_color($anps_timeline_colors['title']);
        $style_triangle = anps_style_attr(array(
            'border-left-color' => $anps_timeline_colors['content_bg'],
            'border-right-color' => $anps_timeline_colors['content_bg'],
        ));

        $return = '<div class="anps-timeline__item">';
            $return .= '<div class="anps-timeline__content">';
                $return .= '<div class="anps-timeline__content-inner"' . $style . '>';
                    $return .= '<div class="anps-timeline__subtitle">' . $subtitle . '</div>';
                    $return .= '<h3 class="anps-timeline__title"'. $style_title . '>' . $title . '</h3>';
                    $return .= '<div class="anps-timeline__text">' . $content . '</div>';
                $return .= '</div>';
            $return .= '</div>';
            $return .= '<div class="anps-timeline-triangle"' . $style_triangle . '></div>';
            $return .= '<div class="anps-timeline-dot">';
                $return .= '<div' . $style_dot . ' class="anps-timeline-dot__inner"></div>';
                $return .= '<div' . $style_dot . ' class="anps-timeline-dot__outer"></div>';
            $return .= '</div>';
        $return .= '</div>';
        return $return;
    }
}
/* END Timeline Item */
/* Timeline Date */
if(!function_exists('anps_timeline_date_func')) {
    function anps_timeline_date_func($atts, $content) {
        extract( shortcode_atts( array(
            'text' => ''
        ), $atts ) );

        global $anps_timeline_data_counter, $anps_timeline_style, $anps_timeline_colors;
        $anps_timeline_data_counter++;

        $return = '';

        $style = anps_style_attr(array(
            'background-color' => $anps_timeline_colors['content_bg'],
            'color' => $anps_timeline_colors['date'],
        ));

        if ($anps_timeline_data_counter > 1 && $anps_timeline_style === 'style-1') {
            $return .= '</div>';
        }
        
        if ($anps_timeline_style === 'style-1') {
            $return .= '<div class="anps-timeline__wrap"><div' . $style . ' class="anps-timeline__date">' . $text . '</div>';
        } else {
            $return .= '<span class="anps-timeline-date"><span' . $style . ' class="anps-timeline-date__inner">' . $text . '</span></span>';
        }

        return $return;
    }
}
/* END Timeline Date */
/* Load shortcodes */
if (is_plugin_active('js_composer/js_composer.php') && function_exists('vc_add_shortcode_param')) {
    add_shortcode('timeline', array('WPBakeryShortCode_timeline','anps_timeline_func'));
    add_shortcode('timeline_item', array('WPBakeryShortCode_timeline_item','anps_timeline_item_func'));
    add_shortcode('timeline_date', array('WPBakeryShortCode_timeline_date','anps_timeline_date_func'));
} else {
    add_shortcode('timeline', 'anps_timeline_func');
    add_shortcode('timeline_item', 'anps_timeline_item_func');
    add_shortcode('timeline_date', 'anps_timeline_date_func');
}