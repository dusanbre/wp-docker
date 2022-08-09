<?php
if (!defined('ABSPATH')) {
	die('-1');
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $el_id = $css = $css_animation = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$class_to_filter = 'wpb_text_column wpb_content_element ' . $this->getCSSAnimation($css_animation);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$wrapper_attributes = array();

//Icon settings
if ($icon_type == 'fontawesome') {
	$font_icon = $icon_fontawesome;
} elseif ($icon_type == 'openiconic') {
	$font_icon = $icon_openiconic;
} elseif ($icon_type == 'typicons') {
	$font_icon = $icon_typicons;
} elseif ($icon_type == 'entypo') {
	$font_icon = $icon_entypo;
} elseif ($icon_type == 'linecons') {
	$font_icon = $icon_linecons;
} elseif ($icon_type == 'monosocial') {
	$font_icon = $icon_monosocial;
}

$font_size_default = '16';
if ($font_size != '') {
	$font_size_default = $font_size;
}

$line_height_default = '1.4';
if ($line_height != '') {
	$line_height_default = $line_height;
}

$padding_icon_text_default = '10';
if ($padding_icon_text != '') {
	$padding_icon_text_default = $padding_icon_text;
}

$padding_li_bottom_default = '15';
if ($padding_li_bottom != '') {
	$padding_li_bottom_default = $padding_li_bottom;
}

$font_i = '';
$ul_class = 'anps-list-default';
if ($font_icon != '') {
	$ul_class = 'anps-list';
	$font_i = '<i class="' . $font_icon . '" style="color: ' . $icon_color . '; font-size: ' . $font_size_default . 'px;"></i> ';
}

$content = str_replace(array('<ul>', '<li>'), array('<ul class="' . $ul_class . '" style="line-height:' . $line_height_default . 'em">', '<li style="padding-top:' . $padding_li_top . 'px; padding-left: ' . ($font_size_default + $padding_icon_text_default) . 'px; padding-bottom:' . $padding_li_bottom_default . 'px">' . $font_i), $content);

if (!empty($el_id)) {
	$wrapper_attributes[] = 'id="' . esc_attr($el_id) . '"';
}
$output = '
	<div class="' . esc_attr($css_class) . '" ' . implode(' ', $wrapper_attributes) . '>
		<div class="wpb_wrapper">
			' . wpb_js_remove_wpautop($content, true) . '
		</div>
	</div>
';

$allowed_tags = wp_kses_allowed_html('post');
echo wp_kses($output, $allowed_tags);
