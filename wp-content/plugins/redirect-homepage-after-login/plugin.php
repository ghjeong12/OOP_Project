<?php 
/*
Plugin Name: Redirect Homepage after Login
Plugin URI: http://tcoderbd.com
Description: This plugin will enable to redirect user homepage after login.
Author: Md Touhidul Sadeek
Author URI: http://tcoderbd.com
Version: 1.0
*/


/*  Copyright 2016 tCoderBD (email: info@tcoderbd.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;


function tcbd_redirect_after_login() {
	global $redirect_to;
	if (!isset($_GET['redirect_to'])) {
		$redirect_to = get_option('siteurl');
	}
}
add_action('login_form', 'tcbd_redirect_after_login');

function loginpage_custom_link() {
    return get_option('siteurl');
}
add_filter('login_headerurl','loginpage_custom_link');