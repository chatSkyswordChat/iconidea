<?php

namespace WPDesk\FCF\Pro;

use FCFProVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use FCFProVendor\WPDesk\PluginBuilder\Plugin\HookableCollection;
use FCFProVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use FCFProVendor\WPDesk_Plugin_Info;
use WPDesk\FCF\Pro\Form;
use WPDesk\FCF\Pro\Integration;
use WPDesk\FCF\Pro\Plugin\Compatibility;
use WPDesk\FCF\Pro\Pricing;
use WPDesk\FCF\Pro\Validator;

/**
 * Main plugin class. The most important flow decisions are made here.
 */
class Plugin extends AbstractPlugin implements HookableCollection {

	const ROUTE_NAMESPACE = 'flexible-checkout-fields-pro/v1';

	use HookableParent;

	/**
	 * Scripts version.
	 *
	 * @var string
	 */
	private $script_version = '1';

	/**
	 * Instance of old version main class of plugin.
	 *
	 * @var \Flexible_Checkout_Fields_Pro_Plugin
	 */
	private $plugin_old;

	/**
	 * Plugin constructor.
	 *
	 * @param WPDesk_Plugin_Info                   $plugin_info Plugin info.
	 * @param \Flexible_Checkout_Fields_Pro_Plugin $plugin_old  Main plugin.
	 */
	public function __construct( WPDesk_Plugin_Info $plugin_info, \Flexible_Checkout_Fields_Pro_Plugin $plugin_old ) {
		parent::__construct( $plugin_info );

		$this->plugin_url       = $this->plugin_info->get_plugin_url();
		$this->plugin_namespace = $this->plugin_info->get_text_domain();
		$this->script_version   = $plugin_info->get_version();
		$this->plugin_old       = $plugin_old;
	}

	/**
	 * Initializes plugin external state after "flexible_checkout_fields/init" action.
	 * In case of compatibility problems, displays Admin Notices.
	 *
	 * @return void
	 */
	public function load_action_init() {
		add_action(
			'flexible_checkout_fields/init',
			function ( $integrator ) {
				$compatibility = new Compatibility();
				$compatibility->set_plugin( $this );

				if ( $compatibility->check_plugin_compatibility( $integrator ) ) {
					$this->plugin_old->load_after_action_init();
				}
			}
		);
	}

	/**
	 * Initializes plugin external state.
	 * The plugin internal state is initialized in the constructor and the plugin should be internally consistent after
	 * creation. The external state includes hooks execution, communication with other plugins, integration with WC
	 * etc.
	 *
	 * @return void
	 */
	public function init() {
		( new Field\Types() )->init();
		$this->add_hookable( new Integration\PolylangIntegrator( $this->plugin_info ) );
		$this->add_hookable( new Integration\WpmlIntegrator( $this->plugin_info ) );
		$this->add_hookable( new Form\Assets( $this->plugin_info ) );

		$this->add_hookable( new Field\FieldCustomAttrs() );
		$this->add_hookable( new Field\FieldTemplateLoader( $this->plugin_info ) );
		$this->add_hookable( new Field\File\RestRouteCreator() );
		$this->add_hookable( new Field\File\PreviewGenerator() );
		$this->add_hookable( new Field\File\FieldValuePrinter() );
		$this->add_hookable( new Field\FieldValuePrinter() );

		$this->add_hookable( new Pricing\Fields() );
		$this->add_hookable( new Pricing\Session() );
		( new Settings\Forms() )->init();
		( new Settings\Routes() )->init();
		$this->add_hookable( new Validator\FieldValidator() );
	}

	/**
	 * {@inheritdoc}
	 */
	public function hooks() {
		$this->hooks_on_hookable_objects();
	}

	/**
	 * Get script version.
	 *
	 * @return string;
	 */
	public function get_script_version() {
		return $this->script_version;
	}
}
