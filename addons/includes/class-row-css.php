<?php

/**
*  Extender BB Row Settings
*/

if ( !class_exists( 'WPSMRowCss' ) ) {
	class WPSMRowCss {
		
		function __construct()
		{
			add_filter('fl_builder_render_css', array( $this, 'wpsm_row_separator_css' ), 11, 3);
		}

		/**
		 * Row Seperator CSS
		 */
		function wpsm_row_separator_css( $css, $nodes, $global_settings) 
		{	
			$rows = $nodes['rows'];

			foreach( $rows as $row) {
				$rsetting = $row->settings;
				
				ob_start();
				include WPSM_BBE_DIR . 'includes/row-css.php';
				$css .= ob_get_clean();

			}
			return $css;
		}
	}
	new WPSMRowCss();
}