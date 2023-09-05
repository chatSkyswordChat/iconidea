<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Apr_Core_Site_Logo extends Widget_Image {

	public function apr_sc_site_logo() {
		/* Add css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-site-logo', LUSION_CSS . '/elementor/sitelogo-rtl.min.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-site-logo', LUSION_CSS . '/elementor/sitelogo.min.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr_site_logo';
	}

	public function get_title() {
		return __( 'APR Site Logo', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-site-logo';
	}

	public function get_categories() {
		return [ 'apr-core' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_extra',
			[
				'label' => __( 'Logo Site', 'apr-core' ),
			]
		);
		$this->add_control(
			'logo_select',
			[
				'label'   => __( 'Image from', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'site_logo',
				'options' => [
					'site_logo' => __( 'Use Site Logo', 'apr-core' ),
					'customize' => __( 'Custom Logo', 'apr-core' ),
				]
			]
		);
		$this->add_control(
			'show_is_home_page',
			[
				'label'   => __( 'Is home page', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			]
		);
		$this->add_control(
			'image_logo',
			[
				'label'     => __( 'Choose Image', 'apr-core' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'logo_select' => 'customize'
				],
			]
		);
		$this->add_control(
			'logo_alignment',
			[
				'label'          => __( 'Alignment', 'apr-core' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'left',
				'options'        => [
					'left'   => [
						'title' => __( 'Left', 'apr-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'apr-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'apr-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'label_block'    => false,
				'style_transfer' => true,
			]
		);
		$this->end_controls_section();
		parent::register_controls();
		$this->remove_control( 'image' );
		$this->update_control(
			'image_size',
			[
				'default' => 'full',
			]
		);

		$this->update_control(
			'link_to',
			[
				'default' => 'custom',
			]
		);

		$this->update_control(
			'link',
			[
				'placeholder' => site_url(),
			]
		);
	}

	protected function get_html_wrapper_class() {
		return parent::get_html_wrapper_class() . ' elementor-widget-' . parent::get_name();
	}

	public function get_value( array $options = [] ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( is_numeric( $custom_logo_id ) ) {
			$logo_attachment = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			if ( $logo_attachment ) {
				$url = $logo_attachment[0];
			} else {
				$url = Utils::get_placeholder_image_src();

			}
		}

		return [
			'id'  => $custom_logo_id,
			'url' => $url,
		];
	}

	protected function render() {
		$this->apr_sc_site_logo();
		$settings = $this->get_settings_for_display();
		if ( 'site_logo' === $settings['logo_select'] ) {
			$custom_logo              = $this->get_value();
			$settings['image']['url'] = $custom_logo['url'];
			$settings['image']['id']  = $custom_logo['id'];
		} else {
			$settings['image']['url'] = $settings['image_logo']['url'];
			$settings['image']['id']  = $settings['image_logo']['id'];
		}
		if ( empty( $settings['image']['url'] ) ) {
			return;
		}
		$has_caption = ! empty( $settings['caption'] );
		$class       = 'elementor-image';
		if ( $settings['logo_alignment'] ) {
			$class .= ' text-' . $settings['logo_alignment'];
		}
		$this->add_render_attribute( 'link', 'class', 'logo-builder' );
		if ( ! empty( $settings['shape'] ) ) {
			$class .= ' elementor-image-shape-' . $settings['shape'];
		}

		$link = $this->get_link_url( $settings );

		if ( $link ) {
			$this->add_render_attribute( 'link', [
				'href'                         => $link['url'],
				'data-elementor-open-lightbox' => $settings['open_lightbox'],
			] );

			if ( Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'link', [
					'class' => 'elementor-clickable',
				] );
			}

			if ( ! empty( $link['is_external'] ) ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( ! empty( $link['nofollow'] ) ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}
		?>
		<div class="<?php echo esc_attr( $class ); ?>">
			<?php if ( $has_caption ) : ?>
			<figure class="wp-caption">
				<?php endif; ?>
				<?php if ( is_front_page() && $settings['show_is_home_page'] === 'no' ) : ?>
				<h1>
					<?php endif;
					?>
					<?php if ( $link ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
						<?php endif; ?>
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
						<?php if ( $link ) : ?>
					</a>
				<?php endif; ?>
					<?php if ( is_front_page() && $settings['show_is_home_page'] === 'no' ) : ?>
				</h1>
			<?php endif;
			?>
				<?php if ( $has_caption ) : ?>
					<figcaption
						class="widget-image-caption wp-caption-text"><?php echo $settings['caption']; ?></figcaption>
				<?php endif; ?>
				<?php if ( $has_caption ) : ?>
			</figure>
		<?php endif; ?>
		</div>
		<?php
	}

	protected function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				$settings['link']['url'] = site_url();
			}

			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}

	protected function content_template() {
		return;
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Site_Logo );
