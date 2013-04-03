<?php
global $eddmobile_options;

$eddmobile_options = get_option('eddmobile_plugin_options');

function eddmobile_plugin_menu() {
	add_options_page( __( 'EDD Mobile', 'edd-mobile' ), __( 'EDD Mobile', 'edd-mobile' ), 'manage_options', 'edd-mobile-settings', 'eddmobile_plugin_options_page' );

}
add_action('admin_menu', 'eddmobile_plugin_menu');
//add_action('network_admin_menu', 'bp_mobile_plugin_menu');


function eddmobilemobile_plugin_admin_init() {
	register_setting( 'eddmobile_plugin_options', 'eddmobile_plugin_options', 'eddmobile_plugin_options_validate' );
	//add_settings_section('general_section', 'General Settings', 'eddmobile_section_general', __FILE__);
	add_settings_section( 'style_section', __( 'Style Settings', 'edd-mobile' ), 'eddmobile_section_style', 'edd-mobile-settings' );

	add_settings_field( 'toolbar-color', __( 'Toolbar Color', 'edd-mobile' ), 'eddmobile_setting_toolbar_color', 'edd-mobile-settings', 'style_section' );

}
add_action('admin_init', 'eddmobilemobile_plugin_admin_init');


function eddmobile_plugin_options_page() {
?>

	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2><?php _e( 'EDD Mobile', 'edd-mobile' ); ?></h2>
		<form action="options.php" method="post">
		<?php settings_fields( 'eddmobile_plugin_options' ); ?>
		<?php do_settings_sections( 'edd-mobile-settings' ); ?>

		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'edd-mobile' ); ?>" />
		</p>
		</form>
	</div>

<?php
}

function eddmobile_section_general() {

}

function eddmobile_section_style() {

}


function eddmobile_plugin_options_validate($input) {

	return $input; // return validated input

}

/*** style settings functions ***/
function eddmobile_setting_toolbar_color() {
	global $eddmobile_options;

	$value = !empty( $eddmobile_options['toolbar-color'] ) ? $eddmobile_options['toolbar-color'] : '' ;

	echo "<input id='toolbar-color' name='eddmobile_plugin_options[toolbar-color]' size='20' type='text' value='$value' />";
}


function eddmobile_admin_enqueue_scripts() {

	wp_enqueue_script( 'wp-color-picker' );
	// load the minified version of custom script
	wp_enqueue_script( 'eddmobile-custom', plugins_url( 'color-pick.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), '1.1', true );
	wp_enqueue_style( 'wp-color-picker' );
}
if ( isset( $_GET['page'] ) && ( $_GET['page'] == 'edd-mobile-settings' ) ) {
	add_action( 'admin_enqueue_scripts', 'eddmobile_admin_enqueue_scripts' );
}

