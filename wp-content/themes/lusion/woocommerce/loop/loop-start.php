<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $woocommerce_loop, $lusion_product_layout, $lusion_product_type;
$lusion_product_layout = $lusion_product_type = $lusion_product_column ='';
$lusion_pagination_type = lusion_get_meta_value('pagination_type');
$lusion_product_columns_cat = lusion_get_meta_value('product_columns');
$lusion_product_columns_layout_list_cat = lusion_get_meta_value('product_columns_layout_list');
$lusion_product_columns_layout_customize = Lusion::setting('product_column');
$lusion_product_columns_layout_list_customize = Lusion::setting('product_column_list');
$lusion_product_layout_cat = lusion_get_meta_value('product_layout');
$lusion_product_layout_customize = Lusion::setting('product_layouts');
$lusion_product_type_cat = lusion_get_meta_value('product_type');
$lusion_product_type_customize = Lusion::setting('product_type');
$lusion_product_type_product_other = Lusion::setting('other_product_type');

if(shortcode_exists('product') && isset($woocommerce_loop['product_layout'])){
	$lusion_product_layout = $woocommerce_loop['product_layout']; 
}elseif(is_product_category() && isset($lusion_product_layout_cat) && $lusion_product_layout_cat){
    $lusion_product_layout = $lusion_product_layout_cat;
}else{
    $lusion_product_layout = Lusion::setting('product_layouts');
}

if(shortcode_exists('product') && isset($woocommerce_loop['product_column_number'])){
	$lusion_product_column = $woocommerce_loop['product_column_number'];
}elseif(class_exists('WooCommerce') && 'product' == get_post_type()){
	if($lusion_product_layout === 'list' || $lusion_product_layout ==='list_grid'){
		if($lusion_product_columns_layout_list_cat && $lusion_product_columns_layout_list_cat != 'default'){
			$lusion_product_column = $lusion_product_columns_layout_list_cat;
		}else{
			$lusion_product_column = $lusion_product_columns_layout_list_customize;
		}
		
	}elseif($lusion_product_layout === 'grid' || $lusion_product_layout ==='grid_list'){
		if($lusion_product_columns_cat && $lusion_product_columns_cat != 'default'){
			$lusion_product_column = $lusion_product_columns_cat;
		}else{
			$lusion_product_column = $lusion_product_columns_layout_customize;
		}
	}
}elseif(!shortcode_exists('product')) {
    if($lusion_product_columns_layout_list_customize && ($lusion_product_layout === 'list' || $lusion_product_layout ==='list_grid')){
		$lusion_product_column = $lusion_product_columns_layout_list_customize;
	}elseif($lusion_product_columns_layout_customize && ($lusion_product_layout === 'grid' || $lusion_product_layout ==='grid_list')){
		$lusion_product_column = $lusion_product_columns_layout_customize;
	}
}
if($lusion_pagination_type && isset($lusion_pagination_type) ){
	$pagination_type = $lusion_pagination_type;
}else{
	$pagination_type = Lusion::setting('pagination_type');
}

if(is_singular('product')) {
	if($lusion_product_type_product_other && $lusion_product_type_product_other != 'default' )  {
		$lusion_product_type = $lusion_product_type_product_other;
	}else{
		$lusion_product_type = $lusion_product_type_customize;
	}
}elseif(shortcode_exists('product') && isset($woocommerce_loop['product_type'])){
	$lusion_product_type = $woocommerce_loop['product_type']; 
}elseif(is_product_category()){
	if(isset($lusion_product_type_cat) && $lusion_product_type_cat && $lusion_product_type_cat != "default"){ 
		$lusion_product_type = $lusion_product_type_cat;
	}else{
		$lusion_product_type = $lusion_product_type_customize;
	}
}else{
	$lusion_product_type = $lusion_product_type_customize;
}
$class_style = $class_product = '';

if($lusion_product_layout === 'list' || $lusion_product_layout ==='list_grid' || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] === 'list')){
	$class_product = 'product-list';
} else{
	$class_product = 'product-grid';		
}
if($lusion_product_layout != 'list' || $lusion_product_layout ==='list_grid' || $lusion_product_layout ==='grid_list' || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] != 'list')){
	if ($lusion_product_type == 1 ) {
	$class_style = ' product-style-1';
	}elseif ($lusion_product_type == 2 ) {
		$class_style = ' product-style-2';
	}elseif ($lusion_product_type == 3 ) {
		$class_style = ' product-style-3';
	}elseif ($lusion_product_type == 4 ) {
		$class_style = ' product-style-4';
	}elseif ($lusion_product_type == 5 ) {
		$class_style = ' product-style-1  product-style-5';
	}elseif ($lusion_product_type == 6 ) {
		$class_style = ' product-style-6';
	}elseif ($lusion_product_type == 7) {
		$class_style = 'product-style-7';
	} else{
		$class_style = 'product-style-default';
	}
}

?>

<div class="product-style <?php echo esc_attr($class_style); ?>">
	
<ul class="products  <?php echo esc_attr($class_product); ?> columns-<?php echo esc_attr($lusion_product_column); ?> pagination_<?php echo esc_attr($pagination_type); ?>">