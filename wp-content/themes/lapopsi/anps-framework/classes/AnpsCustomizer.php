<?php
class Anps_Customizer {
    function __construct() {
        add_action('customize_register', array($this, 'customizer_register'));
    }

    public function customizer_register($wp_customize) {
        $this->wp_customize = $wp_customize;

        /* Include custom controls */
        include_once 'customizer_controls/anps_divider_control.php';
        include_once 'customizer_controls/anps_desc_control.php';
        include_once 'customizer_controls/anps_sidebar_control.php';

        /* Add theme options panel */
        $wp_customize->add_panel('anps_customizer', array(
            'title' => esc_html__('Theme Options', 'lapopsi'),
        ));

        /* Add section and options */
        $this->main_theme_colors();
        $this->typography();
        $this->page_layout();
        $this->page_setup();
        $this->header_options();
        $this->footer_options();
        $this->woocommerce();
        $this->logos();
    }

    /* Option types */

    private function color($options) {
        $wp_customize = $this->wp_customize;
        $wp_customize->add_setting($options['name'], array(
                'default' => $options['default'],
                'type' => 'option',
                'sanitize_callback' => 'sanitize_hex_color_no_hash',
                'sanitize_js_callback' => 'maybe_hash_hex_color'
            )
        );
        $wp_customize->add_control(new WP_Customize_Color_Control(
                $wp_customize,
                $options['name'],
                array(
                    'label' => $options['label'],
                    'section' => $options['section'],
                    'settings' => $options['name'],
                )
            )
        );
    }

    private function input($options) {
        $wp_customize = $this->wp_customize;

        $wp_customize->add_setting($options['name'], array(
            'default' => get_option($options['name'], $options['default']),
            'type' => 'option',
            'sanitize_callback' => 'esc_html'
        ));
        $wp_customize->add_control($options['name'], array(
            'label' => $options['label'],
            'settings' => $options['name'],
            'section' => $options['section']
        ));
    }

    private function desc($options) {
        $wp_customize = $this->wp_customize;

        $default_options = array(
            'name' => '',
            'section' => '',
            'label' => '',
            'desc' => '',
        );

        $options = array_merge($default_options, $options);

        $wp_customize->add_setting($options['name'], array(
            'type'=>'option',
            'sanitize_callback' => 'esc_html'
        ));

        $wp_customize->add_control(new Anps_Desc_Control($wp_customize, $options['name'], array(
            'section' => $options['section'],
            'settings' => $options['name'],
            'label' => $options['label'],
            'description' => $options['desc']
        )));
    }

    private function sidebar($options) {
        $wp_customize = $this->wp_customize;

        $wp_customize->add_setting($options['name'], array(
            'type' => 'option',
            'sanitize_callback' => 'esc_html'
        ));

        $wp_customize->add_control(new Anps_Sidebar_Control($wp_customize, $options['name'], array(
            'section' => $options['section'],
            'settings' => $options['name'],
            'label' => $options['label']
        )));
    }

    private function checkbox($options) {
        $wp_customize = $this->wp_customize;

        $wp_customize->add_setting($options['name'], array(
            'default' => $options['default'],
            'type' =>'option',
            'sanitize_callback' => 'esc_html'
        ));

        $wp_customize->add_control($options['name'], array(
            'section' => $options['section'],
            'type' => 'checkbox',
            'label' => $options['label'],
            'settings' => $options['name']
        ));
    }

    private function select($options) {
        $wp_customize = $this->wp_customize;

        $wp_customize->add_setting($options['name'], array(
            'default' => $options['default'],
            'type' => 'option',
            'sanitize_callback' => 'esc_html'
        ));

        $wp_customize->add_control($options['name'], array(
            'label' => $options['label'],
            'type' => 'select',
            'settings' => $options['name'],
            'section' => $options['section'],
            'choices' => $options['choices']
        ));
    }

    private function radio($options) {
        $wp_customize = $this->wp_customize;

        $wp_customize->add_setting($options['name'], array(
            'type' => 'option',
            'default' => $options['default'],
            'sanitize_callback' => 'esc_html'
        ));

        $wp_customize->add_control($options['name'], array(
            'type' => 'radio',
            'section' => $options['section'],
            'settings' => $options['name'],
            'label' => $options['label'],
            'choices' => $options['choices'],
        ));
    }

    private function pages($options) {
        $wp_customize = $this->wp_customize;

        $wp_customize->add_setting($options['name'], array(
            'default' => get_option($options['name']),
            'type' => 'option',
            'sanitize_callback' => 'esc_html'
        ));
        $wp_customize->add_control($options['name'], array(
            'label' => $options['label'],
            'type' => 'dropdown-pages',
            'settings' => $options['name'],
            'section' => $options['section']
        ));
    }

    private function image($options) {
        $wp_customize = $this->wp_customize;

        $wp_customize->add_setting($options['name'], array(
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $options['name'], array(
            'label' => $options['label'],
            'section' => $options['section'],
            'settings' => $options['name']
        )));
    }

    /* Sections and options */

    private function main_theme_colors() {
        $wp_customize = $this->wp_customize;
        $section = 'anps_main_theme_colors';

        $wp_customize->add_section($section, array(
            'title' => esc_html__('Main Theme Colors', 'lapopsi'),
            'panel' => 'anps_customizer'
        ));

        $this->color(array(
            'label'   => esc_html__('Text color', 'lapopsi'),
            'name'    => 'anps_text_color',
            'default' => '878a9d',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Page background color', 'lapopsi'),
            'name'    => 'anps_page_bg_color',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Primary color', 'lapopsi'),
            'name'    => 'anps_primary_color',
            'default' => '383e48',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Secondary color', 'lapopsi'),
            'name'    => 'anps_secondary_color',
            'default' => 'd7f4fe',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Hovers color', 'lapopsi'),
            'name'    => 'anps_hovers_color',
            'default' => '1d2128',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Headings color', 'lapopsi'),
            'name'    => 'anps_headings_color',
            'default' => '383e48',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Mobile address bar color', 'lapopsi'),
            'name'    => 'anps_mobile_toolbar_color',
            'default' => '',
            'section' => $section,
        ));
    }

    private function typography() {
        $wp_customize = $this->wp_customize;
        $section = 'anps_typography';

        $wp_customize->add_section($section, array(
            'title' => esc_html__('Typography', 'lapopsi'),
            'panel' => 'anps_customizer'
        ));

        $this->input(array(
            'label'   => esc_html__('Body font size', 'lapopsi'),
            'name'    => 'anps_body_font_size',
            'default' => '16',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Menu font size', 'lapopsi'),
            'name'    => 'anps_menu_font_size',
            'default' => '16',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Submenu font size', 'lapopsi'),
            'name'    => 'anps_submenu_font_size',
            'default' => '14',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Top bar font size', 'lapopsi'),
            'name'    => 'anps_top_bar_font_size',
            'default' => '13',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Content heading 1 font size', 'lapopsi'),
            'name'    => 'anps_h1_font_size',
            'default' => '40',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Content heading 2 font size', 'lapopsi'),
            'name'    => 'anps_h2_font_size',
            'default' => '36',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Content heading 3 font size', 'lapopsi'),
            'name'    => 'anps_h3_font_size',
            'default' => '32',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Content heading 4 font size', 'lapopsi'),
            'name'    => 'anps_h4_font_size',
            'default' => '22',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Content heading 5 font size', 'lapopsi'),
            'name'    => 'anps_h5_font_size',
            'default' => '20',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Page heading 1 font size', 'lapopsi'),
            'name'    => 'anps_page_heading_h1_font_size',
            'default' => '36',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Single blog page heading 1 font size', 'lapopsi'),
            'name'    => 'anps_blog_heading_h1_font_size',
            'default' => '36',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Footer font size', 'lapopsi'),
            'name'    => 'anps_footer_font_size',
            'default' => '16',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Copyright footer font size', 'lapopsi'),
            'name'    => 'anps_c_footer_font_size',
            'default' => '14',
            'section' => $section,
        ));
    }

    private function page_layout() {
        $wp_customize = $this->wp_customize;
        $section = 'anps_page_layout';

        $wp_customize->add_section($section, array(
            'title' => esc_html__('Page Layout', 'lapopsi'),
            'panel' => 'anps_customizer'
        ));

        /* Post Sidebars */
        $this->desc(array(
            'label'   => esc_html__('Post Sidebars', 'lapopsi'),
            'name'    => 'anps_post_sidebar_desc',
            'section' => $section,
            'desc'    => esc_html__('This will change the default sidebar value on all posts. It can be changed on each post individually.', 'lapopsi')
        ));

        $this->sidebar(array(
            'label'   => esc_html__('Post sidebar left', 'lapopsi'),
            'name'    => 'anps_post_sidebar_left',
            'section' => $section,
        ));

        $this->sidebar(array(
            'label'   => esc_html__('Post sidebar right', 'lapopsi'),
            'name'    => 'anps_post_sidebar_right',
            'section' => $section,
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Show sidebars on mobile after main content', 'lapopsi'),
            'name'    => 'anps_post_sidebar_after',
            'section' => $section,
            'default' => '',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Hide sidebars on mobile', 'lapopsi'),
            'name'    => 'anps_post_sidebar_hide',
            'section' => $section,
            'default' => '',
        ));

        /* Page Heading */

        $this->desc(array(
            'label'   => esc_html__('Page heading', 'lapopsi'),
            'name'    => 'anps_page_heading',
            'section' => $section,
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Enable page heading and background', 'lapopsi'),
            'name'    => 'anps_heading_status',
            'section' => $section,
            'default' => '',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Enable breadcrumbs', 'lapopsi'),
            'name'    => 'anps_breadcrumbs_status',
            'section' => $section,
            'default' => '',
        ));

        $this->select(array(
            'label'   => esc_html__('Page header style', 'lapopsi'),
            'name'    => 'anps_page_header_style',
            'section' => $section,
            'default' => 'normal',
            'choices' => array(
                'normal' => esc_html__('Normal', 'lapopsi'),
                'large' => esc_html__('Large', 'lapopsi'),
            )
        ));

        $this->input(array(
            'label'   => esc_html__('Page header height', 'lapopsi'),
            'name'    => 'anps_page_header_height',
            'default' => '110',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Page header large height', 'lapopsi'),
            'name'    => 'anps_page_header_lg_height',
            'default' => '370',
            'section' => $section,
        ));

        $divider_options = array(
            'none' => esc_html__('None', 'lapopsi'),
            'border' => esc_html__('Border', 'lapopsi'),
            'shadow' => esc_html__('Shadow', 'lapopsi'),
        );

        $this->select(array(
            'label'   => esc_html__('Page header divider', 'lapopsi'),
            'name'    => 'anps_page_header_divider',
            'section' => $section,
            'default' => 'border',
            'choices' => $divider_options
        ));

        $this->select(array(
            'label'   => esc_html__('Page header large divider', 'lapopsi'),
            'name'    => 'anps_page_header_lg_divider',
            'section' => $section,
            'default' => 'border',
            'choices' => $divider_options
        ));

        $this->input(array(
            'label'   => esc_html__('Desktop Container Width', 'lapopsi'),
            'name'    => 'anps_container_width',
            'default' => '1300',
            'section' => $section,
        ));

        $this->desc(array(
            'label'   => esc_html__('Main content', 'lapopsi'),
            'name'    => 'anps_main_content_title',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Top spacing', 'lapopsi'),
            'name'    => 'anps_main_space_top',
            'default' => '70',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Bottom spacing', 'lapopsi'),
            'name'    => 'anps_main_space_bottom',
            'default' => '70',
            'section' => $section,
        ));

        $this->desc(array(
            'label'   => esc_html__('Blog Layout', 'lapopsi'),
            'name'    => 'anps_blog_layout_title',
            'desc'    => esc_html__('This options are used for blog, archive pages, categories and tags. All options can be overwritten in WPBakery Page Builder.', 'lapopsi'),
            'section' => $section
        ));

        $this->select(array(
            'label'   => esc_html__('Columns', 'lapopsi'),
            'name'    => 'anps_blog_columns',
            'section' => $section,
            'default' => '1',
            'choices' => array(
                '1' => esc_html__('1 column', 'lapopsi'),
                '2' => esc_html__('2 columns', 'lapopsi'),
                '4' => esc_html__('3 columns', 'lapopsi'),
                '3' => esc_html__('4 columns', 'lapopsi')
            )
        ));

        $this->select(array(
            'label'   => esc_html__('Layout', 'lapopsi'),
            'name'    => 'anps_blog_layout',
            'section' => $section,
            'default' => 'img-left',
            'choices' => array(
                'img-left' => esc_html__('Image left of text', 'lapopsi'),
                'img-right' => esc_html__('Image right of text', 'lapopsi'),
                'img-above' => esc_html__('Image above text', 'lapopsi'),
            )
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Shadow around blog articles', 'lapopsi'),
            'name'    => 'anps_blog_shadow',
            'section' => $section,
            'default' => '1',
        ));
    }

    private function page_setup() {
        $wp_customize = $this->wp_customize;
        $section = 'anps_page_setup';

        $wp_customize->add_section($section, array(
            'title' => esc_html__('Page setup', 'lapopsi'),
            'panel' => 'anps_customizer'
        ));

        /* Home Page */

        $this->desc(array(
            'label'   => esc_html__('Home Page', 'lapopsi'),
            'name'    => 'anps_customizer_home_title',
            'section' => $section
        ));

        $this->input(array(
            'label'   => esc_html__('Slider shortcode', 'lapopsi'),
            'name'    => 'anps_slider_home_page',
            'default' => '',
            'section' => $section,
        ));

        /* Page Setup */

        $this->desc(array(
            'label'   => esc_html__('Page setup', 'lapopsi'),
            'name'    => 'anps_customizer_setup_title',
            'section' => $section
        ));

        $this->pages(array(
            'label'   => esc_html__('404 error page', 'lapopsi'),
            'name'    => 'anps_error_page',
            'section' => $section
        ));

        $this->input(array(
            'label'   => esc_html__('Excerpt length', 'lapopsi'),
            'name'    => 'anps_excerpt_length',
            'default' => '40',
            'section' => $section,
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Add "scroll to top" button', 'lapopsi'),
            'name'    => 'anps_scroll_to_top',
            'section' => $section,
            'default' => '0',
        ));

        /* Portfolio */

        $this->desc(array(
            'label'   => esc_html__('Portfolio', 'lapopsi'),
            'name'    => 'anps_customizer_portfolio_title',
            'section' => $section
        ));

        $this->input(array(
            'label'   => esc_html__('Portfolio slug', 'lapopsi'),
            'name'    => 'anps_portfolio_slug',
            'default' => '',
            'section' => $section,
        ));

        $this->select(array(
            'label'   => esc_html__('Portfolio single style', 'lapopsi'),
            'name'    => 'anps_portfolio_single',
            'section' => $section,
            'default' => 'style-1',
            'choices' => array(
                'style-1' => esc_html__('Style 1', 'lapopsi'),
                'style-2' => esc_html__('Style 2', 'lapopsi'),
                'style-3' => esc_html__('Style 3', 'lapopsi')
            )
        ));

        /* Team */

        $this->desc(array(
            'label'   => esc_html__('Team', 'lapopsi'),
            'name'    => 'anps_customizer_team_title',
            'section' => $section
        ));

        $this->input(array(
            'label'   => esc_html__('Team slug', 'lapopsi'),
            'name'    => 'anps_team_slug',
            'default' => '',
            'section' => $section,
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Team single page', 'lapopsi'),
            'name'    => 'anps_team_single_page',
            'section' => $section,
            'default' => '1',
        ));

        /* Post meta */

        $this->desc(array(
            'label'   => esc_html__('Post meta on blog / categories / tag / archive pages', 'lapopsi'),
            'name'    => 'anps_customizer_post_meta_title',
            'section' => $section
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Comments', 'lapopsi'),
            'name'    => 'anps_post_meta_comments',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Categories', 'lapopsi'),
            'name'    => 'anps_post_meta_categories',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Author', 'lapopsi'),
            'name'    => 'anps_post_meta_author',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Date', 'lapopsi'),
            'name'    => 'anps_post_meta_date',
            'section' => $section,
            'default' => '1',
        ));

        /* Post meta single */

        $this->desc(array(
            'label'   => esc_html__('Post meta on single post', 'lapopsi'),
            'name'    => 'anps_customizer_post_single_meta_title',
            'section' => $section
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Comments', 'lapopsi'),
            'name'    => 'anps_post_meta_comments_single',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Categories', 'lapopsi'),
            'name'    => 'anps_post_meta_categories_single',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Author', 'lapopsi'),
            'name'    => 'anps_post_meta_author_single',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Date', 'lapopsi'),
            'name'    => 'anps_post_meta_date_single',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Tags', 'lapopsi'),
            'name'    => 'anps_post_meta_tags_single',
            'section' => $section,
            'default' => '1',
        ));
    }

    private function header_options() {
        $wp_customize = $this->wp_customize;
        $section = 'anps_header';

        $wp_customize->add_section($section, array(
            'title' => esc_html__('Header Options', 'lapopsi'),
            'panel'=>'anps_customizer'
        ));

        $this->radio(array(
            'label'   => esc_html__('Menu layout', 'lapopsi'),
            'name'    => 'anps_menu_type',
            'section' => $section,
            'default' => 'top',
            'choices' => array(
                'top' => esc_html__('Top', 'lapopsi'),
                'bottom' => esc_html__('Bottom', 'lapopsi'),
                'vertical' => esc_html__('Vertical', 'lapopsi')
            )
        ));

        /* Menu Options */

        $this->desc(array(
            'label'   => esc_html__('Menu options', 'lapopsi'),
            'name'    => 'anps_customizer_menu_options_title',
            'section' => $section
        ));

        $this->input(array(
            'label'   => esc_html__('Menu bar height', 'lapopsi'),
            'name'    => 'anps_menu_height',
            'default' => '90',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Menu transparent bar height', 'lapopsi'),
            'name'    => 'anps_menu_transparent_height',
            'default' => '90',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Menu bar height (mobile)', 'lapopsi'),
            'name'    => 'anps_menu_mobile_height',
            'default' => '74',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Menu item spacing', 'lapopsi'),
            'name'    => 'anps_menu_spacing',
            'default' => '15',
            'section' => $section,
        ));

        /* Header Colors */

        $this->desc(array(
            'label'   => esc_html__('Header colors', 'lapopsi'),
            'name'    => 'anps_customizer_header_colors_title',
            'section' => $section
        ));

        $this->color(array(
            'label'   => esc_html__('Menu text color', 'lapopsi'),
            'name'    => 'anps_menu_text_color',
            'default' => '565656',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Menu text hover color', 'lapopsi'),
            'name'    => 'anps_menu_text_hover_color',
            'default' => '000000',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Active menu text color', 'lapopsi'),
            'name'    => 'anps_menu_text_active_color',
            'default' => '2dc1f3',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Menu background color 1', 'lapopsi'),
            'name'    => 'anps_menu_bg_color',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Menu background color 2', 'lapopsi'),
            'name'    => 'anps_menu_bg_color2',
            'default' => '',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Page header background color 1', 'lapopsi'),
            'name'    => 'anps_page_header_background_color1',
            'default' => '2cc7fc',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Page header background color 2', 'lapopsi'),
            'name'    => 'anps_page_header_background_color2',
            'default' => '049ef4',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Page title color', 'lapopsi'),
            'name'    => 'anps_page_title',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Top bar text color', 'lapopsi'),
            'name'    => 'anps_top_bar_color',
            'default' => '878a9d',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Top bar background color', 'lapopsi'),
            'name'    => 'anps_top_bar_bg_color',
            'default' => '252e42',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Submenu background color', 'lapopsi'),
            'name'    => 'anps_submenu_background_color',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Submenu text color', 'lapopsi'),
            'name'    => 'anps_submenu_text_color',
            'default' => '8c8c8c',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Submenu text hover color', 'lapopsi'),
            'name'    => 'anps_submenu_text_hover_color',
            'default' => '000000',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Submenu active text color', 'lapopsi'),
            'name'    => 'anps_submenu_text_active_color',
            'default' => '000000',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Mobile menu icons color', 'lapopsi'),
            'name'    => 'anps_menu_mobile_icons',
            'default' => '202431',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Breadcrumbs text color', 'lapopsi'),
            'name'    => 'anps_breadcrumbs_text_color',
            'default' => '999cab',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Breadcrumbs border color', 'lapopsi'),
            'name'    => 'anps_breadcrumbs_border_color',
            'default' => 'e7e7e7',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Breadcrumbs background color', 'lapopsi'),
            'name'    => 'anps_breadcrumbs_bg_color',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Search text color', 'lapopsi'),
            'name'    => 'anps_header_search_text_color',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Search background color', 'lapopsi'),
            'name'    => 'anps_header_search_background_color',
            'default' => 'ffffff',
            'section' => $section,
        ));

        /* Transparent options */

        $this->desc(array(
            'label'   => esc_html__('Transparent options', 'lapopsi'),
            'name'    => 'anps_customizer_transparent_options_title',
            'section' => $section
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Transparent header on home page', 'lapopsi'),
            'name'    => 'anps_front_transparent_header',
            'section' => $section,
            'default' => '',
        ));

        $this->color(array(
            'label'   => esc_html__('Text color', 'lapopsi'),
            'name'    => 'anps_menu_transparent_text_color',
            'default' => '',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Active menu text color', 'lapopsi'),
            'name'    => 'anps_menu_transparent_active',
            'default' => '',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Background color 1', 'lapopsi'),
            'name'    => 'anps_menu_transparent_bg_color',
            'default' => '',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Background color 2', 'lapopsi'),
            'name'    => 'anps_menu_transparent_bg2_color',
            'default' => '',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Text hover color', 'lapopsi'),
            'name'    => 'anps_menu_transparent_text_hover_color',
            'default' => '',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Top bar color', 'lapopsi'),
            'name'    => 'anps_menu_transparent_topbar_color',
            'default' => '',
            'section' => $section,
        ));

        /* Sticky menu options */

        $this->desc(array(
            'label'   => esc_html__('Sticky menu options', 'lapopsi'),
            'name'    => 'anps_customizer_sticky_menu_title',
            'section' => $section
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Sticky menu', 'lapopsi'),
            'name'    => 'anps_sticky_menu',
            'section' => $section,
            'default' => '1',
        ));

        $this->input(array(
            'label'   => esc_html__('Menu sticky bar height', 'lapopsi'),
            'name'    => 'anps_menu_sticky_height',
            'default' => '74',
            'section' => $section,
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Sticky menu mobile', 'lapopsi'),
            'name'    => 'anps_sticky_menu_mobile',
            'section' => $section,
            'default' => '',
        ));

        $this->input(array(
            'label'   => esc_html__('Menu sticky bar height (mobile)', 'lapopsi'),
            'name'    => 'anps_menu_sticky_mobile_height',
            'default' => '60',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Sticky bar background color 1', 'lapopsi'),
            'name'    => 'anps_sticky_bg',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Sticky bar background color 2', 'lapopsi'),
            'name'    => 'anps_sticky_bg2',
            'default' => '',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Sticky bar text color', 'lapopsi'),
            'name'    => 'anps_sticky_color',
            'default' => '565656',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Sticky bar text hover color', 'lapopsi'),
            'name'    => 'anps_sticky_color_hover',
            'default' => '000000',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Active menu text color', 'lapopsi'),
            'name'    => 'anps_sticky_color_active',
            'default' => '2dc1f3',
            'section' => $section,
        ));

        /* Menu button options */

        $this->desc(array(
            'label'   => esc_html__('Menu button options', 'lapopsi'),
            'name'    => 'anps_customizer_menu_button_title',
            'section' => $section
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Menu button', 'lapopsi'),
            'name'    => 'anps_menu_button',
            'section' => $section,
            'default' => '',
        ));

        $this->input(array(
            'label'   => esc_html__('Menu button text', 'lapopsi'),
            'name'    => 'anps_menu_button_text',
            'default' => '',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Menu button URL', 'lapopsi'),
            'name'    => 'anps_menu_button_url',
            'default' => '',
            'section' => $section,
        ));

        $this->select(array(
            'label'   => esc_html__('Menu button target', 'lapopsi'),
            'name'    => 'anps_menu_button_target',
            'section' => $section,
            'default' => '_self',
            'choices' => array(
                '_self' => '_self',
                '_blank' => '_blank',
                '_parent' => '_parent',
                '_top' => '_top'
            )
        ));

        /* Top bar options */

        $this->desc(array(
            'label'   => esc_html__('Top bar options', 'lapopsi'),
            'name'    => 'anps_customizer_top_bar_title',
            'section' => $section
        ));

        $this->select(array(
            'label'   => esc_html__('Top bar desktop', 'lapopsi'),
            'name'    => 'anps_top_bar_desktop',
            'section' => $section,
            'default' => 'off',
            'choices' => array(
                'off'=> esc_html__('Off', 'lapopsi'),
                'on'=> esc_html__('On', 'lapopsi'),
            )
        ));

        $this->select(array(
            'label'   => esc_html__('Top bar mobile', 'lapopsi'),
            'name'    => 'anps_top_bar_mobile',
            'section' => $section,
            'default' => 'off',
            'choices' => array(
                'off'=> esc_html__('Off', 'lapopsi'),
                'on'=> esc_html__('On', 'lapopsi'),
                'toggle'=> esc_html__('Toggle to show', 'lapopsi'),
                'menu'=> esc_html__('Inside mobile menu', 'lapopsi'),
            )
        ));

        $this->input(array(
            'label'   => esc_html__('Top bar height', 'lapopsi'),
            'name'    => 'anps_top_bar_height',
            'default' => '50',
            'section' => $section,
        ));


        /* Other header options */

        $this->desc(array(
            'label'   => esc_html__('Other header options', 'lapopsi'),
            'name'    => 'anps_customizer_top_bar_title',
            'section' => $section
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Full width header', 'lapopsi'),
            'name'    => 'anps_header_full_width',
            'section' => $section,
            'default' => '',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Display search on mobile and tablets?', 'lapopsi'),
            'name'    => 'anps_global_search_icon_mobile',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Display search icon in menu (desktop)?', 'lapopsi'),
            'name'    => 'anps_global_search_icon',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Enable menu walker (mega menu)', 'lapopsi'),
            'name'    => 'anps_global_menu_walker',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Menu shadow', 'lapopsi'),
            'name'    => 'anps_menu_shadow',
            'section' => $section,
            'default' => '1',
        ));
    }

    private function footer_options() {
        $wp_customize = $this->wp_customize;
        $section = 'anps_footer';

        $wp_customize->add_section($section, array(
            'title' => esc_html__('Footer Options', 'lapopsi'),
            'panel'=>'anps_customizer'
        ));

        /* Footer */

        $this->checkbox(array(
            'label'   => esc_html__('Enable footer', 'lapopsi'),
            'name'    => 'anps_enable_footer',
            'default' => '1',
            'section' => $section
        ));

        $this->select(array(
            'label'   => esc_html__('Footer columns', 'lapopsi'),
            'name'    => 'anps_footer_style',
            'section' => $section,
            'default' => '4',
            'choices' => array(
                '1' => esc_html__('1 column', 'lapopsi'),
                '2' => esc_html__('2 columns', 'lapopsi'),
                '3' => esc_html__('3 columns', 'lapopsi'),
                '4' => esc_html__('4 columns', 'lapopsi'),
                '4-lg' => esc_html__('4 columns (1st column larger)', 'lapopsi')
            )
        ));

        $this->select(array(
            'label'   => esc_html__('Copyright footer columns', 'lapopsi'),
            'name'    => 'anps_copyright_footer',
            'section' => $section,
            'default' => '1',
            'choices' => array(
                '1' => esc_html__('1 column', 'lapopsi'),
                '2' => esc_html__('2 columns', 'lapopsi')
            )
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Fixed footer', 'lapopsi'),
            'name'    => 'anps_fixed_footer',
            'section' => $section,
            'default' => '',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Footer shadow', 'lapopsi'),
            'name'    => 'anps_footer_shadow',
            'section' => $section,
            'default' => '',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Copyright footer shadow', 'lapopsi'),
            'name'    => 'anps_copyright_footer_shadow',
            'section' => $section,
            'default' => '',
        ));

        /* Footer Colors */

        $this->desc(array(
            'label'   => esc_html__('Footer Colors', 'lapopsi'),
            'name'    => 'anps_customizer_footer_colors_title',
            'section' => $section
        ));

        $this->color(array(
            'label'   => esc_html__('Footer background color', 'lapopsi'),
            'name'    => 'anps_footer_bg_color',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Footer text color', 'lapopsi'),
            'name'    => 'anps_footer_text_color',
            'default' => 'ffffff',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Footer hover color', 'lapopsi'),
            'name'    => 'anps_footer_hover_color',
            'default' => '',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Footer border color', 'lapopsi'),
            'name'    => 'anps_footer_border_color',
            'default' => '2e2e2e',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Footer divider color', 'lapopsi'),
            'name'    => 'anps_footer_divider_color',
            'default' => 'ebf2f6',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Footer heading text color', 'lapopsi'),
            'name'    => 'anps_footer_heading_text_color',
            'default' => '383e48',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Copyright footer text color', 'lapopsi'),
            'name'    => 'anps_c_footer_text_color',
            'default' => '9294a3',
            'section' => $section,
        ));

        $this->color(array(
            'label'   => esc_html__('Copyright footer background color', 'lapopsi'),
            'name'    => 'anps_c_footer_bg_color',
            'default' => 'fcfcfc',
            'section' => $section,
        ));
    }

    private function woocommerce() {
        $wp_customize = $this->wp_customize;
        $section = 'anps_woocommerce';

        $wp_customize->add_section($section, array(
            'title' => esc_html__('WooCommerce', 'lapopsi'),
            'panel'=>'anps_customizer'
        ));

        $this->select(array(
            'label'   => esc_html__('Display shopping cart icon in header?', 'lapopsi'),
            'name'    => 'anps_shopping_cart_header',
            'section' => $section,
            'default' => 'shop_only',
            'choices' => array(
                'hide'      => esc_html__('Never display', 'lapopsi'),
                'shop_only' => esc_html__('WooCommece pages', 'lapopsi'),
                'always'    => esc_html__('Display everywhere', 'lapopsi')
            )
        ));

        $this->select(array(
            'label'   => esc_html__('How many products in column?', 'lapopsi'),
            'name'    => 'anps_woo_products_layout',
            'section' => $section,
            'default' => 'col-md-3',
            'choices' => array(
                'col-md-3' => esc_html__('4 columns', 'lapopsi'),
                'col-md-4' => esc_html__('3 columns', 'lapopsi')
            )
        ));

        $this->input(array(
            'label'   => esc_html__('Products per page', 'lapopsi'),
            'name'    => 'anps_products_per_page',
            'default' => '12',
            'section' => $section,
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Product image zoom', 'lapopsi'),
            'name'    => 'anps_product_zoom',
            'section' => $section,
            'default' => '1',
        ));

        $this->checkbox(array(
            'label'   => esc_html__('Product image lightbox', 'lapopsi'),
            'name'    => 'anps_product_lightbox',
            'section' => $section,
            'default' => '1',
        ));
    }

    private function logos() {
        $wp_customize = $this->wp_customize;
        $section = 'anps_logos';

        $wp_customize->add_section($section, array(
            'title' => esc_html__('Logos & Media', 'lapopsi'),
            'panel' => 'anps_customizer'
        ));

        /* Logo */

        $this->desc(array(
            'label'   => esc_html__('Logo', 'lapopsi'),
            'name'    => 'anps_customizer_logo_title',
            'section' => $section
        ));

        $this->image(array(
            'label'   => esc_html__('Image', 'lapopsi'),
            'name'    => 'anps_logo',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Height', 'lapopsi'),
            'name'    => 'anps_logo_height',
            'default' => '',
            'section' => $section,
        ));

        /* Front page logo */

        $this->desc(array(
            'label'   => esc_html__('Front page Logo', 'lapopsi'),
            'name'    => 'anps_customizer_front_logo_title',
            'section' => $section
        ));

        $this->image(array(
            'label'   => esc_html__('Image', 'lapopsi'),
            'name'    => 'anps_front_logo',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Height', 'lapopsi'),
            'name'    => 'anps_front_logo_height',
            'default' => '',
            'section' => $section,
        ));

        /* Sticky logo */

        $this->desc(array(
            'label'   => esc_html__('Sticky Logo', 'lapopsi'),
            'name'    => 'anps_customizer_sticky_logo_title',
            'section' => $section
        ));

        $this->image(array(
            'label'   => esc_html__('Image', 'lapopsi'),
            'name'    => 'anps_sticky_logo',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Height', 'lapopsi'),
            'name'    => 'anps_sticky_logo_height',
            'default' => '',
            'section' => $section,
        ));

        /* Sticky logo */

        $this->desc(array(
            'label'   => esc_html__('Transparent Sticky Logo', 'lapopsi'),
            'name'    => 'anps_customizer_transparent_sticky_logo_title',
            'section' => $section
        ));

        $this->image(array(
            'label'   => esc_html__('Image', 'lapopsi'),
            'name'    => 'anps_sticky_transparent_logo',
            'section' => $section,
        ));

        $this->input(array(
            'label'   => esc_html__('Height', 'lapopsi'),
            'name'    => 'anps_sticky_transparent_logo_height',
            'default' => '',
            'section' => $section,
        ));

        /* Mobile logos */

        $this->desc(array(
            'label'   => esc_html__('Mobile logos', 'lapopsi'),
            'name'    => 'anps_customizer_mobile_logo_title',
            'section' => $section
        ));

        $this->image(array(
            'label'   => esc_html__('Mobile logo', 'lapopsi'),
            'name'    => 'anps_mobile_logo',
            'section' => $section,
        ));

        $this->image(array(
            'label'   => esc_html__('Front page mobile logo', 'lapopsi'),
            'name'    => 'anps_front_mobile_logo',
            'section' => $section,
        ));

        /* Page heading */

        $this->desc(array(
            'label'   => esc_html__('Page heading', 'lapopsi'),
            'name'    => 'anps_customizer_page_heading_title',
            'section' => $section
        ));

        $this->image(array(
            'label'   => esc_html__('Page heading background', 'lapopsi'),
            'name'    => 'anps_page_heading_bg',
            'section' => $section,
        ));

        /* Site icons */

        $this->desc(array(
            'label'   => esc_html__('Site icons', 'lapopsi'),
            'name'    => 'anps_customizer_site_icons_title',
            'section' => $section
        ));

        $this->image(array(
            'label'   => esc_html__('Favicon', 'lapopsi'),
            'name'    => 'anps_favicon',
            'section' => $section,
        ));

        $this->image(array(
            'label'   => esc_html__('Home screen icon', 'lapopsi'),
            'name'    => 'anps_home_screen_icon',
            'section' => $section,
        ));
    }
}
$anps_customizer = new Anps_Customizer();
