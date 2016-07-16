<?php

function uab_update_password(WP_REST_Request $request)
{
    $user_id          = (int) $request['user_id'];
    $current_password = trim( $request['current_password'] );
    $new_password     = trim( $request['new_password'] );
    $password_confirm = trim( $request['password_confirm'] );

    $errors = [];

    $user = get_user_by( 'id', $user_id );

    //This should not be true since we are the one's passing the user's ID, but just incase we will check for problems.
    if( empty( $user ) )
    {
        $error = "Something went wrong. System can't identify you. Please try again or contact support.";
        return new WP_Error( 'server_error', $error );
    }
    //Return error if current don't match user's password
    if ( ! wp_check_password( $current_password, $user->user_pass, $user_id ) )
    {
        $reset_link_url = network_site_url( '/lostpassword' );
        $errors['current_password'] = "Invalid passowrd. <a href='$reset_link_url'>Forgot password?</a>";
        return new WP_Error( 'update_errors', $errors, array( 'status' => 422 ) );
    }
    if( $new_password !== $password_confirm )
    {
        $errors["password_confirm"] = "Password confirmation don't match";
    }
    if( strlen( $new_password ) < 6 )
    {
        $errors["new_password"] = "Password must be at least 6 characters";
    }

    if( count( $errors ) > 0 )
    {
        return new WP_Error( 'update-password-errors', $errors, array( 'status' => 422 ) );
    }

    wp_set_password( $new_password, $user_id );
    return "Password has been updated successfully";
}


?>
