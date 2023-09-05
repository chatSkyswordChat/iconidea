<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Initialize Global Variables
 */
if ( ! class_exists( 'Lusion_Global' ) ) {
	class Lusion_Global {
		protected static $instance = null;
		protected static $header_type = '01';
		protected static $footer_type = '01';
		public $has_sidebar = false;
		public $has_both_sidebar = false;
		public $wishlist_tooltip_position = 'left';

		function __construct() {
			add_action( 'wp', array( $this, 'init_global_variable' ) );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init_global_variable() {
			global $lusion_page_options;
			if ( is_singular( 'portfolio' ) ) {
				$lusion_page_options = unserialize( get_post_meta( get_the_ID(), 'apr_portfolio_options', true ) );
			} elseif ( is_singular( 'post' ) ) {
				$lusion_page_options = unserialize( get_post_meta( get_the_ID(), 'apr_post_options', true ) );
			} elseif ( is_singular( 'page' ) ) {
				$lusion_page_options = unserialize( get_post_meta( get_the_ID(), 'apr_page_options', true ) );
			} elseif ( is_singular( 'product' ) ) {
				$lusion_page_options = unserialize( get_post_meta( get_the_ID(), 'apr_product_options', true ) );
			}
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				// Get page id of shop.
				$page_id             = wc_get_page_id( 'shop' );
				$lusion_page_options = unserialize( get_post_meta( $page_id, 'apr_page_options', true ) );
			}
			$this->set_footer_type();
		}

		function set_footer_type() {
			$result = '';
			global $wp_query, $footer_type;
			if ( empty( $footer_type ) ) {
				$result = Lusion::setting( 'global_footer' );
				if ( is_category() ) {
					$cat        = $wp_query->get_queried_object();
					$cat_layout = get_metadata( 'category', $cat->term_id, 'footer_type', true );
					if ( ! empty( $cat_layout ) && $cat_layout != 'default' ) {
						$result = $cat_layout;
					}
				} else if ( is_archive() ) {
					if ( function_exists( 'is_shop' ) && is_shop() ) {
						$shop_layout = get_post_meta( wc_get_page_id( 'shop' ), 'footer_type', true );
						if ( ! empty( $shop_layout ) && $shop_layout != 'default' ) {
							$result = $shop_layout;
						}
					}
				} else {
					$footer_layout_page = get_post_meta( get_the_ID(), 'footer_type', true );
					if ( $footer_layout_page && $footer_layout_page != 'default' && $result != 'none' ) {
						$result = $footer_layout_page;
					}
				}
				$footer_type = $result;
			}

			return $footer_type;
		}

		function get_footer_type() {
			return self::$footer_type;
		}

		public static function is_blog() {
			global $post;
			$posttype = get_post_type( $post );

			return ( ( ( is_archive() ) || ( is_author() ) || ( is_category() ) || ( is_home() ) || ( is_single() ) || ( is_tag() ) ) && ( $posttype == 'post' ) ) ? true : false;
		}

		public static function is_shop() {
			return ( is_post_type_archive( 'product' ) );
		}

		public static function check_container_type() {
			$layout_site        = Lusion::setting( 'layout_site' );
			$blog_layout        = Lusion::setting( 'blog_general_layout' );
			$portfolio_layout   = Lusion::setting( 'portfolio_layout' );
			$shop_layout        = Lusion::setting( 'shop_layout' );
			$single_shop_layout = Lusion::setting( 'single_layout' );
			if ( is_404() ) {
				$container = 'container-fluid';
			} elseif ( self::is_blog() ) {
				if ( $blog_layout === 'wide' ) {
					$container = 'container-fluid';
				} elseif ( $blog_layout === 'full_width' ) {
					$container = 'container';
				} else {
					$container = 'container-fluid';
				}
			} elseif ( 'portfolio' == get_post_type() ) {
				if ( $portfolio_layout === 'wide' ) {
					$container = 'container-fluid';
				} elseif ( $portfolio_layout === 'full_width' ) {
					$container = 'container';
				} else {
					$container = 'container-fluid';
				}
			} elseif ( class_exists( 'WooCommerce' ) && is_singular( 'product' ) ) {
				if ( $single_shop_layout === 'wide' ) {
					$container = 'container-fluid';
				} elseif ( $single_shop_layout === 'full_width' ) {
					$container = 'container';
				} else {
					$container = 'container-fluid';
				}
			} elseif ( class_exists( 'WooCommerce' ) && 'product' == get_post_type() ) {
				if ( $shop_layout === 'wide' ) {
					$container = 'container-fluid';
				} elseif ( $shop_layout === 'full_width' ) {
					$container = 'container';
				} else {
					$container = 'container-fluid';
				}
			} else {
				if ( $layout_site === 'wide' ) {
					$container = 'container-fluid';
				} elseif ( $layout_site === 'full_width' ) {
					$container = 'container';
				} else {
					$container = 'container-fluid';
				}
			}

			return $container;
		}

		public static function check_layout_type() {
			$layout_site        = Lusion::setting( 'layout_site' );
			$blog_layout        = Lusion::setting( 'blog_general_layout' );
			$portfolio_layout   = Lusion::setting( 'portfolio_layout' );
			$shop_layout        = Lusion::setting( 'shop_layout' );
			$single_shop_layout = Lusion::setting( 'single_layout' );
			if ( is_404() ) {
				$page_layout = 'wide';
			} elseif ( self::is_blog() ) {
				if ( $blog_layout === 'wide' ) {
					$page_layout = 'wide';
				} elseif ( $blog_layout === 'full_width' ) {
					$page_layout = 'full';
				} else {
					$page_layout = 'boxed';
				}
			} elseif ( 'portfolio' == get_post_type() ) {
				if ( $portfolio_layout === 'wide' ) {
					$page_layout = 'wide';
				} elseif ( $portfolio_layout === 'full_width' ) {
					$page_layout = 'full';
				} else {
					$page_layout = 'boxed';
				}
			} elseif ( class_exists( 'WooCommerce' ) && 'product' == get_post_type() ) {
				if ( $shop_layout === 'wide' ) {
					$page_layout = 'wide';
				} elseif ( $shop_layout === 'full_width' ) {
					$page_layout = 'full';
				} else {
					$page_layout = 'boxed';
				}
			} elseif ( class_exists( 'WooCommerce' ) && is_singular( 'product' ) ) {
				if ( $single_shop_layout === 'wide' ) {
					$page_layout = 'wide';
				} elseif ( $single_shop_layout === 'full_width' ) {
					$page_layout = 'full';
				} else {
					$page_layout = 'boxed';
				}
			} else {
				if ( $layout_site === 'wide' ) {
					$page_layout = 'wide';
				} elseif ( $layout_site === 'full_width' ) {
					$page_layout = 'full';
				} else {
					$page_layout = 'boxed';
				}
			}

			return $page_layout;
		}

		public static function get_left_sidebar() {
			$lusion_left_sidebar     = get_post_meta( get_the_ID(), 'left_sidebar_general', true );
			$filter_top_product      = lusion_get_meta_value( 'filter_top_product' );
			$shop_archive_filter_top = Lusion::setting( 'shop_archive_filter_top' );
			if ( ! is_404() ) {
				if ( self::is_blog() ) {
					if ( is_category() ) {
						$lusion_left_sidebar_cat = lusion_get_meta_value( 'left_sidebar', false );
						if ( $lusion_left_sidebar_cat != 'default' && $lusion_left_sidebar_cat !== 'none' && $lusion_left_sidebar_cat !== '' ) {
							$sidebar_left = $lusion_left_sidebar_cat;
						} elseif ( $lusion_left_sidebar_cat === 'none' ) {
							$sidebar_left = 'none';
						} else {
							$sidebar_left = Lusion::setting( 'blog_sidebar_left' );
						}
					} else {
						if ( self::is_blog() && is_singular() ) {
							if ( $lusion_left_sidebar != 'default' && $lusion_left_sidebar !== 'none' && $lusion_left_sidebar !== '' ) {
								$sidebar_left = $lusion_left_sidebar;
							} elseif ( $lusion_left_sidebar === 'none' ) {
								$sidebar_left = 'none';
							} else {
								$sidebar_left = Lusion::setting( 'blog_single_sidebar_left' );
							}
						} else {
							if ( $lusion_left_sidebar != 'default' && $lusion_left_sidebar !== 'none' && $lusion_left_sidebar !== '' ) {
								$sidebar_left = $lusion_left_sidebar;
							} else {
								$sidebar_left = Lusion::setting( 'blog_sidebar_left' );
							}
						}
					}
				} elseif ( is_tax( 'product_cat' ) ) {
					$lusion_left_sidebar_product = lusion_get_meta_value( 'product_left_sidebar' );
					if ( $lusion_left_sidebar_product !== 'default' && $lusion_left_sidebar_product !== 'none' && $lusion_left_sidebar_product !== '' ) {
						$sidebar_left = $lusion_left_sidebar_product;
					} elseif ( $lusion_left_sidebar_product === 'none' ) {
						$sidebar_left = 'none';
					} else {
						$sidebar_left = Lusion::setting( 'shop_sidebar_left' );
					}
				} elseif ( is_singular( 'product' ) ) {
					if ( $lusion_left_sidebar !== 'default' && $lusion_left_sidebar !== 'none' && $lusion_left_sidebar !== '' ) {
						$sidebar_left = $lusion_left_sidebar;
					} elseif ( $lusion_left_sidebar === 'none' ) {
						$sidebar_left = 'none';
					} else {
						$sidebar_left = Lusion::setting( 'single_sidebar_left' );
					}
				} elseif ( self::is_shop() || ( ( is_tax( 'product_tag' ) || is_tax( 'yith_product_brand' ) ) && class_exists( 'WooCommerce' ) ) ) {
					$sidebar_left = Lusion::setting( 'shop_sidebar_left' );
				} else {
					if ( $lusion_left_sidebar != 'default' && $lusion_left_sidebar !== 'none' && $lusion_left_sidebar !== '' ) {
						$sidebar_left = $lusion_left_sidebar;
					} elseif ( $lusion_left_sidebar === 'none' ) {
						$sidebar_left = 'none';
					} else {
						$sidebar_left = Lusion::setting( 'general_left_sidebar' );
					}
				}

			}

			return $sidebar_left;
		}

		public static function get_right_sidebar() {
			$lusion_right_sidebar    = get_post_meta( get_the_ID(), 'right_sidebar_general', true );
			$filter_top_product      = lusion_get_meta_value( 'filter_top_product' );
			$shop_archive_filter_top = Lusion::setting( 'shop_archive_filter_top' );
			if ( ! is_404() ) {
				if ( self::is_blog() ) {
					if ( is_category() ) {
						$lusion_right_sidebar_cat = lusion_get_meta_value( 'right_sidebar', false );
						if ( $lusion_right_sidebar_cat != 'default' && $lusion_right_sidebar_cat !== 'none' && $lusion_right_sidebar_cat !== '' ) {
							$sidebar_right = $lusion_right_sidebar_cat;
						} elseif ( $lusion_right_sidebar_cat === 'none' ) {
							$sidebar_right = 'none';
						} else {
							$sidebar_right = Lusion::setting( 'blog_sidebar_right' );
						}
					} else {
						if ( self::is_blog() && is_singular() ) {
							if ( $lusion_right_sidebar != 'default' && $lusion_right_sidebar !== 'none' && $lusion_right_sidebar !== '' ) {
								$sidebar_right = $lusion_right_sidebar;
							} elseif ( $lusion_right_sidebar === 'none' ) {
								$sidebar_right = 'none';
							} else {
								$sidebar_right = Lusion::setting( 'blog_single_sidebar_right' );
							}
						} else {
							if ( $lusion_right_sidebar != 'default' && $lusion_right_sidebar !== 'none' && $lusion_right_sidebar !== '' ) {
								$sidebar_right = $lusion_right_sidebar;
							} else {
								$sidebar_right = Lusion::setting( 'blog_sidebar_right' );
							}
						}
					}
				} elseif ( is_tax( 'product_cat' ) ) {
					$lusion_right_sidebar_product = lusion_get_meta_value( 'product_right_sidebar' );
					if ( $lusion_right_sidebar_product !== 'default' && $lusion_right_sidebar_product !== 'none' && $lusion_right_sidebar_product !== '' ) {
						$sidebar_right = $lusion_right_sidebar_product;
					} elseif ( $lusion_right_sidebar_product === 'none' ) {
						$sidebar_right = 'none';
					} else {
						$sidebar_right = Lusion::setting( 'shop_sidebar_right' );
					}
				} elseif ( self::is_shop() || ( ( is_tax( 'product_tag' ) || is_tax( 'yith_product_brand' ) ) && class_exists( 'WooCommerce' ) ) ) {
					$sidebar_right = Lusion::setting( 'shop_sidebar_right' );
				} elseif ( is_singular( 'product' ) ) {
					if ( $lusion_right_sidebar !== 'default' && $lusion_right_sidebar !== 'none' && $lusion_right_sidebar !== '' ) {
						$sidebar_right = $lusion_right_sidebar;
					} elseif ( $lusion_right_sidebar === 'none' ) {
						$sidebar_right = 'none';
					} else {
						$sidebar_right = Lusion::setting( 'single_sidebar_right' );
					}
				} else {
					if ( ( $lusion_right_sidebar !== 'default' ) && ( $lusion_right_sidebar !== 'none' ) && $lusion_right_sidebar !== '' ) {
						$sidebar_right = $lusion_right_sidebar;
					} elseif ( $lusion_right_sidebar === 'none' ) {
						$sidebar_right = 'none';
					} else {
						$sidebar_right = Lusion::setting( 'general_right_sidebar' );
					}
				}
			}

			return $sidebar_right;
		}

		public static function get_page_sidebar() {
			$page_sidebar1           = self::get_left_sidebar();
			$page_sidebar2           = self::get_right_sidebar();
			$shop_archive_filter_top = '';
			$filter_top_product      = lusion_get_meta_value( 'filter_top_product' );
			$shop_archive_filter     = Lusion::setting( 'shop_archive_filter' );
			if ( ( isset( $filter_top_product ) && $filter_top_product == 1 ) ) {
				$shop_archive_filter_top = $filter_top_product;
			} else {
				$shop_archive_filter_top = Lusion::setting( 'shop_archive_filter_top' );
			}
			if ( ! is_404() || is_page_template( 'coming-soon.php' ) ) {
				if ( $page_sidebar1 !== 'none' && $page_sidebar1 !== '' && $page_sidebar2 !== 'none' && $page_sidebar2 !== '' && is_active_sidebar( $page_sidebar1 ) && is_active_sidebar( $page_sidebar2 ) ) {
					$cols = 'col-xl-6 col-lg-6 col-md-12 col-sm-12 main-sidebar has-sidebar';
				} elseif ( ( $page_sidebar1 !== 'none' && $page_sidebar1 !== '' && is_active_sidebar( $page_sidebar1 ) ) || ( $page_sidebar2 !== 'none' && $page_sidebar2 !== '' && is_active_sidebar( $page_sidebar2 ) ) ) {
					if ( $shop_archive_filter_top == 1 && $shop_archive_filter == 1 && ( is_tax( 'product_cat' ) || ( self::is_shop() || ( ( is_tax( 'product_tag' ) || is_tax( 'yith_product_brand' ) ) && class_exists( 'WooCommerce' ) ) ) ) ) {
						$cols = 'col-xl-12 col-lg-12 col-md-12 col-sm-12 main-sidebar has-sidebar';
					} else if ( $shop_archive_filter_top !== 1 && $shop_archive_filter == 1 && ( is_active_sidebar( $page_sidebar1 ) || is_active_sidebar( $page_sidebar2 ) ) && ( is_tax( 'product_cat' ) || ( self::is_shop() || ( ( is_tax( 'product_tag' ) || is_tax( 'yith_product_brand' ) ) && class_exists( 'WooCommerce' ) ) ) ) ) {
						$cols = 'col-xl-12 col-lg-12 col-md-12 col-sm-12 main-sidebar has-sidebar';
					} else {
						$cols = 'col-xl-9 col-lg-9 col-md-12 col-sm-12 main-sidebar has-sidebar';
					}
				} else {
					$cols = 'col-xl-12 col-lg-12 col-md-12 col-sm-12 main-sidebar';
				}

				return $cols;
			}
		}
	}

	global $lusion_vars;
	$lusion_vars = new Lusion_Global();
}
