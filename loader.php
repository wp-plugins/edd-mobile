<?php
/*
Plugin Name: EDD Mobile
Plugin URI: http://taptappress.com
Description: A mobile app for Easy Digital Downloads
Author: modemlooper
Author URI: http://taptappress.com
Version: 1.0.2
Text Domain: edd-mobile
Domain Path: /languages/

edd-mobile is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

edd-mobile is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

*/

if ( !defined( 'EDD_MOBILE_PLUGIN_DIR' ) )
	define( 'EDD_MOBILE_PLUGIN_DIR', trailingslashit( WP_PLUGIN_DIR . '/edd-mobile' ) );

if ( !defined( 'EDD_MOBILE_PLUGIN_URL' ) ) {
	$plugin_url = plugin_dir_url( __FILE__ );

	// If we're using https, update the protocol.
	if ( is_ssl() )
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );

	define( 'EDD_MOBILE_PLUGIN_URL', $plugin_url );
}

add_action( 'init', 'edd_mobile_load_translations', 1 );
/**
 * Load translations for this plugin
 */
function edd_mobile_load_translations() {

	load_plugin_textdomain( 'edd-mobile', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}

require( EDD_MOBILE_PLUGIN_DIR . '/includes/edd-mobile-functions.php'  );
require( EDD_MOBILE_PLUGIN_DIR . '/includes/edd-mobile-admin.php'  );