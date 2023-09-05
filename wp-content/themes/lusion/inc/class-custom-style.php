<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Lusion_Custom_Style' ) ) {
	class Lusion_Custom_Style {
		public function __construct() {
			add_action( 'wp_footer', array( $this, 'style_css' ) );

		}

		public function style_css() {
			wp_register_style( 'custom-style', false );
			wp_enqueue_style( 'custom-style' );
			$style_css = "";
			$style_css .= $this->primary_color_css();
			$style_css .= $this->button_primary_color();
			$style_css .= $this->breadcrumbs();
			$style_css .= $this->site_background();
			$style_css .= $this->mb_single_product_background();
			$style_css .= $this->mb_category_background();
			$style_css .= $this->body_bg_image();
			$style_css .= $this->general_shop_background();
			$style_css .= $this->header();
			$style_css .= $this->site_width();
			$style_css .= $this->remove_space_top();
			$style_css .= $this->remove_space_bottom();
			$style_css .= $this->scroll_top_color();
			$style_css .= $this->color_title_breadcrumb();
			$style_css .= $this->color_link_title_breadcrumb();
			$style_css .= $this->icon_button_add_to_cart();
			$style_css = Lusion_Minify::css( $style_css );
			$style_css .= $this->padding_container();
			wp_add_inline_style( 'custom-style', html_entity_decode( $style_css, ENT_QUOTES ) );
		}

		# Check color
		function check_color( $color_1, $color_2 ) {
			$check_color = lusion_get_meta_value( $color_1 );
			if ( isset( $check_color ) && $check_color !== '' ) {
				$color = $check_color;
			} else {
				$color = Lusion::setting( $color_2 );
			}

			return $color;
		}

		# Regardless of the name, this function works for both primary and highlight color, gradient additionally.
		function primary_color_css() {
			$hasGra = lusion_get_meta_value( 'enable_gradient' );
			$color  = $this->check_color( 'site_color', 'primary_color' );
			$css    = '';

			if ( isset( $color ) && $color !== '' ) {
				$css = "
                .woocommerce p.stars a,.product_single_3.woocommerce .content-single-information table.shop_attributes td a:hover,
                .hover-home-drink a:hover,.widget_categories ul li ul.children li a:hover,
                .hover-color a:hover,body.woocommerce .star-rating::before, div.woocommerce .star-rating::before,
                .icon-primary .show-toggle-mb.footer-menu-title i,.woocommerce-cart-form__contents .product-cart-content dl dt,
                .custom-slide-product .apr-product .slick-slider .slick-arrow i:active, 
                .custom-slide-product .apr-product .slick-slider .slick-arrow i:focus, 
                .custom-slide-product .apr-product .slick-slider .slick-arrow i:hover,
                .icon-primary .show-toggle-mb.footer-menu-title i,
                .lookbook-inner .repeater-item .product-item .content-product .title-price>.product.woocommerce.add_to_cart_inline .button:hover,
                .woocommerce div.entry-summary form.cart .woocommerce-grouped-product-list.group_table tbody td .quantity .qty-number:hover span.increase-qty,
                .woocommerce div.entry-summary form.cart .woocommerce-grouped-product-list.group_table tbody td .quantity .qty-number:hover span.increase-qty,
                .post-meta-info a:hover,.post-name a:hover,
                .woocommerce-cart-form .actions button.button, .woocommerce-cart-form .actions button.button:disabled, 
                .woocommerce-cart-form .actions button.button:disabled[disabled],
                .page.woocommerce-cart .cart-right .woocommerce-shipping-calculator button,
                .button-back-cart,.cart-discount a,.block-brand-cs .elementor-swiper-button i:hover,.block-brand-cs .elementor-swiper-button i:focus,.block-brand-cs .elementor-swiper-button i:active,
                .shop_table .cart_item a.remove:hover i,
                .woocommerce table.shop_table .product-quantity .quantity .qty-number:hover span.increase-qty,
                .icon-detail a:hover,.woocommerce-loop-product__title:hover,
                .product-style-4 .product-action .yith-wcwl-wishlistaddedbrowse a:before, 
                .content-filter.languges > ul li:hover a,.breadcrumb li a:hover,.breadcrumb li,
                .product-style-4.product-action .yith-wcwl-wishlistexistsbrowse a:before,
                .product-style-3 .product-grid .product-top .product-action .group-action .action-item a,
                .product-style-3 .product-action .yith-wcwl-wishlistaddedbrowse a:before, 
                .product-style-3 .product-action .yith-wcwl-wishlistexistsbrowse a:before,
                .product-style-2 .product-grid .product-top > .wishlist-btn .yith-wcwl-wishlistaddedbrowse a:before, 
                .product-style-2 .product-grid .product-top > .wishlist-btn .yith-wcwl-wishlistexistsbrowse a:before,
                .product-style-1 .product-grid .product-desc .product-action .yith-wcwl-wishlistaddedbrowse a:before, 
                .product-style-1 .product-grid .product-desc .product-action .yith-wcwl-wishlistexistsbrowse a:before,
                .product-style-1 .product-grid .product-desc .product-action .action-item.wishlist-btn a:hover,
                .elementor-icon-list-text:hover,
                .sub-cart .widget_shopping_cart_content ul.woocommerce-mini-cart li a:not(.remove):hover,
                .sub-cart .widget_shopping_cart_content ul.woocommerce-mini-cart li .quantity .qty-number:hover span.increase-qty,
                .apr-nav-menu--main > .mega-menu .sub-menu li.current-menu-item > a,
                .apr-nav-menu--main > .mega-menu .sub-menu li a:hover,
                .apr-nav-menu--main .mega-menu > li > a:hover,
                .woocommerce .woocommerce-form-login-toggle .woocommerce-info a, .woocommerce .woocommerce-form-coupon-toggle .woocommerce-info a,
                .apr-nav-menu--layout-dropdown .mega-menu li:hover > a,
                .btn-search:hover,.woocommerce .wishlist_table .product-add-to-cart .yith-wcqv-button:hover:before,
                .woo-list-category .view_all a:hover,
                .header-account > a:hover,.header-cart > a:hover,
                .text-color a:hover,.white-color a:hover,.color-white a:hover, .highlight-color a:hover,
                .span-primary-color .elementor-text-editor span,
                .primary-color a,.header-currency .woocs-style-1-dropdown:hover,.header-currency .woocs-style-1-dropdown .woocs-style-1-dropdown-menu li:hover,
                .header-visit-home a:hover,
                .apr-nav-menu--layout-dropdown .caret-submenu:hover,
                .menu-icon:hover,
                .woo-list-category .list-cate-title:hover,
                a:hover,a:focus,.link-language:hover,
                .elementor-icon-box-icon .elementor-icon,
                .not-show-field .search-box .close-search-box:hover,
                .languges-flags .lang-1:hover i,
                .woocommerce-downloads.woocommerce-account .woocommerce-MyAccount-content .woocommerce-info a.button:hover,
                .breadcrumb li a:hover,
                .product-style-2 .product-grid .product-top > .wishlist-btn a:hover,
                .woocommerce-loop-product__title a:hover,.post-name a:hover,.sc-instagram .content a.user-name:hover,
                .blog-shortcode.grid-style5 .read_more a,.content-filter.languges>ul li a:hover,
                .grey-color:hover, .grey-color a:hover,.list-social .socials li a:hover,
                .product-style-2 .product-grid .product-top > .wishlist-btn .yith-wcwl-wishlistaddedbrowse a:before,
                 .product-style-2 .product-grid .product-top > .wishlist-btn .yith-wcwl-wishlistexistsbrowse a:before,
                 .woo-list-category .view_all a,
                 .apr-advance-tabs.apr-tabs-vertical.apr-tabs-horizontal .apr-tabs-nav > ul li.active,
                 .apr-advance-tabs.apr-tabs-vertical.apr-tabs-horizontal .apr-tabs-nav > ul li.active-default,
                  .apr-advance-tabs.apr-tabs-vertical.apr-tabs-horizontal .apr-tabs-nav > ul li:hover,
                  .woo-list-category.style1.sub-menu-active a,.woo-list-category.style1.sub-menu-active .caret-submenu.active i,
                  .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav > ul > li.active:after,
                .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav > ul > li.active-default:after,
                 .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav > ul > li:hover:after,
				 .widget.widget_product_categories ul.product-categories li:hover > a, .widget.widget_product_categories ul.product-categories li:hover > p, .widget.widget_product_categories ul.product-categories li:hover > span.count, div.woocommerce nav.woocommerce-pagination .page-numbers li a.active, div.woocommerce nav.woocommerce-pagination .page-numbers li a:hover, div.woocommerce nav.woocommerce-pagination .page-numbers li span.active, div.woocommerce nav.woocommerce-pagination .page-numbers li span:hover, body.woocommerce nav.woocommerce-pagination .page-numbers li a.active, body.woocommerce nav.woocommerce-pagination .page-numbers li span.active, body.woocommerce nav.woocommerce-pagination .page-numbers li span:hover,
				 .widget.widget_berocket_aapf_single ul .berocket_term_parent_0:hover .berocket_color_text,
				 .widget.brand ul li a:hover, .widget_archive ul li a:hover, .widget_categories ul li a:hover, .widget_meta ul li a:hover, .widget_nav_menu ul li a:hover, .widget_pages ul li a:hover, .widget_recent_comments ul li a:hover, .widget_recent_entries ul li a:hover, .widget_rss ul li a:hover,
				 .navigation-top .mega-menu > li .sub-menu > li:hover > a,
				 .widget.widget_product_categories ul.product-categories li ul.children li:hover > a, .widget.widget_product_categories ul.product-categories li ul.children li:hover > p, .widget.widget_product_categories ul.product-categories li ul.children li:hover > span.count,
				 .top-tlt-product .cate-product a:hover, .woocommerce div.entry-summary .availability span.stock,
				 h6.title-holder:hover, h6.title-holder:hover::before, div#delivery-return-content a:hover,
				 .elementor-single-product.single-style-1 .woocommerce div.entry-summary p.price,
				 .shop_table.cart .product-cart-content .product-name:hover, .woocommerce-cart .actions .wc-backward:hover,.woocommerce ul.order_details li, .woocommerce-account .woocommerce-MyAccount-navigation li.is-active a, .woocommerce-account .woocommerce-MyAccount-navigation li:hover a,  .woocommerce-Address-title.title .edit, .woocommerce-account .woocommerce-MyAccount-content .woocommerce-pagination .button:hover,
				 .woocommerce .wishlist_table .product-name a:hover, .yith_wcwl_wishlist_footer .yith-wcwl-share ul li a:hover, .woocommerce .wishlist_table .product-name a.yith-wcqv-button, .widget_tag_cloud .tagcloud a:hover, .pagination-content.type-number > a:hover, .pagination-content.type-number > span:hover, .pagination-content.type-number > span.current, .blog-list .read_more a, .blog-info-single .info a:hover, .post-single .pagination-link a:hover,
                 .search-results-wrapper li .suggestion-content .suggestion-title:hover,
                 .widget_tag_cloud .tagcloud a:hover,
                 .widget_products .product_list_widget .product-desc .product-title a:hover, .widget_top_rated_products .product_list_widget .product-desc .product-title a:hover,
                 .single-product .widget.widget_product_categories ul.product-categories li.current-cat>a:hover, .single-product .widget.widget_product_categories ul.product-categories li.current-cat>p:hover, .single-product .widget.widget_product_categories ul.product-categories li.current-cat>span.count:hover,
                 .active-sidebar .widget_product_tag_cloud .tagcloud a:hover,
                 .widget.widget_product_categories ul.product-categories li.current-cat>a, .widget.widget_product_categories ul.product-categories li.current-cat>p, .widget.widget_product_categories ul.product-categories li.current-cat>span.count,
                 .apr-contact label>span:not(.wpcf7-form-control-wrap),
                 .page-404 .go-home:hover,
                 .blog-gallery .slick-arrow:hover, .blog-gallery-single .slick-arrow:hover,
                 .blog-video i:before,
                 .quote_section blockquote a:hover,
                 .woocommerce .shop_table.woocommerce-checkout-review-order-table tfoot tr.order-total td,
                 .woocommerce-account .form-row label .required,
                 .comment-item .box-info-comment .comment-actions .comment-reply a.comment-edit-link:hover,
                 .woocommerce div.entry-summary p.price ins .amount,
                 ul.list-info-contact li .info-content a:hover,
                 .widget.yith-woocompare-widget .product_list_widget .product-desc .product-title a:hover,
                 .col-xl-9.has-sidebar .product-detail.single_1 div.entry-summary h6.title-holder:hover,
                 .col-xl-9.has-sidebar .product-detail.single_1 div.entry-summary h6.title-holder:hover:before,
                 .quantity.loading:before,
                 .woocommerce div.entry-summary form.cart .reset_variations:hover,
                 .woocommerce-account .woocommerce-MyAccount-content .shop_table.woocommerce-table--order-details tbody tr td.product-name a:hover,
                 .ywcars_view_request span.ywcars_update_messages:hover,
                 .ywcars_view_request table.ywcars_refund_info tbody tr td.ywcars_refund_info_minor_cell a:hover,
                 .apr-advance-tabs.apr-tabs-vertical.apr-tabs-vertical-2 .elementor-toggle .elementor-toggle-item .elementor-tab-title:hover,
                 .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-title:hover,
                 .elementor-icon:hover,.post-type-archive-portfolio .portfolio-container.layout1 .load-item .item .portfolio_body .title-category .portfolio_title a:hover,
                  .tax-portfolio_cat .portfolio-container.layout1 .load-item .item .portfolio_body .title-category .portfolio_title a:hover,
                   .post-type-archive-portfolio .portfolio-container.layout1 .load-item .item .portfolio_body .title-category .cate-portfolio a:hover,
                  .tax-portfolio_cat .portfolio-container.layout1 .load-item .item .portfolio_body .title-category .cate-portfolio a:hover,
                  .portfolio-single .portfolio-content .cate-portfolio a:hover,.portfolio-single .pagination-link a:hover,
                  .portfolio-single .pagination-link .nav-previous a:last-child:hover,
                   .portfolio-single .pagination-link .nav-next a:last-child:hover,
                   .apr-banner.type_2 .icon-detail a:hover,
                   .blog-info-single .info i,
                   .info-post .info i,
                   .widget_recent_entries ul li a:hover:before,
                   .active-sidebar .comment-author-link,
                .active-sidebar .widget.widget_recent_comments ul li,
                .category-product a:hover,
                .read_more a,body.woocommerce ul.products.product-list.columns-2 .product-content .product-desc .product-action .yith-wcwl-wishlistaddedbrowse a:before,
                .product-style-5 .product-grid .product-top .product-action .group-action .action-item a,
                .apr-banner.type_7 .bn-title,
                .apr-banner.type_7 .bn-title a,
                .product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action .group-action a.button,
                .product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action .action-item .add-cart-btn a:hover:before,
                .product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action a,
                .product-action-horizontal-bottom .product-style-2 .product-action .yith-wcwl-wishlistaddedbrowse a:before, 
                .product-action-horizontal-bottom .product-style-2 .product-action .yith-wcwl-wishlistexistsbrowse a:before,
                .elementor-widget-container .apr-nav-menu--main>.mega-menu>li>a:hover,
                .info-post .info a:hover,
                .elementor-widget-container .apr-nav-menu--main>.mega-menu>li>a:hover,
                .blog-info-single .info a,
                .post-share-list a:hover,
                .author-post-single h4 a:hover,
                .post-single .pagination-link .nav-next .text-next>a:last-child:hover, .post-single .pagination-link .nav-previous .text-prev>a:last-child:hover,
                .post-single .pagination-link .nav-next .text-next>a:first-child:hover, .post-single .pagination-link .nav-previous .text-prev>a:first-child:hover,
                .comment-item .box-info-comment .comment-actions .comment-reply a:hover,
                .tag-post-single .info-tag a:hover,
                .apr-nav-menu--main>.mega-menu .sub-menu li.current-menu-item:not(.current-category-ancestor)>a,
                .elementor-toggle .elementor-toggle-item .elementor-tab-content .list-menu li a:hover,
                .elementor-custom-embed-play .eicon-play,.lookbook-inner .repeater-item .product-item .content-product .title-price .price,
                .lookbook-inner .repeater-item .product-item .content-product .title-price .title a:hover,
                .lookbook-inner .repeater-item .product-item .product-tooltip .theme-icon-tag-icon,.button-video-slider i,
                .tab-full_width ul.tabs.wc-tabs li.active a,
                .tab-full_width ul.tabs.wc-tabs li a:hover,
                .cate-product a:hover, .search-results-wrapper li .suggestion-content .add-cart-btn a,
                .page-404 .go-home,
                .product-style.product-style-5 .product-action .yith-wcwl-wishlistaddedbrowse a:before,
                 .product-style.product-style-5 .product-action .yith-wcwl-wishlistexistsbrowse a:before,
                .heading-custom .heading-modern .heading-title span,.color-white.hover-home-main a:hover,
                .list-icon-footer-home-pages .elementor-icon-list-item:hover a,
                .list-icon-footer-home-pages .elementor-icon-list-item:hover a .elementor-icon-list-text,
                .blog-list .cate-post a:hover,
                .blog-list.blog-list-style-2 .read_more a:hover,
                .tm-posts-widget .post-widget-info .post-widget-title a:hover,.testimonial-type-1 .testimonial-name,
                .tm-posts-widget .post-widget-info .custom-date a:hover,
                .team-content.cs-slick-arrows .slick-arrow:focus, .team-content.cs-slick-arrows .slick-arrow:hover,
                .product-style.product-style-2 .product-grid .product-top .product-action .action-item .add-cart-btn a:hover:before,
                div.woocommerce  ul.products.product-style-2 li.product .button.loading::after,
                .product-style.product-style-2 .product-grid .product-top .product-action .group-action a.button:hover,
                .list-view-as li a.active,.not-show-field .search-box .search-results-wrapper .product-grid .product-content .product-desc .product-action .add-cart .add-cart-btn a:hover,
                .woocommerce .wishlist_table .product-add-to-cart .add-cart a.button:hover, 
                .woocommerce .wishlist_table .product-add-to-cart .add-cart a.button:focus, .woocommerce .wishlist_table .product-add-to-cart .add-cart a.button:active,.product-action .action-item a.button,body.woocommerce ul.products.product-list .product-content .product-desc .product-action .yith-wcwl-add-to-wishlist a,
                .woocommerce .wishlist_table .product-add-to-cart .yith-wcqv-button:hover, .woocommerce .wishlist_table .product-add-to-cart .yith-wcqv-button:focus, .woocommerce .wishlist_table .product-add-to-cart .yith-wcqv-button:active,
                .popup-account form.woocommerce-form.woocommerce-form-register button.button:hover,
                .popup-account form.woocommerce-form.woocommerce-form-register button.button:focus,
               .popup-account form.woocommerce-form.woocommerce-form-login button.button:hover,
                .popup-account form.woocommerce-form.woocommerce-form-login button.button:focus,
                .woocommerce .col-xl-12 .product:not(.outofstock) .product-detail.single_1 div.entry-summary .yith-wcwl-add-to-wishlist a,
                .search-results-wrapper .view-all a.view-all-seach:hover,.sub-cart a.button,
                .sub-cart .cart-title span.close-sub-cart:hover,.sub-cart a.button.checkout:hover,.sub-cart a.button,
                .apr-nav-menu--main>.mega-menu .sub-menu li:hover .caret-submenu,
                .header-language-text .language-content__text .content-filter.languges > ul li a:hover,
                 .header-language-text-flag .language-content__text .content-filter.languges > ul li a:hover,
                 .megamenu_sub .apr-banner .btn-bn:hover,.product-action .yith-wcwl-wishlistaddedbrowse a:before,
                 .product-action .yith-wcwl-wishlistexistsbrowse a:before,
                 .search-results-wrapper .product-grid .product-content .product-desc .product-action .add-cart .add-cart-btn a.loading:before,
                 .sub-cart a.button.checkout:focus,.product-action-horizontal-bottom div.woocommerce .product-style-2 ul.products.product-content .product-desc .product-action .add-cart .add-cart-btn a:before,
                 .woocommerce-account .woocommerce-MyAccount-content table.my_account_orders .button,
                 .woocommerce-account div.pp_woocommerce .pp_content_container input[type='submit']:hover,
                 .page.woocommerce-cart .box-shipping-cs .shipping-calculator-form button.button,
                 .woocommerce-table.woocommerce-table--order-details tbody tr td.woocommerce-table__product-name.product-name a:hover,
                 .lookbook-inner .repeater-item .product-item .product-tooltip .theme-icon-tag-icon,
                 .lookbook-inner .repeater-item .product-item .content-product .title-price .title a:hover,
                 .lookbook-inner .repeater-item .product-item .content-product .images div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a, 
                 .lookbook-inner .repeater-item .product-item .content-product .images div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
                 .apr-product .loadmore-product .view-more-button:hover, 
				 .apr-product .loadmore-product .view-more-button:focus,
                 .product-share .product-sharing-list a:hover,
                 .woocommerce div.entry-summary form.cart .woocommerce-grouped-product-list.group_table tbody td.woocommerce-grouped-product-list-item__label a:hover,
                 .woocommerce div.entry-summary form.cart .woocommerce-grouped-product-list.group_table tbody td.woocommerce-grouped-product-list-item__quantity .button:hover,
				 .single-product .side-breadcrumb .breadcrumb li,
				 .single-product .side-breadcrumb .breadcrumb li a:hover,
				 .single-product .side-breadcrumb .breadcrumb li:hover::before,
                 .cs-image-box .elementor-image-box-content .elementor-image-box-title a:hover,
                 .woocommerce .product.product-type-grouped .single_2 div.entry-summary .yith-wcwl-add-to-wishlist a,
                 .woocommerce .product.product-type-grouped .single_2 div.entry-summary .yith-wcwl-add-to-wishlist a,
                 #yith-quick-view-close:hover,
                 .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a, .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
                 .contnet-product-group .title a:hover,
                 .contnet-product-group .button-get-outfit a:hover,
                 #yith-quick-view-close:hover,.box-sale-banner .elementor-image-box-title a:hover,
                 .product-action-horizontal-bottomdiv.woocommerce .product-style-2 ul.products li.product .button.loading:hover::after,
                 .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav>.apr-tab-top-icon>.item-tab.active, 
                 .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav>.apr-tab-top-icon>.item-tab:hover, 
                 .apr-advance-tabs.apr-tabs-vertical .apr-tabs-nav>.apr-tab-top-icon>.item-tab.active-default,
                 .apr-advance-tabs.apr-tabs-vertical.apr-tabs-vertical-2 .elementor-toggle .elementor-toggle-item .elementor-tab-title:hover .elementor-toggle-title,
                 .apr-advance-tabs.apr-tabs-vertical.apr-tabs-horizontal .apr-tabs-nav>.apr-tab-top-icon .item-tab.active, .apr-advance-tabs.apr-tabs-vertical.apr-tabs-horizontal .apr-tabs-nav>.apr-tab-top-icon .item-tab:hover,
                 .woo-list-category.style4 .info-woo-category .list-cate-title:hover, .sitcky-right .action-item.wishlist-btn a,
                 body.woocommerce ul.products.product-list .product-content .product-desc .product-action .yith-wcwl-wishlistaddedbrowse a:before, 
                 body.woocommerce ul.products.product-list .product-content .product-desc .product-action .yith-wcwl-wishlistexistsbrowse a:before,
                 .widget.widget_product_categories ul.product-categories>li a:hover
                {
                    color: $color;
                }
				.single-product .side-breadcrumb .breadcrumb li a::before,
                .woo-list-category .view_all a:hover:before,
                .quote_section:before,
                .hover-underline .megamenu_sub ul > li > a:before,
                .hover-underline > ul > li .sub-menu li > a:before,
                .hover-underline > ul > li > a:before,
                .hover-underline .apr-nav-menu--main > ul > li > a:before,
                .apr-nav-menu--main > .mega-menu .sub-menu > li:hover > a:before, 
				.apr-nav-menu--main > .mega-menu .sub-menu > li.current-menu-item > a:before,span.count,
                .apr-nav-menu--main > .mega-menu .sub-menu li.current-menu-item a:before,
                .apr-nav-menu--main > .mega-menu .sub-menu li a:hover:before,
                .product-content .product-top .sale_perc,
                .product-action-horizontal-middle .product-style-2 .product-grid .product-top .product-action .action-item a:hover,
                .tooltip-inner,
				.scroll-to-top,
				.product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action .group-action a.button:hover,
                .product-detail .sale_perc,
                .apr-advance-tabs:not(.apr-tabs-vertical) .apr-tabs-nav > .apr-tab-top-icon .item-tab:after,
				.read_more a:hover:before,
				.product-style-1 .product-grid .product-top .product-action .action-item .add-cart-btn a:hover,
                .product-style-1 .product-grid .product-top .product-action .action-item a:hover,
                .button-video-slider i:hover,
				.icon-box-list .slick-arrow:hover,
                .product-style-1 .product-grid .product-top .product-action .action-item a:hover,
				.product-grid .product-top .product-action .action-item .add-cart-btn a,
				.product-grid .product-top .product-action .group-action a:hover,
                .blog-shortcode.grid-style4 .watch-video i,
                .blog-shortcode.grid-style5 .read_more a:before,
                .elementor-icon-box-button,
                .blog-shortcode.grid-style4 .watch-video i,
                .apr-product  .product-style-6 .slick-slider .slick-arrow i:hover,
				.apr-product .product-style-6 .slick-slider .slick-arrow i:focus,
                .blog-shortcode.grid-style4 .watch-video i,
                .blog-shortcode.grid-style5 .read_more a:before,
				.elementor-single-product .btn-single-product a:focus, 
				.elementor-single-product .btn-single-product a:hover,
                .mc4wp-form-fields input[type='submit']:hover,
				.apr-banner.type_6 .bn-content .icon-detail a,
				.product-style-3 .product-grid .product-top .product-action .group-action .action-item a:hover,
                .product-style-3 .product-grid .product-top .product-action .action-item .add-cart-btn a,
                .product-style-3 .product-grid .product-top .product-action .group-action .action-item .yith-wcwl-wishlistaddedbrowse a,
                .custom-date:hover,
				.widget_berocket_aapf_single .berocket_filter_slider.ui-widget-content .ui-slider-range, 
				.widget_berocket_aapf_single .berocket_filter_price_slider.ui-widget-content .ui-slider-range,
                .slider-banner .slick-arrow:hover,
                .woo-list-category .view_all a:before,
				.woo-list-category.style1.sub-menu-active a.list-cate-title::before,
				.widget.brand ul li a:hover::before, 
				.widget_archive ul li a:hover::before, 
				.widget_categories ul li a:hover::before, 
				.widget_meta ul li a:hover::before, 
				.widget_nav_menu ul li a:hover::before, 
				.widget_pages ul li a:hover::before, 
				.widget_recent_comments ul li a:hover::before,
				.widget_rss ul li a:hover::before,
				.widget.widget_product_categories ul.product-categories li ul.children li:hover::before,
				#cart_added_msg_popup, 
				#compare_added_msg_popup, 
				#yith-wcwl-message,
				body.woocommerce ul.products li.product .button.loading, 
				div.woocommerce ul.products li.product .button.loading, 
				.woocommerce div.entry-summary form.cart button[type='submit'],
				.quantity .qty-number:hover, 
				.woocommerce div.entry-summary .yith-wcwl-add-to-wishlist a:hover,
				.woocommerce #reviews #review_form .comment-form p.form-submit input#submit,
				.product-extra .slick-arrow:focus i, 
				.product-extra .slick-arrow:hover i,
				.woocommerce-checkout #payment ul.payment_methods li input:checked ~ label::after,
				.woocommerce-wishlist table.wishlist_table.shop_table tbody tr td.product-remove a:hover, 
				.blog-list .read_more a::before,
				.post-single .pagination-link a:hover::before, 
				.commentform .form-submit input[type='submit'].btn:active,
				.commentform .form-submit input[type='submit'].btn:focus, 
				.commentform .form-submit input[type='submit'].btn:hover,
				.team-content.cs-slick-arrows .slick-arrow:hover, 
				.apr-contact input[type='submit']:hover, 
				.video-product:focus, .video-product:hover,
				.woocommerce form.woocommerce-form.login .form-row .button,
				.product-style-1 .slick-slider .slick-arrow i:hover,
				.product-style-1 .slick-slider .slick-arrow i:focus,
                body:not(.elementor-editor-active) .busy-loader .w-ball-wrapper .w-ball,
                body:not(.elementor-editor-active) .pacman > div:nth-child(3), 
				body:not(.elementor-editor-active) .pacman > div:nth-child(4), 
				body:not(.elementor-editor-active) .pacman > div:nth-child(5), 
				body:not(.elementor-editor-active) .pacman > div:nth-child(6),
                body:not(.elementor-editor-active) #object-7,
                body:not(.elementor-editor-active) .bubblingG span,
                body:not(.elementor-editor-active) .preloader8 span,
                .blog-item:hover .blog-video i,
                .woocommerce-account .woocommerce-MyAccount-content .button:hover,
                .woocommerce-account .woocommerce-form.woocommerce-form-login button.button:active, 
				.woocommerce-account .woocommerce-form.woocommerce-form-login button.button:focus, 
				.woocommerce-account .woocommerce-form.woocommerce-form-login button.button:hover, 
				.woocommerce-account .woocommerce-form.woocommerce-form-register button.button:active, 
				.woocommerce-account .woocommerce-form.woocommerce-form-register button.button:focus, 
				.woocommerce-account .woocommerce-form.woocommerce-form-register button.button:hover,
                .product-detail .product-list-thumbnails .slick-arrow:hover,
                .apr-product .slick-slider .slick-arrow i:hover, 
                .apr-product .slick-slider .slick-arrow i:focus,
                 .popup-account .nav-tabs li a::after, 
				 .woocommerce-account #customer_login h2::after,
                 .bapf_slidr_main.ui-widget-content .ui-slider-handle, 
				 .berocket_filter_price_slider.ui-widget-content .ui-slider-handle, 
				 .slide.default .bapf_slidr_main .ui-state-default, 
				 .slide.default .bapf_slidr_main .ui-widget-header .ui-state-default, 
				 .slide.default .bapf_slidr_main.ui-widget-content .ui-state-default, 
				 .slide.default .berocket_filter_price_slider .ui-state-default, 
				 .slide.default .berocket_filter_price_slider .ui-widget-header .ui-state-default, 
				 .slide.default .berocket_filter_price_slider.ui-widget-content .ui-state-default,
                 .bapf_slidr_main.ui-widget-content .ui-slider-range, 
				 .berocket_filter_price_slider.ui-widget-content .ui-slider-range,
                 .button-video-slider div:before,
				 .post-type-archive-portfolio .portfolio-container .load-item .item .portfolio_body .poppup-share div.share span.theme-icon-share:hover,
                 .tax-portfolio_cat .portfolio-container .load-item .item .portfolio_body .poppup-share div.share span.theme-icon-share:hover,
                 .portfolio-single .portfolio-content .portfolio-info .portfolio-share .portfolio-sharing-list a:hover,
                 .bg-primary-color > .elementor-column-wrap,
                 .bg-site > .elementor-widget-container,
                 .popup-account form.woocommerce-form.woocommerce-form-login button.button, 
				 .popup-account form.woocommerce-form.woocommerce-form-register button.button,
                 span.bapf_clr_text,
                 .tooltip-custom,
                 .product-style-5 .product-grid .product-top .product-action .action-item .add-cart-btn a,
                 .product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action .action-item .add-cart-btn a,
                 .product-action-horizontal-bottom .product-style-2 .product-grid.product-top .product-action a:hover,
                 .widget_search .submit.btn-search,
                 .show-space-line.apr-nav-menu--main .mega-menu > li:hover > a:before,
                 .blog-info-single .info:first-child:before,
				.post-sidebar-sticky .content-post-sticky:before,
                .apr-nav-menu--main>.mega-menu .sub-menu>li.current-menu-item:not(.current-category-ancestor)>a:before,
                .elementor-widget-video .elementor-custom-embed-image-overlay:hover .elementor-custom-embed-play i,
                .slide-top-cate .slick-arrow:hover,
				.lookbook-inner .repeater-item .product-item .product-tooltip:after,
                .label-product.new,
				.woocommerce .button.wc-backward,
                .woocommerce .wc-proceed-to-checkout a.button.alt,
                .woocommerce-checkout #payment #place_order,
				.woocommerce-account .woocommerce-MyAccount-content .button,
                body .single-product-home-cake .elementor-single-product.single-style-2 .slick-arrow:hover,
                .woocommerce .product-detail div.entry-summary .yith-wcwl-add-to-wishlist a:hover,
                .woocommerce .col-xl-12 .product-detail.single_1 div.entry-summary .yith-wcwl-add-to-wishlist a:hover,
                .elementor-single-product.single-style-1 .btn-single-product a:before,
				.testimonial-type-1 .testimonial-image:before,
                .elementor-single-product.single-style-1 .slick-arrow:hover,
                .icon-show-social,
                .blog-list .cate-post a,
                .blog-list .info-post .info:before,
                .blog-list.blog-list-style-2 .read_more a:before,
                span.post_count,.woocommerce form.woocommerce-form.login .woocommerce-form__label input[type='checkbox']:checked:before,
                .woocommerce-account-fields input[type='checkbox']:checked:before, 
				#ship-to-different-address input[type='checkbox']:checked:before,
                .blog-list-style-3.post_sticky.blog-list .blog-item.blog-has-img .blog-post-info .category-post a, 
				.blog-list-style-3.post_sticky.blog-list .blog-item.blog-item.post-image .blog-post-info .category-post a, 
				.blog-list-style-3.post_sticky.blog-list .blog-item.post-audio .blog-post-info .category-post a, 
				.blog-list-style-3.post_sticky.blog-list .blog-item.post-video .blog-post-info .category-post a,
                .blog-img-top .blog-post-cat a,
				.blog-list-style-3.list_post_sticky.blog-list .blog-item .info-post .info:nth-last-child(2):before,
                .blog-list-style-3.blog-list .blog-post-info .category-post a,
                .widget_archive ul li a:hover:before,
                .widget_categories ul li a:hover:before,
                 div.woocommerce nav.woocommerce-pagination .page-numbers li span.current, 
                 body.woocommerce nav.woocommerce-pagination .page-numbers li span.current,
                .product-action-horizontal-bottom .product-style.product-style-2.product-style-7 .product-grid .product-top .product-action .action-item .add-cart-btn a:hover,
				.blog-shortcode.grid-style8 div.blog-img .blog-post-cat a,
                .widget.widget_product_categories ul.product-categories>li:hover:before,
				.not-show-field .search-box .search-results-wrapper .product-grid .product-content .product-desc .product-action .add-cart .add-cart-btn a:after,
                .search-results-wrapper .view-all a.view-all-seach,
                input:checked~.checkmark, 
				input:checked~.radiobtn,
				body.woocommerce ul.products.product-list .product-content .product-desc .product-action .add-cart .button,
                .woocommerce .col-xl-12 .product:not(.outofstock) .product-detail.single_1 div.entry-summary .yith-wcwl-add-to-wishlist a:hover,
                .widget.widget_product_categories ul.product-categories>li.current-cat:before,
				.woocommerce .wishlist_table .product-add-to-cart .add-cart a.button,
				.woocommerce .wishlist_table .product-remove a.remove:hover,
				body.woocommerce ul.products.product-list .product-content .product-desc .product-action .group-action .action-item .yith-wcwl-add-to-wishlist:hover, 
				body.woocommerce ul.products.product-list .product-content .product-desc .product-action .group-action .action-item a.button:hover,
                .sub-cart a.button.checkout,
				.woocommerce form.woocommerce-form.login .form-row .button:hover,
                .apr-nav-menu--main:not(.apr-nav-menu--layout-dropdown) > ul > li > a:before,
                .apr-nav-menu--main:not(.apr-nav-menu--layout-dropdown) > ul > li > a:after,
                .sub-cart a.button.checkout,
                header .apr-nav-menu--main:not(.apr-nav-menu--layout-dropdown) > ul > li > a:before,
				.woocommerce-cart-form .actions button.button:hover, 
				.woocommerce-cart-form .actions button.button:disabled:hover, 
				.woocommerce-cart-form .actions button.button:disabled[disabled]:hover,
				.page.woocommerce-cart .cart-right .coupon .coupon-form button.button:hover,
                .page.woocommerce-cart .cart-right .coupon .coupon-form button.button:focus,
                .page.woocommerce-cart .cart-right .coupon .coupon-form button.button:active,
                header .apr-nav-menu--main:not(.apr-nav-menu--layout-dropdown) > ul > li > a:before,
                .mega-menu .tip,.slider-banner .slick-arrow:focus,
                .category-product-slider .slick-arrow:hover,
                .category-product-slider .slick-arrow:focus,
                .mega-menu .woo-list-category ul.children-cate li a:before,
                body > .apr-nav-menu--layout-dropdown .megamenu_sub ul>li>a:before,
                .woocommerce-account .woocommerce-MyAccount-navigation li:hover a:before,
                .woocommerce-account .woocommerce-MyAccount-navigation li.is-active a:before,
                .checkbox-custom input:checked~.checkmark,
                .woocommerce-account div.pp_woocommerce .pp_content_container input[type='submit'],
                .lookbook-inner .repeater-item .product-item, 
				.blog-shortcode.grid-style8 .blog-img .blog-post-cat a,
                .lookbook-inner .repeater-item .product-item .content-product .title-price .action-item.add-cart a:after,
				.woocommerce .wishlist_table .product-remove a.remove:hover, 
				.woocommerce .wishlist_table .product-add-to-cart .add-cart a.button,
                .woocommerce-account div.pp_woocommerce .pp_content_container input[type='submit'],
                .lookbook-inner .repeater-item .product-item,
                .lookbook-inner .repeater-item .product-item .content-product .title-price .action-item.add-cart a:after,
                .woocommerce .product.product-type-grouped .single_2 div.entry-summary .yith-wcwl-add-to-wishlist a:hover,
                .woocommerce-account div.pp_woocommerce .pp_content_container input[type=submit],
                .lookbook-inner .repeater-item .product-item,
                .lookbook-inner .repeater-item .product-item .content-product .title-price .action-item.add-cart a:after,
                body.woocommerce nav.woocommerce-pagination .page-numbers li a.active, 
                body.woocommerce nav.woocommerce-pagination .page-numbers li a:hover, 
                body.woocommerce nav.woocommerce-pagination .page-numbers li span.active, 
                body.woocommerce nav.woocommerce-pagination .page-numbers li span:hover, 
                div.woocommerce nav.woocommerce-pagination .page-numbers li a.active, 
                div.woocommerce nav.woocommerce-pagination .page-numbers li a:hover, 
                div.woocommerce nav.woocommerce-pagination .page-numbers li span.active, .cascade-slider_arrow:hover,
                .cascade-slider_arrow:focus,
                div.woocommerce nav.woocommerce-pagination .page-numbers li span:hover,.woo-list-category.style3 .slick-arrow:hover,
                .woo-list-category.style3 .slick-arrow:focus,
                .lookbook-inner .repeater-item .product-item,.blog-shortcode.grid-style8 .blog-img .blog-post-cat a,
                .lookbook-inner .repeater-item .product-item .content-product .title-price .action-item.add-cart a:after,
                .contnet-product-group .button-get-outfit a:hover i,
                .fancybox-container.fancybox-is-open .content-product .title-price .action-item.add-cart a:hover, .fancybox-container.fancybox-is-open .content-product .title-price .action-item.add-cart a:focus,
                .blog-list-style-3.list_post_sticky.blog-list .blog-item.blog-has-img .blog-post-info .category-post a, 
                .blog-list-style-3.list_post_sticky.blog-list .blog-item.blog-item.post-image .blog-post-info .category-post a, 
                .blog-list-style-3.list_post_sticky.blog-list .blog-item.post-audio .blog-post-info .category-post a,
                .blog-list-style-3.list_post_sticky.blog-list .blog-item.post-video .blog-post-info .category-post a,
                 body.woocommerce .apr-product .woocommerce.columns-1 ul.products.product-list.columns-1 .product-content .product-desc .product-action .action-item .button:hover,
                 body.woocommerce .apr-product .woocommerce.columns-1 ul.products.product-list.columns-1 .product-content .product-desc .product-action .action-item .yith-wcwl-add-to-wishlist:hover,
                 .custom-slide-product .apr-product .slick-slider ul.slick-dots li.slick-active button, .custom-slide-product .apr-product .slick-slider ul.slick-dots li.slick-active button button, li:hover button .custom-slide-product .apr-product .slick-slider ul.slick-dots li:hover button,
                 body.woocommerce ul.products.product-list.columns-1 .product-content .product-desc .product-action .group-action .action-item .yith-wcwl-add-to-wishlist.exists,
                 .main-brands .brands-content .info-brands, .product-detail span.label-product,
                 .main-brands .brands-content .info-brands, .woocommerce .sitcky-right button.button.alt,
				 .border-top-right-about .elementor-image::before,.widget.widget_product_categories ul.product-categories>li ul.children li a:before,.widget_archive ul li a:hover:before, .widget_categories ul li a:hover:before,
				 .border-left-bottom-about .elementor-image::before, .border-left-bottom-about .elementor-image::after,
				 .border-top-right-about .elementor-image::after, .list-item ul li::before,.breadcrumb li a:before,
                 .widget.widget_product_categories ul.product-categories>li a:before,
                 body.woocommerce .apr-product .woocommerce ul.products.product-list.columns-1 .product-content .product-desc .product-action .action-item .button:hover,.product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action .action-item .add-cart-btn a:hover,
                 body.woocommerce .apr-product .woocommerce ul.products.product-list.columns-1 .product-content .product-desc .product-action .action-item .yith-wcwl-add-to-wishlist:hover,.product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action a:hover,
				 .testimonial-type-1 .testimonial-image::before,.shopswatchinput::-webkit-scrollbar-thumb,
				 .woocommerce div.widget_price_filter .ui-slider .ui-slider-range,
					.woocommerce div.widget_price_filter .ui-slider .ui-slider-handle,
					.woocommerce div.widget_price_filter .price_slider_amount .button{
                    background-color:$color;
                }
                @media (max-width: 1366px){
                    .product-box-filter-1366.apr-product-tab .product-tab-header ul li:not(.init):hover ,
                    .product-box-filter-1366.apr-product-tab .product-tab-header ul li.tab-item.item-current:not(.init) {
                        background-color: $color;
                    }
                }
                .sale-christmas .label-product.on-sale span:before{
                   border-top-color: $color;
                   border-left-color: $color;
                   border-right-color: $color;
                }
                .lookbook-inner .repeater-item .product-item{
                    background-color: $color" . "80;
                }
                .woocommerce-cart-form .actions a.button:hover,
                .order-again a.button:hover,
                .pp_content_container input[type='submit']:hover,
                .woocommerce form.woocommerce-form-track-order p.form-row button.button:hover,
                #yith-quick-view-content .product-list-thumbnails .slick-arrow:focus, 
                #yith-quick-view-content .product-list-thumbnails .slick-arrow:hover,
                 .product-style-5 .product-grid .product-top .product-action .group-action .action-item a:hover,
                 .apr-banner.type_7 .bn-title:hover,
                 .apr-banner.type_7 .list-subtitle h4:hover,
                    .post-single .pagination-link .icon-next a:hover, .post-single .pagination-link .icon-prev a:hover,
                 .commentform .form-submit input[type='submit'].btn{
                    background:$color;
                }
               .elementor-icon-box-icon .elementor-icon:hover,
                body:not(.elementor-editor-active) .lds-dual-ring:after,
                .tooltip .arrow:before{
                    border-bottom-color: $color !important;
                    border-top-color: $color !important;
                }
                body:not(.elementor-editor-active) .object-3 {
                    border-left-color: {$color};
                    border-top-color: {$color};
                }
                body:not(.elementor-editor-active) .pacman > div:nth-child(2),
                body:not(.elementor-editor-active) .pacman > div:first-of-type {
                    border-left-color: {$color};
                    border-top-color: {$color};
                    border-bottom-color: {$color};
                }
                .tooltip-custom::after{
                    border-color: $color transparent transparent;
                }
                .product-style-1 .tooltip-custom::after,  .product-style-2 .tooltip-custom::after,
                .product-style-3 .tooltip-custom::after, .product-style-4 .product-top .tooltip-custom::after{
                        border-color: transparent transparent transparent $color;
                }
                .rtl .product-style-1 .tooltip-custom::after, 
                .rtl div:not(.product-action-horizontal-middle) .product-style-2 .tooltip-custom::after, 
                .rtl div:not(.product-action-horizontal-bottom) .product-style-2 .tooltip-custom::after, 
                .rtl .product-style-3 .tooltip-custom::after, .rtl .product-style-4 .product-top .tooltip-custom::after{
                        border-color: transparent $color transparent transparent;
                }
                .product-action-horizontal-bottom .product-style-2 .tooltip-custom::after, 
                .product-action-horizontal-middle .product-style-2 .tooltip-custom::after,
                .middle-has-wishlist.wishlist--bottom .product-style-2 .wishlist-btn .tooltip-custom::after,
                .middle-has-wishlist.wishlist--top .product-style-2 .wishlist-btn .tooltip-custom::after,
                .product-style-4 .tooltip-custom::after{
                        border-color: $color transparent transparent transparent !important;
                }
                span.bapf_clr_text:after{
                    border-top-color: {$color};
                }
                .elementor-timeline.type2 .elementor-timeline-list li:nth-child(2n) .elementor-timeline-number:before,
                .quote_section:after{
                    border-left-color: {$color};
                }
                .elementor-timeline.type2 .elementor-timeline-number:before{
                    border-right-color: {$color};
                }
                .product-style-1.product-style-5 div.wcvashopswatchlabel.wcvasquare:hover,
                .product-style-1.product-style-5 div.selectedswatch.wcvasquare:hover,
                .testimonial-type-1 .slick-slide .slick-slide-inner:hover,
				div.wcvashopswatchlabel.wcvasquare:hover,
				.popup-account form.woocommerce-form.woocommerce-form-register button.button:hover,
                 .popup-account form.woocommerce-form.woocommerce-form-register button.button:focus,
                  .popup-account form.woocommerce-form.woocommerce-form-register button.button:active,
                   .popup-account form.woocommerce-form.woocommerce-form-login button.button:hover,
                    .popup-account form.woocommerce-form.woocommerce-form-login button.button:focus,
                 .popup-account form.woocommerce-form.woocommerce-form-login button.button:active,
                 .portfolio-single .portfolio-content .portfolio-info .portfolio-share .portfolio-sharing-list a:hover,.button-video-slider i:hover,.woocommerce .coupon button.button:hover, .woocommerce .coupon button.button:active, .woocommerce .coupon button.button:focus,
                 label.selectedswatch.wcvasquare,
                 label.wcvaswatchlabel:hover,.testimonial-type-1 .slick-slide:hover .item-testimonial,input[type='search']:hover,
                 .search-results-wrapper .view-all a.view-all-seach{
                    border-color: $color !important;
                }
                .apr-banner.type_5:hover .description,
                .comment-author-link,   
                .active-sidebar span.comment-author-link,
                .active-sidebar .widget.widget_recent_comments ul li,
                .widget.widget_product_categories ul.product-categories li.current-cat>a, 
                .widget.widget_product_categories ul.product-categories li.current-cat>p, 
                .widget.widget_product_categories ul.product-categories li.current-cat>span.count,
                .apr-nav-menu--main > .mega-menu > li:hover > a, 
                .apr-nav-menu--main .apr-item.apr-item-active, 
                .apr-nav-menu--main .apr-item.highlighted, 
                .apr-nav-menu--main > .mega-menu > li.current-menu-parent > a, 
                .apr-nav-menu--main > .mega-menu > li.current_page_item > a, 
                .apr-nav-menu--main > .mega-menu > li > a:focus,
                .contact-2 .elementor-icon-box-title a:hover,.shop_table .cart_item a.remove:hover,
                .widget.widget_product_categories ul.product-categories>li ul.children li a:hover,
                .widget.widget_product_categories ul.product-categories>li ul.children ul.children li a:hover,
                .sub-cart .widget_shopping_cart_content ul.woocommerce-mini-cart li a.remove:hover,
                .hover-color a:hover,
                div.pp_woocommerce .pp_details .pp_close:focus, div.pp_woocommerce .pp_details .pp_close:hover{
                    color: $color !important;
                 }
                 input[type=email]:hover, input[type=password]:hover, input[type='search']:hover, input[type='text']:hover, input[type=url]:hover, select:hover, textarea:hover,
                 .woocommerce-cart-form .actions button.button, .woocommerce-cart-form .actions button.button:disabled, .woocommerce-cart-form .actions button.button:disabled[disabled],
                #yith-quick-view-content .product-list-thumbnails .slick-arrow:focus, 
                #yith-quick-view-content .product-list-thumbnails .slick-arrow:hover,
                .icon-box-list .slick-arrow:hover,
                .sub-cart a.button.checkout:hover,.slider-banner .slick-arrow:hover,
                .apr-product .slick-slider .slick-arrow i:focus, .apr-product .slick-slider .slick-arrow i:hover,
                .apr-advance-tabs.apr-tabs-vertical.apr-tabs-horizontal .apr-tabs-nav > ul li.active,
                .apr-advance-tabs.apr-tabs-vertical.apr-tabs-horizontal .apr-tabs-nav > ul li.active-default,
                 .apr-advance-tabs.apr-tabs-vertical.apr-tabs-horizontal .apr-tabs-nav > ul li:hover,
				 body.woocommerce ul.products li.product .button.loading, div.woocommerce ul.products li.product .button.loading, .quantity .qty-number:hover, .product-extra .slick-arrow:focus i, .product-extra .slick-arrow:hover i,  .woocommerce .wc-proceed-to-checkout a.button.alt,.team-content.cs-slick-arrows .slick-arrow:hover ,
                 body:not(.elementor-editor-active) .lds-ripple div,
                 .active-sidebar .widget_product_tag_cloud .tagcloud a:hover,
                 .blog-item:hover .blog-video i:after,
                 .quote_section:before,
                 .woocommerce .shop_table.woocommerce-checkout-review-order-table tfoot tr.order-total td,
                 .product-detail .product-list-thumbnails .slick-arrow:hover,
                 .sub-cart a.button:hover ,
                 .popup-account form.woocommerce-form.woocommerce-form-login button.button, .popup-account form.woocommerce-form.woocommerce-form-register button.button,
                 .widget-title,.page.woocommerce-cart .cart-right .woocommerce-shipping-calculator button,
                 .bapf_head h3,.woocommerce form.woocommerce-form.login .woocommerce-form__label input[type='checkbox']:hover:before,
                 .checked .bapf_clr_span,
                 .product-style-5 .product-grid .product-top .product-action .group-action .action-item a,
                 .product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action .action-item .add-cart-btn a,
                 .product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action a,
                    .post-single .pagination-link .icon-next a:hover, .post-single .pagination-link .icon-prev a:hover,
                 .read_more a,.woocommerce .wishlist_table .product-add-to-cart .yith-wcqv-button:hover, .woocommerce .wishlist_table .product-add-to-cart .yith-wcqv-button:focus, .woocommerce .wishlist_table .product-add-to-cart .yith-wcqv-button:active,
                 .elementor-widget-video .elementor-custom-embed-image-overlay:hover .elementor-custom-embed-play i:after,
                 body .single-product-home-cake .elementor-single-product.single-style-2 .slick-arrow:hover,
                 .tab-full_width ul.tabs.wc-tabs li.active a,.page.woocommerce-cart .cart-right .coupon .coupon-form button.button:hover,
                 .page.woocommerce-cart .cart-right .coupon .coupon-form button.button:focus,.page.woocommerce-cart .cart-right .coupon .coupon-form button.button:active,
                 .tab-full_width ul.tabs.wc-tabs li a:hover,.woocommerce .wishlist_table .product-add-to-cart .add-cart a.button,
                .woocommerce .col-xl-12 .product-detail.single_1 div.entry-summary .yith-wcwl-add-to-wishlist a:hover,
                .elementor-single-product.single-style-1 .slick-arrow:hover,.woocommerce form .form-row.woocommerce-validated .select2-container, .woocommerce form .form-row.woocommerce-validated input.input-text, .woocommerce form .form-row.woocommerce-validated select,
                .blog-list .cate-post a,.blog-item.post-link,body.woocommerce ul.products.product-list .product-content .product-desc .product-action .group-action .action-item .yith-wcwl-add-to-wishlist, body.woocommerce ul.products.product-list .product-content .product-desc .product-action .group-action .action-item a.button,
                .quote_section,label.checkcontainer:hover input~.checkmark,input:checked~.checkmark, input:checked~.radiobtn,
                 div.woocommerce nav.woocommerce-pagination .page-numbers li span.current, 
                 body.woocommerce nav.woocommerce-pagination .page-numbers li span.current,body.woocommerce ul.products.product-list .product-content .product-desc .product-action .add-cart .button,
                 .product-action-horizontal-bottom .product-style.product-style-2.product-style-7 .product-grid .product-top .product-action a:hover,.woocommerce-account-fields input[type='checkbox']:hover:before, #ship-to-different-address input[type='checkbox']:hover:before,.woocommerce-account-fields input[type='checkbox']:hover:before, #ship-to-different-address input[type='checkbox']:hover:before,.woocommerce form.woocommerce-form.login .woocommerce-form__label input[type='checkbox']:checked:before,.woocommerce-account-fields input[type='checkbox']:checked:before, #ship-to-different-address input[type='checkbox']:checked:before,.woocommerce-account-fields input[type='checkbox']:checked:before, #ship-to-different-address input[type='checkbox']:checked:before,.woocommerce-cart-form .actions a.button:hover,
                .post-type-archive-product .widget-title, .single-product .widget-title, .tax-product_cat .widget-title,
                .woocommerce .col-xl-12 .product:not(.outofstock) .product-detail.single_1 div.entry-summary .yith-wcwl-add-to-wishlist a:hover,
                .sub-cart a.button,.sub-cart a.button.checkout,.megamenu_sub .apr-banner .btn-bn:hover,
                .sub-cart a.button:focus, .sub-cart a.button:hover,
                .woocommerce-account .woocommerce-MyAccount-navigation li:hover a:before,
                .woocommerce-account .woocommerce-MyAccount-navigation li.is-active a:before,
                .checkbox-custom input:checked~.checkmark,
                .checkbox-custom:not(.disabled):hover input~.checkmark,
                .woocommerce-account div.pp_woocommerce .pp_content_container input[type='submit'],
                .page.woocommerce-cart .box-shipping-cs .shipping-calculator-form button.button,
                .woocommerce-checkout #payment #place_order:hover,
                .apr-product .loadmore-product .view-more-button:hover, .apr-product .loadmore-product .view-more-button:focus,
                body.woocommerce nav.woocommerce-pagination .page-numbers li a.active, 
                body.woocommerce nav.woocommerce-pagination .page-numbers li a:hover, 
                body.woocommerce nav.woocommerce-pagination .page-numbers li span.active, 
                body.woocommerce nav.woocommerce-pagination .page-numbers li span:hover, 
                div.woocommerce nav.woocommerce-pagination .page-numbers li a.active, 
                div.woocommerce nav.woocommerce-pagination .page-numbers li a:hover, 
                div.woocommerce nav.woocommerce-pagination .page-numbers li span.active, 
                div.woocommerce nav.woocommerce-pagination .page-numbers li span:hover,
                .woocommerce-checkout #payment #place_order:hover,.product-action-horizontal-bottom .product-style.product-style-2.product-style-7 .product-grid .product-top .product-action .add-cart-btn a,
                .apr-product .loadmore-product .view-more-button:hover, .apr-product .loadmore-product .view-more-button:focus,
                .woocommerce-checkout #payment #place_order:hover,.woo-list-category.style3 .slick-arrow:hover,.woo-list-category.style3 .slick-arrow:focus,.cascade-slider_arrow:hover,
                .cascade-slider_arrow:focus,
                .apr-product .loadmore-product .view-more-button:hover, .apr-product .loadmore-product .view-more-button:focus,
                .woocommerce .product.product-type-grouped .single_2 div.entry-summary .yith-wcwl-add-to-wishlist a:hover,
                .product-action-horizontal-bottom .product-style.product-style-2.product-style-7 .product-grid .product-top .product-action .add-cart-btn a,
                .fancybox-container.fancybox-is-open .content-product .title-price .action-item.add-cart a:hover,
                 .fancybox-container.fancybox-is-open .content-product .title-price .action-item.add-cart a:focus,
                 .custom-slide-product .apr-product .slick-slider ul.slick-dots li button:before,
				 .sitcky-right .action-item.wishlist-btn a:hover,
                 .product-action-horizontal-bottom .product-style.product-style-2.product-style-7 .product-grid .product-top .product-action .action-item .add-cart-btn a,.bapf_slidr_main.ui-widget-content .ui-slider-handle, .berocket_filter_price_slider.ui-widget-content .ui-slider-handle, .slide.default .bapf_slidr_main .ui-state-default, .slide.default .bapf_slidr_main .ui-widget-header .ui-state-default, .slide.default .bapf_slidr_main.ui-widget-content .ui-state-default, .slide.default .berocket_filter_price_slider .ui-state-default, .slide.default .berocket_filter_price_slider .ui-widget-header .ui-state-default, .slide.default .berocket_filter_price_slider.ui-widget-content .ui-state-default,
                 body.woocommerce .apr-product .woocommerce ul.products.product-list.columns-1 .product-content .product-desc .product-action .action-item .button:hover,body.woocommerce .apr-product .woocommerce ul.products.product-list.columns-1 .product-content .product-desc .product-action .action-item .yith-wcwl-add-to-wishlist.exists ,.product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action a,.product-action-horizontal-bottom .product-style-2.product-style .product-grid .product-top .product-action .action-item a:hover,.product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action a:hover,
                 .product-action-horizontal-bottom .product-style-2 .product-grid .product-top .product-action .group-action a.button:hover,
                 body.woocommerce .apr-product .woocommerce ul.products.product-list.columns-1 .product-content .product-desc .product-action .action-item .yith-wcwl-add-to-wishlist:hover{
                    border-color: $color;
                }
                .block-brand-cs .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
                .show-space-line.apr-nav-menu--main .mega-menu > li > a:hover:before,
				.widget_berocket_aapf_single .berocket_filter_slider.ui-widget-content .ui-slider-handle, .widget_berocket_aapf_single .berocket_filter_price_slider.ui-widget-content .ui-slider-handle,
                .show-space-line.apr-nav-menu--main .mega-menu>li>a:hover:before,
                #yith-quick-view-content div.entry-summary .action-item.wishlist-btn a:hover,
                .woocommerce ul.products .blockOverlay{
                     background-color:$color !important;
                }
                .woocommerce .coupon button.button:hover, .woocommerce .coupon button.button:active, .woocommerce .coupon button.button:focus{
                     border-color: $color !important;
                }
				.icon-sticky::before {
					border-color: transparent $color transparent transparent;
				}
				@media (min-width: 1025px){
                    .elementor-widget-container .apr-nav-menu--main > .mega-menu > li > a:hover,
					.header-default .mega-menu > li.current-menu-item > a, .header-default .mega-menu > li:hover > a {
						color: $color;
					}
                    .elementor-single-product.single-style-2 .btn-single-product a:after,
                    .apr-banner.type_3 .img-banner .button-banner.effect_button .btn-bn .elementor-icon-box-button:before,
                    .btn:before, 
                    .button-banner.effect_button .btn-bn:before,
                    .button:not(.compare):not(.add_to_cart_button):not(.yith-wcqv-button):not(.product_type_grouped):not(.product_type_external):not(.disabled):before, 
                    .efect-btn .elementor-button:before, 
                    .elementor-button:before, 
                    .elementor-icon-box-button:before, 
                    .elementor-single-product .btn-single-product a:before, 
                    .sub-cart .woocommerce a.button.checkout:before, 
                    .sub-cart .woocommerce a.button:before,
                    .sub-cart a.button.checkout{
                        background-color: $color;
                    }
                    header .apr-nav-menu--main:not(.apr-nav-menu--layout-dropdown) > ul > li > a:after,
                    header .apr-nav-menu--main:not(.apr-nav-menu--layout-dropdown) > ul > li > a:before{
                         background: $color;
                    }
                    .product-action-horizontal-middle.wishlist--bottom .wishlist-btn .tooltip-custom::after, 
                    .product-action-horizontal-middle.wishlist--top .wishlist-btn .tooltip-custom::after {
                        border-color: transparent transparent transparent $color !important;
                    }
                    .testimonial-type-1 .slick-slide:hover .item-testimonial,.sub-cart a.button.checkout,
                     .image-carousel-hover figure:hover{
                        border-color: $color;
                    }
                    .bgr-primary .elementor-column-wrap{
                        background-color: $color !important;
                    }
				}
                @media (max-width: 1024px){
                    .woo-list-category ul.children-cate li a:hover::before,
                    .sub-cart a.button:hover {
                        background-color:$color;
                    }
                    .middle-has-wishlist .product-style-2 .product-grid .product-content .product-desc .product-action .add-cart .add-cart-btn a:before,
                    .woo-list-category .list-cate-title:hover,
                    .woo-list-category ul.children-cate li a:hover{
                        color: $color;
                    }
                }
                @media (max-width: 767px){
                    .product-style-6.apr-product .slick-slider .slick-arrow:hover,
                    .woocommerce-product-gallery__wrapper .slick-arrow:focus, .woocommerce-product-gallery__wrapper .slick-arrow:hover,
                    body.woocommerce .apr-product .woocommerce.columns-1 ul.products.product-list.columns-1 .product-content .product-top .product-action .action-item .button:hover{
                        background-color:$color;
                    }
                    .woocommerce-product-gallery__wrapper .slick-arrow:focus, .woocommerce-product-gallery__wrapper .slick-arrow:hover,
					.woocommerce-checkout #payment #place_order:hover,
					body.woocommerce .apr-product .woocommerce.columns-1 ul.products.product-list.columns-1 .product-content .product-top .product-action .action-item .button:hover{
                        border-color: $color;
                    }
					.woocommerce-checkout #payment #place_order:hover{
                        color: $color;
                    }
                }
                @media (min-width: 768px){
                    .apr-product-tab .product-tab-header ul li:after,
                    .product-style-4 .product-grid .product-content .product-top .group-action .action-item a,
                    .product-style-4 .product-action .action-item .add-cart-btn a:hover,
                     div.woocommerce ul.products .product-style-4 .product-content .product-desc .product-action .group-action .action-item a:hover ,
                    .woocommerce .product-style.product-style-4 ul.products .product-content .product-desc .product-action .group-action .action-item a:hover,
                    .woocommerce .product-style.product-style-4 ul.products.product-grid .product-content .product-desc .product-action .group-action .action-item a:hover,
                    div.woocommerce .product-style-4  ul.products.product-grid .product-content .product-desc .product-action .group-action .action-item a:hover{
                        background-color: $color;
                    }
                }";
			}

			return $css;
		}

		function padding_container() {
			$check_padding = lusion_get_meta_value( 'padding_container' );
			if ( isset( $check_padding ) && $check_padding != '' ) {
				$padding = $check_padding;
			} else {
				$padding = Lusion::setting( 'layout_padding_container' );
			}
			$css = '';

			if ( isset( $padding ) && $padding !== '' ) {
				$css = "
                .wide .wrapper>.container-fluid{
                    padding: $padding;
                }";
			}

			return $css;
		}

		# Button Primary color
		function button_primary_color() {
			$css        = '';
			$color_btn  = Lusion::setting( 'btn_primary_color' );
			$color_dark = Lusion::setting( 'btn_dark_color' );
			$color      = $this->check_color( 'site_color', 'primary_color' );
			if ( Lusion::setting( 'btn_custom' ) == 1 && $color !== '' ) {
				$css = "
                    .btn, button, input[type=button], input[type=reset], input[type='submit']{
                        border-color:{$color_btn};
                        color: {$color_btn};
                    }
                    .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle{
                        border-color:{$color_btn};
                        color: {$color_btn};
                    }";
				/* Hover color*/
				$css .= "
                    .btn-primary:active, .btn-primary:focus, .btn-primary:hover,
                    .btn-highlight:active, .btn-highlight:focus, .btn-highlight:hover,
                    .btn-hover.btn-primary,
                    .btn-hover.btn-highlight{
                        border-color:{$color_btn};
                        background-color:{$color_btn};
                    }";
			}
			if ( Lusion::setting( 'btn_custom' ) == 1 && $color_dark !== '' ) {
				$css = "
                   @media (min-width: 1025px){
                        .mc4wp-form-fields input[type='submit']{
                            background: -moz-linear-gradient(to left, $color_dark 50%, $color 50% );
                            background: -webkit-gradient(to left, $color_dark 50%, $color 50% );
                            background: -webkit-linear-gradient(to left, $color_dark 50%, $color 50% );
                            background: -o-linear-gradient(to left, $color_dark 50%, $color 50% );
                            background: -ms-linear-gradient(to left, $color_dark 50%, $color 50% );
                            background: linear-gradient(to left, $color_dark 50%, $color 50% );
                            background-size: 200% 100%;
                            background-position: right bottom;
                          }
                    }";
			}

			return $css;
		}

		function breadcrumbs() {
			$align_breadcrumbs      = lusion_get_meta_value( 'align_breadcrumbs' );
			$breadcrumbs_color      = lusion_get_meta_value( 'breadcrumbs_color' );
			$breadcrumbs_opacity    = lusion_get_meta_value( 'breadcrumbs_opacity' );
			$breadcrumbs_bg_overlay = lusion_get_meta_value( 'breadcrumbs_bg_overlay' );
			$title_color            = lusion_get_meta_value( 'color_page_title' );
			$link_color             = lusion_get_meta_value( 'color_breadcrumb_link' );
			$css                    = '';

			if ( isset( $align_breadcrumbs ) && $align_breadcrumbs !== 'default' && $align_breadcrumbs !== '' ) {
				$css .= "
                div.side-breadcrumb{
                    text-align: {$align_breadcrumbs};
                }";
			}
			if ( isset( $breadcrumbs_color ) && $breadcrumbs_color != '' ) {
				$css .= "
                div.side-breadcrumb .breadcrumb > li,
                div.side-breadcrumb .breadcrumb{
                    color: {$breadcrumbs_color};
                }";
			}
			if ( isset( $title_color ) && $title_color != '' ) {
				$css .= "
                div.side-breadcrumb .page-title h1, div.side-breadcrumb .page-title h2 {
                    color: {$title_color};
                }";
			}
			if ( isset( $link_color ) && $link_color != '' ) {
				$css .= "
                div.side-breadcrumb .breadcrumb .home,
                div.side-breadcrumb .breadcrumb li a,
                div.side-breadcrumb .breadcrumb li:before,
				.side-breadcrumb.breadcrumb_has_bg .breadcrumb li a,
				.side-breadcrumb.breadcrumb_has_bg .breadcrumb li,
				.side-breadcrumb.breadcrumb_has_bg .breadcrumb .home{
                    color: {$link_color};
                }";
			}
			if ( isset( $breadcrumbs_opacity ) && $breadcrumbs_opacity != '' ) {
				$css .= "
                div.side-breadcrumb:before {
                    opacity: {$breadcrumbs_opacity};
                }";
			}
			if ( isset( $breadcrumbs_bg_overlay ) && $breadcrumbs_bg_overlay != '' ) {
				$css .= "
                div.side-breadcrumb:before {
                    background-color: {$breadcrumbs_bg_overlay};
                }";
			}

			return $css;
		}

		function site_background() {
			$site_background = lusion_get_meta_value( 'site_background' );
			$css             = '';
			if ( $site_background != '' ) {
				$css = "
                body{
                    background-color: {$site_background}!important;
                }";
			}

			return $css;
		}

		function mb_single_product_background() {
			$background_color_single_product = lusion_get_meta_value( 'background_color_single_product' );
			$css                             = '';
			if ( $background_color_single_product != '' ) {
				$css = "
                .single-product .wrapper{
                    background-color: {$background_color_single_product} !important;
                }";
			}

			return $css;
		}

		function mb_category_background() {

			global $wp_query;
			$cat           = $wp_query->get_queried_object();
			$term_id       = isset( $cat->term_id ) ? $cat->term_id : 0;
			$bg_color_cate = get_term_meta( $term_id, 'bg_color_cate', true );

			$css = '';
			if ( isset( $bg_color_cate ) && $bg_color_cate != '' ) {
				$css = "
                body.post-type-archive-product, body.single-product, body.tax-product_cat{
                    background-color: {$bg_color_cate};
                }";
			}

			return $css;
		}

		function body_bg_image() {
			$body_bg_image = lusion_get_meta_value( 'body_bg_image' );
			$css           = '';
			if ( $body_bg_image != '' ) {
				$css = "
                body{
                    background-image: url($body_bg_image) !important;
                }";
			}

			return $css;
		}

		function general_shop_background() {
			$general_shop_background = Lusion::setting( 'general_shop_background' );
			$css                     = '';
			if ( $general_shop_background != '' ) {
				$css = "
                .post-type-archive-product,
                .single-product,
                .tax-product_cat{
                    background-color: {$general_shop_background};
                }";
			}

			return $css;
		}

		function header() {
			$sticky_bg = lusion_get_meta_value( 'sticky_bg' );

			$choose_header_builder = Lusion::setting( 'choose_header_builder' );
			$header_type           = lusion_get_meta_value( 'header_type' );
			$css                   = '';
			if ( isset( $sticky_bg ) && $sticky_bg !== '' ) {
				$css = "
                    .header-sticky.is-sticky,
                    .header-default.header-sticky.is-sticky, .header-sticky.is-sticky.header-1 .bg-header , .header-sticky.is-sticky:not(.header-1) .elementor > .elementor-inner > .elementor-section-wrap > .elementor-element{
                        background-color: {$sticky_bg}!important;
                    }";
			}
			if ( is_singular( 'header' ) ) {
				global $post;
				$id = $post->ID;
			} else {
				if ( ! empty( $header_type ) && $header_type !== 'default' ) {
					$id = lusion_get_id_by_slug( lusion_get_meta_value( 'header_type' ), 'header' );
				} else {
					$id = lusion_get_id_by_slug( Lusion::setting( 'choose_header_builder' ), 'header' );
				}
			}
			$header_fix_bg = get_post_meta( $id, 'header_fix_bg', true );
			if ( isset( $header_fix_bg ) && $header_fix_bg != '' ) {
				$css .= "
                     .header-fixed .site-header:not(.is-sticky) > .elementor > .elementor-inner > .elementor-section-wrap > .elementor-element{
                        background-color: {$header_fix_bg}!important;
                    }";
			}

			return $css;
		}

		function site_width() {
			$site_width = lusion_get_meta_value( 'site_width' );
			$css        = '';
			if ( isset( $site_width ) && $site_width != '' ) {
				$css = "
                 @media (min-width: 1200px){
                    .site-width > .wrapper > .container,
                    .elementor-inner .elementor-section.elementor-section-boxed>.elementor-container{
                        max-width: {$site_width};
                    }
                }";
			}

			return $css;
		}

		function remove_space_top() {
			$remove_space_top = lusion_get_meta_value( 'remove_space_top' );
			$css              = '';
			if ( $remove_space_top != '' ) {
				$css = "
                .remove_space_top .side-breadcrumb{
                    margin-bottom: 0 !important;
                }
                .remove_space_top .site-header+.wrapper{
                    padding-top: 0 !important;
                }";
			}

			return $css;
		}

		function remove_space_bottom() {
			$remove_space_bottom = lusion_get_meta_value( 'remove_space_bottom' );
			$css                 = '';
			if ( $remove_space_bottom != '' ) {
				$css = "
               .remove_space_bottom #page-footer,
               .remove_space_bottom  + #page-footer{
                    margin-top: 0 !important;
                }";
			}

			return $css;
		}

		function scroll_top_color() {
			$scroll_top_color = lusion_get_meta_value( 'scroll_top_color' );
			$css              = '';
			if ( $scroll_top_color != '' ) {
				$css = "
                .scroll-to-top {
                    background: {$scroll_top_color};
                }";
			}

			return $css;
		}

		function color_title_breadcrumb() {
			$color_page_title = lusion_get_meta_value( 'color_page_title' );
			$css              = '';
			if ( $color_page_title != '' ) {
				$css = "
                .side-breadcrumb .page-title h1, .side-breadcrumb .page-title h2,.breadcrumb li {
                    color: {$color_page_title};
                }
                .side-breadcrumb .page-title h1:after, .side-breadcrumb .page-title h2:after{
                        background-color: {$color_page_title};
                }";
			}

			return $css;
		}

		function color_link_title_breadcrumb() {
			$color_breadcrumb_link = lusion_get_meta_value( 'color_breadcrumb_link' );
			$css                   = '';
			if ( $color_breadcrumb_link != '' ) {
				$css = "
                .breadcrumb li a,.breadcrumb li .home,.breadcrumb li:before {
                    color: {$color_breadcrumb_link};
                }";
			}

			return $css;
		}

		function icon_button_add_to_cart() {
			$unicode_add_to_cart = Lusion::setting( 'unicode_add_to_cart' );
			$css                 = '';
			if ( $unicode_add_to_cart != '' ) {
				$css = "
                .product-style-2 .product-grid .product-top .product-action .action-item .add-cart-btn a:before{
                    content: '$unicode_add_to_cart';
                    font-weight: 900;
                    font-family: 'Font Awesome 5 Free';
                }";
			}

			return $css;
		}
	}

	new Lusion_Custom_Style();
}
