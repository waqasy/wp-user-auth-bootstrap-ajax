<?php
//Takes care of sending the reset password link to the user's email
function uab_send_reset_link(WP_REST_Request $request)
{
    $email = trim( $request['email'] );

    if ( empty( $email ) || !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
    {
        $error = "Valid Email is required.";
        return new WP_Error( 'reset_link_error', $error );
    }

    $user_data = get_user_by( 'email', $email );
    if( empty( $user_data ) )
    {
        $error = "There is no user registered with that email address.";
        return new WP_Error( 'reset_link_error', $error );
    }

    // Redefining user_login ensures we return the right case in the email.
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $key = get_password_reset_key( $user_data );

    if ( is_wp_error( $key ) ) {
        $error = "Something went wrong, please try again or contact support.";
        return new WP_Error( 'server_error', $error );
    }

    $message = __('Someone has requested a password reset for the following account:') . "\r\n\r\n";
    $message .= network_home_url( '/' ) . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= '<' . network_site_url("resetpassword?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf( __('[%s] Password Reset'), $blogname );

    /**
     * Filter the subject of the password reset email.
     * @param string  $title      Default email title.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     */
    $title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

    /**
     * Filter the message body of the password reset mail.
     * @param string  $message    Default mail message.
     * @param string  $key        The activation key.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     */
    $message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

    if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
    {
        $error = "The email could not be sent, please try again or contact support.";
        return new WP_Error( 'server_error', $error );
    }

    return "Reset link has been sent to your email";
}




?>
