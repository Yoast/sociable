<?php
/*
Plugin Name: Sociable by Yoast
Plugin URI:
Description:
Author: Team Yoast
Version: 5.0.0
Requires at least:
Author URI: https://yoast.com/
License: GPL v3
Text Domain:
Domain Path:

Sociable for WordPress
Copyright (C) 2008-2014, Joost de Valk - joost@yoast.com


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

define( 'SCWP_VERSION', '5.0.0' );

define( 'SCWP_FILE', __FILE__ );

define( 'SCWP_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * TODO: Create autoloader for classes to reduce double code
 */
if ( ! class_exists( 'Sociable_Admin' ) ) {
	require_once 'includes/class-options.php';
	require_once 'includes/class-sociable.php';
	require_once 'includes/class-sociable-social-button.php';
	require_once 'includes/class-sociable-pinterest-button.php';
	require_once 'includes/class-sociable-facebook-button.php';
	require_once 'includes/class-sociable-email-button.php';
	require_once 'includes/class-sociable-linkedin-button.php';
	require_once 'includes/class-sociable-googleplus-button.php';
	require_once 'includes/class-sociable-twitter-button.php';
	require_once 'includes/class-sociable-tumblr-button.php';
}

if (! class_exists( 'Yoast_Sociable' ) ) {
	require_once 'includes/class-sociable-social-button.php';
	require_once 'includes/class-sociable-pinterest-button.php';
	require_once 'includes/class-sociable-facebook-button.php';
	require_once 'includes/class-sociable-email-button.php';
	require_once 'includes/class-sociable-linkedin-button.php';
	require_once 'includes/class-sociable-googleplus-button.php';
	require_once 'includes/class-sociable-twitter-button.php';
	require_once 'includes/class-sociable-tumblr-button.php';
}

// Only require the needed classes
if ( is_admin() ) {
	require_once 'admin/class-sociable-admin.php';
}
else {
	require_once 'frontend/class-sociable-frontend.php';
}