<?php

if ( ! class_exists( 'wpsClassLoader' ) ) {
	
	/**
	 *
	 * @since 1.0.1
	 */
	class wpsClassLoader {
		
		/**
		 * Load the files or,
		 * show an admin notice.
		 *
		 * @since 1.0.1
		 * @return void
		 */ 
		static public function init()
		{
			/*if ( class_exists( 'FLBuilder' ) || ( $plugin_dirname != $lite_dirname && $lite_active ) ) {
				self::admin_notice_hooks();
				return;
			}*/
			
			//self::define_constants();
			self::load_files();
		}
		
		/**
		 * Define builder constants.
		 *
		 * @since 1.0.1
		 * @return void
		 */ 
		/*static private function define_constants()
		{
			define('FL_BUILDER_VERSION', '1.8');
			define('FL_BUILDER_FILE', trailingslashit(dirname(dirname(__FILE__))) . 'fl-builder.php');
			define('WPSM_BBE_DIR', plugin_dir_path(FL_BUILDER_FILE));
			define('FL_BUILDER_URL', plugins_url('/', FL_BUILDER_FILE));
			define('FL_BUILDER_LITE', false);
			define('FL_BUILDER_SUPPORT_URL', 'https://www.tesseracttheme.com/support/');
			define('FL_BUILDER_UPGRADE_URL', 'https://www.tesseracttheme.com/');
			define('FL_BUILDER_DEMO_URL', 'http://www.tesseracttheme.com');
			define('FL_BUILDER_OLD_DEMO_URL', 'http://www.tesseracttheme.com');
			define('FL_BUILDER_DEMO_CACHE_URL', 'http://www.tesseracttheme.com');
		}*/
		
		/**
		 * Loads classes and includes.
		 *
		 * @since 1.0.1
		 * @return void
		 */ 
		static private function load_files()
		{	

			/* Classes */
			require_once WPSM_BBE_DIR . 'classes/class-wpsbbe-admin-settings.php';
			
			/* Includes */
			/*require_once WPSM_BBE_DIR . 'includes/example.php';
			require_once WPSM_BBE_DIR . 'includes/forupdater/updater.php';*/
		}
		
		/**
		 * Initializes actions for the admin notice
		 *
		 * @since 1.0.1
		 * @return void
		 */ 
		/*static private function admin_notice_hooks()
		{
			add_action('admin_notices',           __CLASS__ . '::admin_notice');
			add_action('network_admin_notices',   __CLASS__ . '::admin_notice');
		}*/
	
		/**
		 * Shows an admin notice if another version of the builder
		 * has already been loaded before this one.
		 *
		 * @since 1.8
		 * @return void
		 */
		/*static public function admin_notice()
		{
			if ( ! is_admin() ) {
				return;
			}
			else if ( ! is_user_logged_in() ) {
				return;
			}
			else if ( ! current_user_can( 'update_core' ) ) {
				return;
			}
			
			$message = __( 'You currently have two versions of Tesseract Designer Plus active on this site. Please <a href="%s">deactivate one</a> before continuing.', 'fl-builder' );
			
			echo '<div class="updated">';
			echo '<p>' . sprintf( $message, admin_url( 'plugins.php' ) ) . '</p>';
			echo '</div>';
		}*/
	}
}

wpsClassLoader::init();
