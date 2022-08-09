<?php
add_action('wp_enqueue_scripts', 'i_start_parent_theme_enqueue_styles');
/**
 * Enqueue scripts and styles.
 */
function i_start_parent_theme_enqueue_styles()
{
    wp_enqueue_style('lapopsi-style', get_stylesheet_directory_uri() . '/css/app.css', array(), false, 'all');
    wp_enqueue_script('lapopsi-js', get_stylesheet_directory_uri() . '/js/app.js', array(), false, true);

}