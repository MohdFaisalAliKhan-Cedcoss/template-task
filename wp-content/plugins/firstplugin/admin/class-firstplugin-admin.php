<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Firstplugin
 * @subpackage Firstplugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Firstplugin
 * @subpackage Firstplugin/admin
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Firstplugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook      The plugin page slug.
	 */
	public function f_admin_enqueue_styles( $hook ) {

		wp_enqueue_style( 'mwb-f-select2-css', FIRSTPLUGIN_DIR_URL . 'admin/css/firstplugin-select2.css', array(), time(), 'all' );

		wp_enqueue_style( $this->plugin_name, FIRSTPLUGIN_DIR_URL . 'admin/css/firstplugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook      The plugin page slug.
	 */
	public function f_admin_enqueue_scripts( $hook ) {

		wp_enqueue_script( 'mwb-f-select2', FIRSTPLUGIN_DIR_URL . 'admin/js/firstplugin-select2.js', array( 'jquery' ), time(), false );

		wp_register_script( $this->plugin_name . 'admin-js', FIRSTPLUGIN_DIR_URL . 'admin/js/firstplugin-admin.js', array( 'jquery', 'mwb-f-select2' ), $this->version, false );

		wp_localize_script(
			$this->plugin_name . 'admin-js',
			'f_admin_param',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'reloadurl' => admin_url( 'admin.php?page=firstplugin_menu' ),
			)
		);

		wp_enqueue_script( $this->plugin_name . 'admin-js' );
	}

	/**
	 * Adding settings menu for firstPlugin.
	 *
	 * @since    1.0.0
	 */
	public function f_options_page() {
		global $submenu;
		if ( empty( $GLOBALS['admin_page_hooks']['mwb-plugins'] ) ) {
			add_menu_page( __( 'MakeWebBetter', 'firstplugin' ), __( 'MakeWebBetter', 'firstplugin' ), 'manage_options', 'mwb-plugins', array( $this, 'mwb_plugins_listing_page' ), FIRSTPLUGIN_DIR_URL . 'admin/images/mwb-logo.png', 15 );
			$f_menus = apply_filters( 'mwb_add_plugins_menus_array', array() );
			if ( is_array( $f_menus ) && ! empty( $f_menus ) ) {
				foreach ( $f_menus as $f_key => $f_value ) {
					add_submenu_page( 'mwb-plugins', $f_value['name'], $f_value['name'], 'manage_options', $f_value['menu_link'], array( $f_value['instance'], $f_value['function'] ) );
				}
			}
		}
	}


	/**
	 * firstPlugin f_admin_submenu_page.
	 *
	 * @since 1.0.0
	 * @param array $menus Marketplace menus.
	 */
	public function f_admin_submenu_page( $menus = array() ) {
		$menus[] = array(
			'name'            => __( 'firstPlugin', 'firstplugin' ),
			'slug'            => 'firstplugin_menu',
			'menu_link'       => 'firstplugin_menu',
			'instance'        => $this,
			'function'        => 'f_options_menu_html',
		);
		return $menus;
	}


	/**
	 * firstPlugin mwb_plugins_listing_page.
	 *
	 * @since 1.0.0
	 */
	public function mwb_plugins_listing_page() {
		$active_marketplaces = apply_filters( 'mwb_add_plugins_menus_array', array() );
		if ( is_array( $active_marketplaces ) && ! empty( $active_marketplaces ) ) {
			require FIRSTPLUGIN_DIR_PATH . 'admin/partials/welcome.php';
		}
	}

	/**
	 * firstPlugin admin menu page.
	 *
	 * @since    1.0.0
	 */
	public function f_options_menu_html() {

		include_once FIRSTPLUGIN_DIR_PATH . 'admin/partials/firstplugin-admin-display.php';
	}

	/**
	 * firstPlugin admin menu page.
	 *
	 * @since    1.0.0
	 * @param array $f_settings_general Settings fields.
	 */
	public function f_admin_general_settings_page( $f_settings_general ) {
		$f_settings_general = array(
			array(
				'title' => __( 'Text Field Demo', 'firstplugin' ),
				'type'  => 'text',
				'description'  => __( 'This is text field demo follow same structure for further use.', 'firstplugin' ),
				'id'    => 'f_text_demo',
				'value' => '',
				'class' => 'f-text-class',
				'placeholder' => __( 'Text Demo', 'firstplugin' ),
			),
			array(
				'title' => __( 'Number Field Demo', 'firstplugin' ),
				'type'  => 'number',
				'description'  => __( 'This is number field demo follow same structure for further use.', 'firstplugin' ),
				'id'    => 'f_number_demo',
				'value' => '',
				'class' => 'f-number-class',
				'placeholder' => '',
			),
			array(
				'title' => __( 'Password Field Demo', 'firstplugin' ),
				'type'  => 'password',
				'description'  => __( 'This is password field demo follow same structure for further use.', 'firstplugin' ),
				'id'    => 'f_password_demo',
				'value' => '',
				'class' => 'f-password-class',
				'placeholder' => '',
			),
			array(
				'title' => __( 'Textarea Field Demo', 'firstplugin' ),
				'type'  => 'textarea',
				'description'  => __( 'This is textarea field demo follow same structure for further use.', 'firstplugin' ),
				'id'    => 'f_textarea_demo',
				'value' => '',
				'class' => 'f-textarea-class',
				'rows' => '5',
				'cols' => '10',
				'placeholder' => __( 'Textarea Demo', 'firstplugin' ),
			),
			array(
				'title' => __( 'Select Field Demo', 'firstplugin' ),
				'type'  => 'select',
				'description'  => __( 'This is select field demo follow same structure for further use.', 'firstplugin' ),
				'id'    => 'f_select_demo',
				'value' => '',
				'class' => 'f-select-class',
				'placeholder' => __( 'Select Demo', 'firstplugin' ),
				'options' => array(
					'INR' => __( 'Rs.', 'firstplugin' ),
					'USD' => __( '$', 'firstplugin' ),
				),
			),
			array(
				'title' => __( 'Multiselect Field Demo', 'firstplugin' ),
				'type'  => 'multiselect',
				'description'  => __( 'This is multiselect field demo follow same structure for further use.', 'firstplugin' ),
				'id'    => 'f_multiselect_demo',
				'value' => '',
				'class' => 'f-multiselect-class mwb-defaut-multiselect',
				'placeholder' => __( 'Multiselect Demo', 'firstplugin' ),
				'options' => array(
					'INR' => __( 'Rs.', 'firstplugin' ),
					'USD' => __( '$', 'firstplugin' ),
				),
			),
			array(
				'title' => __( 'Checkbox Field Demo', 'firstplugin' ),
				'type'  => 'checkbox',
				'description'  => __( 'This is checkbox field demo follow same structure for further use.', 'firstplugin' ),
				'id'    => 'f_checkbox_demo',
				'value' => '',
				'class' => 'f-checkbox-class',
				'placeholder' => __( 'Checkbox Demo', 'firstplugin' ),
			),

			array(
				'title' => __( 'Radio Field Demo', 'firstplugin' ),
				'type'  => 'radio',
				'description'  => __( 'This is radio field demo follow same structure for further use.', 'firstplugin' ),
				'id'    => 'f_radio_demo',
				'value' => '',
				'class' => 'f-radio-class',
				'placeholder' => __( 'Radio Demo', 'firstplugin' ),
				'options' => array(
					'yes' => __( 'YES', 'firstplugin' ),
					'no' => __( 'NO', 'firstplugin' ),
				),
			),

			array(
				'type'  => 'button',
				'id'    => 'f_button_demo',
				'button_text' => __( 'Button Demo', 'firstplugin' ),
				'class' => 'f-button-class',
			),
		);
		return $f_settings_general;
	}
}
