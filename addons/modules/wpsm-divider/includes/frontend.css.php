.fl-node-<?php echo $id; ?> .wpsm-divider-wrap{
	<?php echo ( $settings->top_space != '' ) ? 'margin-top: '.$settings->top_space.'px' : ''; ?>;
	<?php echo ( $settings->bottom_space != '' ) ? 'margin-bottom: '.$settings->bottom_space.'px' : ''; ?>;
}

.fl-node-<?php echo $id; ?> .wpsm-divider {
	border-top:<?php echo $settings->height; ?>px <?php echo $settings->style; ?> #<?php echo $settings->color; ?>;
	filter: alpha(opacity = <?php echo $settings->opacity; ?>);
	opacity: <?php echo $settings->opacity/100; ?>;
	<?php echo ( $settings->width != '' ) ? 'width: '.$settings->width.'%' : ''; ?>;
	<?php echo ( $settings->alignment != 'center' ) ? 'float: '.$settings->alignment : ''; ?>;
	margin: 0 auto;
}