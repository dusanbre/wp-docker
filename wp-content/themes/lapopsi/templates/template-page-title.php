<?php if( !is_front_page() ): ?>
<?php
/*
 * 1) check if it is fullscreen
 * 2) check if page img, page video, global img
 */
//header image
$id = get_queried_object_id();
if (function_exists('is_shop') && (is_shop() || is_product())) {
    $id = get_option('woocommerce_shop_page_id'); 
}

$heading_bg_img = get_post_meta($id, $key ='anps_heading_bg', $single = true );
$heading_bg_video = get_post_meta($id, $key ='anps_page_heading_video', $single = true );
$header_img = '';
$header_media_class = '';
$video_container = '';
if(isset($heading_bg_video) && $heading_bg_video != '') {
    $header_media_class = 'page-header-media ';
    $header_img = '';
    /* Image fallback */
    if(isset($heading_bg_img) && $heading_bg_img != '') {
        $header_img =  "background-image: url(".get_post_meta($id, $key ='anps_heading_bg', $single = true ).");";
    }
    /* Video */
    $video_container = "<div class='page-header-video'>".anps_heading_video($heading_bg_video)."</div>";
} elseif(isset($heading_bg_img) && $heading_bg_img != '') {
    $header_media_class = 'page-header-media ';
    $header_img =  "background-image: url(".get_post_meta($id, $key ='anps_heading_bg', $single = true ).");";
}  elseif(get_option('anps_page_heading_bg', '')!='') {
    $header_media_class = 'page-header-media ';
    $header_img = "background-image: url(".get_option('anps_page_heading_bg', '').");";
}

$full_screen = get_post_meta($id, $key ='anps_page_heading_full', $single = true );
$full_screen = str_replace('on', 'large', $full_screen);

if ($full_screen === '') {
    $full_screen = get_option('anps_page_header_style', 'normal');
}

$header_class = 'page-header-sm';

if($full_screen == 'large') {
    $header_class = 'page-header-lg';
    $header_class .= ' page-header-' . get_option('anps_page_header_lg_divider', 'border');
} else {
    $header_class .= ' page-header-' . get_option('anps_page_header_divider', 'border');
}

/* Is hidden on page */
$is_hidden = get_post_meta($id, $key ='anps_disable_heading', $single = true ); 
?>
<?php if( get_option('anps_heading_status', '1') == '1' && $is_hidden != '1' ): ?>
<div class="<?php echo esc_attr($header_media_class); ?>page-header <?php echo esc_attr($header_class); ?>" style="<?php echo esc_attr($header_img); ?>">
    <div class="container"><h1 class="page-title">
        <?php anps_page_title(); ?></h1>

        <?php if (is_single() && get_post_type() === 'post'): ?>
            <?php echo anps_post_meta('single', $id); ?>
        <?php endif; ?>
    </div>
    <?php echo wp_kses($video_container, array(
        'div' => array(
            'class' => array()
        ),
        'iframe' => array(
            'id' => array(),
            'src' => array(),
            'width' => array(),
            'height' => array(),
            'frameborder' => array(),
            'webkitallowfullscreen' => array(),
            'mozallowfullscreen' => array(),
            'allowfullscreen' => array(),
        ),
        'video' => array(
            'src' => array()
        )
    )); ?>
</div>
<?php endif; ?>
<?php endif;
