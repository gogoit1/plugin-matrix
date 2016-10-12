.fl-node-<?php echo $id; ?> .wpsm-ilink-wrap {
	text-align: <?php echo $settings->align; ?>
}

.fl-node-<?php echo $id; ?> .wpsm-ilink-wrap a {
	<?php if( $settings->item_spacing != '' ) { ?>
	margin-left: <?php echo $settings->item_spacing; ?>px;
	margin-right: <?php echo $settings->item_spacing; ?>px;
	<?php } ?>	
}

.fl-node-<?php echo $id; ?> .wpsm-ilink-wrap a,
.fl-node-<?php echo $id; ?> .wpsm-ilink-wrap a span {
	<?php if( !empty($settings->font) && $settings->font['family'] != 'Default' ) : ?>
	<?php FLBuilderFonts::font_css( $settings->font ); ?>
	<?php endif; ?>
	<?php echo ( $settings->font_size != '' ) ? 'font-size: '.$settings->font_size.'px;' : ''; ?>
	<?php echo ( $settings->line_height != '' ) ? 'line-height: '.$settings->line_height.'px;' : ''; ?>
	<?php if( $settings->txt_color != '' ) { ?>
	color: #<?php echo $settings->txt_color; ?>;
	<?php } ?>	
}



<?php if( $settings->il_style == 'effect-a' ) { ?>
	
	/* Effect A: Brackets */
	.fl-node-<?php echo $id; ?> .il-effect-a a::before,
	.fl-node-<?php echo $id; ?> .il-effect-a a::after {
		display: inline-block;
		font-size: 1.3em;
		opacity: 0;
		-webkit-transition: -webkit-transform 0.3s, opacity 0.2s;
		-moz-transition: -moz-transform 0.3s, opacity 0.2s;
		transition: transform 0.3s, opacity 0.2s;
	}

	.fl-node-<?php echo $id; ?> .il-effect-a a::before {
		margin-right: 0.3em;
		content: '[';
		-webkit-transform: translateX(20px);
		-moz-transform: translateX(20px);
		transform: translateX(20px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-a a::after {
		margin-left: 0.3em;
		content: ']';
		-webkit-transform: translateX(-20px);
		-moz-transform: translateX(-20px);
		transform: translateX(-20px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-a a:hover::before,
	.fl-node-<?php echo $id; ?> .il-effect-a a:hover::after,
	.fl-node-<?php echo $id; ?> .il-effect-a a:focus::before,
	.fl-node-<?php echo $id; ?> .il-effect-a a:focus::after {
		opacity: 1;
		-webkit-transform: translateX(0px);
		-moz-transform: translateX(0px);
		transform: translateX(0px);
	}
<?php }elseif( $settings->il_style == 'effect-b' ) { ?>
	
	/* Effect B: 3D rolling links, idea from http://hakim.se/thoughts/rolling-links */
	.fl-node-<?php echo $id; ?> .il-effect-b a {
		line-height: 1.3em;
		color: white;
		<?php if( $settings->txt_color != '' ) { ?>
		color: #<?php echo $settings->txt_color; ?>;
		<?php } ?>
		-webkit-perspective: 1000px;
		-moz-perspective: 1000px;
		perspective: 1000px;
	}

	.fl-node-<?php echo $id; ?> .il-effect-b a span {
		position: relative;
		display: inline-block;
		padding: 7px 14px;
		background: #2195de;
		<?php if( $settings->bg_color != '' ) { ?>
		background: #<?php echo $settings->bg_color; ?>;
		<?php } ?>
		-webkit-transition: -webkit-transform 0.3s;
		-moz-transition: -moz-transform 0.3s;
		transition: transform 0.3s;
		-webkit-transform-origin: 50% 0;
		-moz-transform-origin: 50% 0;
		transform-origin: 50% 0;
		-webkit-transform-style: preserve-3d;
		-moz-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}

	.fl-node-<?php echo $id; ?> .csstransforms3d.il-effect-b a span::before {
		position: absolute;
		top: 100%;
		left: 0;
		width: 100%;
		height: 100%;
		<?php if( $settings->txt_hover_color != '' ) { ?>
		color: #<?php echo $settings->txt_hover_color; ?>;
		<?php } ?>
		background: #28a2ee;
		<?php if( $settings->bg_hover_color != '' ) { ?>
		background: #<?php echo $settings->bg_hover_color; ?>;
		<?php } ?>
		content: attr(data-hover);
		padding: inherit;
		-webkit-transition: background 0.3s;
		-moz-transition: background 0.3s;
		transition: background 0.3s;
		-webkit-transform: rotateX(-90deg);
		-moz-transform: rotateX(-90deg);
		transform: rotateX(-90deg);
		-webkit-transform-origin: 50% 0;
		-moz-transform-origin: 50% 0;
		transform-origin: 50% 0;
	}

	.fl-node-<?php echo $id; ?> .il-effect-b a:hover span,
	.fl-node-<?php echo $id; ?> .il-effect-b a:focus span {
		-webkit-transform: rotateX(90deg) translateY(-22px);
		-moz-transform: rotateX(90deg) translateY(-22px);
		transform: rotateX(90deg) translateY(-22px);
	}

	.fl-node-<?php echo $id; ?> .csstransforms3d.il-effect-b a:hover span::before,
	.fl-node-<?php echo $id; ?> .csstransforms3d.il-effect-b a:focus span::before {
		<?php if( $settings->txt_hover_color != '' ) { ?>
		color: #<?php echo $settings->txt_hover_color; ?>;
		<?php } ?>
		background: #28a2ee;
		<?php if( $settings->bg_hover_color != '' ) { ?>
		background: #<?php echo $settings->bg_hover_color; ?>;
		<?php } ?>
	}
<?php }elseif( $settings->il_style == 'effect-c' ) { ?>

	/* Effect C: bottom line slides/fades in */
	.fl-node-<?php echo $id; ?> .il-effect-c a {
		<?php if( $settings->txt_color != '' ) { ?>
		color: #<?php echo $settings->txt_color; ?>;
		<?php } ?>
		padding: 8px 0;
	}

	.fl-node-<?php echo $id; ?> .il-effect-c a::after {
		position: absolute;
		top: 100%;
		left: 0;
		width: 100%;
		height: 4px;
		background: rgba(0,0,0,0.1);
		<?php if( $settings->border_hover_color != '' ) { ?>
		background: #<?php echo $settings->border_hover_color; ?>;
		<?php } ?>
		content: '';
		opacity: 0;
		-webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
		-moz-transition: opacity 0.3s, -moz-transform 0.3s;
		transition: opacity 0.3s, transform 0.3s;
		-webkit-transform: translateY(10px);
		-moz-transform: translateY(10px);
		transform: translateY(10px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-c a:hover::after,
	.fl-node-<?php echo $id; ?> .il-effect-c a:focus::after {
		opacity: 1;
		-webkit-transform: translateY(0px);
		-moz-transform: translateY(0px);
		transform: translateY(0px);
	}
<?php }elseif( $settings->il_style == 'effect-d' ) { ?>
	
	/* Effect D: bottom border enlarge */
	.fl-node-<?php echo $id; ?> .il-effect-d a {
		<?php if( $settings->txt_color != '' ) { ?>
		color: #<?php echo $settings->txt_color; ?>;
		<?php } ?>
		padding: 0 0 10px;
	}

	.fl-node-<?php echo $id; ?> .il-effect-d a::after {
		position: absolute;
		top: 100%;
		left: 0;
		width: 100%;
		height: 1px;
		background: #8d6c6c;
		<?php if( $settings->border_hover_color != '' ) { ?>
		background: #<?php echo $settings->border_hover_color; ?>;
		<?php } ?>
		content: '';
		opacity: 0;
		-webkit-transition: height 0.3s, opacity 0.3s, -webkit-transform 0.3s;
		-moz-transition: height 0.3s, opacity 0.3s, -moz-transform 0.3s;
		transition: height 0.3s, opacity 0.3s, transform 0.3s;
		-webkit-transform: translateY(-10px);
		-moz-transform: translateY(-10px);
		transform: translateY(-10px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-d a:hover::after,
	.fl-node-<?php echo $id; ?> .il-effect-d a:focus::after {
		height: 5px;
		opacity: 1;
		-webkit-transform: translateY(0px);
		-moz-transform: translateY(0px);
		transform: translateY(0px);
	}
<?php }elseif( $settings->il_style == 'effect-e' ) { ?>

	/* Effect E: same word slide in and border bottom */
	.fl-node-<?php echo $id; ?> .il-effect-e a {
		margin: 0 10px;
		padding: 10px 20px;
	}

	.fl-node-<?php echo $id; ?> .il-effect-e a::before {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 2px;
		background: #7b7474;
		<?php if( $settings->border_color != '' ) { ?>
		background: #<?php echo $settings->border_color; ?>;
		<?php } ?>
		content: '';
		-webkit-transition: top 0.3s;
		-moz-transition: top 0.3s;
		transition: top 0.3s;
	}

	.fl-node-<?php echo $id; ?> .il-effect-e a::after {
		position: absolute;
		top: 0;
		left: 0;
		width: 2px;
		height: 2px;
		background: #7b7474;
		<?php if( $settings->border_color != '' ) { ?>
		background: #<?php echo $settings->border_color; ?>;
		<?php } ?>
		content: '';
		-webkit-transition: height 0.3s;
		-moz-transition: height 0.3s;
		transition: height 0.3s;
	}

	.fl-node-<?php echo $id; ?> .il-effect-e a:hover::before {
		top: 100%;
		opacity: 1;
	}

	.fl-node-<?php echo $id; ?> .il-effect-e a:hover::after {
		height: 100%;
	}
<?php }elseif( $settings->il_style == 'effect-f' ) { ?>

	/* Effect F: second border slides up */
	.fl-node-<?php echo $id; ?> .il-effect-f a {
		padding: 12px 10px 10px;
		/*color: #566473;*/
		text-shadow: none;
		font-weight: 700;
	}

	.fl-node-<?php echo $id; ?> .il-effect-f a::before,
	.fl-node-<?php echo $id; ?> .il-effect-f a::after {
		position: absolute;
		top: 100%;
		left: 0;
		width: 100%;
		height: 3px;
		background: #566473;
		<?php if( $settings->border_color != '' ) { ?>
		background: #<?php echo $settings->border_color; ?>;
		<?php } ?>
		content: '';
		-webkit-transition: -webkit-transform 0.3s;
		-moz-transition: -moz-transform 0.3s;
		transition: transform 0.3s;
		-webkit-transform: scale(0.85);
		-moz-transform: scale(0.85);
		transform: scale(0.85);
	}

	.fl-node-<?php echo $id; ?> .il-effect-f a::after {
		opacity: 0;
		-webkit-transition: top 0.3s, opacity 0.3s, -webkit-transform 0.3s;
		-moz-transition: top 0.3s, opacity 0.3s, -moz-transform 0.3s;
		transition: top 0.3s, opacity 0.3s, transform 0.3s;
	}

	.fl-node-<?php echo $id; ?> .il-effect-f a:hover::before,
	.fl-node-<?php echo $id; ?> .il-effect-f a:hover::after,
	.fl-node-<?php echo $id; ?> .il-effect-f a:focus::before,
	.fl-node-<?php echo $id; ?> .il-effect-f a:focus::after {
		-webkit-transform: scale(1);
		-moz-transform: scale(1);
		transform: scale(1);
	}

	.fl-node-<?php echo $id; ?> .il-effect-f a:hover::after,
	.fl-node-<?php echo $id; ?> .il-effect-f a:focus::after {
		top: 0%;
		opacity: 1;
	}
<?php }elseif( $settings->il_style == 'effect-g' ) { ?>

	/* Effect G: border slight translate */
	.fl-node-<?php echo $id; ?> .il-effect-g a {
		padding: 10px 20px;
	}

	.fl-node-<?php echo $id; ?> .il-effect-g a::before,
	.fl-node-<?php echo $id; ?> .il-effect-g a::after  {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border: 3px solid #354856;
		<?php if( $settings->border_color != '' ) { ?>
		border: 3px solid #<?php echo $settings->border_color; ?>;
		<?php } ?>
		content: '';
		-webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
		-moz-transition: -moz-transform 0.3s, opacity 0.3s;
		transition: transform 0.3s, opacity 0.3s;
	}

	.fl-node-<?php echo $id; ?> .il-effect-g a::after  {
		border-color: #b1a7a7;
		<?php if( $settings->border_hover_color != '' ) { ?>
		border-color: #<?php echo $settings->border_hover_color; ?>;
		<?php } ?>
		opacity: 0;
		-webkit-transform: translateY(-7px) translateX(6px);
		-moz-transform: translateY(-7px) translateX(6px);
		transform: translateY(-7px) translateX(6px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-g a:hover::before,
	.fl-node-<?php echo $id; ?> .il-effect-g a:focus::before {
		opacity: 0;
		-webkit-transform: translateY(5px) translateX(-5px);
		-moz-transform: translateY(5px) translateX(-5px);
		transform: translateY(5px) translateX(-5px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-g a:hover::after,
	.fl-node-<?php echo $id; ?> .il-effect-g a:focus::after  {
		opacity: 1;
		-webkit-transform: translateY(0px) translateX(0px);
		-moz-transform: translateY(0px) translateX(0px);
		transform: translateY(0px) translateX(0px);
	}

<?php }elseif( $settings->il_style == 'effect-h' ) { ?>

	/* Effect H => 10: reveal, push out */
	.fl-node-<?php echo $id; ?> .il-effect-h  {
		position: relative;
		z-index: 1;
	}

	.fl-node-<?php echo $id; ?> .il-effect-h a {
		overflow: hidden;
		margin: 0 15px;
	}

	.fl-node-<?php echo $id; ?> .il-effect-h a span {
		display: block;
		padding: 10px 20px;
		color: #fff;
		<?php if( $settings->txt_color != '' ) { ?>
		color: #<?php echo $settings->txt_color; ?>;
		<?php } ?>
		background: #27496d;
		<?php if( $settings->bg_color != '' ) { ?>
		background: #<?php echo $settings->bg_color; ?>;
		<?php } ?>
		-webkit-transition: -webkit-transform 0.3s;
		-moz-transition: -moz-transform 0.3s;
		transition: transform 0.3s;
	}

	.fl-node-<?php echo $id; ?> .il-effect-h a::before {
		position: absolute;
		top: 0;
		left: 0;
		z-index: -1;
		padding: 10px 20px;
		width: 100%;
		height: 100%;
		background: #0f7c67;
		color: #fff;
		<?php if( $settings->bg_hover_color != '' ) { ?>
		background: #<?php echo $settings->bg_hover_color; ?>;
		<?php } ?>
		<?php if( $settings->txt_hover_color != '' ) { ?>
		color: #<?php echo $settings->txt_hover_color; ?>;
		<?php } ?>
		content: attr(data-hover);
		-webkit-transition: -webkit-transform 0.3s;
		-moz-transition: -moz-transform 0.3s;
		transition: transform 0.3s;
		-webkit-transform: translateX(-25%);
	}

	.fl-node-<?php echo $id; ?> .il-effect-h a:hover span,
	.fl-node-<?php echo $id; ?> .il-effect-h a:focus span {
		-webkit-transform: translateX(100%);
		-moz-transform: translateX(100%);
		transform: translateX(100%);
	}

	.fl-node-<?php echo $id; ?> .il-effect-h a:hover::before,
	.fl-node-<?php echo $id; ?> .il-effect-h a:focus::before {
		-webkit-transform: translateX(0%);
		-moz-transform: translateX(0%);
		transform: translateX(0%);
	}

<?php }elseif( $settings->il_style == 'effect-i' ) { ?>

	/* Effect I => 13: three circles */
	.fl-node-<?php echo $id; ?> .il-effect-i a {
		-webkit-transition: color 0.3s;
		-moz-transition: color 0.3s;
		transition: color 0.3s;
	}

	.fl-node-<?php echo $id; ?> .il-effect-i a::before {
		position: absolute;
		top: 100%;
		left: 50%;
		color: transparent;
		content: '•';
		text-shadow: 0 0 transparent;
		font-size: 1.2em;
		line-height: 0.5em;
		-webkit-transition: text-shadow 0.3s, color 0.3s;
		-moz-transition: text-shadow 0.3s, color 0.3s;
		transition: text-shadow 0.3s, color 0.3s;
		-webkit-transform: translateX(-50%);
		-moz-transform: translateX(-50%);
		transform: translateX(-50%);
		pointer-events: none;
	}

	.fl-node-<?php echo $id; ?> .il-effect-i a:hover::before,
	.fl-node-<?php echo $id; ?> .il-effect-i a:focus::before {
		line-height: 0.5em;
		color: #961b1b;
		text-shadow: 10px 0 #961b1b, -10px 0 #961b1b;
		<?php if( $settings->border_hover_color != '' ) { ?>
		color: #<?php echo $settings->border_hover_color; ?>;
		text-shadow: 10px 0 #<?php echo $settings->border_hover_color; ?>, -10px 0 #<?php echo $settings->border_hover_color; ?>;
		
		<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .il-effect-i a:hover,
	.fl-node-<?php echo $id; ?> .il-effect-i a:focus {
		color: #ba7700;
		<?php if( $settings->txt_hover_color != '' ) { ?>
		color: #<?php echo $settings->txt_hover_color; ?>;
		<?php } ?>

	}

<?php }elseif( $settings->il_style == 'effect-j' ) { ?>

	/* Effect J => 20: 3D side */
	.fl-node-<?php echo $id; ?> .il-effect-j a {
		line-height: 2em;
		-webkit-perspective: 800px;
		-moz-perspective: 800px;
		perspective: 800px;
	}

	.fl-node-<?php echo $id; ?> .il-effect-j a span {
		position: relative;
		display: inline-block;
		padding: 3px 15px 0;
		color: #fff;
		<?php if( $settings->txt_color != '' ) { ?>
		color: #<?php echo $settings->txt_color; ?>;
		<?php } ?>
		background: #587285;
		<?php if( $settings->bg_color != '' ) { ?>
		background: #<?php echo $settings->bg_color; ?>;
		<?php } ?>
		box-shadow: inset 0 3px #2f4351;
		-webkit-transition: background 0.6s;
		-moz-transition: background 0.6s;
		transition: background 0.6s;
		-webkit-transform-origin: 50% 0;
		-moz-transform-origin: 50% 0;
		transform-origin: 50% 0;
		-webkit-transform-style: preserve-3d;
		-moz-transform-style: preserve-3d;
		transform-style: preserve-3d;
		-webkit-transform-origin: 0% 50%;
		-moz-transform-origin: 0% 50%;
		transform-origin: 0% 50%;
	}

	.fl-node-<?php echo $id; ?> .il-effect-j a span::before {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 101%;
		background: #5b9dd9;
		color: #fff;
		<?php if( $settings->bg_hover_color != '' ) { ?>
		background: #<?php echo $settings->bg_hover_color; ?>;
		<?php } ?>
		<?php if( $settings->txt_hover_color != '' ) { ?>
		color: #<?php echo $settings->txt_hover_color; ?>;
		<?php } ?>
		padding: inherit;
		content: attr(data-hover);
		-webkit-transform: rotateX(270deg);
		-moz-transform: rotateX(270deg);
		transform: rotateX(270deg);
		-webkit-transition: -webkit-transform 0.6s;
		-moz-transition: -moz-transform 0.6s;
		transition: transform 0.6s;
		-webkit-transform-origin: 0 0;
		-moz-transform-origin: 0 0;
		transform-origin: 0 0;
		pointer-events: none;
	}

	.fl-node-<?php echo $id; ?> .il-effect-j a:hover span,
	.fl-node-<?php echo $id; ?> .il-effect-j a:focus span {
		background: #2f4351;
	}

	.fl-node-<?php echo $id; ?> .il-effect-j a:hover span::before,
	.fl-node-<?php echo $id; ?> .il-effect-j a:focus span::before {
		-webkit-transform: rotateX(10deg);	
		-moz-transform: rotateX(10deg);
		transform: rotateX(10deg);
	}


<?php }elseif( $settings->il_style == 'effect-k' ) { ?>

	/* Effect K => 21: borders slight translate */
	.fl-node-<?php echo $id; ?> .il-effect-k a {
		padding: 10px;
		font-weight: 700;
		text-shadow: none;
		-webkit-transition: color 0.3s;
		-moz-transition: color 0.3s;
		transition: color 0.3s;
	}

	.fl-node-<?php echo $id; ?> .il-effect-k a::before,
	.fl-node-<?php echo $id; ?> .il-effect-k a::after {
		position: absolute;
		left: 0;
		width: 100%;
		height: 2px;
		background: #337ab7;
		<?php if( $settings->border_hover_color != '' ) { ?>
		background: #<?php echo $settings->border_hover_color; ?>;
		<?php } ?>
		content: '';
		opacity: 0;
		-webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
		-moz-transition: opacity 0.3s, -moz-transform 0.3s;
		transition: opacity 0.3s, transform 0.3s;
		-webkit-transform: translateY(-10px);
		-moz-transform: translateY(-10px);
		transform: translateY(-10px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-k a::before {
		top: 0;
		-webkit-transform: translateY(-10px);
		-moz-transform: translateY(-10px);
		transform: translateY(-10px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-k a::after {
		bottom: 0;
		-webkit-transform: translateY(10px);
		-moz-transform: translateY(10px);
		transform: translateY(10px);
	}

	.fl-node-<?php echo $id; ?> .il-effect-k a:hover,
	.fl-node-<?php echo $id; ?> .il-effect-k a:focus {
		color: #337ab7;
		<?php if( $settings->txt_hover_color != '' ) { ?>
		color: #<?php echo $settings->txt_hover_color; ?>;
		<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .il-effect-k a:hover::before,
	.fl-node-<?php echo $id; ?> .il-effect-k a:focus::before,
	.fl-node-<?php echo $id; ?> .il-effect-k a:hover::after,
	.fl-node-<?php echo $id; ?> .il-effect-k a:focus::after {
		opacity: 1;
		-webkit-transform: translateY(0px);
		-moz-transform: translateY(0px);
		transform: translateY(0px);
	}

<?php } ?>
