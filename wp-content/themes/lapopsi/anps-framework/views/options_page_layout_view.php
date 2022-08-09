<?php
//Check classes/AnpsFramework.php for available field options and settings.
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');
wp_enqueue_style('anps-colorpicker');
wp_enqueue_script('anps-colorpicker-theme');
wp_enqueue_script('anps-colorpicker-custom');
wp_enqueue_script("my-upload");
wp_enqueue_style("thickbox");
wp_enqueue_script('anps-pattern');

if (isset($_GET['save_page'])) {
     $anps_options->anps_save_options("options_page");
}
?>
<form action="themes.php?page=theme_options&sub_page=options_page&save_page" method="post">
    <div class="content-inner">
        <div class="row layout">
            <div class="col-md-12">
                <h3><i class="fa fa-columns"></i><?php esc_html_e("Page layout:", 'lapopsi'); ?></h3>
            </div>

            <div class="info boxed-checkbox col-md-6">
                <!-- Boxed -->
                <?php
                    if(get_option("anps_is_boxed", "0")=="0"){
                        $checked='';

                    } else {
                        $checked = 'checked';
                    }
                ?>

                <?php $anps_style->anps_create_checkbox('anps_is_boxed', esc_html__('Boxed version', 'lapopsi'), '0');?>

            </div>
            <div class="clearfix"></div>
            <!-- Pattern -->
            <div class="boxed-wrapper">
                <div id="pattern-select-wrapper">
                    <label class="col-md-12" for="anps_pattern"><?php esc_html_e("Choose a pattern:", 'lapopsi'); ?></label>
                    <div class="admin-patern-radio col-md-12 hidden">
                        <?php for($i = 0; $i < 13; $i++):
                            if(get_option('anps_pattern') == $i) {
                                $checked = 'checked';

                            } else {
                                $checked = '';

                            }
                            ?>
                            <input type="radio" id="anps_pattern" name="anps_pattern" value="<?php echo esc_attr($i); ?>" <?php echo esc_attr($checked); ?>/>
                        <?php endfor; ?>
                    </div>
                    <div class="admin-patern-select col-md-12">
                        <?php for ($i = 0; $i < 13; $i++) : ?>
                            <?php if (get_option('anps_pattern') == $i): ?>
                                <button style="background-image: url('<?php echo get_template_directory_uri(); ?>/css/boxed/pattern-<?php echo esc_attr($i); ?>.png')" class="admin-pattern-item selected-pattern">Pattern <?php echo esc_html($i); ?></button>
                            <?php else: ?>
                                <button style="background-image: url('<?php echo get_template_directory_uri(); ?>/css/boxed/pattern-<?php echo esc_attr($i); ?>.png')" class="admin-pattern-item">Pattern <?php echo esc_html($i); ?></button>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
                <!-- Custom background -->
                <div class="input col-md-12" <?php if(get_option('anps_is_boxed', "0")=="0" || get_option('anps_pattern',"") != 0) echo 'style="display: none"'; ?> id="patern-type-wrapper">
                    <label for="anps_type"><?php esc_html_e("Custom background type", 'lapopsi' ); ?></label>
                    <div class="patern-type">
                        <?php $types = array(
                            'stretched' => esc_html__('Stretched', 'lapopsi'),
                            'tilled' => esc_html__('Tiled', 'lapopsi'),
                            'custom-color' => esc_html__('Custom color', 'lapopsi')
                        );
                        foreach ($types as $value => $type) :
                            if(get_option('anps_type', "") == $value) {
                                $checked='checked';
                            } else {
                                $checked = '';
                            }
                            ?>
                        <span class="onethird">
                            <input type="radio" id="back-type-<?php echo esc_attr($value); ?>" name="anps_type" value="<?php echo esc_attr($value); ?>" <?php echo esc_attr($checked); ?>/>
                            <label for="back-type-<?php echo esc_attr($value); ?>"><?php echo esc_attr($type); ?></label>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Custom pattern -->
                <div class="col-md-12"  <?php if ( (get_option('anps_is_boxed', "0")=="0") || ( get_option('anps_pattern', "") != 0 ) ) echo 'style="display: none"'; ?> id="custom-patern-wrapper">
                    <?php $anps_style->anps_create_upload('anps_custom_pattern', esc_html__('Custom background image/pattern', 'lapopsi')); ?>
                </div>
                <!-- Custom background color -->

                <div id="custom-background-color-wrapper" class="col-md-12" >
                    <?php $anps_style->anps_create_color_option('anps_bg_color', 'transparent', esc_html__('Background color', 'lapopsi')); ?>
                </div>
            </div>
        </div>
        <!-- Post Sidebars (global settings) -->
        <div class="row">           
            <div class="col-md-12">
                <h3><i class="fa fa-columns"></i><?php esc_html_e("Post Sidebars", 'lapopsi'); ?></h3>
                <p class="anps-desc"><?php esc_html_e('This will change the default sidebar value on all posts. It can be changed on each post individually.', 'lapopsi'); ?></p>
            </div>

            <!-- Left sidebar -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_select( 'anps_post_sidebar_left', $anps_style->anps_get_sidebars_array(), esc_html__('Left sidebar', 'lapopsi'), '0', '1');?>
            </div>

            <!-- Right sidebar -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_select( 'anps_post_sidebar_right', $anps_style->anps_get_sidebars_array(), esc_html__('Right sidebar', 'lapopsi'), '0', '1');?>
            </div>

            <div class="col-md-6">
                <?php $anps_style->anps_create_checkbox('anps_post_sidebar_after', esc_html__('Show sidebars on mobile after main content', 'lapopsi'));?>
            </div>

            <div class="col-md-6">
                <?php $anps_style->anps_create_checkbox('anps_post_sidebar_hide', esc_html__('Hide sidebars on mobile', 'lapopsi'));?>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-columns"></i><?php esc_html_e('Page Header', 'lapopsi'); ?></h3>
            </div>
           <!-- Enable/Disable page title and background -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_checkbox('anps_heading_status', esc_html__('Enable page heading and background', 'lapopsi'), '1');?>
            </div>
             <!-- Breadcrumbs enable/disable -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_checkbox('anps_breadcrumbs_status', esc_html__('Enable breadcrumbs', 'lapopsi'), '1');?>
            </div>

            <div class="col-md-4">
                <?php
                    $header_style_options = array(
                        'normal' => esc_html__('Normal', 'lapopsi'),
                        'large' => esc_html__('Large', 'lapopsi'),
                    );

                    $anps_style->anps_create_select('anps_page_header_style', $header_style_options, __('Page header style', 'lapopsi'), 'normal');
                ?>
            </div>

            <div class="col-md-4">
                <?php $anps_options->anps_create_number_option('anps_page_header_height', '110', esc_html__('Page header height', 'lapopsi'), 'px', '');?>
            </div>

            <div class="col-md-4">
                <?php $anps_options->anps_create_number_option('anps_page_header_lg_height', '370', esc_html__('Page header large height', 'lapopsi'), 'px', '');?>
            </div>

            <div class="col-md-4">
                <?php
                    $divider_options = array(
                        'none' => esc_html__('None', 'lapopsi'),
                        'border' => esc_html__('Border', 'lapopsi'),
                        'shadow' => esc_html__('Shadow', 'lapopsi'),
                    );
                    $anps_style->anps_create_select('anps_page_header_divider', $divider_options, __('Page header divider', 'lapopsi'), 'border');
                ?>
            </div>

            <div class="col-md-4">
                <?php
                    $anps_style->anps_create_select('anps_page_header_lg_divider', $divider_options, __('Page header large divider', 'lapopsi'), 'border');
                ?>
            </div>

        </div>

        <div class="row">
            <!-- Container width -->
            <div class="col-md-12">
                <h3><i class="fa fa-columns"></i><?php esc_html_e('Desktop Container Width', 'lapopsi'); ?></h3>
            </div>

            <div class="col-md-4">
                <?php $anps_options->anps_create_number_option('anps_container_width', '1300', '', 'px', '');?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-columns"></i><?php esc_html_e('Main content', 'lapopsi'); ?></h3>
            </div>

            <div class="col-md-4">
                <?php $anps_options->anps_create_number_option('anps_main_space_top', '70', esc_html__('Top spacing', 'lapopsi'), 'px', '');?>
            </div>

            <div class="col-md-4">
                <?php $anps_options->anps_create_number_option('anps_main_space_bottom', '70', esc_html__('Bottom spacing', 'lapopsi'), 'px', '');?>
            </div>
        </div>

        <div class="row">
            <!-- Comments on page (enable/disable) -->
            <div class="col-md-12">
                <h3><i class="fa fa-columns"></i><?php esc_html_e('Page Comments', 'lapopsi'); ?></h3>
            </div>
            <div class="col-md-4">
                <?php $anps_style->anps_create_checkbox('anps_page_comments', esc_html__('Enable page comments', 'lapopsi'), '1');?>
            </div>
            <!-- END Comments on page (enable/disable) -->
            <!-- Mobile layout -->

            <div class="col-md-12">
                <h3><i class="fa fa-columns"></i><?php esc_html_e('Blog Layout', 'lapopsi'); ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><p class="anps-desc"><?php esc_html_e('This options are used for blog, archive pages, categories and tags. All options can be overwritten in WPBakery Page Builder.', 'lapopsi'); ?></p></div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php $anps_options = array(
                    '1'=>esc_html__('1 column', 'lapopsi'),
                    '2'=>esc_html__('2 columns', 'lapopsi'),
                    '3'=>esc_html__('3 columns', 'lapopsi'),
                    '4'=>esc_html__('4 columns', 'lapopsi')
                );
                $anps_style->anps_create_select('anps_blog_columns', $anps_options, __('Columns', 'lapopsi'), '1') ;?>
            </div>
            <div class="col-md-4">
                <?php $anps_options = array(
                    'img-left' => esc_html__('Image left of text', 'lapopsi'),
                    'img-right' => esc_html__('Image right of text', 'lapopsi'),
                    'img-above' => esc_html__('Image above text', 'lapopsi'),
                );
                $anps_style->anps_create_select('anps_blog_layout', $anps_options, __('Layout', 'lapopsi'), 'img-left') ;?>
            </div>
            <div class="col-md-4">
                <?php $anps_style->anps_create_checkbox('anps_blog_shadow', esc_html__('Shadow around blog articles', 'lapopsi'), '1');?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-columns"></i><?php esc_html_e('Visual Composer', 'lapopsi'); ?></h3>
            </div>
            <div class="col-md-4">
                <?php
                    $anps_options = array(
                        'md' => esc_html__('Medium - vc_col-md', 'lapopsi'),
                        'sm' => esc_html__('Small - vc_col-sm', 'lapopsi'),
                    );
                    $anps_style->anps_create_select('anps_vc_column_class', $anps_options, __('Default column class', 'lapopsi'), 'md') ;
                ?>
            </div>
        </div>
    </div>

    <!-- Save form -->
    <?php $anps_style->anps_save_button(); ?>
</form>
