<div id="fl-wps-settings-form" class="fl-settings-form wps-settings-form">

	<h3 class="fl-settings-form-header"><?php _e("Tesseract Designer Plus General Settings", 'fl-builder'); ?></h3>

	<form id="wps-settings-form" action="<?php FLBuilderAdminSettings::render_form_action( 'wps-settings' ); ?>" method="post">

		<?php if ( FLBuilderAdminSettings::multisite_support() && ! is_network_admin() ) : ?>
		<label>
			<input class="fl-override-ms-cb" type="checkbox" name="fl-override-ms" value="1" <?php if(get_option('_fl_builder_wps_settings')) echo 'checked="checked"'; ?> />
			<?php _e('Override network settings?', 'fl-builder'); ?>
		</label>
		<?php endif; ?>

		<div class="fl-settings-form-content">

			<?php

				$wps_settings = FLBuilderModel::get_admin_settings_option( '_fl_builder_wps_settings', true );

				if( empty( $wps_settings ) || !array_key_exists( 'google-map-api', $wps_settings ) ) {
					$wps_settings['google-map-api'] = '';
				} 

				$google_map_api_key = '';
				if( is_array( $wps_settings ) ) {
					
					$google_map_api_key	= ( array_key_exists( 'google-map-api', $wps_settings ) )  ? $wps_settings['google-map-api'] : '';
					
				} 
			?>

				<!-- Google Map API Key  -->
					<h4><?php _e( 'Google Map API Key', 'fl-builder' ); ?></h4>
					<input type="text" name="google-map-api" value="<?php echo $google_map_api_key; ?>" class="regular-text wps-google-map-api" />
					<p><?php _e('Get your Google map API key.', 'fl-builder'); ?> <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"><?php _e('Here is article', 'fl-builder'); ?></a>.
					</p>


		</div>

		<p class="submit">
			<input type="submit" name="fl-save-wps-settings" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'fl-builder' ); ?>" />
		</p>

		<?php wp_nonce_field('wps-settings', 'fl-wps-settings-nonce'); ?>

	</form>
</div>
