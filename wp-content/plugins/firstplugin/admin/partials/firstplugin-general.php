<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the html field for general tab.
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
global $f_mwb_f_obj;
$f_genaral_settings = apply_filters( 'f_general_settings_array', array() );
?>
<!--  template file for admin settings. -->
<div class="f-secion-wrap">
	<table class="form-table f-settings-table">
		<?php
			$f_general_html = $f_mwb_f_obj->mwb_f_plug_generate_html( $f_genaral_settings );
			echo esc_html( $f_general_html );
		?>
	</table>
</div>
