<?php

class AnpsDownload extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'AnpsDownload', esc_html__('AnpsThemes - Download', 'anps_theme_plugin'), array('description' => esc_html__('Choose a image to show on page', 'anps_theme_plugin'),)
        );
        add_action( 'admin_enqueue_scripts', array( $this, 'anps_enqueue_scripts' ) );
        add_action( 'admin_footer-widgets.php', array( $this, 'anps_print_scripts' ), 9999 );
    }
    
    public static function anps_register_widget() {
        return register_widget("AnpsDownload");
    }

    function anps_enqueue_scripts( $hook_suffix ) {
        wp_enqueue_style('fontawesome');
    }

    function anps_print_scripts() {
        ?>
        <script>
            jQuery(function($) {
                $(document).on('widget-added widget-updated', anpsColorPickerUpdate);
                $(document).ready(anpsColorPickerReady);
            });
        </script>
        <?php
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'file' => '', 'file_title' => '', 'icon'=>'', 'icon_color'=>'', 'bg_color'=>'', 'file_external'=>''));

        $file = $instance['file'];
        $file_external = $instance['file_external'];
        $title = $instance['title'];
        $file_title = $instance['file_title'];
        $icon = $instance['icon'];
        $icon_color = $instance['icon_color'];
        $text_color = $instance['text_color'];
        $bg_color = $instance['bg_color'];
        ?>
        <!-- Widget title -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e("Title", 'anps_theme_plugin'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <!-- File title -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('file_title')); ?>"><?php esc_html_e("File title", 'anps_theme_plugin'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('file_title')); ?>" name="<?php echo esc_attr($this->get_field_name('file_title')); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['file_title']); ?>" />
        </p>
        <!-- File -->
        <p>
            <?php $files = get_children('post_type=attachment'); ?>
            <label for="<?php echo esc_attr($this->get_field_id('file')); ?>"><?php esc_html_e("File", 'anps_theme_plugin'); ?></label><br />
            <select id="<?php echo esc_attr($this->get_field_id('file')); ?>" name="<?php echo esc_attr($this->get_field_name('file')); ?>">
                <option value=""><?php esc_html_e("Select a file", 'anps_theme_plugin'); ?></option>
                <?php foreach ($files as $item) : ?>
                    <option <?php if ($item->guid == $file) {
                        echo 'selected="selected"';
                    } ?> value="<?php echo esc_attr($item->guid); ?>"><?php echo esc_html($item->post_title); ?></option>
            <?php endforeach; ?>
            </select>
        </p>
        <!-- Icon -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php esc_html_e("Icon", 'anps_theme_plugin'); ?></label><br />
            <div class="anps-iconpicker">
                <i class="fa <?php echo esc_attr($icon); ?>"></i>
                <input type="text" value="<?php echo esc_attr($icon); ?>" id="<?php echo esc_attr($this->get_field_id('icon')); ?>" name="<?php echo esc_attr($this->get_field_name('icon')); ?>">
                <button type="button"><?php esc_html_e('Select icon', 'anps_theme_plugin'); ?></button>
            </div>
        </p>
        <!-- Icon color -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon_color')); ?>"><?php esc_html_e("Icon color", 'anps_theme_plugin'); ?></label><br />
            <input class="anps-color-picker" id="<?php echo esc_attr($this->get_field_id('icon_color')); ?>" name="<?php echo esc_attr($this->get_field_name('icon_color')); ?>" type="text" value="<?php echo esc_attr($instance['icon_color']); ?>" />
        </p>
        <!-- Icon color -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text_color')); ?>"><?php esc_html_e("Text color", 'anps_theme_plugin'); ?></label><br />
            <input class="anps-color-picker" id="<?php echo esc_attr($this->get_field_id('text_color')); ?>" name="<?php echo esc_attr($this->get_field_name('text_color')); ?>" type="text" value="<?php echo esc_attr($instance['text_color']); ?>" />
        </p>
        <!-- Background color -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('bg_color')); ?>"><?php esc_html_e("Background color", 'anps_theme_plugin'); ?></label><br />
            <input class="anps-color-picker" id="<?php echo esc_attr($this->get_field_id('bg_color')); ?>" name="<?php echo esc_attr($this->get_field_name('bg_color')); ?>" type="text" value="<?php echo esc_attr($instance['bg_color']); ?>" />
        </p>
        <!-- File external -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('file_external')); ?>"><?php esc_html_e("File external", 'anps_theme_plugin'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('file_external')); ?>" name="<?php echo esc_attr($this->get_field_name('file_external')); ?>" type="text" class="widefat" value="<?php echo esc_attr($instance['file_external']); ?>" />
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['file'] = $new_instance['file'];
        $instance['file_external'] = $new_instance['file_external'];
        $instance['title'] = $new_instance['title'];
        $instance['file_title'] = $new_instance['file_title'];
        $instance['icon'] = $new_instance['icon'];
        $instance['icon_color'] = $new_instance['icon_color'];
        $instance['text_color'] = $new_instance['text_color'];
        $instance['bg_color'] = $new_instance['bg_color'];
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );

        /* File */
        $file = '';
        if( isset($instance['file']) ) {
           $file = $instance['file'];
        }

        /* File external */
        $file_external = '';
        if( isset($instance['file_external']) ) {
           $file_external = $instance['file_external'];
        }

        /* File title */
        $file_title = '';
        if( isset($instance['file_title']) ) {
           $file_title = $instance['file_title'];
        }

        $icon = $instance['icon'];
        $icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : '';
        $text_color = isset($instance['text_color']) ? $instance['text_color'] : '';
        $bg_color = isset($instance['bg_color']) ? $instance['bg_color'] : '';

        if($file) {
            $file_url = $file;
        } elseif($file_external) {
            $file_url = $file_external;
        } else {
            $file_url = "#";
        }

        echo $before_widget;
        ?>

        <?php if($title) : ?>
            <h3 class="widget-title"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>
            <div class="download">
                <a class="download__link" href="<?php echo esc_url($file_url); ?>" target="_blank" style="background-color: <?php echo esc_attr($bg_color); ?>">
                    <span class="download__title" <?php echo anps_style_color($text_color); ?>>
                        <?php echo esc_html($file_title); ?>
                        <?php if ($icon !== ''): ?>
                        <span class="download__icon"><i class="fa <?php echo esc_attr($icon); ?>" style="color: <?php echo esc_attr($icon_color); ?>"></i></span>
                        <?php endif; ?>
                    </span>
                </a>
            </div>
        <?php
        echo $after_widget;
    }
}

add_action( 'widgets_init', array('AnpsDownload', 'anps_register_widget') );
