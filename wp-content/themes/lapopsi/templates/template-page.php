<?php
$meta = get_post_meta(get_the_ID());
?>

<?php
while (have_posts()) : the_post(); ?>
    <?php 
    if(in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        anps_left_sidebar(); 
    }
    ?>

    <?php anps_the_content(); ?>

    <?php 
    if(in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        anps_right_sidebar();
    }
    ?>
<?php endwhile; // end of the loop. 