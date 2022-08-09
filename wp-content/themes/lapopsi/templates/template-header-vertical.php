<header
    class="anps-header anps-header--vertical">
    <?php get_template_part( 'templates/template', 'top-bar' ); ?>
    <div class="anps-header__wrap">
        <div class="anps-header__bar" data-height="<?php echo get_option('anps_menu_height', '90');?>px" data-m-height="<?php echo get_option('anps_menu_mobile_height', '74');?>px">
            <div class="container">
                <div class="anps-header__content">
                    <div class="anps-logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php
                            echo wp_kses(anps_logo(), array(
                                'span' => array(
                                    'class' => array(),
                                    'style' => array(),
                                ),
                                'img' => array(
                                    'class' => array(),
                                    'src' => array(),
                                    'style' => array(),
                                    'alt' => array(),
                                )
                            ));
                            ?>
                        </a>
                    </div>

                    <?php if(is_active_sidebar('large-above-menu')) : ?>
                        <div class="anps-header__widgets">
                            <?php dynamic_sidebar('large-above-menu'); ?>
                        </div>
                    <?php endif; ?>

                    <?php anps_get_menu(); ?>
                    <?php anps_get_menu_button(); ?>
                </div>
            </div><?php // container ?>
        </div><?php // site-header__bar ?>
    </div><?php // site-header__wrap ?>
</header>
