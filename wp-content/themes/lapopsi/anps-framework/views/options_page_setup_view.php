<?php
//Check classes/AnpsFramework.php for available field options and settings.
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');
if (isset($_GET['save_page_setup'])) {
    $anps_options->anps_save_options("options_page_setup");
}
?>
<form action="themes.php?page=theme_options&sub_page=options_page_setup&save_page_setup" method="post">
    <div class="content-inner">
        <!-- Home page -->
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e('Home page', 'lapopsi'); ?></h3>
            </div>
            <div class="col-md-6">
                <?php $anps_style->anps_create_text_option('anps_slider_home_page', esc_html__('Slider shortcode', 'lapopsi'), esc_html__('Example: slider-1', 'lapopsi')); ?>
            </div>
        </div>
        <div class="row">
            <!-- Page setup -->
            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e('Page setup', 'lapopsi'); ?></h3>
            </div>
            <!-- Error page -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_select('anps_error_page', $anps_style->anps_get_pages_array(), esc_html__('404 error page', 'lapopsi'), '0', '1' );?>
            </div>
            <!-- Excerpt length -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_number_option('anps_excerpt_length', 40, esc_html__('Excerpt length', 'lapopsi')); ?>
            </div>
            <!-- scroll to top -->
            <div class="col-md-6">
                <?php $anps_style->anps_create_checkbox('anps_scroll_to_top', esc_html__('Add "scroll to top" button', 'lapopsi'), '0');?>
            </div>

            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e('Portfolio', 'lapopsi'); ?></h3>
            </div>

            <!-- Portfolio single style -->
             <div class="col-md-6">
                <?php $anps_style->anps_create_text_option('anps_portfolio_slug', esc_html__('Portfolio slug', 'lapopsi')); ?>
             </div>

            <div class="col-md-6">
                <?php
                $anps_styles = array(
                    'style-1' => esc_html__('Style 1', 'lapopsi'),
                    'style-2' => esc_html__('Style 2', 'lapopsi'),
                    'style-3' => esc_html__('Style 3', 'lapopsi')
                );
                $anps_style->anps_create_select('anps_portfolio_single', $anps_styles, esc_html__('Portfolio single style', 'lapopsi'), 'style-1');?>
            </div>

            <!-- Team -->
            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e('Team', 'lapopsi'); ?></h3>
            </div>
            <!-- Team slug -->
             <div class="col-md-6">
                <?php $anps_style->anps_create_text_option('anps_team_slug', esc_html__('Team slug', 'lapopsi')); ?>
             </div>
            <!-- Team member single page -->
            <div class="col-md-3">
                <?php $anps_style->anps_create_checkbox('anps_team_single_page', esc_html__('Team single page', 'lapopsi'), '1'); ?>
            </div>         
            <!-- END Team -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e('Post meta on blog / categories / tag / archive pages', 'lapopsi'); ?></h3>
            </div>
            <!-- Post meta enable/disable -->
            <?php $post_meta_arr = array(
                'anps_post_meta_comments'   => esc_html__('Comments', 'lapopsi'),
                'anps_post_meta_categories' => esc_html__('Categories', 'lapopsi'),
                'anps_post_meta_author'     => esc_html__('Author', 'lapopsi'),
                'anps_post_meta_date'       => esc_html__('Date', 'lapopsi')
            ); ?>
            <?php foreach($post_meta_arr as $key=>$item) :?>
                <div class="col-md-3">
                    <?php $anps_style->anps_create_checkbox($key, $item, '1'); ?>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-cog"></i><?php esc_html_e('Post meta on single post', 'lapopsi'); ?></h3>
            </div>
            <!-- Post meta enable/disable -->
            <?php $post_meta_arr = array(
                'anps_post_meta_comments_single'   => esc_html__('Comments', 'lapopsi'),
                'anps_post_meta_categories_single' => esc_html__('Categories', 'lapopsi'),
                'anps_post_meta_author_single'     => esc_html__('Author', 'lapopsi'),
                'anps_post_meta_date_single'       => esc_html__('Date', 'lapopsi'),
                'anps_post_meta_tags_single'       => esc_html__('Tags', 'lapopsi')
            ); ?>
            <?php foreach($post_meta_arr as $key=>$item) :?>
                <div class="col-md-3">
                    <?php $anps_style->anps_create_checkbox($key, $item, '1'); ?>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Save form -->
    <?php $anps_options->anps_save_button(); ?>
</form>
