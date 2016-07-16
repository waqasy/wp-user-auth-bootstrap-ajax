<?php

function uab_update_user(WP_REST_Request $request)
{
    global $wpdb;

    $user_id  = (int) $request['user_id'];
    $username = sanitize_user( trim( $request['username'] ), true );
    $email    = sanitize_email( trim( $request['email'] ) );

    $errors = [];

    $user = get_user_by( 'id', $user_id );
    //This should not be true since we are the one's passing the user's ID, but just incase we will check for problems.
    if( empty( $user ) )
    {
        $error = "Something went wrong. System can't identify you. Please try again or contact support.";
        return new WP_Error( 'server_error', $error );
    }

    //Makes sure username would be unique, but won't cause an error incase he didn't change his current username
    if( username_exists( $username ) && $username !== $user->user_login )
    {
        $errors["username"] = "Username exists already";
    }
    if( strlen( $username ) < 3 )
    {
        $errors["username"] = "Username must be at least 3 characters";
    }
    //Makes sure email would be unique, but won't cause an error incase he didn't change his current email
    if( email_exists( $email ) && $email !== $user->user_email )
    {
        $errors["email"] = "Email exists already";
    }
    if( empty( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) )
    {
        $errors["email"] = "Valid Email is required";
    }


    if( count( $errors ) > 0 )
    {
        return new WP_Error( 'update_errors', $errors, array( 'status' => 422 ) );
    }

    //We want to keep the user_nicename format as WordPress does.
    $user_nicename = mb_substr( $username, 0, 50 );
    $user_nicename = sanitize_title( $user_nicename );

    $user_data = array(
        'user_login' =>  $username,
        'user_email' =>  $email,
        'user_nicename' => $user_nicename
    );

    //IF we get an error here that means we have a problem in our app.
    if( false === $wpdb->update( $wpdb->users, $user_data, array( 'ID' => $user_id ) ) )
    {
        $error = "Sorry, update failed due to an unxpected error. Please contact support if it continues";
        return new WP_Error( 'server_error', $error );
    }

    //If user has changes then WordPress would logout the user so in that case we will send an AJAX request to log him in.
    if( $username !== $user->user_login )
    {
        return ['success' => 'Profile has been updated successfully', 'username_changed' => true];
    }

    return ['success' => 'Profile has been updated successfully', 'username_changed' => false];
}


?>
