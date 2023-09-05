<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5"/>
<!-- 	<meta name="description" content="<?php bloginfo('description'); ?>"> -->
	<?php if(Lusion::setting('googlebot_enable')) :?>
    <meta name="googlebot" content="noindex">
	<?php endif; ?>
    <link rel="profile" href="//gmpg.org/xfn/11" />
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/webfonts/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/webfonts/lusion.woff?40uiqo" as="font" type="font/woff" crossorigin="anonymous" />
    <?php wp_head(); ?>
</head>
<?php
$lusion_site_layout = get_post_meta(get_the_ID(), 'site_layout', true);
$lusion_hide_header = get_post_meta(get_the_ID(), 'hide_header', true);

if(is_category() || is_tax()){
    $lusion_hide_header_cat = lusion_get_meta_value('hide_header', true);
    if (!$lusion_hide_header_cat) {
        $lusion_hide_header = true;
    }
}
$container = Lusion_Global::check_container_type();
?>
<body <?php body_class(); ?>>
    <?php wp_body_open();
    if (class_exists('WooCommerce')) {
        ?>
        <div class="shopping_cart sub-cart">
            <h4 class="cart-title">
                <?php echo esc_html__('Cart', 'lusion') ?>
                <span class="count-product-cart">
                    <?php echo is_object(WC()->cart) ? WC()->cart->get_cart_contents_count() : '0'; ?>
                </span>
                <span class="close-sub-cart"><?php echo esc_html__('x', 'lusion') ?></span>
            </h4>
            <?php echo the_widget('WC_Widget_Cart', 'title='); ?>
        </div>
        <?php
    }   $scroll_chevron_enable = get_post_meta(get_the_ID(), 'scroll_chevron_enable', true);
        if($scroll_chevron_enable) :?>
           <div id="arrowAnim">
              <div class="arrowSliding">
                <i class="theme-icon-download"></i>
              </div>
              <div class="arrowSliding delay1">
                <i class="theme-icon-download"></i>
              </div>
              <div class="arrowSliding delay2">
                <i class="theme-icon-download"></i>
              </div>
              <div class="arrowSliding delay3">
                <i class="theme-icon-download"></i>
              </div>
        </div>
        <?php endif;
        Lusion_Functions::lusion_pre_loader();
        if ( is_front_page() ){
            Lusion_Templates::popup_newsletter();
        }
        if(class_exists('WooCommerce') && !is_checkout()){
            Lusion_Templates::popup_account();
        }

    ?>
    <div id="page" <?php lusion_page_class();?>>
        <?php if(!$lusion_hide_header && !is_404()) {
            Lusion::get_header_type(); }
        ?>

        <?php get_template_part('breadcrumb'); ?>
        <?php if ((is_home() && !is_front_page()) || is_category()):?>
            <?php get_template_part('archive-blog-custom');?>
        <?php elseif (is_home() && is_front_page()):?>
            <?php get_template_part('archive-blog-custom');?>
        <?php endif;?>
        <div id="site-main" class="wrapper">
            <?php if($lusion_site_layout == 'full-width') :?>
                <div class="container">
            <?php elseif ($lusion_site_layout == 'wide' || $lusion_site_layout == 'boxed' || $lusion_site_layout == 'full-screen'): ?>
                <div class="container-fluid">
            <?php else: ?>
                <div class="<?php echo esc_attr($container);?>">
            <?php endif;?>
                    <div class="row">
