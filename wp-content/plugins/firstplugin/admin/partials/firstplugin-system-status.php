<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the html for system status.
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
// Template for showing information about system status.
global $f_mwb_f_obj;
$f_default_status = $f_mwb_f_obj->mwb_f_plug_system_status();
$f_wordpress_details = is_array( $f_default_status['wp'] ) && ! empty( $f_default_status['wp'] ) ? $f_default_status['wp'] : array();
$f_php_details = is_array( $f_default_status['php'] ) && ! empty( $f_default_status['php'] ) ? $f_default_status['php'] : array();
?>
<div class="mwb-f-table-wrap">
	<div class="mwb-f-table-inner-container">
		<table class="mwb-f-table" id="mwb-f-wp">
			<thead>
				<tr>
					<th><?php esc_html_e( 'WP Variables', 'firstplugin' ); ?></th>
					<th><?php esc_html_e( 'WP Values', 'firstplugin' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( is_array( $f_wordpress_details ) && ! empty( $f_wordpress_details ) ) { ?>
					<?php foreach ( $f_wordpress_details as $wp_key => $wp_value ) { ?>
						<?php if ( isset( $wp_key ) && 'wp_users' != $wp_key ) { ?>
							<tr>
								<td><?php echo esc_html( $wp_key ); ?></td>
								<td><?php echo esc_html( $wp_value ); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="mwb-f-table-inner-container">
		<table class="mwb-f-table" id="mwb-f-php">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Sysytem Variables', 'firstplugin' ); ?></th>
					<th><?php esc_html_e( 'System Values', 'firstplugin' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( is_array( $f_php_details ) && ! empty( $f_php_details ) ) { ?>
					<?php foreach ( $f_php_details as $php_key => $php_value ) { ?>
						<tr>
							<td><?php echo esc_html( $php_key ); ?></td>
							<td><?php echo esc_html( $php_value ); ?></td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
