<?php

/**
 * @class WPSMHeadingModule
 */
class WPSMHeadingModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Heading Fun', 'wpsm-bbe'),
			'description'   => __('Heading with Seperator', 'wpsm-bbe'),
			'category'      => __('Tesseract Designer Plus', 'wpsm-bbe'),
			'dir'           => WPSM_BBE_DIR . 'modules/wpsm-heading/',
            'url'           => WPSM_BBE_URL . 'modules/wpsm-heading/',
   			'partial_refresh'	=> true
		));
	}

	/**
	 * Render Divider.
	 */
	public function render_divider( $pos ){

		if ( $this->settings->border_pos == $pos ) { 
			$wpsm_html = '<div class="wpsm-heading-spacer">';
			$wpsm_html .= '<span class="wpsm-headings-line"></span>';
			$wpsm_html .= '</div>';
			echo $wpsm_html;
		} 

	}
}

	
/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSMHeadingModule', array(
	'general'       => array(
		'title'         => __('General', 'wpsm-bbe'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'heading'        => array(
						'type'            => 'text',
						'label'           => __('Heading', 'wpsm-bbe'),
						'default'         => '',
						'preview'         => array(
							'type'            => 'text',
							'selector'        => '.wpsm-heading-text'
						)
					),
					'sub_heading'        => array(
						'type'            => 'text',
						'label'           => __('Sub Heading', 'wpsm-bbe'),
						'default'         => '',
					),
				)
			),
			'border'		=> array(
				'title'			=> __('Border Setting', 'wpsm-bbe' ),
				'fields'		=> array(
					'border_pos'   => array(
						'type'          => 'select',
						'label'         => __('Border Position', 'wpsm-bbe'),
						'default'       => 'no',
						'options'       => array(
							'no'         => __('No', 'wpsm-bbe'),
							'below_heading'     => __('Below Heading', 'wpsm-bbe'),
							'above_heading'		=> __('Above Heading', 'wpsm-bbe'),
							//'in_heading'        => __('Heading with Border', 'wpsm-bbe')
						),
						'toggle'        => array(
					        'above_heading'      => array(
					            'fields'	=> array( 'border_style', 'border_height', 'border_width', 'border_color', 'border_alignment' ),
					        ),
					        'below_heading'      => array(
					            'fields'	=> array( 'border_style', 'border_height', 'border_width', 'border_color', 'border_alignment' ),
					        ),
					    )
					),
					'border_style'         => array(
						'type'          => 'select',
						'label'         => __('Border Style', 'wpsm-bbe'),
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
					),
					'border_height'        => array(
						'type'          => 'text',
						'label'         => __('Border Height', 'wpsm-bbe'),
						'default'       => '1',
						'maxlength'     => '2',
						'size'          => '6',
						'description'   => 'px',
					),
					'border_width'        => array(
						'type'          => 'text',
						'label'         => __('Width', 'wpsm-bbe'),
						'default'       => '100',
						'maxlength'     => '3',
						'size'          => '6',
						'description'   => 'px',
					),
					'border_color'          => array(
						'type'          => 'color',
						'show_reset'    => true,
						'label'         => __('Border Color', 'wpsm-bbe')
					),
					'border_alignment'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'wpsm-bbe'),
						'default'       => 'center',
						'options'       => array(
							'center'         => __( 'Center', 'wpsm-bbe' ),
							'left'        => __( 'Left', 'wpsm-bbe' ),
							'right'        => __( 'Right', 'wpsm-bbe' ),
						),
					),
					'border_top_space'        => array(
						'type'          => 'text',
						'label'         => __('Divider Top Margin', 'wpsm-bbe'),
						'default'       => '10',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
					),
					'border_bottom_space'        => array(
						'type'          => 'text',
						'label'         => __('Divider Bottom Margin', 'wpsm-bbe'),
						'default'       => '10',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
					),
				)
			),
		)
	),
	'style'         => array(
		'title'         => __('Style', 'wpsm-bbe'),
		'sections'      => array(
			'text_style'	=> array(
				'title'		 => __( 'Heading Structure', 'wpsm-bbe' ),
				'fields'	 => array(
					'text_alignment'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'wpsm-bbe'),
						'default'       => 'center',
						'options'       => array(
							'center'         => __( 'Center', 'wpsm-bbe' ),
							'left'        => __( 'Left', 'wpsm-bbe' ),
							'right'        => __( 'Right', 'wpsm-bbe' ),
						),
					),
				)
			),
			'heading_spacing'	=> array(
				'title'	=> __('Heading Spacing', 'wpsm-bbe' ),
				'fields'	=> array(
					'head_top_space'        => array(
						'type'          => 'text',
						'label'         => __('Heading Top Margin', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '6',
						'placeholder'	=> '0',
						'description'   => 'px',
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-heading-text',
							'property'		 => 'margin-top',
							'unit'			 => 'px' 
						)
					),
					'head_bottom_space'        => array(
						'type'          => 'text',
						'label'         => __('Heading Bottom Spacing', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '6',
						'placeholder'	=> '0',
						'description'   => 'px',
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-heading-text',
							'property'		 => 'margin-bottom',
							'unit'			 => 'px' 
						)
					),
				)
			),
			'subheading_spacing'	=> array(
				'title'	=> __('Sub-Heading Spacing', 'wpsm-bbe' ),
				'fields'	=> array(
					'subhead_top_space'        => array(
						'type'          => 'text',
						'label'         => __('Sub-Heading Top Margin', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '6',
						'placeholder'	=> '0',
						'description'   => 'px',
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-subheading-text',
							'property'		 => 'margin-top',
							'unit'			 => 'px' 
						)
					),
					'subhead_bottom_space'        => array(
						'type'          => 'text',
						'label'         => __('Sub-Heading Bottom Spacing', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '6',
						'placeholder'	=> '0',
						'description'   => 'px',
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-subheading-text',
							'property'		 => 'margin-bottom',
							'unit'			 => 'px' 
						)
					),
				)
			),
			'colors'		=> array(
				'title'         => __('Colors', 'wpsm-bbe'),
				'fields'        => array(
					'heading_color'          => array(
						'type'          => 'color',
						'show_reset'    => true,
						'label'         => __('Heading Color', 'wpsm-bbe'),
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-heading-text',
							'property'		 => 'color',
						)
					),
					'subheading_color'          => array(
						'type'          => 'color',
						'show_reset'    => true,
						'label'         => __('Sub Heading Color', 'wpsm-bbe'),
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-subheading-text',
							'property'		 => 'color',
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
												'selector'        => '.wpsm-heading-text'
											)
										)
									)
								)	
			),
			'subheading_typo'	=> array(
				'title'		 => __('Sub Heading', 'wpsm-bbe' ),
				'fields'	 => wpsmHelp::wpsm_pull_typo( 'sub',
									array( 
										'tag'	=> array(
											'default'   => 'h4',
										),
										'font' => array(
											'preview'         => array(
												'type'            => 'font',
												'selector'        => '.wpsm-subheading-text'
											)
										)
									) 
								)	
			),
			/*'colors'        => array(
				'title'         => __('Colors', 'wpsm-bbe'),
				'fields'        => array(
					'color'          => array(
						'type'          => 'color',
						'show_reset'    => true,
						'label'         => __('Text Color', 'wpsm-bbe')
					),
				)
			),
			'structure'     => array(
				'title'         => __('Structure', 'wpsm-bbe'),
				'fields'        => array(
					'alignment'     => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'wpsm-bbe'),
						'default'       => 'left',
						'options'       => array(
							'left'      =>  __('Left', 'wpsm-bbe'),
							'center'    =>  __('Center', 'wpsm-bbe'),
							'right'     =>  __('Right', 'wpsm-bbe')
						),
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.fl-heading',
							'property'        => 'text-align'
						)
					),
					'tag'           => array(
						'type'          => 'select',
						'label'         => __( 'HTML Tag', 'wpsm-bbe' ),
						'default'       => 'h3',
						'options'       => array(
							'h1'            =>  'h1',
							'h2'            =>  'h2',
							'h3'            =>  'h3',
							'h4'            =>  'h4',
							'h5'            =>  'h5',
							'h6'            =>  'h6'
						)
					),
					'font'          => array(
						'type'          => 'font',
						'default'		=> array(
							'family'		=> 'Default',
							'weight'		=> 300
						),
						'label'         => __('Font', 'wpsm-bbe'),
						'preview'         => array(
							'type'            => 'font',
							'selector'        => '.fl-heading-text'
						)					
					),
					'font_size'     => array(
						'type'          => 'select',
						'label'         => __('Font Size', 'wpsm-bbe'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'wpsm-bbe'),
							'custom'        =>  __('Custom', 'wpsm-bbe')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('custom_font_size')
							)
						)
					),
					'custom_font_size' => array(
						'type'          => 'text',
						'label'         => __('Custom Font Size', 'wpsm-bbe'),
						'default'       => '24',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			),
			'r_structure'   => array(
				'title'         => __( 'Mobile Structure', 'wpsm-bbe' ),
				'fields'        => array(
					'r_alignment'   => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'wpsm-bbe'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'wpsm-bbe'),
							'custom'        =>  __('Custom', 'wpsm-bbe')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('r_custom_alignment')
							)
						),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'r_custom_alignment' => array(
						'type'          => 'select',
						'label'         => __('Custom Alignment', 'wpsm-bbe'),
						'default'       => 'center',
						'options'       => array(
							'left'      =>  __('Left', 'wpsm-bbe'),
							'center'    =>  __('Center', 'wpsm-bbe'),
							'right'     =>  __('Right', 'wpsm-bbe')
						),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'r_font_size'   => array(
						'type'          => 'select',
						'label'         => __('Font Size', 'wpsm-bbe'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'wpsm-bbe'),
							'custom'        =>  __('Custom', 'wpsm-bbe')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('r_custom_font_size')
							)
						),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'r_custom_font_size' => array(
						'type'          => 'text',
						'label'         => __('Custom Font Size', 'wpsm-bbe'),
						'default'       => '24',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'         => array(
							'type'            => 'none'
						)
					)
				)
			)*/
		)
	)
));