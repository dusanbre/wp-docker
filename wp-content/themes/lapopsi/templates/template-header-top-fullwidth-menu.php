<?php get_template_part( 'templates/template', 'top-bar' ); ?>

<header class="anps-header anps-header--top-fullwidth-menu<?php echo anps_header_full_width(); ?><?php echo anps_menu_border(); ?><?php echo anps_transparent_class('anps-header'); ?>
    <?php echo anps_is_bellowmenu(); ?>
    <?php echo anps_menu_is_centered(); ?>">

    <div class="anps-header__main" data-height="<?php echo get_option('anps_menu_height', '90');?>px" data-m-height="<?php echo get_option('anps_menu_mobile_height', '74');?>px">
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
                <div class="anps-large-above-menu">
                    <?php if(is_active_sidebar('large-above-menu')) : ?>
                        <div class="anps-header__widgets">
                            <?php dynamic_sidebar('large-above-menu'); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo anps_menu_button('div', 'menu-button'); ?>

                    <?php anps_get_menu_button(); ?>
                </div>
            </div>
        </div><?php // container ?>
    </div><?php // anps-header__main ?>
    <div class="anps-header__wrap">
        <div class="anps-header__bar" data-height="56px" data-m-height="0" data-height-scroll="56px">
            <div class="container">
                <?php anps_get_menu(); ?>
            </div>
        </div><?php // site-header__bar ?>
    </div><?php // site-header__wrap ?>
</header>
