<?php

/**
 * Class Arrowpress_Getting_Started
 *
 * @since 0.8.3
 */
class Arrowpress_Getting_Started extends Arrowpress_Admin_Sub_Page {
	/**
	 * @var string
	 *
	 * @since 0.8.5
	 */
	public $key_page = 'getting-started';

	/**
	 * Get steps.
	 *
	 * @return array
	 * @since 0.8.3
	 *
	 */
	public static function get_steps() {
		$steps = array();

		$steps[] = array(
			'key'   => 'welcome',
			'title' => __( 'Welcome', 'arrowpress-core' ),
		);

		$steps[] = array(
			'key'   => 'quick-setup',
			'title' => __( 'Setup', 'arrowpress-core' ),
		);


		$is_active = Arrowpress_Product_Registration::is_active();
		if ( ! $is_active && ! Arrowpress_Free_Theme::is_free() ) {
			$envato_id = Arrowpress_Theme_Manager::get_data( 'envato_item_id', false );
			if ( $envato_id ) {
				$steps[] = array(
					'key'   => 'updates',
					'title' => __( 'Updates', 'arrowpress-core' ),
				);
			}
		}

		$plugins = Arrowpress_Plugins_Manager::get_required_plugins_inactive();
		if ( count( $plugins ) > 0 ) {
			$steps[] = array(
				'key'   => 'install-plugins',
				'title' => __( 'Plugins', 'arrowpress-core' ),
			);
		}

		$steps[] = array(
			'key'   => 'import-demo',
			'title' => __( 'Import', 'arrowpress-core' ),
		);

		$steps[] = array(
			'key'   => 'customize',
			'title' => __( 'Customize', 'arrowpress-core' ),
		);

		$steps[] = array(
			'key'   => 'support',
			'title' => __( 'Support', 'arrowpress-core' ),
		);

		$steps[] = array(
			'key'   => 'finish',
			'title' => __( 'Ready', 'arrowpress-core' ),
		);

		return $steps;
	}

	/**
	 * Get link redirect to step.
	 *
	 * @param $step
	 *
	 * @return string
	 * @since 0.8.9
	 *
	 */
	public static function get_link_redirect_step( $step ) {
		$self = self::instance();
		$base = Arrowpress_Dashboard::get_link_page_by_slug( $self->key_page );

		return add_query_arg( array( 'redirect' => $step ), $base );
	}

	/**
	 * Arrowpress_Getting_Started constructor.
	 *
	 * @since 0.8.3
	 */
	protected function __construct() {
		parent::__construct();

		$this->init_hooks();
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 0.8.3
	 */
	private function init_hooks() {
		add_action( 'admin_init', array( $this, 'redirect_to_tep' ) );
		add_action( 'tc_after_dashboard_wrapper', array( $this, 'add_modals_importer' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'arrowpress_getting_started_main_content', array( $this, 'render_step_templates' ) );
		add_action( 'wp_ajax_arrowpress-get-started', array( $this, 'handle_ajax' ) );
		add_filter( 'arrowpress_dashboard_sub_pages', array( $this, 'add_sub_page' ) );
		add_action( 'admin_init', array( $this, 'notice_visited' ) );
	}

	/**
	 * Notice customer has already visited.
	 *
	 * @since 0.8.9
	 */
	public function notice_visited() {
		if ( ! $this->is_myself() ) {
			return;
		}

		if ( ! $this->already_visited() ) {
			return;
		}

		Arrowpress_Notification::add_notification(
			array(
				'id'          => 'gs-visited',
				'type'        => 'warning',
				'content'     => __( 'Oops! It seems you already setup your site.', 'arrowpress-core' ),
				'dismissible' => true,
				'global'      => false,
			)
		);
	}

	/**
	 * Redirect to step.
	 *
	 * @since 0.8.9
	 */
	public function redirect_to_tep() {
		if ( ! $this->is_myself() ) {
			return;
		}

		$step_redirect = ! empty( $_GET['redirect'] ) ? $_GET['redirect'] : false;
		if ( ! $step_redirect ) {
			return;
		}

		$steps = self::get_steps();
		foreach ( $steps as $index => $step ) {
			if ( $step['key'] == $step_redirect ) {
				$url = $this->get_link_myself() . "#step-$index";

				arrowpress_core_redirect( $url );
			}
		}
	}

	/**
	 * Check already visited.
	 *
	 * @return bool
	 * @since 1.2.1
	 *
	 */
	public function already_visited() {
		$option = Arrowpress_Admin_Settings::get( 'getting_started_visited', false );

		return (bool) $option;
	}

	/**
	 * Add modals importer.
	 *
	 * @since 0.8.5
	 */
	public function add_modals_importer() {
		if ( ! $this->is_myself() ) {
			return;
		}

		Arrowpress_Dashboard::get_template( 'partials/importer-modal.php' );
		Arrowpress_Dashboard::get_template( 'partials/importer-uninstall-modal.php' );
	}

	/**
	 * Add sub page.
	 *
	 * @param $sub_pages
	 *
	 * @return mixed
	 * @since 0.8.5
	 *
	 */
	public function add_sub_page( $sub_pages ) {
		$sub_pages['getting-started'] = array(
			'title' => __( 'Getting Started', 'arrowpress-core' ),
		);

		return $sub_pages;
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 0.8.3
	 */
	public function enqueue_scripts() {
		if ( ! $this->is_myself() ) {
			return;
		}

		$min = '.min';
 		$ver = ARROWPRESS_CORE_VERSION;

		if ( Apr_Core::is_debug() ) {
			$min = '';
			$ver = uniqid();
		}
		$extend = $min . '.js';

		wp_enqueue_script( 'arrowpress-plugins', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/plugins/arrowpress-plugins.js', array( 'jquery' ), ARROWPRESS_CORE_VERSION );
		wp_enqueue_script( 'arrowpress-importer', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/importer/importer' . $extend, array(
			'wp-util',
			'jquery',
			'backbone',
			'underscore'
		), $ver );
		wp_enqueue_script( 'arrowpress-getting-started', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/getting-started/getting-started-v2' . $extend, array(
			'arrowpress-plugins',
			'arrowpress-importer',
			'arrowpress-video-youtube'
		), $ver );

		$this->localize_script();
	}

	/**
	 * Localize script.
	 *
	 * @since 0.8.3
	 */
	private function localize_script() {
		wp_localize_script( 'arrowpress-getting-started', 'arrowpress_gs', array(
			'url_ajax' => admin_url( 'admin-ajax.php?action=arrowpress-get-started&step=' ),
			'steps'    => self::get_steps()
		) );

		$arrowpress_plugins_manager = Arrowpress_Plugins_Manager::instance();
		$arrowpress_plugins_manager->localize_script();

		$arrowpress_importer = Arrowpress_Importer::instance();
		$arrowpress_importer->localize_script();
	}

	/**
	 * Handle ajax.
	 *
	 * @since 0.8.3
	 */
	public function handle_ajax() {
		$step = ! empty( $_REQUEST['step'] ) ? $_REQUEST['step'] : false;

		switch ( $step ) {
			case 'quick-setup':
				$this->handle_quick_setup();
				break;

			case 'finish':
				$this->handle_finish();
				break;

			default:
				break;
		}

		wp_die();
	}

	/**
	 * Handle finish getting started.
	 *
	 * @since 1.2.1
	 */
	private function handle_finish() {
		Arrowpress_Admin_Settings::set( 'getting_started_visited', true );
		wp_send_json_success();
	}

	/**
	 * Handle quick setup.
	 *
	 * @since 0.8.3
	 */
	private function handle_quick_setup() {
		$blog_name = isset( $_POST['blogname'] ) ? esc_html( $_POST['blogname'] ) : false;
		if ( $blog_name !== false ) {
			update_option( 'blogname', $blog_name );
		}

		$blog_description = isset( $_POST['blogdescription'] ) ? esc_html( $_POST['blogdescription'] ) : false;
		if ( $blog_description !== false ) {
			update_option( 'blogdescription', $blog_description );
		}

		wp_send_json_success( __( 'Saving successful!', 'arrowpress-core' ) );
	}

	/**
	 * Render step templates.
	 *
	 * @since 0.8.3
	 */
	public function render_step_templates() {
		$steps = self::get_steps();

		foreach ( $steps as $index => $step ) {
			$key = strtolower( $step['key'] );
			$this->render_step_template( $key );
		}
	}

	/**
	 * Get step template by slug.
	 *
	 * @param string $slug
	 *
	 * @return bool
	 * @since 0.8.3
	 *
	 */
	public function render_step_template( $slug ) {
		$template_path = 'dashboard/gs-steps/' . $slug . '.php';
		$template_path = apply_filters( "arrowpress_core_path_template_getting_started_$slug", $template_path, $slug );

		$html = Arrowpress_Template_Helper::template( $template_path );

		return Arrowpress_Template_Helper::template( 'dashboard/gs-steps/master.php', array(
			'slug' => $slug,
			'html' => $html
		), true );
	}
}
