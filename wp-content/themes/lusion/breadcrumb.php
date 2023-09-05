<?php
global $product;
$breadcrumb = Lusion::setting('breadcrumb');
$page_title = Lusion::setting('page_title');
$bg_breadcrumb = Lusion::setting('general_background');
$page_titles = get_post_meta(get_the_ID(), 'page_title', true);
$breadcrumbs = get_post_meta(get_the_ID(), 'breadcrumbs', true);
$bg_breadcrumbs = get_post_meta(get_the_ID(), 'breadcrumbs_bg', true);
$bg_breadcrumb_cate = lusion_get_meta_value('image');
$bg_breadcrumb_cate_post = lusion_get_meta_value('image');
$blog_layout_list_style = Lusion::setting('blog_archive_layout_list_style' );
if(is_category() || is_tax()){
	$blog_layout_list_style = lusion_get_meta_value( 'blog_list_style', false);
	$page_title_cat = lusion_get_meta_value('page_title', true);
	if (!$page_title_cat) {
		$page_title = false;
	}else{
		$page_title = true;
	}
}else{
	if($page_titles === '1'){
		$page_title = false;
	}else{
		if ($page_title === '1') {
			$page_title = true;
		} else {
			$page_title = false;
		}
	}
}
	
if ((is_front_page() && is_home()) || is_front_page() || is_page_template('coming-soon.php')|| is_404()) {
    $breadcrumb = false;
    $page_title = false;
} else {
	if(is_category() || is_tax()){
		$breadcrumb_cat = lusion_get_meta_value('breadcrumb', true);
		if (!$breadcrumb_cat) {
			$breadcrumb = false;
		}
	}else{
		if ($breadcrumbs === '1') {
	        $breadcrumb = false;
	    }
	}
}
if (is_home() && $blog_layout_list_style === 'style_3' ){
    $breadcrumb = false;
    $page_title = false;
} 
$bg_breadcrumb_image = '';
if (is_tax('product_cat') && $bg_breadcrumb_cate !=''){
	$bg_breadcrumb_image = $bg_breadcrumb_cate;
} elseif(is_category() && $bg_breadcrumb_cate_post != ''){
	$bg_breadcrumb_image = $bg_breadcrumb_cate_post;
} else{
	if (isset($bg_breadcrumbs) && $bg_breadcrumbs != '') {
		$bg_breadcrumb_image = $bg_breadcrumbs;
	}else{
		$bg_breadcrumb_image = $bg_breadcrumb["background-image"];
	}
}
?>
<!-- Page title + breadcrumb -->
<?php if($breadcrumb == true || $page_title == true): ?>
<?php if(!is_singular('post')): ?>
<div class="side-breadcrumb <?php if($bg_breadcrumb_image !==''){echo 'breadcrumb_has_bg';}?>" style="background-image: url(<?php echo esc_url($bg_breadcrumb_image)?>);">
    <div class="container">
        <?php if($page_title == true) { ?>
            <?php if(($page_title == true) || is_404() ) :?>
                <div class="page-title">
                    <?php if(is_singular('product')):?>
                        <h2>
                            <?php echo esc_html__('Product', 'lusion'); ?>
                        </h2>
                        <?php else: ?>
                            <?php if(is_single()):?>
                                <h2>
                                <?php else:?>
                                <h1>
                            <?php endif;?>
                        <?php Lusion_Templates::page_title();?>
                            <?php if(is_single()):?>
                                </h2>
                                <?php else:?>
                                </h1>
                            <?php endif;?>
                    <?php endif; ?>
                </div>
            <?php endif?>
        <?php } ?>
        <?php if ($breadcrumb):?>
            <div class="breadcrumbs">
                <?php Lusion_Templates::breadcrumbs(); ?>
            </div>
        <?php endif;?>	   
    </div>
</div>
<?php endif; ?>
<?php endif; ?>

