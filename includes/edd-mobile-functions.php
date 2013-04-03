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