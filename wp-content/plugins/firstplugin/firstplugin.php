<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://makewebbetter.com/
 * @since             1.0.0
 * @package           Firstplugin
 *
 * @wordpress-plugin
 * Plugin Name:       firstPlugin
 * Plugin URI:        https://makewebbetter.com/product/firstplugin/
 * Description:       This is my first plugin.
 * Version:           1.0.0
 * Author:            makewebbetter
 * Author URI:        https://makewebbetter.com/
 * Text Domain:       firstplugin
 * Domain Path:       /languages
 *
 * Requires at least: 4.6
 * Tested up to:      4.9.5
 *
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Define plugin constants.
 *
 * @since             1.0.0
 */
function define_firstplugin_constants() {

	firstplugin_constants( 'FIRSTPLUGIN_VERSION', '1.0.0' );
	firstplugin_constants( 'FIRSTPLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
	firstplugin_constants( 'FIRSTPLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
	firstplugin_constants( 'FIRSTPLUGIN_SERVER_URL', 'https://makewebbetter.com' );
	firstplugin_constants( 'FIRSTPLUGIN_ITEM_REFERENCE', 'firstPlugin' );
}


/**
 * Callable function for defining plugin constants.
 *
 * @param   String $key    Key for contant.
 * @param   String $value   value for contant.
 * @since             1.0.0
 */
function firstplugin_constants( $key, $value ) {

	if ( ! defined( $key ) ) {

		define( $key, $value );
	}
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-firstplugin-activator.php
 */
function activate_firstplugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-firstplugin-activator.php';
	Firstplugin_Activator::firstplugin_activate();
	$mwb_f_active_plugin = get_option( 'mwb_all_plugins_active', false );
	if ( is_array( $mwb_f_active_plugin ) && ! empty( $mwb_f_active_plugin ) ) {
		$mwb_f_active_plugin['firstplugin'] = array(
			'plugin_name' => __( 'firstPlugin', 'firstplugin' ),
			'active' => '1',
		);
	} else {
		$mwb_f_active_plugin = array();
		$mwb_f_active_plugin['firstplugin'] = array(
			'plugin_name' => __( 'firstPlugin', 'firstplugin' ),
			'active' => '1',
		);
	}
	update_option( 'mwb_all_plugins_active', $mwb_f_active_plugin );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-firstplugin-deactivator.php
 */
function deactivate_firstplugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-firstplugin-deactivator.php';
	Firstplugin_Deactivator::firstplugin_deactivate();
	$mwb_f_deactive_plugin = get_option( 'mwb_all_plugins_active', false );
	if ( is_array( $mwb_f_deactive_plugin ) && ! empty( $mwb_f_deactive_plugin ) ) {
		foreach ( $mwb_f_deactive_plugin as $mwb_f_deactive_key => $mwb_f_deactive ) {
			if ( 'firstplugin' === $mwb_f_deactive_key ) {
				$mwb_f_deactive_plugin[ $mwb_f_deactive_key ]['active'] = '0';
			}
		}
	}
	update_option( 'mwb_all_plugins_active', $mwb_f_deactive_plugin );
}

register_activation_hook( __FILE__, 'activate_firstplugin' );
register_deactivation_hook( __FILE__, 'deactivate_firstplugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-firstplugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_firstplugin() {
	define_firstplugin_constants();

	$f_plugin_standard = new Firstplugin();
	$f_plugin_standard->f_run();
	$GLOBALS['f_mwb_f_obj'] = $f_plugin_standard;

}
run_firstplugin();

// Add rest api endpoint for plugin.
add_action( 'rest_api_init', 'f_add_default_endpoint' );

/**
 * Callback function for endpoints.
 *
 * @since    1.0.0
 */
function f_add_default_endpoint() {
	register_rest_route(
		'f-route',
		'/f-dummy-data/',
		array(
			'methods'  => 'POST',
			'callback' => 'mwb_f_default_callback',
		)
	);
}

/**
 * Begins execution of api endpoint.
 *
 * @param   Array $request    All information related with the api request containing in this array.
 * @return  Array   $mwb_f_response   return rest response to server from where the endpoint hits.
 * @since    1.0.0
 */
function mwb_f_default_callback( $request ) {
	require_once FIRSTPLUGIN_DIR_PATH . 'includes/class-firstplugin-api-process.php';
	$mwb_f_api_obj = new Firstplugin_Api_Process();
	$mwb_f_resultsdata = $mwb_f_api_obj->mwb_f_default_process( $request );
	if ( is_array( $mwb_f_resultsdata ) && isset( $mwb_f_resultsdata['status'] ) && 200 == $mwb_f_resultsdata['status'] ) {
		unset( $mwb_f_resultsdata['status'] );
		$mwb_f_response = new WP_REST_Response( $mwb_f_resultsdata, 200 );
	} else {
		$mwb_f_response = new WP_Error( $mwb_f_resultsdata );
	}
	return $mwb_f_response;
}


// Add settings link on plugin page.
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'firstplugin_settings_link' );

/**
 * Settings link.
 *
 * @since    1.0.0
 * @param   Array $links    Settings link array.
 */
function firstplugin_settings_link( $links ) {

	$my_link = array(
		'<a href="' . admin_url( 'admin.php?page=firstplugin_menu' ) . '">' . __( 'Settings', 'firstplugin' ) . '</a>',
	);
	return array_merge( $my_link, $links );
}
