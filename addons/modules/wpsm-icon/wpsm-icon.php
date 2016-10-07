<?php

/**
 * @class WPSMIconModule
 */
class WPSMIconModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Simple Icon', 'wpsm-bbe'),
			'description'   => __('Display an icon and optional title.', 'wpsm-bbe'),
			'category'      => __('Tesseract Designer Plus', 'wpsm-bbe'),
			'dir'           => WPSM_BBE_DIR . 'modules/wpsm-icon/',
            'url'           => WPSM_BBE_URL . 'modules/wpsm-icon/',
			'editor_export' => false
		));
	}

	public function renderIcon( $pos )
	{
		if ( $this->settings->icon_position == $pos ) {
			
			$output = '<span class="wpsm-icon">';
			if( !empty($this->settings->link) ) {
				$output .= '<a href="'.$this->settings->link.'" target="'.$this->settings->link_target.'">';
			}
			
			$output .= '<i class="'.$this->settings->icon.'"></i>';

			if( !empty($this->settings->link) ) {
				$output .= '</a>';
			}
			$output .= '</span>';

			return $output;
		}
		return false;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSMIconModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'wpsm-bbe'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         =>  __('Icon', 'wpsm-bbe'), // Section Title
				'fields'        => array( // Section Fields
					'icon_type'   => array(
						'type'          => 'select',
						'label'         => __('Icon Type', 'wpsm-bbe'),
						'default'       => 'icon_only',
						'options'       => array(
							'icon_only'		=> __('Simple Icon', 'wpsm-bbe'),
							'icon_text'		=> __('Icon with Text', 'wpsm-bbe')
						),
						'toggle' 		=> array(
							'icon_only'		=> array(
								'fields'	=> array( 'align' ),
							),
							'icon_text'		=> array(
								'fields'	=> array( 'icon_position' ),
								'sections'	=> array( 'text' )
							),
						)
					),
					'icon_position'   => array(
						'type'          => 'select',
						'label'         => __('Icon Postion', 'wpsm-bbe'),
						'default'       => 'before',
						'options'       => array(
							'before'		=> __('Before Text', 'wpsm-bbe'),
							'after'		=> __('After Text', 'wpsm-bbe')
						),
					),
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'wpsm-bbe')
					)
				)
			),
			'link'          => array(
				'title'         => 'Link',
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'wpsm-bbe'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'wpsm-bbe'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'wpsm-bbe'),
							'_blank'        => __('New Window', 'wpsm-bbe')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'text'          => array(
				'title'         => 'Text',
				'fields'        => array(
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false
					)
				)
			)
		)
	),
	'style'         => array( // Tab
		'title'         => __('Style', 'wpsm-bbe'), // Tab title
		'sections'      => array( // Tab Sections
			'structure'     => array( // Section
				'title'         => __('Structure', 'wpsm-bbe'), // Section Title
				'fields'        => array( // Section Fields
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'wpsm-bbe'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'wpsm-bbe'),
							'left'          => __('Left', 'wpsm-bbe'),
							'right'         => __('Right', 'wpsm-bbe')
						)
					),
					'iconStyle'         => array(
						'type'          => 'select',
						'label'         => __('Icon Style', 'wpsm-bbe'),
						'default'       => 'none',
						'options'       => array(
							'none'        => __('None', 'wpsm-bbe'),
							'circle'          => __('Circle', 'wpsm-bbe'),
							'square'         => __('Square', 'wpsm-bbe'),
							'custom'         => __('Custom', 'wpsm-bbe'),
						),
						'toggle'		=> array(
							'circle'		=> array(
								'fields'		=> array( 'bg_size', 'border', 'border_width','bg_color', 'bg_hover_color', 'border_color', 'border_hover_color', 'three_d' ),
							),
							'square'		=> array(
								'fields'		=> array( 'bg_size', 'border', 'border_width','bg_color', 'bg_hover_color', 'border_color', 'border_hover_color', 'three_d' ),
							),
							'custom'		=> array(
								'fields'		=> array( 'bg_size', 'border', 'border_width', 'border_radius','bg_color', 'bg_hover_color', 'border_color', 'border_hover_color', 'three_d' ),
							),
						)
					),
					'size'          => array(
						'type'          => 'text',
						'label'         => __('Icon Size', 'wpsm-bbe'),
						'default'       => '30',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'bg_size'          => array(
						'type'          => 'text',
						'label'         => __('Icon Background Size', 'wpsm-bbe'),
						'default'       => '60',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'border'		=> array(
						'type'          => 'select',
						'label'         => __('Icon Border Style', 'wpsm-bbe'),
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
						'help'			=> __( 'Set Border width 0 to set border style none', 'wpsm-bbe' )
						/*'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-divider',
							'property'      => 'border-top-style'
						),*/
					),
					'border_width'        => array(
						'type'          => 'text',
						'label'         => __('Icon Border Width', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '6',
						'description'   => 'px',
						'help'			=> __( 'Set Border width 0 to set border style none', 'wpsm-bbe' )
					),
					'border_radius'        => array(
						'type'          => 'text',
						'label'         => __('Icon Border Radius', 'wpsm-bbe'),
						'default'       => '0',
						'maxlength'     => '3',
						'size'          => '6',
						'description'   => 'px',
					),
				)
			),
			'colors'        => array( // Section
				'title'         => __('Colors', 'wpsm-bbe'), // Section Title
				'fields'        => array( // Section Fields
					'color'         => array(
						'type'          => 'color',
						'label'         => __('Color', 'wpsm-bbe'),
						'show_reset'    => true
					),
					'hover_color' => array(
						'type'          => 'color',
						'label'         => __('Hover Color', 'wpsm-bbe'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'wpsm-bbe'),
						'show_reset'    => true
					),
					'bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'wpsm-bbe'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'border_color'      => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'wpsm-bbe'),
						'show_reset'    => true
					),
					'border_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Border Hover Color', 'wpsm-bbe'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'three_d'       => array(
						'type'          => 'select',
						'label'         => __('Gradient', 'wpsm-bbe'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'wpsm-bbe'),
							'1'             => __('Yes', 'wpsm-bbe')
						)
					)
				)
			),
		)
	)
));