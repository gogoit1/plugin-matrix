<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Sets up HTML buffering if we're on version 1 of Tesseract
 */
function trb_version_one_check() {
	$theme = wp_get_theme();

	if ( ! empty( $theme ) ) {
		// We only want to use output buffering if the theme is version 1
		if ( version_compare( $theme->Version, "1.0" ) <= 0 ) {
			// We're in version 1
			define( 'TESSERACT_RB_THEME_VERSION', 1 );
			add_action( 'get_footer', 'trb_start_footer_buffer' );
			add_action( 'wp_footer', 'trb_scan_footer_buffer_for_branding' );
			add_filter( 'body_class', 'trb_add_version_one_body_class' );
		} elseif ( version_compare( $theme->Version, "2.0" ) >= 0 ) {
			define( 'TESSERACT_RB_THEME_VERSION', 2 );
		} else {
			define( 'TESSERACT_RB_THEME_VERSION', 'unknown' );
		}
	}
}

add_action( 'init', 'trb_version_one_check' );

/**
 * Hooked on get_footer, this starts an output buffer.
 * We'll scanned the buffered content to try to replace the "Theme by Tyler Moore" block.
 */
function trb_start_footer_buffer() {
	ob_start();
}

/**
 * Hooked on wp_footer (which is called after get_footer), this captures the buffered HTML
 * and does a regex replacement for a div with id "designer", which is where the
 * "Theme by Tyler Moore" text lives.
 */
function trb_scan_footer_buffer_for_branding() {
	// The contents of the buffer should be the footer HTML
	$content = ob_get_contents();

	// Start another buffer to get the replacement HTML for the branding block
	ob_start();

	tesseract_replace_branding();

	$replacement = ob_get_contents();
	ob_end_clean(); // End the replacement HTML buffer

	// Do a search + replace on the HTML with the replacement HTML
	$content = preg_replace( '/<div id=\"designer\">.*?<\/div>/s', $replacement, $content, 1 );

	ob_end_clean(); // End the footer HTML buffer

	echo $content; // Echo the modified HTML
}

function trb_add_version_one_body_class( $classes ) {
	$classes[] = 'tesseract-version-1';

	return $classes;
}
