<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');
/* Enqueue style in script for custom colorpicker */
wp_enqueue_style('anps-colorpicker');
wp_enqueue_script('anps-colorpicker-theme');
wp_enqueue_script('anps-colorpicker-custom');
/* Save form */
if(isset($_GET['save_style'])) {
    $anps_options->anps_save_options('theme_style');
}
?>

<form action="themes.php?page=theme_options&save_style" method="post">
    <div class="content-inner">
        <!-- Main Theme Colors -->
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-tint"></i><?php esc_html_e("Main Theme Colors", 'lapopsi'); ?></h3>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_text_color', '878a9d', esc_html__('Text color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_page_bg_color', 'ffffff', esc_html__('Page background color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_primary_color', '383e48', esc_html__('Primary color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_secondary_color', 'd7f4fe', esc_html__('Secondary color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_secondary_background_color', '3acbfd', esc_html__('Secondary background color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_hovers_color', '1d2128', esc_html__('Hovers color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_headings_color', '383e48', esc_html__('Headings color', 'lapopsi')); ?>
            </div>

            <div class="col-md-3 col-sm-6">
                <?php $anps_style->anps_create_color_option('anps_mobile_toolbar_color', '', esc_html__('Mobile address bar color', 'lapopsi')); ?>
            </div>
        </div>
    </div>

    <!-- Save form -->
    <?php $anps_options->anps_save_button(); ?>
</form>
