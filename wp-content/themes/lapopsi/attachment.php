<?php get_header(); ?>
<?php 
if(in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    anps_left_sidebar(); 
}
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
        $num_of_sidebars = 0;
        if(in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            $num_of_sidebars = anps_num_sidebars();
        }
        $class = '';

        if( $num_of_sidebars > 0 ) {
            $class = 'page-content';
        }
    ?>
    <div class="<?php echo esc_attr($class); ?> col-md-<?php echo 12-esc_attr($num_of_sidebars)*3; ?>">
        <a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>"><?php echo wp_get_attachment_image(get_the_ID(), 'full'); ?></a>
    </div>
   <?php endwhile; // end of the loop. ?>
<?php 
if(in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    anps_right_sidebar();
}
?>
<?php get_footer();