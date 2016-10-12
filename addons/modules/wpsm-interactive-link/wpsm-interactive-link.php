<?php

/**
 * @class WPSMInteractiveLinkModule
 */
class WPSMInteractiveLinkModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Interactive Link', 'wpsm-bbe'),
			'description'   	=> __('Stylish Amazing Effects for Links or Menu Items.', 'wpsm-bbe'),
			'category'      	=> __('Tesseract Designer Plus', 'wpsm-bbe'),
			'dir'           	=> WPSM_BBE_DIR . 'modules/wpsm-interactive-link/',
            'url'           	=> WPSM_BBE_URL . 'modules/wpsm-interactive-link/',
			'partial_refresh'	=> true
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSMInteractiveLinkModule', array(
	'items'         => array(
		'title'         => __('Menu Items', 'wpsm-bbe'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'items'         => array(
						'type'          => 'form',
						'label'         => __('Link', 'wpsm-bbe'),
						'form'          => 'menu_items_form', // ID from registered form below
						'preview_text'  => 'link_text', // Name of a field to use for the preview text
						'multiple'      => true
					)
				)
			)
		)
	),
	'style'        => array(
		'title'         => __('Style', 'wpsm-bbe'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'il_style'         => array(
						'type'          => 'select',
						'label'         => __('Link Effect', 'wpsm-bbe'),
						'default'       => 'effect-a',
						'options'       => array(
							'effect-a'		=> __( 'Effect A', 'wpsm-bbe' ),
							'effect-b'		=> __( 'Effect B', 'wpsm-bbe' ),
							'effect-c'		=> __( 'Effect C', 'wpsm-bbe' ),
							'effect-d'		=> __( 'Effect D', 'wpsm-bbe' ),
							'effect-e'		=> __( 'Effect E', 'wpsm-bbe' ),
							'effect-f'		=> __( 'Effect F', 'wpsm-bbe' ),
							'effect-g'		=> __( 'Effect G', 'wpsm-bbe' ),
							'effect-h'		=> __( 'Effect H', 'wpsm-bbe' ),
							'effect-i'		=> __( 'Effect I', 'wpsm-bbe' ),
							'effect-j'		=> __( 'Effect J', 'wpsm-bbe' ),
							'effect-k'		=> __( 'Effect K', 'wpsm-bbe' ),
						),
						'toggle'        => array(
					        'effect-a'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color' ),
					        ),
					        'effect-b'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'txt_hover_color', 'bg_color', 'bg_hover_color' ),
					        ),
					        'effect-c'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'border_hover_color' ),
					        ),
					        'effect-d'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'border_hover_color' ),
					        ),
					        'effect-e'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'border_color' ),
					        ),
					        'effect-f'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'border_color' ),
					        ),
					        'effect-g'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'border_color', 'border_hover_color' ),
					        ),
					        'effect-h'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'txt_hover_color', 'bg_color', 'bg_hover_color' ),
					        ),
					        'effect-i'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'txt_hover_color', 'border_hover_color' ),
					        ),
					        'effect-j'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'txt_hover_color', 'bg_color', 'bg_hover_color' ),
					        ),
					        'effect-k'      => array(
					            'sections'	=> array( 'colors' ),
					            'fields'	=> array( 'txt_color', 'txt_hover_color', 'border_hover_color' ),
					        ),
					    )
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'wpsm-bbe'),
						'default'       => 'left',
						'options'       => array(
							'left'			=> __( 'Left', 'wpsm-bbe' ),
							'center'		=> __( 'Center', 'wpsm-bbe' ),
							'right'			=> __( 'Right', 'wpsm-bbe' ),
						),
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.wpsm-ilink-wrap',
							'property'		=> 'text-align'
						)
					),
					'item_spacing'     => array(
						'type'          => 'text',
						'label'         => __('Item Spacing', 'wpsm-bbe'),
						'default'       => '',
						'placeholder'	=> '10',
						'maxlength'     => '2',
						'size'          => '3',
						'description'   => 'px',
						'preview'       => array(
					        'type'          => 'css',
					        'rules'			=> array(
					            array(
					                'selector'     	=> '.wpsm-ilink-wrap a',
					                'property'		=> 'margin-left',
					                'unit'			=> 'px'
					            ),
					            array(
					                'selector'     	=> '.wpsm-ilink-wrap a',
					                'property'     	=> 'margin-right',
					                'unit'			=> 'px'
					            ),    
					        )
					    )
					),
				)
			),
			'colors'		=> array(
				'title'         => __('Colors', 'wpsm-bbe'),
				'fields'		=> array(
					'txt_color'  => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'wpsm-bbe'),
						'default'       => '',
						'show_reset'	=> true
					),
					'txt_hover_color'  => array(
						'type'          => 'color',
						'label'         => __('Text Hover Color', 'wpsm-bbe'),
						'default'       => '',
						'show_reset'	=> true,
						'preview'		=> array(
							'type'	=> 'none'
						)
					),
					'bg_color'  => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'wpsm-bbe'),
						'default'       => '',
						'show_reset'	=> true
					),
					'bg_hover_color'  => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'wpsm-bbe'),
						'default'       => '',
						'show_reset'	=> true,
						'preview'		=> array(
							'type'	=> 'none'
						)
					),
					'border_color'  => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'wpsm-bbe'),
						'default'       => '',
						'show_reset'	=> true
					),
					'border_hover_color'  => array(
						'type'          => 'color',
						'label'         => __('Border Hover Color', 'wpsm-bbe'),
						'default'       => '',
						'show_reset'	=> true,
						'preview'		=> array(
							'type'	=> 'none'
						)
					),
				)
			)
		)
	),
	'typography'         => array(
		'title'         => __('Typography', 'wpsm-bbe'),
		'sections'      => array(
			'heading_typo'	=> array(
				'title'		 => __('Heading', 'wpsm-bbe' ),
				'fields'	 => wpsmHelp::wpsm_pull_typo( '',
									array(
										'font' => array(
											'preview'         => array(
												'type'            => 'font',
												'selector'        => '.wpsm-ilink-wrap a, .wpsm-ilink-wrap a span'
											)
										)
									),
									array('tag')
								)	
			),
		)
	)
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('menu_items_form', array(
	'title' => __('Add Link', 'wpsm-bbe'),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'wpsm-bbe'),
			'sections'      => array(
				'general'       => array(
					'title'         => '',
					'fields'        => array(
						'link_text'         => array(
							'type'          => 'text',
							'label'         => __('Link Text', 'wpsm-bbe')
						),
						'link'          => array(
							'type'          => 'link',
							'label'         => __('Link', 'fl-builder'),
							'placeholder'   => __( 'http://www.example.com', 'fl-builder' ),
							'preview'       => array(
								'type'          => 'none'
							)
						),
						'link_target'   => array(
							'type'          => 'select',
							'label'         => __('Link Target', 'fl-builder'),
							'default'       => '_self',
							'options'       => array(
								'_self'         => __('Same Window', 'fl-builder'),
								'_blank'        => __('New Window', 'fl-builder')
							),
							'preview'       => array(
								'type'          => 'none'
							)
						)
					)
				),
			)
		)
	)
));