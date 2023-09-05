<?php
function lusion_pingback_header() {
	echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
}

add_action( 'wp_head', 'lusion_pingback_header' );
// Customs icon markers
if ( class_exists( 'WP_Store_locator' ) ) {
	add_filter( 'wpsl_admin_marker_dir', 'lusion_custom_admin_marker_dir' );
	add_filter( 'wpsl_marker_props', 'lusion_custom_marker_props' );
	function lusion_custom_admin_marker_dir() {
		$admin_marker_dir = get_stylesheet_directory() . '/wpsl-markers/';

		return $admin_marker_dir;
	}

	function lusion_custom_marker_props( $marker_props ) {
		$marker_props['scaledSize'] = '36,53'; // Set this to 50% of the original size
		$marker_props['origin']     = '0,0';
		$marker_props['anchor']     = '18,35';

		return $marker_props;
	}

	define( 'WPSL_MARKER_URI', dirname( get_bloginfo( 'stylesheet_url' ) ) . '/wpsl-markers/' );
}

if ( ! function_exists( 'lusion_get_search_form' ) ) {
	function lusion_get_search_form() {
		$template = get_search_form( false );
		$output   = '';
		ob_start();
		?>
		<?php echo wp_kses( $template, lusion_allow_html() ); ?>
		<?php
		$output .= ob_get_clean();

		return $output;
	}
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'lusion_yith_wcwl_ajax_update_count' ) ) {
	function lusion_yith_wcwl_ajax_update_count() {
		wp_send_json( array(
			'count' => yith_wcwl_count_all_products()
		) );
	}

	add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'lusion_yith_wcwl_ajax_update_count' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'lusion_yith_wcwl_ajax_update_count' );
}
function categories_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', ' </span>', $variable );

	return $variable;
}

add_filter( 'wp_list_categories', 'categories_postcount_filter' );
function archive_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', ' </span>', $variable );

	return $variable;
}

add_filter( 'get_archives_link', 'archive_postcount_filter' );
function lusion_get_meta_value( $meta_key, $boolean = false ) {
	global $wp_query, $lusion_settings;

	$value = '';
	if ( is_category() ) {
		$cat   = $wp_query->get_queried_object();
		if($cat){
			$value = get_metadata( 'category', $cat->term_id, $meta_key, true );
		}
 	} elseif ( is_tax( 'product_cat' ) ) {
		$cat   = $wp_query->get_queried_object();
		$value = get_metadata( 'product_cat', $cat->term_id, $meta_key, true );
	} elseif ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if ( $term ) {
			$value = get_metadata( $term->taxonomy, $term->term_id, $meta_key, true );
		}
	} elseif ( is_archive() ) {
		if ( function_exists( 'is_shop' ) && is_shop() ) {
			$value = get_post_meta( wc_get_page_id( 'shop' ), $meta_key, true );
		} else {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if ( $term ) {
				$value = get_metadata( $term->taxonomy, $term->term_id, $meta_key, true );
			}

		}
	} else {
		if ( is_singular() ) {
			$value = get_post_meta( get_the_id(), $meta_key, true );
		} else {
			if ( ! is_home() && is_front_page() ) {
				if ( isset( $lusion_settings[$meta_key] ) ) {
					$value = $lusion_settings[$meta_key];
				}
			} elseif ( is_home() && ! is_front_page() ) {

				if ( isset( $lusion_settings['blog-' . $meta_key] ) ) {
					$value = $lusion_settings['blog-' . $meta_key];
				} else {
					$value = get_post_meta( get_queried_object_id(), $meta_key, true );
				}
			} elseif ( is_home() || is_front_page() ) {
				if ( isset( $lusion_settings[$meta_key] ) ) {
					$value = $lusion_settings[$meta_key];
				}
			}
		}
	}

	if ( $boolean ) {
		$value = ( $value != $meta_key ) ? true : false;
	}

	return $value;
}

if ( ! function_exists( 'lusion_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function lusion_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}
if ( ! function_exists( 'lusion_get_layout_class' ) ) {
	/**
	 * Return layout class when sidebar displays
	 *
	 * @return [string] [lusion_class]
	 */
	function lusion_get_layout_class() {
		$lusion_class         = '';
		$lusion_layout        = Lusion_Helper::get_post_meta( 'layout' );
		$lusion_sidebar_left  = Lusion_Global::get_left_sidebar();
		$lusion_sidebar_right = Lusion_Global::get_right_sidebar();
		/** Sidebar left & right  */
		if ( $lusion_sidebar_left && $lusion_sidebar_right && is_active_sidebar( $lusion_sidebar_left ) && is_active_sidebar( $lusion_sidebar_right ) ) {
			$lusion_class .= 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 main-sidebar has-sidebar';
			/** Only sidebar left  */
		} elseif ( $lusion_sidebar_left && ( ! $lusion_sidebar_right || $lusion_sidebar_right == "none" ) && is_active_sidebar( $lusion_sidebar_left ) ) {
			$lusion_class .= 'f-right col-lg-9 col-md-12 col-sm-12 col-xs-12 main-sidebar has-sidebar';
			/** Only sidebar right  */
		} elseif ( ( ! $lusion_sidebar_left || $lusion_sidebar_left == "none" ) && $lusion_sidebar_right && is_active_sidebar( $lusion_sidebar_right ) ) {
			$lusion_class .= 'col-lg-9 col-md-12 col-sm-12 col-xs-12 main-sidebar has-sidebar';
			/** No sidebar  */
		} else {
			$lusion_class .= 'col-lg-12 col-md-12 col-sm-12 col-xs-12 main-sidebar';
			if ( $lusion_layout == 'fullwidth' ) {
				$lusion_class .= ' col-md-12';
			}
		}

		return $lusion_class;
	}
}
if ( ! function_exists( 'lusion_allow_html' ) ) {
	function lusion_allow_html() {
		return array(
			'form'   => array(
				'role'   => array(),
				'method' => array(),
				'class'  => array(),
				'action' => array(),
				'id'     => array(),
			),
			'input'  => array(
				'type'          => array(),
				'name'          => array(),
				'class'         => array(),
				'title'         => array(),
				'id'            => array(),
				'value'         => array(),
				'placeholder'   => array(),
				'autocomplete'  => array(),
				'data-number'   => array(),
				'data-keypress' => array(),
			),
			'button' => array(
				'type'  => array(),
				'name'  => array(),
				'class' => array(),
				'title' => array(),
				'id'    => array(),
			),
			'img'    => array(
				'src'   => array(),
				'alt'   => array(),
				'class' => array(),
			),
			'div'    => array(
				'class' => array(),
			),
			'h4'     => array(
				'class' => array(),
			),
			'a'      => array(
				'class'         => array(),
				'href'          => array(),
				'onclick'       => array(),
				'aria-expanded' => array(),
				'aria-haspopup' => array(),
				'data-toggle'   => array(),
			),
			'i'      => array(
				'class' => array(),
			),
			'p'      => array(
				'class' => array(),
			),
			'br'     => array(),
			'span'   => array(
				'class'   => array(),
				'onclick' => array(),
				'style'   => array(),
			),
			'strong' => array(
				'class' => array(),
			),
			'em'     => array(
				'class' => array(),
			),
			'ul'     => array(
				'class' => array(),
			),
			'li'     => array(
				'class' => array(),
			),
			'del'    => array(),
			'ins'    => array(),
			'select' => array(
				'class' => array(),
				'name'  => array(),
			),
			'option' => array(
				'class' => array(),
				'value' => array(),
			),
		);
	}
}

function lusion_ajax_qty_cart() {

	// Set item key as the hash found in input.qty's name
	$cart_item_key = $_POST['hash'];

	// Get the array of values owned by the product we're updating
	$threeball_product_values = WC()->cart->get_cart_item( $cart_item_key );

	// Get the quantity of the item in the cart
	$threeball_product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var( $_POST['quantity'], FILTER_SANITIZE_NUMBER_INT ) ) ), $cart_item_key );

	// Update cart validation
	$passed_validation = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity );

	// Update the quantity of the item in the cart
	if ( $passed_validation ) {
		WC()->cart->set_quantity( $cart_item_key, $threeball_product_quantity, true );
	}

	// Refresh the page
	$result = [ 'html' => wc_get_template_html( '../woocommerce/cart/mini-cart.php' ), 'count' => WC()->cart->cart_contents_count ];
	echo json_encode( $result );
	die();

}

add_action( 'wp_ajax_qty_cart', 'lusion_ajax_qty_cart' );
add_action( 'wp_ajax_nopriv_qty_cart', 'lusion_ajax_qty_cart' );
function lusion_posts_per_page( $query ) {
	global $wp_query;
	$lusion_post_per_page       = $lusion_portfolio_per_page_cate = '';
	$lusion_product_per_page    = Lusion::setting( 'shop_archive_number_item' );
	$lusion_portfolio_per_page  = Lusion::setting( 'portfolio_archive_number_item' );
	$single_post_related_number = Lusion::setting( 'single_post_related_number' );
	if ( is_category() ) {
		$category = $wp_query->get_queried_object();
		if ( isset( $category ) ) {
			$cat_id = $category->term_id;
			if ( get_metadata( 'category', $cat_id, 'post_per_page', true ) != '' ) {
				$lusion_post_per_page = get_metadata( 'category', $cat_id, 'post_per_page', true );
				$query->set( 'posts_per_page', $lusion_post_per_page );
			}
		}
	}
	if ( is_tax( 'product_cat' ) ) {
		$cat = $wp_query->get_queried_object();
		if ( get_metadata( 'product_cat', $cat->term_id, 'product_per_page', true ) != 'default' ) {
			$lusion_product_per_page = get_metadata( 'product_cat', $cat->term_id, 'product_per_page', true );
		}
	}
	if ( isset( $lusion_product_per_page ) && $lusion_product_per_page != '' ) {
		if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'product' ) || is_tax( 'product_cat' ) ) ) {
			$query->set( 'posts_per_page', $lusion_product_per_page );
		}
	}
	if ( is_tax( 'portfolio_cat' ) ) {
		$cate = $wp_query->get_queried_object();
		if ( isset( $cate ) ) {
			$cat_id = $cate->term_id;
			if ( get_metadata( 'portfolio_cat', $cat_id, 'post_per_page_portfolio', true ) != ' ' ) {
				$lusion_portfolio_per_page_cate = get_metadata( 'portfolio_cat', $cat_id, 'post_per_page_portfolio', true );
				$query->set( 'posts_per_page', $lusion_portfolio_per_page_cate );
			}
		}
	}
	if ( isset( $lusion_portfolio_per_page ) && $lusion_portfolio_per_page != '' ) {
		if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_cat' ) ) ) {
			$query->set( 'posts_per_page', $lusion_portfolio_per_page );
		}
	}

	if ( isset( $single_post_related_number ) && $single_post_related_number != '' ) {
		if ( is_single() && 'post' == get_post_type() && $query->is_main_query() && ! is_admin() ) {
			$query->set( 'posts_per_page', $single_post_related_number );
		}
	}
}

add_action( 'pre_get_posts', 'lusion_posts_per_page' );

function lusion_get_featured_post() {
	$block_options    = array();
	$args             = array(
		'numberposts' => - 1,
		'post_type'   => 'post',
		'post_status' => 'publish',
	);
	$posts            = get_posts( $args );
	$block_options[0] = 'Please Select Post';
	foreach ( $posts as $_post ) {

		$block_options[$_post->ID] = $_post->post_title;
	}

	return $block_options;
}

function lusion_get_headers_post_type() {
	$header_type     = [];
	$args            = array(
		'post_type'      => 'header',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
	);
	$header          = get_posts( $args );
	$header_type[''] = 'Please Select Header';
	foreach ( $header as $header ) {
		$header_type[$header->post_name] = $header->post_title;
	}

	return $header_type;
}

function lusion_get_template() {
	$template_type    = [];
	$args             = array(
		'post_type'      => 'elementor_library',
		'post_status'    => 'publish',
		'posts_per_page' => - 1
	);
	$template         = get_posts( $args );
	$template_type[0] = 'Please Select Template';
	foreach ( $template as $template ) {
		$template_type[$template->ID] = $template->post_title;
	}

	return $template_type;
}

function lusion_get_footers_post_type() {
	$footer_type     = [];
	$args            = array(
		'post_type'      => 'footer',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
	);
	$footer          = get_posts( $args );
	$footer_type[''] = 'Please Select Footer';
	foreach ( $footer as $footer ) {
		$footer_type[$footer->post_name] = $footer->post_title;
	}

	return $footer_type;
}

function lusion_get_id_by_slug( $slug, $post_type ) {
	$id       = '';
	$args     = array(
		'name'           => $slug,
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => 1
	);
	$my_posts = get_posts( $args );
	if ( $my_posts ) {
		$id = $my_posts[0]->ID;
	}

	return $id;
}

function lusion_get_post_media() {
	$gallery                = get_post_meta( get_the_ID(), 'gallery_metabox', true );
	$blog_layout            = Lusion::setting( 'blog_archive_layout' );
	$blog_layout_list_style = Lusion::setting( 'blog_archive_layout_list_style' );
	if ( is_category() ) {
		$blog_layout            = lusion_get_meta_value( 'blog_layout', false );
		$blog_layout_list_style = lusion_get_meta_value( 'blog_list_style', false );
	}
	$blog_id = 'blog_id-' . get_the_ID();
	?>
	<?php if ( get_post_format() === 'video' ) : ?>
		<?php $video = get_post_meta( get_the_ID(), 'post_video', true ); ?>
		<?php if ( $video && $video != '' ): ?>
			<?php
			$img_class = '';
			if ( is_singular() ) {
				$image_size = array( 1300, 650 );
			} else {
				if ( $blog_layout === 'grid' || $blog_layout === 'masonry' ) {
					$image_size = array( 570, 570 );
				} else {
					if ( is_sticky() ) {
						$image_size = array( 1920, 950 );
					} else {
						$image_size = array( 570, 400 );
					}
				}
				if ( $blog_layout === 'masonry' ) {
					$img_class .= 'class="no-lazyload"';
				}
			}

			?>
			<div class="blog-video blog-img ">
				<a class="fancybox" data-fancybox href="<?php echo esc_url( $video ); ?>">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( $image_size, array( 'class' => $img_class ) );
					}
					?>
					<span class="btn-video"><i class="fa fa-play" aria-hidden="true"></i></span></a>
			</div>
		<?php endif; ?>
	<?php elseif ( get_post_format() == 'audio' ) : ?>
		<?php $audio = get_post_meta( get_the_ID(), 'post_audio', true ); ?>
		<?php if ( $audio && $audio != '' ): ?>
			<?php if ( is_singular() ) {
				$height = '300';
			} else {
				$height = '230';
			} ?>
			<div class="blog-audio">
				<div class="audio_container">
					<?php echo Lusion_Helper::w3c_iframe( wp_oembed_get( $audio, array( 'height' => $height ) ) ); ?>
				</div>
			</div>

		<?php endif; ?>
	<?php elseif ( get_post_format() == 'link' ): ?>
		<?php
		$link      = get_post_meta( get_the_ID(), 'post_link', true );
		$close_div = '';
		?>
		<?php if ( $link && $link != '' ): ?>
			<?php if ( is_singular() && has_post_thumbnail() ) {
				echo '<div class="blog-img">';
				the_post_thumbnail( array( 1300, 650 ) );
				$close_div = true;
			} ?>
			<div class="link_section clearfix">
				<div class="link-icon">
					<a class="link-post"
					   href="<?php echo esc_url( is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link ); ?>">
						<i class="fa fa-link"></i>
					</a>
				</div>
			</div>
			<?php if ( $close_div ) {
				echo '</div>';
			} ?>
		<?php endif; ?>
	<?php elseif ( get_post_format() == 'quote' ): ?>
		<?php
		$quote_text = get_post_meta( get_the_ID(), 'post_quote_text', true );
		?>
		<?php if ( is_singular() ): ?>
			<?php if ( $quote_text && $quote_text != '' ): ?>
				<div class="quote_section">
					<blockquote class="var3">
						<p><?php echo wp_kses( $quote_text, array() ); ?></p>
					</blockquote>
				</div>
			<?php endif; ?>
		<?php else: ?>
			<?php if ( $quote_text && $quote_text != '' ): ?>
				<div class="quote_section">
					<blockquote class="var3">
						<a href="<?php the_permalink(); ?>"
						   title="<?php the_title_attribute(); ?>"><?php echo wp_kses( $quote_text, array() ); ?></a>
					</blockquote>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php elseif ( get_post_format() == 'gallery' ): ?>
		<?php if ( is_array( $gallery ) && count( $gallery ) > 1 ) : ?>
			<?php if ( is_singular() ): ?>
				<div class="blog-gallery-single blog-img slider ">
					<?php
					foreach ( $gallery as $key => $value ) :
						?>
						<div class="img-gallery">
							<?php echo wp_get_attachment_image( $value, array( 1300, 650 ) ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php else: ?>
				<div id="<?php echo esc_attr( $blog_id ); ?>" class="slider blog-gallery blog-img">
					<?php
					foreach ( $gallery as $key => $value ) :
						if ( $blog_layout === 'grid' || $blog_layout === 'masonry' ) {
							$image_size = array( 570, 570 );
						} else {
							if ( is_sticky() ) {
								$image_size = array( 1920, 950 );
							} else {
								$image_size = array( 570, 400 );
							}
						}
						?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php
							echo wp_get_attachment_image( $value, $image_size, false, array(
								'class' => "no-lazyload",
							) );
							?>
						</a>
					<?php
					endforeach;
					?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php elseif ( get_post_format() == 'image' ): ?>
		<?php if ( has_post_thumbnail() ): ?>
			<?php if ( is_singular() ): ?>
				<div class="blog-img">
					<?php
					echo get_the_post_thumbnail( null, array( 1300, 650 ), array(
						// 'alt' => the_title_attribute(),
						'class' => "no-lazyload"
					) );
					?>
				</div>
			<?php else: ?>
				<?php
				if ( $blog_layout === 'grid' || $blog_layout === 'masonry' ) {
					if ( $blog_layout === 'masonry' ) {
						$image_size = array( 600, 767 );
					} else {
						$image_size = array( 570, 570 );
					}
				} else {
					if ( is_sticky() ) {
						$image_size = array( 1920, 950 );
					} else {
						$image_size = array( 570, 400 );
					}
				}
				?>
				<div class="blog-img ">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php
						$img_class = '';
						if ( $blog_layout === 'masonry' ) {
							$img_class .= 'class="no-lazyload"';
						}
						echo get_the_post_thumbnail( null, $image_size, array(
							// 'alt' => the_title_attribute(),
							'class' => $img_class
						) );
						?>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php else: ?>
		<?php if ( has_post_thumbnail() ): ?>
			<?php if ( is_singular() ): ?>
				<div class="blog-img">
					<?php
					echo get_the_post_thumbnail( null, array( 1300, 650 ), array(// 'alt' => the_title_attribute(),
					) );
					?>
				</div>
			<?php else: ?>
				<div class="blog-img">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php
						if ( $blog_layout === 'grid' || $blog_layout === 'masonry' ) {
							$image_size = array( 570, 570 );
						} else {
							if ( is_sticky() && $blog_layout_list_style != 'style_2' ) {
								$image_size = array( 1920, 950 );
							} else {
								$image_size = array( 570, 400 );
							}
						}
						$img_class = '';
						if ( $blog_layout === 'masonry' ) {
							$img_class .= 'class="no-lazyload"';
						}
						echo get_the_post_thumbnail( null, $image_size, array(
							// 'alt' => the_title_attribute(),
							'class' => $img_class
						) );
						?>
					</a>
					<?php if ( is_sticky() && $blog_layout_list_style === 'style_2' ) { ?>
						<div class="icon-sticky"><i class="theme-icon-ray"></i></div>
					<?php }
					?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif;
}

/**
 * [lusion_arrowpress_maintenance_mode description]
 * Enable coming soon mode for theme.
 */
if ( ! function_exists( 'lusion_arrowpress_maintenance_mode' ) ) {
	function lusion_arrowpress_maintenance_mode() {
		$coming_soon_enable = Lusion::setting( 'coming_soon_enable' );
		global $lusion_settings;
		if ( isset( $coming_soon_enable ) && $coming_soon_enable && ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) ) {
			add_filter( 'template_include', function () {
				return get_stylesheet_directory() . '/coming-soon.php';
			} );
		}
	}

	add_action( 'template_redirect', 'lusion_arrowpress_maintenance_mode' );
}

function lusion_resizeImage( $width, $height ) {
	$image_url = lusion_get_attachment(get_post_thumbnail_id(),array($width,$height));
	return $image_url['src'];
}

/**
 * Get related posts
 *
 * @param     $post_id
 * @param int $number_posts
 *
 * @return WP_Query
 */
function lusion_get_related_posts( $post_id, $number_posts = - 1 ) {
	$query = new WP_Query();
	$args  = '';
	if ( $number_posts == 0 ) {
		return $query;
	}
	$args  = wp_parse_args( $args, array(
		'posts_per_page'      => $number_posts,
		'post__not_in'        => array( $post_id ),
		'ignore_sticky_posts' => 0,
		'category__in'        => wp_get_post_categories( $post_id )
	) );
	$query = new WP_Query( $args );

	return $query;
}

/**
 * Get related posts
 *
 * @param     $post_id
 * @param int $number_posts
 *
 * @return WP_Query
 */
function lusion_get_related_portfolio( $post_id, $number_posts = - 1 ) {
	$query = new WP_Query();
	$args  = '';
	if ( $number_posts == 0 ) {
		return $query;
	}
	$args  = wp_parse_args( $args, array(
		'post_type'           => 'portfolio',
		'posts_per_page'      => $number_posts,
		'post__not_in'        => array( $post_id ),
		'ignore_sticky_posts' => 0,
		'category__in'        => wp_get_post_categories( $post_id )
	) );
	$query = new WP_Query( $args );

	return $query;
}

/* Displays the class names for the #page element. */
function lusion_page_class( $class = '' ) {
	// Separates class names with a single space, collates class names for body element
	echo 'class="' . join( ' ', lusion_get_page_class( $class ) ) . '"';
}

/* Retrieves an array of the class names for the #page element. */
function lusion_get_page_class( $class = '' ) {
	$classes   = array();
	$classes[] = 'hfeed';
	$classes[] = 'site';
	/* Page layout */
	$lusion_site_layout = lusion_get_meta_value( 'site_layout' );
	if ( ( $lusion_site_layout !== '' ) && ( $lusion_site_layout == 'wide' ) ) {
		$classes[] = 'wide';
	} elseif ( ( $lusion_site_layout !== '' ) && ( $lusion_site_layout == 'full-width' ) ) {

		$classes[] = 'full-width';
	} elseif ( ( $lusion_site_layout !== '' ) && ( $lusion_site_layout == 'boxed' ) ) {
		$classes[] = 'boxed';
	} elseif ( ( $lusion_site_layout !== '' ) && ( $lusion_site_layout == 'full-screen' ) ) {
		$classes[] = 'full-screen';
	} else {
		$classes[] = Lusion_Global::check_layout_type();
	}
	/* Gradient - class */
	$general_gradient = Lusion::setting( 'general_gradient' );
	if ( $general_gradient == 1 ) {
		$classes[] = 'page-gradient';
	} else {
		$classes[] = '';
	}
	/* Site width */
	$lusion_width = get_post_meta( get_the_ID(), 'site_width', true );
	if ( $lusion_width ) {
		$classes[] = 'site-width';
	}
	if ( lusion_get_meta_value( 'fixed_header' ) == '' ) {
		if ( Lusion::setting( 'fixed_header' ) ) {
			$classes[] = 'header-fixed';
		}
	} elseif ( lusion_get_meta_value( 'fixed_header' ) == 'on' ) {
		$classes[] = 'header-fixed';
	} else {
		$classes[] = '';
	}
	/* Remove padding top */
	$lusion_remove_space_top = get_post_meta( get_the_ID(), 'remove_space_top', true );
	if ( $lusion_remove_space_top ) {
		$classes[] = 'remove_space_top';
	}
	/* Remove padding bottom */
	$lusion_remove_space_bottom = get_post_meta( get_the_ID(), 'remove_space_bottom', true );
	if ( $lusion_remove_space_bottom ) {
		$classes[] = 'remove_space_bottom';
	}
	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		$class = array();
	}
	$classes = apply_filters( 'lusion_page_class', $classes, $class );

	return array_unique( $classes );
}

function lusion_resize_image( $width, $height ) {
	$image_url = lusion_get_attachment(get_post_thumbnail_id(),array($width,$height));
	return $image_url['src'];
}
function lusion_crop_images_custom( $url_image, $custom_dimension = array() ) {
	$image_cr         = array();
	$size_wh['width'] = $size_wh['height'] = 'full';
	if ( ! empty( $custom_dimension['width'] ) && ! empty( $custom_dimension['height'] ) ) {
		$args                = array(
			'url'     => $url_image,
			'width'   => $custom_dimension['width'],
			'height'  => $custom_dimension['height'],
			'crop'    => true,
			'single'  => true,
			'upscale' => false,
		);
		$size_wh['width']    = $args['width'];
		$size_wh['height']   = $args['height'];
		//$image_cr['url_img'] = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
	} elseif ( ! empty( $custom_dimension['width'] ) && empty( $custom_dimension['height'] ) ) {
		$args                = array(
			'url'     => $url_image,
			'width'   => $custom_dimension['width'],
			'height'  => null,
			'crop'    => true,
			'single'  => true,
			'upscale' => false,
		);
		$size_wh['width']    = $args['width'];
		$size_wh['height']   = 'auto';
		//$image_cr['url_img'] = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
	} elseif ( empty( $custom_dimension['width'] ) && ! empty( $custom_dimension['height'] ) ) {
		$args                = array(
			'url'     => $url_image,
			'width'   => null,
			'height'  => $custom_dimension['height'],
			'crop'    => true,
			'single'  => true,
			'upscale' => false,
		);
		$size_wh['height']   = $args['height'];
		$size_wh['width']    = 'auto';
		//$image_cr['url_img'] = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
	} else {
		$image_cr['url_img'] = $url_image;
	}
	$image_cr['width_height'] = $size_wh;

	return $image_cr;
}
function lusion_get_attachment( $attachment_id, $size ) {
	if ( ! $attachment_id ) {
		return false;
	}
	if(empty($size)){
		$size = 'full';
	}
	$attachment = get_post( $attachment_id );
	$image = wp_get_attachment_image_src( $attachment_id, $size );

	if ( ! $attachment ) {
		return false;
	}

	return array(
		'alt'         => esc_attr( get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) ),
		'caption'     => esc_attr( $attachment->post_excerpt ),
		'description' => force_balance_tags( $attachment->post_content ),
		'href'        => get_permalink( $attachment->ID ),
		'src'         => esc_url( $image[0] ),
		'title'       => esc_attr( $attachment->post_title ),
		'width'  => ( $image[1] && $image[1] > 2 ) ? esc_attr( $image[1] ) : '',
		'height' => ( $image[2] && $image[2] > 2 ) ? esc_attr( $image[2] ) : ''
	);
}
function lusion_limit_title( $numberlimit ) {
	$tit = the_title( '', '', false );
	echo substr( $tit, 0, $numberlimit );
	if ( strlen( $tit ) > $numberlimit ) {
		echo esc_html__( '...', 'lusion' );
	}
}

function lusion_limit_excerpt( $numberlimit ) {
	$tit = get_the_excerpt( '', '', false );
	echo substr( $tit, 0, $numberlimit );
	if ( strlen( $tit ) > $numberlimit ) {
		echo esc_html__( '...', 'lusion' );
	}
}
add_action( 'wp_ajax_load_product_by_catslug', 'lusion_load_product_by_catslug' ); 
add_action( 'wp_ajax_nopriv_load_product_by_catslug', 'lusion_load_product_by_catslug' ); 
function lusion_load_product_by_catslug() {
	global $woocommerce_loop, $post;
	$posts_per_page                              = $_POST['posts_per_page'];
	$product_cat                                 = $_POST['product_cat'];
	$shortcodes                                  = $_POST['filter_by'];
	$orderby                                     = $_POST['orderby'];
	$order                                       = $_POST['order'];
	$columns                                     = $_POST['columns'];
	$woocommerce_loop['show_attribute_on_title'] = $_POST['show_attribute_on_title'];
	if($_POST['product_attr']){
		$woocommerce_loop['product_attr']            = $_POST['product_attr'];
	}
	$woocommerce_loop['show_compare']            = $_POST['show_compare'];
	$woocommerce_loop['show_wishlist']           = $_POST['show_wishlist'];
	$woocommerce_loop['show_quickview']          = $_POST['show_quickview'];
	$woocommerce_loop['product_type']            = $_POST['product_type'];
	$woocommerce_loop['product_layout']          = $_POST['product_layout'];
	if (isset($_POST['show_custom_image']) && $_POST['show_custom_image'] === 'yes' ) {
		$custom_dimension                     = array();
		$custom_dimension['width']            = $_POST['custom_dimension_width'];
		$custom_dimension['height']           = $_POST['custom_dimension_height'];
		$woocommerce_loop['custom_dimension'] = $custom_dimension;
	}
	$woocommerce_loop['show_custom_image'] = $_POST['show_custom_image'];
	$woocommerce_loop['product_type']      = $_POST['product_type'];
	echo do_shortcode( '[' . $shortcodes . ' category="' . $product_cat . '"  limit="' . $posts_per_page . '" columns="' . $columns . '" orderby="' . $orderby . '" order="' . $order . '"]' );
	die();
}

/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
// check for empty-cart get param to clear the cart
add_action( 'init', 'lusion_woocommerce_clear_cart_url' );
function lusion_woocommerce_clear_cart_url() {
	global $woocommerce;
	if ( isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart();
	}
}

add_action( 'woocommerce_cart_actions', 'lusion_patricks_add_clear_cart_button', 20 );
function lusion_patricks_add_clear_cart_button() {
	echo "<a class='button' href='?empty-cart=true'>" . __( 'Clear cart', 'lusion' ) . "</a>";
}

function lusion_purchase_theme_button() {
	$purchase_theme_enable = Lusion::setting( 'purchase_theme_enable' );
	$price_theme           = Lusion::setting( 'price_theme' );
	$link_theme            = Lusion::setting( 'link_theme' );
	?>
	<?php if ( $purchase_theme_enable && $link_theme !== '' ) { ?>
		<a href="<?php echo esc_url( $link_theme ); ?>" class="purchase-theme site-2" target="_blank" rel="noreferrer">
            <span class="icon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/envato.png" alt="Buy Now at Envato"
					 width="16" height="18"/>
            </span>
			<span class="caption"><?php echo __( 'Buy Theme', 'lusion' ); ?></span>
			<?php if ( $price_theme !== '' ): ?>
				<span class="price">
                    <span class="sign"><?php echo __( '$', 'lusion' ); ?></span>
                    <span class="amount"><?php echo esc_attr( $price_theme ); ?></span>
                </span>
			<?php endif; ?>
		</a>
		<?php
	}
}
