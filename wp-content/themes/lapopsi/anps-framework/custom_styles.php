<?php
function anps_custom_styles_font_family()
{
  /* Font Default Values */
  $font_1 = "Montserrat";
  $font_2 = 'Nunito';
  $font_3 = "Montserrat";

  /* logo font */

  $logo_font_explode = urldecode(get_option('anps_text_logo_font'));
  $logo_font_e = explode('|', $logo_font_explode);

  $logo_font = $logo_font_e[0];

  if (get_option('anps_text_logo_source_1') == 'Custom fonts') {
    anps_custom_font($logo_font);
  }

  /* Font 1 */
  if (
    get_option('font_source_1') == 'System fonts' ||
    get_option('font_source_1') == 'Custom fonts' ||
    get_option('font_source_1') == 'Google fonts'
  ) {

    $font_1 = urldecode(get_option('font_type_1'));
  }

  if (get_option('font_source_1') == 'Custom fonts') {
    anps_custom_font($font_1);
  }

  /* Font 2 */
  if (
    get_option('font_source_2') == 'System fonts' ||
    get_option('font_source_2') == 'Custom fonts' ||
    get_option('font_source_2') == 'Google fonts'
  ) {

    $font_2 = urldecode(get_option('font_type_2'));
  }

  if (get_option('font_source_2') == 'Custom fonts') {
    anps_custom_font($font_2);
  }

  /* Font 3 (navigation) */
  if (
    get_option('font_source_navigation') == 'System fonts' ||
    get_option('font_source_navigation') == 'Custom fonts' ||
    get_option('font_source_navigation') == 'Google fonts'
  ) {

    $font_3 = urldecode(get_option('font_type_navigation'));
  }

  if (get_option('font_source_navigation') == 'Custom fonts') {
    anps_custom_font($font_3);
  }

  /* logo font */
?>
  .logo .logo-wrap {
  font-family: <?php echo anps_wrap_font(esc_attr($logo_font)); ?>;
  }

  <?php
  /* Font 1 */
  ?>
  .featured-title,
  .quantity .quantity-field,
  .cart_totals th,
  .rev_slider,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  .h5,
  .title.h5,
  table.table > tbody th,
  table.table > thead th,
  table.table > tfoot th,
  .search-notice-label,
  .filter-dark button,
  .filter:not(.filter-dark) button,
  .orderform .quantity-field,
  .product-top-meta,
  .onsale,
  .page-header .page-title,
  *:not(.widget) > .download,
  .btn,
  .button,
  .contact-number,
  .site-footer .widget_recent_entries a,
  .font1 {
  font-family: <?php echo anps_wrap_font(esc_attr($font_1)); ?>;
  <?php if ($font_1 === 'Montserrat') : ?>
    font-weight: 500;
  <?php endif; ?>
  }

  .breadcrumb {
  font-family: <?php echo anps_wrap_font(esc_attr($font_1)); ?>;
  }

  <?php
  /* Font 2 */
  ?>

  .btn.btn-xs,
  body,
  .alert,
  div.wpcf7-mail-sent-ng,
  div.wpcf7-validation-errors,
  .search-result-title,
  .contact-form .form-group label,
  .contact-form .form-group .wpcf7-not-valid-tip,
  .wpcf7 .form-group label,
  .wpcf7 .form-group .wpcf7-not-valid-tip,
  .heading-subtitle,
  .top-bar-style-2,
  .large-above-menu.style-2 .widget_anpstext {
  font-family: <?php echo anps_wrap_font(esc_attr($font_2)); ?>;
  }

  <?php
  /* Font 3 (Navigation Font) */
  ?>

  nav.site-navigation ul li a,
  .menu-button,
  .megamenu-title {
  font-family: <?php echo anps_wrap_font(esc_attr($font_3)); ?>;

  <?php if ($font_1 === 'Montserrat') : ?>
    font-weight: 500;
  <?php endif; ?>
  }

  @media (max-width: 1199px) {
  .site-navigation .main-menu li a {
  font-family: <?php echo anps_wrap_font(esc_attr($font_3)); ?>;

  <?php if ($font_1 === 'Montserrat') : ?>
    font-weight: 500;
  <?php endif; ?>
  }
  }
<?php
}
function anps_custom_styles_colors()
{
  /* Main colors */
  $anps_text_color = get_option('anps_text_color', '878a9d');
  $anps_primary_color = get_option('anps_primary_color', '383e48');
  $anps_secondary_color = get_option('anps_secondary_color', 'd7f4fe');
  $anps_hovers_color = get_option('anps_hovers_color', '1d2128');
  $anps_headings_color = get_option('anps_headings_color', '383e48');

  /* Footer colors */
  $anps_footer_bg_color = get_option('anps_footer_bg_color', 'ffffff');
  $anps_footer_text_color = get_option('anps_footer_text_color', '9294a3');
  $anps_footer_divider_color = get_option('anps_footer_divider_color', 'ebf2f6');
  $anps_footer_border_color = get_option('anps_footer_border_color', 'ebf2f6');
  $anps_footer_heading_text_color = get_option('anps_footer_heading_text_color', '383e48');
  $anps_c_footer_text_color = get_option('anps_c_footer_text_color', '9294a3');
  $anps_c_footer_bg_color = get_option('anps_c_footer_bg_color', 'fcfcfc');

  /*
		CONDITIONAL COLORS
	*/

  /* Container size */

  $container_size = get_option('anps_container_width', '1300');
?>

  @media (min-width: <?php echo esc_html($container_size) * 1 + 30; ?>px) {
  .container,
  .boxed .site,
  .boxed .site-footer {
  width: <?php echo esc_html($container_size); ?>px;
  }
  }

  <?php
  /* CSS variables */
  $css_variables = anps_style_options();
  ?>

  html {
  <?php
  foreach ($css_variables as $name => $value) {
    if (anps_is_empty_style($value)) {
      echo "--{$name}: {$value};";
    }
  }
  ?>
  }

  <?php
  /* Text Color */
  ?>
  .select2-container .select2-choice,
  .select2-container .select2-choice > .select2-chosen,
  .select2-results li,
  .widget_rss .widget-title:hover,
  .widget_rss .widget-title:focus,
  .sidebar a,
  body,
  #lang_sel a.lang_sel_sel,
  .search-notice-field,
  .product_meta .posted_in a,
  .product_meta > span > span,
  .price del,
  .social.social-transparent-border a,
  .social.social-border a,
  .top-bar .social a,
  .site-main .social.social-minimal a:hover,
  .site-main .social.social-minimal a:focus,
  .info-table-content strong,
  .site-footer .download-icon,
  .mini-cart-list .empty,
  .mini-cart-content,
  ol.list span,
  .product_list_widget del,
  .product_list_widget del .amount,
  .anps-member__title,
  .post-tags a,
  .comment-reply-link,
  .comment-edit-link,
  .comment-edit-link::before {
  color: #<?php echo esc_attr($anps_text_color); ?>;
  }

  <?php
  /* Primary Color */
  ?>

  aside .widget_shopping_cart_content .buttons a,
  .site-footer .widget_shopping_cart_content .buttons a,
  .demo_store_wrapper,
  .mini-cart-content .buttons a,
  .widget_calendar caption,
  .widget_calendar a,
  .bg-primary,
  mark,
  .onsale,
  .nav-links > *:not(.dots):hover,
  .nav-links > *:not(.dots):focus,
  .nav-links > *:not(.dots).current,
  ul.page-numbers > li > *:hover,
  ul.page-numbers > li > *:focus,
  ul.page-numbers > li > *.current,
  .sidebar .download a,
  aside .widget_price_filter .price_slider_amount button.button,
  .site-footer .widget_price_filter .price_slider_amount button.button,
  aside .widget_price_filter .ui-slider .ui-slider-range,
  .site-footer .widget_price_filter .ui-slider .ui-slider-range,
  article.post.sticky .post-title:before,
  article.post.sticky .post-meta:before,
  article.post.sticky .post-content:before,
  table.table > tbody.bg-primary tr,
  table.table > tbody tr.bg-primary,
  table.table > thead.bg-primary tr,
  table.table > thead tr.bg-primary,
  table.table > tfoot.bg-primary tr,
  table.table > tfoot tr.bg-primary,
  .pika-prev, .pika-next,
  .owl-nav button,
  .featured-has-icon .featured-title:before,
  .woocommerce-product-gallery__trigger {
  background-color: #<?php echo esc_attr($anps_primary_color); ?>;
  }

  ::-moz-selection {
  background-color: #<?php echo esc_attr($anps_primary_color); ?>;
  }

  ::selection {
  background-color: #<?php echo esc_attr($anps_primary_color); ?>;
  }

  aside .widget_price_filter .price_slider_amount .from,
  aside .widget_price_filter .price_slider_amount .to,
  .site-footer .widget_price_filter .price_slider_amount .from,
  .site-footer .widget_price_filter .price_slider_amount .to,
  .mini-cart-content .total .amount,
  .widget_calendar #today,
  .widget_rss ul .rsswidget,
  b,
  a,
  .megamenu-title,
  header a:focus,
  nav.site-navigation ul li a:hover,
  nav.site-navigation ul li a:focus,
  nav.site-navigation ul li a:active,
  .counter-wrap .title,
  .vc_gitem_row .vc_gitem-col.anps-grid .vc_gitem-post-data-source-post_date > div:before,
  .vc_gitem_row .vc_gitem-col.anps-grid-mansonry .vc_gitem-post-data-source-post_date > div:before,
  ul.testimonial-wrap .rating,
  .projects-item .project-title,
  .filter-dark button.selected,
  .filter:not(.filter-dark) button:focus,
  .filter:not(.filter-dark) button.selected,
  .product_meta .posted_in a:hover,
  .product_meta .posted_in a:focus,
  .post-info td a:hover,
  .post-info td a:focus,
  .post-meta i,
  .stars a:hover,
  .stars a:focus,
  .stars,
  .star-rating,
  .social.social-transparent-border a:hover,
  .social.social-transparent-border a:focus,
  .social.social-border a:hover,
  .social.social-border a:focus,
  .list li:before,
  .info-table-icon,
  .icon-media,
  .site-footer .download a:hover,
  .site-footer .download a:focus,
  .comment-date i,
  [itemprop="datePublished"]:before,
  .breadcrumb a:hover,
  .breadcrumb a:focus,
  .panel-heading a.collapsed:hover,
  .panel-heading a.collapsed:focus,
  ol.list,
  .product_list_widget .amount,
  .product_list_widget ins,
  ul.testimonial-wrap .user-data .name-user,
  .wpcf7-form-control-wrap[class*="date-"]:after,
  .copyright-footer a,
  .contact-info i,
  .featured-has-icon.simple-style .featured-title i,
  a.featured-lightbox-link,
  .jobtitle,
  .site-footer .widget_recent_entries .post-date:before,
  .site-footer .social.social-minimal a:hover,
  .site-footer .social.social-minimal a:focus,
  .heading-middle span:before,
  .heading-left span:before,
  .anps-info-it-wrap,
  .anps-info-icons-wrap,
  .testimonials-style-3 .testimonials-wrap .name-user,
  .testimonials-style-3 .testimonials-wrap .content p::before,
  aside.sidebar .widget_nav_menu .current-menu-item > a {
  color: #<?php echo esc_attr($anps_primary_color); ?>;
  }

  @media (min-width: 768px) {
  .featured-has-icon:hover .featured-title i,
  .featured-has-icon:focus .featured-title i {
  color: #<?php echo esc_attr($anps_primary_color); ?>;
  }
  }

  a.featured-lightbox-link svg {
  fill: #<?php echo esc_attr($anps_primary_color); ?>;
  }

  nav.site-navigation .current-menu-item > a {
  color: #<?php echo esc_attr($anps_primary_color); ?> !important;
  }

  .gallery-fs .owl-item a:hover:after,
  .gallery-fs .owl-item a:focus:after,
  .gallery-fs .owl-item a.selected:after,
  blockquote:not([class]) p,
  .blockquote-style-1 p,
  .blockquote-style-2 p,
  .featured-content,
  .post-minimal-wrap {
  border-color: #<?php echo esc_attr($anps_primary_color); ?>;
  }

  <?php
  /* Hovers Color */
  ?>
  aside .widget_shopping_cart_content .buttons a:hover,
  aside .widget_shopping_cart_content .buttons a:focus,
  .site-footer .widget_shopping_cart_content .buttons a:hover,
  .site-footer .widget_shopping_cart_content .buttons a:focus,
  .mini-cart-content .buttons a:hover,
  .mini-cart-content .buttons a:focus,
  .widget_calendar a:hover,
  .widget_calendar a:focus,
  .sidebar .download a:hover,
  .sidebar .download a:focus,
  .site-footer .widget_price_filter .price_slider_amount button.button:hover,
  .site-footer .widget_price_filter .price_slider_amount button.button:focus,
  .owl-nav button:hover, .owl-nav button:focus,
  .woocommerce-product-gallery__trigger:hover,
  .woocommerce-product-gallery__trigger:focus {
  background-color: #<?php echo esc_attr($anps_hovers_color); ?>;
  }

  .sidebar a:hover,
  .sidebar a:focus,
  a:hover,
  a:focus,
  .copyright-footer a:hover,
  .copyright-footer a:focus {
  color: #<?php echo esc_attr($anps_hovers_color); ?>;
  }

  .form-group input:not([type="submit"]):hover,
  .form-group input:not([type="submit"]):focus,
  .form-group textarea:hover,
  .form-group textarea:focus,
  .wpcf7 input:not([type="submit"]):hover,
  .wpcf7 input:not([type="submit"]):focus,
  .wpcf7 textarea:hover,
  .wpcf7 textarea:focus,
  input,
  .input-text:hover,
  .input-text:focus {
  outline-color: #<?php echo esc_attr($anps_hovers_color); ?>;
  }

  .scrollup a:hover {
  border-color: #<?php echo esc_attr($anps_hovers_color); ?>;
  }

  <?php
  /* Headings Color */
  ?>
  .featured-title,
  .woocommerce form label,
  .mini-cart-content .total,
  .quantity .minus:hover,
  .quantity .minus:focus,
  .quantity .plus:hover,
  .quantity .plus:focus,
  .cart_totals th,
  .cart_totals .order-total,
  .widget_rss ul .rss-date,
  .widget_rss ul cite,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  .h5,
  .title.h5,
  em,
  .dropcap,
  table.table > tbody th,
  table.table > thead th,
  table.table > tfoot th,
  .orderform .minus:hover,
  .orderform .minus:focus,
  .orderform .plus:hover,
  .orderform .plus:focus,
  .product-top-meta .price,
  .post-info th,
  .post-author-title strong,
  .site-main .social.social-minimal a,
  .info-table-content,
  .comment-author,
  [itemprop="author"],
  .breadcrumb a,
  aside .mini-cart-list + p.total > strong,
  .site-footer .mini-cart-list + p.total > strong,
  .mini-cart-list .remove,
  .anps-member__name,
  .post__title,
  .post-tags__title,
  .post-author__title strong,
  .comment-meta__author {
  color: #<?php echo esc_attr($anps_headings_color); ?>;
  }
  .mini_cart_item_title {
  color: #<?php echo esc_attr($anps_headings_color); ?> !important;
  }
  <?php
  /* Footer Background  Color */
  ?>
  .site-footer {
  background-color: #<?php echo esc_attr($anps_footer_bg_color); ?>;
  }
  <?php
  /* Footer Text Color */
  ?>
  .site-footer {
  color: #<?php echo esc_attr($anps_footer_text_color); ?>;
  }
  <?php
  /* Footer Divider Color */
  ?>
  .site-footer__main {
  border-top-color: #<?php echo esc_attr($anps_footer_divider_color); ?>;
  }
  <?php
  /* Footer Border Color */
  ?>
  .site-footer .widget_calendar table,
  .site-footer .widget_calendar table td,
  .site-footer .widget_calendar table th,
  .site-footer .searchform input[type="text"],
  .site-footer .searchform #searchsubmit,
  .site-footer .woocommerce-product-search input.search-field,
  .site-footer .woocommerce-product-search input[type="submit"] {
  border-color: #<?php echo esc_attr($anps_footer_border_color); ?>;
  }

  .site-footer .widget_calendar th:after,
  .site-footer .download i:after,
  .site-footer .widget_pages a:after {
  background-color: #<?php echo esc_attr($anps_footer_border_color); ?>;
  }
  <?php
  /* Copyright Footer Text & Background Color */
  ?>
  .copyright-footer {
  background-color: #<?php echo esc_attr($anps_c_footer_bg_color); ?>;
  color: #<?php echo esc_attr($anps_c_footer_text_color); ?>;
  }
  <?php
  $buttons_data = json_decode(stripslashes(get_option('anps-buttons', '{"defaultButton":0,"secondaryButton":1,"buttons":[{"name":"Main button","type":"gradient","normalStyle":{"color":"ffffff","background-color-1":"53caf2","background-color-2":"17c5ff","border-radius":"5","box-shadow":""},"hoverStyle":{},"id":0},{"name":"Normal button","type":"normal","normalStyle":{"background-color":"eceff4","border-radius":"5","box-shadow":"","color":"878a9d"},"hoverStyle":{"background-color":"e2e5eb","color":"6a6e85"},"id":1},{"name":"Border button","type":"border","normalStyle":{"color":"383e48","background-color":"","border-color":"3acbfd","border-radius":"5","border-width":"2"},"hoverStyle":{"background-color":"","border-color":"3acbfd","color":"3acbfd"},"id":2},{"name":"Text button","type":"text","normalStyle":{"color":"383e48"},"hoverStyle":{"color":"3acbfd"},"id":3}],"menuButton":2}')));
  $buttons = $buttons_data->buttons;

  function anps_button_val($prop, $val)
  {
    if (strpos(strtolower($prop), 'color') > -1) {
      if ($val === '') {
        $val = 'transparent';
      } else {
        $val = '#' . $val;
      }
    } else if ($prop === 'border-width' || $prop === 'border-radius') {
      $val .= 'px';
    }

    return $val;
  }

  foreach ($buttons as $button) {
    echo ".anps-btn--style-{$button->id} {";
    foreach ($button->normalStyle as $prop => $val) {
      if ($prop !== 'background-color-1' && $prop !== 'background-color-2' && $prop !== 'box-shadow') {
        if (anps_is_empty_style($val)) {
          echo esc_attr($prop) . ': ' . anps_button_val($prop, $val) . ';';
        }
      }
    }

    if ($button->type === 'gradient') {
      if (
        $button->normalStyle->{'background-color-1'} !== '' &&
        $button->normalStyle->{'background-color-2'} !== ''
      ) {
        echo 'background-image: linear-gradient(to right, #' . $button->normalStyle->{'background-color-1'} . ', #' . $button->normalStyle->{'background-color-2'} . ');';
      }
    }

    if (isset($button->normalStyle->{'box-shadow'})) {
      if ($button->normalStyle->{'box-shadow'} !== '') {
        echo 'box-shadow: 0 10px 25px 0 #' . $button->normalStyle->{'box-shadow'} . ';';
      }
    }

    echo '}';
  }

  foreach ($buttons as $button) {
    $hover_style = array_merge((array)$button->normalStyle, (array)$button->hoverStyle);
    echo ".anps-btn--style-{$button->id}:hover, .anps-btn--style-{$button->id}:focus {";
    foreach ($hover_style as $prop => $val) {
      if (
        $prop !== 'background-color-1' &&
        $prop !== 'background-color-2' &&
        $prop !== 'box-shadow'
      ) {
        if (anps_is_empty_style($val)) {
          echo esc_attr($prop) . ': ' . anps_button_val($prop, $val) . ';';
        }
      }
    }

    if (isset($button->normalStyle->{'box-shadow'})) {
      if ($button->normalStyle->{'box-shadow'} !== '') {
        echo 'box-shadow: 0 10px 35px 0 #' . $button->normalStyle->{'box-shadow'} . ';';
      }
    }

    echo '}';
  }
}
function anps_custom_styles_font_size()
{
  $anps_body_font_size = get_option('anps_body_font_size', '16');

  $anps_h1_font_size = get_option('anps_h1_font_size', '40');
  $anps_h2_font_size = get_option('anps_h2_font_size', '36');
  $anps_h3_font_size = get_option('anps_h3_font_size', '32');
  $anps_h4_font_size = get_option('anps_h4_font_size', '22');
  $anps_h5_font_size = get_option('anps_h5_font_size', '20');

  $anps_menu_font_size = get_option('anps_menu_font_size', '16');
  $anps_submenu_font_size = get_option('anps_submenu_font_size', '14');
  $anps_top_bar_font_size = get_option('anps_top_bar_font_size', '13');


  $anps_page_heading_h1_font_size = get_option('anps_page_heading_h1_font_size', '36');
  $anps_page_heading_fontsize = get_post_meta(get_the_ID(), 'anps_page_heading_fontsize', true);
  if ($anps_page_heading_fontsize !== '') {
    $anps_page_heading_h1_font_size = $anps_page_heading_fontsize;
  }

  $anps_blog_heading_h1_font_size = get_option('anps_blog_heading_h1_font_size', '36');

  $anps_footer_font_size = get_option('anps_footer_font_size', '16');
  $anps_c_footer_font_size = get_option('anps_c_footer_font_size', '14');

  /* Body Font Size */
  ?>
  body,
  .site-main .wp-caption p.wp-caption-text,
  .anps_menu_widget .menu a:before,
  .vc_gitem_row .vc_gitem-col.anps-grid .post-desc,
  .vc_gitem_row .vc_gitem-col.anps-grid-mansonry .post-desc,
  .alert,
  .projects-item .project-title,
  .product_meta,
  .btn.btn-wide,
  .btn.btn-lg,
  .breadcrumb li:before {
  font-size: <?php echo esc_attr($anps_body_font_size); ?>px;
  }

  h1, .h1 { font-size: <?php echo esc_attr($anps_h1_font_size); ?>px; }
  h2, .h2 { font-size: <?php echo esc_attr($anps_h2_font_size); ?>px; }
  h3, .h3 { font-size: <?php echo esc_attr($anps_h3_font_size); ?>px; }
  h4, .h4 { font-size: <?php echo esc_attr($anps_h4_font_size); ?>px; }
  h5, .h5 { font-size: <?php echo esc_attr($anps_h5_font_size); ?>px; }

  nav.site-navigation,
  nav.site-navigation ul li a {
  font-size: <?php echo esc_attr($anps_menu_font_size); ?>px;
  }

  .site-footer {
  font-size: <?php echo esc_attr($anps_footer_font_size); ?>px;
  }

  .copyright-footer {
  font-size: <?php echo esc_attr($anps_c_footer_font_size); ?>px;
  }

  @media (min-width: 1000px) {
  .page-header .page-title {
  font-size: <?php echo esc_attr($anps_page_heading_h1_font_size); ?>px;
  }

  .single .page-header .page-title {
  font-size: <?php echo esc_attr($anps_blog_heading_h1_font_size); ?>px;
  }
  }
<?php
}

function anps_other_styles_css()
{
?>
  .header-wrap {
  height: <?php echo get_option('anps_menu_mobile_height', '74'); ?>px;
  }

  .js-is-sticky .header-wrap {
  height: <?php echo get_option('anps_menu_sticky_mobile_height', '60'); ?>px;
  }

  @media (min-width: 1200px) {
  .header-wrap {
  height: <?php echo get_option('anps_menu_height', '90'); ?>px;
  }

  .js-is-sticky .header-wrap {
  height: <?php echo get_option('anps_menu_sticky_height', '74'); ?>px;
  }
  }
  <?php
}

function anps_theme_options_custom_css()
{
  echo get_option('anps_custom_css', '');
}

/* Custom styles */
function anps_custom_styles()
{
  anps_custom_styles_font_family();
  anps_custom_styles_font_size();
  anps_custom_styles_colors();
  anps_other_styles_css();
  anps_theme_options_custom_css();
}


function anps_get_custom_styles_colors()
{
  $colors = array(
    'anps_text_color' => get_option('anps_text_color', '878a9d'),
    'anps_primary_color' => get_option('anps_primary_color', '383e48'),
    'anps_secondary_color' => get_option('anps_secondary_color', 'd7f7f9'),
    'anps_hovers_color' => get_option('anps_hovers_color', '1d2128'),
    'anps_headings_color' => get_option('anps_headings_color', '383e48'),
    'anps_page_title' => get_option('anps_page_title', 'ffffff'),
    'anps_page_header_background_color1' => get_option('anps_page_header_background_color1', '2cc7fc'),
    'anps_page_header_background_color2' => get_option('anps_page_header_background_color2', '049ef4'),
    'anps_footer_bg_color' => get_option('anps_footer_bg_color', 'ffffff'),
    'anps_footer_text_color' => get_option('anps_footer_text_color', '9294a3'),
    'anps_footer_divider_color' => get_option('anps_footer_divider_color', 'ebf2f6'),
    'anps_footer_border_color' => get_option('anps_footer_border_color', '2e2e2e'),
    'anps_footer_heading_text_color' => get_option('anps_footer_heading_text_color', '383e48'),
    'anps_c_footer_text_color' => get_option('anps_c_footer_text_color', '9294a3'),
    'anps_c_footer_bg_color' => get_option('anps_c_footer_bg_color', 'fcfcfc'),
    'anps_container_width' => get_option('anps_container_width', '1300'),
  );


  return $colors;
}

function anps_get_custom_styles_font_size()
{

  $fonts = array(
    'anps_body_font_size' => get_option('anps_body_font_size', '16'),
    'anps_h1_font_size' => get_option('anps_h1_font_size', '40'),
    'anps_h2_font_size' => get_option('anps_h2_font_size', '36'),
    'anps_h3_font_size' => get_option('anps_h3_font_size', '32'),
    'anps_h4_font_size' => get_option('anps_h4_font_size', '22'),
    'anps_h5_font_size' => get_option('anps_h5_font_size', '20'),
    'anps_menu_font_size' => get_option('anps_menu_font_size', '16'),
    'anps_submenu_font_size' => get_option('anps_submenu_font_size', '14'),
    'anps_top_bar_font_size' => get_option('anps_top_bar_font_size', '13'),
    'anps_page_heading_h1_font_size' => get_option('anps_page_heading_h1_font_size', '36'),
    'anps_blog_heading_h1_font_size' => get_option('anps_blog_heading_h1_font_size', '36'),
    'anps_footer_font_size' => get_option('anps_footer_font_size', '16'),
    'anps_c_footer_font_size' => get_option('anps_c_footer_font_size', '14'),

  );

  return $fonts;
}

function anps_get_custom_styles_font_family()
{
  $fonts = array(
    'font_1' => 'Montserrat',
    'font_2' => 'Nunito',
    'font_3' => 'Montserrat'
  );

  $logo_font_option = explode('|', urldecode(get_option('anps_text_logo_font', '')));
  $fonts['logo_font'] = array_shift($logo_font_option);

  $font_sources = array('System fonts', 'Custom fonts', 'Google fonts');
  if (in_array(get_option('font_source_1'), $font_sources)) {
    $fonts['font_1'] = urldecode(get_option('font_type_1'));
  }
  if (in_array(get_option('font_source_2'), $font_sources)) {
    $fonts['font_2'] = urldecode(get_option('font_type_2'));
  }
  if (in_array(get_option('font_source_navigation'), $font_sources)) {
    $fonts['font_3'] = urldecode(get_option('font_type_navigation'));
  }

  return $fonts;
}

/** Build Google font URI */
function anps_get_google_fonts_uri($fonts_list = array())
{
  if (empty($fonts_list)) {
    return false;
  }
  $uri = 'https://fonts.googleapis.com/css2?display=swap';
  foreach ($fonts_list as $font) {
    $uri .= '&family=' . urlencode($font) . ':ital,wght@0,300;0,400;0,500;0,600;0,700;1,400';
  }
  return $uri;
}

function anps_custom_block_editor_styles()
{
  $ff = anps_get_custom_styles_font_family();
  $fs = anps_get_custom_styles_font_size();
  $c = anps_get_custom_styles_colors();

  $css = '';
  // Import required custom fonts
  $font_source_type = get_option('font_source_1');
  if ($font_source_type === 'Custom fonts') {
    $css .= anps_custom_font($ff['font_1']);
  }

  ob_start();

  if ($fs['anps_blog_heading_h1_font_size']) : ?>
    .post-type-page .editor-styles-wrapper .editor-post-title__input,
    .post-type-post .editor-styles-wrapper .editor-post-title__input { font-size:
    <?php echo esc_attr($fs['anps_blog_heading_h1_font_size']); ?>px; }
  <?php endif; ?>
  :root .editor-styles-wrapper {
  <?php if ($c['anps_text_color']) : ?>
    color: #<?php echo esc_attr($c['anps_text_color']); ?> !important;
  <?php endif;
  if ($fs['anps_body_font_size']) : ?>
    font-size: <?php echo esc_attr($fs['anps_body_font_size']); ?>px !important;
  <?php endif;
  if ($ff['font_2']) : ?>
    font-family: <?php echo anps_wrap_font($ff['font_2']); ?> !important;
  <?php endif; ?>
  }
  <?php if ($c['anps_page_title']) : ?>
    :root .editor-styles-wrapper .editor-post-title__input { color: #<?php echo esc_attr($c['anps_page_title']); ?>;
    text-align:left; text-transform:none; }
  <?php endif;
  if ($c['anps_page_header_background_color1'] &&  $c['anps_page_header_background_color2']) : ?>
    :root .editor-styles-wrapper .edit-post-visual-editor__post-title-wrapper { background:
    linear-gradient(90deg,#<?php echo esc_attr($c['anps_page_header_background_color1']); ?>,#<?php echo esc_attr($c['anps_page_header_background_color2']); ?>);
    }
  <?php endif;
  if ($fs['anps_h1_font_size']) : ?>
    :root .editor-styles-wrapper h1.wp-block { font-size: <?php echo esc_attr($fs['anps_h1_font_size']); ?>px; }
  <?php endif;
  if ($fs['anps_h2_font_size']) : ?>
    :root .editor-styles-wrapper h2.wp-block { font-size: <?php echo esc_attr($fs['anps_h2_font_size']); ?>px; }
  <?php endif;
  if ($fs['anps_h3_font_size']) : ?>
    :root .editor-styles-wrapper h3.wp-block { font-size: <?php echo esc_attr($fs['anps_h3_font_size']); ?>px; }
  <?php endif;
  if ($fs['anps_h4_font_size']) : ?>
    :root .editor-styles-wrapper h4.wp-block { font-size: <?php echo esc_attr($fs['anps_h4_font_size']); ?>px; }
  <?php endif;
  if ($fs['anps_h5_font_size']) : ?>
    :root .editor-styles-wrapper h5.wp-block { font-size: <?php echo esc_attr($fs['anps_h5_font_size']); ?>px; }
  <?php endif;
  if ($c['anps_headings_color']) : ?>
    :root .editor-styles-wrapper h1,
    :root .editor-styles-wrapper h2,
    :root .editor-styles-wrapper h3,
    :root .editor-styles-wrapper h4,
    :root .editor-styles-wrapper h5,
    :root .editor-styles-wrapper h6,
    :root .editor-styles-wrapper em { color: #<?php echo esc_attr($c['anps_headings_color']); ?>; }
  <?php endif;
  if ($ff['font_1']) : ?>
    :root .editor-styles-wrapper .editor-post-title__input,
    :root .editor-styles-wrapper h1,
    :root .editor-styles-wrapper h2,
    :root .editor-styles-wrapper h3,
    :root .editor-styles-wrapper h4,
    :root .editor-styles-wrapper h5,
    :root .editor-styles-wrapper h6 {
    font-family: <?php echo anps_wrap_font($ff['font_1']); ?>;
    <?php if ($ff['font_1'] === 'Montserrat') :
    ?>font-weight: 500;<?php
                      endif; ?>
    }
  <?php endif;
  if ($c['anps_primary_color']) : ?>
    :root .editor-styles-wrapper a,
    :root .editor-styles-wrapper b,
    :root .editor-styles-wrapper .wp-block-file__textlink { color: #<?php echo esc_attr($c['anps_primary_color']); ?>; }
    :root .editor-styles-wrapper mark:not(.has-background) {
    color: #fff !important;
    background-color: #<?php echo esc_attr($c['anps_primary_color']); ?> !important;
    }
  <?php endif;
  if ($c['anps_hovers_color']) : ?>
    :root .editor-styles-wrapper a:hover,
    :root .editor-styles-wrapper .wp-block-file__textlink:hover { color: #<?php echo esc_attr($c['anps_hovers_color']); ?>;
    }
  <?php endif;
  if ($c['anps_container_width']) : ?>
    :root .editor-styles-wrapper .block-editor-block-list__layout.is-root-container { max-width: <?php echo esc_attr($c['anps_container_width']) ?>px; }
    :root .editor-styles-wrapper .wp-block { max-width: <?php echo esc_attr($c['anps_container_width']) ?>px; }
<?php endif;

  return ob_get_clean();
}
