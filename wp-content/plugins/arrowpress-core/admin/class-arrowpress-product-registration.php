<?php

/**
 * Class Arrowpress_Product_Registration.
 *
 * @package   ArrowPress_Core
 * @since     0.2.1
 */
class Arrowpress_Product_Registration extends Arrowpress_Singleton {

	/**
	 * Premium themes.
	 *
	 * @since 0.9.0
	 *
	 * @var null
	 */
	private static $themes = null;

	/**
	 * Deregister product registration.
	 *
	 * @since 1.5.0
	 *
	 * @return true|WP_Error
	 */
	public static function deregister() {
		if ( ! self::is_active() ) {
			return true;
		}

		$allow_deregister = apply_filters( 'arrowpress_core_allow_deregister_activation', true );
		if ( ! $allow_deregister ) {
			return new WP_Error( 'not_allowed', __( 'Can not deregister activation.', 'arrowpress-core' ) );
		}

		$token = get_option( 'arrowpress_purchase_token' );

		$request = Arrowpress_Remote_Helper::post(
			'https://updates.arrowtheme.com/wp-json/arrow-market/v1/deactivate/',
			array(
				'body' => array(
					'site_code' => $token,
				),
			),
			true
		);

		if ( is_wp_error( $request ) ) {
			return $request;
		}
		
		if ( $request->status !== 'success' ) {
			return new WP_Error( 'something_went_wrong', ! empty( $request->message ) ? $request->message : __( 'Something went wrong!', 'arrowpress-core' ) );
		}

		self::destroy_active();

		return true;
	}

	/**
	 * Double check theme update before inject update theme.
	 *
	 * @since 1.1.1
	 */
	public static function double_check_theme_update() {
		$instance = self::instance();

		$instance->check_theme_update( true );
	}

	/**
	 * Get active theme from envato.
	 *
	 * @since 0.2.1
	 *
	 * @return bool
	 */
	public static function is_active() {
		$purchase_token = get_option('arrowpress_purchase_token');

		$is_active = ! empty( $purchase_token );

		return apply_filters( 'arrowpress_core_production_registration_is_active', $is_active );
	}

	/**
	 * Destroy active theme from envato.
	 *
	 * @since 0.8.0
	 */
	public static function destroy_active() {
		delete_option( 'arrowpress_purchase_code' );
		delete_option( 'arrowpress_purchase_token' );
		delete_option( 'arrowpress_personal_token' );
	}

	/**
	 * Get url link download theme from envato.
	 *
	 * @since 0.7.0
	 *
	 * @param $stylesheet
	 *
	 * @return WP_Error|string
	 */
	public static function get_url_download_theme( $stylesheet = null ) {
		$theme_data = Arrowpress_Theme_Manager::get_metadata();
		$item_id    = $theme_data['envato_item_id'] ?? 0;

		return Arrowpress_Envato_API::get_url_download_item( $item_id );
	}

	/**
	 * Get link review of theme on themeforest.
	 *
	 * @sicne
	 *
	 * @return string
	 */
	public static function get_link_reviews() {
		$link       = 'https://themeforest.net/downloads';
		$theme_data = Arrowpress_Theme_Manager::get_metadata();
		$item_id    = $theme_data['envato_item_id'];

		if ( ! empty( $item_id ) ) {
			$link .= sprintf( '#item-%s', $item_id );
		}

		return $link;
	}

	/**
	 * Arrowpress_Product_Registration constructor.
	 *
	 * @since 0.2.1
	 */
	protected function __construct() {
		$this->init_hooks();
		$this->upgrader();
	}

	/**
	 * Upgrader.
	 *
	 * @since 0.9.0
	 */
	private function upgrader() {
		Arrowpress_Auto_Upgrader::instance();
	}

	/**
	 * Init hooks.
	 *
	 * @since 0.2.1
	 */
	private function init_hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'wp_ajax_arrowpress_core_update_theme', array( $this, 'ajax_update_theme' ) );
		add_action( 'arrowpress_core_background_check_update_theme', array( $this, 'background_check_update_theme' ), 1 );
		add_action( 'arrowpress_core_list_modals', array( $this, 'add_modal_activate_theme' ) );
		add_action( 'arrowpress_core_dashboard_init', array( $this, 'handle_deregister' ) );
	}

	/**
	 * Handle deregister.
	 *
	 * @since 1.4.2
	 */
	public function handle_deregister() {
		if ( ! isset( $_REQUEST['arrowpress-core-deregister'] ) ) {
			return;
		}

		$result = self::deregister();

		if ( is_wp_error( $result ) ) {
			$link = Arrowpress_Dashboard::get_link_main_dashboard();
			$link = add_query_arg(
				array(
					'arrowpress-core-error' => $result->get_error_code(),
				),
				$link
			);
			arrowpress_core_redirect( $link );

			return;
		}

		$link = Arrowpress_Dashboard::get_link_main_dashboard();
		arrowpress_core_redirect( $link );
	}

	/**
	 * Add modal activate theme.
	 *
	 * @since 1.3.4
	 */
	public function add_modal_activate_theme() {
		if ( Arrowpress_Free_Theme::is_free() ) {
			return;
		}

		if ( self::is_active() ) {
			return;
		}

		Arrowpress_Modal::render_modal( array(
			'id'       => 'tc-modal-activate-theme',
			'template' => 'registration/activate-modal.php',
		) );
	}

	/**
	 * Handle ajax update theme.
	 *
	 * @since 1.1.0
	 */
	public function ajax_update_theme() {
		check_ajax_referer( 'arrowpress_core_update_theme', 'nonce' );

		$theme_data = Arrowpress_Theme_Manager::get_metadata();
		$theme      = $theme_data['template'];

		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		$skin     = new WP_Ajax_Upgrader_Skin();
		$upgrader = new Theme_Upgrader( $skin );
		$results  = $upgrader->bulk_upgrade( array( $theme ) );
		$messages = $skin->get_upgrade_messages();

		if ( ! $results || ! isset( $results[ $theme ] ) ) {
			wp_send_json_error( $messages );
		}

		$result = $results[ $theme ];
		if ( ! $result ) {
			wp_send_json_error( array( __( 'Something went wrong! Please try again later.', 'arrowpress-core' ) ) );
		}

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( $result->get_error_messages() );
		}

		$theme_data = Arrowpress_Theme_Manager::get_metadata( true );
		$theme      = $theme_data['version'];

		wp_send_json_success( $theme );
	}

	/**
	 * Check update theme in background.
	 *
	 * @since 1.1.0
	 */
	public function background_check_update_theme() {
		$force = isset( $_GET['force-check'] );

		$this->check_theme_update( $force );
	}

	/**
	 * Get check update themes.
	 *
	 * @since 1.1.0
	 *
	 * @return array
	 */
	public static function get_update_themes() {
		$update = get_option( 'arrowpress_core_check_update_themes', array() );

		return wp_parse_args( $update, array(
			'last_checked' => false,
			'themes'       => array(),
		) );
	}

	/**
	 * Check update theme from envato.
	 *
	 * @since 1.1.0
	 *
	 * @param $force bool
	 */
	private function check_theme_update( $force = false ) {
		$update_themes = self::get_update_themes();
		$last_checked  = $update_themes['last_checked'];
		$now           = time();
		$timeout       = 12 * 3600;

		if ( ! $force && $last_checked && $now - $last_checked < $timeout ) {
			return;
		}

		$theme_data      = Arrowpress_Theme_Manager::get_metadata();
		$item_id         = $theme_data['envato_item_id'];
		$current_version = $theme_data['version'];

		$checker                       = new Arrowpress_Theme_Envato_Check_Update( $item_id, $current_version );
		$update_themes['last_checked'] = $now;
		$data                          = $checker->get_theme_data();

		$themes   = (array) $update_themes['themes'];
		$template = $theme_data['template'];
		if ( $data ) {
			$themes[ $template ] = array(
				'update'       => $checker->can_update(),
				'theme'        => $template,
				'name'         => $data['theme_name'],
				'description'  => $data['description'],
				'version'      => $data['version'],
				'icon'         => $data['icon'],
				'author'       => $data['author_name'],
				'author_url'   => $data['author_url'],
				'rating'       => $data['rating'],
				'rating_count' => $data['rating_count'],
				'url'          => $data['url'],
				'package'      => '',
			);
		} else {
			unset( $themes[ $template ] );
		}

		$update_themes['themes'] = $themes;

		update_option( 'arrowpress_core_check_update_themes', $update_themes );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @param $page_now
	 *
	 * @since 0.7.0
	 */
	public function enqueue_scripts( $page_now ) {
		if ( strpos( $page_now, Arrowpress_Dashboard::$prefix_slug . 'dashboard' ) === false ) {
			return;
		}

		wp_enqueue_script( 'arrowpress-theme-update', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/theme-update.js', array( 'jquery' ), ARROWPRESS_CORE_VERSION );

		$this->_localize_script();
	}

	/**
	 * Localize script.
	 *
	 * @since 0.7.0
	 */
	private function _localize_script() {
		$nonce           = wp_create_nonce( 'arrowpress_core_update_theme' );
		$link_deregister = Arrowpress_Dashboard::get_link_main_dashboard(
			array(
				'arrowpress-core-deregister' => true,
			)
		);

		wp_localize_script( 'arrowpress-theme-update', 'arrowpress_theme_update', array(
			'admin_ajax'     => admin_url( 'admin-ajax.php' ),
			'action'         => 'arrowpress_core_update_theme',
			'nonce'          => $nonce,
			'url_deregister' => $link_deregister,
			'i18l'           => array(
				'confirm_deregister' => __( 'Are you sure to remove theme activation??', 'arrowpress-core' ),
				'updating'           => __( 'Updating...', 'arrowpress-core' ),
				'updated'            => __( 'Updated!', 'arrowpress-core' ),
				'wrong'              => __( 'Some thing went wrong. Please try again later!', 'arrowpress-core' ),
				'warning_leave'      => __( 'The update process will cause errors if you leave this page!', 'arrowpress-core' ),
			),
		) );
	}
}
