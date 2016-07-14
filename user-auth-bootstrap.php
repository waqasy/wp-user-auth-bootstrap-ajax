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

function user_auth_bootstrap_activate()
{
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'user_auth_bootstrap_activate' );

function user_auth_enqueue_scripts()
{
    wp_enqueue_script( 'register-user-js', plugins_url( 'js/register.js', __FILE__ ), array( 'jquery' ), '', true );
    wp_localize_script( 'register-user-js', 'register_user_data', array( 'nonce' => wp_create_nonce( 'wp_rest' ) ) );
}

add_action( 'wp_enqueue_scripts', 'user_auth_enqueue_scripts' );

include(plugin_dir_path( __FILE__ ) . '/includes/forms/register.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/login.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/request-password-reset.php');
include(plugin_dir_path( __FILE__ ) . '/includes/forms/password-reset.php');

include(plugin_dir_path( __FILE__ ) . '/includes/process-register-form.php');
include(plugin_dir_path( __FILE__ ) . '/includes/process-login-form.php');
include(plugin_dir_path( __FILE__ ) . '/includes/process-request-password-reset-form.php');
include(plugin_dir_path( __FILE__ ) . '/includes/process-password-reset-form.php');

include(plugin_dir_path( __FILE__ ) . '/includes/api/process-register.php');


include(plugin_dir_path( __FILE__ ) . '/includes/functions.php');


add_shortcode('register-form', 'register_form');
add_shortcode('login-form', 'login_form');
add_shortcode('request-password-reset-form', 'request_password_reset_form');
add_shortcode('password-reset-form', 'password_reset_form');

add_action('admin_post_nopriv_submit-register-form', 'handle_register_form');
add_action('admin_post_nopriv_submit-login-form', 'handle_login_form');
add_action('admin_post_nopriv_submit-request-password-reset-form', 'handle_request_password_reset_form');
add_action('admin_post_nopriv_submit-password-reset-form', 'handle_password_reset_form');


// wp-json/registering-user/v1/user

function coverager_register_endpoints()
{
    register_rest_route('registering-user/v1', '/user/', array(
        'methods' => 'POST',
        'callback' => 'register_user'
    ));
}

add_action('rest_api_init', 'coverager_register_endpoints');
