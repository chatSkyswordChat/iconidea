<?php

class Apr_Core_Custom_Term_Meta {

	public function __construct() {

		if ( is_admin() ) {

			add_action( 'product_cat_add_form_fields', array( $this, 'create_screen_fields' ), 10, 1 );
			add_action( 'product_cat_edit_form_fields', array( $this, 'edit_screen_fields' ), 10, 2 );

			add_action( 'created_term', array( $this, 'save_data' ), 10, 1 );
			add_action( 'edit_term', array( $this, 'save_data' ), 10, 1 );

			add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts_styles' ) );
			add_action( 'admin_footer', array( $this, 'add_admin_js' ) );
		}

	}

	public function create_screen_fields( $taxonomy ) {

		// Set default values.
		$product_cat_label      = '';
		$categories_label_color = '';
		$bg_color_cate          = '';
		$bottom_color_cate      = '';
		// Form fields.

		echo '<div class="form-field term-product_cat_label-wrap">';
		echo '	<label for="product_cat_label">' . __( 'Categories label', 'apr-core' ) . '</label>';
		echo '	<input type="text" id="product_cat_label" name="product_cat_label" placeholder="' . esc_attr__( '', 'apr-core' ) . '" value="' . esc_attr( $product_cat_label ) . '">';
		echo wp_oembed_get( $product_cat_label );
		echo '	<p class="description">' . __( 'Categories label.', 'apr-core' ) . '</p>';
		echo '</div>';

		echo '<div class="form-field term-categories_label_color-wrap">';
		echo '	<label for="categories_label_color">' . __( 'Categories label background color', 'apr-core' ) . '</label>';
		echo '	<input type="text" id="categories_label_color" name="categories_label_color" class="categories_label_color_picker" value="' . esc_attr( $categories_label_color ) . '"><br>';
		echo '	<p class="description">' . __( 'The hex background color of the Categories label.', 'apr-core' ) . '</p>';
		echo '</div>';

		echo '<div class="form-field term-categories_label_color-wrap">';
		echo '	<label for="categories_label_color">' . __( 'Top background color', 'apr-core' ) . '</label>';
		echo '	<input type="text" id="bg_color_cate" name="bg_color_cate" class="categories_label_color_picker" value="' . esc_attr( $bg_color_cate ) . '"><br>';
		echo '	<p class="description">' . __( 'Select top color for page.', 'apr-core' ) . '</p>';
		echo '</div>';

		echo '<div class="form-field term-categories_label_color-wrap">';
		echo '	<label for="categories_label_color">' . __( 'Bottom background color', 'apr-core' ) . '</label>';
		echo '	<input type="text" id="bottom_color_cate" name="bottom_color_cate" class="categories_label_color_picker" value="' . esc_attr( $bottom_color_cate ) . '"><br>';
		echo '	<p class="description">' . __( 'Select bottom color for page.', 'apr-core' ) . '</p>';
		echo '</div>';
	}

	public function edit_screen_fields( $term, $taxonomy ) {

		// Retrieve an existing value from the database.
		$product_cat_label      = get_term_meta( $term->term_id, 'product_cat_label', true );
		$categories_label_color = get_term_meta( $term->term_id, 'categories_label_color', true );
		$bg_color_cate          = get_term_meta( $term->term_id, 'bg_color_cate', true );
		$bottom_color_cate      = get_term_meta( $term->term_id, 'bottom_color_cate', true );

		if ( empty( $product_cat_label ) ) {
			$product_cat_label = '';
		}
		if ( empty( $categories_label_color ) ) {
			$categories_label_color = '';
		}
		if ( empty( $bg_color_cate ) ) {
			$bg_color_cate = '';
		}
		if ( empty( $bottom_color_cate ) ) {
			$bottom_color_cate = '';
		}

		echo '<tr class="form-field term-product_cat_label-wrap">';
		echo '<th scope="row">';
		echo '	<label for="product_cat_label">' . __( 'Categories label', 'apr-core' ) . '</label>';
		echo '</th>';
		echo '<td>';
		echo '	<input type="text" id="product_cat_label" name="product_cat_label" placeholder="' . esc_attr__( '', 'apr-core' ) . '" value="' . esc_attr( $product_cat_label ) . '">';
		echo wp_oembed_get( $product_cat_label );
		echo '	<p class="description">' . __( 'Only works when you use in Mega Menu with categories.', 'apr-core' ) . '</p>';
		echo '</td>';
		echo '</tr>';

		echo '<tr class="form-field term-categories_label_color-wrap">';
		echo '<th scope="row">';
		echo '	<label for="categories_label_color">' . __( 'Categories label color', 'apr-core' ) . '</label>';
		echo '</th>';
		echo '<td>';
		echo '	<input type="text" id="categories_label_color" name="categories_label_color" class="categories_label_color_picker" value="' . esc_attr( $categories_label_color ) . '"><br>';
		echo '	<p class="description">' . __( 'The hex color of the region title.', 'apr-core' ) . '</p>';
		echo '</td>';
		echo '</tr>';

		echo '<tr class="form-field term-categories_label_color-wrap">';
		echo '<th scope="row">';
		echo '	<label for="categories_label_color">' . __( 'Background color', 'apr-core' ) . '</label>';
		echo '</th>';
		echo '<td>';
		echo '	<input type="text" id="bg_color_cate" name="bg_color_cate" class="categories_label_color_picker" value="' . esc_attr( $bg_color_cate ) . '"><br>';
		echo '	<p class="description">' . __( 'Select background color for page.', 'apr-core' ) . '</p>';
		echo '</td>';
		echo '</tr>';

	}

	public function save_data( $term_id ) {

		// Sanitize user input.
		$categories_new_label       = isset( $_POST['product_cat_label'] ) ? $_POST['product_cat_label'] : '';
		$categories_new_label_color = isset( $_POST['categories_label_color'] ) ? sanitize_hex_color( $_POST['categories_label_color'] ) : '';
		$bg_color_cate              = isset( $_POST['bg_color_cate'] ) ? sanitize_hex_color( $_POST['bg_color_cate'] ) : '';

		// Update the meta field in the database.
		update_term_meta( $term_id, 'product_cat_label', $categories_new_label );
		update_term_meta( $term_id, 'categories_label_color', $categories_new_label_color );
		update_term_meta( $term_id, 'bg_color_cate', $bg_color_cate );

	}

	public function load_scripts_styles() {

		// Color picker
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );

	}

	public function add_admin_js() {
		// Print js only once per page
		if ( did_action( 'Categories_label_Term_Meta_js' ) >= 1 ) {
			return;
		}

		?>
		<script>
			jQuery(document).ready(function ($) {
				$('.categories_label_color_picker').wpColorPicker();
			});
		</script>
		<?php

		do_action( 'Categories_label_Term_Meta_js', $this );

	}

}

new Apr_Core_Custom_Term_Meta;
