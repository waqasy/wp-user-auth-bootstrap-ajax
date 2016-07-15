<?php
session_start();
//SHows old input incase of form failed to submit
function old($field)
{
    if( isset($_SESSION[$field]) )
    {
        echo $_SESSION[$field];
    }
}
//Returns true if there is an error for the passed field.
function errors_has($key)
{
    if( is_array($_SESSION['errors']) && array_key_exists($key, $_SESSION['errors']) )
    {
        return true;
    }
}

function success_has($key)
{
    if( isset($_SESSION[$key]) )
    {
        return true;
    }
}

function check_reset_link($key, $login)
{
    $user = check_password_reset_key($key, $login);
    //echo $user->user_email;
    if(is_wp_error($user))
    {
        return;
        //echo "Reset link is invalid, you may request another one <a href='/coverager/lostpassword'>here</a>.";
        //return;
        // $_SESSION['errors']['password_reset'] = "Reset link is invalid, you may request another one here.";
        // return wp_redirect( '/coverager/lostpassword' );
    }
}

// <?php check_reset_link($_REQUEST['key'], $_REQUEST['login']);
// <?php session_start(); 
