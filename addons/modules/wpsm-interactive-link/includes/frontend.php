<?php 
$span = false;
if( $settings->il_style == 'effect-b' || $settings->il_style == 'effect-h' || $settings->il_style == 'effect-j' ) {
	$span = true;
}


?><div class="wpsm-ilink-wrap il-<?php echo $settings->il_style; ?> csstransforms3d"><?php 
	for ( $i = 0; $i < count( $settings->items ); $i++ ) : 
		if ( empty( $settings->items[ $i ] ) ) continue; 
	?><a href="<?php echo $settings->items[ $i ]->link; ?>" target="<?php echo $settings->items[ $i ]->link_target; ?>" class="wpsm-ilink"<?php 
		if ( ! empty( $settings->id ) ) echo ' id="' . sanitize_html_class( $settings->id ) . '-' . $i . '"'; 
		if ( $settings->il_style == 'effect-h' ) echo 'data-hover="'.$settings->items[ $i ]->link_text.'"'?>><?php 
		if( $span ) {
			echo '<span data-hover="'.$settings->items[ $i ]->link_text.'">';
		}
		echo $settings->items[ $i ]->link_text;
		if( $span ) {
			echo '</span>';
		}
	?></a><?php endfor; 
?></div>