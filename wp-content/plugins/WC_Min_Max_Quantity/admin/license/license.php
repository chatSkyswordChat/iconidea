<?php
namespace WC_MMQ_PRO\Admin\License;

class License {

    use \WC_MMQ_PRO\Admin\License\Singleton;

    public function __construct(){
        
        // THE AJAX ADD ACTIONS
        add_action( 'init', [$this, 'activate_license'] );

        add_action( 'init', [$this, 'deactivate_license'] );

    }

    public function activate_license() {
        
        if( isset($_POST['wcmmq_pro_license_key']) && !empty($_POST['wcmmq_pro_license_key'])){

            $edd_action_type = "activate_license";
            $license_key     = !empty( $_POST["wcmmq_pro_license_key"] ) ? trim( $_POST["wcmmq_pro_license_key"] ) : "";
            $item_id         = WC_MMQ_EDD_PRODUCT_ID;
            $store_url       = WC_MMQ_EDD_STORE_URL;

            if ( empty( $edd_action_type ) || empty( $license_key ) || empty( $item_id ) || empty( $store_url ) ) {
                //Nothing to Show Here.

            } else {
                $message = '';
                $message_type = 'success';
                $api_params = [
                    'edd_action' => $edd_action_type,
                    'license'    => urlencode($license_key),
                    'item_id'    => urlencode( $item_id ),
                    'url'        => home_url(),
                ];

                $response = wp_remote_get( $store_url, ['body' => $api_params, 'timeout' => 15, 'redirection' => 3, 'sslverify' => false] );

                // if ( is_wp_error( $response ) ) {
                //     echo "error";
                //     wp_die();
                // }

                if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

                    if ( is_wp_error( $response ) ) {
                        $message = $response->get_error_message();
                    } else {
                        $message = __( 'An error occurred, please try again.', 'wcmmq_pro' );
                    }
                }else{

                    $body         = wp_remote_retrieve_body( $response );
                    $license_data = json_decode( $body );

                    if ( $license_data->license == 'valid' ) {
                        $license        = $license_key;
                        $license_status = 'valid';

                        update_option( WC_MMQ_EDD_LICENSE_KEY, $license );
                        update_option( WC_MMQ_EDD_LICENSE_STATUS, $license_status );
                        $this->global_var_cache_set( WC_MMQ_EDD_LICENSE_STATUS, $license_status );



                    } else if(false === $license_data->success) {
                        $message_type = 'warning';
                        switch ( $license_data->error ) {

                            case 'expired':
                                $message = sprintf(
                                    /* translators: the license key expiration date */
                                    __( 'Your license key expired on %s.', 'wcmmq_pro' ),
                                    date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
                                );
                                break;
            
                            case 'disabled':
                            case 'revoked':
                                $message = __( 'Your license key has been disabled.', 'wcmmq_pro' );
                                break;
            
                            case 'missing':
                                $message = __( 'Invalid license.', 'wcmmq_pro' );
                                break;
            
                            case 'invalid':
                            case 'site_inactive':
                                $message = __( 'Your license is not active for this URL.', 'wcmmq_pro' );
                                break;
            
                            case 'item_name_mismatch':
                                /* translators: the plugin name */
                                $message = sprintf( __( 'This appears to be an invalid license key for %s.', 'wcmmq_pro' ), EDD_SAMPLE_ITEM_NAME );
                                break;
            
                            case 'no_activations_left':
                                $message = __( 'Your license key has reached its activation limit.', 'wcmmq_pro' );
                                break;
            
                            default:
                                $message = __( 'An error occurred, please try again.', 'wcmmq_pro' );
                                break;
                        }



                        delete_option( WC_MMQ_EDD_LICENSE_KEY );
                        delete_option( WC_MMQ_EDD_LICENSE_STATUS );
                    }

                }

                if ( ! empty( $message ) ) {
                    $redirect = add_query_arg(
                        array(
                            'page'          => WC_MMQ_EDD_LICENSE_PAGE,
                            //'sl_activation' => 'false',
                            'barta'       => rawurlencode( $message ),
                            'type'          => $message_type
                        ),
                        admin_url( 'admin.php' )
                    );
            
                    wp_safe_redirect( $redirect );
                    exit();
                }


                wp_safe_redirect( admin_url( 'admin.php?page=' . WC_MMQ_EDD_LICENSE_PAGE . '&message=This is barta' ) );

                

            }

            // exit;
        }

    }

    public function deactivate_license() {
        $edd_action_type = "deactivate_license";
        $license_key     = get_option( WC_MMQ_EDD_LICENSE_KEY );
        $item_id         = WC_MMQ_EDD_PRODUCT_ID;
        $store_url       = WC_MMQ_EDD_STORE_URL;

        if ( empty( $_POST['ultraaddons-revoke-license'] ) || empty( $edd_action_type ) || empty($license_key)) {
            //echo "invalid-1";
        } else {

            $item_id    = $item_id;
            $license    = $license_key;
            $api_params = [
                'edd_action' => $edd_action_type,
                'license'    => urlencode($license),
                'item_id'    => urlencode( $item_id ),
                'url'        => home_url(),
            ];

            $response = wp_remote_get( $store_url, ['body' => $api_params, 'timeout' => 15, 'redirection' => 3, 'sslverify' => false] );

            if ( is_wp_error( $response ) ) {
                echo "error";
                wp_die();
            }

            $body         = wp_remote_retrieve_body( $response );
            $license_data = json_decode( $body );

            if ( $license_data->license == 'deactivated' ) {
                $license_status = 'invalid';

                delete_option( WC_MMQ_EDD_LICENSE_KEY );
                delete_option( WC_MMQ_EDD_LICENSE_STATUS );

                $this->global_var_cache_set( WC_MMQ_EDD_LICENSE_STATUS, $license_status );

                echo 'deactivated';

            } else {
                echo 'deactivated';
            }

        }

        // exit;
    }

    public function global_var_cache_get( $key ) {
        global $etn_global_var_cache;

        if ( isset( $etn_global_var_cache[$key] ) ) {
            return $etn_global_var_cache[$key];
        }

        return null;
    }

    public function global_var_cache_set( $key, $value ) {
        global $etn_global_var_cache;
        $etn_global_var_cache[$key] = $value;

        return true;
    }

    public function status() {
        $cached = $this->global_var_cache_get( WC_MMQ_EDD_LICENSE_STATUS );
        
        //return cached data if any
        if ( null !== $cached ) {
            return $cached;
        }

        //check if any license data is stored
        $license_key    = get_option( WC_MMQ_EDD_LICENSE_KEY );
        $license_status = get_option( WC_MMQ_EDD_LICENSE_STATUS );
        $status         = 'invalid';

        // check if stored data is valid
        if ( 'valid' == $license_status && !empty( $license_key ) ) {

            //check if license active and update local storage
            $is_license_key_valid   = $this->check_license_validity( $license_key );

            if( $is_license_key_valid ){
                $status = 'valid';
            } else {
                delete_option( WC_MMQ_EDD_LICENSE_KEY );
                delete_option( WC_MMQ_EDD_LICENSE_STATUS );
            }
        }
        $this->global_var_cache_set( WC_MMQ_EDD_LICENSE_STATUS, $status );

        return $status;
    }

    public function check_license_validity( $license_key ) {
        $edd_action_type = 'check_license';
        $item_id         = WC_MMQ_EDD_PRODUCT_ID;
        $store_url       = WC_MMQ_EDD_STORE_URL;

        if ( empty( $edd_action_type ) || empty( $license_key ) || empty( $item_id ) || empty( $store_url ) ) {
            echo "invalid";
        } else {
            $item_id    = $item_id;
            $license    = $license_key;
            $api_params = [
                'edd_action' => $edd_action_type,
                'license'    => urlencode($license),
                'item_id'    => urlencode( $item_id ),
                'url'        => home_url(),
            ];

            $response = wp_remote_get( $store_url, ['body' => $api_params, 'timeout' => 15, 'redirection' => 3, 'sslverify' => false] );

            if ( is_wp_error( $response ) ) {
                echo "error";
                wp_die();
            }

            $body         = wp_remote_retrieve_body( $response );
            $license_data = json_decode( $body );

            if ( $license_data->license == 'valid' ) {
                return true;
            } else {
                return false;
            }

        }

        // exit;
    }

}