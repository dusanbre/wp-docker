<?php
if(!function_exists('anps_button_func')) {
    function anps_button_func($atts, $content) {
        extract( shortcode_atts( array(
            'link'             => '',
            'size'             => '',
            'align'            => '',
            'style_button'     => '',
            'icon_type'        => '',
            'icon_fontawesome' => '',
            'icon_openiconic'  => '',
            'icon_typicons'    => '',
            'icon_entypo'      => '',
            'icon_linecons'    => '',
            'icon_monosocial'  => '',
            'icon_anps_icons'  => '',
            'image'            => '',
            'width'            => '',
            'ajax_load_more'   => '',
        ), $atts ) );

        $btn_wrap_class = 'anps-btn-wrap';
        $btn_wrap_class .= ' anps-btn-wrap--' . $align;

        $btn_class = 'anps-btn';
        $btn_class .= ' anps-btn--' . $size;
        $btn_class .= ' anps-btn--style-' . $style_button;

        $buttons_data = json_decode(stripslashes(get_option('anps-buttons', '[]')));
        $buttons = $buttons_data->buttons;
        $button_type = '';

        foreach($buttons as $button) {
            if ($button->id == $style_button) {
                $button_type = $button->type;
            }
        }

        $btn_class .= ' anps-btn--' . $button_type;

        $rstyle = anps_rstyle(array(
            'width' => $width,
        ));

        $icon_media = '';
        if ($image !== '') {
            $icon_media = '<div class="anps-btn__icon">'.wp_get_attachment_image($image, 'full').'</div>';
        } elseif ($icon_type === 'anps_icons') {
            $svg = anps_svg(str_replace('anps-icon-', '', $icon_anps_icons), ANPS_PLUGIN_URL . 'icons/');
            $icon_media = '<div class="anps-btn__icon">' . $svg . '</div>';
        } else {
            vc_icon_element_fonts_enqueue($icon_type);
            $icon_type_name = 'icon_' . $icon_type;

            if(isset($$icon_type_name) && $$icon_type_name !== '') {
                $icon_media = '<i class="anps-btn__icon ' . $$icon_type_name . '"></i>';
            }
        }

        $return = '';
        
        if(isset($ajax_load_more) && $ajax_load_more != '') {
            $all_posts = wp_count_posts()->publish; 
            $posts_per_page = get_option('posts_per_page');
            $page_number_max = ceil($all_posts / $posts_per_page);
            if($page_number_max > 1) {
                $btn_class .= ' anps-ajax-load';
                $return .= "<button{$rstyle} class='$btn_class'>{$icon_media}{$content}</button>";
            }
        } elseif(!$link) {
            $return .= "<button{$rstyle} class='$btn_class'>{$icon_media}{$content}</button>";
        } else {
            $return .= '<a ' . $rstyle . anps_get_vc_link($link) . ' class="' . $btn_class . '">' . $icon_media . $content . '</a>';
        }

        return '<div class="' . $btn_wrap_class . '">' . $return . '</div>';
    }
}
add_shortcode('button', 'anps_button_func');

/* Add button shortcode to Contact Form 7 */

function anps_button_cf7() {
    wpcf7_add_form_tag( array('button', 'text'), 'anps_button_cf7_handler' );
}
add_action( 'wpcf7_init', 'anps_button_cf7' );
 
function anps_button_cf7_handler( $tag ) {
    return do_shortcode('[button ' . $tag->attr . ']' . $tag->content . '[/button]');
}