<?php

function uab_login_user(WP_REST_Request $request)
{
    $username = sanitize_text_field( trim( $request['username'] ) );
    $password = trim( $request['password'] );
    $remember = $request['remember'];

    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => $remember
    );

    //If wp_signon fails it will return an error.
    $user = wp_signon( $creds, false );

    if ( is_wp_error( $user ) )
    {
        $error = "Invalid username and password combination";
        return new WP_Error( 'login_error', $error );
    }

    return "Welcome back $username!";

}
