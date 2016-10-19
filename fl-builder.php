<?php
/**
 * Plugin Name: Tesseract Plus Plugin
 * Plugin URI: https://www.tesseractplus.com
 * Description: A drag and drop frontend WordPress page builder plugin that works with almost any theme! This is a white label product based on Beaver Builder’s agency package.
 * Version: 1.8.2
 * Author: The Tesseract Plus Team
 * Author URI: https://www.tesseractplus.com
 * Copyright: (c) 2014 Tesseract Plus
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: fl-builder
 */
add_action('wp_head','hook_css');

function hook_css() {

	$output="<style> #tesseractplus-plugin-notice { display:none; } </style>";

	echo $output;

}
if(function_exists( 'is_plugin_active' ))
{
	if ( is_plugin_active( 'tesseract-plus-plugin/fl-builder.php' ) ) {
				deactivate_plugins( 'beaver-builder-lite-version/fl-builder.php' );
				deactivate_plugins( 'bb-plugin/fl-builder.php' );
			}
}
require_once 'classes/class-fl-builder-loader.php';

