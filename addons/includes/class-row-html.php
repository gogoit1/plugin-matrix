<?php

/**
*  Extender BB Row Settings
*/

if ( !class_exists( 'WPSMRowHtml' ) ) {
	class WPSMRowHtml {
		
		function __construct()
		{
			add_filter('fl_builder_row_custom_class', array( $this, 'wpsm_apply_row_class' ), 10, 2);
			add_action( 'fl_builder_before_render_row_bg', array( $this, 'wpsm_row_separator_before_html' ), 10, 1 );
			add_action( 'fl_builder_after_render_row_bg', array( $this, 'wpsm_row_separator_after_html' ), 10, 1 );
		}

		function wpsm_row_separator_before_html( $row )
		{	
			$rsetting = $row->settings;
			$this->wpsm_row_separator_data( $row, 'top' );
			$this->wpsm_img_separator_data( $row, 'top' );
		}

		function wpsm_row_separator_after_html( $row )
		{	
			$rsetting = $row->settings;
			$this->wpsm_row_separator_data( $row, 'bottom' );
			$this->wpsm_img_separator_data( $row, 'bottom' );
		}
		

		/**
		 * Apply class to row based on setting
		 */
		function wpsm_apply_row_class( $row_class, $row )
		{
			if ( $row->settings->enable_top_separator == 'yes' ) {
				$separator_class = ' wpsm-row-top-separator';
				$row_class = $row_class.$separator_class;
			}

			if ( $row->settings->enable_bottom_separator == 'yes' ) {
				$separator_class = ' wpsm-row-bottom-separator';
				$row_class = $row_class.$separator_class;
			}
			
			return $row_class;
		}

		/**
		 * Row Separator Prepare Data
		 */
		function wpsm_row_separator_data( $row, $pos ) {
			$wpsm_css_shapes = array(
				'tip-center',
				'tip-left',
				'tip-right',
				'split-inner',
				'split-outer',
				'teeth-left',
				'teeth-center',
				'teeth-right',
			);

			$rsetting 		= $row->settings;
			$wpsm_separator = '';

			if ( $rsetting->enable_top_separator == 'yes' && $pos == 'top' ) {
				$wpsm_separator = '<div class="wpsm-separator-spacer wpsm-separator--top"></div>';
				$wpsm_separator_color = $rsetting->s_top_color != '' ? '#'.$rsetting->s_top_color : '#ffffff';

				if ( array_search( $rsetting->s_top_style, $wpsm_css_shapes ) !== false ) {
					$wpsm_separator .= '<div class="wpsm-separator wpsm-separator--css wpsm-separator--top wpsm-separator-style--' . $rsetting->s_top_style . '"><div class="wpsm-separator-content"></div></div>';
				} else {
					if ( strpos( $rsetting->s_top_style, 'circle' ) === 0 ) {
						$aspect_ratio = '';
						$viewbox = '0 0 200 100';
					} else {
						$aspect_ratio = 'preserveAspectRatio="none"';
						$viewbox = '0 0 100 100';
					}

					$wpsm_separator .= '<svg class="wpsm-separator wpsm-separator--top wpsm-separator-style--' . $rsetting->s_top_style . '" width="100%" height="'. $rsetting->s_top_height .'px" viewBox="' . $viewbox . '" ' . $aspect_ratio . ' version="1.1" xmlns="http://www.w3.org/2000/svg">';
					$wpsm_separator .= $this->wpsm_top_polygon_shape( $rsetting->s_top_style );
					$wpsm_separator .= '</svg>';
				}

				echo $wpsm_separator;
			}

			if ( $rsetting->enable_bottom_separator == 'yes' && $pos == 'bottom' ) {
				$wpsm_separator = '<div class="wpsm-separator-spacer wpsm-separator--bottom"></div>';
				$wpsm_separator_color = $rsetting->s_bottom_color != '' ? '#'.$rsetting->s_bottom_color : '#ffffff';

				if ( array_search( $rsetting->s_bottom_style, $wpsm_css_shapes ) !== false ) {
					$wpsm_separator .= '<div class="wpsm-separator wpsm-separator--css wpsm-separator--bottom wpsm-separator-style--' . $rsetting->s_bottom_style . '"><div class="wpsm-separator-content"></div></div>';
				} else {
					if ( strpos( $rsetting->s_bottom_style, 'circle' ) === 0 ) {
						$aspect_ratio = '';
						$viewbox = '0 0 200 100';
					} else {
						$aspect_ratio = 'preserveAspectRatio="none"';
						$viewbox = '0 0 100 100';
					}

					$wpsm_separator .= '<svg class="wpsm-separator wpsm-separator--bottom wpsm-separator-style--' . $rsetting->s_bottom_style . '" width="100%" height="'. $rsetting->s_bottom_height .'px" viewBox="' . $viewbox . '" ' . $aspect_ratio . ' version="1.1" xmlns="http://www.w3.org/2000/svg">';
					$wpsm_separator .= $this->wpsm_bottom_polygon_shape( $rsetting->s_bottom_style );
					$wpsm_separator .= '</svg>';
				}

				echo $wpsm_separator;
			}
		}

		/**
		 * Get Top Polygon Shapes
		 */
		function wpsm_top_polygon_shape( $shape ) {
			switch ( $shape ) {
				case 'circle-center':
					return '<path d="M 0 100 A 100 100 0 0 1 200 100 L 4000 100 L 4000 -5 L -4000 -5 L -4000 100 Z" />';
				case 'circle-left':
					return '<path d="M 0 100 A 100 100 0 0 1 200 100 L 4000 100 L 4000 -5 L -4000 -5 L -4000 100 Z" transform="translate(-500, 0)" />';
				case 'circle-right':
					return '<path d="M 0 100 A 100 100 0 0 1 200 100 L 4000 100 L 4000 -5 L -4000 -5 L -4000 100 Z" transform="translate(500, 0)" />';
				case 'arrow-center':
					return '<polygon points="0,100 0,-5 100,-5 100,100 50,5"/>';
				case 'arrow-left':
					return '<polygon points="0,100 0,-5 100,-5 100,100 25,5"/>';
				case 'arrow-right':
					return '<polygon points="0,100 0,-5 100,-5 100,100 75,5"/>';
				case 'slope-left':
					return '<polygon points="0,100 0,-5 100,-5 100,5"/>';
				case 'slope-right':
					return '<polygon points="0,5 0,-5 100,-5 100,100"/>';
				case 'blob-center':
					return '<path d="M 0 100 L 0 -5 L 100 -5 L 100 100 Q 50 -75 0 100 Z" />';
				case 'blob-left':
					return '<path d="M 0 100 L 0 -5 L 100 -5 L 100 100 Q 10 -75 0 100 Z" />';
				case 'blob-right':
					return '<path d="M 0 100 L 0 -5 L 100 -5 L 100 100 Q 90 -75 0 100 Z" />';
				case 'stamp':
					return '<path d="M 0 100 Q 2.5 50 5 100 Q 7.5 50 10 100 Q 12.5 50 15 100 Q 17.5 50 20 100 Q 22.5 50 25 100 Q 27.5 50 30 100 Q 32.5 50 35 100 Q 37.5 50 40 100 Q 42.5 50 45 100 Q 47.5 50 50 100 Q 52.5 50 55 100 Q 57.5 50 60 100 Q 62.5 50 65 100 Q 67.5 50 70 100 Q 72.5 50 75 100 Q 77.5 50 80 100 Q 82.5 50 85 100 Q 87.5 50 90 100 Q 92.5 50 95 100 Q 97.5 50 100 100 L 100 -5 L 0 -5 Z" />';
				case 'cloud':
					return '<path d="M 62.08,83.56 c 1.52,-8.90 3.05,-10.85 4.58,-5.73 2.21,-23.58 4.43,-23.58 6.65,0 1.18,-3.97 2.37,-3.74 3.56,0.74 1.78,-15.58 3.57,-17.61 5.36,-6.34 2.02,-17.80 4.04,-15.94 6.07,5.59 1.15,-3.85 2.29,-3.73 3.44,0.34 1.83,-17.70 3.66,-20.27 5.49,-7.82 C 98.17,61.88 99.08,57.65 100,57.63 l 0,-57.63 -100,0 0,60.13 c 0.69,0.01 1.39,2.33 2.08,6.99 2.01,-23.50 4.03,-22.70 6.05,2.69 1.29,-6.73 2.59,-6.30 3.89,1.10 1.97,-21.05 3.94,-21.05 5.92,0 1.24,-7.11 2.49,-7.77 3.74,-1.83 2.05,-29.82 4.11,-31.72 6.16,-5.75 1.69,-13.01 3.39,-10.50 5.08,7.58 1.35,-7.75 2.71,-7.75 4.07,0 2.15,-22.97 4.30,-20.84 6.46,6.33 1.05,-3.16 2.11,-2.97 3.16,0.57 2.11,-22.52 4.23,-23.59 6.35,-3.09 1.73,-8.20 3.46,-5.60 5.19,7.80 1.28,-3.65 2.57,-3.28 3.86,1.02 Z" />';
				default:
					return '';
			}
		}
		/**
		 * Get Bottom Polygon Shapes
		 */
		function wpsm_bottom_polygon_shape( $shape ) {
			switch ( $shape ) {
				case 'circle-center':
					return '<path d="M 0 0 A 100 100 0 0 0 200 0 L 4000 0 L 4000 105 L -4000 105 L -4000 0 Z" />';
				case 'circle-left':
					return '<path d="M 0 0 A 100 100 0 0 0 200 0 L 4000 0 L 4000 105 L -4000 105 L -4000 0 Z" transform="translate(-500, 0)" />';
				case 'circle-right':
					return '<path d="M 0 0 A 100 100 0 0 0 200 0 L 4000 0 L 4000 105 L -4000 105 L -4000 0 Z" transform="translate(500, 0)" />';
				case 'arrow-center':
					return '<polygon points="0,105 0,0 50,95 100,0 100,105"/>';
				case 'arrow-left':
					return '<polygon points="0,105 0,0 25,95 100,0 100,105"/>';
				case 'arrow-right':
					return '<polygon points="0,105 0,0 75,95 100,0 100,105"/>';
				case 'slope-left':
					return '<polygon points="0,105 0,95 100,0 100,105"/>';
				case 'slope-right':
					return '<polygon points="0,105 0,0 100,95 100,105"/>';
				case 'blob-center':
					return '<path d="M 0 0 L 0 105 L 100 105 L 100 0 Q 50 175 0 0 Z" />';
				case 'blob-left':
					return '<path d="M 0 0 L 0 105 L 100 105 L 100 0 Q 10 175 0 0 Z" />';
				case 'blob-right':
					return '<path d="M 0 0 L 0 105 L 100 105 L 100 0 Q 90 175 0 0 Z" />';
				case 'stamp':
					return '<path d="M 0 0 Q 2.5 50 5 0 Q 7.5 50 10 0 Q 12.5 50 15 0 Q 17.5 50 20 0 Q 22.5 50 25 0 Q 27.5 50 30 0 Q 32.5 50 35 0 Q 37.5 50 40 0 Q 42.5 50 45 0 Q 47.5 50 50 0 Q 52.5 50 55 0 Q 57.5 50 60 0 Q 62.5 50 65 0 Q 67.5 50 70 0 Q 72.5 50 75 0 Q 77.5 50 80 0 Q 82.5 50 85 0 Q 87.5 50 90 0 Q 92.5 50 95 0 Q 97.5 50 100 0 L 100 105 L 0 105 Z" />';
				case 'cloud':
					return '<path d="M 37.91 16.43 C 36.38 25.33 34.85 27.29 33.32 22.17 C 31.10 45.76 28.89 45.76 26.67 22.17 C 25.48 26.15 24.29 25.91 23.11 21.42 C 21.32 37.01 19.53 39.04 17.74 27.76 C 15.72 45.56 13.69 43.71 11.67 22.17 C 10.52 26.02 9.37 25.91 8.22 21.82 C 6.39 39.53 4.56 42.10 2.73 29.65 C 1.82 38.11 0.91 42.34 0 42.36 L 0 105 L 100 105 L 100 39.86 C 99.30 39.85 98.60 37.53 97.91 32.87 C 95.89 56.38 93.87 55.58 91.85 30.17 C 90.55 36.91 89.25 36.48 87.96 29.07 C 85.98 50.12 84.01 50.12 82.03 29.07 C 80.79 36.19 79.54 36.85 78.29 30.90 C 76.24 60.73 74.18 62.63 72.12 36.66 C 70.43 49.67 68.73 47.17 67.03 29.07 C 65.67 36.83 64.32 36.83 62.96 29.07 C 60.80 52.05 58.65 49.91 56.49 22.74 C 55.43 25.90 54.38 25.71 53.32 22.17 C 51.20 44.70 49.09 45.76 46.97 25.26 C 45.24 33.47 43.50 30.86 41.77 17.46 C 40.48 21.12 39.19 20.74 37.91 16.43 Z" />';
				default:
					return '';
			}
		}

		/**
		 * Image Separator Data
		 */
		function wpsm_img_separator_data($row, $pos)
		{
			$rsetting 		= $row->settings;
			$wpsm_separator = '';
			$url = '';
		
			if( !empty( $rsetting->img_src ) ) {
				$url = $rsetting->img_src;
			}

			if ( $rsetting->enable_img_separator == 'yes' && $pos == $rsetting->img_position ) {
				$wpsm_separator .= '<div class="wpsm-img-separator-wrap wpsm-img-separator-'.$rsetting->img_position.'">';
				$wpsm_separator .= '<div class="wpsm-img-separator-content">';
				$wpsm_separator .= '<img class="wpsm-img-separator" src="'.$url.'"/>';
				$wpsm_separator .= '</div>';
				$wpsm_separator .= '</div>';
				echo $wpsm_separator;
			}

		}
	}
	new WPSMRowHtml();
}