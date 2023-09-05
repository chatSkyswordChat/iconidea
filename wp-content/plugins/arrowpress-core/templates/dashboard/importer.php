<?php
$demo_data      = $args['$demo_data'];
$demo_installed = $args['$demo_installed'];
echo apply_filters( 'arrowpress-message-before-importer', '' );
?>

<div class="wrapper-import-demo tc-importer-wrapper" data-template="arrowpress-importer">
</div>

<script type="text/html" id="tmpl-arrowpress-importer">
    <div class="theme-browser rendered">
        <div class="themes wp-clearfix">
            <# if ( _.size(data.demos) > 0 ) { #>
                <# _.each(data.demos, function(demo) { #>
                    <div class="theme arrowpress-demo {{demo.key == data.installed ? 'installed active' : ''}}" data-arrowpress-demo="{{demo.key}}">
                        <div class="theme-screenshot arrowpress-screenshot">
                            <img src="{{demo['screenshot']}}" alt="{{demo['title']}}">
                        </div>

                        <div class="theme-id-container">
                            <h2 class="theme-name">{{demo['title']}}</h2>

                            <div class="theme-actions">
                                <# if (demo.key == data.installed) { #>
                                    <button class="button button-primary btn-uninstall"><?php esc_html_e( 'Uninstall', 'arrowpress-core' ); ?></button>
                                    <# } else { #>
                                        <button class="button button-primary action-import"><?php esc_html_e( 'Install', 'arrowpress-core' ); ?></button>
                                        <a class="button button-secondary" href="{{demo['demo_url']}}" target="_blank"><?php esc_html_e( 'Preview', 'arrowpress-core' ); ?></a>
                                        <# } #>
                            </div>
                        </div>
                    </div>
                    <# }); #>
                        <# } else { #>
                            <h3 class="text-center"><?php esc_html_e( 'No demo content.', 'arrowpress-core' ); ?></h3>
                            <# } #>
        </div>
    </div>
</script>
