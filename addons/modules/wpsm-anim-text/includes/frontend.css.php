.fl-node-<?php echo $id; ?> .wpsm-anim-text-wrap {
	<?php if( !empty($settings->font_family) && $settings->font_family['family'] != 'Default' ) : ?>
	<?php FLBuilderFonts::font_css( $settings->font_family ); ?>
	<?php endif; ?>

	<?php if( !empty($settings->font_size) ) : ?>
		font-size: <?php echo $settings->font_size; ?>px;
	<?php endif; ?>

	<?php if( !empty($settings->line_height) ) : ?>
		line-height: <?php echo $settings->line_height; ?>px;
	<?php endif; ?>

	<?php if( !empty($settings->align) ) : ?>
		text-align: <?php echo $settings->align; ?>;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .wpsm-anim-text-wrap,
.fl-node-<?php echo $id; ?> .wpsm-animated {
	<?php if( !empty($settings->anim_color) ) : ?>
		color: #<?php echo $settings->anim_color; ?>;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .wpsm-prefix,
.fl-node-<?php echo $id; ?> .wpsm-suffix {
	<?php if( !empty($settings->pre_suf_color) ) : ?>
		color: #<?php echo $settings->pre_suf_color; ?>;
	<?php endif; ?>
}




<?php if ( ( $settings->showCursor == 'true' ) && ( $settings->blinkCursor == 'true' ) ) { ?>
	.fl-node-<?php echo $id; ?> .typed-cursor{
		    opacity: 1;
		    -webkit-animation: blink 0.7s infinite;
		    -moz-animation: blink 0.7s infinite;
		    animation: blink 0.7s infinite;
	}
	@keyframes blink{
	    0% { opacity:1; }
	    50% { opacity:0; }
	    100% { opacity:1; }
	}
	@-webkit-keyframes blink{
	    0% { opacity:1; }
	    50% { opacity:0; }
	    100% { opacity:1; }
	}
	@-moz-keyframes blink{
	    0% { opacity:1; }
	    50% { opacity:0; }
	    100% { opacity:1; }
	}
<?php } ?>
