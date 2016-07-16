<?php
//resets user's password on success
function uab_reset_password(WP_REST_Request $request)
{
    $key              = $request['key'];
    $login            = $request['login'];
    $email            = sanitize_email( trim( $request['email'] ) );
    $password         = trim( $request['password'] );
    $password_confirm = trim( $request['password_confirm'] );

    $user = check_password_reset_key($key, $login);
    //Incase user needs to request another reset-link
    $reset_link_url = network_site_url( '/lostpassword' );
    if( is_wp_error( $user ) )
    {
        $error = "Invalid reset link, you may request another one <a href='$reset_link_url'>here</a>";
        return new WP_Error( 'invalid_reset_link', $error );
    }
    $user_email = $user->user_email;

    $errors = [];
    //order matters here. If email is empty or not valid in terms of syntax then it will show the proper error for that instead.
    if( $email !== $user->user_email )
    {
        $errors['email'] = "Entered email don't match to the reset link credentials, you may request another one <a href='$reset_link_url'>here</a>.";
    }
    if ( empty( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) )
    {
        $errors['email'] = "Valid Email is required";
    }
    if( $password !== $password_confirm )
    {
        $errors["password_confirm"] = "Password confirmation don't match";
    }
    if( strlen( $password ) < 6 )
    {
        $errors["password"] = "Password must be at least 6 characters";
    }

    if( count( $errors ) > 0 )
    {
        return new WP_Error( 'reset-password-error', $errors );
    }

    wp_set_password( $password, $user->id );

    $login_url = $reset_link_url = network_site_url( '/login' );
    return "Password changed successfully. <a href='$login_url'>Login here</a>.";

}



?>
