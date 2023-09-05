<?php
/* 1: Remove Action */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories');
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary_2', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary_2', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary_2', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/* 2: Add Action */
add_action('woocommerce_shop_loop_item_title', 'lusion_woocommerce_template_loop_product_title', 10);
add_action('woocommerce_after_subcategory_title', 'lusion_description_cat_product', 12);
add_action('woocommerce_before_shop_loop_item_title', 'lusion_woocommerce_product_image', 10);
add_action('woocommerce_product_image_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_categories_left_toolbar', 'woocommerce_result_count', 10);
add_action('woocommerce_categories_view', 'lusion_woocommerce_list_view', 10);
add_action('woocommerce_categories_catalog_ordering', 'woocommerce_catalog_ordering', 10);
add_action('woocommerce_categories_filter', 'lusion_product_shop_filter', 10);
add_action('woocommerce_product_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_product_excerpt', 'lusion_woocommerce_single_excerpt', 10);

add_action('woocommerce_product_action', 'lusion_wishlist_custom', 20);
add_action('woocommerce_product_action', 'lusion_compare_product', 30);
add_action('woocommerce_product_action', 'lusion_quickview', 10);

add_action('woocommerce_product_top_action_layout_1', 'lusion_compare_product', 30);
add_action('woocommerce_product_top_action_layout_1', 'lusion_quickview', 10);
add_action('woocommerce_product_top_action_layout_1', 'lusion_wishlist_custom', 10);
add_action('woocommerce_product_top_action_layout_4', 'lusion_quickview', 10);
add_action('woocommerce_product_bottom_action_layout_1', 'lusion_wishlist_custom', 10);
add_action('woocommerce_product_bottom_action_layout_4', 'lusion_wishlist_custom', 10);
add_action('woocommerce_product_bottom_action_layout_4', 'lusion_compare_product', 10);

add_action('woocommerce_before_single_product_summary', 'lusion_video_product', 10);
add_action('woocommerce_cart_collaterals_before', 'woocommerce_cross_sell_display');
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35, 5);
add_action('woocommerce_single_product_summary', 'lusion_model_information', 8);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'lusion_size_guide_link', 9);
add_action('woocommerce_single_product_summary', 'lusion_stock_text_shop_page', 35);
add_action('woocommerce_single_product_summary', 'lusion_product_sharing', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 5);
add_action('woocommerce_single_product_summary', 'lusion_product_breadcrumbs', 3);

add_action('woocommerce_single_product_summary_2', 'lusion_product_breadcrumbs', 3);
add_action('woocommerce_single_product_summary_2', 'woocommerce_template_single_title', 4);
add_action('woocommerce_single_product_summary_2', 'woocommerce_template_single_rating', 6);
add_action('woocommerce_single_product_summary_2', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary_2', 'lusion_product_sharing', 20);
add_action('woocommerce_single_product_summary_2', 'woocommerce_template_single_excerpt', 35, 5);

add_action('woocommerce_after_single_product_summary_2', 'woocommerce_template_single_meta', 20, 5);
add_action('woocommerce_after_single_product_summary_2', 'woocommerce_template_single_add_to_cart', 40);
add_action('woocommerce_after_single_product_summary_2', 'lusion_single_wishlist_custom', 45);
add_action('woocommerce_after_single_product_summary_2', 'lusion_model_information', 8);
add_action('woocommerce_after_single_product_summary_2', 'lusion_size_guide_link', 9);
add_action('woocommerce_after_single_product_summary_2', 'lusion_stock_text_shop_page', 35);
add_action('woocommerce_after_single_product_summary_2', 'comments_template', 50);

add_action('woocommerce_single_product_summary_3', 'lusion_product_breadcrumbs', 3);
add_action('woocommerce_single_product_summary_3', 'woocommerce_template_single_title', 4);
add_action('woocommerce_single_product_summary_3', 'woocommerce_template_single_rating', 6);
add_action('woocommerce_single_product_summary_3', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary_3', 'woocommerce_template_single_excerpt', 12, 5);
add_action('woocommerce_single_product_summary_3', 'woocommerce_template_single_add_to_cart', 20);
add_action('woocommerce_single_product_summary_3', 'lusion_single_wishlist_custom', 25);
add_action('woocommerce_single_product_summary_3', 'woocommerce_template_single_meta', 30, 5);
add_action('woocommerce_single_product_summary_3', 'lusion_model_information', 35);
add_action('woocommerce_single_product_summary_3', 'lusion_stock_text_shop_page', 45);
add_action('woocommerce_single_product_summary_3', 'lusion_size_guide_link', 40);
add_action('woocommerce_single_product_summary_3', 'lusion_product_sharing', 45);


add_action('woocommerce_after_single_product_other_summary', 'lusion_single_add_elementor', 5);
add_action('woocommerce_after_single_product_other_summary', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product_other_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_widget_shopping_cart_buttons', 'lusion_woocommerce_widget_shopping_cart_proceed_to_checkout', 15);
add_action('woocommerce_info_product', 'lusion_info_product', 10);
add_action('woocommerce_sticky_single_product', 'lusion_sticky_product', 10);
/* 3: Add Filter */
add_filter('lusion_woocommerce_show_subcategories', 'woocommerce_maybe_show_product_subcategories');
add_filter('woocommerce_short_description', 'lusion_woocommerce_short_description', 10, 1);
add_filter('woocommerce_add_to_cart_fragments', 'lusion_woocommerce_header_add_to_cart_fragment', 30, 1);
add_filter('woocommerce_add_to_cart_fragments', 'lusion_woocommerce_header_add_to_cart_fragment_number', 30, 1);
add_filter('woocommerce_product_tabs', 'lusion_overide_product_tabs', 98);
add_filter('woocommerce_upsell_display_args', 'lusion_wc_change_number_related_products');
add_filter('woocommerce_output_related_products_args', 'lusion_related_products_args');

add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
	return array(
		'width'  => 570,
		'height' => 630,
		'crop'   => 0,
	);
});

add_filter('woocommerce_product_additional_information_heading', function () {
	return '';
});

add_filter('woocommerce_product_description_heading', function () {
	return '';
});

add_action('init', function () {
	// Remove the shortcode.
	remove_shortcode('add_to_cart');

	// Add it back, but using our callback.
	add_shortcode('add_to_cart', 'lusion_product_add_to_cart_shortcode');
}, 11);
function lusion_product_add_to_cart_shortcode($atts)
{
	global $post;

	if (empty($atts)) {
		return '';
	}

	$atts = shortcode_atts(
		array(
			'id'         => '',
			'class'      => '',
			'quantity'   => '1',
			'sku'        => '',
			'style'      => 'border:4px solid #ccc; padding: 12px;',
			'show_price' => 'true',
		),
		$atts,
		'product_add_to_cart'
	);

	if (!empty($atts['id'])) {
		$product_data = get_post($atts['id']);
	} elseif (!empty($atts['sku'])) {
		$product_id   = wc_get_product_id_by_sku($atts['sku']);
		$product_data = get_post($product_id);
	} else {
		return '';
	}

	$product = is_object($product_data) && in_array($product_data->post_type, array('product', 'product_variation'), true) ? wc_setup_product_data($product_data) : false;

	if (!$product) {
		return '';
	}

	ob_start();

	echo '<div class="product woocommerce add_to_cart_inline ' . esc_attr($atts['class']) . '" style="' . (empty($atts['style']) ? '' : esc_attr($atts['style'])) . '">';

	if (wc_string_to_bool($atts['show_price'])) {
		// @codingStandardsIgnoreStart
		echo $product->get_price_html();
		// @codingStandardsIgnoreEnd
	}

	woocommerce_template_loop_add_to_cart(
		array(
			'quantity' => $atts['quantity'],
		)
	);

	echo '</div>';

	// Restore Product global in case this is shown inside a product post.
	wc_setup_product_data($post);

	return ob_get_clean();
}

add_filter('woocommerce_product_reviews_tab_title', 'add_stars_to_reviews_tab_item', 98);
function add_stars_to_reviews_tab_item($title)
{
	global $product;

	$average_rating = $product->get_average_rating();

	if (!empty($average_rating) && $average_rating > 0) {
		$title = '<div>' . $title . '</div>
        <div class="stars">' . wp_kses($average_rating, lusion_allow_html()) . '</div>';
	}

	return $title;
}

function lusion_model_information()
{
	global $product;

	$model_information = get_post_meta(get_the_ID(), 'model_information', true);
	if ($model_information != '') : ?>
		<div class="model-information">
			<?php echo wp_kses($model_information, lusion_allow_html()); ?>
		</div>
	<?php endif;
}

function lusion_category_mobile()
{
	global $product;

	$lusion_product_meta       = Lusion::setting('single_product_meta_enable');
	$lusion_product_meta_multi = Lusion::setting('product_meta_multi');
	if ($lusion_product_meta) : ?>
		<?php if (isset($lusion_product_meta_multi) && in_array('categories', $lusion_product_meta_multi)) : ?>
			<div class="cate-product">
				<?php echo wc_get_product_category_list($product->get_id(), ', '); ?>
			</div>
		<?php endif; ?>
	<?php endif;
}

function lusion_product_breadcrumbs()
{
	global $post;
	$prepend = '';
	$home    = '<span>' . esc_html__('Home', 'lusion') . '</span>';
	$before  = '<li>';
	$after   = '</li>';
	echo '<ul class="single_product_breadcrumb breadcrumb ">';
	if (!empty($home)) {
		echo wp_kses($before, array('li' => array())) . '<a class="home" href="' . apply_filters('woocommerce_breadcrumb_home_url', home_url('/')) . '"><i class="' . esc_attr(Lusion::setting('icon_link')) . '"></i> ' . $home . '</a>' . $after;
	}
	echo wp_kses($prepend, lusion_allow_html());
	if ($terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'))) {
		$main_term = $terms[0];
		$ancestors = get_ancestors($main_term->term_id, 'product_cat');
		$ancestors = array_reverse($ancestors);

		foreach ($ancestors as $ancestor) {
			$ancestor = get_term($ancestor, 'product_cat');

			if (!is_wp_error($ancestor) && $ancestor) {
				echo wp_kses($before, array('li' => array())) . '<a href="' . get_term_link($ancestor) . '">' . $ancestor->name . '</a>' . $after;
			}
		}

		echo wp_kses($before, array('li' => array())) . '<a href="' . get_term_link($main_term) . '">' . $main_term->name . '</a>' . $after;
	}
	echo '</ul>';
}

function lusion_get_current_url()
{
	global $wp;
	$current_url = trailingslashit(home_url($wp->request));

	return $current_url;
}

if (function_exists('is_gutenberg_page')) {
	add_action('woocommerce_product_add_to_cart_text', 'lusion_woocommerce_product_add_to_cart_text');
}
if (!function_exists('lusion_woocommerce_product_add_to_cart_text')) {
	function lusion_woocommerce_product_add_to_cart_text()
	{
		global $product;
		if (!$product->is_in_stock()) {
			return esc_html__('Out of Stock', 'lusion');
		} elseif ($product->is_on_backorder()) {
			return esc_html__('Backorder', 'lusion');
		} else {
			$product_type = $product->get_type();
			switch ($product_type) {
				case 'simple':
					if ($product->is_virtual('yes')) {
						return esc_html__('Book now', 'lusion');
					} else {
						return esc_html__('Add to cart', 'lusion');
					}
					break;

				case 'grouped':
					return esc_html__('Buy Product', 'lusion');
					break;
				case 'external':
					return esc_html__('Buy Product', 'lusion');
					break;
				case 'variable':
					if (is_product()) {
						return esc_html__('Add to cart', 'lusion');
					} else {
						return esc_html__('Select Options', 'lusion');
					}
					break;
				default:
					return esc_html__('Read more', 'lusion');
			}
		}
	}
}
function lusion_info_product()
{
	global $product, $woocommerce_loop, $post;
	?>
	<?php if ((isset($woocommerce_loop['show_category_product']) && $woocommerce_loop['show_category_product'] === 'yes')) : ?>
		<div class="category-product">
			<?php echo get_the_term_list($post->ID, 'product_cat', ' ', ', '); ?>
		</div>
	<?php elseif (Lusion::setting('product_categories')) : ?>
		<div class="category-product">
			<?php echo get_the_term_list($post->ID, 'product_cat', ' ', ', '); ?>
		</div>
	<?php endif; ?>

	<?php
	if ($product->is_type('variable')) {
		$variations = $product->get_available_variations();
		$args       = array(
			'category' => array('category_slug')
		);

		foreach (wc_get_products($args) as $product) {

			foreach ($product->get_attributes() as $attr_name => $attr) {

				echo wc_attribute_label($attr_name); // attr label

				foreach ($attr->get_terms() as $term) {

					echo wp_kses($term->name, lusion_allow_html());
				}
			}
		}
	?>
		<div class="show-attribute">
			<?php
			foreach ($product->get_attributes() as $key => $value) {
				if (count($value['options']) > 1) {
					echo '<p>' . count($value['options']) . ' ' . wc_attribute_label($key) . 's</p>';
				}
			}
			?>
		</div>
	<?php
	}
	?>
<?php
}

//Title product
function lusion_woocommerce_template_loop_product_title()
{
	global $product, $woocommerce_loop;
?>
	<h2 class="woocommerce-loop-product__title"><a href="<?php the_permalink(); ?>" class="product-name"><?php echo get_the_title(); ?></a>
		<?php
		if (isset($woocommerce_loop['product_type']) && (isset($woocommerce_loop['show_attribute_on_title']) && $woocommerce_loop['show_attribute_on_title'] === 'yes') && (isset($woocommerce_loop['product_attr']) && $woocommerce_loop['product_attr'] !== '')) {
			$tax_attr = $woocommerce_loop['product_attr'];
			if ($product->is_type('variable')) {
				$attribute = $product->get_attribute($tax_attr);
				if ($attribute !== '') { ?>
					<span class="name-attr">
						<?php
						echo '&#40;' . $attribute . '&#41;';
						?>
					</span>
		<?php
				}
			}
		}
		?>
	</h2>
<?php
}

// Filter Archive

function lusion_product_shop_filter()
{
	$shop_archive_filter = Lusion::setting('shop_archive_filter');
?>

	<?php if (isset($shop_archive_filter) && $shop_archive_filter) : ?>
		<div class="shop-filter">
			<div class="btn-filter-product">
				<?php echo esc_html__('Filter', 'lusion'); ?> <i class="theme-icon-slider"> </i>
			</div>
		</div>
	<?php endif; ?>
	<?php
}

//Single gallery thumbs navigation
add_action('woocommerce_before_single-product-thumb', 'lusion_single_gallery_nav', 10);
function lusion_woocommerce_account_menu_items()
{
	$items = array(
		'dashboard'       => __('Account Dashboard', 'lusion'),
		'edit-account'    => __('Account Information', 'lusion'),
		'edit-address'    => __('Address Book', 'lusion'),
		'orders'          => __('My Orders', 'lusion'),
		'downloads'       => __('Downloads', 'lusion'),
		'customer-logout' => __('Logout', 'lusion'),
	);

	return $items;
}

add_filter('woocommerce_account_menu_items', 'lusion_woocommerce_account_menu_items');
add_filter('woocommerce_loop_add_to_cart_args', 'lusion_remove_rel', 10, 2);
function lusion_remove_rel($args, $product)
{
	unset($args['attributes']['rel']);

	return $args;
}

function lusion_custom_price_html()
{
	global $post;
	$sales_price_to   = get_post_meta($post->ID, '_sale_price_dates_to', true);
	$sales_price_from = get_post_meta($post->ID, '_sale_price_dates_from', true);
	$strSaleFromTo    = '';
	if ($sales_price_to != "" && $sales_price_from != "") {
		$sales_price_date_to   = date("d/m", $sales_price_to);
		$sales_price_date_from = date("d/m", $sales_price_from);
		$strSaleFromTo         = '<span class="date_from_to"> Promotion from: <span>' . $sales_price_date_from . ' - ' . $sales_price_date_to . '</span></span>';
	}
	echo wp_kses($strSaleFromTo, lusion_allow_html());
}

function lusion_image_single_product_sc()
{
	global $product, $woocommerce_loop;
	$image_product = get_post_meta(get_the_ID(), 'image_product', true);
	$image_product_id = attachment_url_to_postid($image_product);
	if ($image_product_id) : ?>
		<div class="image-product-sc">
			<?php if (wp_is_mobile()) : ?>
				<img src="<?php echo esc_url($image_product); ?>" alt="<?php echo esc_attr($product->get_title()); ?>" />
				<?php
				if (isset($woocommerce_loop['single_type']) && $woocommerce_loop['show_custom_image'] === 'yes') : ?>
					<?php
					if ($woocommerce_loop['show_custom_image'] === 'yes') {
						$has_custom_size    = false;
						$attachment_size[1] = '';
						if (!empty($woocommerce_loop['custom_dimension']['width'])) {
							$has_custom_size    = true;
							$attachment_size[0] = $woocommerce_loop['custom_dimension']['width'];
						}

						if (!empty($woocommerce_loop['custom_dimension']['height'])) {
							$has_custom_size    = true;
							$attachment_size[1] = $woocommerce_loop['custom_dimension']['height'];
						}
					}
					?>
					<?php if ($woocommerce_loop['show_custom_image'] === 'yes') :
						echo wp_get_attachment_image($image_product_id, array($attachment_size[0], $attachment_size[1]), false, array(
							'alt'  => esc_attr($product->get_title())
						));
					endif; ?>
				<?php else : ?>
					<img src="<?php echo esc_url($image_product); ?>" alt="<?php echo esc_attr($product->get_title()); ?>" />
				<?php endif; ?>
			<?php elseif (wp_is_mobile()) : ?>
				<?php
				echo wp_get_attachment_image($image_product_id, array(720, 720), false, array(
					'alt'  => esc_attr($product->get_title())
				));
				?>

			<?php else : ?>
				<?php
				if (isset($woocommerce_loop['single_type']) && $woocommerce_loop['show_custom_image'] === 'yes') : ?>
					<?php
					if ($woocommerce_loop['show_custom_image'] === 'yes') {
						$has_custom_size    = false;
						$attachment_size[1] = '';
						if (!empty($woocommerce_loop['custom_dimension']['width'])) {
							$has_custom_size    = true;
							$attachment_size[0] = $woocommerce_loop['custom_dimension']['width'];
						}

						if (!empty($woocommerce_loop['custom_dimension']['height'])) {
							$has_custom_size    = true;
							$attachment_size[1] = $woocommerce_loop['custom_dimension']['height'];
						}
					}
					?>
					<?php if ($woocommerce_loop['show_custom_image'] === 'yes') :
						echo wp_get_attachment_image($image_product_id, array($attachment_size[0], $attachment_size[1]), false, array(
							'alt'  => esc_attr($product->get_title())
						));
					?>
					<?php endif; ?>
				<?php else : ?>
					<img src="<?php echo esc_url($image_product); ?>" alt="<?php echo esc_attr($product->get_title()); ?>" />
				<?php endif; ?>
			<?php endif; ?>
			<?php lusion_percentage_price_sale(); ?>
		</div>
	<?php endif;
}

function lusion_woocommerce_list_view()
{
	$lusion_product_layout              = lusion_get_meta_value('product_layout');
	$lusion_product_columns             = lusion_get_meta_value('product_columns');
	$lusion_product_columns_layout_list = lusion_get_meta_value('product_columns_layout_list');
	if ($lusion_product_layout) {
		$lusion_product_layout = lusion_get_meta_value('product_layout');
	} else {
		$lusion_product_layout = Lusion::setting('product_layouts');
	}
	if ($lusion_product_columns) {
		$lusion_product_column = $lusion_product_columns;
	} else {
		$lusion_product_column = Lusion::setting('product_column');
	}
	if ($lusion_product_columns_layout_list) {
		$lusion_product_list_column = $lusion_product_columns_layout_list;
	} else {
		$lusion_product_list_column = Lusion::setting('product_column_list');
	}
	?>
	<div class="list-view">
		<ul class="list-view-as">
			<?php if ($lusion_product_layout == 'grid') : ?>
				<li class="four-2">
					<a class="active" href="#" id="grid4" data-layout="layout-grid" data-column="<?php echo esc_attr($lusion_product_column); ?>"><i class="theme-icon-grid"></i></a>
				</li>
			<?php endif; ?>
			<?php if ($lusion_product_layout == 'list') : ?>
				<li class="list-last">
					<a class="active" href="#" id="list1" data-layout="layout-list" data-column="<?php echo esc_attr($lusion_product_list_column); ?>"><i class="theme-icon-list"></i></a>
				</li>
			<?php endif; ?>
			<?php if ($lusion_product_layout == 'grid_list' || $lusion_product_layout == 'list_grid') : ?>
				<li class="four-2">
					<a href="#" class="<?php if ($lusion_product_layout == 'grid_list') {
											echo 'active';
										} ?>" id="grid4" data-layout="layout-grid" data-column="<?php echo esc_attr($lusion_product_column); ?>"><i class="theme-icon-grid"></i></a>
				</li>
				<li class="list-last">
					<a href="#" class="<?php if ($lusion_product_layout == 'list_grid') {
											echo 'active';
										} ?>" id="list1" data-layout="layout-list" data-column="<?php echo esc_attr($lusion_product_list_column); ?>"><i class="theme-icon-list"></i></a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
<?php
}

function lusion_percentage_price_sale()
{
	global $product, $post, $woocommerce_loop;
	$labels = '';
	if (Lusion::setting('sale_lable') && $product->is_on_sale()) {
		if (Lusion::setting('percentage_lable')) {
			$percentage = $sale_price = '';
			// Main Price
			$regular_price_min = $product->is_type('variable') ? $product->get_variation_regular_price('min', true) : $product->get_regular_price();
			$regular_price_max = $product->is_type('variable') ? $product->get_variation_regular_price('max', true) : $product->get_regular_price();
			$sale_price_min    = $product->is_type('variable') ? $product->get_variation_sale_price('min', true) : $product->get_sale_price();
			$sale_price_max    = $product->is_type('variable') ? $product->get_variation_sale_price('max', true) : $product->get_sale_price();
			if ($regular_price_min !== $sale_price_min || $regular_price_max !== $sale_price_max && $product->is_on_sale()) {
				// Percentage calculation and text
				$percentage_price_min = round(($regular_price_min - $sale_price_min) / $regular_price_min * 100);
				$percentage_price_max = round(($regular_price_max - $sale_price_max) / $regular_price_max * 100);
				if ($product->is_type('variable')) {
					if ($percentage_price_max > 0 && $percentage_price_min == 0) {
						$sales_html = '<span class="label-product on-sale percentage">' . esc_html__('-', 'lusion') . $percentage_price_max . '%</span>';
						echo wp_kses($sales_html, lusion_allow_html());
					} elseif ($percentage_price_min > 0 && $percentage_price_max == 0) {
						$sales_html = '<span class="label-product on-sale percentage">' . esc_html__('-', 'lusion') . $percentage_price_min . '%</span>';
						echo wp_kses($sales_html, lusion_allow_html());
					} else {
						$sales_html = '<span class="label-product on-sale upto">' . esc_html__('Up to ', 'lusion') . $percentage_price_max . '%</span>';
						echo wp_kses($sales_html, lusion_allow_html());
					}
				} else {
					$sale_price = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
					$sales_html = '<span class="label-product on-sale percentage">' . esc_html__('-', 'lusion') . $sale_price . '%</span>';
					echo wp_kses($sales_html, lusion_allow_html());
				}
			}
		} else {
			$sales_html = apply_filters('woocommerce_sale_flash', '<span class="label-product on-sale"><span>' . esc_html__('Sale ', 'lusion') . '</span></span>', $post, $product);
			$labels     .= $sales_html;
		}
	}
}

function lusion_woocommerce_product_image()
{
	global $product, $woocommerce_loop;
	$class_img                 = $second_image = $has_second_image = '';
	$attachment_ids            = $product->get_gallery_image_ids();
	$lusion_product_columns    = lusion_get_meta_value('product_columns');
	$custom_size_product_image = Lusion::setting('custom_size_product_image');
	$product_image_width       = Lusion::setting('product_image_width');
	$product_image_height      = Lusion::setting('product_image_height');
	if ($lusion_product_columns) {
		$lusion_product_columns = lusion_get_meta_value('product_columns');
	} else {
		$lusion_product_columns = Lusion::setting('product_column');
	}
	if (is_array($attachment_ids) && !empty($attachment_ids)) {
		$class_img        = 'img-first';
		$has_second_image = 'has-second-image';
	}
?>
	<div class="image-product <?php echo esc_attr($has_second_image); ?>">
		<?php if (isset($woocommerce_loop['product_type']) && $woocommerce_loop['show_custom_image'] === 'yes') : ?>
			<?php
			if ($woocommerce_loop['show_custom_image'] === 'yes') {
				$has_custom_size    = false;
				$attachment_size[1] = '';
				if (!empty($woocommerce_loop['custom_dimension']['width'])) {
					$has_custom_size    = true;
					$attachment_size[0] = $woocommerce_loop['custom_dimension']['width'];
				}

				if (!empty($woocommerce_loop['custom_dimension']['height'])) {
					$has_custom_size    = true;
					$attachment_size[1] = $woocommerce_loop['custom_dimension']['height'];
				}
			}
			?>

			<?php if (is_array($attachment_ids) && !empty($attachment_ids)) : ?>
				<?php if ($woocommerce_loop['show_custom_image'] === 'yes') : ?>
					<a class="img-last" href="<?php echo esc_url(get_permalink($product->get_id())); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
						<?php
						echo wp_get_attachment_image($attachment_ids[0], array($attachment_size[0], $attachment_size[1]), false, array(
							'alt'  => esc_attr($product->get_title()),
							'class' => 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail'
						));
						?>
					</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($woocommerce_loop['show_custom_image'] === 'yes') : ?>
				<a class="<?php echo esc_attr($class_img); ?>" href="<?php echo esc_url(get_permalink($product->get_id())); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
					<?php
						echo get_the_post_thumbnail(null, array($attachment_size[0], $attachment_size[1]), array(
							'alt' => esc_attr($product->get_title()),
							'class' => "attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
						));
					?>
				</a>
			<?php endif; ?>

		<?php else : ?>
			<?php
			if (count($attachment_ids) && isset($attachment_ids[0])) {
				$second_image = wp_get_attachment_image($attachment_ids[0], 'woocommerce_thumbnail');
			}
			if ($second_image != '') : ?>
				<?php if ((Lusion::setting('custom_size_product_image')) && (isset($product_image_width)) && (isset($product_image_height)) && ($product_image_width !== '') && ($product_image_height !== '')) : ?>
					<a class="img-last" href="<?php echo esc_url(get_permalink($product->get_id())); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
						<?php
						echo wp_get_attachment_image($attachment_ids[0], array($product_image_width, $product_image_height), false, array(
							'alt'  => esc_attr($product->get_title()),
							'class' => 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail'
						));
						?>
					</a>
				<?php else : ?>
					<a class="img-last" href="<?php echo esc_url(get_permalink($product->get_id())); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
						<?php echo wp_kses($second_image, array(
							'img' => array(
								'width'  => array(),
								'height' => array(),
								'src'    => array(),
								'class'  => array(),
								'alt'    => array(),
								'id'     => array(),
							)
						)); ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ((Lusion::setting('custom_size_product_image')) && (isset($product_image_width)) && (isset($product_image_height)) && ($product_image_width !== '') && ($product_image_height !== '')) : ?>
				<a class="<?php echo esc_attr($class_img); ?>" href="<?php echo esc_url(get_permalink($product->get_id())); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
					<?php
						echo get_the_post_thumbnail(null, array($product_image_width, $product_image_height), array(
							'alt' => esc_attr($product->get_title()),
							'class' => "attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
						));
					?>
				</a>

			<?php else : ?>
				<a class="<?php echo esc_attr($class_img); ?>" href="<?php echo esc_url(get_permalink($product->get_id())); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
					<?php echo woocommerce_get_product_thumbnail(); ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php
}

//Single Product
add_action('lusion_get_product_image', 'lusion_get_product_image');

function lusion_get_product_image()
{
	global $post, $product;
	$thumbnail_size    = apply_filters('woocommerce_product_thumbnails_large_size', 'full');
	$post_thumbnail_id = get_post_thumbnail_id($post->ID);
	$full_size_image   = wp_get_attachment_image_src($post_thumbnail_id, $thumbnail_size);
	$single_type       = Lusion_Templates::get_product_single_style();
?>
	<figure class="woocommerce-product-gallery__wrapper product-gallery-custom">
		<?php
		$attachment_ids = $product->get_gallery_image_ids();
		if (has_post_thumbnail()) {
			$attributes = array(
				'title'                   => get_post_field('post_title', $post_thumbnail_id),
				'data-caption'            => get_post_field('post_excerpt', $post_thumbnail_id),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2]
			);

			if (has_post_thumbnail()) {
				$html = '<div data-thumb="' . get_the_post_thumbnail_url($post->ID, 'woocommerce_single') . '" class="woocommerce-product-gallery__image"><a href="' . esc_url($full_size_image[0]) . '">';
				$html .= get_the_post_thumbnail($post->ID, 'woocommerce_single', $attributes);
				$html .= '</a></div>';
			} else {
				$html = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'lusion'));
				$html .= '</div>';
			}

			echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id($post->ID));
		}
		if ($attachment_ids && has_post_thumbnail()) { ?>
			<?php foreach ($attachment_ids as $attachment_id) {
				$full_size_image = wp_get_attachment_image_src($attachment_id, 'full');
				$thumbnail       = wp_get_attachment_image_src($attachment_id, 'woocommerce_single');
				$attributes      = array(
					'title'                   => get_post_field('post_title', $attachment_id),
					'data-caption'            => get_post_field('post_excerpt', $attachment_id),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);
				$html            = '<div data-thumb="' . esc_url($full_size_image[0]) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url($full_size_image[0]) . '">';
				$html            .= wp_get_attachment_image($attachment_id, 'woocommerce_single', false, $attributes);
				$html            .= '</a></div>';
				echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $attachment_id);
			} ?>
		<?php
		}
		?>
	</figure>
<?php
}


function lusion_single_gallery_nav()
{
	global $product;
	$gallery_ids = $product->get_gallery_image_ids();

	$single_type = Lusion_Templates::get_product_single_style();
?>
	<?php if ($single_type == 'single_1' && $gallery_ids && has_post_thumbnail()) : ?>
		<div class="product-list-thumbnails">
			<?php
			echo '<img class="no-lazyload" src="' . esc_url(lusion_resizeImage('152', '205')) . '" alt = "' . get_the_title(get_post_thumbnail_id()) . '">';
			foreach ($gallery_ids as $key => $value) {

				$image_url_2 = lusion_get_attachment($value, array(152, 205));
				echo '<img class="no-lazyload" src="' . esc_url($image_url_2['src']) . '" alt ="' . get_the_title($value) . '">';
			}
			?>
		</div>
	<?php endif; ?>
	<?php if ($single_type == 'single_3' && $gallery_ids && has_post_thumbnail()) : ?>
		<div class="product-list-thumbnails">
			<?php
			foreach ($gallery_ids as $key => $value) {
				$image_url_2 = lusion_get_attachment($value, array(545, 800));
				echo '<img class="no-lazyload" src="' . esc_url($image_url_2['src']) . '" alt ="' . get_the_title($value) . '">';
			}
			?>
		</div>
	<?php endif; ?>
<?php
}

function lusion_single_add_elementor()
{
	if (!comments_open()) {
		return;
	}
	global $comment, $product;
	$single_type = Lusion_Templates::get_product_single_style();
?>
	<?php if ($single_type == 'single_3') : ?>
		<div class="content-single-elementor">
			<?php echo the_content(); ?>
		</div>
		<div class="content-single-information">
			<h2 class="woocommerce-information-title"> <?php _e('Additional Information', 'lusion'); ?> </h2>
			<?php do_action('woocommerce_product_additional_information', $product); ?>
		</div>
		<div id="reviews" class="content-single-review woocommerce-Reviews">
			<div id="comments">
				<h2 class="woocommerce-Reviews-title"><?php
														if (get_option('woocommerce_enable_review_rating') === 'yes' && ($count = $product->get_review_count())) {
															/* translators: 1: reviews count 2: product name */
															if ($count <= 9) {
																echo "0";
															}
															printf(esc_html(_n('%1$s Reviews', '%1$s Reviews', $count, 'lusion')), esc_html($count));
														} else {
															_e('Reviews', 'lusion');
														}
														?></h2>

				<?php if (have_comments()) : ?>

					<ol class="commentlist">
						<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
					</ol>

					<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) :
						echo '<nav class="woocommerce-pagination">';
						paginate_comments_links(
							apply_filters('woocommerce_comment_pagination_args', array(
								'prev_text' => '&larr;',
								'next_text' => '&rarr;',
								'type'      => 'list',
							))
						);
						echo '</nav>';
					endif; ?>

				<?php else : ?>

					<p class="woocommerce-noreviews"><?php _e('There are no reviews yet.', 'lusion'); ?></p>

				<?php endif; ?>
			</div>
			<button class="btn btn-primary add-single-review">
				<?php if (have_comments()) : ?>
					<?php echo esc_html__('Add review', 'lusion'); ?>
				<?php else : ?>
					<?php echo esc_html__('Add first review', 'lusion'); ?>
				<?php endif; ?>
			</button>
			<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>

				<div id="review_form_wrapper">
					<div id="review_form">
						<?php
						$commenter = wp_get_current_commenter();

						$comment_form = array(
							'title_reply'         => have_comments() ? __('Write a Review', 'lusion') : sprintf(__('Be the first to review &ldquo;%s&rdquo;', 'lusion'), get_the_title()),
							'title_reply_to'      => __('Leave a Reply to %s', 'lusion'),
							'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title">',
							'title_reply_after'   => '</h3>',
							'comment_notes_after' => '',
							'fields'              => array(
								'author' => '<div class="comment-group"><p class="comment-form-author">' .
									'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . esc_attr__('Name', 'lusion') . '" size="30" required /></p>',
								'email'  => '<p class="comment-form-email">' .
									'<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . esc_attr__('Email', 'lusion') . '" size="30" required /></p></div>',
							),
							'class_submit'        => 'btn btn-primary',
							'label_submit'        => esc_html__('Submit', 'lusion'),
							'logged_in_as'        => '',
							'comment_field'       => '',
						);

						if ($account_page_url = wc_get_page_permalink('myaccount')) {
							$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a review.', 'lusion'), esc_url($account_page_url)) . '</p>';
						}

						if (get_option('woocommerce_enable_review_rating') === 'yes') {
							$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . '</label><select name="rating" id="rating" required>
                                    <option value="">' . esc_html__('Rate&hellip;', 'lusion') . '</option>
                                    <option value="5">' . esc_html__('Perfect', 'lusion') . '</option>
                                    <option value="4">' . esc_html__('Good', 'lusion') . '</option>
                                    <option value="3">' . esc_html__('Average', 'lusion') . '</option>
                                    <option value="2">' . esc_html__('Not that bad', 'lusion') . '</option>
                                    <option value="1">' . esc_html__('Very poor', 'lusion') . '</option>
                                </select></div>';
						}

						$comment_form['comment_field'] .= '<div class="form-comment"><p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr__('Review', 'lusion') . '" required></textarea></p></div>';

						comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
						?>
					</div>
				</div>

			<?php else : ?>

				<p class="woocommerce-verification-required"><?php _e('Only logged in customers who have purchased this product may leave a review.', 'lusion'); ?></p>

			<?php endif; ?>

			<div class="clear"></div>
		</div>
	<?php endif; ?>
<?php
}

function lusion_compare_product()
{
	global $product, $woocommerce_loop;
	$compare = (get_option('yith_woocompare_compare_button_in_products_list') == 'yes');
?>
	<?php
	if ((isset($woocommerce_loop['show_compare']) && $woocommerce_loop['show_compare'] === 'yes') && $compare && class_exists('YITH_Woocompare_Frontend')) {
		printf('<div class="action-item compare-product"><a data-toggle="tooltip" data-placement="top" href="%s" class="%s" data-product_id="%d"><i class="theme-icon-shuffle"></i></a><span class="tooltip-custom">' . esc_html__("Compare", "lusion") . '</span></div>', lusion_add_compare_action($product->get_id()), 'add_to_compare compare button', $product->get_id(), esc_html__('Compare', 'lusion'));
	} elseif (is_shop() || ((is_tax('product_tag') || is_tax('product_cat') || is_product() || is_tax('yith_product_brand') || is_cart()) && class_exists('WooCommerce'))) {
		if (class_exists('YITH_Woocompare_Frontend') && $compare && Lusion::setting('product_compare')) {
			printf('<div class="action-item compare-product"><a data-toggle="tooltip" data-placement="top" href="%s" class="%s" data-product_id="%d"><i class="theme-icon-shuffle"></i></a><span class="tooltip-custom">' . esc_html__("Compare", "lusion") . '</span></div>', lusion_add_compare_action($product->get_id()), 'add_to_compare compare button', $product->get_id(), esc_html__('Compare', 'lusion'));
		}
	}
	?>
<?php
}

function lusion_add_compare_action($product_id)
{
	$action   = 'yith-woocompare-add-product';
	$url_args = array('action' => $action, 'id' => $product_id);

	return wp_nonce_url(add_query_arg($url_args), $action);
}

function lusion_quickview()
{
	global $product, $woocommerce_loop, $woocommerce;
?>
	<?php
	if ((isset($woocommerce_loop['show_quickview']) && $woocommerce_loop['show_quickview'] === 'yes') && class_exists('YITH_WCQV')) {
		printf('<div data-toggle="tooltip" data-placement="top" data-original-title="' . esc_attr__('Quick View', 'lusion') . '" class="action-item quick-view"><a class="button yith-wcqv-button" href="#" data-product_id="%d" ><i class="theme-icon-search-1"></i></a><span class="tooltip-custom">' . esc_html__("Quick View", "lusion") . '</span></div>', $product->get_id(), esc_html__('Quick View', 'lusion'), esc_html__('Quick View', 'lusion'));
	} elseif (is_shop() || ((is_tax('product_tag') || is_tax('product_cat') || is_product() || is_tax('yith_product_brand') || is_cart()) && class_exists('WooCommerce'))) {
		if (class_exists('YITH_WCQV') && Lusion::setting('product_quickview')) {
			printf('<div data-toggle="tooltip" data-placement="top" data-original-title="' . esc_attr__('Quick View', 'lusion') . '" class="action-item quick-view"><a class="button yith-wcqv-button" href="#" data-product_id="%d" ><i class="theme-icon-search-1"></i></a><span class="tooltip-custom">' . esc_html__("Quick View", "lusion") . '</span></div>', $product->get_id(), esc_html__('Quick View', 'lusion'), esc_html__('Quick View', 'lusion'));
		}
	}
	?>
<?php
}

function lusion_wishlist_custom()
{
	global $woocommerce_loop;
	$lusion_product_layout = $lusion_product_type = '';
	$lusion_product_layout = lusion_get_meta_value('product_layout');
	$lusion_product_type   = lusion_get_meta_value('product_type');

	if (isset($lusion_product_layout) && $lusion_product_layout) {
		$lusion_product_layout = $lusion_product_layout;
	} else {
		$lusion_product_layout = Lusion::setting('product_layouts');
	}

	if (isset($lusion_product_type) && $lusion_product_type) {
		$lusion_product_type = $lusion_product_type;
	} else {
		$lusion_product_type = Lusion::setting('product_type');
	}
?>

	<?php if ((isset($woocommerce_loop['show_wishlist']) && $woocommerce_loop['show_wishlist'] === 'yes') && class_exists('YITH_WCWL')) : ?>
		<div class="action-item wishlist-btn">
			<span class="tooltip-custom"><?php echo esc_html__("Wishlist", "lusion"); ?></span>
			<?php
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
			?>
		</div>
	<?php elseif (is_shop() || ((is_tax('product_tag') || is_tax('product_cat') || is_product() || is_tax('yith_product_brand') || is_cart()) && class_exists('WooCommerce'))) : ?>
		<?php if (class_exists('YITH_WCWL') && Lusion::setting('product_wishlist')) : ?>
			<div class="action-item wishlist-btn">
				<span class="tooltip-custom"><?php echo esc_html__("Wishlist", "lusion"); ?></span>
				<?php
				echo do_shortcode('[yith_wcwl_add_to_wishlist]');
				?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php
}

function lusion_single_wishlist_custom()
{
	global $woocommerce_loop;
?>
	<?php if (class_exists('YITH_WCWL')) : ?>
		<?php
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		?>
	<?php endif; ?>
<?php
}

function lusion_video_product()
{
	global $product;
	$video_product = get_post_meta(get_the_ID(), 'video_product', true);
?>
	<?php if ($video_product) : ?>
		<div class="video-product">
			<a data-fancybox href="<?php echo esc_url($video_product); ?>"><i class="fas fa-play"></i></a>
		</div>
	<?php endif; ?>
<?php
}

function lusion_size_guide_link()
{
	global $product;
	$size_guide_image = lusion_get_meta_value('size_guide_image');
	if ($size_guide_image) {
		$size_guide_image = lusion_get_meta_value('size_guide_image');
	} else {
		$size_guide_image = Lusion::setting('image_size_guide');
	}
?>
	<?php if ($size_guide_image) : ?>
		<div class="size-guide-product">
			<a href="#img-size-guide" data-fancybox><?php echo esc_html__('Size Guide', 'lusion') ?></a>
		</div>
		<div id="img-size-guide">
			<div class="img-size-guide-inner">
				<img src="<?php echo esc_url($size_guide_image); ?>" alt="<?php echo esc_attr($size_guide_image); ?>" />
			</div>
		</div>
	<?php endif; ?>
<?php
}


function lusion_description_cat_product($category)
{
	$cat_id      = $category->term_id;
	$prod_term   = get_term($cat_id, 'product_cat');
	$description = $prod_term->description;

	echo '<p>' . $description . '</p>';
}

if (!function_exists('lusion_woocommerce_show_subcategories')) {

	/**
	 * Output the start of a product loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 *
	 * @return string
	 */
	function lusion_woocommerce_show_subcategories($echo = true)
	{
		ob_start();
		if ($echo) {
			echo apply_filters('lusion_woocommerce_show_subcategories', ob_get_clean());
		} else {
			return apply_filters('lusion_woocommerce_show_subcategories', ob_get_clean());
		}
	}
}
function lusion_woocommerce_header_add_to_cart_fragment_number($fragments)
{
	ob_start();

?>
	<span class="count"><?php echo WC()->cart->cart_contents_count; ?></span>
<?php
	$fragments['.shopping-cart-button .count'] = ob_get_clean();

	return $fragments;
}

function lusion_woocommerce_header_add_to_cart_fragment($fragments)
{
	$_cartQty                                                                            = WC()->cart->cart_contents_count;
	$_cartTotal                                                                          = WC()->cart->get_cart_total();
	$fragments['.cart-title .count-product-cart']                                        = '<span class="count-product-cart">' . $_cartQty . '</span>';
	$fragments['.shopping_cart .woocommerce-mini-cart__total .woocommerce-Price-amount'] = '' . $_cartTotal . '';
	$fragments['.wp-amount .cart-amount']                                                = '<div class="cart-amount">' . $_cartTotal . '</div>';

	return $fragments;
}

function lusion_woocommerce_single_excerpt()
{
	global $post;
?>
	<div class="desc">
		<?php if (isset($post->post_excerpt) && $post->post_excerpt) : ?>
			<?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
		<?php else : ?>
			<?php
			/*$tit = get_the_content('', '', FALSE);
			   echo substr($tit, 0, 290);*/
			echo get_the_content();
			?>
		<?php endif; ?>
	</div>
	<?php
}

function lusion_woocommerce_short_description($post_excerpt)
{
	$content = str_replace(']]>', ']]&gt;', $post_excerpt);

	return $content;
}

function lusion_stock_text_shop_page()
{
	global $product;
	$avail                      = esc_html__('Availability: ', 'lusion');
	$availability               = $product->get_availability();
	$lusion_product_meta_enable = Lusion::setting('single_product_meta_enable');
	$lusion_product_meta_multi  = Lusion::setting('product_meta_multi');
	if (isset($lusion_product_meta_multi) && in_array('availability', $lusion_product_meta_multi) && $lusion_product_meta_enable) {
		if ($product->is_in_stock()) {
			echo '<div class="availability"><strong>' . $avail . '</strong><span class="stock">' . $product->get_stock_quantity() . esc_html__(' In Stock', 'lusion') . '</span></div>';
		} else {
			echo '<div class="availability"><strong>' . $avail . '</strong><span class="stock">' . esc_html__(' Out Stock', 'lusion') . '</span></div>';
		}
	}
}

function lusion_product_sharing()
{
	if (Lusion::setting('single_product_sharing_enable') === '1') :
		Lusion_Templates::product_sharing();
	endif;
}

function lusion_overide_product_tabs($tabs)
{
	global $product, $post;
	$tab_review  = Lusion::setting('single_product_review');
	$tab_desc    = Lusion::setting('single_product_desc');
	$rename_info = Lusion::setting('single_product_rename_info');
	$rename_desc = Lusion::setting('single_product_rename_desc');

	if (isset($tab_desc) && $tab_desc && !empty(get_the_content())) {
		unset($tabs['description']);
	} else {
		if (isset($rename_desc) && $rename_desc != '' && $post->post_content) {
			$tabs['description']['title'] = $rename_desc;
		}
	}

	if (isset($tab_review) && $tab_review) {
		unset($tabs['reviews']);
	}

	if ($product && ($product->has_attributes() || apply_filters('wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions()))) {
		if (isset($rename_info) && $rename_info != '') {
			$tabs['additional_information']['title'] = $rename_info;
		}
	}

	return $tabs;
}

/**
 * Change number of related products output
 */
function lusion_woo_related_products_limit()
{
	global $product;

	$args['posts_per_page'] = 6;

	return $args;
}

function lusion_related_products_args($args)
{
	$related_limit          = Lusion::setting('related_limit');
	$args['posts_per_page'] = $related_limit; // 4 related products

	return $args;
}

/**
 * Change number of upsells output
 */

function lusion_wc_change_number_related_products($args)
{
	$upsell_limit           = Lusion::setting('upsell_limit');
	$args['posts_per_page'] = $upsell_limit; // Change this number
	$args['columns']        = $upsell_limit; // This is the number shown per row.

	return $args;
}

if (!function_exists('lusion_woocommerce_support')) {
	add_action('after_setup_theme', 'lusion_woocommerce_support');
	function lusion_woocommerce_support()
	{
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-lightbox');
	}
}
add_filter('woocommerce_default_address_fields', 'lusion_custom_override_default_address_field');
function lusion_custom_override_default_address_field($address_field)
{
	$array_placeholder                         = esc_html__('House number and street name *', 'lusion');
	$address_field['address_1']['placeholder'] = $array_placeholder;

	return $address_field;
}
if (!function_exists('lusion_woocommerce_widget_shopping_cart_proceed_to_checkout')) {

	/**
	 * Output the proceed to checkout button.
	 */
	function lusion_woocommerce_widget_shopping_cart_proceed_to_checkout()
	{
		echo '<a href="' . esc_url(wc_get_checkout_url()) . '" class="button checkout wc-forward">' . esc_html__('Checkout', 'lusion') . '</a>';
	}
}
if (!function_exists('lusion_sticky_product')) {
	function lusion_sticky_product()
	{
		global $post, $product;
		$thumbnail_size    = apply_filters('woocommerce_product_thumbnails_large_size', 'full');
		$post_thumbnail_id = get_post_thumbnail_id($post->ID);
		$full_size_image   = wp_get_attachment_image_src($post_thumbnail_id, $thumbnail_size);
	?>
		<div class="sticky-img">
			<?php
			$html = '';
			if (has_post_thumbnail()) {
				$attributes = array(
					'title'                   => get_post_field('post_title', $post_thumbnail_id),
					'data-caption'            => get_post_field('post_excerpt', $post_thumbnail_id),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2]
				);

				if (has_post_thumbnail()) {
					$html .= get_the_post_thumbnail($post->ID, 'thumbnail', $attributes);
				} else {
					$html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'lusion'));
				}

				echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id($post->ID));
			}
			?>
		</div>
<?php
	}
}

add_action('after_setup_theme', 'lusion_disable_wc_lightbox', 20);
function lusion_disable_wc_lightbox()
{
	remove_theme_support('wc-product-gallery-lightbox');
}

function lusion_check_for_out_of_stock_products()
{
	if (WC()->cart->is_empty()) {
		return;
	}

	$removed_products = [];

	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
		$product_obj = $cart_item['data'];

		if (!$product_obj->is_in_stock()) {
			WC()->cart->remove_cart_item($cart_item_key);
			$removed_products[] = $product_obj;
		}
	}

	if (!empty($removed_products)) {
		wc_clear_notices(); // remove any WC notice about sorry about out of stock products to be removed from cart.

		foreach ($removed_products as $idx => $product_obj) {
			$product_name = $product_obj->get_title();
			$msg          = sprintf(__("The product '%s' was removed from your cart because it is out of stock.", 'lusion'), $product_name);

			wc_add_notice($msg, 'error');
		}
	}
}

add_action('woocommerce_before_cart', 'lusion_check_for_out_of_stock_products');
