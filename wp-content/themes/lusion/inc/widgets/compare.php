<?php
if (!class_exists('Apr_Core_Compare')) {
	class Apr_Core_Compare extends Apr_Widget
	{
		public function __construct()
		{
			$this->widget_cssclass = 'yith-woocompare-widget';
			$this->widget_description = esc_html__('The widget shows the list of products added in the comparison table.', 'apr-core');
			$this->widget_id = 'apr-yith-woocompare-widget';
			$this->widget_name = esc_html__('[APR] YITH WooCommerce Compare Widget', 'apr-core');
			parent::__construct();
		}

		public function apr_list_products_html($products_list = array(), $lang = false)
		{
			ob_start();

			/**
			 * WPML Suppot:  Localize Ajax Call
			 */
			global $sitepress;

			if (defined('ICL_LANGUAGE_CODE') && $lang && isset($sitepress)) {
				$sitepress->switch_lang($lang, true);
			}

			if (empty($products_list->products_list)) {
				echo '<li class="list_empty">' . esc_html__('No products to compare', 'apr-core') . '</li>';
				return ob_get_clean();
			}

			foreach ($products_list->products_list as $product_id) {
				/**
				 * @type object $product /WC_Product
				 */
				$product = $products_list->wc_get_product($product_id);
				if (!$product)
					continue;
				?>
				<li>
					<div class="product-content clearfix">
						<div class="product-top">
							<div class="product-image">
								<a href="<?php echo esc_attr(get_permalink($product_id)); ?>">
									<?php echo __($product->get_image()) ?>
								</a>
							</div>
						</div>
						<div class="product-desc">
							<h6 class="product-title">
								<a href="<?php echo esc_attr(get_permalink($product_id)); ?>">
									<?php echo esc_html($product->get_title()) ?></a>
							</h6>
							<div class="product-price">
								<?php
								$unit_price = get_post_meta($product_id, 'unit_price', true);
								if ($price_html = $product->get_price_html()) : ?>
									<p class="price">
										<?php echo wp_kses($price_html, array(
											'div' => array(
												'class' => array(),
											),
											'span' => array(
												'class' => array(),
											),
											'ins' => array(),
											'del' => array(),
										)); ?>
										<?php if ($unit_price): ?>
											<span class="unit_price">/ <?php echo esc_attr($unit_price); ?></span>
										<?php endif; ?>
									</p>
								<?php endif; ?></div>
						</div>
				</li>
				<?php
			}

			$return = ob_get_clean();

			return apply_filters('yith_woocompare_widget_products_html', $return, $products_list->products_list, $products_list);
		}

		public function widget($args, $instance)
		{
			global $yith_woocompare;

			/**
			 * WPML Support
			 */
			$lang = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : false;

			extract($args);

			do_action('wpml_register_single_string', 'Widget', 'widget_yit_compare_title_text', $instance['title']);
			$localized_widget_title = apply_filters('wpml_translate_single_string', $instance['title'], 'Widget', 'widget_yit_compare_title_text');

			echo $before_widget . $before_title . $localized_widget_title . $after_title; ?>

			<ul class="product_list_widget" data-lang="<?php echo $lang ?>">
				<?php
				echo $this->apr_list_products_html($yith_woocompare->obj); ?>
			</ul>

			<?php echo $after_widget;
		}

		public function update($new_instance, $old_instance)
		{
			$instance = $old_instance;

			$instance['title'] = strip_tags($new_instance['title']);

			return $instance;
		}

		public function form($instance)
		{
			global $woocommerce;

			$defaults = array(
				'title' => '',
			);

			$instance = wp_parse_args((array)$instance, $defaults); ?>

			<p>
				<label>
					<?php _e('Title', 'apr-core') ?>:<br/>
					<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>"
						   name="<?php echo $this->get_field_name('title'); ?>"
						   value="<?php echo $instance['title']; ?>"/>
				</label>
			</p>
			<?php
		}
	}
}