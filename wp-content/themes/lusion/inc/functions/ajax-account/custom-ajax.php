<?php
function lusion_ajax_account_init(){
    wp_register_script('validate-script', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array('jquery') );
    wp_enqueue_script('validate-script');
    wp_enqueue_script('ajax-account-script', get_template_directory_uri().'/assets/js/un-minify/ajax-account.min.js', array('jquery'));
    wp_enqueue_script('ajax-account-script');

    wp_localize_script( 'ajax-account-script', 'ajax_account_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => get_permalink(get_option('woocommerce_myaccount_page_id')),
        'loadingmessage' => __('<p class="woocommerce-message">Sending user info, please wait...</p>', 'lusion')
    ));
    // Enable the user with no privileges to run lusion_ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'lusion_ajax_login' );
    // Enable the user with no privileges to run lusion_ajax_register() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxregister', 'lusion_ajax_register' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'lusion_ajax_account_init');
}
function lusion_ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    // Call auth_user_login
    lusion_auth_user_login($_POST['username'], $_POST['password'], '');

    die();
}

function lusion_ajax_register(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
    $info['user_pass'] = sanitize_text_field($_POST['password']);
    $info['user_email'] = sanitize_email( $_POST['email']);

    // Register the user
    $user_register = wp_insert_user( $info );
    if ( is_wp_error($user_register) ){
        $error  = $user_register->get_error_codes()	;

        if(in_array('empty_user_login', $error))
            echo json_encode(array('loggedin'=>false, 'message'=>$user_register->get_error_message('empty_user_login')));
        elseif(in_array('existing_user_login',$error))
            echo json_encode(array('loggedin'=>false, 'message'=>__('<p class="woocommerce-info">This username is already registered.</p>', 'lusion')));
        elseif(in_array('existing_user_email',$error))
            echo json_encode(array('loggedin'=>false, 'message'=>__('<p class="woocommerce-info">This email address is already registered.</p>', 'lusion')));
    } else {
//        auth_user_login($info['nickname'], $info['user_pass'], 'Registration');
        lusion_auth_user_login($info['nickname'], $info['user_pass'], '');
    }

    die();
}
function lusion_auth_user_login($user_login, $password, $login){
    $info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;

    // From false to '' since v 4.9
    $user_signon = wp_signon( $info, '' );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('<p class = "woocommerce-error">Invalid username or password. Please try again!</p>','lusion')));
    } else {
        wp_set_current_user($user_signon->ID);
        echo json_encode(array('loggedin'=>true, 'message'=>__('<p class="woocommerce-message">Successful </p>','lusion')));
    }

    die();
}