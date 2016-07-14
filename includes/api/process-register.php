<?php


function register_user(WP_REST_Request $request)
{
    $error = [ "email" => "Valid email is required", "password" => "Password must be at least 6 characters" ];
    return new WP_Error( 'registration_errors', $error );
    return $request->get_params();
    $username = $request['username'];
    return $username;
    //print_r($request);
}
