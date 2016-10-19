<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



/**

 * Active callback functions.

 */

function tesseract_footer_button_textarea_enable() {



	$textarea_enable = get_theme_mod( 'tesseract_footer_right_content' );

	$bool = ( $textarea_enable == 'html' ) ? true : false;

	return true;

	return $bool;



}



function tesseract_footer_right_menu_select_enable() {



	$select_enable = get_theme_mod( 'tesseract_footer_right_content' );

	$bool = ( $select_enable == 'menu' ) ? true : false;

	return true;

	return $bool;



}



if ( class_exists( 'WP_Customize_Control' )  && !class_exists( 'Tesseract_Customize_Footer_Control' ) ) :



    class Tesseract_Customize_Footer_Control extends WP_Customize_Control {



        public function render_content() {



            $allowed_html = array(

                'a' => array(

                    'href' => array(),

                    'title' => array()

                ),

                'br' => array(),

                'em' => array(),

                'strong' => array(),

            ); ?>



			<h4><?php echo wp_kses( $this->label, $allowed_html ); ?></h4>

             <span class="description"><?php echo wp_kses( $this->description, $allowed_html ); ?></span>



<?php

        }

    }



endif;



/**

 * Tesseract Remove Branding Customizer.

 *

 * @package  Tesseract_Remove_Branding/Customizer

 * @category Class

 * @autfor Tesseract Theme

 */

class Tesseract_Remove_Branding_Customizer {



	/**

	 * Section slug.

	 *

	 * @var string

	 */

	public $section_slug = 'tesseract_footer_right';

	public $section_slug_centre = 'tesseract_footer_centre';



	/**

	 * Initialize the customize actions.

	 */

	public function __construct() {

		add_action( 'customize_register', array( $this, 'register_settings' ), 11 );

		add_action( 'customize_preview_init', array( $this, 'live_preview' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_style' ), 20 );

		add_action( 'wp_enqueue_scripts', array( $this, 'backend_style' ), 20 );



		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_controls_javascript' ) );

	}



	/**

	 * Register the customizer settings.

	 *

	 * @param \WP_Customize_Manager $wp_customize

	 */

	public function register_settings( $wp_customize ) {

		$footer_content_section = $wp_customize->get_section( 'tesseract_footer_content' );

		if ( ! empty( $footer_content_section ) ) {

			$wp_customize->get_section('tesseract_footer_content')->title = __( 'Footer Left Block Content', 'tesseract-remove-branding' );

		}

		/*$wp_customize->add_section( $this->section_slug_centre, array(

			'title'      => __('Footer Centre Block Content', 'tesseract-remove-branding'),

			'priority'   => 6,

			'panel'      => 'tesseract_footer_options'

		) );



			$wp_customize->add_setting( $this->section_slug_centre . '_content_header', array(

				'default'           => '',

				'type'           	=> 'option',

				'transport'         => 'refresh',

				'sanitize_callback' => '__return_false'

				)

			);



				$wp_customize->add_control(

					new Tesseract_Customize_Footer_Control(

					$wp_customize,

					$this->section_slug_centre . '_content_header_control',

					array(

						'label' =>  __('Choose the content to be displayed in the centre block of the footer area', 'tesseract-remove-branding' ),

						'section' => $this->section_slug_centre,

						'settings' => $this->section_slug_centre . '_content_header',

						'priority' => 	1

						)

					)

				);
				$wp_customize->add_setting( $this->section_slug_centre . '_content', array(

					'default'			=> 'html'

			) );



			$choices = array(

				'nothing' 	 => __( 'Nothing', 'tesseract-remove-branding' ),

				'html' 	 => __( 'HTML', 'tesseract-remove-branding' ),

				'social'     => __( 'Social Icons', 'tesseract-remove-branding' ),

				'search' 	 => __( 'Search Bar', 'tesseract-remove-branding' )

			);


				$wp_customize->add_control(

					new WP_Customize_Control(

						$wp_customize,

						$this->section_slug_centre . '_content_control',

						array(

							'section'        => $this->section_slug_centre,

							'settings'       => $this->section_slug_centre . '_content',

							'type'           => 'radio',

							'choices' 		 => $choices,

							'priority' 		 => 2

						)

					)

				);



			$default_html = '<strong>Theme by <a href="http://tesseracttheme.com">Tesseract</a></strong>

                        &nbsp;&nbsp;

                        <strong>

                        	<a href="http://tesseracttheme.com">

                        		<img src="http://tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />

                            </a>

                        </strong>';



			$wp_customize->add_setting( $this->section_slug_centre . '_content_html', array(

				'sanitize_callback' => 'tesseract_sanitize_textarea_html',

				'default' 			=> $default_html

			) );



				$wp_customize->add_control(

					new WP_Customize_Control(

						$wp_customize,

						$this->section_slug_centre . '_content_control_type_html',

						array(

							'label'          => __( 'HTML', 'tesseract-remove-branding' ),

							'section'        => $this->section_slug_centre,

							'settings'       => $this->section_slug_centre . '_content_html',

							'type'           => 'textarea',

							'priority' 		 => 4,

						)

					)

				);*/


		$wp_customize->add_section( $this->section_slug, array(

			'title'      => __('Footer Right Block Content', 'tesseract-remove-branding'),

			'priority'   => 7,

			'panel'      => 'tesseract_footer_options'

		) );



			$wp_customize->add_setting( $this->section_slug . '_content_header', array(

				'default'           => '',

				'type'           	=> 'option',

				'transport'         => 'refresh',

				'sanitize_callback' => '__return_false'

				)

			);



				$wp_customize->add_control(

					new Tesseract_Customize_Footer_Control(

					$wp_customize,

					$this->section_slug . '_content_header_control',

					array(

						'label' =>  __('Choose the content to be displayed in the right block of the footer area', 'tesseract-remove-branding' ),

						'section' => $this->section_slug,

						'settings' => $this->section_slug . '_content_header',

						'priority' => 	1

						)

					)

				);



			$wp_customize->add_setting( $this->section_slug . '_content', array(

					'default'			=> 'html'

			) );



			$choices = array(

				'nothing' 	 => __( 'Nothing', 'tesseract-remove-branding' ),

				'html' 	 => __( 'HTML', 'tesseract-remove-branding' ),

				'social'     => __( 'Social Icons', 'tesseract-remove-branding' ),

				'search' 	 => __( 'Search Bar', 'tesseract-remove-branding' )

			);



			if ( defined( 'TESSERACT_RB_THEME_VERSION' ) && is_numeric( TESSERACT_RB_THEME_VERSION ) ) {

				if ( TESSERACT_RB_THEME_VERSION >= 2 ) {

					// Only allow menu to be chosen on version 2

					$choices['menu'] = __( 'Menu', 'tesseract-remove-branding' );

				}

			}



				$wp_customize->add_control(

					new WP_Customize_Control(

						$wp_customize,

						$this->section_slug . '_content_control',

						array(

							'section'        => $this->section_slug,

							'settings'       => $this->section_slug . '_content',

							'type'           => 'radio',

							'choices' 		 => $choices,

							'priority' 		 => 2

						)

					)

				);



			$default_html = '<strong>Theme by <a href="http://tesseracttheme.com">Tesseract</a></strong>

                        &nbsp;&nbsp;

                        <strong>

                        	<a href="http://tesseracttheme.com">

                        		<img src="http://tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />

                            </a>

                        </strong>';



			$wp_customize->add_setting( $this->section_slug . '_content_html', array(

				'sanitize_callback' => 'tesseract_sanitize_textarea_html',

				'default' 			=> $default_html

			) );



				$wp_customize->add_control(

					new WP_Customize_Control(

						$wp_customize,

						$this->section_slug . '_content_control_type_html',

						array(

							'label'          => __( 'HTML', 'tesseract-remove-branding' ),

							'section'        => $this->section_slug,

							'settings'       => $this->section_slug . '_content_html',

							'type'           => 'textarea',

							'priority' 		 => 4,

						)

					)

				);



		$footer_right_content_menu_selector_menus = get_terms( 'nav_menu' );



		if ( empty( $footer_right_content_menu_selector_menus ) ) {

			$footer_right_content_menu_selector_items = array( 'none' => "You haven't made any menus!" );

		} else {

			$footer_right_content_menu_selector_items = array();

			$item_keys = array( 'none' ); $item_values = array( '' );

			foreach ( $footer_right_content_menu_selector_menus as $items ) {

				array_push( $item_keys, $items->slug);

				array_push( $item_values, $items->name);

			}



			$footer_right_content_menu_selector_items = array_combine( $item_keys, $item_values );

		}



		$wp_customize->add_setting( $this->section_slug .'_menu_select', array(

			'sanitize_callback' => 'tesseract_sanitize_select',

			'default' 			=> 'none'

		) );



			$wp_customize->add_control(

				new WP_Customize_Control(

					$wp_customize,

					$this->section_slug . '_content_control_type_menu',

					array(

						'label'          => __( 'Select menu', 'tesseract-remove-branding' ),

						'section'        => $this->section_slug,

						'settings'       => $this->section_slug . '_menu_select',

						'type'           => 'select',

						'choices'        => $footer_right_content_menu_selector_items,

						'priority' 		 => 5,

						'active_callback' 	=> $this->section_slug .'_menu_select_enable'

					)

				)

			);



	}



	/**

	 * Customizer live preview.

	 */

	public function live_preview() {



		wp_enqueue_script( 'tesseract-remove-branding-customizer', Tesseract_Remove_Branding::get_assets_url() . 'js/tesseract-remove-branding-customizer.js', array( 'jquery', 'customize-preview' ), Tesseract_Remove_Branding::VERSION, true );



	}



	public function enqueue_controls_javascript() {

		wp_enqueue_script( 'tesseract-remove-branding-controls', Tesseract_Remove_Branding::get_assets_url() . 'js/tesseract-remove-branding-controls.js', array( 'jquery', 'customize-controls' ), Tesseract_Remove_Branding::VERSION, true );

	}



	public function frontend_style() {



		wp_enqueue_style( 'tesseract-remove-branding-frontend', Tesseract_Remove_Branding::get_assets_url() . 'css/tesseract-remove-branding-frontend.css', array('tesseract-footer-banner'), Tesseract_Remove_Branding::VERSION );



		//If there's no footer right side content

		$fcContent = get_theme_mod('tesseract_footer_right_content');

		$fcContent = ( $fcContent == 'nothing' );



		if ( true == $fcContent ) :

			$dynamic_styles_trb = "#horizontal-menu-wrap {

					width: 100%;

				}



				#footer-banner-right {

					display: none;

					padding: 0;

					margin: 0;

					}

			";

		endif;



		if ( ! empty( $dynamic_styles_trb ) ) {

			wp_add_inline_style( 'tesseract-remove-branding-frontend', $dynamic_styles_trb );

		}



	}



	public function backend_style() {



		wp_enqueue_style( 'tesseract-remove-branding-backend', Tesseract_Remove_Branding::get_assets_url() . 'css/tesseract-remove-branding-backend.css', array('tesseract_customize_controls_style-css'), Tesseract_Remove_Branding::VERSION );



	}



}



new Tesseract_Remove_Branding_Customizer();



