<?php
global $eddmobile_options;

$eddmobile_options = get_option('eddmobile_plugin_options');


// create edd mobile slug
function edd_mobile_create_slug() {
  global $wp, $wp_query;

  $page_slug = 'edd-mobile';

  //check if user is requesting our slug
  if( strtolower( $wp->request ) == $page_slug  ){

  	include( EDD_MOBILE_PLUGIN_DIR . 'themes/index.php' );
    die();

  }

}
add_filter('template_redirect','edd_mobile_create_slug');


// create our edd mobile head hook
function edd_mobile_head() {
	do_action('edd_mobile_head');
}


// add custom toolbar color
function eddmobile_custom_styles() {
	global $eddmobile_options;

	if ( !empty( $eddmobile_options['toolbar-color'] ) ) {

		$color = $eddmobile_options['toolbar-color'];

		echo "<style type='text/css'>";

			echo ".toolbar { background-color: $color !important; }";

		echo '</style>';
	}

}
add_action( 'edd_mobile_head', 'eddmobile_custom_styles' );


// echoes key to js
function edd_mobile_key() {
	global $edd_options;

	$user_id = get_current_user_id();

	$user = get_userdata( $user_id );

	if ( !empty( $user->edd_user_public_key ) )

		return $user->edd_user_public_key;

}


// echoes token to js
function edd_mobile_token() {
	global $edd_options;

	$user_id = get_current_user_id();

	$user = get_userdata( $user_id );

	if ( !empty( $user->edd_user_public_key ) )

		return hash( 'md5', $user->edd_user_secret_key . $user->edd_user_public_key );

}


// require edd plugin
function eddmobile_admin_notice() {

 	If ( !is_plugin_active('easy-digital-downloads/easy-digital-downloads.php' ) ) {
    ?>
    <div class="updated">
        <p><?php _e( 'EDD Mobile requires the <a href="https://easydigitaldownloads.com">Easy Digital Downloads</a> plugin to be installed and activated!', 'edd-mobile' ); ?></p>
    </div>
    <?php
     }
}
add_action( 'admin_notices', 'eddmobile_admin_notice' );


function edd_mobile_login_user_in( $user_id, $user_login, $user_pass ) {
	$user = get_userdata( $user_id );
	if( ! $user )
		return;
	wp_set_auth_cookie( $user_id );
	wp_set_current_user( $user_id, $user_login );
	do_action( 'wp_login', $user_login, $user );
}


/**
 *Process the login form
 *
 * @access      public
 * @since       1.0
 */
function edd_mobile_process_login_form() {


		if( isset( $_POST['edd_mobile_login_nonce'] ) && wp_verify_nonce( $_POST['edd_mobile_login_nonce'], 'edd_mobile_login_nonce' ) ) {

			// this returns the user ID and other info from the user name
			$user = get_user_by( 'login', $_POST['edd_mobile_user_login'] );
			$pswd = wp_check_password( $_POST['edd_mobile_user_pass'], $user->user_pass, $user->ID );

			if( $user && $pswd ) {

				edd_mobile_login_user_in( $user->ID, $_POST['edd_mobile_user_login'], $_POST['edd_mobile_user_pass'] );


			} else {

				echo 'failed';
			}
		}


		die();

}
add_action('wp_ajax_edd_mobile_login_action', 'edd_mobile_process_login_form');
add_action('wp_ajax_nopriv_edd_mobile_login_action', 'edd_mobile_process_login_form');