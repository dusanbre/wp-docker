<?php
if(!function_exists('anps_team_func')) {
    function anps_team_func($atts, $content) {
        extract(shortcode_atts(array(
            'columns' => '',
            'layout_type' => '',
            'filter' => '',
            'orderby' => '',
            'order' => '',
            'image_type' => '',
            'background_color' => '',
            'title_color' => '',
            'name_color' => '',
            'shadow' => '',
        ), $atts));

        $style = anps_style_attr(array(
            'background-color' => $background_color,
        ));

        $style_name = anps_style_attr(array(
            'color' => $name_color,
        ));

        $style_title = anps_style_attr(array(
            'color' => $title_color,
        ));
        
        $args = array(
            'post_type' => 'team',
            'showposts' => -1,
            'orderby'   => $orderby,
            'order'     => $order,
        );
        
        if ($filter !== '') {
            $args['post__in'] = explode(',', $filter);
        }
        
        $class_name = 'anps-team';
        $class_name .= ' anps-team--img-' . $image_type;
        $class_name .= ' anps-team--col-' . $columns;
        $class_name .= ' anps-team--' . $layout_type;
        $class_name .= $shadow === 'true' ? ' anps-team--shadow' : '';
        $return = '';
        $return .= "<div class='{$class_name}'>";
        
        if ($layout_type === 'carousel') {
            $return .= '<div class="owl-carousel" data-col="' . $columns . '">';
        }

        $posts = new WP_Query($args);
        while($posts->have_posts()) {
            $posts->the_post();

            $return .= anps_get_member(array(
                'style' => $style,
                'style_name' => $style_name,
                'style_title' => $style_title,
            ));
        }
        wp_reset_postdata();

        if ($layout_type === 'carousel') {
            $return .= '</div>';
        }
            
        $return .= '</div>';

        return $return;
    }
}
add_shortcode('team', 'anps_team_func');

function anps_get_member($options) {
    $default = array(
        'style' => '',
        'style_name' => '',
        'style_title' => '',
        'show_excerpt' => false,
    );

    $options = array_merge($default, $options);

    $social_accounts = explode('|', get_post_meta(get_the_ID(), $key = 'anps_team_social', $single = true));
    $subtitle = get_post_meta(get_the_ID(), $key = 'anps_team_subtitle', $single = true);

    $return = '';

    $return .= "<div class='anps-team__col'>";
        $return .= '<div class="anps-member"' . $options['style'] . '>';
            $return .= '<div class="anps-member__header">';
                /* Image */
                if (isset($options['single']) && $options['single']) {
                    $return .= '<div class="anps-member__img">';
                } else {
                    $return .= '<a href="' . get_the_permalink() . '" class="anps-member__img">';
                }
                $return .= get_the_post_thumbnail(get_the_ID(), 'anps-team');
                if (isset($options['single']) && $options['single']) {
                    $return .= '</div>';
                } else {
                    $return .= '</a>';
                }

                /* Social */
                if ($social_accounts !== '') {
                    $social_class = 'anps-member-social';

                    if (count($social_accounts) === 1) {
                        $social_class .= ' anps-member-social--single';
                    } else {
                        $social_class .= ' anps-member-social--multiple';
                    }

                    $return .= "<ul class='{$social_class}'>";
                        foreach($social_accounts as $social) {
                            $social = explode(';', $social);

                            if ($social[0] !== '' && $social[1] !== '') {
                                $style_social = anps_style_attr(array(
                                    'background-color' => isset($social[2]) ? $social[2]: '',
                                ));

                                $return .= '<li class="anps-member-social__item">';
                                    $return .= '<a' . $style_social . ' class="anps-member-social__link" target="_blank" href="' . $social[1] . '">';
                                        $return .= '<i class="fa ' . $social[0] . '"></i>';
                                    $return .= '</a>';
                                $return .= '</li>';
                            }
                        }
                    $return .= '</ul>';
                }
            $return .= '</div>';

            if (isset($options['single']) && $options['single']) {
                $return .= '<div class="anps-member__content">';
            } else {
                $return .= '<a href="' . get_the_permalink() . '" class="anps-member__content">';
            }
            /* Name */
            $return .= '<div' . $options['style_name'] . ' class="anps-member__name">' . get_the_title() . '</div>';
            
            /* Title */
            if ($subtitle !== '') {
                $return .= '<div' . $options['style_title'] . ' class="anps-member__title">' . $subtitle . '</div>';
            }

            if ($options['show_excerpt']) {
                $return .= '<div class="anps-member__excerpt">' . get_the_excerpt() . '</div>';
            }
            if (isset($options['single']) && $options['single']) {
                $return .= '</div>';
            } else {
                $return .= '</a>';
            }
        $return .= '</div>';
    $return .= '</div>';

    return $return;
}
