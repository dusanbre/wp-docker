<?php
if(!function_exists('anps_recent_blog_func')) {
    function anps_recent_blog_func($atts, $content) {
        extract( shortcode_atts( array(
            'recent_title' => "",
            'number' => '',
            'number_in_row' => "3",
            'slider' => '1',
            'content_length' => '130',
            'cat_ids' => '',
            'show_meta' => 'true',
            'slider_nav' => 'true',
            'link_color' => '',
            'link_icon_color' => '',
            'text_color' => '',
            'title_color' => '',
            'link_icon_bg_color' => '',
            'hide_title' => '',
            'hide_content' => '',
            'hide_content_button' => '',
        ), $atts ) );

        $args = array(
            'posts_per_page'   => $number,
            'cat'              => $cat_ids,
            'orderby'          => "date",
            'order'            => "DESC",
            'post_type'        => 'post',
            'post_status'      => 'publish',
        );
        $posts = new WP_Query($args);

        $recent_post_text = '';
        $post_class = 'post anps-recent-article';

        if($posts->have_posts()) {
            $recent_post_text .= '<div data-nav="' . $slider_nav . '" data-link-color="' . $link_color . '" data-columns="' . $number_in_row . '" class="anps-recent-news">';

            if ($slider === '1') {
                $recent_post_text .= '<div class="owl-carousel">';
            } else {
                $post_class .= ' col-md-' . (12 / $number_in_row);
            }

            $style = anps_style_attr(array(
                'color' => $text_color,
                '--anps-text-color' => $link_color,
            ));
            $style_title = anps_style_color($title_color);

            while($posts->have_posts()) {
                $posts->the_post();
                $recent_post_text .= "<article class='{$post_class}'{$style}>";
                if(get_the_post_thumbnail(get_the_ID())!="") {
                    $recent_post_text .= "<header class='anps-recent-article__header'>";
                        $recent_post_text .= '<a class="anps-recent-article__link" href="' . get_the_permalink() . '">';
                            $recent_post_text .= get_the_post_thumbnail(get_the_ID(), 'post-thumb');
                            $recent_post_text .= '<div class="anps-recent-article__icon"><i class="fa fa-link"></i></div>';
                        $recent_post_text .= '</a>';
                    $recent_post_text .= "</header>";
                }
                if($hide_title !== 'true') {
                    $recent_post_text .= "<a{$style_title} class='anps-recent-article__title' href='".get_permalink()."'><h3>".get_the_title()."</h3></a>";
                }
                if ($show_meta) {
                    $recent_post_text .= anps_post_meta();
                }
                if($hide_content !== 'true') {
                    $recent_post_text .= '<div class="anps-recent-article__text">';
                    ob_start();
                    the_excerpt();
                    $excerpt = ob_get_clean();
                    $recent_post_text .= mb_substr($excerpt, 0, $content_length);
                    if($hide_content_button !== 'true') {
                        $recent_post_text .= do_shortcode('[anps_link icon_color="' . $link_icon_color . '" icon_bg_color="' . $link_icon_bg_color . '" text_color="' . $link_color . '" icon_type="fontawesome" icon_fontawesome="fa fa-angle-right" icon_container="true" icon_container_size="|||38" text="' . esc_html__( 'Read More', 'anps_theme_plugin' ) . '" link="url:' . urlencode(get_the_permalink()) . '|||"][/anps_link]');
                    }
                    $recent_post_text .= '</div>';
                }
                $recent_post_text .= "</article>";
            }

            if ($slider === '1') {
                $recent_post_text .= '</div>';
            }
        }
        wp_reset_postdata();

        $recent_post_text .= '</div>';

        return $recent_post_text;
    }
}
add_shortcode('recent_blog', 'anps_recent_blog_func');
