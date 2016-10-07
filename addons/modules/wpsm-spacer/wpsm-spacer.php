<?php

/**
 * @class WPSMSpacerModule
 */
class WPSMSpacerModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Classic Spacer', 'wpsm-bbe'),
			'description'   => __('Show Spacing with Responsvie Options ', 'wpsm-bbe'),
			'category'      => __('Tesseract Designer Plus', 'wpsm-bbe'),
			'dir'           => WPSM_BBE_DIR . 'modules/wpsm-spacer/',
            'url'           => WPSM_BBE_URL . 'modules/wpsm-spacer/',
			'editor_export' => false
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSMSpacerModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'wpsm-bbe'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => 'Spacing', // Section Title
				'fields'        => array( // Section Fields
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'wpsm-bbe'),
						'default'       => '30',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px',
						'help'			=> __('Spacing size', 'wpsm-bbe'),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.wpsm-spacer-gap',
							'property'      => 'height',
							'unit'          => 'px'
						)
					),
					'medium_height'        => array(
						'type'          => 'text',
						'label'         => __('Medium Device Height', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px',
						'help'			=> __('Spacing size for small devices. It will apply as per Global-Setting -> Medium-Breakpoints', 'wpsm-bbe'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'small_height'        => array(
						'type'          => 'text',
						'label'         => __('Small Device Height', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px',
						'help'			=> __('Spacing size for small devices. It will apply as per Global-Setting -> Small-Breakpoints', 'wpsm-bbe'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					
				)
			),
		)
	)
));