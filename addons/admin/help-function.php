<?php 
/* Most Important funtions */
/**
* 
*/
function wpsm_get_value( $value='', $default='' ) {
 	if ( $value != '' ) {
 		return $value;	
 	}
 	return $default;
} 

class wpsmHelp {
	
	static public function wpsm_pull_typo( $prefix = '', $options = NULL, $remove = NULL ) {
		
		$typo = array(
			'tag'	=> array(
				'type'		=> 'select',
				'label'     => __( 'HTML Tag', 'wpsm-bbe' ),
				'default'   => 'h2',
				'options'   => array(
					'h1'		=>  'h1',
					'h2'       	=>  'h2',
					'h3'       	=>  'h3',
					'h4'       	=>  'h4',
					'h5'       	=>  'h5',
					'h6'       	=>  'h6'
				)
			),
			'font'          => array(
				'type'          => 'font',
				'default'		=> array(
					'family'		=> 'Default',
					'weight'		=> 300
				),
				'label'         => __('Font', 'wpsm-bbe'),
			),
			'font_size' => array(
				'type'          => 'text',
				'label'         => __('Font Size', 'wpsm-bbe'),
				'default'       => '',
				'maxlength'     => '4',
				'size'          => '6',
				'description'   => 'px',
				'help'			=> __('If you want to apply default "Font Size" leave it blank', 'wpsm-bbe')
			),
			'line_height' => array(
				'type'          => 'text',
				'label'         => __('Line Height', 'wpsm-bbe'),
				'default'       => '',
				'maxlength'     => '4',
				'size'          => '6',
				'description'   => 'px',
				'help'			=> __('If you want to apply default "Line Height" leave it blank', 'wpsm-bbe')
			)
		);

		if ( $prefix != '' ) {
			foreach ( $typo as $key => $value ) {
				$typo[$prefix.'_'.$key] = $value;
				unset( $typo[$key] );
			}
		}
		
		if ( is_array( $options ) && ( count( $options ) > 0 ) ) {
			$typo = array_replace_recursive( $typo, $options );
		}


		if( is_array( $remove ) && ( count( $remove ) > 0 ) ){
			foreach ($remove as $remove_options) {
				unset( $typo[$remove_options] );
			}
		}

		return $typo;
	}
}
