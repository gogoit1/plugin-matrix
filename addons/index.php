<?php
defined( 'ABSPATH' ) or die( 'You are in wrong way... !' );

if( !class_exists( 'Tesseract_Add_Ons' )){
	class Tesseract_Add_Ons
	{
		public function __construct() 
		{
			require( dirname( __FILE__ ) . '/vs-support/version-one-support.php');
			define( 'WPSM_BBE_DIR', plugin_dir_path( __FILE__ ) );
			define( 'WPSM_BBE_URL', plugins_url( '/', __FILE__ ) );
			add_action( 'plugins_loaded', array( 'Tesseract_Remove_Branding', 'get_instance' ) );
			if ( wp_get_theme() == 'Tesseract' ) 
			{
				add_action( 'tesseract_footer_branding', array($this,'tesseract_remove_branding'), 9 );
				add_action( 'tesseract_footer_branding', array($this,'tesseract_replace_branding'), 10 );
			}
		}
		public function tesseract_remove_branding()
		{
			remove_action( 'tesseract_footer_branding', 'tesseract_footer_branding_output', 10 );
		}
		public function tesseract_replace_branding()
		{
			if (!defined('TESSERACT_BRANDING_EXIST'))
				define('TESSERACT_BRANDING_EXIST', 'nope');
			$content = get_theme_mod('tesseract_footer_right_content');
			$content_default_html = get_theme_mod('tesseract_footer_right_content_html');
			if ( $content ) : ?>
				<div id="footer-banner-right" class="banner-right <?php echo 'content-' . $content; ?>">
					<?php switch( $content ) 
						{
							default:
							break;
							case 'html':
							$code = do_shortcode( $content_default_html );
							echo '<div id="footer-button-container"><div id="footer-button-container-inner">' . $code . '</div></div>';
							break;
							case 'social': ?>
								<ul class="hr-social">
									<?php 
										$bln_tesseract_social_account_right = false;
										for ( $i = 1; $i <= 10; $i++ ) 
										{
											$account_number = sprintf( '%02d', $i );
											$sn_img = get_theme_mod( "tesseract_social_account{$account_number}_image" );
											if ( $sn_img ) 
											{
												$sn_name = get_theme_mod( "tesseract_social_account{$account_number}_name" );
												$sn_url = get_theme_mod( "tesseract_social_account{$account_number}_url" );
												if ( $sn_name && $sn_url ) 
												{
													$bln_tesseract_social_account_right = true;
													echo '<li><a title="Follow Us on ' . $sn_name . '" href="' . $sn_url . '" target="_blank"><img src="' . $sn_img . '" width="24" height="24" alt="' . $sn_name . ' icon" /></a></li>';
												}
											}
										}	
										if($bln_tesseract_social_account_right == false)
										{
											echo "<li>Add your social accounts and they'll appear here.</li>";
										}	
									?>
								</ul>
							<?php break;
							case 'search':
								get_search_form();
							break;
							case 'menu'; ?>
							<nav id="footer-right-menu" role="navigation">
								<?php if ( function_exists( 'tesseract_output_menu' ) ) : ?>
									<?php tesseract_output_menu( FALSE, FALSE, 'secondary_right', 1 ); ?>
								<?php else: ?>
									Using the menu option requires Tesseract version 2 or newer.
								<?php endif; ?>
							</nav>
				  <?php } ?>
				</div>
			<?php elseif ( !$content && $content_default_html ) : ?>
				<div id="footer-banner-right" class="banner-right content-notset defbtn-isset">
					<div id="footer-button-container">
						<div id="footer-button-container-inner">
							<?php echo $content_default_html; ?>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div id="footer-banner-right" class="banner-right content-notset defbtn-notset">
					<div id="footer-button-container">
						<div id="footer-button-container-inner">
							<strong>Theme by <a href="http://tesseracttheme.com">Tesseract</a></strong>
	                        &nbsp;&nbsp;
	                        <strong>
	                        	<a href="http://tesseracttheme.com">
	                        		<img src="//tylers-storage.s3-us-west-1.amazonaws.com/wp-content/uploads/2015/09/07185505/Drawing1.png" alt="Drawing" width="16" height="16" />
	                            </a>
	                        </strong>
						</div>
					</div>
				</div>
	          <?php endif;
		}
	}
	new Tesseract_Add_Ons();
}


if ( !class_exists( 'WPSM_BBE_Extension' ) ) {
	class WPSM_BBE_Extension
	{
		
		function __construct()
		{
			$this->wpsActionFilterLoader();
			add_action( 'after_setup_theme', array( $this, 'wpsm_bbe_includes') );
			add_action( 'init', array( $this, 'wpsm_bbe_load_modules') );
			add_action( 'wp_enqueue_scripts', array( $this, 'wpsm_page_builder_script') );
			add_filter( 'fl_builder_render_css', array( $this, 'wpsm_bbe_render_css' ), 10, 3 );
		}
		
		function wpsActionFilterLoader() {
			/* Admin Fun*/
			require_once 'admin/help-function.php';

			/* Classe Loader */
			require 'classes/class-wpsbbe-admin-settings.php';
		}
		
		/**
		 * Includes Necessary Files
		 */
		function wpsm_bbe_includes() {
			
			if ( class_exists( 'FLBuilder' ) ) {
							
				/* Includes */
			    require_once 'includes/row-settings.php';
			    require_once 'includes/class-row-html.php';
   			    require_once 'includes/class-row-css.php';
			}
		}
		
		/**
		 * Load All Modules
		 */
		function wpsm_bbe_load_modules() {
			if ( class_exists( 'FLBuilder' ) ) {
				
			    /* Include Modules */
			    require_once 'modules/all-elements.php';
			}
		}


		/**
		 * Render Global uabb-layout-builder css
		 */
		function wpsm_bbe_render_css($css, $nodes, $global_settings) {
			if ( class_exists( 'FLBuilder' ) ) {

			    $css .= file_get_contents(WPSM_BBE_DIR . 'css/wpsm-row.css');
			    /*ob_start();
				include WPSM_BBE_DIR . 'includes/row-css.php';
				$css .= ob_get_clean();*/
    		}
	    	return $css;
		}

		/**
		 * Page Builder Scripts
		 */
		function wpsm_page_builder_script() {

			if ( class_exists( 'FLBuilder' ) && FLBuilderModel::is_builder_active() ) {
				wp_enqueue_script('wpsm-jqueryextend', WPSM_BBE_URL . 'js/jQueryExtend.js', array(), false, true);
				wp_enqueue_style('wpsm-pagebuilder-ui', WPSM_BBE_URL . 'admin/assets/css/pagebuilder-ui.css');
				wp_enqueue_script('wpsm-pagebuilder-ui', WPSM_BBE_URL . 'admin/assets/js/pagebuilder-ui.js', array(), false, true);
			}
		}
	}
	new WPSM_BBE_Extension();
}

if ( ! class_exists( 'Tesseract_Remove_Branding' ) ) {
	class Tesseract_Remove_Branding 
	{
		const VERSION = '1.0.0';
		protected static $instance = null;
		
		private function __construct() 
		{
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
			add_action( 'after_setup_theme', array( $this, 'tesseract_remove_branding_setup' ), 100 );
			if ( wp_get_theme() == 'Tesseract' ) 
			{
				$this->includes();
			} else {
				add_action( 'admin_notices', array( $this, 'tesseract_theme_missing_notice' ) );
			}
		}
		public static function get_instance() 
		{
			if ( null == self::$instance ) 
			{
				self::$instance = new self;
			}
			return self::$instance;
		}

		public static function get_assets_url() 
		{
			return plugins_url( 'assets/', __FILE__ );
		}

		public function load_plugin_textdomain() 
		{
			$locale = apply_filters( 'plugin_locale', get_locale(), 'tesseract-remove-branding' );
			load_textdomain( 'tesseract-remove-branding', trailingslashit( WP_LANG_DIR ) . 'tesseract-remove-branding/tesseract-remove-branding-' . $locale . '.mo' );
			load_plugin_textdomain( 'tesseract-remove-branding', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		public function tesseract_remove_branding_setup() 
		{
			register_nav_menus( array(
				'secondary_right' => __( 'Footer Right', 'tesseract' )
			) );
		}

		private function includes() 
		{
			include_once 'includes/class-trb-customizer.php';
		}
		public function tesseract_theme_missing_notice() 
		{
			echo '<div class="error"><p>' . sprintf( __( 'Tesseract Remove Branding depends on the %s to work!', 'tesseract-remove-branding' ), '<a href="https://s3.amazonaws.com/tesseracttheme/TESSERACT.zip" target="_blank">' . __( 'Tesseract theme', 'tesseract-remove-branding' ) . '</a>' ) . '</p></div>';
		}
	}
}


