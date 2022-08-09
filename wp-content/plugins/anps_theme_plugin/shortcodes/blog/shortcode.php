<?php
if(!function_exists('anps_blog_func')) {
    function anps_blog_func($atts, $content) {
        extract( shortcode_atts( array(
            'category' => '',
            'orderby' => '',
            'order' => '',
            'columns' => '1',
            'layout' => 'default',
            'image_size' => 'img-cover',
            'post_style' => 'style-1',
            'shadow' => '',
            'hide_content' => '',
            'hide_pagination' => '',
            'bg_color' => '',
            'link_icon_color' => '',
            'link_icon_bg_color' => '',
            'link_text_color' => '',
            'per_page' => '',
            'ajax_load_more' => '',
        ), $atts ) );
        global $wp_rewrite;

        $ajax_class = '';
        if(isset($ajax_load_more) && $ajax_load_more != '') {
            $ajax_class = ' anps-ajax-blog';
        }

        if(get_query_var('paged') > 1) {
            $current = get_query_var('paged');
        } elseif(get_query_var('page') > 1) {
            $current = get_query_var('page');
        } else {
            $current = 1;
        }
        $args = array(
            'posts_per_page' => $per_page,
            'cat'            => $category,
            'orderby'        => $orderby,
            'order'          => $order,
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'paged'          => $current
        );

        $posts = new WP_Query( $args );

        $pagination = array(
            'base' => @esc_url(add_query_arg('page','%#%')),
            'format' => '',
            'total' => $posts->max_num_pages,
            'current' => $current,
            'show_all' => false,
            'prev_text' => '<i class="fa fa-angle-left"></i> ' . esc_html__( 'Previous ', 'anps_theme_plugin' ),
            'next_text' => esc_html__( 'Next', 'anps_theme_plugin' ) . ' <i class="fa fa-angle-right"></i>',
            'type' => 'list',
        );

        $post_text = "";
        if($posts->have_posts()) :
            $post_text .= "<div class='row anps-blog$ajax_class'>";
            global $counter_blog;
            $counter_blog = 1;
            while($posts->have_posts()) :
                $posts->the_post();
                set_query_var('layout', $layout);
                set_query_var('image_size', $image_size);
                set_query_var('hide_content', $hide_content);
                set_query_var('post_style', $post_style);
                set_query_var('shadow', $shadow);
                set_query_var('columns', $columns);
                set_query_var('bg_color', $bg_color);
                set_query_var('link_icon_color', $link_icon_color);
                set_query_var('link_icon_bg_color', $link_icon_bg_color);
                set_query_var('link_text_color', $link_text_color);
                ob_start();
                get_template_part('templates/content-blog');
                $counter_blog++;
                $post_text .= ob_get_clean();
            endwhile;
            if( $wp_rewrite->using_permalinks() ) {
                $pagination['base'] = user_trailingslashit( trailingslashit( esc_url(remove_query_arg('s',get_pagenum_link(1)) ) ) . 'page/%#%/', 'paged');
            }
            if( !empty($wp_query->query_vars['s']) ) {
                $pagination['add_args'] = array('s'=>get_query_var('s'));
            }
            $post_text .= "</div>";
            if ($hide_pagination !== 'true') {
                $post_text .= paginate_links( $pagination );
            }
            wp_reset_postdata();
        else :
            $post_text .= "<h2>".esc_html__('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'anps_theme_plugin')."</h2>";
        endif;
        return $post_text;
    }
}
add_shortcode('blog', 'anps_blog_func');
