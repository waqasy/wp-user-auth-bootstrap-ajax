<?php

function handle_password_reset_form()
{
    return wp_redirect( wp_get_referer() );
}

?>
