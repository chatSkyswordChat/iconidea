<?php

class Apr_Core_Taxonomy_Metabox {

	protected $type;

	public function __construct( $type ) {
		$this->type = $type;
		add_action( 'init', array( $this, 'createTable' ) );
		add_action( 'category_add_form_fields', array( $this, 'createCategory' ), 10, 2 );
		add_action( 'category_edit_form_fields', array( $this, 'editCategory' ), 10, 2 );
		add_action( 'created_term', array( $this, 'saveCategory' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'saveCategory' ), 10, 3 );
	}

	public function createTable() {
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

		if ( get_option( 'lusion_' . $tableName ) ) {
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
			update_option( 'lusion_' . $tableName, true );
		}

		return true;
	}

	public function createCategory() {
		$metaBoxes = $this->getDefaultTaxMetaData();
		$this->showTaxAddMetaBoxes( $metaBoxes );
	}

	public function editCategory( $tag, $taxonomy ) {
		$metaBoxes = $this->getDefaultTaxMetaData();
		$this->showTaxEditMetaBoxes( $tag, $taxonomy, $metaBoxes );
	}

	public function saveCategory( $term_id, $tt_id, $taxonomy ) {
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
				"name"         => '',
				"title"        => '',
				"desc"         => '',
				"type"         => '',
				"default"      => '',
				"options"      => '',
				"required"     => '',
				"number_after" => ''
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

		if ( $type == "number" ) : ?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
				<td>
					<input type="number" id="<?php echo esc_attr( $name ) ?>" name="<?php echo esc_attr( $name ) ?>"
						   value="<?php echo stripslashes( $meta_box_value ) ?>" size="50%"/>
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
					"name"         => '',
					"title"        => '',
					"desc"         => '',
					"type"         => '',
					"default"      => '',
					"options"      => '',
					"require"      => '',
					"number_after" => '',
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
			'breadcrumb'      => array(
				'name'  => 'breadcrumb',
				'title' => esc_html__( 'Breadcrumbs', 'apr-core' ),
				'desc'  => esc_html__( 'Hide Breadcrumbs', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'page_title'      => array(
				'name'  => 'page_title',
				'title' => esc_html__( 'Page title', 'apr-core' ),
				'desc'  => esc_html__( 'Hide Page Title', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'hide_header'     => array(
				'name'  => 'hide_header',
				'title' => esc_html__( 'Header', 'apr-core' ),
				'desc'  => esc_html__( 'Hide header', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'hide_footer'     => array(
				'name'  => 'hide_footer',
				'title' => esc_html__( 'Footer', 'apr-core' ),
				'desc'  => esc_html__( 'Hide footer', 'apr-core' ),
				'type'  => 'checkbox',
			),
			'left_sidebar'    => array(
				'name'    => 'left_sidebar',
				'title'   => esc_html__( 'Left Sidebar', 'apr-core' ),
				'desc'    => esc_html__( 'Left Sidebar', 'apr-core' ),
				'type'    => 'select',
				'options' => $apr_sidebars,
				'default' => '',
			),
			'right_sidebar'   => array(
				'name'    => 'right_sidebar',
				'title'   => esc_html__( 'Right Sidebar', 'apr-core' ),
				'desc'    => esc_html__( 'Right Sidebar', 'apr-core' ),
				'type'    => 'select',
				'options' => $apr_sidebars,
				'default' => '',
			),
			'blog_layout'     => array(
				'name'    => 'blog_layout',
				'title'   => esc_html__( 'Blog layout', 'apr-core' ),
				'desc'    => esc_html__( 'Select blog layout', 'apr-core' ),
				'type'    => 'select',
				'options' => array(
					''        => esc_html__( 'Default', 'apr-core' ),
					'list'    => esc_html__( 'List', 'apr-core' ),
					'grid'    => esc_html__( 'Grid', 'apr-core' ),
					'masonry' => esc_html__( 'Masonry', 'apr-core' ),
				),
			),
			'blog_list_style' => array(
				'name'    => 'blog_list_style',
				'title'   => esc_html__( 'Blog List Style', 'apr-core' ),
				'desc'    => esc_html__( 'Select style blog layout List', 'apr-core' ),
				'type'    => 'select',
				'options' => array(
					''        => esc_html__( 'Default', 'apr-core' ),
					'style_1' => esc_html__( 'Style 1', 'apr-core' ),
					'style_2' => esc_html__( 'Style 2', 'apr-core' ),
					'style_3' => esc_html__( 'Style 3', 'apr-core' ),
				),
			),
			'blog_columns'    => array(
				'name'    => 'blog_columns',
				'title'   => esc_html__( 'Blog columns', 'apr-core' ),
				'desc'    => esc_html__( 'Select 1,2 columns for layout list and 2, 3, 4 columns for layout grid or masonry', 'apr-core' ),
				'type'    => 'select',
				'options' => array(
					''  => esc_html__( 'Default', 'apr-core' ),
					'1' => esc_html__( '1 col', 'apr-core' ),
					'2' => esc_html__( '2 col', 'apr-core' ),
					'3' => esc_html__( '3 col', 'apr-core' ),
					'4' => esc_html__( '4 col', 'apr-core' ),
				),
			),
			'post_per_page'   => array(
				'name'    => 'post_per_page',
				'desc'    => esc_html__( 'Number post show on page', 'apr-core' ),
				'title'   => esc_html__( 'Post show per page', 'apr-core' ),
				'type'    => 'number',
				'default' => '6',
			),
			'post_pagination' => array(
				'name'    => 'post_pagination',
				'title'   => esc_html__( 'Pagination type', 'apr-core' ),
				'desc'    => esc_html__( 'Select blog pagination', 'apr-core' ),
				'type'    => 'select',
				'options' => array(
					'default'   => esc_html__( 'Default', 'apr-core' ),
					'load_more' => esc_html__( 'Load more', 'apr-core' ),
					'next_prev' => esc_html__( 'Next/Prev', 'apr-core' ),
					'number'    => esc_html__( 'Number', 'apr-core' ),
				),
				'default' => 'default'
			),
			'image'           => array(
				'name'             => 'image',
				'title'            => esc_html__( 'Image Category', 'apr-core' ),
				'desc'             => esc_html__( 'Image', 'apr-core' ),
				//				'type'    => 'upload',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'default'          => '',
			),
		);
	}
}

$post_apr_core_taxonomy_metabox = new Apr_Core_Taxonomy_Metabox( 'category' );
