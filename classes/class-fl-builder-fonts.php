<?php

/**
 * Helper class for font settings.
 *
 * @class   FLBuilderFonts
 * @since   1.6.3
 */
final class FLBuilderFonts {

	/**
	 * An array of fonts / weights.
	 * @var array
	 */
	static private $fonts = array();

	/**
	 * Renders the JavasCript variable for font settings dropdowns.
	 *
	 * @since  1.6.3
	 * @return void
	 */
	static public function js()
	{
		$default = json_encode(FLBuilderFontFamilies::$default);
		$system  = json_encode(FLBuilderFontFamilies::$system);
		$google  = json_encode(FLBuilderFontFamilies::$google);
		
		echo 'var FLBuilderFontFamilies = { default: '. $default .', system: '. $system .', google: '. $google .' };';
	}

	/**
	 * Renders a list of all available fonts.
	 *
	 * @since  1.6.3
	 * @param  string $font The current selected font.
	 * @return void
	 */
	static public function display_select_font($font)
	{
		echo '<option value="Default" '. selected('Default', $font) .'>'. __( 'Default', 'fl-builder' ) .'</option>';
		echo '<optgroup label="System">';
		
		foreach(FLBuilderFontFamilies::$system as $name => $variants) {
			echo '<option value="'. $name .'" '. selected($name, $font) .'>'. $name .'</option>';
		}
		
		echo '<optgroup label="Google">';
		
		foreach(FLBuilderFontFamilies::$google as $name => $variants) {
			echo '<option value="'. $name .'" '. selected($name, $font) .'>'. $name .'</option>';
		}
	}

	/**
	 * Renders a list of all available weights for a selected font.
	 *
	 * @since  1.6.3
	 * @param  string $font   The current selected font.
	 * @param  string $weight The current selected weight.
	 * @return void
	 */
	static public function display_select_weight( $font, $weight )
	{	
		if( $font == 'Default' ){
			echo '<option value="default">'. __( 'Default', 'fl-builder' ) .'</option>';		
		} else {

			if( array_key_exists( $font, FLBuilderFontFamilies::$system ) ){
				
				foreach( FLBuilderFontFamilies::$system[ $font ]['weights'] as $variant ) {
					echo '<option value="'. $variant .'" '. selected($variant, $weight) .'>'. FLBuilderFonts::get_weight_string( $variant ) .'</option>';
				}

			} else {
				foreach(FLBuilderFontFamilies::$google[ $font ] as $variant) {

					echo '<option value="'. $variant .'" '. selected($variant, $weight) .'>'. FLBuilderFonts::get_weight_string( $variant ) .'</option>';
				}

			}
			
		}
	
	}

	/**
	 * Returns a font weight name for a respective weight.
	 *
	 * @since  1.6.3
	 * @param  string $weight The selected weight.
	 * @return string         The weight name.
	 */
	static public function get_weight_string( $weight ){

		$weight_string = array(
			'default' => __( 'Default', 'fl-builder' ),
			'regular' => __( 'Regular', 'fl-builder' ),
			'100' => 'Thin 100',
			'200' => 'Extra-Light 200',
			'300' => 'Light 300',
			'400' => 'Normal 400',
			'500' => 'Medium 500',
			'600' => 'Semi-Bold 600',
			'700' => 'Bold 700',
			'800' => 'Extra-Bold 800',
			'900' => 'Ultra-Bold 900'
		);
		
		return $weight_string[ $weight ];
	}

	/**
	 * Helper function to render css styles for a selected font.
	 *
	 * @since  1.6.3
	 * @param  array $font An array with font-family and weight.
	 * @return void
	 */
	static public function font_css( $font ){

		$css = '';

		if( array_key_exists( $font['family'], FLBuilderFontFamilies::$system ) ){
			
			$css .= 'font-family: '. $font['family'] .','. FLBuilderFontFamilies::$system[ $font['family'] ]['fallback'] .';';

		} else {
			$css .= 'font-family: '. $font['family'] .';';
		}	

		if ( 'regular' == $font['weight'] ) {
			$css .= 'font-weight: normal;';
		} else {
			$css .= 'font-weight: '. $font['weight'] .';';
		}

		echo $css;
	}

	/**
	 * Add fonts to the $font array for a module.
	 *
	 * @since  1.6.3
	 * @param  object $module The respective module.
	 * @return void
	 */
	static public function add_fonts_for_module( $module ){
		$fields = FLBuilderModel::get_settings_form_fields( $module->form );
		$array = array();

		foreach ( $fields as $name => $field ) {
			if ( $field['type'] == 'font' && isset( $module->settings->$name ) ) {
				$array[] = $module->settings->$name;
				self::add_font( $module->settings->$name );
			}
		}
	}

	/**
	 * Enqueue the stylesheet for fonts.
	 *
	 * @since  1.6.3
	 * @return void
	 */
	static public function enqueue_styles(){
		$google_url = '//fonts.googleapis.com/css?family=';

		if( count( self::$fonts ) > 0 ){

			foreach( self::$fonts as $family => $weights ){
				$google_url .= $family . ':' . implode( ',', $weights ) . '|';
			}

			$google_url = substr( $google_url, 0, -1 );
			wp_enqueue_style( 'fl-builder-google-fonts', $google_url, array() );
		}		
	}

	/**
	 * Adds data to the $fonts array for a font to be rendered.
	 *
	 * @since  1.6.3
	 * @param  array $font an array with the font family and weight to add.
	 * @return void
	 */
	static public function add_font( $font ){

		if( $font['family'] != 'Default' ){

			// check if is a Google Font
			if( !array_key_exists( $font['family'], FLBuilderFontFamilies::$system ) ){

				// check if font family is already added
				if( array_key_exists( $font['family'], self::$fonts ) ){

					// check if the weight is already added
					if( !in_array( $font['weight'], self::$fonts[ $font['family'] ] ) ){
						self::$fonts[ $font['family'] ][] = $font['weight'];
					}
				} else {
					// adds a new font and height
					self::$fonts[ $font['family'] ] = array( $font['weight'] );

				}

			}

		}
	}

}

/**
 * Font info class for system and Google fonts.
 *
 * @class FLFontFamilies
 * @since 1.6.3
 */
final class FLBuilderFontFamilies {

	static public $default = array(
		"Default" => array(
			'default'
		)
	);

	/**
	 * Array with a list of system fonts.
	 * @var array
	 */
	static public $system = array(
		"Helvetica" => array(
			"fallback" => "Verdana, Arial, sans-serif",
			"weights"  => array(
				"300",
				"400",
				"700",
			)
		),
		"Verdana" => array(
			"fallback" => "Helvetica, Arial, sans-serif",
			"weights"  => array(
				"300",
				"400",
				"700",
			)
		),
		"Arial" => array(
			"fallback" => "Helvetica, Verdana, sans-serif",
			"weights"  => array(
				"300",
				"400",
				"700",
			)
		),
		"Times" => array(
			"fallback" => "Georgia, serif",
			"weights"  => array(
				"300",
				"400",
				"700",
			)
		),
		"Georgia" => array(
			"fallback" => "Times, serif",
			"weights"  => array(
				"300",
				"400",
				"700",
			)
		),
		"Courier" => array(
			"fallback" => "monospace",
			"weights"  => array(
				"300",
				"400",
				"700",
			)
		),
	);
	
	/**
	 * Array with Google Fonts.
	 * @var array
	 */
	static public $google = array(
	    "ABeeZee" => array(
	        "regular",
	    ),
	    "Abel" => array(
	        "regular",
	    ),
	    "Abril Fatface" => array(
	        "regular",
	    ),
	    "Aclonica" => array(
	        "regular",
	    ),
	    "Acme" => array(
	        "regular",
	    ),
	    "Actor" => array(
	        "regular",
	    ),
	    "Adamina" => array(
	        "regular",
	    ),
	    "Advent Pro" => array(
	        "100",
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Aguafina Script" => array(
	        "regular",
	    ),
	    "Akronim" => array(
	        "regular",
	    ),
	    "Aladin" => array(
	        "regular",
	    ),
	    "Aldrich" => array(
	        "regular",
	    ),
	    "Alef" => array(
	        "regular",
	        "700",
	    ),
	    "Alegreya" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Alegreya SC" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Alegreya Sans" => array(
	        "100",
	        "300",
	        "regular",
	        "500",
	        "700",
	        "800",
	        "900",
	    ),
	    "Alegreya Sans SC" => array(
	        "100",
	        "300",
	        "regular",
	        "500",
	        "700",
	        "800",
	        "900",
	    ),
	    "Alex Brush" => array(
	        "regular",
	    ),
	    "Alfa Slab One" => array(
	        "regular",
	    ),
	    "Alice" => array(
	        "regular",
	    ),
	    "Alike" => array(
	        "regular",
	    ),
	    "Alike Angular" => array(
	        "regular",
	    ),
	    "Allan" => array(
	        "regular",
	        "700",
	    ),
	    "Allerta" => array(
	        "regular",
	    ),
	    "Allerta Stencil" => array(
	        "regular",
	    ),
	    "Allura" => array(
	        "regular",
	    ),
	    "Almendra" => array(
	        "regular",
	        "700",
	    ),
	    "Almendra Display" => array(
	        "regular",
	    ),
	    "Almendra SC" => array(
	        "regular",
	    ),
	    "Amarante" => array(
	        "regular",
	    ),
	    "Amaranth" => array(
	        "regular",
	        "700",
	    ),
	    "Amatic SC" => array(
	        "regular",
	        "700",
	    ),
	    "Amethysta" => array(
	        "regular",
	    ),
	    "Amiri" => array(
	        "regular",
	        "700",
	    ),
	    "Amita" => array(
	        "regular",
	        "700",
	    ),
	    "Anaheim" => array(
	        "regular",
	    ),
	    "Andada" => array(
	        "regular",
	    ),
	    "Andika" => array(
	        "regular",
	    ),
	    "Angkor" => array(
	        "regular",
	    ),
	    "Annie Use Your Telescope" => array(
	        "regular",
	    ),
	    "Anonymous Pro" => array(
	        "regular",
	        "700",
	    ),
	    "Antic" => array(
	        "regular",
	    ),
	    "Antic Didone" => array(
	        "regular",
	    ),
	    "Antic Slab" => array(
	        "regular",
	    ),
	    "Anton" => array(
	        "regular",
	    ),
	    "Arapey" => array(
	        "regular",
	    ),
	    "Arbutus" => array(
	        "regular",
	    ),
	    "Arbutus Slab" => array(
	        "regular",
	    ),
	    "Architects Daughter" => array(
	        "regular",
	    ),
	    "Archivo Black" => array(
	        "regular",
	    ),
	    "Archivo Narrow" => array(
	        "regular",
	        "700",
	    ),
	    "Arimo" => array(
	        "regular",
	        "700",
	    ),
	    "Arizonia" => array(
	        "regular",
	    ),
	    "Armata" => array(
	        "regular",
	    ),
	    "Artifika" => array(
	        "regular",
	    ),
	    "Arvo" => array(
	        "regular",
	        "700",
	    ),
	    "Arya" => array(
	        "regular",
	        "700",
	    ),
	    "Asap" => array(
	        "regular",
	        "700",
	    ),
	    "Asar" => array(
	        "regular",
	    ),
	    "Asset" => array(
	        "regular",
	    ),
	    "Astloch" => array(
	        "regular",
	        "700",
	    ),
	    "Asul" => array(
	        "regular",
	        "700",
	    ),
	    "Atomic Age" => array(
	        "regular",
	    ),
	    "Aubrey" => array(
	        "regular",
	    ),
	    "Audiowide" => array(
	        "regular",
	    ),
	    "Autour One" => array(
	        "regular",
	    ),
	    "Average" => array(
	        "regular",
	    ),
	    "Average Sans" => array(
	        "regular",
	    ),
	    "Averia Gruesa Libre" => array(
	        "regular",
	    ),
	    "Averia Libre" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Averia Sans Libre" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Averia Serif Libre" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Bad Script" => array(
	        "regular",
	    ),
	    "Balthazar" => array(
	        "regular",
	    ),
	    "Bangers" => array(
	        "regular",
	    ),
	    "Basic" => array(
	        "regular",
	    ),
	    "Battambang" => array(
	        "regular",
	        "700",
	    ),
	    "Baumans" => array(
	        "regular",
	    ),
	    "Bayon" => array(
	        "regular",
	    ),
	    "Belgrano" => array(
	        "regular",
	    ),
	    "Belleza" => array(
	        "regular",
	    ),
	    "BenchNine" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Bentham" => array(
	        "regular",
	    ),
	    "Berkshire Swash" => array(
	        "regular",
	    ),
	    "Bevan" => array(
	        "regular",
	    ),
	    "Bigelow Rules" => array(
	        "regular",
	    ),
	    "Bigshot One" => array(
	        "regular",
	    ),
	    "Bilbo" => array(
	        "regular",
	    ),
	    "Bilbo Swash Caps" => array(
	        "regular",
	    ),
	    "Biryani" => array(
	        "200",
	        "300",
	        "regular",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Bitter" => array(
	        "regular",
	        "700",
	    ),
	    "Black Ops One" => array(
	        "regular",
	    ),
	    "Bokor" => array(
	        "regular",
	    ),
	    "Bonbon" => array(
	        "regular",
	    ),
	    "Boogaloo" => array(
	        "regular",
	    ),
	    "Bowlby One" => array(
	        "regular",
	    ),
	    "Bowlby One SC" => array(
	        "regular",
	    ),
	    "Brawler" => array(
	        "regular",
	    ),
	    "Bree Serif" => array(
	        "regular",
	    ),
	    "Bubblegum Sans" => array(
	        "regular",
	    ),
	    "Bubbler One" => array(
	        "regular",
	    ),
	    "Buda" => array(
	        "300",
	    ),
	    "Buenard" => array(
	        "regular",
	        "700",
	    ),
	    "Butcherman" => array(
	        "regular",
	    ),
	    "Butterfly Kids" => array(
	        "regular",
	    ),
	    "Cabin" => array(
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Cabin Condensed" => array(
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Cabin Sketch" => array(
	        "regular",
	        "700",
	    ),
	    "Caesar Dressing" => array(
	        "regular",
	    ),
	    "Cagliostro" => array(
	        "regular",
	    ),
	    "Calligraffitti" => array(
	        "regular",
	    ),
	    "Cambay" => array(
	        "regular",
	        "700",
	    ),
	    "Cambo" => array(
	        "regular",
	    ),
	    "Candal" => array(
	        "regular",
	    ),
	    "Cantarell" => array(
	        "regular",
	        "700",
	    ),
	    "Cantata One" => array(
	        "regular",
	    ),
	    "Cantora One" => array(
	        "regular",
	    ),
	    "Capriola" => array(
	        "regular",
	    ),
	    "Cardo" => array(
	        "regular",
	        "700",
	    ),
	    "Carme" => array(
	        "regular",
	    ),
	    "Carrois Gothic" => array(
	        "regular",
	    ),
	    "Carrois Gothic SC" => array(
	        "regular",
	    ),
	    "Carter One" => array(
	        "regular",
	    ),
	    "Catamaran" => array(
	        "100",
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Caudex" => array(
	        "regular",
	        "700",
	    ),
	    "Caveat" => array(
	        "regular",
	        "700",
	    ),
	    "Caveat Brush" => array(
	        "regular",
	    ),
	    "Cedarville Cursive" => array(
	        "regular",
	    ),
	    "Ceviche One" => array(
	        "regular",
	    ),
	    "Changa One" => array(
	        "regular",
	    ),
	    "Chango" => array(
	        "regular",
	    ),
	    "Chau Philomene One" => array(
	        "regular",
	    ),
	    "Chela One" => array(
	        "regular",
	    ),
	    "Chelsea Market" => array(
	        "regular",
	    ),
	    "Chenla" => array(
	        "regular",
	    ),
	    "Cherry Cream Soda" => array(
	        "regular",
	    ),
	    "Cherry Swash" => array(
	        "regular",
	        "700",
	    ),
	    "Chewy" => array(
	        "regular",
	    ),
	    "Chicle" => array(
	        "regular",
	    ),
	    "Chivo" => array(
	        "regular",
	        "900",
	    ),
	    "Chonburi" => array(
	        "regular",
	    ),
	    "Cinzel" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Cinzel Decorative" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Clicker Script" => array(
	        "regular",
	    ),
	    "Coda" => array(
	        "regular",
	        "800",
	    ),
	    "Coda Caption" => array(
	        "800",
	    ),
	    "Codystar" => array(
	        "300",
	        "regular",
	    ),
	    "Combo" => array(
	        "regular",
	    ),
	    "Comfortaa" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Coming Soon" => array(
	        "regular",
	    ),
	    "Concert One" => array(
	        "regular",
	    ),
	    "Condiment" => array(
	        "regular",
	    ),
	    "Content" => array(
	        "regular",
	        "700",
	    ),
	    "Contrail One" => array(
	        "regular",
	    ),
	    "Convergence" => array(
	        "regular",
	    ),
	    "Cookie" => array(
	        "regular",
	    ),
	    "Copse" => array(
	        "regular",
	    ),
	    "Corben" => array(
	        "regular",
	        "700",
	    ),
	    "Courgette" => array(
	        "regular",
	    ),
	    "Cousine" => array(
	        "regular",
	        "700",
	    ),
	    "Coustard" => array(
	        "regular",
	        "900",
	    ),
	    "Covered By Your Grace" => array(
	        "regular",
	    ),
	    "Crafty Girls" => array(
	        "regular",
	    ),
	    "Creepster" => array(
	        "regular",
	    ),
	    "Crete Round" => array(
	        "regular",
	    ),
	    "Crimson Text" => array(
	        "regular",
	        "600",
	        "700",
	    ),
	    "Croissant One" => array(
	        "regular",
	    ),
	    "Crushed" => array(
	        "regular",
	    ),
	    "Cuprum" => array(
	        "regular",
	        "700",
	    ),
	    "Cutive" => array(
	        "regular",
	    ),
	    "Cutive Mono" => array(
	        "regular",
	    ),
	    "Damion" => array(
	        "regular",
	    ),
	    "Dancing Script" => array(
	        "regular",
	        "700",
	    ),
	    "Dangrek" => array(
	        "regular",
	    ),
	    "Dawning of a New Day" => array(
	        "regular",
	    ),
	    "Days One" => array(
	        "regular",
	    ),
	    "Dekko" => array(
	        "regular",
	    ),
	    "Delius" => array(
	        "regular",
	    ),
	    "Delius Swash Caps" => array(
	        "regular",
	    ),
	    "Delius Unicase" => array(
	        "regular",
	        "700",
	    ),
	    "Della Respira" => array(
	        "regular",
	    ),
	    "Denk One" => array(
	        "regular",
	    ),
	    "Devonshire" => array(
	        "regular",
	    ),
	    "Dhurjati" => array(
	        "regular",
	    ),
	    "Didact Gothic" => array(
	        "regular",
	    ),
	    "Diplomata" => array(
	        "regular",
	    ),
	    "Diplomata SC" => array(
	        "regular",
	    ),
	    "Domine" => array(
	        "regular",
	        "700",
	    ),
	    "Donegal One" => array(
	        "regular",
	    ),
	    "Doppio One" => array(
	        "regular",
	    ),
	    "Dorsa" => array(
	        "regular",
	    ),
	    "Dosis" => array(
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	    ),
	    "Dr Sugiyama" => array(
	        "regular",
	    ),
	    "Droid Sans" => array(
	        "regular",
	        "700",
	    ),
	    "Droid Sans Mono" => array(
	        "regular",
	    ),
	    "Droid Serif" => array(
	        "regular",
	        "700",
	    ),
	    "Duru Sans" => array(
	        "regular",
	    ),
	    "Dynalight" => array(
	        "regular",
	    ),
	    "EB Garamond" => array(
	        "regular",
	    ),
	    "Eagle Lake" => array(
	        "regular",
	    ),
	    "Eater" => array(
	        "regular",
	    ),
	    "Economica" => array(
	        "regular",
	        "700",
	    ),
	    "Eczar" => array(
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	    ),
	    "Ek Mukta" => array(
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	    ),
	    "Electrolize" => array(
	        "regular",
	    ),
	    "Elsie" => array(
	        "regular",
	        "900",
	    ),
	    "Elsie Swash Caps" => array(
	        "regular",
	        "900",
	    ),
	    "Emblema One" => array(
	        "regular",
	    ),
	    "Emilys Candy" => array(
	        "regular",
	    ),
	    "Engagement" => array(
	        "regular",
	    ),
	    "Englebert" => array(
	        "regular",
	    ),
	    "Enriqueta" => array(
	        "regular",
	        "700",
	    ),
	    "Erica One" => array(
	        "regular",
	    ),
	    "Esteban" => array(
	        "regular",
	    ),
	    "Euphoria Script" => array(
	        "regular",
	    ),
	    "Ewert" => array(
	        "regular",
	    ),
	    "Exo" => array(
	        "100",
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Exo 2" => array(
	        "100",
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Expletus Sans" => array(
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Fanwood Text" => array(
	        "regular",
	    ),
	    "Fascinate" => array(
	        "regular",
	    ),
	    "Fascinate Inline" => array(
	        "regular",
	    ),
	    "Faster One" => array(
	        "regular",
	    ),
	    "Fasthand" => array(
	        "regular",
	    ),
	    "Fauna One" => array(
	        "regular",
	    ),
	    "Federant" => array(
	        "regular",
	    ),
	    "Federo" => array(
	        "regular",
	    ),
	    "Felipa" => array(
	        "regular",
	    ),
	    "Fenix" => array(
	        "regular",
	    ),
	    "Finger Paint" => array(
	        "regular",
	    ),
	    "Fira Mono" => array(
	        "regular",
	        "700",
	    ),
	    "Fira Sans" => array(
	        "300",
	        "regular",
	        "500",
	        "700",
	    ),
	    "Fjalla One" => array(
	        "regular",
	    ),
	    "Fjord One" => array(
	        "regular",
	    ),
	    "Flamenco" => array(
	        "300",
	        "regular",
	    ),
	    "Flavors" => array(
	        "regular",
	    ),
	    "Fondamento" => array(
	        "regular",
	    ),
	    "Fontdiner Swanky" => array(
	        "regular",
	    ),
	    "Forum" => array(
	        "regular",
	    ),
	    "Francois One" => array(
	        "regular",
	    ),
	    "Freckle Face" => array(
	        "regular",
	    ),
	    "Fredericka the Great" => array(
	        "regular",
	    ),
	    "Fredoka One" => array(
	        "regular",
	    ),
	    "Freehand" => array(
	        "regular",
	    ),
	    "Fresca" => array(
	        "regular",
	    ),
	    "Frijole" => array(
	        "regular",
	    ),
	    "Fruktur" => array(
	        "regular",
	    ),
	    "Fugaz One" => array(
	        "regular",
	    ),
	    "GFS Didot" => array(
	        "regular",
	    ),
	    "GFS Neohellenic" => array(
	        "regular",
	        "700",
	    ),
	    "Gabriela" => array(
	        "regular",
	    ),
	    "Gafata" => array(
	        "regular",
	    ),
	    "Galdeano" => array(
	        "regular",
	    ),
	    "Galindo" => array(
	        "regular",
	    ),
	    "Gentium Basic" => array(
	        "regular",
	        "700",
	    ),
	    "Gentium Book Basic" => array(
	        "regular",
	        "700",
	    ),
	    "Geo" => array(
	        "regular",
	    ),
	    "Geostar" => array(
	        "regular",
	    ),
	    "Geostar Fill" => array(
	        "regular",
	    ),
	    "Germania One" => array(
	        "regular",
	    ),
	    "Gidugu" => array(
	        "regular",
	    ),
	    "Gilda Display" => array(
	        "regular",
	    ),
	    "Give You Glory" => array(
	        "regular",
	    ),
	    "Glass Antiqua" => array(
	        "regular",
	    ),
	    "Glegoo" => array(
	        "regular",
	        "700",
	    ),
	    "Gloria Hallelujah" => array(
	        "regular",
	    ),
	    "Goblin One" => array(
	        "regular",
	    ),
	    "Gochi Hand" => array(
	        "regular",
	    ),
	    "Gorditas" => array(
	        "regular",
	        "700",
	    ),
	    "Goudy Bookletter 1911" => array(
	        "regular",
	    ),
	    "Graduate" => array(
	        "regular",
	    ),
	    "Grand Hotel" => array(
	        "regular",
	    ),
	    "Gravitas One" => array(
	        "regular",
	    ),
	    "Great Vibes" => array(
	        "regular",
	    ),
	    "Griffy" => array(
	        "regular",
	    ),
	    "Gruppo" => array(
	        "regular",
	    ),
	    "Gudea" => array(
	        "regular",
	        "700",
	    ),
	    "Gurajada" => array(
	        "regular",
	    ),
	    "Habibi" => array(
	        "regular",
	    ),
	    "Halant" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Hammersmith One" => array(
	        "regular",
	    ),
	    "Hanalei" => array(
	        "regular",
	    ),
	    "Hanalei Fill" => array(
	        "regular",
	    ),
	    "Handlee" => array(
	        "regular",
	    ),
	    "Hanuman" => array(
	        "regular",
	        "700",
	    ),
	    "Happy Monkey" => array(
	        "regular",
	    ),
	    "Headland One" => array(
	        "regular",
	    ),
	    "Henny Penny" => array(
	        "regular",
	    ),
	    "Herr Von Muellerhoff" => array(
	        "regular",
	    ),
	    "Hind" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Hind Siliguri" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Hind Vadodara" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Holtwood One SC" => array(
	        "regular",
	    ),
	    "Homemade Apple" => array(
	        "regular",
	    ),
	    "Homenaje" => array(
	        "regular",
	    ),
	    "IM Fell DW Pica" => array(
	        "regular",
	    ),
	    "IM Fell DW Pica SC" => array(
	        "regular",
	    ),
	    "IM Fell Double Pica" => array(
	        "regular",
	    ),
	    "IM Fell Double Pica SC" => array(
	        "regular",
	    ),
	    "IM Fell English" => array(
	        "regular",
	    ),
	    "IM Fell English SC" => array(
	        "regular",
	    ),
	    "IM Fell French Canon" => array(
	        "regular",
	    ),
	    "IM Fell French Canon SC" => array(
	        "regular",
	    ),
	    "IM Fell Great Primer" => array(
	        "regular",
	    ),
	    "IM Fell Great Primer SC" => array(
	        "regular",
	    ),
	    "Iceberg" => array(
	        "regular",
	    ),
	    "Iceland" => array(
	        "regular",
	    ),
	    "Imprima" => array(
	        "regular",
	    ),
	    "Inconsolata" => array(
	        "regular",
	        "700",
	    ),
	    "Inder" => array(
	        "regular",
	    ),
	    "Indie Flower" => array(
	        "regular",
	    ),
	    "Inika" => array(
	        "regular",
	        "700",
	    ),
	    "Inknut Antiqua" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Irish Grover" => array(
	        "regular",
	    ),
	    "Istok Web" => array(
	        "regular",
	        "700",
	    ),
	    "Italiana" => array(
	        "regular",
	    ),
	    "Italianno" => array(
	        "regular",
	    ),
	    "Itim" => array(
	        "regular",
	    ),
	    "Jacques Francois" => array(
	        "regular",
	    ),
	    "Jacques Francois Shadow" => array(
	        "regular",
	    ),
	    "Jaldi" => array(
	        "regular",
	        "700",
	    ),
	    "Jim Nightshade" => array(
	        "regular",
	    ),
	    "Jockey One" => array(
	        "regular",
	    ),
	    "Jolly Lodger" => array(
	        "regular",
	    ),
	    "Josefin Sans" => array(
	        "100",
	        "300",
	        "regular",
	        "600",
	        "700",
	    ),
	    "Josefin Slab" => array(
	        "100",
	        "300",
	        "regular",
	        "600",
	        "700",
	    ),
	    "Joti One" => array(
	        "regular",
	    ),
	    "Judson" => array(
	        "regular",
	        "700",
	    ),
	    "Julee" => array(
	        "regular",
	    ),
	    "Julius Sans One" => array(
	        "regular",
	    ),
	    "Junge" => array(
	        "regular",
	    ),
	    "Jura" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	    ),
	    "Just Another Hand" => array(
	        "regular",
	    ),
	    "Just Me Again Down Here" => array(
	        "regular",
	    ),
	    "Kadwa" => array(
	        "regular",
	        "700",
	    ),
	    "Kalam" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Kameron" => array(
	        "regular",
	        "700",
	    ),
	    "Kanit" => array(
	        "100",
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Kantumruy" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Karla" => array(
	        "regular",
	        "700",
	    ),
	    "Karma" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Kaushan Script" => array(
	        "regular",
	    ),
	    "Kavoon" => array(
	        "regular",
	    ),
	    "Kdam Thmor" => array(
	        "regular",
	    ),
	    "Keania One" => array(
	        "regular",
	    ),
	    "Kelly Slab" => array(
	        "regular",
	    ),
	    "Kenia" => array(
	        "regular",
	    ),
	    "Khand" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Khmer" => array(
	        "regular",
	    ),
	    "Khula" => array(
	        "300",
	        "regular",
	        "600",
	        "700",
	        "800",
	    ),
	    "Kite One" => array(
	        "regular",
	    ),
	    "Knewave" => array(
	        "regular",
	    ),
	    "Kotta One" => array(
	        "regular",
	    ),
	    "Koulen" => array(
	        "regular",
	    ),
	    "Kranky" => array(
	        "regular",
	    ),
	    "Kreon" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Kristi" => array(
	        "regular",
	    ),
	    "Krona One" => array(
	        "regular",
	    ),
	    "Kurale" => array(
	        "regular",
	    ),
	    "La Belle Aurore" => array(
	        "regular",
	    ),
	    "Laila" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Lakki Reddy" => array(
	        "regular",
	    ),
	    "Lancelot" => array(
	        "regular",
	    ),
	    "Lateef" => array(
	        "regular",
	    ),
	    "Lato" => array(
	        "100",
	        "300",
	        "regular",
	        "700",
	        "900",
	    ),
	    "League Script" => array(
	        "regular",
	    ),
	    "Leckerli One" => array(
	        "regular",
	    ),
	    "Ledger" => array(
	        "regular",
	    ),
	    "Lekton" => array(
	        "regular",
	        "700",
	    ),
	    "Lemon" => array(
	        "regular",
	    ),
	    "Libre Baskerville" => array(
	        "regular",
	        "700",
	    ),
	    "Life Savers" => array(
	        "regular",
	        "700",
	    ),
	    "Lilita One" => array(
	        "regular",
	    ),
	    "Lily Script One" => array(
	        "regular",
	    ),
	    "Limelight" => array(
	        "regular",
	    ),
	    "Linden Hill" => array(
	        "regular",
	    ),
	    "Lobster" => array(
	        "regular",
	    ),
	    "Lobster Two" => array(
	        "regular",
	        "700",
	    ),
	    "Londrina Outline" => array(
	        "regular",
	    ),
	    "Londrina Shadow" => array(
	        "regular",
	    ),
	    "Londrina Sketch" => array(
	        "regular",
	    ),
	    "Londrina Solid" => array(
	        "regular",
	    ),
	    "Lora" => array(
	        "regular",
	        "700",
	    ),
	    "Love Ya Like A Sister" => array(
	        "regular",
	    ),
	    "Loved by the King" => array(
	        "regular",
	    ),
	    "Lovers Quarrel" => array(
	        "regular",
	    ),
	    "Luckiest Guy" => array(
	        "regular",
	    ),
	    "Lusitana" => array(
	        "regular",
	        "700",
	    ),
	    "Lustria" => array(
	        "regular",
	    ),
	    "Macondo" => array(
	        "regular",
	    ),
	    "Macondo Swash Caps" => array(
	        "regular",
	    ),
	    "Magra" => array(
	        "regular",
	        "700",
	    ),
	    "Maiden Orange" => array(
	        "regular",
	    ),
	    "Mako" => array(
	        "regular",
	    ),
	    "Mallanna" => array(
	        "regular",
	    ),
	    "Mandali" => array(
	        "regular",
	    ),
	    "Marcellus" => array(
	        "regular",
	    ),
	    "Marcellus SC" => array(
	        "regular",
	    ),
	    "Marck Script" => array(
	        "regular",
	    ),
	    "Margarine" => array(
	        "regular",
	    ),
	    "Marko One" => array(
	        "regular",
	    ),
	    "Marmelad" => array(
	        "regular",
	    ),
	    "Martel" => array(
	        "200",
	        "300",
	        "regular",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Martel Sans" => array(
	        "200",
	        "300",
	        "regular",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Marvel" => array(
	        "regular",
	        "700",
	    ),
	    "Mate" => array(
	        "regular",
	    ),
	    "Mate SC" => array(
	        "regular",
	    ),
	    "Maven Pro" => array(
	        "regular",
	        "500",
	        "700",
	        "900",
	    ),
	    "McLaren" => array(
	        "regular",
	    ),
	    "Meddon" => array(
	        "regular",
	    ),
	    "MedievalSharp" => array(
	        "regular",
	    ),
	    "Medula One" => array(
	        "regular",
	    ),
	    "Megrim" => array(
	        "regular",
	    ),
	    "Meie Script" => array(
	        "regular",
	    ),
	    "Merienda" => array(
	        "regular",
	        "700",
	    ),
	    "Merienda One" => array(
	        "regular",
	    ),
	    "Merriweather" => array(
	        "300",
	        "regular",
	        "700",
	        "900",
	    ),
	    "Merriweather Sans" => array(
	        "300",
	        "regular",
	        "700",
	        "800",
	    ),
	    "Metal" => array(
	        "regular",
	    ),
	    "Metal Mania" => array(
	        "regular",
	    ),
	    "Metamorphous" => array(
	        "regular",
	    ),
	    "Metrophobic" => array(
	        "regular",
	    ),
	    "Michroma" => array(
	        "regular",
	    ),
	    "Milonga" => array(
	        "regular",
	    ),
	    "Miltonian" => array(
	        "regular",
	    ),
	    "Miltonian Tattoo" => array(
	        "regular",
	    ),
	    "Miniver" => array(
	        "regular",
	    ),
	    "Miss Fajardose" => array(
	        "regular",
	    ),
	    "Modak" => array(
	        "regular",
	    ),
	    "Modern Antiqua" => array(
	        "regular",
	    ),
	    "Molengo" => array(
	        "regular",
	    ),
	    "Molle" => array(
	    ),
	    "Monda" => array(
	        "regular",
	        "700",
	    ),
	    "Monofett" => array(
	        "regular",
	    ),
	    "Monoton" => array(
	        "regular",
	    ),
	    "Monsieur La Doulaise" => array(
	        "regular",
	    ),
	    "Montaga" => array(
	        "regular",
	    ),
	    "Montez" => array(
	        "regular",
	    ),
	    "Montserrat" => array(
	        "regular",
	        "700",
	    ),
	    "Montserrat Alternates" => array(
	        "regular",
	        "700",
	    ),
	    "Montserrat Subrayada" => array(
	        "regular",
	        "700",
	    ),
	    "Moul" => array(
	        "regular",
	    ),
	    "Moulpali" => array(
	        "regular",
	    ),
	    "Mountains of Christmas" => array(
	        "regular",
	        "700",
	    ),
	    "Mouse Memoirs" => array(
	        "regular",
	    ),
	    "Mr Bedfort" => array(
	        "regular",
	    ),
	    "Mr Dafoe" => array(
	        "regular",
	    ),
	    "Mr De Haviland" => array(
	        "regular",
	    ),
	    "Mrs Saint Delafield" => array(
	        "regular",
	    ),
	    "Mrs Sheppards" => array(
	        "regular",
	    ),
	    "Muli" => array(
	        "300",
	        "regular",
	    ),
	    "Mystery Quest" => array(
	        "regular",
	    ),
	    "NTR" => array(
	        "regular",
	    ),
	    "Neucha" => array(
	        "regular",
	    ),
	    "Neuton" => array(
	        "200",
	        "300",
	        "regular",
	        "700",
	        "800",
	    ),
	    "New Rocker" => array(
	        "regular",
	    ),
	    "News Cycle" => array(
	        "regular",
	        "700",
	    ),
	    "Niconne" => array(
	        "regular",
	    ),
	    "Nixie One" => array(
	        "regular",
	    ),
	    "Nobile" => array(
	        "regular",
	        "700",
	    ),
	    "Nokora" => array(
	        "regular",
	        "700",
	    ),
	    "Norican" => array(
	        "regular",
	    ),
	    "Nosifer" => array(
	        "regular",
	    ),
	    "Nothing You Could Do" => array(
	        "regular",
	    ),
	    "Noticia Text" => array(
	        "regular",
	        "700",
	    ),
	    "Noto Sans" => array(
	        "regular",
	        "700",
	    ),
	    "Noto Serif" => array(
	        "regular",
	        "700",
	    ),
	    "Nova Cut" => array(
	        "regular",
	    ),
	    "Nova Flat" => array(
	        "regular",
	    ),
	    "Nova Mono" => array(
	        "regular",
	    ),
	    "Nova Oval" => array(
	        "regular",
	    ),
	    "Nova Round" => array(
	        "regular",
	    ),
	    "Nova Script" => array(
	        "regular",
	    ),
	    "Nova Slim" => array(
	        "regular",
	    ),
	    "Nova Square" => array(
	        "regular",
	    ),
	    "Numans" => array(
	        "regular",
	    ),
	    "Nunito" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Odor Mean Chey" => array(
	        "regular",
	    ),
	    "Offside" => array(
	        "regular",
	    ),
	    "Old Standard TT" => array(
	        "regular",
	        "700",
	    ),
	    "Oldenburg" => array(
	        "regular",
	    ),
	    "Oleo Script" => array(
	        "regular",
	        "700",
	    ),
	    "Oleo Script Swash Caps" => array(
	        "regular",
	        "700",
	    ),
	    "Open Sans" => array(
	        "300",
	        "regular",
	        "600",
	        "700",
	        "800",
	    ),
	    "Open Sans Condensed" => array(
	        "300",
	        "700",
	    ),
	    "Oranienbaum" => array(
	        "regular",
	    ),
	    "Orbitron" => array(
	        "regular",
	        "500",
	        "700",
	        "900",
	    ),
	    "Oregano" => array(
	        "regular",
	    ),
	    "Orienta" => array(
	        "regular",
	    ),
	    "Original Surfer" => array(
	        "regular",
	    ),
	    "Oswald" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Over the Rainbow" => array(
	        "regular",
	    ),
	    "Overlock" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Overlock SC" => array(
	        "regular",
	    ),
	    "Ovo" => array(
	        "regular",
	    ),
	    "Oxygen" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Oxygen Mono" => array(
	        "regular",
	    ),
	    "PT Mono" => array(
	        "regular",
	    ),
	    "PT Sans" => array(
	        "regular",
	        "700",
	    ),
	    "PT Sans Caption" => array(
	        "regular",
	        "700",
	    ),
	    "PT Sans Narrow" => array(
	        "regular",
	        "700",
	    ),
	    "PT Serif" => array(
	        "regular",
	        "700",
	    ),
	    "PT Serif Caption" => array(
	        "regular",
	    ),
	    "Pacifico" => array(
	        "regular",
	    ),
	    "Palanquin" => array(
	        "100",
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Palanquin Dark" => array(
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Paprika" => array(
	        "regular",
	    ),
	    "Parisienne" => array(
	        "regular",
	    ),
	    "Passero One" => array(
	        "regular",
	    ),
	    "Passion One" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Pathway Gothic One" => array(
	        "regular",
	    ),
	    "Patrick Hand" => array(
	        "regular",
	    ),
	    "Patrick Hand SC" => array(
	        "regular",
	    ),
	    "Patua One" => array(
	        "regular",
	    ),
	    "Paytone One" => array(
	        "regular",
	    ),
	    "Peddana" => array(
	        "regular",
	    ),
	    "Peralta" => array(
	        "regular",
	    ),
	    "Permanent Marker" => array(
	        "regular",
	    ),
	    "Petit Formal Script" => array(
	        "regular",
	    ),
	    "Petrona" => array(
	        "regular",
	    ),
	    "Philosopher" => array(
	        "regular",
	        "700",
	    ),
	    "Piedra" => array(
	        "regular",
	    ),
	    "Pinyon Script" => array(
	        "regular",
	    ),
	    "Pirata One" => array(
	        "regular",
	    ),
	    "Plaster" => array(
	        "regular",
	    ),
	    "Play" => array(
	        "regular",
	        "700",
	    ),
	    "Playball" => array(
	        "regular",
	    ),
	    "Playfair Display" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Playfair Display SC" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Podkova" => array(
	        "regular",
	        "700",
	    ),
	    "Poiret One" => array(
	        "regular",
	    ),
	    "Poller One" => array(
	        "regular",
	    ),
	    "Poly" => array(
	        "regular",
	    ),
	    "Pompiere" => array(
	        "regular",
	    ),
	    "Pontano Sans" => array(
	        "regular",
	    ),
	    "Poppins" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Port Lligat Sans" => array(
	        "regular",
	    ),
	    "Port Lligat Slab" => array(
	        "regular",
	    ),
	    "Pragati Narrow" => array(
	        "regular",
	        "700",
	    ),
	    "Prata" => array(
	        "regular",
	    ),
	    "Preahvihear" => array(
	        "regular",
	    ),
	    "Press Start 2P" => array(
	        "regular",
	    ),
	    "Princess Sofia" => array(
	        "regular",
	    ),
	    "Prociono" => array(
	        "regular",
	    ),
	    "Prosto One" => array(
	        "regular",
	    ),
	    "Puritan" => array(
	        "regular",
	        "700",
	    ),
	    "Purple Purse" => array(
	        "regular",
	    ),
	    "Quando" => array(
	        "regular",
	    ),
	    "Quantico" => array(
	        "regular",
	        "700",
	    ),
	    "Quattrocento" => array(
	        "regular",
	        "700",
	    ),
	    "Quattrocento Sans" => array(
	        "regular",
	        "700",
	    ),
	    "Questrial" => array(
	        "regular",
	    ),
	    "Quicksand" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Quintessential" => array(
	        "regular",
	    ),
	    "Qwigley" => array(
	        "regular",
	    ),
	    "Racing Sans One" => array(
	        "regular",
	    ),
	    "Radley" => array(
	        "regular",
	    ),
	    "Rajdhani" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Raleway" => array(
	        "100",
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Raleway Dots" => array(
	        "regular",
	    ),
	    "Ramabhadra" => array(
	        "regular",
	    ),
	    "Ramaraja" => array(
	        "regular",
	    ),
	    "Rambla" => array(
	        "regular",
	        "700",
	    ),
	    "Rammetto One" => array(
	        "regular",
	    ),
	    "Ranchers" => array(
	        "regular",
	    ),
	    "Rancho" => array(
	        "regular",
	    ),
	    "Ranga" => array(
	        "regular",
	        "700",
	    ),
	    "Rationale" => array(
	        "regular",
	    ),
	    "Ravi Prakash" => array(
	        "regular",
	    ),
	    "Redressed" => array(
	        "regular",
	    ),
	    "Reenie Beanie" => array(
	        "regular",
	    ),
	    "Revalia" => array(
	        "regular",
	    ),
	    "Rhodium Libre" => array(
	        "regular",
	    ),
	    "Ribeye" => array(
	        "regular",
	    ),
	    "Ribeye Marrow" => array(
	        "regular",
	    ),
	    "Righteous" => array(
	        "regular",
	    ),
	    "Risque" => array(
	        "regular",
	    ),
	    "Roboto" => array(
	        "100",
	        "300",
	        "regular",
	        "500",
	        "700",
	        "900",
	    ),
	    "Roboto Condensed" => array(
	        "300",
	        "regular",
	        "700",
	    ),
	    "Roboto Mono" => array(
	        "100",
	        "300",
	        "regular",
	        "500",
	        "700",
	    ),
	    "Roboto Slab" => array(
	        "100",
	        "300",
	        "regular",
	        "700",
	    ),
	    "Rochester" => array(
	        "regular",
	    ),
	    "Rock Salt" => array(
	        "regular",
	    ),
	    "Rokkitt" => array(
	        "regular",
	        "700",
	    ),
	    "Romanesco" => array(
	        "regular",
	    ),
	    "Ropa Sans" => array(
	        "regular",
	    ),
	    "Rosario" => array(
	        "regular",
	        "700",
	    ),
	    "Rosarivo" => array(
	        "regular",
	    ),
	    "Rouge Script" => array(
	        "regular",
	    ),
	    "Rozha One" => array(
	        "regular",
	    ),
	    "Rubik" => array(
	        "300",
	        "regular",
	        "500",
	        "700",
	        "900",
	    ),
	    "Rubik Mono One" => array(
	        "regular",
	    ),
	    "Rubik One" => array(
	        "regular",
	    ),
	    "Ruda" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Rufina" => array(
	        "regular",
	        "700",
	    ),
	    "Ruge Boogie" => array(
	        "regular",
	    ),
	    "Ruluko" => array(
	        "regular",
	    ),
	    "Rum Raisin" => array(
	        "regular",
	    ),
	    "Ruslan Display" => array(
	        "regular",
	    ),
	    "Russo One" => array(
	        "regular",
	    ),
	    "Ruthie" => array(
	        "regular",
	    ),
	    "Rye" => array(
	        "regular",
	    ),
	    "Sacramento" => array(
	        "regular",
	    ),
	    "Sahitya" => array(
	        "regular",
	        "700",
	    ),
	    "Sail" => array(
	        "regular",
	    ),
	    "Salsa" => array(
	        "regular",
	    ),
	    "Sanchez" => array(
	        "regular",
	    ),
	    "Sancreek" => array(
	        "regular",
	    ),
	    "Sansita One" => array(
	        "regular",
	    ),
	    "Sarala" => array(
	        "regular",
	        "700",
	    ),
	    "Sarina" => array(
	        "regular",
	    ),
	    "Sarpanch" => array(
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Satisfy" => array(
	        "regular",
	    ),
	    "Scada" => array(
	        "regular",
	        "700",
	    ),
	    "Scheherazade" => array(
	        "regular",
	        "700",
	    ),
	    "Schoolbell" => array(
	        "regular",
	    ),
	    "Seaweed Script" => array(
	        "regular",
	    ),
	    "Sevillana" => array(
	        "regular",
	    ),
	    "Seymour One" => array(
	        "regular",
	    ),
	    "Shadows Into Light" => array(
	        "regular",
	    ),
	    "Shadows Into Light Two" => array(
	        "regular",
	    ),
	    "Shanti" => array(
	        "regular",
	    ),
	    "Share" => array(
	        "regular",
	        "700",
	    ),
	    "Share Tech" => array(
	        "regular",
	    ),
	    "Share Tech Mono" => array(
	        "regular",
	    ),
	    "Shojumaru" => array(
	        "regular",
	    ),
	    "Short Stack" => array(
	        "regular",
	    ),
	    "Siemreap" => array(
	        "regular",
	    ),
	    "Sigmar One" => array(
	        "regular",
	    ),
	    "Signika" => array(
	        "300",
	        "regular",
	        "600",
	        "700",
	    ),
	    "Signika Negative" => array(
	        "300",
	        "regular",
	        "600",
	        "700",
	    ),
	    "Simonetta" => array(
	        "regular",
	        "900",
	    ),
	    "Sintony" => array(
	        "regular",
	        "700",
	    ),
	    "Sirin Stencil" => array(
	        "regular",
	    ),
	    "Six Caps" => array(
	        "regular",
	    ),
	    "Skranji" => array(
	        "regular",
	        "700",
	    ),
	    "Slabo 13px" => array(
	        "regular",
	    ),
	    "Slabo 27px" => array(
	        "regular",
	    ),
	    "Slackey" => array(
	        "regular",
	    ),
	    "Smokum" => array(
	        "regular",
	    ),
	    "Smythe" => array(
	        "regular",
	    ),
	    "Sniglet" => array(
	        "regular",
	        "800",
	    ),
	    "Snippet" => array(
	        "regular",
	    ),
	    "Snowburst One" => array(
	        "regular",
	    ),
	    "Sofadi One" => array(
	        "regular",
	    ),
	    "Sofia" => array(
	        "regular",
	    ),
	    "Sonsie One" => array(
	        "regular",
	    ),
	    "Sorts Mill Goudy" => array(
	        "regular",
	    ),
	    "Source Code Pro" => array(
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "900",
	    ),
	    "Source Sans Pro" => array(
	        "200",
	        "300",
	        "regular",
	        "600",
	        "700",
	        "900",
	    ),
	    "Source Serif Pro" => array(
	        "regular",
	        "600",
	        "700",
	    ),
	    "Special Elite" => array(
	        "regular",
	    ),
	    "Spicy Rice" => array(
	        "regular",
	    ),
	    "Spinnaker" => array(
	        "regular",
	    ),
	    "Spirax" => array(
	        "regular",
	    ),
	    "Squada One" => array(
	        "regular",
	    ),
	    "Sree Krushnadevaraya" => array(
	        "regular",
	    ),
	    "Stalemate" => array(
	        "regular",
	    ),
	    "Stalinist One" => array(
	        "regular",
	    ),
	    "Stardos Stencil" => array(
	        "regular",
	        "700",
	    ),
	    "Stint Ultra Condensed" => array(
	        "regular",
	    ),
	    "Stint Ultra Expanded" => array(
	        "regular",
	    ),
	    "Stoke" => array(
	        "300",
	        "regular",
	    ),
	    "Strait" => array(
	        "regular",
	    ),
	    "Sue Ellen Francisco" => array(
	        "regular",
	    ),
	    "Sumana" => array(
	        "regular",
	        "700",
	    ),
	    "Sunshiney" => array(
	        "regular",
	    ),
	    "Supermercado One" => array(
	        "regular",
	    ),
	    "Sura" => array(
	        "regular",
	        "700",
	    ),
	    "Suranna" => array(
	        "regular",
	    ),
	    "Suravaram" => array(
	        "regular",
	    ),
	    "Suwannaphum" => array(
	        "regular",
	    ),
	    "Swanky and Moo Moo" => array(
	        "regular",
	    ),
	    "Syncopate" => array(
	        "regular",
	        "700",
	    ),
	    "Tangerine" => array(
	        "regular",
	        "700",
	    ),
	    "Taprom" => array(
	        "regular",
	    ),
	    "Tauri" => array(
	        "regular",
	    ),
	    "Teko" => array(
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	    ),
	    "Telex" => array(
	        "regular",
	    ),
	    "Tenali Ramakrishna" => array(
	        "regular",
	    ),
	    "Tenor Sans" => array(
	        "regular",
	    ),
	    "Text Me One" => array(
	        "regular",
	    ),
	    "The Girl Next Door" => array(
	        "regular",
	    ),
	    "Tienne" => array(
	        "regular",
	        "700",
	        "900",
	    ),
	    "Tillana" => array(
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	    ),
	    "Timmana" => array(
	        "regular",
	    ),
	    "Tinos" => array(
	        "regular",
	        "700",
	    ),
	    "Titan One" => array(
	        "regular",
	    ),
	    "Titillium Web" => array(
	        "200",
	        "300",
	        "regular",
	        "600",
	        "700",
	        "900",
	    ),
	    "Trade Winds" => array(
	        "regular",
	    ),
	    "Trocchi" => array(
	        "regular",
	    ),
	    "Trochut" => array(
	        "regular",
	        "700",
	    ),
	    "Trykker" => array(
	        "regular",
	    ),
	    "Tulpen One" => array(
	        "regular",
	    ),
	    "Ubuntu" => array(
	        "300",
	        "regular",
	        "500",
	        "700",
	    ),
	    "Ubuntu Condensed" => array(
	        "regular",
	    ),
	    "Ubuntu Mono" => array(
	        "regular",
	        "700",
	    ),
	    "Ultra" => array(
	        "regular",
	    ),
	    "Uncial Antiqua" => array(
	        "regular",
	    ),
	    "Underdog" => array(
	        "regular",
	    ),
	    "Unica One" => array(
	        "regular",
	    ),
	    "UnifrakturCook" => array(
	        "700",
	    ),
	    "UnifrakturMaguntia" => array(
	        "regular",
	    ),
	    "Unkempt" => array(
	        "regular",
	        "700",
	    ),
	    "Unlock" => array(
	        "regular",
	    ),
	    "Unna" => array(
	        "regular",
	    ),
	    "VT323" => array(
	        "regular",
	    ),
	    "Vampiro One" => array(
	        "regular",
	    ),
	    "Varela" => array(
	        "regular",
	    ),
	    "Varela Round" => array(
	        "regular",
	    ),
	    "Vast Shadow" => array(
	        "regular",
	    ),
	    "Vesper Libre" => array(
	        "regular",
	        "500",
	        "700",
	        "900",
	    ),
	    "Vibur" => array(
	        "regular",
	    ),
	    "Vidaloka" => array(
	        "regular",
	    ),
	    "Viga" => array(
	        "regular",
	    ),
	    "Voces" => array(
	        "regular",
	    ),
	    "Volkhov" => array(
	        "regular",
	        "700",
	    ),
	    "Vollkorn" => array(
	        "regular",
	        "700",
	    ),
	    "Voltaire" => array(
	        "regular",
	    ),
	    "Waiting for the Sunrise" => array(
	        "regular",
	    ),
	    "Wallpoet" => array(
	        "regular",
	    ),
	    "Walter Turncoat" => array(
	        "regular",
	    ),
	    "Warnes" => array(
	        "regular",
	    ),
	    "Wellfleet" => array(
	        "regular",
	    ),
	    "Wendy One" => array(
	        "regular",
	    ),
	    "Wire One" => array(
	        "regular",
	    ),
	    "Work Sans" => array(
	        "100",
	        "200",
	        "300",
	        "regular",
	        "500",
	        "600",
	        "700",
	        "800",
	        "900",
	    ),
	    "Yanone Kaffeesatz" => array(
	        "200",
	        "300",
	        "regular",
	        "700",
	    ),
	    "Yantramanav" => array(
	        "100",
	        "300",
	        "regular",
	        "500",
	        "700",
	        "900",
	    ),
	    "Yellowtail" => array(
	        "regular",
	    ),
	    "Yeseva One" => array(
	        "regular",
	    ),
	    "Yesteryear" => array(
	        "regular",
	    ),
	    "Zeyada" => array(
	        "regular",
	    ),
	);
}