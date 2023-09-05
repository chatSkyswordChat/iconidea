<?php
$url_image_preview = 'https://arrowtheme.github.io/demo-data/lusion/images';
$plugin_required   = array(
	'elementor',
	'classic-widgets',
	'woocommerce',
	'woocommerce-currency-switcher',
	'woocommerce-colororimage-variation-select',
	'woocommerce-ajax-filters',
	'yith-woocommerce-compare',
	'yith-woocommerce-quick-view',
	'yith-woocommerce-wishlist',
	'yith-woocommerce-brands-add-on',
	'mailchimp-for-wp',
	'contact-form-7'
);
$revolution        = array(
	'revslider'
);

return array(
	'demo-fashion-store'     => array(
		'title'            => 'Home Fashion Store',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-fashion-store',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-fashion-store.jpg',
		'revsliders'       => array(
			'home-fashion-store.zip'
		),

	),
	'demo-fashion-brand'     => array(
		'title'            => 'Home Fashion Brand',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-fashion-brand',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-fashion-brand.jpg',
		'revsliders'       => array(
			'home-brand.zip'
		),
	),
	'demo-lookbook'          => array(
		'title'            => 'Home Lookbook',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-lookbook',
		'default_xml'      => true,
		'plugins_required' => $plugin_required,
		'thumbnail_url'    => $url_image_preview . '/home-lookbook.jpg',
	),
	'demo-minimalist'        => array(
		'title'            => 'Home Minimalist',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-minimalist',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-minimalist.jpg',
		'revsliders'       => array(
			'home-minimalist.zip'
		),
	),
	'demo-slide'             => array(
		'title'            => 'Home Slide',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-slide',
		'default_xml'      => true,
		'plugins_required' => $plugin_required,
		'thumbnail_url'    => $url_image_preview . '/home-slide.jpg'
	),
	'demo-christmas'         => array(
		'title'            => 'Home Christmas',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-christmas',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-christmas.jpg',
		'revsliders'       => array(
			'home-christmas.zip'
		),
	),
	'demo-christmas-2'       => array(
		'title'            => 'Home Christmas 2',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-christmas-2',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-christmas-2.jpg',
		'revsliders'       => array(
			'home-xmas.zip'
		),
	),
	'demo-shoe-shop'         => array(
		'title'            => 'Home Shoe Shop',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-shose-shop',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-shose.jpg',
		'revsliders'       => array(
			'home-shoe.zip'
		),
	),
	'demo-bag-shop'          => array(
		'title'            => 'Home Bag Shop',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-bag-shop',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-bag.jpg',
		'revsliders'       => array(
			'home-bag.zip'
		),
	),
	'demo-full-option'       => array(
		'title'            => 'Home Full Option',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-full-option',
		'default_xml'      => true,
		'plugins_required' => $plugin_required,
		'thumbnail_url'    => $url_image_preview . '/home-full-option.jpg'
	),
	'demo-fashion-men-women' => array(
		'title'            => 'Home Fashion Men Women',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-fashion-men-women',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-fashion-for-men-and-women.jpg',
		'revsliders'       => array(
			'home-fashion-women-men.zip'
		),
	),
	'demo-fashion-women'     => array(
		'title'            => 'Home Fashion Women',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-fashion-women',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-fashion-women.jpg',
		'revsliders'       => array(
			'women-fashion.zip'
		),
	),
	'demo-fashion-children'  => array(
		'title'            => 'Home Fashion Children',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-fashion-children',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-children-fashion.jpg',
		'revsliders'       => array(
			'home-fashion-children.zip'
		),
	),
	'demo-fashion-men'       => array(
		'title'            => 'Home Fashion Men',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-fashion-men',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-men-fashion.jpg',
		'revsliders'       => array(
			'home-fashion-men.zip'
		),
	),
	'demo-fashion-newborn'   => array(
		'title'            => 'Home Fashion Newborn',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-fashion-newborn',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-fashion-newborn.jpg',
		'revsliders'       => array(
			'home-fashion-newborn.zip'
		),
	),
	'demo-accesories'        => array(
		'title'            => 'Home Accesories',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-accesories',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-accessories.jpg',
		'revsliders'       => array(
			'home-accessories.zip'
		),
	),
	'demo-instagrams'        => array(
		'title'            => 'Home Instagrams',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-instargam',
		'default_xml'      => true,
		'plugins_required' => $plugin_required,
		'thumbnail_url'    => $url_image_preview . '/home-instargam.jpg'
	),
	'demo-food'              => array(
		'title'            => 'Home Food',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-food',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-food.jpg',
		'revsliders'       => array(
			'home-food.zip'
		),
	),
	'demo-cake-shop'         => array(
		'title'            => 'Home Cake Shop',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-cake-shop',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-sweets-bakery.jpg',
		'revsliders'       => array(
			'home-cake-shop.zip'
		),
	),
	'demo-organic'           => array(
		'title'            => 'Home Organic',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-organic',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-organic.jpg',
		'revsliders'       => array(
			'home-organic.zip'
		),
	),
	'demo-liquor-store'      => array(
		'title'            => 'Home Liquor Store',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-liquor-store',
		'default_xml'      => true,
		'plugins_required' => $plugin_required,
		'thumbnail_url'    => $url_image_preview . '/home-drinks.jpg'
	),
	'demo-decor'             => array(
		'title'            => 'Home Decor',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-decor',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-decor.jpg',
		'revsliders'       => array(
			'home-decor.zip',
		),
	),
	'demo-furniture'         => array(
		'title'            => 'Home Furniture',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-furniture',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-furniture.jpg',
		'revsliders'       => array(
			'home-furniture.zip'
		),
	),
	'demo-handmade'          => array(
		'title'            => 'Home Handmade',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-handmade',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-handmade.jpg',
		'revsliders'       => array(
			'home-handmade.zip'
		),
	),
	'demo-watch'             => array(
		'title'            => 'Home Watch',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-watch',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-watch.png',
		'revsliders'       => array(
			'home-watch.zip'
		),
	),
	'demo-smart-watch'       => array(
		'title'            => 'Smart Watch',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-watch',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/smart-watch.jpg',
		'revsliders'       => array(
			'smart-watch.zip'
		),
	),
	'demo-valentine'         => array(
		'title'            => 'Home Valentine',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-valentine',
		'default_xml'      => true,
		'plugins_required' => $plugin_required,
		'thumbnail_url'    => $url_image_preview . '/home-valentine.jpg'
	),
	'demo-minimalist-boxed'  => array(
		'title'            => 'Home Minimalist Boxed',
		'demo_url'         => 'https://lusion.arrowtheme.com/home-minimalist-boxed',
		'default_xml'      => true,
		'plugins_required' => array_merge( $plugin_required, $revolution ),
		'thumbnail_url'    => $url_image_preview . '/home-minimalist-boxed.png',
		'revsliders'       => array(
			'home-minimalist.zip'
		),
	),
	'demo-new-year'          => array(
		'title'            => 'Home New Year',
		'demo_url'         => 'https://lusion.arrowtheme.com/new-year/',
		'default_xml'      => true,
		'plugins_required' => $plugin_required,
		'thumbnail_url'    => $url_image_preview . '/new-year.png'
	),
);
