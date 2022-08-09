<?php
if (isset($_GET['save_whitelist'])) {
    $anps_plugin->save_options('whitelist_settings');
}
?>
<form action="edit.php?post_type=whitelist&page=anps_whitelist_settings&save_whitelist" method="post">
    <div class="content-inner">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e("General settings", 'anps_theme_plugin'); ?></h3>
                <?php $anps_plugin->anps_create_text_option('anps_whitelist_email', esc_html__('Email', 'anps_theme_plugin')); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e("E-mail settings", 'anps_theme_plugin'); ?></h3>
                <?php $anps_plugin->anps_create_text_option('anps_whitelist_pending_subject', esc_html__('Whitelist Pending Subject', 'anps_theme_plugin')); ?>
                <?php $anps_plugin->anps_create_textarea('anps_whitelist_pending_content', htmlentities(get_option('anps_whitelist_pending_content', '')), '5', esc_html__('Whitelist Pending Content', 'anps_theme_plugin')); ?>
                <?php $anps_plugin->anps_create_text_option('anps_whitelist_approve_subject', esc_html__('Whitelist Approve Subject', 'anps_theme_plugin')); ?>
                <?php $anps_plugin->anps_create_textarea('anps_whitelist_approve_content', htmlentities(get_option('anps_whitelist_approve_content', '')), '5', esc_html__('Whitelist Approve Content', 'anps_theme_plugin')); ?>
                <?php $anps_plugin->anps_create_text_option('anps_whitelist_not_approved_subject', esc_html__('Whitelist Not Approved Subject', 'anps_theme_plugin')); ?>
                <?php $anps_plugin->anps_create_textarea('anps_whitelist_not_approved_content', htmlentities(get_option('anps_whitelist_not_approved_content', '')), '5', esc_html__('Whitelist Not Approved Content', 'anps_theme_plugin')); ?>
            </div>
        </div>
    </div>

    <div class="fixsave"><button type="submit"><?php esc_html_e('Save', 'anps_theme_plugin'); ?><i class="fa fa-floppy-o"></i></button></div>
    <button type="submit" class="bottom-save absolute"><i class="fa fa-floppy-o"></i><?php esc_html_e('Save all changes', 'anps_theme_plugin'); ?></button>
</form>