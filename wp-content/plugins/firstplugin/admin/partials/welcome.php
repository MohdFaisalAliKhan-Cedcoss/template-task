<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the welcome html.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Firstplugin
 * @subpackage Firstplugin/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="mwb-f-main-wrapper">
	<div class="mwb-f-go-pro">
		<div class="mwb-f-go-pro-banner">
			<div class="mwb-f-inner-container">
				<div class="mwb-f-name-wrapper" id="mwb-f-page-header">
					<h3><?php esc_html_e( 'Welcome To MakeWebBetter', 'firstplugin' ); ?></h4>
					</div>
				</div>
			</div>
			<div class="mwb-f-inner-logo-container">
				<div class="mwb-f-main-logo">
					<img src="<?php echo esc_url( FIRSTPLUGIN_DIR_URL . 'admin/images/logo.png' ); ?>">
					<h2><?php esc_html_e( 'We make the customer experience better', 'firstplugin' ); ?></h2>
					<h3><?php esc_html_e( 'Being best at something feels great. Every Business desires a smooth buyer’s journey, WE ARE BEST AT IT.', 'firstplugin' ); ?></h3>
				</div>
				<div class="mwb-f-active-plugins-list">
					<?php
					$mwb_f_all_plugins = get_option( 'mwb_all_plugins_active', false );
					if ( is_array( $mwb_f_all_plugins ) && ! empty( $mwb_f_all_plugins ) ) {
						?>
						<table class="mwb-f-table">
							<thead>
								<tr class="mwb-plugins-head-row">
									<th><?php esc_html_e( 'Plugin Name', 'firstplugin' ); ?></th>
									<th><?php esc_html_e( 'Active Status', 'firstplugin' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if ( is_array( $mwb_f_all_plugins ) && ! empty( $mwb_f_all_plugins ) ) { ?>
									<?php foreach ( $mwb_f_all_plugins as $f_plugin_key => $f_plugin_value ) { ?>
										<tr class="mwb-plugins-row">
											<td><?php echo esc_html( $f_plugin_value['plugin_name'] ); ?></td>
											<?php if ( isset( $f_plugin_value['active'] ) && '1' != $f_plugin_value['active'] ) { ?>
												<td><?php esc_html_e( 'NO', 'firstplugin' ); ?></td>
											<?php } else { ?>
												<td><?php esc_html_e( 'YES', 'firstplugin' ); ?></td>
											<?php } ?>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
						<?php
					}
					?>
				</div>
			</div>
		</div>
