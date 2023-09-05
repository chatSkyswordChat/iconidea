<?php
$get_left_sidebar = Lusion_Global::get_left_sidebar();
$get_right_sidebar = Lusion_Global::get_right_sidebar();
$filter_top_product = lusion_get_meta_value('filter_top_product');
$shop_archive_filter_top = Lusion::setting('shop_archive_filter_top');
$product_banner = Lusion::setting('product_banner');
$lusion_tempalte_cate = lusion_get_meta_value('select_template');
$show_hide_banner = Lusion::setting('show_hide_banner');
$banner_page_shop = lusion_get_meta_value('banner_page_shop');
$class_has_banner = '';
if ($lusion_tempalte_cate !== '' && $lusion_tempalte_cate != '0' && !$banner_page_shop) {
    $class_has_banner = 'has-banner-product';
} else {
    if ($product_banner !== '' && $product_banner != '0' && $show_hide_banner == 1 && !$banner_page_shop) {
        $class_has_banner = 'has-banner-product';
    }
}
if (($filter_top_product || $shop_archive_filter_top) && (($get_left_sidebar !== 'none' && $get_right_sidebar == 'none') || ($get_left_sidebar == 'none' && $get_right_sidebar !== 'none'))) :
    if(is_tax('product_cat') || (is_shop() || ((is_tax('product_tag') || is_tax('yith_product_brand')) && class_exists('WooCommerce')))){
        $get_right_sidebar = 'none';
    }
endif;
if ( $get_right_sidebar  !== 'none' && $get_right_sidebar !== '' && is_active_sidebar($get_right_sidebar)):?>
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 right-sidebar active-sidebar <?php echo esc_attr($class_has_banner); ?>">
	    <div class="sticky-sidebar">
	    	<h3 class="tlt-filter"><?php echo esc_html__('Filter Options', 'lusion'); ?></h3>
	    	<?php dynamic_sidebar($get_right_sidebar); ?>
	    </div>
    </div>
<?php endif;?>