<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Firstplugin
 * @subpackage Firstplugin/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {

	exit(); // Exit if accessed directly.
}

global $f_mwb_f_obj;
$f_active_tab   = isset( $_GET['f_tab'] ) ? sanitize_key( $_GET['f_tab'] ) : 'firstplugin-general';
$f_default_tabs = $f_mwb_f_obj->mwb_f_plug_default_tabs();
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="mwb-f-main-wrapper">
	<div class="mwb-f-go-pro">
		<div class="mwb-f-go-pro-banner">
			<div class="mwb-f-inner-container">
				<div class="mwb-f-name-wrapper">
					<p><?php esc_html_e( 'firstPlugin', 'firstplugin' ); ?></p></div>
					<div class="mwb-f-static-menu">
						<ul>
							<li>
								<a href="<?php echo esc_url( 'https://makewebbetter.com/contact-us/' ); ?>" target="_blank">
									<span class="dashicons dashicons-phone"></span>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url( 'https://docs.makewebbetter.com/hubspot-woocommerce-integration/' ); ?>" target="_blank">
									<span class="dashicons dashicons-media-document"></span>
								</a>
							</li>
							<?php $f_plugin_pro_link = apply_filters( 'f_pro_plugin_link', '' ); ?>
							<?php if ( isset( $f_plugin_pro_link ) && '' != $f_plugin_pro_link ) { ?>
								<li class="mwb-f-main-menu-button">
									<a id="mwb-f-go-pro-link" href="<?php echo esc_url( $f_plugin_pro_link ); ?>" class="" title="" target="_blank"><?php esc_html_e( 'GO PRO NOW', 'firstplugin' ); ?></a>
								</li>
							<?php } else { ?>
								<li class="mwb-f-main-menu-button">
									<a id="mwb-f-go-pro-link" href="#" class="" title=""><?php esc_html_e( 'GO PRO NOW', 'firstplugin' ); ?></a>
								</li>
							<?php } ?>
							<?php $f_plugin_pro = apply_filters( 'f_pro_plugin_purcahsed', 'no' ); ?>
							<?php if ( isset( $f_plugin_pro ) && 'yes' == $f_plugin_pro ) { ?>
								<li>
									<a id="mwb-f-skype-link" href="<?php echo esc_url( 'https://join.skype.com/invite/IKVeNkLHebpC' ); ?>" target="_blank">
										<img src="<?php echo esc_url( FIRSTPLUGIN_DIR_URL . 'admin/images/skype_logo.png' ); ?>" style="height: 15px;width: 15px;" ><?php esc_html_e( 'Chat Now', 'firstplugin' ); ?>
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="mwb-f-main-template">
			<div class="mwb-f-body-template">
				<div class="mwb-f-navigator-template">
					<div class="mwb-f-navigations">
						<?php
						if ( is_array( $f_default_tabs ) && ! empty( $f_default_tabs ) ) {

							foreach ( $f_default_tabs as $f_tab_key => $f_default_tabs ) {

								$f_tab_classes = 'mwb-f-nav-tab ';

								if ( ! empty( $f_active_tab ) && $f_active_tab === $f_tab_key ) {
									$f_tab_classes .= 'f-nav-tab-active';
								}
								?>
								
								<div class="mwb-f-tabs">
									<a class="<?php echo esc_attr( $f_tab_classes ); ?>" id="<?php echo esc_attr( $f_tab_key ); ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=firstplugin_menu' ) . '&f_tab=' . esc_attr( $f_tab_key ) ); ?>"><?php echo esc_html( $f_default_tabs['title'] ); ?></a>
								</div>

								<?php
							}
						}
						?>
					</div>
				</div>

				<div class="mwb-f-content-template">
					<div class="mwb-f-content-container">
						<?php
							// if submenu is directly clicked on woocommerce.
						if ( empty( $f_active_tab ) ) {

							$f_active_tab = 'mwb_f_plug_general';
						}

							// look for the path based on the tab id in the admin templates.
						$f_tab_content_path = 'admin/partials/' . $f_active_tab . '.php';

						$f_mwb_f_obj->mwb_f_plug_load_template( $f_tab_content_path );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
