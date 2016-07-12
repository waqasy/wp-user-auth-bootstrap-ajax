<?php

function handle_form_login()
{
    session_start();

    $nonce = isset( $_POST['user_noncename'] ) ? $_POST['user_noncename'] : 'some random string here';
    if ( !wp_verify_nonce( $nonce, get_template_directory_uri( __FILE__ ) ) ) {
        return "something went wrong";
    }

    $username = sanitize_text_field(trim($_POST['username']));
    $password = sanitize_text_field(trim($_POST['password']));
    $remember = $_POST['remember'];

    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => $remember
    );

    //If wp_signon fails it will return an error.
    $user = wp_signon($creds, false);
    
    if (is_wp_error($user))
    {
        $_SESSION["errors"]["login-error"] = "Invalid username and password combination";
        return wp_redirect( '/coverager/login' );
    }

    return wp_redirect( '/coverager' );

}

?>
