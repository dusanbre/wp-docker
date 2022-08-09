<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');

wp_enqueue_style('anps-colorpicker');
wp_enqueue_script('anps-colorpicker-theme');
wp_enqueue_script('anps-colorpicker-custom');

if (isset($_GET['save_options'])) {

    if(!isset($_POST['anps_footer_disable'])) {
        $_POST['anps_footer_disable'] = "";
    } else {
        $_POST['anps_footer_disable'] = "1";
    }
    $anps_options->anps_save_options("footer");
}
?>
<form action="themes.php?page=theme_options&sub_page=footer&save_options" method="post">
    <div class="content-inner">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-level-down"></i><?php esc_html_e("Footer banner", 'lapopsi'); ?></h3>
            </div>
            <div class="col-md-4">
                <?php $anps_style->anps_create_select( 'anps_global_footer_banner', $anps_style->anps_get_custom_posts_array('footer_banner'), '', '', '1'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-level-down"></i><?php esc_html_e("Footer", 'lapopsi'); ?></h3>
            </div>
            <div class="col-md-4">
                <?php $anps_style->anps_create_checkbox('anps_enable_footer', esc_html__('Enable footer', 'lapopsi'), '1');?>
            </div>
            <!-- Footer columns -->
            <div class="col-md-4">
                <?php
                    $options = array(
                        '1' => esc_html__('1 column', 'lapopsi'),
                        '2' => esc_html__('2 columns', 'lapopsi'),
                        '3' => esc_html__('3 columns', 'lapopsi'),
                        '4' => esc_html__('4 columns', 'lapopsi'),
                        '4-lg' => esc_html__('4 columns (1st column larger)', 'lapopsi'),
                        '5' => esc_html__('5 columns (1st column larger)', 'lapopsi'),
                    );
                    $anps_style->anps_create_select( 'anps_footer_style', $options, esc_html__('Footer columns', 'lapopsi'), '4');
                ?>
            </div>
            <!-- Copyright footer columns -->
            <div class="col-md-4">
                <?php
                    $options = array(
                        '1' => esc_html__('1 column', 'lapopsi'),
                        '2' => esc_html__('2 columns', 'lapopsi')
                    );
                    $anps_style->anps_create_select( 'anps_copyright_footer', $options, esc_html__('Copyright footer columns', 'lapopsi'));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php $anps_style->anps_create_checkbox('anps_fixed_footer', esc_html__('Fixed footer', 'lapopsi'), '');?>
            </div>
            <div class="col-md-4">
                <?php $anps_style->anps_create_checkbox('anps_footer_shadow', esc_html__('Footer shadow', 'lapopsi'), '');?>
            </div>
            <div class="col-md-4">
                <?php $anps_style->anps_create_checkbox('anps_copyright_footer_shadow', esc_html__('Copyright footer shadow', 'lapopsi'), '');?>
            </div>
        </div>

<div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-tint"></i><?php esc_html_e("Footer Colors", 'lapopsi'); ?></h3>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_footer_bg_color', 'ffffff', esc_html__('Footer background color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_footer_text_color', '9294a3', esc_html__('Footer text color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_footer_hover_color', '', esc_html__('Footer hover color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_footer_border_color', '2e2e2e', esc_html__('Footer border color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_footer_divider_color', 'ebf2f6', esc_html__('Footer divider color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_footer_heading_text_color', '383e48', esc_html__('Footer heading text color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_c_footer_text_color', '9294a3', esc_html__('Copyright footer text color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_c_footer_bg_color', 'fcfcfc', esc_html__('Copyright footer background color', 'lapopsi')); ?>
            </div>
        </div>
    </div>

    <!-- Save form -->
    <?php $anps_options->anps_save_button(); ?>
</form>
