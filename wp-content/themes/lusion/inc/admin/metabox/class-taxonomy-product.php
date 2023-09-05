<?php

class Apr_Core_Taxonomy_Product_Metabox {

	protected $type;

	public function __construct( $type ) {
		$this->type = $type;
		add_action( 'init', array( $this, 'createProductTable' ) );
		add_action( 'product_cat_add_form_fields', array( $this, 'createProductCategory' ), 10, 2 );
		add_action( 'product_cat_edit_form_fields', array( $this, 'editProductCategory' ), 10, 2 );
		add_action( 'created_term', array( $this, 'saveProductCategory' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'saveProductCategory' ), 10, 3 );
	}

	public function createProductTable() {
		global $wpdb;
		$type                 = $this->type;
		$tableName            = $wpdb->prefix . $this->type . 'meta';
		$table_name           = $wpdb->prefix . $type . 'meta';
		$variable_name        = $type . 'meta';
		$wpdb->$variable_name = $table_name;

		if ( ! empty ( $wpdb->charset ) ) {
			$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
		}
		if ( ! empty ( $wpdb->collate ) ) {
			$charset_collate .= " COLLATE {$wpdb->collate}";
		}

		if ( get_option( 'apr-core_' . $tableName ) ) {
			return false;
		}

		if ( ! $wpdb->get_var( "SHOW TABLES LIKE '$tableName'" ) == $tableName ) {
			$sql = "CREATE TABLE {$tableName} (
	            meta_id bigint(20) NOT NULL AUTO_INCREMENT,
	            {$type}_id bigint(20) NOT NULL default 0,
	            meta_key varchar(255) DEFAULT NULL,
	            meta_value longtext DEFAULT NULL,
	            UNIQUE KEY meta_id (meta_id)
	        ) {$charset_collate};";
			$wpdb->query( $sql );
			update_option( 'apr-core_' . $tableName, true );
		}

		return true;
	}

	public function createProductCategory() {
		$metaBoxes = $this->getDefaultTaxMetaData();
		$this->showTaxAddMetaBoxes( $metaBoxes );
	}

	public function editProductCategory( $tag, $taxonomy ) {
		$metaBoxes = $this->getDefaultTaxMetaData();
		$this->showTaxEditMetaBoxes( $tag, $taxonomy, $metaBoxes );
	}

	public function saveProductCategory( $term_id, $tt_id, $taxonomy ) {
		if ( ! $term_id ) {
			return;
		}
		$metaBoxes = $this->getDefaultTaxMetaData();

		return $this->saveTaxData( $term_id, $tt_id, $taxonomy, $metaBoxes );
	}

	protected function showTaxEditMetaBoxes( $tag, $taxonomy, $metaBoxes ) {
		if ( ! isset( $metaBoxes ) || empty( $metaBoxes ) ) {
			return;
		}

		foreach ( $metaBoxes as $meta_box ) {
			$this->_showTaxEditMetaBox( $tag, $taxonomy, $meta_box );
		}
	}

	protected function showTaxAddMetaBoxes( $metaBoxes ) {
		if ( ! isset( $metaBoxes ) || empty( $metaBoxes ) ) {
			return;
		}

		foreach ( $metaBoxes as $meta_box ) {
			$this->_showTaxAddMetaBox( $meta_box );
		}
	}

	public function _showTaxAddMetaBox( $meta_box ) {
		extract(
			shortcode_atts( array(
				"name"    => '',
				"title"   => '',
				"desc"    => '',
				"type"    => '',
				"default" => '',
				"options" => ''
			), $meta_box )
		);

		?>

		<input type="hidden" name="<?php echo $name ?>_noncename" id="<?php echo $name ?>_noncename"
			   value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ) ?>"/>

		<?php

		if ( $type == "text" ) : // text
			?>
			<div class="form-field">
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>"/>
				<?php if ( $desc ) : ?><p><?php echo $desc ?></p><?php endif; ?>
			</div>
		<?php endif;

		if ( $type == "select" ) : // select
			?>
			<div class="form-field">
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<select name="<?php echo $name ?>" id="<?php echo $name ?>">
					<?php if ( is_array( $options ) ) :
						foreach ( $options as $key => $value ) : ?>
							<option value="<?php echo $key ?>"><?php echo $value ?></option>
						<?php endforeach;
					endif; ?>
				</select>
				<?php if ( $desc ) : ?><p><?php echo $desc ?></p><?php endif; ?>
			</div>
		<?php endif;

		if ( $type == "upload" ) : // upload image
			?>
			<div class="form-field">
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<label for='upload_image'>
					<input style="margin-bottom:5px;" type="text" name="<?php echo $name ?>"
						   id="<?php echo $name ?>"/><br/>
					<button class="button_upload_image button"
							id="<?php echo $name ?>"><?php echo esc_html__( 'Upload Image', 'apr-core' ) ?></button>
					<button class="button_remove_image button"
							id="<?php echo $name ?>"><?php echo esc_html__( 'Remove Image', 'apr-core' ) ?></button>
				</label>
				<?php if ( $desc ) : ?><p><?php echo $desc ?></p><?php endif; ?>
			</div>
		<?php endif;

		if ( $type == "editor" ) : // editor
			?>
			<div class="form-field">
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<?php wp_editor( '', $name ) ?>
				<?php if ( $desc ) : ?><p><?php echo $desc ?></p><?php endif; ?>
			</div>
		<?php endif;

		if ( $type == "textarea" ) : // textarea
			?>
			<div class="form-field">
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<textarea id="<?php echo $name ?>" name="<?php echo $name ?>"></textarea>
				<?php if ( $desc ) : ?><p><?php echo $desc ?></p><?php endif; ?>
			</div>
		<?php endif;

		if ( ( $type == 'radio' ) && ( ! empty( $options ) ) ) : // radio buttons
			?>
			<div class="form-field">
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<?php foreach ( $options as $key => $value ) : ?>
					<input style="display:inline-block; width:auto;" type="radio"
						   id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>"
						   value="<?php echo $key ?>"/>
					<label style="display:inline-block"
						   for="<?php echo $name ?>_<?php echo $key ?>"><?php echo $value ?></label>
				<?php endforeach; ?>
				<?php if ( $desc ) : ?><p><?php echo $desc ?></p><?php endif; ?>
			</div>
		<?php endif;

		if ( $type == "checkbox" ) : // checkbox
			?>
			<div class="form-field">
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<label><input style="display:inline-block; width:auto;" type="checkbox" name="<?php echo $name ?>"
							  value="<?php echo $name ?>"/> <?php echo $desc ?></label>
			</div>
		<?php endif;

		if ( ( $type == 'multi_checkbox' ) && ( ! empty( $options ) ) ) : // radio buttons
			?>
			<div class="form-field">
				<label for="<?php echo $name ?>"><?php echo $title ?></label>
				<?php foreach ( $options as $key => $value ) : ?>
					<input style="display:inline-block; width:auto;" type="checkbox"
						   id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>[]"
						   value="<?php echo $key ?>"/>
					<label style="display:inline-block"
						   for="<?php echo $name ?>_<?php echo $key ?>"><?php echo $value ?></label>
				<?php endforeach; ?>
				<?php if ( $desc ) : ?><p><?php echo $desc ?></p><?php endif; ?>
			</div>
		<?php endif;
	}

	protected function _showTaxEditMetaBox( $tag, $taxonomy, $meta_box ) {
		extract(
			shortcode_atts( array(
				"name"     => '',
				"title"    => '',
				"desc"     => '',
				"type"     => '',
				"default"  => '',
				"options"  => '',
				"required" => '',
			), $meta_box )
		);

		?>

		<input type="hidden" name="<?php echo $name ?>_noncename" id="<?php echo $name ?>_noncename"
			   value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ) ?>"/>

		<?php
		$meta_box_value = get_metadata( $tag->taxonomy, $tag->term_id, $name, true );

		if ( $meta_box_value == "" ) {
			$meta_box_value = $default;
		}

		if ( $type == "text" ) : // text
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>"
						   value="<?php echo stripslashes( $meta_box_value ) ?>" size="50%"/>
					<?php if ( $desc ) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			</tr>
		<?php endif;

		if ( $type == "select" ) : // select
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<select name="<?php echo $name ?>" id="<?php echo $name ?>">
						<?php if ( is_array( $options ) ) :
							foreach ( $options as $key => $value ) : ?>
								<option
									value="<?php echo $key ?>"<?php echo $meta_box_value == $key ? ' selected="selected"' : '' ?>><?php echo $value ?></option>
							<?php endforeach;
						endif; ?>
					</select>
					<?php if ( $desc ) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			</tr>
		<?php endif;

		if ( $type == "upload" ) : // upload image
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<label for='upload_image'>
						<input style="margin-bottom:5px;" value="<?php echo stripslashes( $meta_box_value ) ?>"
							   type="text" name="<?php echo $name ?>" id="<?php echo $name ?>" size="50%"/>
						<br/>
						<button class="button_upload_image button"
								id="<?php echo $name ?>"><?php echo esc_html__( 'Upload Image', 'apr-core' ) ?></button>
						<button class="button_remove_image button"
								id="<?php echo $name ?>"><?php echo esc_html__( 'Remove Image', 'apr-core' ) ?></button>
					</label>
					<?php if ( $desc ) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			</tr>
		<?php endif;

		if ( $type == "editor" ) : // editor
			?>
			<tr class="form-field">
				<th colspan="2" scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label>
				</th>
			<tr>
				<td colspan="2">
					<?php wp_editor( $meta_box_value, $name ) ?>
					<?php if ( $desc ) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			</tr>
		<?php endif;

		if ( $type == "textarea" ) : // textarea
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
                    <textarea id="<?php echo $name ?>"
							  name="<?php echo $name ?>"><?php echo stripslashes( $meta_box_value ) ?></textarea>
					<?php if ( $desc ) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			</tr>
		<?php endif;

		if ( ( $type == 'radio' ) && ( ! empty( $options ) ) ) : // radio buttons
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<?php foreach ( $options as $key => $value ) : ?>
						<input style="display:inline-block; width:auto;" type="radio"
							   id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>"
							   value="<?php echo $key ?>"
							<?php echo( isset( $meta_box_value ) && ( $meta_box_value == $key ) ? ' checked="checked"' : '' ) ?>/>
						<label for="<?php echo $name ?>_<?php echo $key ?>"><?php echo $value ?></label>
					<?php endforeach; ?>
					<?php if ( $desc ) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			</tr>
		<?php endif;

		if ( $type == "checkbox" ) :  // checkbox
			?>
			<?php if ( $meta_box_value == $name ) {
			$checked = "checked=\"checked\"";
		} else {
			$checked = "";
		} ?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<label><input style="display:inline-block; width:auto;" type="checkbox" name="<?php echo $name ?>"
								  value="<?php echo $name ?>" <?php echo $checked ?> /> <?php echo $desc ?></label>
				</td>
			</tr>
		<?php endif;

		if ( ( $type == 'multi_checkbox' ) && ( ! empty( $options ) ) ) : // radio buttons
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<?php foreach ( $options as $key => $value ) : ?>
						<input style="display:inline-block; width:auto;" type="checkbox"
							   id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>[]"
							   value="<?php echo $key ?>" <?php echo( ( isset( $meta_box_value ) && in_array( $key, explode( ',', $meta_box_value ) ) ) ? ' checked="checked"' : '' ) ?>/>
						<label for="<?php echo $name ?>_<?php echo $key ?>"> <?php echo $value ?></label>
					<?php endforeach; ?>
					<?php if ( $desc ) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
				</td>
			</tr>
		<?php endif;
	}

	// Save Tax Data
	function saveTaxData( $term_id, $tt_id, $taxonomy, $meta_boxes ) {
		if ( ! isset( $meta_boxes ) || empty( $meta_boxes ) ) {
			return;
		}

		foreach ( $meta_boxes as $meta_box ) {

			extract(
				shortcode_atts( array(
					"name"     => '',
					"title"    => '',
					"desc"     => '',
					"type"     => '',
					"default"  => '',
					"options"  => '',
					"required" => '',
				), $meta_box )
			);

			if ( ! isset( $_POST[$name . '_noncename'] ) ) {
				return;
			}

			if ( ! wp_verify_nonce( $_POST[$name . '_noncename'], plugin_basename( __FILE__ ) ) ) {
				return;
			}

			$meta_box_value = get_metadata( $taxonomy, $term_id, $name, true );

			if ( ! isset( $_POST[$name] ) ) {
				delete_metadata( $taxonomy, $term_id, $name, $meta_box_value );
				continue;
			}

			$data = $_POST[$name];

			if ( is_array( $data ) ) {
				$data = implode( ',', $data );
			}

			if ( ! $meta_box_value && ! $data ) {
				add_metadata( $taxonomy, $term_id, $name, $data, true );
			} elseif ( $data != $meta_box_value ) {
				update_metadata( $taxonomy, $term_id, $name, $data );
			} elseif ( ! $data ) {
				delete_metadata( $taxonomy, $term_id, $name, $meta_box_value );
			}
		}
	}

	protected function getDefaultTaxMetaData() {
		$apr_sidebars = Lusion_Helper::get_registered_sidebars( $default_option = true );

		return array(
			'hide_header'                 => array(
				'name'  => 'hide_header',
				'title' => esc_html__( 'Header', 'apr-core' ),
				'desc'  => esc_html__( 'Hide header', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'hide_footer'                 => array(
				'name'  => 'hide_footer',
				'title' => esc_html__( 'Footer', 'apr-core' ),
				'desc'  => esc_html__( 'Hide footer', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'page_title'                  => array(
				'name'  => 'page_title',
				'title' => esc_html__( 'Page Title', 'apr-core' ),
				'desc'  => esc_html__( 'Hide Page Title', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'breadcrumb'                  => array(
				'name'  => 'breadcrumb',
				'title' => esc_html__( 'Breadcrumbs', 'apr-core' ),
				'desc'  => esc_html__( 'Hide Breadcrumbs', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'product_left_sidebar'        => array(
				'name'    => 'product_left_sidebar',
				'title'   => esc_html__( 'Left Sidebar', 'apr-core' ),
				'desc'    => esc_html__( 'Left Sidebar', 'apr-core' ),
				'type'    => 'select',
				'options' => $apr_sidebars,
				'default' => 'default',
			),
			'product_right_sidebar'       => array(
				'name'    => 'product_right_sidebar',
				'title'   => esc_html__( 'Right Sidebar', 'apr-core' ),
				'desc'    => esc_html__( 'Right Sidebar', 'apr-core' ),
				'type'    => 'select',
				'options' => $apr_sidebars,
				'default' => 'default',
			),
			'product_columns'             => array(
				'name'    => 'product_columns',
				'title'   => esc_html__( 'Product Columns', 'apr-core' ),
				'desc'    => esc_html__( 'Select product columns. Note: Option 4 col not for cases where the page has 2 sidebar (left and right); Option 3 col, 4 col  col not for cases where the page product list layout.', 'apr-core' ),
				'type'    => 'select',
				'default' => '',
				'options' => array(
					''  => esc_html__( 'Default', 'apr-core' ),
					'1' => esc_html__( '1 col', 'apr-core' ),
					'2' => esc_html__( '2 col', 'apr-core' ),
					'3' => esc_html__( '3 col', 'apr-core' ),
					'4' => esc_html__( '4 col', 'apr-core' ),
				),
			),
			'product_columns_layout_list' => array(
				'name'    => 'product_columns_layout_list',
				'title'   => esc_html__( 'Product Columns Layout List', 'apr-core' ),
				'type'    => 'select',
				'default' => '2',
				'options' => array(
					''  => esc_html__( 'Default', 'apr-core' ),
					'1' => esc_html__( '1 col', 'apr-core' ),
					'2' => esc_html__( '2 col', 'apr-core' ),
				),
			),
			'product_layout'              => array(
				'name'    => 'product_layout',
				'title'   => esc_html__( 'Product layout', 'apr-core' ),
				'desc'    => esc_html__( 'Select product layout.', 'apr-core' ),
				'type'    => 'select',
				'default' => '',
				'options' => array(
					''          => esc_html__( 'Default', 'apr-core' ),
					'grid'      => esc_html__( 'Grid', 'apr-core' ),
					'list'      => esc_html__( 'List', 'apr-core' ),
					'grid_list' => esc_html__( 'Grid(default) / List', 'apr-core' ),
					'list_grid' => esc_html__( 'List(default) / Grid', 'apr-core' ),
				),
			),
			'product_type'                => array(
				'name'    => 'product_type',
				'title'   => esc_html__( 'Product Type', 'apr-core' ),
				'desc'    => esc_html__( 'Select product style (Only for layout grid).', 'apr-core' ),
				'type'    => 'select',
				'default' => 'default',
				'options' => array(
					'default' => __( 'Default', 'apr-core' ),
					'1'       => __( 'Style 1', 'apr-core' ),
					'2'       => __( 'Style 2', 'apr-core' ),
					'3'       => __( 'Style 3', 'apr-core' ),
					'4'       => __( 'Style 4', 'apr-core' ),
					'5'       => __( 'Style 5', 'apr-core' ),
					'6'       => __( 'Style 6', 'apr-core' ),
					'7'       => __( 'Style 7', 'apr-core' ),
				),
			),
			'pagination_type'             => array(
				'name'    => 'pagination_type',
				'title'   => esc_html__( 'Pagination Type', 'apr-core' ),
				'type'    => 'select',
				'default' => '',
				'options' => array(
					''                   => esc_html__( 'Default', 'apr-core' ),
					'number'             => esc_html__( 'Number', 'apr-core' ),
					'infinite_scrolling' => esc_html__( 'Infinite Scrolling', 'apr-core' ),
				),
			),
			'product_per_page'            => array(
				'name'    => 'product_per_page',
				'type'    => 'text',
				'title'   => esc_html__( 'Product Show Per Page', 'apr-core' ),
				'default' => '',
			),
			'image'                       => array(
				'name'             => 'image',
				'title'            => esc_html__( 'Background Image Breadcrumb', 'apr-core' ),
				'desc'             => esc_html__( 'Upload Background Image For Breadcrumb', 'apr-core' ),
				//				'type'    => 'upload',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'default'          => '',
			),
			'color_page_title'            => array(
				'name'    => 'color_page_title',
				'title'   => esc_html__( 'Breadcrumb Text Color', 'apr-core' ),
				'desc'    => esc_html__( 'Select Breadcrumb Text Color. Ex: #2c2c2c', 'apr-core' ),
				'type'    => 'text',
				'default' => '',
			),
			'color_breadcrumb_link'       => array(
				'name'    => 'color_breadcrumb_link',
				'title'   => esc_html__( 'Breadcrumb Text Link Color', 'apr-core' ),
				'desc'    => esc_html__( 'Select Breadcrumb Text Link Color. Ex: #707070', 'apr-core' ),
				'type'    => 'text',
				'default' => '',
			),
			'banner_page_shop'            => array(
				'name'  => 'banner_page_shop',
				'title' => esc_html__( 'Banner', 'apr-core' ),
				'desc'  => esc_html__( 'Hide Banner', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'get_template_product'        => array(
				'name'    => 'select_template',
				'title'   => esc_html__( 'Select Banner', 'apr-core' ),
				'desc'    => esc_html__( '', 'apr-core' ),
				'type'    => 'select',
				'default' => '',
				'options' => lusion_get_template(),
			),
			'filter_top_product'          => array(
				'name'  => 'filter_top_product',
				'title' => esc_html__( 'Filter', 'apr-core' ),
				'desc'  => esc_html__( 'Filter Top', 'apr-core' ),
				'type'  => 'checkbox',
			),
		);
	}
}

$product_apr_core_taxonomy_metabox = new Apr_Core_Taxonomy_Product_Metabox( 'product_cat' );
