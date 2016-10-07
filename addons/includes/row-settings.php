<?php

/**
*  Extender BB Row Settings
*/

if ( !class_exists( 'WPSMRowSettings' ) ) {
	class WPSMRowSettings {
		
		function __construct()
		{
			add_filter('fl_builder_register_settings_form', array( $this, 'wpsm_extend_row_settings' ), 10, 2);
		}

		/**
		 * Extending row setting for row separator
		 */
		function wpsm_extend_row_settings( $form, $id ) {

			if( $id == 'row' ) {
				$row_setting = array(
					'title'		=> __('Separator', 'wpsm-bbe'),
					'sections' 	=> array(
						'row_top_separator' => array(
							'title' 		=> __('Top Row Separator Style', 'wpsm-bbe'),
							'fields'  => array(
								'enable_top_separator'  => array(
									'type'    => 'select',
									'label'   => __('Enable Top Separator', 'wpsm-bbe'),
									'help'    => __('Enable Top Row Separator Style', 'wpsm-bbe'),
									'default' => 'no',
									'options' => array(
										'yes'	=> __('Yes', 'wpsm-bbe'),
										'no'	=> __('No', 'wpsm-bbe'),
									),
									'toggle' => array(
										'yes' => array(
											'fields' => array( 's_top_style', 's_top_color', 's_top_height' )
										)
									)
								),
								's_top_style'  => array(
									'type'    => 'select',
									'label'   => __('Top Separator Style', 'wpsm-bbe'),
									'help'    => __('Select Top Separator Style', 'wpsm-bbe'),
									'default' => 'arrow-center',
									'options' => array(
										'tip-left'		=> __( 'Tip Left', 'wpsm' ),
										'tip-center'	=> __( 'Tip Center', 'wpsm' ),
										'tip-right'		=> __( 'Tip Right', 'wpsm' ),
										'circle-left'	=> __( 'Circle Left', 'wpsm' ),
										'circle-center'	=> __( 'Circle Center', 'wpsm' ),
										'circle-right'	=> __( 'Circle Right', 'wpsm' ),
										'split-inner'	=> __( 'Split Inner', 'wpsm' ),
										'split-outer'	=> __( 'Split Outer', 'wpsm' ),
										'teeth-left'	=> __( 'Teeth Left', 'wpsm' ),
										'teeth-center'	=> __( 'Teeth Center', 'wpsm' ),
										'teeth-right'	=> __( 'Teeth Right', 'wpsm' ),
										'arrow-left'	=> __( 'Arrow Left', 'wpsm' ),
										'arrow-center'	=> __( 'Arrow Center', 'wpsm' ),
										'arrow-right'	=> __( 'Arrow Right', 'wpsm' ),
										'blob-left'		=> __( 'Blob Left', 'wpsm' ),
										'blob-center'	=> __( 'Blob Center', 'wpsm' ),
										'blob-right'	=> __( 'Blob Right', 'wpsm' ),
										'slope-left'	=> __( 'Slope Left', 'wpsm' ),
										'slope-right'	=> __( 'Slope Right', 'wpsm' ),
										'stamp'			=> __( 'Stamp', 'wpsm' ),
										'cloud'			=> __( 'Cloud', 'wpsm' )
										
									),
								),
								's_top_color'  => array(
									'type'	=> 'color',
									'label'	=> __('Color', 'wpsm-bbe'),
									'default'	=> 'ffffff',
									'help' 	=> __('Mostly this color is adjacent row color. Default is white', 'wpsm-bbe') 
								),
								's_top_height'	=> array(
									'type'	=> 'text',
									'label'	=> __('Height', 'wpsm-bbe'),
									'default'	=> '100',
									'maxlength'     => '3',
									'size'          => '6',
									'description'	=> 'px',
									'help' 	=> __('Default Size : 100', 'wpsm-bbe') 
								)
							)
						),
						'row_bottom_separator' => array(
							'title' 		=> __('Bottom Row Separator Style', 'wpsm-bbe'),
							'fields'  => array(
								'enable_bottom_separator'  => array(
									'type'    => 'select',
									'label'   => __('Enable Bottom Separator', 'wpsm-bbe'),
									'help'    => __('Enable Bottom Row Separator Style', 'wpsm-bbe'),
									'default' => 'no',
									'options' => array(
										'yes'	=> __('Yes', 'wpsm-bbe'),
										'no'	=> __('No', 'wpsm-bbe'),
									),
									'toggle' => array(
										'yes' => array(
											'fields' => array( 's_bottom_style', 's_bottom_color', 's_bottom_height' )
										)
									)
								),
								's_bottom_style'  => array(
									'type'    => 'select',
									'label'   => __('Bottom Separator Style', 'wpsm-bbe'),
									'help'    => __('Select Bottom Separator Style', 'wpsm-bbe'),
									'default' => 'arrow-center',
									'options' => array(
										'tip-left'		=> __( 'Tip Left', 'wpsm' ),
										'tip-center'	=> __( 'Tip Center', 'wpsm' ),
										'tip-right'		=> __( 'Tip Right', 'wpsm' ),
										'circle-left'	=> __( 'Circle Left', 'wpsm' ),
										'circle-center'	=> __( 'Circle Center', 'wpsm' ),
										'circle-right'	=> __( 'Circle Right', 'wpsm' ),
										'split-inner'	=> __( 'Split Inner', 'wpsm' ),
										'split-outer'	=> __( 'Split Outer', 'wpsm' ),
										'teeth-left'	=> __( 'Teeth Left', 'wpsm' ),
										'teeth-center'	=> __( 'Teeth Center', 'wpsm' ),
										'teeth-right'	=> __( 'Teeth Right', 'wpsm' ),
										'arrow-left'	=> __( 'Arrow Left', 'wpsm' ),
										'arrow-center'	=> __( 'Arrow Center', 'wpsm' ),
										'arrow-right'	=> __( 'Arrow Right', 'wpsm' ),
										'blob-left'		=> __( 'Blob Left', 'wpsm' ),
										'blob-center'	=> __( 'Blob Center', 'wpsm' ),
										'blob-right'	=> __( 'Blob Right', 'wpsm' ),
										'slope-left'	=> __( 'Slope Left', 'wpsm' ),
										'slope-right'	=> __( 'Slope Right', 'wpsm' ),
										'stamp'			=> __( 'Stamp', 'wpsm' ),
										'cloud'			=> __( 'Cloud', 'wpsm' )
										
									),
								),
								's_bottom_color'  => array(
									'type'	=> 'color',
									'label'	=> __('Color', 'wpsm-bbe'),
									'default'	=> 'ffffff',
									'help' 	=> __('Mostly this color is adjacent row color. Default is white', 'wpsm-bbe') 
								),
								's_bottom_height'	=> array(
									'type'	=> 'text',
									'label'	=> __('Height', 'wpsm-bbe'),
									'default'	=> '100',
									'maxlength'     => '3',
									'size'          => '6',
									'description'	=> 'px',
									'help' 	=> __('Default Size : 100', 'wpsm-bbe') 
								)
							)
						),
						'img_separator'       => array( 
							'title' 		=> __('Image Separator', 'wpsm-bbe'),
							'fields'        => array( // Section Fields
								'enable_img_separator'  => array(
									'type'    => 'select',
									'label'   => __('Enable Image Separator', 'wpsm-bbe'),
									'help'    => __('Image as a Row Separator', 'wpsm-bbe'),
									'default' => 'no',
									'options' => array(
										'yes'	=> __('Yes', 'wpsm-bbe'),
										'no'	=> __('No', 'wpsm-bbe'),
									),
									'toggle' => array(
										'yes' => array(
											'fields' => array( 'img', 'img_position', 'img_width', 'img_gutter', 'img_lr_position', 'img_lr_value' )
										)
									)
								),
								'img'         => array(
									'type'          => 'photo',
									'label'         => __('Image', 'wpsm-bbe')
								),
								'img_position'  => array(
									'type'          => 'select',
									'label'         => __('Image Vertical Position', 'wpsm-bbe'),
									'default'       => 'bottom',
									'options'       => array(
										'top'             => __('Top', 'wpsm-bbe'),
										'bottom'         => __('Bottom', 'wpsm-bbe'),
									)
								),
								'img_gutter'     => array(
									'type'          => 'text',
									'label'         => __('Gutter', 'wpsm-bbe'),
									'placeholder'   => __( '50', 'wpsm-bbe' ),
									'description'	=> '%',
									'maxlength'     => '3',
									'size'          => '6',
									'help'			=> __( 'Increse / Decrease Gutter to Adjust Image Vertically.')
								),
								'img_lr_position'  => array(
									'type'          => 'select',
									'label'         => __('Image Horizontal Position', 'wpsm-bbe'),
									'default'       => 'left',
									'options'       => array(
										'left'             => __('Left', 'wpsm-bbe'),
										'right'         => __('Right', 'wpsm-bbe'),
									),
									'help'			=> __('Keep below field empty for Center position')
								),
								'img_lr_value'     => array(
									'type'          => 'text',
									'label'         => __('Image Left / Right Value', 'wpsm-bbe'),
									'placeholder'   => __( '50', 'wpsm-bbe' ),
									'maxlength'     => '3',
									'size'          => '6',
									'description'	=> '%',
									'help'			=> __('Keep it empty for Center position')
								),
								'img_width'     => array(
									'type'          => 'text',
									'label'         => __('Image Width', 'wpsm-bbe'),
									'placeholder'   => __( '150', 'wpsm-bbe' ),
									'maxlength'     => '3',
									'size'          => '6',
									'description'	=> 'px'
								),
							)
						),
					)
				);
				$form['tabs']['row_separator_style'] = $row_setting;
			}
			return $form;
		}
	}
	new WPSMRowSettings();
}