<?php
$footer_columns = get_option('anps_footer_style', '4');
$copyright_footer = get_option('anps_copyright_footer', '1');

$copyright_footer_class = 'copyright-footer';

if (get_option('anps_copyright_footer_shadow', '0') === '1') {
    $copyright_footer_class .= ' copyright-footer--shadow';
}
?>

<?php //actual HTML output ?>

<?php if (is_active_sidebar('footer-1') ||
          is_active_sidebar('footer-2') ||
          is_active_sidebar('footer-3') ||
          is_active_sidebar('footer-4') ||
          is_active_sidebar('copyright-1') ||
          is_active_sidebar('copyright-2')
        ) : ?>
<footer class="site-footer">
    <?php //Footer
    if(get_option('anps_enable_footer', '1') == "1") : ?>
    <?php if (get_option('anps_footer_shadow', '0') === '1'): ?>
        <div class="site-footer__shadow"><?php echo anps_svg('footer-shadow'); ?></div>
    <?php endif; ?>
    <div class="container">
        <div class="site-footer__main">

            <div class="row">
                <?php if($footer_columns=='1') : ?>
                    <div class="col-md-12"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                <?php elseif($footer_columns=='2') : ?>
                    <div class="col-md-6"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <div class="col-md-6"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                <?php elseif($footer_columns=='3') : ?>
                    <div class="col-md-4"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <div class="col-md-4"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                    <div class="col-md-4"><?php dynamic_sidebar( 'footer-3' ); ?></div>
                <?php elseif($footer_columns=='4') : ?>
                    <div class="col-md-3"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <div class="col-md-3"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                    <div class="col-md-3"><?php dynamic_sidebar( 'footer-3' ); ?></div>
                    <div class="col-md-3"><?php dynamic_sidebar( 'footer-4' ); ?></div>
                <?php elseif($footer_columns=='4-lg') : ?>
                    <div class="site-footer__col site-footer__col--lg"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <div class="site-footer__col"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                    <div class="site-footer__col"><?php dynamic_sidebar( 'footer-3' ); ?></div>
                    <div class="site-footer__col"><?php dynamic_sidebar( 'footer-4' ); ?></div>
                <?php elseif($footer_columns=='5') : ?>
                    <div class="col-md-4"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                    <div class="col-md-2"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                    <div class="col-md-2"><?php dynamic_sidebar( 'footer-3' ); ?></div>
                    <div class="col-md-2"><?php dynamic_sidebar( 'footer-4' ); ?></div>
                    <div class="col-md-2"><?php dynamic_sidebar( 'footer-5' ); ?></div>
              <?php endif; ?>
        </div>
       </div>
    </div>
    <?php endif; ?>

<?php if (is_active_sidebar('copyright-1') || is_active_sidebar( 'copyright-2' )) : ?>
    <div class="<?php echo esc_attr($copyright_footer_class); ?>">
        <div class="container">
            <div class="copyright-footer__row">
                <?php if($copyright_footer=="1") : ?>
                    <div class="text-center col-md-12"><?php dynamic_sidebar( 'copyright-1' ); ?></div>
                <?php elseif($copyright_footer=="2") : ?>
                    <div class="copyright-footer__col"><?php dynamic_sidebar( 'copyright-1' ); ?></div>
                    <div class="copyright-footer__col copyright-footer__col--right"><?php dynamic_sidebar( 'copyright-2' ); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif;?>
</footer>
<?php endif;?>
