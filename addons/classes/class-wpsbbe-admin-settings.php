<?php
/*
* Admin options 
*/
	
class wpsAdminSettings {
		
	static public function init() {
		/* Setting Page */
		add_action( 'fl_builder_admin_settings_render_forms', 'wpsAdminSettings::admin_settings_render_form' );
		add_filter( 'fl_builder_admin_settings_nav_items', 'wpsAdminSettings::admin_settings_nav_item' );
		add_action( 'fl_builder_admin_settings_save', 'wpsAdminSettings::wpsbbe_admin_settings_save' );
		
	}

	static public function admin_settings_nav_item( $items ) {

		$items['wps-settings'] = array(
			'title' 	=> __( 'Tesseract Designer Plus Settings', 'fl-builder' ),
			'show'		=> true,
			'priority'	=> 625
		);

	    return $items;
	}

	static public function admin_settings_render_form() {
		include WPSM_BBE_DIR . 'includes/wpsbbe-admin-settings-form.php';
	}

	static public function wpsbbe_admin_settings_save() {

		if ( !is_admin() ) {
			return;
		}
		
		if ( isset( $_POST['fl-wps-settings-nonce'] ) && wp_verify_nonce( $_POST['fl-wps-settings-nonce'], 'wps-settings' ) ) {

			if( isset( $_POST['google-map-api'] ) ) {
				$wps_settings['google-map-api'] = $_POST['google-map-api'];
			}

			FLBuilderModel::update_admin_settings_option( '_fl_builder_wps_settings', $wps_settings, true );
		}
	}
}

wpsAdminSettings::init();