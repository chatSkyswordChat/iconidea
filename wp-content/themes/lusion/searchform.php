<?php
if (get_post_type() =='portfolio') {
    $searchTaxArray = array('portfolio_cat');
}else if (get_post_type_object( 'product' )) {
    $searchTaxArray = array('product_cat');
}else{
    $searchTaxArray = array('category');
}
?>
<form role="search" method="get"  class="searchform" action="<?php echo esc_url(home_url()); ?>">
    <div class="search-form woosearch-search">
        <div class="woosearch-input-box">
        <?php
        if (get_post_type() == 'post') : ?>
            <input autocomplete = "off" class="product-search search-input" type="search" name="s"  placeholder="<?php echo esc_attr__("Search for articles", "lusion") ?>"/>
        <?php else:  ?>
			<input autocomplete = "off" class="product-search search-input" type="search" name="s"  placeholder="<?php echo esc_attr__("Search", "lusion") ?>"/>
        <?php endif;  ?>
        </div>
		<button type="submit" class="submit btn-search">
			<span class="search-text"><?php echo esc_html__('Search','lusion'); ?></span>
			<i class="theme-icon-search"></i>
		</button>
        <?php
        if (get_post_type() == 'post') {
            echo  '<input type="hidden" name="post_type" value="post" />';
        } else if (get_post_type()=='portfolio') {
            echo  '<input type="hidden" name="post_type" value="portfolio" />';
        } else {
            if(class_exists( 'WooCommerce' )) {
                echo  '<input type="hidden" name="post_type" value="product" />';
            }
        }
        ?>
    </div>
</form>
<div class="search-results-wrapper"></div>