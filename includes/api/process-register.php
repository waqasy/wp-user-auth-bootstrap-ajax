<?php


function register_user(WP_REST_Request $request)
{
    $error = [];
    return new WP_Error( 'registration_errors', $error );
    return $request->get_params();

    $username         = sanitize_text_field( trim( $request['username'] ) );
    $email            = sanitize_email( trim( $request['email'] ) );
    $password         = trim( $request['password'] );
    $password_confirm = trim( $request['password_confirm'] );













}
