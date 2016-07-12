<?php
//SHows old input incase of form failed to submit
function old($field)
{
    if( isset($_SESSION[$field]) )
    {
        echo $_SESSION[$field];
    }
}
//Returns true is there is an error for the passed field.
function errorsHas($key)
{
    if( is_array($_SESSION['errors']) && array_key_exists($key, $_SESSION['errors']) )
    {
        return true;
    }
}
