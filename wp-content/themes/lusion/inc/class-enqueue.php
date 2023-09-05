<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Lusion_Enqueue' ) ) {
	class Lusion_Enqueue {
		protected static $instance = null;

		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_css' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts_js' ), 9999 );
			add_filter( 'tiny_mce_before_init', array( $this, 'override_mce_options' ) );

		}

		public function setup() {
			// Make theme available for translation.
			load_theme_textdomain( 'lusion', get_template_directory() . '/languages' );
			// Theme editor style
			add_editor_style( array( 'style.css' ) );
			// Add theme support
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			/*
			 * Enable support for Post Formats.
			 *
			 * See: https://codex.wordpress.org/Post_Formats
			 */
			add_theme_support( 'post-formats', array(
				'image', 'video', 'audio', 'quote', 'link', 'gallery'
			) );
			// register menu locations
			register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'lusion' ),
			) );
			// Enable custom background image option
			add_theme_support( 'custom-background' );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function admin_scripts_css() {
			// Register & enqueue admin script
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_register_script( 'lusion-admin-js', LUSION_JS . '/un-minify/admin.js', array( 'common', 'jquery', 'media-upload', 'thickbox' ), LUSION_THEME_VERSION, true );
			wp_enqueue_style( 'lusion-admin', LUSION_THEME_URI . '/assets/admin/css/admin.min.css', LUSION_THEME_VERSION, true );
			wp_enqueue_script( 'lusion-admin-js' );

		}

		public function scripts_js() {
			if ( ! is_admin() ) {
				global $wp_styles, $wp_query, $wp_scripts;
				$lusion_woo_enable = $lusion_is_product_enable = $lusion_is_cart = $lusion_fancybox_enable = $lusion_rtl = $post_content = $shop_list = $lusion_slick_enable = $lusion_valid_form = $product_list_mode = $lusion_number_cate = '';
				$lusion_scripts    = array_map( 'basename', (array) wp_list_pluck( $wp_scripts->registered, 'src' ) );
				//				$lusion_suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
				$lusion_suffix = '.min';
				$lusion_srcs   = array_map( 'basename', (array) wp_list_pluck( $wp_styles->registered, 'src' ) );
				function lusion_fonts_url() {
					$font_url                = '';
					$fonts                   = array();
					$subsets                 = 'latin,latin-ext';
					$lusion_breadcrumbs_font = get_post_meta( get_the_ID(), 'breadcrumbs_font', true );
					/*
					Translators: If there are characters in your language that are not supported
					by chosen font(s), translate this to 'off'. Do not translate into your own language.
					 */
					if ( 'off' !== _x( 'on', 'Google font: on or off', 'lusion' ) ) {
						$fonts[] = 'Jost' . ':300,400,400i,500,500i,600,700,700i,800,900&display=swap';
					}
					/*
					 * Translators: To add an additional character subset specific to your language,
					 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
					 */
					$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'lusion' );
					if ( 'cyrillic' == $subset ) {
						$subsets .= ',cyrillic,cyrillic-ext';
					} elseif ( 'greek' == $subset ) {
						$subsets .= ',greek,greek-ext';
					} elseif ( 'devanagari' == $subset ) {
						$subsets .= ',devanagari';
					} elseif ( 'vietnamese' == $subset ) {
						$subsets .= ',vietnamese';
					}
					if ( $fonts ) {
						$font_url = add_query_arg( array(
							'family' => urlencode( implode( '|', $fonts ) ),
							'subset' => urlencode( $subsets ),
						), '//fonts.googleapis.com/css' );
					}

					return esc_url_raw( $font_url );
				}

				if ( class_exists( 'WooCommerce' ) ) {
					$lusion_woo_enable = 'yes';
					$shop_list         = is_product_category();
					$cat               = $wp_query->get_queried_object();
					if ( isset( $cat->term_id ) ) {
						$woo_cat = $cat->term_id;
					} else {
						$woo_cat = '';
					}
					$product_list_mode  = get_metadata( 'product_cat', $woo_cat, 'list_mode_product', true );
					$lusion_number_cate = Lusion::setting( 'number_cate' );
					if ( is_single() && 'product' == get_post_type() ) {
						$lusion_is_product_enable = 'yes';
					}
					if ( is_cart() ) {
						$lusion_is_cart = 'yes';
					}
				}
				$coming_soon_enable         = Lusion::setting( 'coming_soon_enable' );
				$coming_soon_countdown      = Lusion::setting( 'coming_soon_countdown' );
				$single_product_prev        = Lusion::setting( 'single_product_prev' );
				$single_product_next        = Lusion::setting( 'single_product_next' );
				$single_per_limit           = Lusion::setting( 'per_limit' );
				$single_ajax_add_to_cart    = Lusion::setting( 'single_ajax_cart' );
				$popup_newsletter_show      = Lusion::setting( 'popup_newsletter_show' );
				$popup_login_show           = Lusion::setting( 'popup_account_show' );
				$single_zoom_image          = Lusion::setting( 'single_zoom_image' );
				$single_sticky_product      = Lusion::setting( 'single_sticky_product' );
				$popup_sale_show            = Lusion::setting( 'popup_sale_show' );
				$sale_popup_show            = Lusion::setting( 'sale_popup_show' );
				$popup_sale_time_load       = Lusion::setting( 'popup_sale_time_load' );
				$popup_sale_time_load_close = Lusion::setting( 'popup_sale_time_load_close' );
				$sale_popup_time_load       = Lusion::setting( 'sale_popup_time_load' );
				$sale_popup_time_load_item  = Lusion::setting( 'sale_popup_time_load_item' );
				$number_thumbnail_show      = lusion_get_meta_value( 'number_thumbnail_show' );
				if ( isset( $number_thumbnail_show ) && $number_thumbnail_show ) {
					$number_thumbnail_show = $number_thumbnail_show;
				} else {
					$number_thumbnail_show = Lusion::setting( 'number_thumbnail_show' );
				}
				if ( is_singular() && get_option( 'thread_comments' ) ) {
					wp_enqueue_script( 'comment-reply' );
				}
				/* Register Script */
				wp_register_script( 'popper', get_template_directory_uri() . '/assets/js/popper' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
				wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
				wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/slick' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
				wp_register_script( 'validate', get_template_directory_uri() . '/assets/js/jquery.validate' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION );
				wp_register_script( 'lusion-scripts', get_template_directory_uri() . '/assets/js/un-minify/theme_function' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
				wp_register_script( 'slimscroll-scripts', get_template_directory_uri() . '/assets/js/jquery.slimscroll' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
				wp_register_script( 'sticky-kit', get_template_directory_uri() . '/assets/js/sticky-kit' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
				wp_register_script( 'elevatezoom', get_template_directory_uri() . '/assets/js/jquery.elevatezoom' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
				wp_register_script( 'widget-product', get_template_directory_uri() . '/assets/js/elementor/products.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
				/* Register Styles*/
				wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/plugin/bootstrap' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
				wp_register_style( 'font-awesome-theme', get_template_directory_uri() . '/assets/css/font-awesome' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
				wp_register_style( 'lusion', get_template_directory_uri() . '/assets/css/lusion' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
				wp_register_style( 'slick', get_template_directory_uri() . '/assets/css/plugin/slick' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
				wp_register_style( 'lusion-theme', get_template_directory_uri() . '/assets/css/theme' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
				wp_register_style( 'lusion-style', get_template_directory_uri() . '/style.css' );
				wp_dequeue_style( 'font-awesome' );
				wp_deregister_style( 'font-awesome' );
				wp_deregister_style( 'yith-wcwl-font-awesome' );
				wp_deregister_style( 'elementor-icons-shared-0' );


				if ( Lusion::setting( 'custom_css_enable' ) == 1 ) {
					wp_add_inline_style( 'lusion-style', html_entity_decode( Lusion::setting( 'custom_css' ), ENT_QUOTES ) );
				}
				if ( Lusion::setting( 'custom_js_enable' ) == 1 ) {
					wp_add_inline_script( 'lusion-scripts', html_entity_decode( Lusion::setting( 'custom_js' ) ) );
				}
				/* Enqueue Styles & Script */
				wp_enqueue_style( 'bootstrap' );
				wp_enqueue_style( 'font-awesome-theme' );
				wp_enqueue_style( 'lusion-fonts', lusion_fonts_url(), array(), null );
				wp_enqueue_style( 'lusion' );
				if ( is_rtl() ) {
					wp_enqueue_style( 'lusion-theme-rtl', get_template_directory_uri() . '/assets/css/theme_rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
				} else {
					wp_enqueue_style( 'lusion-theme', get_template_directory_uri() . '/assets/css/theme' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
				}
				wp_enqueue_style( 'slick' );
				wp_enqueue_style( 'lusion-style' );

				if ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() && 'post' == get_post_type() || $popup_login_show == '1' || $popup_newsletter_show == '1' ) {
					// Fancybox
					$lusion_fancybox_enable = 'yes';
					wp_register_style( 'fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
					wp_register_script( 'fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
					wp_enqueue_script( 'fancybox' );
					wp_enqueue_style( 'fancybox' );
				}
				if ( post_type_supports( get_post_type(), 'comments' ) ) {
					if ( comments_open() ) {
						$lusion_valid_form = 'yes';
						wp_enqueue_script( 'validate' );
					}
				}
				wp_enqueue_script( 'popper' );
				wp_enqueue_script( 'bootstrap' );
				wp_enqueue_script( 'slick' );
				wp_enqueue_style( 'slick' );
				wp_enqueue_script( 'jquery-ui-autocomplete' );
				wp_enqueue_script( 'lusion-scripts' );
				wp_enqueue_script( 'slimscroll-scripts' );


				$home_fashion_store         = Lusion::setting( 'choose_home_default_stylesheet' );
				$lusion_cross_sells_product = Lusion::setting( 'shopping_cart_cross_sells_enable' );
				$default_home_page_id       = get_option( 'page_on_front' );
				$home_page_slug             = get_post_field( 'post_name', $default_home_page_id );
				$page_slug                  = get_post_field( 'post_name' );
				if ( $page_slug == 'home-slide' ) {
					wp_register_style( 'fullpage', get_template_directory_uri() . '/assets/css/fullpage' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
					wp_register_script( 'fullpage', get_template_directory_uri() . '/assets/js/fullpage' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
					wp_enqueue_script( 'fullpage' );
					wp_enqueue_style( 'fullpage' );
				}

				if ( class_exists( 'YITH_WCQV' ) ) {
					wp_register_style( 'lusion-quickview-product', get_template_directory_uri() . '/assets/css/quick-view' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
					wp_enqueue_style( 'lusion-quickview-product' );
				}
				if ( class_exists( 'WooCommerce' ) && is_product() || class_exists( 'WooCommerce' ) && is_tax( 'yith_product_brand' ) ) {
					if ( is_rtl() ) {
						wp_register_style( 'lusion-category-product', get_template_directory_uri() . '/assets/css/products_rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-category-product' );
						wp_register_style( 'lusion-single-product', get_template_directory_uri() . '/assets/css/single-product-rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-single-product' );
					} else {
						wp_register_style( 'lusion-category-product', get_template_directory_uri() . '/assets/css/products' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-category-product' );
						wp_register_style( 'lusion-single-product', get_template_directory_uri() . '/assets/css/single-product' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-single-product' );
						wp_enqueue_script( 'sticky-kit' );
					}
				}
				if ( is_singular( 'portfolio' ) ) {
					wp_register_style( 'lusion-single-portfolio', get_template_directory_uri() . '/assets/css/single-portfolio' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
					wp_enqueue_style( 'lusion-single-portfolio' );
				}
				if ( ( is_post_type_archive( 'portfolio' ) || taxonomy_exists( 'portfolio_cat' ) ) && ! is_front_page() ) {
					wp_register_style( 'lusion-portfolio', get_template_directory_uri() . '/assets/css/portfolio' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
					wp_enqueue_style( 'lusion-portfolio' );
					wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
					wp_register_script( 'loadmore-isotope', get_template_directory_uri() . '/assets/js/un-minify/loadmore-isotope' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
					wp_enqueue_script( 'isotope' );
					wp_enqueue_script( 'loadmore-isotope' );
				}
				if ( is_page_template( 'coming-soon.php' ) || ( isset( $coming_soon_enable ) && $coming_soon_enable == '1' ) ) {
					wp_register_script( 'countdown-scripts', get_template_directory_uri() . '/assets/js/jquery.countdown' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
					wp_enqueue_script( 'countdown-scripts' );
					wp_register_script( 'countdown-comingsoon-scripts', get_template_directory_uri() . '/assets/js/un-minify/countdown' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
					wp_enqueue_script( 'countdown-comingsoon-scripts' );
					wp_register_style( 'lusion-comingsoon-pages', get_template_directory_uri() . '/assets/css/coming-soon' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
					wp_enqueue_style( 'lusion-comingsoon-pages' );
				}
				if ( is_front_page() && is_home() ) {
					// Default homepage
					wp_deregister_style( 'woocommerce-pre-orders-jquery-ui' );
					wp_deregister_style( 'woocommerce-pre-orders-jquery-ui-theme' );
					wp_deregister_style( 'berocket_aapf_widget-style' );
					wp_deregister_script( 'berocket_aapf_widget-script' );
					// blog page
					if ( is_rtl() ) {
						wp_register_style( 'lusion-blog', get_template_directory_uri() . '/assets/css/blog_rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-blog' );
					} else {
						wp_register_style( 'lusion-blog', get_template_directory_uri() . '/assets/css/blog' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-blog' );
					}
				} elseif ( is_front_page() ) {
					// static homepage
					wp_deregister_style( 'woocommerce-pre-orders-jquery-ui' );
					wp_deregister_style( 'woocommerce-pre-orders-jquery-ui-theme' );
					wp_deregister_style( 'berocket_aapf_widget-style' );
					wp_deregister_style( 'woocommerce-smallscreen' );
					wp_deregister_style( 'wp-block-library' );
					wp_deregister_style( 'wc-block-style' );
					wp_deregister_style( 'wc-block-vendors-style' );
					wp_deregister_style( 'woocommerce-pre-orders-main-css' );
					wp_deregister_style( 'yith-wcbr' );
					wp_deregister_style( 'ywcars-frontend' );
					wp_deregister_style( 'jquery-selectBox' );
					wp_deregister_style( 'contact-form-7' );
					wp_deregister_style( 'wcva-shop-frontend' );
					wp_deregister_style( 'woocommerce_prettyPhoto_css' );
					wp_deregister_style( 'ywcars-common' );
					wp_deregister_style( 'elementor-animations' );
					wp_deregister_script( 'berocket_aapf_widget-script' );
				} elseif ( is_home() || is_singular( 'post' ) || is_post_type_archive() || is_author() || is_category() || is_single() || is_tag() && 'post' == get_post_type() ) {
					// blog page
					if ( is_rtl() ) {
						wp_register_style( 'lusion-blog', get_template_directory_uri() . '/assets/css/blog_rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-blog' );
					} else {
						wp_register_style( 'lusion-blog', get_template_directory_uri() . '/assets/css/blog' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-blog' );
					}
					wp_deregister_style( 'woocommerce-pre-orders-jquery-ui' );
					wp_deregister_style( 'woocommerce-pre-orders-jquery-ui-theme' );
					wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
					wp_register_script( 'loadmore-isotope', get_template_directory_uri() . '/assets/js/un-minify/loadmore-isotope' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
					wp_enqueue_script( 'isotope' );
					wp_enqueue_script( 'loadmore-isotope' );
				} else {
					if ( is_404() ) {
						wp_register_style( 'lusion-error-pages', get_template_directory_uri() . '/assets/css/error-pages' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-error-pages' );
						wp_deregister_style( 'woocommerce-pre-orders-jquery-ui' );
						wp_deregister_style( 'woocommerce-pre-orders-jquery-ui-theme' );
					}
					if ( class_exists( 'WooCommerce' ) && is_page( 'cart' ) && $lusion_cross_sells_product == 1 ) {
						if ( is_rtl() ) {
							wp_register_style( 'lusion-category-product', get_template_directory_uri() . '/assets/css/products_rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
							wp_enqueue_style( 'lusion-category-product' );
						} else {
							wp_register_style( 'lusion-category-product', get_template_directory_uri() . '/assets/css/products' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
							wp_enqueue_style( 'lusion-category-product' );
						}
						wp_register_style( 'lusion-single-product', get_template_directory_uri() . '/assets/css/single-product' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-single-product' );
					}
					if ( class_exists( 'WooCommerce' ) && is_page( 'cart' ) || is_cart() || ( class_exists( 'YITH_WCWL' ) && yith_wcwl_is_wishlist_page() ) || is_page( 'checkout' ) || is_checkout() || is_account_page() ) {
						if ( is_rtl() ) {
							wp_register_style( 'lusion-cart', get_template_directory_uri() . '/assets/css/cart_rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
							wp_enqueue_style( 'lusion-cart' );
						} else {
							wp_register_style(
								'lusion-cart', get_template_directory_uri() . '/assets/css/cart' .
								esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION
							);
							wp_enqueue_style( 'lusion-cart' );
						}
					}
					if ( is_page( 'checkout' ) || is_checkout() ) {
						wp_enqueue_script( 'sticky-kit' );
						if ( is_rtl() ) {
							wp_register_style( 'lusion-shipping', get_template_directory_uri() . '/assets/css/shipping_rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
							wp_enqueue_style( 'lusion-shipping' );
						} else {
							wp_register_style( 'lusion-shipping', get_template_directory_uri() . '/assets/css/shipping' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
							wp_enqueue_style( 'lusion-shipping' );
						}
					}
				}
				if ( is_singular( 'page' ) || is_page() ) {
					global $post;
					$post_id = $post->ID;
					// remove style for gutenberg-blocks in Elementor page.
					if ( $elementor_preview_active = \Elementor\Plugin::$instance->preview->is_preview_mode( $post_id ) ) {
						wp_dequeue_style( 'wp-block-library' ); // WordPress core
						wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
						wp_dequeue_style( 'wc-block-style' ); // WooCommerce
						wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
						wp_dequeue_style( 'wc-block-vendors-style' );
						wp_dequeue_style( 'wc-block-style' );
					}

					wp_deregister_style( 'woocommerce-pre-orders-jquery-ui' );
					wp_deregister_style( 'woocommerce-pre-orders-jquery-ui-theme' );
				}
				if ( ( class_exists( 'WooCommerce' ) && is_shop() ) || ( class_exists( 'WooCommerce' ) && is_tax() ) ) {
					if ( is_rtl() ) {
						wp_register_style( 'lusion-category-product', get_template_directory_uri() . '/assets/css/products_rtl' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-category-product' );
					} else {
						wp_register_style( 'lusion-category-product', get_template_directory_uri() . '/assets/css/products' . esc_html( $lusion_suffix ) . '.css', array(), LUSION_THEME_VERSION );
						wp_enqueue_style( 'lusion-category-product' );
					}
				}
				if ( $single_zoom_image == 1 && ( is_single() && 'product' == get_post_type() ) ) {
					wp_enqueue_script( 'elevatezoom' );
					wp_enqueue_script( 'sticky-kit' );
				}
				wp_localize_script( 'lusion-scripts', 'lusion_params', array(
					'ajax_url'                   => esc_js( admin_url( 'admin-ajax.php' ) ),
					'ajax_loader_url'            => esc_js(
						str_replace( array( 'http:', 'https' ), array( '', '' ),
							LUSION_THEME_IMAGE_URI . '/ajax-loader.gif' )
					),
					'ajax_cart_added_msg'        => esc_html__( 'A product has been added to cart.', 'lusion' ),
					'ajax_compare_added_msg'     => esc_html__( 'A product has been added to compare', 'lusion' ),
					'type_product'               => $product_list_mode,
					'shop_list'                  => $shop_list,
					'lusion_number_cate'         => esc_js( $lusion_number_cate ),
					'lusion_woo_enable'          => esc_js( $lusion_woo_enable ),
					'lusion_is_product_enable'   => esc_js( $lusion_is_product_enable ),
					'lusion_is_cart'             => esc_js( $lusion_is_cart ),
					'lusion_fancybox_enable'     => esc_js( $lusion_fancybox_enable ),
					'lusion_slick_enable'        => esc_js( $lusion_slick_enable ),
					'lusion_valid_form'          => esc_js( $lusion_valid_form ),
					'coming_soon_countdown'      => esc_js( $coming_soon_countdown ),
					'single_product_prev'        => esc_js( $single_product_prev ),
					'single_product_next'        => esc_js( $single_product_next ),
					'single_per_limit'           => esc_js( $single_per_limit ),
					'single_ajax_add_to_cart'    => esc_js( $single_ajax_add_to_cart ),
					'single_zoom_image'          => esc_js( $single_zoom_image ),
					'single_sticky_product'      => esc_js( $single_sticky_product ),
					'number_thumbnail_show'      => esc_js( $number_thumbnail_show ),
					'popup_newsletter_show'      => esc_js( $popup_newsletter_show ),
					'popup_sale_show'            => esc_js( $popup_sale_show ),
					'popup_sale_time_load'       => esc_js( $popup_sale_time_load ),
					'popup_sale_time_load_close' => esc_js( $popup_sale_time_load_close ),
					'sale_popup_show'            => esc_js( $sale_popup_show ),
					'sale_popup_time_load'       => esc_js( $sale_popup_time_load ),
					'sale_popup_time_load_item'  => esc_js( $sale_popup_time_load_item ),
					'lusion_rtl'                 => esc_js( is_rtl() ? 'yes' : '' ),
					'lusion_search_no_result'    => esc_js( __( 'Search no result', 'lusion' ) ),
					'lusion_like_text'           => esc_js( __( 'Like', 'lusion' ) ),
					'lusion_unlike_text'         => esc_js( __( 'Unlike', 'lusion' ) ),
					'request_error'              => esc_js( __( 'The requested content cannot be loaded.<br/>Please try again later.', 'lusion' ) ),
				) );
				wp_deregister_style( 'wpcr_font-awesome' );
			}
		}

		public function override_mce_options( $initArray ) {
			$opts                                 = '*[*]';
			$initArray['valid_elements']          = $opts;
			$initArray['extended_valid_elements'] = $opts;

			return $initArray;
		}
	}

	new Lusion_Enqueue();
}
