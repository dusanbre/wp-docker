<?php
    /* Load default and Theme Option settings */

    $bg_color = isset($bg_color) ? $bg_color : '';
    $link_icon_color = isset($link_icon_color) ? $link_icon_color : '';
    $link_icon_bg_color = isset($link_icon_bg_color) ? $link_icon_bg_color : '';
    $link_text_color = isset($link_text_color) ? $link_text_color : '';

    if (!isset($columns)) {
        $columns = get_option('anps_blog_columns', '1');
    }

    if (!isset($shadow)) {
        $shadow = get_option('anps_blog_shadow', '1');
    }

    if (!isset($layout)) {
        $layout = get_option('anps_blog_layout', 'default');
    }

    if (!isset($image_size)) {
        $image_size = get_option('anps_blog_image_size', 'img-cover');
    }

    if (!isset($post_style)) {
        $post_style = get_option('anps_post_style', 'style-1');
    }

    if (!isset($hide_content)) {
        $hide_content = get_option('anps_hide_content', '');
    }

    $style = anps_style_attr(array(
        'background-color' => $bg_color,
    ));

    $class_name = array();
    if ($bg_color !== '') {
        $class_name[] = 'post--has-bg';
    }
    if ($shadow === 'true' || $shadow === '1') {
        $class_name[] = 'post--shadow';
    }
    if ($bg_color === '' && $shadow !== 'true' && $shadow !== '1') {
        $class_name[] = 'post--no-padding';
    } else {
        $class_name[] = 'post--padding';
    }
    $class_name[] = "post--{$layout}";
    $class_name[] = "post--{$post_style}";
    if ($layout === 'img-left' || $layout === 'img-right') {
        $class_name[] = "post--{$image_size}";
    }
    if(isset($ajax_load_more) && $ajax_load_more == '1') {
        $class_name[] = "post";
    }

    $image_wp_size = 'large';

    if ($columns > 1) {
        $image_wp_size = 'anps-blog';
    }

    $link_icon_style = array(
        'width'            => '38px',
        'height'           => '38px',
        'background-color' => $link_icon_bg_color,
    );
?>

<div class="col-md-<?php echo (12/esc_attr($columns)); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class($class_name); ?><?php echo strip_tags($style); ?>>
        <?php if(has_post_thumbnail()): ?>    
        <div class="post__img">
            <?php anps_header_media(get_the_id(), $image_wp_size); ?>
        </div>
        <?php endif; ?>
        <div class="post__wrap">
            <header class="post__header entry-header">
                <?php if(is_sticky()): ?>
                    <div class="post__featured"><?php esc_html_e('Featured', 'lapopsi'); ?></div>
                <?php endif; ?>
                <a class="post__title entry-title" href="<?php the_permalink(); ?>">
                    <h3 class="post__title-inner"><?php the_title(); ?></h3>
                </a>
                <?php if ($post_style === 'style-1'): ?>
                <?php echo anps_post_meta(); ?>
                <?php endif; ?>
            </header>
            <div class="post__content entry-content">
                <?php if ($hide_content !== 'true'): ?>
                <div class="post__desc">
                    <?php if (get_option("rss_use_excerpt") == "0") {
                        the_content();
                    } else {
                        the_excerpt();
                    }
                    ?>
                </div>
                <?php endif; ?>
                <?php if ($post_style === 'style-1'): ?>
                <a class="anps-link" href="<?php the_permalink(); ?>">
                    <span
                        data-rstyle="width:|||38;height:|||38;"
                        class="anps-link__icon-wrap"
                        <?php echo anps_style_attr($link_icon_style); ?>
                    >
                        <i <?php echo anps_style_color($link_icon_color); ?> class="anps-link__icon fa fa-angle-right"></i>
                    </span>
                    <span class="anps-link__text" <?php echo anps_style_color($link_text_color); ?>>
                        <?php esc_html_e('Read More', 'lapopsi'); ?>
                    </span>
                </a>
                <?php endif; ?>

                <?php if ($post_style === 'style-2'): ?>
                <?php echo anps_post_meta(); ?>
                <?php endif; ?>
            </div>
        </div>
    </article>
</div>
