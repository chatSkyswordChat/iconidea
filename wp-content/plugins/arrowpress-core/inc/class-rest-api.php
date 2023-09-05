<?php

namespace Arrow_EL_Lib;

use Arrow_EL_Lib\Utilities\Rest_Response;
use Arrow_EL_Lib\Modules\Cache;
use Arrow_EL_Lib\Elementor\Library\Import;

class Rest_API {

	use SingletonTrait;

	const NAMESPACE = 'arrow-ekit';

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
	}

	public function register_endpoints() {

		register_rest_route(
			self::NAMESPACE,
			'/get-layout-libraries',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_layout_libraries' ),
				'permission_callback' => array( $this, 'permission_callback' ),
			)
		);

		do_action( 'arrow_ekit/rest_api/register_endpoints', self::NAMESPACE );
	}

	public function permission_callback() {
		return current_user_can( 'edit_posts' );
	}

	// Use in Select Post Preview in Elementor.
	public function get_posts( \WP_REST_Request $request ) {
		$query_args = array(
			'post_type'      => $request['post_type'] ?? 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 15,
		);

		if ( isset( $request['ids'] ) ) {
			$ids                    = explode( ',', $request['ids'] );
			$query_args['post__in'] = $ids;
		}

		if ( isset( $request['s'] ) ) {
			$query_args['s'] = $request['s'];
		}

		$query = new \WP_Query( $query_args );

		$options = array();

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$options[] = array(
					'id'   => get_the_ID(),
					'text' => get_the_title(),
				);
			}
		}

		wp_reset_postdata();

		return array( 'results' => $options );
	}


	// Use for chooses layout for create template from Thim Elementor Kit.
	public function get_layout_libraries( \WP_REST_Request $request ) {
		$theme = wp_get_theme();

		if ( $theme->parent() ) {
			$theme = $theme->parent();
		}
		$response = wp_remote_get( 'https://updates.arrowtheme.com/wp-json/thim_em/v1/thim-kit/get-layout-libraries?theme=' . $theme->get( 'TextDomain' ) );

		$raw = ! is_wp_error( $response ) ? json_decode( wp_remote_retrieve_body( $response ), true ) : array();

		return rest_ensure_response( $raw );
	}
}

Rest_API::instance();
