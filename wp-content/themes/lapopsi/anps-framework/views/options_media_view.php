<?php
//Check classes/AnpsFramework.php for available field options and settings.
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');
if (isset($_GET['save_media'])) {
    $anps_options->anps_save_options("options_media");
}
/* Get all fonts */
$fonts = $anps_style->all_fonts();

wp_enqueue_script('my-upload');
wp_enqueue_style('thickbox');
?>
<form action="themes.php?page=theme_options&sub_page=options_media&save_media" method="post">
    <div class="content-inner">

        <div class="row">

            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Logo', 'lapopsi'); ?></h3>
                <p class="anps-desc"><?php esc_html_e('This is the primary logo image. If a specific logo is not defined, this logo will be used instead.', 'lapopsi'); ?></p>
            </div>

            <!-- Logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_logo', esc_html__('Logo', 'lapopsi')); ?>
            </div>

            <!-- Logo height -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_number_option('anps_logo_height', '', esc_html__('Logo height', 'lapopsi'), 'px'); ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Front Page Logo', 'lapopsi'); ?></h3>
                <p class="anps-desc"><?php esc_html_e('This logo will only be visible on the home page. Useful for having a different menu type for your home page (eg. transparent menu).', 'lapopsi'); ?></p>
            </div>

            <!-- Front page logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_front_logo', esc_html__('Front page logo', 'lapopsi')); ?>
            </div>

            <!-- Front page logo height -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_number_option('anps_front_logo_height', '', esc_html__('Front page logo height', 'lapopsi'), 'px'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Sticky Logo', 'lapopsi'); ?></h3>
                <p class="anps-desc"><?php esc_html_e('Visible when the users scrolls down and the menu bar is changed to the sticky state.', 'lapopsi'); ?></p>
            </div>

            <!-- Sticky logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_sticky_logo', esc_html__('Sticky logo', 'lapopsi')); ?>
            </div>

            <!-- Sticky logo height -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_number_option('anps_sticky_logo_height', '', esc_html__('Sticky logo height', 'lapopsi'), 'px'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Transparent Sticky Logo', 'lapopsi'); ?></h3>
                <p class="anps-desc"><?php esc_html_e('Similar to the sticky logo, but only when the sticky is set to be transparent.', 'lapopsi'); ?></p>
            </div>

            <!-- Sticky transparent Logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_sticky_transparent_logo', esc_html__('Transparent Sticky logo', 'lapopsi')); ?>
            </div>

            <!-- Logo height -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_number_option('anps_sticky_transparent_logo_height', '', esc_html__('Transparent Sticky logo height', 'lapopsi'), 'px'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Mobile Logos', 'lapopsi'); ?></h3>
                <p class="anps-desc"><?php esc_html_e('Only visible on screens smaller than 1200px.', 'lapopsi'); ?></p>
            </div>

            <!-- Mobile logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_mobile_logo', esc_html__('Mobile logo', 'lapopsi')); ?>
            </div>

            <!-- Front page mobile logo -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_front_mobile_logo', esc_html__('Front page mobile logo', 'lapopsi')); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Page heading', 'lapopsi'); ?></h3>
            </div>

            <!-- Page heading background upload -->
            <div class="col-md-6">
                <?php $anps_options->anps_create_upload('anps_page_heading_bg', esc_html__('Page heading background', 'lapopsi'), true );?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Site icons', 'lapopsi'); ?></h3>
            </div>

            <!-- Favicon -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_favicon', esc_html__('Favicon', 'lapopsi'), true, esc_html__('Icon that is visible in browsers tabs next to the page title.', 'lapopsi')); ?>
            </div>

            <!-- Home screen icon -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_upload('anps_home_screen_icon', esc_html__('Home screen icon', 'lapopsi'), true, esc_html__('Used when a user adds your site to his home screen on Android and iOS devices. Recommended size is 152x152px.', 'lapopsi')); ?>
            </div>
        </div>

        <!-- Text based logo -->
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-picture-o"></i><?php esc_html_e('Text Based Logo', 'lapopsi'); ?></h3>
            </div>
            <div class="col-md-8">
                <?php
                $value2 = get_option('anps_text_logo', '');
                wp_editor(str_replace('\\"', '"', $value2), 'anps_text_logo', array(
                            'wpautop' => true,
                            'media_buttons' => false,
                            'quicktags' => false,
                            'textarea_name' => 'anps_text_logo',
                            'editor_height' => 150,
                            'tinymce' => array(
                                'toolbar1' => 'bold, italic, underline, forecolor, fontsizeselect',
                                'toolbar2' => ''
                            )
                    )); ?>
            </div>
            <div class="col-md-4">
                <label for="anps_text_logo_font"><?php esc_html_e('Logo font', 'lapopsi'); ?></label>
                <select name="anps_text_logo_font" id="anps_text_logo_font">
                    <?php foreach($fonts as $name => $value) : ?>
                    <optgroup label="<?php echo esc_attr($name); ?>">
                    <?php foreach ($value as $font) :
                            $selected = '';
                            if ($font['value']."|".$name == get_option('anps_text_logo_font')) {
                                $selected = ' selected';
                            }
                    ?>
                            <option value="<?php echo esc_attr($font['value'])."|".esc_attr($name); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($font['name']); ?></option>
                    <?php endforeach; ?>
                    </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- END Text based logo -->

    </div>

    <!-- Save form -->
    <?php $anps_options->anps_save_button(); ?>
</form>
