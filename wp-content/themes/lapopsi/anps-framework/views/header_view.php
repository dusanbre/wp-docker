<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');

/* Enqueue style in script for custom colorpicker */
wp_enqueue_style('anps-colorpicker');
wp_enqueue_script('anps-colorpicker-theme');
wp_enqueue_script('anps-colorpicker-custom');

wp_enqueue_script('my-upload');
wp_enqueue_style("thickbox");



if (isset($_GET['save_options'])) {
    $anps_options->anps_save_options("header");
}
?>

<form action="themes.php?page=theme_options&sub_page=header&save_options" method="post">
    <div class="content-inner">
        <div class="row">

            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i><?php esc_html_e('Menu Layout', 'lapopsi'); ?></h3>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <?php $horizontal_options = array (
                        'top' => array (
                            'image' => 'top-background-menu.jpg',
                            'value' => 'top',
                        ),
                        'top-fullwidth-menu' => array (
                            'image' => 'top-fullwidth-menu.jpg',
                            'value' => 'top-fullwidth-menu',
                        ),
                        'bottom' => array (
                            'image' => 'bottom-background-menu.jpg',
                            'value' => 'bottom',
                        ),
                        'vertical-menu' => array (
                            'image' => 'vertical-menu.jpg',
                            'value' => 'vertical',
                        ),
                    );

                    $anps_options->anps_create_radio('anps_menu_type', $horizontal_options, 'col-md-3 col-sm-4 col-xs-6 col-xxs-12 top-or-bottom', true, '', 'top' );?>
                    <div class="clearfix"></div>
                </div>
                <h3><i class="fa fa-bars"></i><?php esc_html_e('Menu Options', 'lapopsi'); ?></h3>
                <div class="row">
                    <div class="options-to-toggle">
                        <!-- Menu position (homepage) -->
                        <div class="col-md-4">
                            <?php
                            $menu_positions = array(
                                3 => esc_html__('Right', 'lapopsi'),
                                2 => esc_html__('Left', 'lapopsi'),
                            );
                            $anps_options->anps_create_select('anps_front_menu_center', $menu_positions, esc_html__('Menu position (homepage)', 'lapopsi'), 3);
                            ?>
                        </div>

                        <!-- Menu position -->
                        <div class="col-md-4">
                            <?php
                            $menu_positions = array(
                                3 => esc_html__('Right', 'lapopsi'),
                                2 => esc_html__('Left', 'lapopsi'),
                            );
                            $anps_options->anps_create_select('anps_global_menu_center', $menu_positions, esc_html__('Menu position (other pages)', 'lapopsi'), 3);
                            ?>
                        </div>

                        <!-- Menu height -->
                        <div class="col-md-4">
                            <?php $anps_options->anps_create_number_option('anps_menu_height', '90', esc_html__('Menu bar height', 'lapopsi'), 'px');?>
                        </div>

                        <!-- Menu height -->
                        <div class="col-md-4">
                            <?php $anps_options->anps_create_number_option('anps_menu_transparent_height', '90', esc_html__('Menu transparent bar height', 'lapopsi'), 'px');?>
                        </div>

                        <!-- Menu height (mobile) -->
                        <div class="col-md-4">
                            <?php $anps_options->anps_create_number_option('anps_menu_mobile_height', '74', esc_html__('Menu bar height (mobile)', 'lapopsi'), 'px');?>
                        </div>

                        <!-- Menu spacing -->
                        <div class="col-md-4">
                            <?php $anps_options->anps_create_number_option('anps_menu_spacing', '15', esc_html__('Menu item spacing', 'lapopsi'), 'px');?>
                        </div>

                        <!-- Show desktop menu above -->
                        <!-- <div class="col-md-4">
                            <?php $anps_options->anps_create_number_option('anps_menu_desktop_view', '992', esc_html__('Show desktop menu above', 'lapopsi'), 'px');?>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row-flex">
                    <div class="col-md-12">
                        <h3><i class="fa fa-tint"></i><?php esc_html_e("Header Colors", 'lapopsi'); ?></h3>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_header_main_bg_color', '171d2f', esc_html__('Main header color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_menu_text_color', '565656', esc_html__('Menu text color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_menu_text_hover_color', '000000', esc_html__('Menu text hover color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_menu_text_active_color', '2dc1f3', esc_html__('Active menu text color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_options->anps_create_color_option('anps_menu_bg_color', 'ffffff', esc_html__('Menu background color 1', 'lapopsi') );?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_options->anps_create_color_option('anps_menu_bg_color2', '', esc_html__('Menu background color 2', 'lapopsi') );?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_page_header_background_color1', '2cc7fc', esc_html__('Page header background color 1', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_page_header_background_color2', '049ef4', esc_html__('Page header background color 2', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_page_title', 'ffffff', esc_html__('Page title color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_top_bar_color', '878a9d', esc_html__('Top bar text color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_top_bar_bg_color', '252e42', esc_html__('Top bar background color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_submenu_background_color', 'ffffff', esc_html__('Submenu background color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_submenu_text_color', '8c8c8c', esc_html__('Submenu text color', 'lapopsi')); ?>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_submenu_text_hover_color', '000000', esc_html__('Submenu text hover color', 'lapopsi')); ?>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_submenu_text_active_color', '000000', esc_html__('Submenu active text color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_menu_mobile_icons', '202431', esc_html__('Mobile menu icons color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_breadcrumbs_text_color', '999cab', esc_html__('Breadcrumbs text color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_breadcrumbs_border_color', 'e7e7e7', esc_html__('Breadcrumbs border color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_breadcrumbs_bg_color', 'ffffff', esc_html__('Breadcrumbs background color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_header_search_text_color', '000', esc_html__('Search text color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_header_search_background_color', '888', esc_html__('Search background color', 'lapopsi')); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i><?php esc_html_e('Transparent Options', 'lapopsi'); ?></h3>
                <div class="row">
                    <!-- Menu transparent checkbox -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_checkbox('anps_front_transparent_header', esc_html__('Transparent header on home page', 'lapopsi') );?>
                    </div>

                    <!-- Text color -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_color_option('anps_menu_transparent_text_color', '', esc_html__('Text color', 'lapopsi') );?>
                    </div>

                    <!-- Active menu text color -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_color_option('anps_menu_transparent_active', '', esc_html__('Active menu text color', 'lapopsi') );?>
                    </div>

                    <!-- Background color -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_color_option('anps_menu_transparent_bg_color', '', esc_html__('Background color 1', 'lapopsi') );?>
                    </div>

                    <!-- Background color -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_color_option('anps_menu_transparent_bg2_color', '', esc_html__('Background color 2', 'lapopsi') );?>
                    </div>

                    <!-- Text hover color -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_color_option('anps_menu_transparent_text_hover_color', '', esc_html__('Text hover color', 'lapopsi') );?>
                    </div>

                    <!-- Top bar color -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_color_option('anps_menu_transparent_topbar_color', '', esc_html__('Top bar color', 'lapopsi') );?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i><?php esc_html_e('Sticky menu Options', 'lapopsi'); ?></h3>
                <div class="row">
                    <!-- Sticky menu checkbox -->
                    <div class="col-md-4">
                       <?php $anps_options->anps_create_checkbox('anps_sticky_menu', esc_html__('Sticky menu', 'lapopsi'), '1');?>
                    </div>

                    <!-- Sticky menu height -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_number_option('anps_menu_sticky_height', '74', esc_html__('Menu sticky bar height', 'lapopsi'), 'px');?>
                    </div>

                    <!-- Sticky menu mobile checkbox -->
                    <div class="col-md-4">
                       <?php $anps_options->anps_create_checkbox('anps_sticky_menu_mobile', esc_html__('Sticky menu mobile', 'lapopsi'), '');?>
                    </div>

                    <!-- Sticky menu height (mobile) -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_number_option('anps_menu_sticky_mobile_height', '60', esc_html__('Menu sticky bar height (mobile)', 'lapopsi'), 'px');?>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_sticky_bg', 'ffffff', esc_html__('Sticky bar background color 1', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_sticky_bg2', '', esc_html__('Sticky bar background color 2', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_sticky_color', '565656', esc_html__('Sticky bar text color', 'lapopsi')); ?>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <?php $anps_style->anps_create_color_option('anps_sticky_color_hover', '000000', esc_html__('Sticky bar text hover color', 'lapopsi')); ?>
                    </div>

                    <!-- Active menu text color -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_color_option('anps_sticky_color_active', '2dc1f3', esc_html__('Active menu text color', 'lapopsi') );?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i><?php esc_html_e('Menu Button Options', 'lapopsi'); ?></h3>
                <div class="row">
                    <!-- Menu button checkbox -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_checkbox('anps_menu_button', esc_html__('Menu button', 'lapopsi') );?>
                    </div>

                    <!-- Menu button text -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_text_option('anps_menu_button_text', esc_html__('Menu button text', 'lapopsi') );?>
                    </div>

                    <!-- Menu button URL -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_text_option('anps_menu_button_url', esc_html__('Menu button URL', 'lapopsi') );?>
                    </div>

                    <!-- Menu button target -->
                    <div class="col-md-4">
                        <?php $menu_button_target = array('_self' => '_self', '_blank' => '_blank', '_parent' => '_parent', '_top' => '_top');
                        $anps_options->anps_create_select('anps_menu_button_target', $menu_button_target,  esc_html__('Menu button target', 'lapopsi'));?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i><?php esc_html_e('Top bar Options', 'lapopsi'); ?></h3>
                <div class="row">
                    <!--Top bar desktop-->
                    <div class="col-md-4">
                        <?php
                        $top_bar_options = array(
                            'off'=> esc_html__('Off', 'lapopsi'),
                            'on'=> esc_html__('On', 'lapopsi'),
                        );
                        $anps_options->anps_create_select('anps_top_bar_desktop', $top_bar_options,  esc_html__('Top bar desktop', 'lapopsi'));?>
                    </div>

                    <!--Top bar mobile-->
                    <div class="col-md-4">
                        <?php
                        $top_bar_options = array(
                            'off'=> esc_html__('Off', 'lapopsi'),
                            'on'=> esc_html__('On', 'lapopsi'),
                            'toggle'=> esc_html__('Toggle to show', 'lapopsi'),
                            'menu'=> esc_html__('Inside mobile menu', 'lapopsi'),
                        );
                        $anps_options->anps_create_select('anps_top_bar_mobile', $top_bar_options,  esc_html__('Top bar mobile', 'lapopsi'));?>
                    </div>

                    <!-- Top bar height -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_number_option('anps_top_bar_height', '50', esc_html__('Top bar height', 'lapopsi'), 'px');?>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <h3><i class="fa fa-bars"></i><?php esc_html_e('Other Header Options', 'lapopsi'); ?></h3>
                <div class="row">
                    <!-- Header full width -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_checkbox('anps_header_full_width', esc_html__('Full width header', 'lapopsi') );?>
                    </div>

                    <!-- Display search mobile checkbox -->
                    <div class="col-md-4">
                       <?php $anps_options->anps_create_checkbox('anps_global_search_icon_mobile', esc_html__('Display search on mobile and tablets?', 'lapopsi'), '1');?>
                    </div>

                    <!-- Display search desktop checkbox -->
                    <div class="col-md-4">
                       <?php $anps_options->anps_create_checkbox('anps_global_search_icon', esc_html__('Display search icon in menu (desktop)?', 'lapopsi'), '1');?>
                    </div>

                    <!-- Enable menu walker for our mega menu -->
                    <div class="col-md-4">
                        <?php $anps_options->anps_create_checkbox('anps_global_menu_walker', esc_html__('Enable menu walker (mega menu)', 'lapopsi'), '1');?>
                    </div>

                    <!-- Display search mobile checkbox -->
                    <div class="col-md-4">
                       <?php $anps_options->anps_create_checkbox('anps_menu_shadow', esc_html__('Menu shadow', 'lapopsi'), '1');?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save form -->
    <?php $anps_options->anps_save_button(); ?>
</form>
