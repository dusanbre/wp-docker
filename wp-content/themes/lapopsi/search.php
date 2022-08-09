<?php get_header(); ?>
<div class="col-md-12">
  <div class="search-notice">
    <div class="container">
      <form method="get" role="search" action="<?php echo esc_url(home_url('/')); ?>">
        <label class="search-notice-label" for="search-form"><?php esc_html_e('Or try your luck again:', 'lapopsi'); ?></label>
        <input name="s" class="search-notice-field" type="text" id="search-form" placeholder="<?php esc_attr_e('enter your text here', 'lapopsi'); ?>">
      </form>
    </div>
  </div>

  <div class="container content-container">
    <div class="row">
      <div class="search-results">
        <div class="container">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
              <article class="search-result">
                <header>
                  <a href="<?php the_permalink(); ?>">
                    <h3 class="search-result-title"><?php the_title(); ?></h3>
                  </a>
                </header>
                <div class="search-result-content"><?php the_excerpt(); ?></div>
              </article>
            <?php
            endwhile;
            // Search page navigation.
            the_posts_pagination(array(
              'prev_text' => '<i class="fa fa-angle-left"></i> ' . esc_html__('Previous ', 'lapopsi'),
              'next_text' => esc_html__('Next', 'lapopsi') . ' <i class="fa fa-angle-right"></i>',
            ));
          else : ?>
            <div class="search-results-none text-center">
              <h3><?php esc_html_e('No results have been found for your search query', 'lapopsi'); ?></h3>
              <p><?php esc_html_e('Please try again or navigate to another page', 'lapopsi'); ?></p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer();
