<?php

function uab_reset_password(WP_REST_Request $request)
{
    $key              = $request['key'];
    $login            = $request['login'];
    $email            = sanitize_email( trim( $request['email'] ) );
    $password         = trim( $request['password'] );
    $password_confirm = trim( $request['password_confirm'] );

    $user = check_password_reset_key($key, $login);

    if( is_wp_error( $user ) )
    {
        $error = "Invalid reset link";
        return new WP_Error( 'invalid_reset_link', $error );
    }
    $user_email = $user->user_email;

    $errors = [];
    //order matters here. If email is empty or not valid in terms of syntax then it will show the proper error for that instead.
    if( !($email === $user->user_email) )
    {
        $errors['email'] = "Entered email don't match to the reset link credentials, you may request another one <a href='/coverager/lostpassword'>here</a>.";
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = "Valid Email is required";
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
        return new WP_Error( 'reset-password-error', $errors );
    }

    wp_set_password( $password, $user->id );

    return "Password changed successfully. <a href='/coverager/login'>Login here</a>.";

}



?>
