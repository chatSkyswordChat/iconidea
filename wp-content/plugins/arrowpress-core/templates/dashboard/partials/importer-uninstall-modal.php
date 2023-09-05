<div class="tc-modal-importer-uninstall md-modal md-effect-16" data-template="arrowpress-form-uninstall">
</div>
<div class="md-overlay"></div>

<script type="text/html" id="tmpl-arrowpress-form-uninstall">
    <div class="md-content">
        <h3 class="title"><?php esc_html_e( 'Uninstall Demo Content', 'arrowpress-core' ); ?><span class="close"></span></h3>
        <div class="main text-center">
            <p class="warning">
				<?php esc_html_e( 'If you click "Reset all", demo content will be deleted. Be careful :)', 'arrowpress-core' ); ?>
            </p>

            <button class="button button-secondary tc-button tc-start" title="<?php esc_attr_e( 'Reset all', 'arrowpress-core' ); ?>"><?php esc_html_e( 'Reset all', 'arrowpress-core' ); ?></button>

            <div class="notifications">
                <div class="tc-success">
                    <strong>Success!</strong>
                    <span class="content"></span>
                </div>
                <div class="tc-error">
                    <strong>Error!</strong>
                    <span class="content"></span>
                </div>
            </div>
        </div>
    </div>
</script>
