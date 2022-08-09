<?php
if (isset($_GET['save_token_sale'])) {
    $anps_plugin->save_options('whitelist_token_sale');
}
wp_enqueue_style('anps-colorpicker');
wp_enqueue_script('anps-colorpicker-theme');
wp_enqueue_script('anps-colorpicker-custom');
wp_enqueue_script('my-upload');
wp_enqueue_style('thickbox');
?>
<form action="edit.php?post_type=whitelist&page=anps_whitelist_settings&sub_page=token_sale&save_token_sale" method="post">
    <div class="content-inner">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e("Popup Settings", 'anps_theme_plugin'); ?></h3>
                <?php $anps_plugin->anps_create_upload('anps_whitelist_token_pp_image', esc_html__('Popup Image', 'anps_theme_plugin')); ?>
            </div>
            <div class="col-md-4">
                <?php $anps_plugin->anps_create_text_option('anps_whitelist_token_title', esc_html__('Popup Title', 'anps_theme_plugin')); ?>
            </div>
            <div class="col-md-4">
                <?php $anps_plugin->anps_create_text_option('anps_whitelist_token_text', esc_html__('Popup Text', 'anps_theme_plugin')); ?>
            </div>
            <div class="col-md-4">
                <?php $anps_plugin->anps_create_color_option('anps_whitelist_token_overlay_bg_color', 'fff', esc_html__('Overlay Background', 'anps_theme_plugin')); ?>
            </div>
        </div>
    </div>

    <div class="fixsave"><button type="submit"><?php esc_html_e('Save', 'anps_theme_plugin'); ?><i class="fa fa-floppy-o"></i></button></div>
    <button type="submit" class="bottom-save absolute"><i class="fa fa-floppy-o"></i><?php esc_html_e('Save all changes', 'anps_theme_plugin'); ?></button>
</form>
