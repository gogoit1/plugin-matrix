<?php

/**
 * @class WPSMAnimTextModule
 */
class WPSMAnimTextModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Animated Text', 'wpsm-bbe'),
			'description'   => __('Animated Text Title', 'wpsm-bbe'),
			'category'      => __('Tesseract Designer Plus', 'wpsm-bbe'),
			'dir'           => WPSM_BBE_DIR . 'modules/wpsm-anim-text/',
            'url'           => WPSM_BBE_URL . 'modules/wpsm-anim-text/',
			'partial_refresh'	=> true
		));

		// Register and enqueue your own
        $this->add_js('anim-js', $this->url . 'js/typed.js', array(), '', true);
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSMAnimTextModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'wpsm-bbe'), // Tab title
		'sections'      => array( // Tab Sections
			'anim_text_sec'       => array( // Section
				'title'         => __('Animated Text', 'wpsm-bbe'), // Section Title
				'fields'        => array( // Section Fields
					'anim_text'		=> array(
						'type'			=> 'text',
						'label'			=> __('Animated Text', 'wpsm-bbe'),
						'default'		=> 'Welcome',
						'multiple'		=> true,
						'help'			=> __('Add multiple animated text in new field.','wpsm-bbe')
					),
				)
			),
			'pre_suf_sec'       => array( // Section
				'title'         => __('Animated Text', 'wpsm-bbe'), // Section Title
				'fields'        => array( // Section Fields
					'pre_text'		=> array(
						'type'			=> 'text',
						'label'			=> __('Prefix Text', 'wpsm-bbe'),
						'help'			=> __('Prefix to animated text. It Will not animate.','wpsm-bbe')
					),
					'suf_text'		=> array(
						'type'			=> 'text',
						'label'			=> __('Suffix Text', 'wpsm-bbe'),
						'help'			=> __('Suffix to animated text. It Will not animate.','wpsm-bbe')
					),
				)
			),
		)
	),
	'animation'		=> array(
		'title'			=> __('Animation', 'wpsm-bbe'),
		'sections'		=> array(
			'speed'			 => array(
				'title'		=> __('Animation Speed', 'wpsm-bbe'),
				'fields'	=> array(
					'typeSpeed'        => array(
						'type'          => 'text',
						'label'         => __('Typing Speed', 'wpsm-bbe'),
						'default'       => '150',
						'maxlength'     => '4',
						'size'          => '6',
						'description'   => 'ms',
					),
					'startDelay'        => array(
						'type'          => 'text',
						'label'         => __('Start Delay', 'wpsm-bbe'),
						'default'       => '20',
						'maxlength'     => '4',
						'size'          => '6',
						'description'   => 'ms',
						'help'			=> __('Time before Typing starts','wpsm-bbe')
					),
					'backSpeed'        => array(
						'type'          => 'text',
						'label'         => __('Back Speed', 'wpsm-bbe'),
						'default'       => '50',
						'maxlength'     => '4',
						'size'          => '6',
						'description'   => 'ms',
						'help'			=> __('Backspacing / Deleting character speed','wpsm-bbe')
					),
					'backDelay'        => array(
						'type'          => 'text',
						'label'         => __('Back Delay', 'wpsm-bbe'),
						'default'       => '500',
						'maxlength'     => '4',
						'size'          => '6',
						'description'   => 'ms',
						'help'			=> __('Time before Backspacing / Deleting character','wpsm-bbe')
					),
					'loop'         => array(
						'type'          => 'select',
						'label'         => __('Loop', 'wpsm-bbe'),
						'default'       => 'true',
						'options'       => array(
							'true'         => __( 'True', 'wpsm-bbe' ),
							'false'        => __( 'False', 'wpsm-bbe' ),
						),
						'toggle' 		=> array(
							'true'		=> array(
								'fields'	=> array( 'loopCount'),
							)
						)
					),
					'loopCount'        => array(
						'type'          => 'text',
						'label'         => __('Loop Count', 'wpsm-bbe'),
						'default'       => '',
						'maxlength'     => '4',
						'size'          => '6',
						'help'			=> __('Leave blank for infinite loop','wpsm-bbe')
					),
				)
			),
			'cursor'		 => array(
				'title'		=> __('Cursor Setting'),
				'fields'	=> array(
					'showCursor'         => array(
						'type'          => 'select',
						'label'         => __('Show Cursor', 'wpsm-bbe'),
						'default'       => 'true',
						'options'       => array(
							'true'         => __( 'Show', 'wpsm-bbe' ),
							'false'        => __( 'Hide', 'wpsm-bbe' ),
						),
						'toggle' 		=> array(
							'true'		=> array(
								'fields'	=> array( 'cursorChar', 'blinkCursor'),
							)
						)
					),
					'cursorChar'        => array(
						'type'          => 'text',
						'label'         => __('Cursor Char', 'wpsm-bbe'),
						'default'       => '|',
						'maxlength'     => '1',
						'size'          => '6',
					),
					'blinkCursor'         => array(
						'type'          => 'select',
						'label'         => __('Blink Cursor', 'wpsm-bbe'),
						'default'       => 'true',
						'options'       => array(
							'true'         => __( 'True', 'wpsm-bbe' ),
							'false'        => __( 'False', 'wpsm-bbe' ),
						),
					),
				)
			)			
		)
	),
	'style'			=> array(
		'title'			=> __('Style', 'wpsm-bbe'),
		'sections'		=> array(
			'structure'		 => array(
				'title'		=> __('Structure', 'wpsm-bbe'),
				'fields'	=> array(
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'fl-builder'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'fl-builder'),
							'left'          => __('Left', 'fl-builder'),
							'right'         => __('Right', 'fl-builder')
						),
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-anim-text-wrap',
							'property'		 => 'text-align'
						)
					),
				)
			),
			'anim_text_typo'	=> array(
				'title'		=> __('Animated Text', 'wpsm-bbe'),
				'fields'	=> array(
					'anim_color'	=> array(
						'type'          => 'color',
						'label'         => __('Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true,
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-animated',
							'property'		 => 'color'
						)
					),
				)
			),
			'pre_suf_typo'	=> array(
				'title'		=> __('Prefix - Suffix Text', 'wpsm-bbe'),
				'fields'	=> array(
					'pre_suf_color'	=> array(
						'type'          => 'color',
						'label'         => __('Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true,
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-prefix, .wpsm-suffix',
							'property'		 => 'color'
						)
					),
				)
			),
		)
	),
	'Typograpgy'	=> array(
		'title'			=> __('Typography', 'wpsm-bbe'),
		'sections'		=> array(
			'text_typo'	=> array(
				'title'		=> __('', 'wpsm-bbe'),
				'fields'	=> array(
					'tag'         => array(
						'type'          => 'select',
						'label'         => __('Text HTML Tag', 'fl-builder'),
						'default'       => 'h2',
						'options'       => array(
							'h1'        => __('H1', 'fl-builder'),
							'h2'        => __('H2', 'fl-builder'),
							'h3'        => __('H3', 'fl-builder'),
							'h4'        => __('H4', 'fl-builder'),
							'h5'        => __('H5', 'fl-builder'),
							'h6'        => __('H6', 'fl-builder'),
						)
					),
					'font_family' => array(
					    'type'          => 'font',
					    'label'         => __( 'Font', 'fl-builder' ),
					    'default'       => array(
					        'family'        => 'Default',
					        'weight'        => 'Default'
					    ),
					    'preview'         => array(
							'type'            => 'font',
							'selector'        => '.wpsm-anim-text-wrap'
						)
					),
					'font_size'     => array(
						'type'          => 'text',
						'label'         => __('Font Size', 'fl-builder'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '6',
						'description'   => 'px',
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-anim-text-wrap',
							'property'       => 'font-size',
							'unit'			 => 'px'	
						)
					),
					'line_height'     => array(
						'type'          => 'text',
						'label'         => __('Line Height', 'fl-builder'),
						'default'       => '',
						'maxlength'     => '3',
						'size'          => '6',
						'description'   => 'px',
						'preview'         => array(
							'type'           => 'css',
							'selector'       => '.wpsm-anim-text-wrap',
							'property'       => 'line-height',
							'unit'			 => 'px'	
						)
					),
				)
			),
		)
	)
));