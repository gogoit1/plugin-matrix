<?php

/**
 * @class WPSMMapModule
 */
class WPSMMapModule extends FLBuilderModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Map Sparkz', 'wpsm-bbe'),
			'description'   	=> __('Display a Google map.', 'wpsm-bbe'),
			'category'      	=> __('Tesseract Designer Plus', 'wpsm-bbe'),
			'dir'           => WPSM_BBE_DIR . 'modules/wpsm-map/',
            'url'           => WPSM_BBE_URL . 'modules/wpsm-map/',
			'partial_refresh'	=> true
		));

		$wps_settings = FLBuilderModel::get_admin_settings_option( '_fl_builder_wps_settings', true );
		$google_map_api_key = '';

		if( empty( $wps_settings ) || !array_key_exists( 'google-map-api', $wps_settings ) ) {
			$wps_settings['google-map-api'] = '';
		}elseif( is_array( $wps_settings ) && array_key_exists( 'google-map-api', $wps_settings ) ) {
			$google_map_api_key	= $wps_settings['google-map-api'];

			if ( $google_map_api_key != '' ) {
				$google_map_api_key = 'key='.$google_map_api_key;
			}
		} 

		$url = 'https://maps.googleapis.com/maps/api/js?'.$google_map_api_key;

		// Register and enqueue your own
        $this->add_js('map-api', $url );
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSMMapModule', array(
	'general'       => array(
		'title'         => __('General', 'wpsm-bbe'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'addname'       => array(
						'type'          => 'text',
						'label'         => __('Address or Name', 'wpsm-bbe'),
						'placeholder'   => __('1865 Winchester Blvd #202 Campbell, CA 95008', 'wpsm-bbe'),
						'help'			=> __('Text will appear when user Click on map marker', 'wpsm-bbe' ),
						'default'		=> 'New Delhi',
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Map Height', 'wpsm-bbe'),
						'default'       => '400',
						'size'          => '5',
						'description'   => 'px'
					)
				)
			),
			'marker'       => array(
				'title'         => __( 'Map Coordinates', 'wpsm-bbe'),
				'fields'        => array(
					'lat'       => array(
						'type'          => 'text',
						'label'         => __('Lattitude', 'wpsm-bbe'),
						'default'		=> '28.6139391',
						'placeholder'   => __('28.6139391', 'wpsm-bbe'),
						'description'	=> __( 'Get Lattitude <a href="http://www.gps-coordinates.net" target="_blank">Click Here</a>', 'wpsm-bbe'),
						'preview'         => array(
							'type'            => 'refresh'
						)
					),
					'long'       => array(
						'type'          => 'text',
						'label'         => __('Longitude', 'wpsm-bbe'),
						'default'		=> '77.20902120000005',
						'placeholder'   => __('77.20902120000005', 'wpsm-bbe'),
						'description'	=> __( 'Get Longitude <a href="http://www.gps-coordinates.net" target="_blank">Click Here</a>', 'wpsm-bbe'),
						'preview'         => array(
							'type'            => 'refresh'
						)
					),
				)
			),
			'map_set'       => array(
				'title'         => __( 'Map Setting', 'wpsm-bbe'),
				'fields'        => array(
					'map_type'	=> array(
						'type'		=> 'select',
						'label'     => __( 'Map Type', 'wpsm-bbe' ),
						'default'   => 'ROADMAP',
						'options'   => array(
							'ROADMAP'	 	=>   'ROADMAP',
							'SATELLITE'     =>   'SATELLITE',
							'HYBRID'      	=>   'HYBRID',
							'TERRAIN'      	=>   'TERRAIN'
						)
					),
					'zoom_level'	=> array(
						'type'		=> 'select',
						'label'     => __( 'Map Zoom', 'wpsm-bbe' ),
						'default'   => '10',
						'options'   => array(
							'1'		 =>   '1',
							'2'      =>   '2',
							'3'      =>   '3',
							'4'      =>   '4',
							'5'      =>   '5',
							'6'      =>   '6',
							'7'      =>	  '7',
							'8'      =>	  '8',
							'9'      =>	  '9',
							'10'      =>  '10',
							'11'      =>  '11',
							'12'      =>  '12',
							'13'      =>  '13',
							'14'      =>  '14',
							'15'      =>  '15',
							'16'      =>  '16',
							'17'      =>  '17',
							'18'      =>  '18',
							'19'      =>  '19',
							'20'      =>  '20',
						)
					),
					'enable_title'	=> array(
						'type'		=> 'select',
						'label'     => __( 'Enable Title', 'wpsm-bbe' ),
						'default'   => 'yes',
						'options'   => array(
							'no'		=>   'No',
							'yes' 		=>   'Yes'
						)
					),
					'enable_anim'	=> array(
						'type'		=> 'select',
						'label'     => __( 'Enable Animation', 'wpsm-bbe' ),
						'default'   => 'no',
						'options'   => array(
							'no'		=>   'No',
							'yes' 		=>   'Yes'
						)
					),
					'disable_scroll'	=> array(
						'type'		=> 'select',
						'label'     => __( 'Disable Mouse Scroll', 'wpsm-bbe' ),
						'default'   => 'no',
						'options'   => array(
							'no'		=>   'No',
							'yes' 		=>   'Yes'
						)
					),
					
				)
			)
		)
	)
));