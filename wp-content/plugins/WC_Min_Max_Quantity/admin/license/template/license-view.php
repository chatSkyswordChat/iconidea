<?php
$license = \WC_MMQ_PRO\Admin\License\License::instance();

?>

<div class="license-module-parent">
    <div class="settings-section">
        <div class="license-parent">
            <?php 
            $message = isset( $_GET['barta'] ) & ! empty( $_GET['barta'] ) ? $_GET['barta'] : false;
            $message_type = isset( $_GET['type'] ) & ! empty( $_GET['type'] ) ? $_GET['type'] : 'warning';
            if( ! empty( $message ) ){?>
                <div id="codeastrology-license-message-area" class="notice notice-<?php echo esc_attr( $message_type ); ?>">
                    <p><?php echo wp_kses_post( $message ); ?></p>
                </div>
                
                <?php } ?>
            <div class="container">

            </div>
            <?php

            if( $license->status() !== 'valid' ){
                ?>
                <div class="container">
                    <form action="" method="POST" class="admin-form" id="admin-license-form">
                        <div class="tab_wraper">
                            <div class="admin-card attr-tab-content admin-card-shadow">
                                <div class="attr-card-body">
                                    <p>
                                        <?php echo esc_html__("Enter your license key here, to get auto updates.", 'wcmmq_pro');?>
                                    </p>
                                    <div><label class="admin-option-text-license-key" for="admin-option-text-license-key" ><?php echo esc_html__(" License Key", 'wcmmq_pro');?></label></div>
                                    <div class="admin-input-text  license-input-box">
                                        <input type="text" class="attr-form-control" id="admin-option-text-license-key" aria-describedby="admin-option-text-help-license-key" placeholder="Please insert your license key here" name="wcmmq_pro_license_key" value="" >
                                    </div>
                                    <div class="attr-input-group-btn license-input-box">
                                        <input type="hidden" name="type" value="activate" />
                                        <button class="btn-license-activate attr-btn-primary admin-license-form-submit" type="submit" > <?php echo esc_html__("Activate", 'wcmmq_pro');?></button>
                                    </div>
                                    <div class="license-result-box">
                                    </div>
                                    <div class="license-key-doc">
                                        <p class="license-key"><strong>Tips: </strong><a href="<?php echo esc_url( WC_MMQ_EDD_LICENCE_HELP_URL ); ?>" target="_black"><?php echo esc_html__( 'Where is my license key', 'wpt_pro' ); ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
            } else {
                ?>
                <div class="license-form-result">
                    <p class="attr-alert attr-alert-success">
                        <?php 
                        echo sprintf( esc_html__("Congratulations! Your product is activated for %s.", 'wcmmq_pro'), parse_url( home_url(), PHP_URL_HOST) );
                        // echo ;
                        ?>
                    </p>
                    <form action="" method="POST" class="admin-form" id="admin-license-form">
                        <input type="hidden" name="edd_action_type" value="revoke" />
                        <input type="submit" name="ultraaddons-revoke-license" value="<?php echo esc_html__('Revoke License', 'wcmmq_pro');?>"/>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        if(function_exists('wcmmq_social_links')){
            echo '<br><br><br><br>';
            wcmmq_social_links();
            echo '<br><br>';
            wcmmq_submit_issue_link();
        }
        ?>
    </div>
</div>
