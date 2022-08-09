<?php get_header(); ?>

<?php
if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  anps_left_sidebar();
}
?>
<?php
$num_of_sidebars = 0;
if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  $num_of_sidebars = anps_num_sidebars();
}
$class = '';

if ($num_of_sidebars > 0) {
  $class = 'page-content';
}
?>
<div class="<?php echo esc_attr($class); ?> col-md-<?php echo 12 - esc_attr($num_of_sidebars) * 3; ?>">
  <div class="row anps-blog">
    <?php $bloglayout = get_option('anps_blog_columns', '1'); ?>
    <?php if (have_posts()) {
      while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content-blog', $bloglayout); ?>
      <?php endwhile; // end of the loop.
      ?>
  </div>
<?php the_posts_pagination(array(
        'prev_text' => '<i class="fa fa-angle-left"></i> ' . esc_html__('Previous ', 'lapopsi'),
        'next_text' => esc_html__('Next', 'lapopsi') . ' <i class="fa fa-angle-right"></i>',
      ));
    }
?>
</div>
<?php
if (in_array('anps_theme_plugin/anps_theme_plugin.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  anps_right_sidebar();
}
?>
<?php get_footer();
