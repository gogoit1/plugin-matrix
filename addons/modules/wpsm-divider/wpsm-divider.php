<?php

/**
 * @class WPSMDividerModule
 */
class WPSMDividerModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Classic Divider', 'wpsm-bbe'),
			'description'   => __('A horizontal line to separate content.', 'wpsm-bbe'),
			'category'      => __('Tesseract Designer Plus', 'wpsm-bbe'),
			'dir'           => WPSM_BBE_DIR . 'modules/wpsm-divider/',
            'url'           => WPSM_BBE_URL . 'modules/wpsm-divider/',
			'editor_export' => false
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSMDividerModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'wpsm-bbe'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'color'         => array(
						'type'          => 'color',
						'label'         => __('Color', 'wpsm-bbe'),
						'default'       => 'cccccc',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-divider',
							'property'      => 'border-top-color'
						)
					),
					'opacity'    => array(
						'type'          => 'text',
						'label'         => __('Opacity', 'wpsm-bbe'),
						'default'       => '100',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-divider',
							'property'      => 'opacity',
							'unit'          => '%'
						)
					),
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'wpsm-bbe'),
						'default'       => '1',
						'maxlength'     => '2',
						'size'          => '3',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-divider',
							'property'      => 'border-top-width',
							'unit'          => 'px'
						)
					),
					'style'         => array(
						'type'          => 'select',
						'label'         => __('Style', 'wpsm-bbe'),
						'default'       => 'solid',
						'options'       => array(
							'solid'         => _x( 'Solid', 'Border type.', 'wpsm-bbe' ),
							'dashed'        => _x( 'Dashed', 'Border type.', 'wpsm-bbe' ),
							'dotted'        => _x( 'Dotted', 'Border type.', 'wpsm-bbe' ),
							'double'        => _x( 'Double', 'Border type.', 'wpsm-bbe' ),
							'groove'        => _x( 'Groove', 'Border type.', 'wpsm-bbe' ),
							'ridge'        => _x( 'Ridge', 'Border type.', 'wpsm-bbe' ),
							'inset'        => _x( 'Inset', 'Border type.', 'wpsm-bbe' ),
							'outset'        => _x( 'Outset', 'Border type.', 'wpsm-bbe' )
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-divider',
							'property'      => 'border-top-style'
						),
					)
				)
			),
			'other'       => array( // Section
				'title'         => 'Other Options', // Section Title
				'fields'        => array( // Section Fields
					'width'        => array(
						'type'          => 'text',
						'label'         => __('Width', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => '%',
					),
					'alignment'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'wpsm-bbe'),
						'default'       => 'center',
						'options'       => array(
							'center'         => __( 'Center', 'wpsm-bbe' ),
							'left'        => __( 'Left', 'wpsm-bbe' ),
							'right'        => __( 'Right', 'wpsm-bbe' ),
						),
						/*'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-divider',
							'property'      => 'float'
						),*/
					),
					'top_space'        => array(
						'type'          => 'text',
						'label'         => __('Top Spacing', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-divider-wrap',
							'property'      => 'margin-top',
							'unit'          => 'px'
						)
					),
					'bottom_space'        => array(
						'type'          => 'text',
						'label'         => __('Bottom Spacing', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-divider-wrap',
							'property'      => 'margin-bottom',
							'unit'          => 'px'
						)
					),
				)
			)
		)
	)
));