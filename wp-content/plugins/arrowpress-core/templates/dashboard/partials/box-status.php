<?php if ( ! Arrowpress_Product_Registration::is_active() ) : ?>
    <div class="tc-box-status lock" title="<?php esc_attr_e( 'You must activate the theme to use this feature', 'arrowpress-core' ); ?>">
        <span class="dashicons dashicons-lock"></span>
    </div>
	<?php
endif;
