<?php
/*
Plugin Name: User Auth Bootstrap
Description: Gives you boostrap style register and login forms.
Version: 1.0
Author: Isaac Ben Hutta
License: GPLv2
*/

/* Copyright 2016 Isaac Ben Hutta
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License */

function uab_bootstrap_activate()
{
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'uab_bootstrap_activate' );

function uab_enqueue_scripts()
{
    wp_enqueue_script(
        'uab-js',
        plugins_url( 'js/uab.js', __FILE__ ),
        array( 'jquery' ),
        '', //You can specify a verision of you want to
        true // true for loading in footer.
    );

    wp_localize_script(
        'uab-js',
        'uab_data',
        array(
            'nonce' => wp_create_nonce( 'wp_rest' ),
            'site_url' => network_site_url( '/' ),
            'user_id' => get_current_user_id(),
            //For reset password form
            'key' => $_REQUEST['key'] ,
            'login' => $_REQUEST['login']
        )
    );
}

add_action( 'wp_enqueue_scripts', 'uab_enqueue_scripts' );

include(plugin_dir_path( __FILE__ ) . '/includes/forms/register.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/login.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/send-reset-link.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/reset-password.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/update-user.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/update-password.php');

include(plugin_dir_path( __FILE__ ) . '/includes/api/process-register.php');
include(plugin_dir_path( __FILE__ ) . '/includes/api/process-login.php');
include(plugin_dir_path( __FILE__ ) . '/includes/api/process-send-reset-link.php');
include(plugin_dir_path( __FILE__ ) . '/includes/api/process-reset-password.php');
include(plugin_dir_path( __FILE__ ) . '/includes/api/process-update-user.php');
include(plugin_dir_path( __FILE__ ) . '/includes/api/process-update-password.php');



add_shortcode('register-form', 'uab_register_form');
add_shortcode('login-form', 'uab_login_form');
add_shortcode('send-reset-link-form', 'uab_send_reset_link_form');
add_shortcode('password-reset-form', 'uab_password_reset_form');
add_shortcode('update-user-form', 'uab_update_user_form');
add_shortcode('update-password-form', 'uab_update_password_form');



function coverager_register_endpoints()
{
    register_rest_route('registering-user/v1', '/user/', array(
        'methods' => 'POST',
        'callback' => 'uab_register_user'
    ));

    register_rest_route('login-user/v1', '/user/', array(
        'methods' => 'POST',
        'callback' => 'uab_login_user'
    ));

    register_rest_route('reset-link/v1', '/user/', array(
        'methods' => 'POST',
        'callback' => 'uab_send_reset_link'
    ));

    register_rest_route('reset-password/v1', '/user/', array(
        'methods' => 'POST',
        'callback' => 'uab_reset_password'
    ));

    register_rest_route('update-user/v1', '/user/', array(
        'methods' => 'POST',
        'callback' => 'uab_update_user'
    ));

    register_rest_route('update-password/v1', '/user/', array(
        'methods' => 'POST',
        'callback' => 'uab_update_password'
    ));
}

add_action('rest_api_init', 'coverager_register_endpoints');
