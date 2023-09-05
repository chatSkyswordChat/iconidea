<?php
$choose_footer_builder = Lusion::setting( 'choose_footer_builder' );
$footer_type           = lusion_get_meta_value( 'footer_type' );
$footer_class          = '';
if ( ! empty( $footer_type ) && $footer_type !== 'default' ) {
	$footer_class = $footer_type;
} else {
	$footer_class = $choose_footer_builder;
}
?>
<footer id="page-footer" class="page-footer footer-builder <?php echo esc_attr( $footer_class ); ?>">
	<div class="footer-content">
		<?php
		if ( ! empty( $footer_type ) && $footer_type !== 'default' ) {
			echo \Elementor\Plugin::$instance->frontend->get_builder_content( lusion_get_id_by_slug( $footer_type, 'footer' ), true );
		} else {
			echo \Elementor\Plugin::$instance->frontend->get_builder_content( lusion_get_id_by_slug( $choose_footer_builder, 'footer' ), true );
		}
		?>
	</div>
</footer>
