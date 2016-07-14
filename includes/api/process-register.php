<?php


function register_user(WP_REST_Request $request)
{


    //return $request->get_params();

    $username         = sanitize_text_field( trim( $request['username'] ) );
    $email            = sanitize_email( trim( $request['email'] ) );
    $password         = trim( $request['password'] );
    $password_confirm = trim( $request['password_confirm'] );

    $errors = [];

    if(username_exists($username))
    {
        $errors["username"] = "Username exists already";
    }
    if(strlen($username) < 3)
    {
        $errors["username"] = "Username must be at least 3 characters";
    }
    if(email_exists($email))
    {
        $errors["email"] = "Email exists already";
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors["email"] = "Valid Email is required";
    }
    if($password !== $password_confirm)
    {
        $errors["password_confirm"] = "Password confirmation don't match";
    }
    if(strlen($password) < 6)
    {
        $errors["password"] = "Password must be at least 6 characters";
    }

    if(count($errors) > 0)
    {
        return new WP_Error( 'registration_errors', $errors );
    }

    $userdata = array(
        'user_login' =>  $username,
        'user_email' =>  $email,
        'user_pass'  =>  $password
    );

    $user_id = wp_insert_user($userdata);
    //IF we get an error here that means we have a problem in our app.
    if( is_wp_error( $user_id ) )
    {
        $error = "Sorry, registration failed due to an unxpected error. We are working on fixing it as soon as possible.";
        return new WP_Error( 'server_error', $error );
    }

    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => false
    );
    $user = wp_signon($creds, false);

    $username = $user->get('user_login');

    return "Welcome $username, you have registered successfully";


}
