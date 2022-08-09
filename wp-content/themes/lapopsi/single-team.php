<?php
get_header();
while (have_posts()) : the_post();

  $subtitle = get_post_meta(get_the_ID(), $key = 'anps_team_subtitle', $single = true);
?>
  <div class="anps-team-single">
    <div class="col-sm-6 col-md-4">
      <div class="anps-team anps-team--img-square anps-team--shadow anps-team--single">
        <?php echo anps_get_member(array(
          'show_excerpt' => true,
          'single' => true,
        )); ?>
      </div>
    </div>
    <div class="col-sm-6 col-md-8"><?php the_content(); ?></div>
  </div>
<?php endwhile; // end of the loop.
get_footer();
