<?php
if (!is_active_sidebar('top-bar-left') && !is_active_sidebar('top-bar-right')) {
	return;
}

$top_bar_page_setting = get_post_meta(get_queried_object_id(), $key ='anps_header_options_top_bar', $single = true );

if ($top_bar_page_setting === '1') {
    return;
}

if ($top_bar_page_setting !== '2' && get_option('anps_top_bar_desktop', 'off') === 'off' && get_option('anps_top_bar_mobile', 'off') === 'off') {
    return;
}

$top_bar_class = 'top-bar';

/* Desktop */
if ($top_bar_page_setting === '2' || get_option('anps_top_bar_desktop', 'off') === 'on') {
    $top_bar_class .= ' top-bar--desktop';
}

/* Mobile */
if ($top_bar_page_setting === '2' || get_option('anps_top_bar_mobile', 'off') === 'on') {
    $top_bar_class .= ' top-bar--mobile';
} else if (get_option('anps_top_bar_mobile', 'off') === 'toggle') {
    $top_bar_class .= ' top-bar--toggle';
} else if (get_option('anps_top_bar_mobile', 'off') === 'menu') {
    $top_bar_class .= ' top-bar--menu';
}
?>
<!--actual HTML output:-->
<div class="<?php echo esc_attr($top_bar_class); ?><?php echo anps_header_full_width(); ?>">
    <div class="container">
        <div class="top-bar-row">
            <?php
            if (is_active_sidebar('top-bar-left')) : ?>
                <div class="top-bar-left">
                    <?php do_shortcode(dynamic_sidebar('top-bar-left'));?>
                </div>
            <?php endif;?>
            <?php
            if (is_active_sidebar('top-bar-right')) : ?>
                <div class="top-bar-right">
                    <?php do_shortcode(dynamic_sidebar('top-bar-right'));?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
