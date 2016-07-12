<?php

function handle_form_register()
{
    session_start();

    $nonce = isset( $_POST['user_noncename'] ) ? $_POST['user_noncename'] : 'some random string here';
    if ( !wp_verify_nonce( $nonce, get_template_directory_uri( __FILE__ ) ) ) {
        return "something went wrong";
    }


    $username         = sanitize_text_field(trim($_POST['username']));
    $email            = sanitize_email(trim($_POST['email']));
    $password         = sanitize_text_field(trim($_POST['password']));
    $password_confirm = sanitize_text_field(trim($_POST['password_confirm']));

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


    $_SESSION['errors'] = $errors;
    if(count($_SESSION['errors']) > 0)
    {
        //If there are errors we will set some session value
        //so we can the user what went wrong and all also keep his old values filled in the form
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        return wp_redirect( '/coverager/register' );
    }


    $userdata = array(
        'user_login' =>  $username,
        'user_email' =>  $email,
        'user_pass'  =>  $password
    );

    wp_insert_user($userdata);

    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => false
    );

    $user = wp_signon($creds, false);
    $username = $user->get('user_login');
    $_SESSION["success"] = "Welcome $username, you have registered successfully";
    return wp_redirect( '/coverager/register' );

} //end function

// function wpdocs_custom_login() {
//     $creds = array(
//         'user_login'    => 'example',
//         'user_password' => 'plaintextpw',
//         'remember'      => true
//     );
//
//     $user = wp_signon( $creds, false );

    // On success.
    // if ( is_wp_error( $user_id ) ) {
    //     echo "Some errors : ". print_r($user_id);
    // }


    // $creds = array(
    //     'user_login'    => "fake",
    //     'user_password' => "johnny",
    //     'remember'      => false
    // );
    //
    // $user = wp_signon($creds, false);
    // if(is_wp_error( $user ))
    // {
    //     echo "Invalid username and password combination";
    // }

?>
