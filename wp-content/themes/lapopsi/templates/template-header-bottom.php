<header
    class="anps-header anps-header--bottom <?php echo anps_transparent_class('anps-header'); ?>
    <?php echo anps_is_bellowmenu(); ?>
    <?php echo anps_menu_is_centered(); ?>">
    <?php get_template_part( 'templates/template', 'top-bar' ); ?>
    <div class="anps-header__wrap">
        <div class="anps-header__bar" data-height="<?php echo get_option('anps_menu_height', '90');?>px" data-m-height="<?php echo get_option('anps_menu_mobile_height', '74');?>px" data-height-scroll="<?php echo get_option('anps_menu_sticky_height', '90');?>px">
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

                    <?php anps_get_menu(); ?>
                    <?php anps_get_menu_button(); ?>
                </div>
            </div><?php // container ?>
        </div><?php // site-header__bar ?>
    </div><?php // site-header__wrap ?>
</header>
