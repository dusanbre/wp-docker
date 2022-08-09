<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
$atts['content'] = $this->getTemplateVariable( 'content' );
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();

echo '<div class="' . esc_attr( $this->getElementClasses() ) . '"';
echo ' id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';
echo ' data-vc-content=".vc_tta-panel-body">';
echo '<div class="vc_tta-panel-heading">' . $this->getTemplateVariable( 'heading' ) . '</div>';
echo '<div class="vc_tta-panel-body">' . $this->getTemplateVariable( 'content' );
if ( $isPageEditable ) {
	echo '<div data-js-panel-body>' . $this->getTemplateVariable( 'content' ); // fix for fe - shortcodes container, not required in b.e.
}
if ( $isPageEditable ) {
	echo '</div>';
}
echo '</div>';
echo '</div>';
