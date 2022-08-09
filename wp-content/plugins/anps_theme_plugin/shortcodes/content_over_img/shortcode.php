<?php
/* Content over image */
if(!function_exists('anps_content_over_img_func')) {
    function anps_content_over_img_func( $atts,  $content ) {
        extract( shortcode_atts( array(
            'image_location' => 'left',
            'image' => ''
        ), $atts ) );
        if($image) {
            $image_b = wp_get_attachment_image_src($image, 'full');
            $image_b = $image_b[0];
        }
        
        $data = '';
        $data .= "<div class='anps-content-over anps-content-over--{$image_location}'>";
            $data .= "<div style='background-image: url({$image_b});' class='anps-content-over__img'></div>";
            $data .= "<div class='container'><div class='anps-content-over__main'>".do_shortcode($content)."</div></div>";
        $data .= "</div>";
        return $data;
    }
}
add_shortcode('content_over_img', 'anps_content_over_img_func');
