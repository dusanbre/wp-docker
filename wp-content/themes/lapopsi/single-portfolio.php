<?php get_header(); ?>
<?php
if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  anps_left_sidebar();
}
?>
<?php
while (have_posts()) : the_post();
  get_template_part('templates/portfolio', get_option('anps_portfolio_single', 'style-1'));
endwhile;
?>
<?php
if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  anps_right_sidebar();
}
?>
<?php
get_footer();
