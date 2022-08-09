<?php 
$is_hidden = get_post_meta(get_queried_object_id(), $key ='anps_disable_heading', $single = true ); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post--single'); ?>>
    <?php if (has_post_thumbnail()): ?>
    <header class="entry-header">
        <div class="post__img">
            <?php anps_header_media(get_the_id(), 'full'); ?>
        </div>
        <?php if(get_option('anps_heading_status', '1') != '1' || $is_hidden == '1') : ?>
            <h1 class="page-title"><?php anps_page_title(); ?></h1>
            <?php echo anps_post_meta('single', $id, ' post-meta--content'); ?>
        <?php endif; ?>
    </header>
    <?php endif; ?>
    <div class="post__content entry-content">
        <div class="post__desc clearfix">
            <?php the_content(); ?>
        </div>
    </div>

    <?php
        wp_link_pages(array(
            'before'           => '<div class="nav-links-sm">' . __( 'Pages:', 'lapopsi' ),
            'after'            => '</div>',
            'next_or_number'   => 'number',
            'separator'        => ' ',
            'pagelink'         => '%',
	    ));
    ?>

    <footer class="post__footer entry-footer">
        <?php if (get_the_tag_list() !== false): ?>
        <div class="post-tags">
            <div class="post-tags__title"><?php esc_html_e( 'Tags', 'lapopsi' ); ?></div>
            <div class="post-tags__items">
                <?php echo get_the_tag_list('', '', ''); ?>
            </div>
        </div>
        <?php endif; ?>
        <!-- Post Author -->
        <?php if( get_the_author_meta('description') ): ?>
        <div class="post-author">
            <div class="post-author__img">
                <?php echo get_avatar(get_the_author_meta('ID'), 99); ?>
            </div>
            <div class="post-author__content">
                <span class="post-author__title"><?php esc_html_e( 'By', 'lapopsi' ); ?> <strong><?php the_author(); ?></strong></span>
                <p class="post-author__desc"><?php the_author_meta('description'); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </footer>
</article>
