<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Firstplugin
 * @subpackage Firstplugin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Firstplugin
 * @subpackage Firstplugin/includes
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Firstplugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Firstplugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'FIRSTPLUGIN_VERSION' ) ) {

			$this->version = FIRSTPLUGIN_VERSION;
		} else {

			$this->version = '1.0.0';
		}

		$this->plugin_name = 'firstplugin';

		$this->firstplugin_dependencies();
		$this->firstplugin_locale();
		$this->firstplugin_admin_hooks();
		$this->firstplugin_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Firstplugin_Loader. Orchestrates the hooks of the plugin.
	 * - Firstplugin_i18n. Defines internationalization functionality.
	 * - Firstplugin_Admin. Defines all hooks for the admin area.
	 * - Firstplugin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function firstplugin_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-firstplugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-firstplugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-firstplugin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-firstplugin-public.php';

		$this->loader = new Firstplugin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Firstplugin_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function firstplugin_locale() {

		$plugin_i18n = new Firstplugin_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function firstplugin_admin_hooks() {

		$f_plugin_admin = new Firstplugin_Admin( $this->f_get_plugin_name(), $this->f_get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $f_plugin_admin, 'f_admin_enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $f_plugin_admin, 'f_admin_enqueue_scripts' );

		// Add settings menu for firstPlugin.
		$this->loader->add_action( 'admin_menu', $f_plugin_admin, 'f_options_page' );

		// All admin actions and filters after License Validation goes here.
		$this->loader->add_filter( 'mwb_add_plugins_menus_array', $f_plugin_admin, 'f_admin_submenu_page', 15 );
		$this->loader->add_filter( 'f_general_settings_array', $f_plugin_admin, 'f_admin_general_settings_page', 10 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function firstplugin_public_hooks() {

		$f_plugin_public = new Firstplugin_Public( $this->f_get_plugin_name(), $this->f_get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $f_plugin_public, 'f_public_enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $f_plugin_public, 'f_public_enqueue_scripts' );

	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function f_run() {
		$this->loader->f_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function f_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Firstplugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function f_get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function f_get_version() {
		return $this->version;
	}

	/**
	 * Predefined default mwb_f_plug tabs.
	 *
	 * @return  Array       An key=>value pair of firstPlugin tabs.
	 */
	public function mwb_f_plug_default_tabs() {

		$f_default_tabs = array();

		$f_default_tabs['firstplugin-general'] = array(
			'title'       => esc_html__( 'General Setting', 'firstplugin' ),
			'name'        => 'firstplugin-general',
		);
		$f_default_tabs = apply_filters( 'mwb_f_plugin_standard_admin_settings_tabs', $f_default_tabs );

		$f_default_tabs['firstplugin-system-status'] = array(
			'title'       => esc_html__( 'System Status', 'firstplugin' ),
			'name'        => 'firstplugin-system-status',
		);

		return $f_default_tabs;
	}

	/**
	 * Locate and load appropriate tempate.
	 *
	 * @since   1.0.0
	 * @param string $path path file for inclusion.
	 * @param array  $params parameters to pass to the file for access.
	 */
	public function mwb_f_plug_load_template( $path, $params = array() ) {

		$f_file_path = FIRSTPLUGIN_DIR_PATH . $path;

		if ( file_exists( $f_file_path ) ) {

			include $f_file_path;
		} else {

			/* translators: %s: file path */
			$f_notice = sprintf( esc_html__( 'Unable to locate file at location "%s". Some features may not work properly in this plugin. Please contact us!', 'firstplugin' ), $f_file_path );
			$this->mwb_f_plug_admin_notice( $f_notice, 'error' );
		}
	}

	/**
	 * Show admin notices.
	 *
	 * @param  string $f_message    Message to display.
	 * @param  string $type       notice type, accepted values - error/update/update-nag.
	 * @since  1.0.0
	 */
	public static function mwb_f_plug_admin_notice( $f_message, $type = 'error' ) {

		$f_classes = 'notice ';

		switch ( $type ) {

			case 'update':
				$f_classes .= 'updated is-dismissible';
				break;

			case 'update-nag':
				$f_classes .= 'update-nag is-dismissible';
				break;

			case 'success':
				$f_classes .= 'notice-success is-dismissible';
				break;

			default:
				$f_classes .= 'notice-error is-dismissible';
		}

		$f_notice  = '<div class="' . esc_attr( $f_classes ) . '">';
		$f_notice .= '<p>' . esc_html( $f_message ) . '</p>';
		$f_notice .= '</div>';

		echo wp_kses_post( $f_notice );
	}


	/**
	 * Show wordpress and server info.
	 *
	 * @return  Array $f_system_data       returns array of all wordpress and server related information.
	 * @since  1.0.0
	 */
	public function mwb_f_plug_system_status() {
		global $wpdb;
		$f_system_status = array();
		$f_wordpress_status = array();
		$f_system_data = array();

		// Get the web server.
		$f_system_status['web_server'] = isset( $_SERVER['SERVER_SOFTWARE'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) : '';

		// Get PHP version.
		$f_system_status['php_version'] = function_exists( 'phpversion' ) ? phpversion() : __( 'N/A (phpversion function does not exist)', 'firstplugin' );

		// Get the server's IP address.
		$f_system_status['server_ip'] = isset( $_SERVER['SERVER_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_ADDR'] ) ) : '';

		// Get the server's port.
		$f_system_status['server_port'] = isset( $_SERVER['SERVER_PORT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_PORT'] ) ) : '';

		// Get the uptime.
		$f_system_status['uptime'] = function_exists( 'exec' ) ? @exec( 'uptime -p' ) : __( 'N/A (make sure exec function is enabled)', 'firstplugin' );

		// Get the server path.
		$f_system_status['server_path'] = defined( 'ABSPATH' ) ? ABSPATH : __( 'N/A (ABSPATH constant not defined)', 'firstplugin' );

		// Get the OS.
		$f_system_status['os'] = function_exists( 'php_uname' ) ? php_uname( 's' ) : __( 'N/A (php_uname function does not exist)', 'firstplugin' );

		// Get WordPress version.
		$f_wordpress_status['wp_version'] = function_exists( 'get_bloginfo' ) ? get_bloginfo( 'version' ) : __( 'N/A (get_bloginfo function does not exist)', 'firstplugin' );

		// Get and count active WordPress plugins.
		$f_wordpress_status['wp_active_plugins'] = function_exists( 'get_option' ) ? count( get_option( 'active_plugins' ) ) : __( 'N/A (get_option function does not exist)', 'firstplugin' );

		// See if this site is multisite or not.
		$f_wordpress_status['wp_multisite'] = function_exists( 'is_multisite' ) && is_multisite() ? __( 'Yes', 'firstplugin' ) : __( 'No', 'firstplugin' );

		// See if WP Debug is enabled.
		$f_wordpress_status['wp_debug_enabled'] = defined( 'WP_DEBUG' ) ? __( 'Yes', 'firstplugin' ) : __( 'No', 'firstplugin' );

		// See if WP Cache is enabled.
		$f_wordpress_status['wp_cache_enabled'] = defined( 'WP_CACHE' ) ? __( 'Yes', 'firstplugin' ) : __( 'No', 'firstplugin' );

		// Get the total number of WordPress users on the site.
		$f_wordpress_status['wp_users'] = function_exists( 'count_users' ) ? count_users() : __( 'N/A (count_users function does not exist)', 'firstplugin' );

		// Get the number of published WordPress posts.
		$f_wordpress_status['wp_posts'] = wp_count_posts()->publish >= 1 ? wp_count_posts()->publish : __( '0', 'firstplugin' );

		// Get PHP memory limit.
		$f_system_status['php_memory_limit'] = function_exists( 'ini_get' ) ? (int) ini_get( 'memory_limit' ) : __( 'N/A (ini_get function does not exist)', 'firstplugin' );

		// Get the PHP error log path.
		$f_system_status['php_error_log_path'] = ! ini_get( 'error_log' ) ? __( 'N/A', 'firstplugin' ) : ini_get( 'error_log' );

		// Get PHP max upload size.
		$f_system_status['php_max_upload'] = function_exists( 'ini_get' ) ? (int) ini_get( 'upload_max_filesize' ) : __( 'N/A (ini_get function does not exist)', 'firstplugin' );

		// Get PHP max post size.
		$f_system_status['php_max_post'] = function_exists( 'ini_get' ) ? (int) ini_get( 'post_max_size' ) : __( 'N/A (ini_get function does not exist)', 'firstplugin' );

		// Get the PHP architecture.
		if ( PHP_INT_SIZE == 4 ) {
			$f_system_status['php_architecture'] = '32-bit';
		} elseif ( PHP_INT_SIZE == 8 ) {
			$f_system_status['php_architecture'] = '64-bit';
		} else {
			$f_system_status['php_architecture'] = 'N/A';
		}

		// Get server host name.
		$f_system_status['server_hostname'] = function_exists( 'gethostname' ) ? gethostname() : __( 'N/A (gethostname function does not exist)', 'firstplugin' );

		// Show the number of processes currently running on the server.
		$f_system_status['processes'] = function_exists( 'exec' ) ? @exec( 'ps aux | wc -l' ) : __( 'N/A (make sure exec is enabled)', 'firstplugin' );

		// Get the memory usage.
		$f_system_status['memory_usage'] = function_exists( 'memory_get_peak_usage' ) ? round( memory_get_peak_usage( true ) / 1024 / 1024, 2 ) : 0;

		// Get CPU usage.
		// Check to see if system is Windows, if so then use an alternative since sys_getloadavg() won't work.
		if ( stristr( PHP_OS, 'win' ) ) {
			$f_system_status['is_windows'] = true;
			$f_system_status['windows_cpu_usage'] = function_exists( 'exec' ) ? @exec( 'wmic cpu get loadpercentage /all' ) : __( 'N/A (make sure exec is enabled)', 'firstplugin' );
		}

		// Get the memory limit.
		$f_system_status['memory_limit'] = function_exists( 'ini_get' ) ? (int) ini_get( 'memory_limit' ) : __( 'N/A (ini_get function does not exist)', 'firstplugin' );

		// Get the PHP maximum execution time.
		$f_system_status['php_max_execution_time'] = function_exists( 'ini_get' ) ? ini_get( 'max_execution_time' ) : __( 'N/A (ini_get function does not exist)', 'firstplugin' );

		// Get outgoing IP address.
		$f_system_status['outgoing_ip'] = function_exists( 'file_get_contents' ) ? file_get_contents( 'http://ipecho.net/plain' ) : __( 'N/A (file_get_contents function does not exist)', 'firstplugin' );

		$f_system_data['php'] = $f_system_status;
		$f_system_data['wp'] = $f_wordpress_status;

		return $f_system_data;
	}

	/**
	 * Generate html components.
	 *
	 * @param  string $f_components    html to display.
	 * @since  1.0.0
	 */
	public function mwb_f_plug_generate_html( $f_components = array() ) {
		if ( is_array( $f_components ) && ! empty( $f_components ) ) {
			foreach ( $f_components as $f_component ) {
				switch ( $f_component['type'] ) {

					case 'hidden':
					case 'number':
					case 'password':
					case 'email':
					case 'text':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $f_component['id'] ); ?>"><?php echo esc_html( $f_component['title'] ); // WPCS: XSS ok. ?>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $f_component['type'] ) ); ?>">
								<input
								name="<?php echo esc_attr( $f_component['id'] ); ?>"
								id="<?php echo esc_attr( $f_component['id'] ); ?>"
								type="<?php echo esc_attr( $f_component['type'] ); ?>"
								value="<?php echo esc_attr( $f_component['value'] ); ?>"
								class="<?php echo esc_attr( $f_component['class'] ); ?>"
								placeholder="<?php echo esc_attr( $f_component['placeholder'] ); ?>"
								/>
								<p class="f-descp-tip"><?php echo esc_html( $f_component['description'] ); // WPCS: XSS ok. ?></p>
							</td>
						</tr>
						<?php
						break;

					case 'textarea':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $f_component['id'] ); ?>"><?php echo esc_html( $f_component['title'] ); ?>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $f_component['type'] ) ); ?>">
								<textarea
								name="<?php echo esc_attr( $f_component['id'] ); ?>"
								id="<?php echo esc_attr( $f_component['id'] ); ?>"
								class="<?php echo esc_attr( $f_component['class'] ); ?>"
								rows="<?php echo esc_attr( $f_component['rows'] ); ?>"
								cols="<?php echo esc_attr( $f_component['cols'] ); ?>"
								placeholder="<?php echo esc_attr( $f_component['placeholder'] ); ?>"
								><?php echo esc_textarea( $f_component['value'] ); // WPCS: XSS ok. ?></textarea>
								<p class="f-descp-tip"><?php echo esc_html( $f_component['description'] ); // WPCS: XSS ok. ?></p>
							</td>
						</tr>
						<?php
						break;

					case 'select':
					case 'multiselect':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $f_component['id'] ); ?>"><?php echo esc_html( $f_component['title'] ); ?>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $f_component['type'] ) ); ?>">
								<select
								name="<?php echo esc_attr( $f_component['id'] ); ?><?php echo ( 'multiselect' === $f_component['type'] ) ? '[]' : ''; ?>"
								id="<?php echo esc_attr( $f_component['id'] ); ?>"
								class="<?php echo esc_attr( $f_component['class'] ); ?>"
								<?php echo 'multiselect' === $f_component['type'] ? 'multiple="multiple"' : ''; ?>
								>
								<?php
								foreach ( $f_component['options'] as $f_key => $f_val ) {
									?>
									<option value="<?php echo esc_attr( $f_key ); ?>"
										<?php
										if ( is_array( $f_component['value'] ) ) {
											selected( in_array( (string) $f_key, $f_component['value'], true ), true );
										} else {
											selected( $f_component['value'], (string) $f_key );
										}
										?>
										>
										<?php echo esc_html( $f_val ); ?>
									</option>
									<?php
								}
								?>
								</select> 
								<p class="f-descp-tip"><?php echo esc_html( $f_component['description'] ); // WPCS: XSS ok. ?></p>
							</td>
						</tr>
						<?php
						break;

					case 'checkbox':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc"><?php echo esc_html( $f_component['title'] ); ?></th>
							<td class="forminp forminp-checkbox">
								<label for="<?php echo esc_attr( $f_component['id'] ); ?>"></label>
								<input
								name="<?php echo esc_attr( $f_component['id'] ); ?>"
								id="<?php echo esc_attr( $f_component['id'] ); ?>"
								type="checkbox"
								class="<?php echo esc_attr( isset( $f_component['class'] ) ? $f_component['class'] : '' ); ?>"
								value="1"
								<?php checked( $f_component['value'], '1' ); ?>
								/> 
								<span class="f-descp-tip"><?php echo esc_html( $f_component['description'] ); // WPCS: XSS ok. ?></span>

							</td>
						</tr>
						<?php
						break;

					case 'radio':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $f_component['id'] ); ?>"><?php echo esc_html( $f_component['title'] ); ?>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $f_component['type'] ) ); ?>">
								<fieldset>
									<span class="f-descp-tip"><?php echo esc_html( $f_component['description'] ); // WPCS: XSS ok. ?></span>
									<ul>
										<?php
										foreach ( $f_component['options'] as $f_radio_key => $f_radio_val ) {
											?>
											<li>
												<label><input
													name="<?php echo esc_attr( $f_component['id'] ); ?>"
													value="<?php echo esc_attr( $f_radio_key ); ?>"
													type="radio"
													class="<?php echo esc_attr( $f_component['class'] ); ?>"
												<?php checked( $f_radio_key, $f_component['value'] ); ?>
													/> <?php echo esc_html( $f_radio_val ); ?></label>
											</li>
											<?php
										}
										?>
									</ul>
								</fieldset>
							</td>
						</tr>
						<?php
						break;

					case 'button':
						?>
						<tr valign="top">
							<td scope="row">
								<input type="button" class="button button-primary" 
								name="<?php echo esc_attr( $f_component['id'] ); ?>"
								id="<?php echo esc_attr( $f_component['id'] ); ?>"
								value="<?php echo esc_attr( $f_component['button_text'] ); ?>"
								/>
							</td>
						</tr>
						<?php
						break;

					case 'submit':
						?>
						<tr valign="top">
							<td scope="row">
								<input type="submit" class="button button-primary" 
								name="<?php echo esc_attr( $f_component['id'] ); ?>"
								id="<?php echo esc_attr( $f_component['id'] ); ?>"
								value="<?php echo esc_attr( $f_component['button_text'] ); ?>"
								/>
							</td>
						</tr>
						<?php
						break;

					default:
						break;
				}
			}
		}
	}
}
