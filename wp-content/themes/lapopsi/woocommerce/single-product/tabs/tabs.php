<?php

/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) : ?>

	<div class="tabs tabs-default tabs-small">
		<div class="nav-tabs-wrap">
			<ul class="nav nav-tabs" role="tablist">
				<?php $first_tab = true; ?>
				<?php foreach ($product_tabs as $key => $product_tab) : ?>
					<?php
					$class = $key;

					if ($first_tab) {
						$class .= ' active';
						$first_tab = false;
					}
					?>
					<li role="presentation" class="<?php echo esc_attr($class); ?>">
						<a href="#tab-<?php echo esc_attr($key); ?>" aria-controls="#tab-<?php echo esc_attr($key); ?>" role="tab" data-toggle="tab"><?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', esc_html($product_tab['title']), $key); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="tab-content">
			<?php $first_tab = true; ?>
			<?php foreach ($product_tabs as $key => $product_tab) : ?>
				<?php
				$class = 'tab-pane';

				if ($first_tab) {
					$class .= ' active';
					$first_tab = false;
				}
				?>
				<div role="tabpanel" class="<?php echo esc_attr($class); ?>" id="tab-<?php echo esc_attr($key); ?>">
					<?php call_user_func($product_tab['callback'], $key, $product_tab); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>