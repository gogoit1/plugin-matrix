/* Heading Alignment */

.fl-node-<?php echo $id; ?> .wpsm-heading-wrap{
	text-align: <?php echo $settings->text_alignment; ?>;
}

/* Divider */

<?php if ( $settings->border_pos != 'no' ) { ?>
.fl-node-<?php echo $id; ?> .wpsm-heading-spacer{
	<?php echo ( $settings->border_top_space != '' ) ? 'margin-top: '.$settings->border_top_space.'px' : ''; ?>;
	<?php echo ( $settings->border_bottom_space != '' ) ? 'margin-bottom: '.$settings->border_bottom_space.'px' : ''; ?>;
}

.fl-node-<?php echo $id; ?> .wpsm-headings-line {
	border-top:<?php echo $settings->border_height; ?>px <?php echo $settings->border_style; ?>;
	<?php echo ( $settings->border_color != '' ) ? 'border-top-color: #'.$settings->border_color.';' : ''; ?>
	<?php echo ( $settings->border_width != '' ) ? 'width: '.$settings->border_width.'px' : ''; ?>;
	<?php echo ( $settings->border_alignment != 'center' && $settings->border_alignment != 'default' ) ? 'float: '.$settings->border_alignment : 'margin: 0 auto'; ?>;
}
<?php } ?>

/* Heading */

.fl-node-<?php echo $id; ?> .wpsm-heading-wrap .wpsm-heading-text {
	<?php echo ( $settings->head_top_space != '' ) ? 'margin-top: '.$settings->head_top_space.'px' : ''; ?>;
	<?php echo ( $settings->head_bottom_space != '' ) ? 'margin-bottom: '.$settings->head_bottom_space.'px' : ''; ?>;
	<?php echo ( $settings->heading_color != '' ) ? 'color: #'.$settings->heading_color.';' : ''; ?>
	<?php echo ( $settings->font_size != '' ) ? 'font-size: '.$settings->font_size.'px;' : ''; ?>
	<?php echo ( $settings->line_height != '' ) ? 'line-height: '.$settings->line_height.'px;' : ''; ?>
	<?php if( !empty($settings->font) && $settings->font['family'] != 'Default' ) : ?>
	<?php FLBuilderFonts::font_css( $settings->font ); ?>
	<?php endif; ?>
}

/* Sub Heading */

.fl-node-<?php echo $id; ?> .wpsm-heading-wrap .wpsm-subheading-text {
	<?php echo ( $settings->subhead_top_space != '' ) ? 'margin-top: '.$settings->subhead_top_space.'px' : ''; ?>;
	<?php echo ( $settings->subhead_bottom_space != '' ) ? 'margin-bottom: '.$settings->subhead_bottom_space.'px' : ''; ?>;
	<?php echo ( $settings->subheading_color != '' ) ? 'color: #'.$settings->subheading_color.';' : ''; ?>
	<?php echo ( $settings->sub_font_size != '' ) ? 'font-size: '.$settings->sub_font_size.'px;' : ''; ?>
	<?php echo ( $settings->sub_line_height != '' ) ? 'line-height: '.$settings->sub_line_height.'px;' : ''; ?>
	<?php if( !empty($settings->sub_font) && $settings->sub_font['family'] != 'Default' ) : ?>
	<?php FLBuilderFonts::font_css( $settings->sub_font ); ?>
	<?php endif; ?>
}


/*
.fl-node-<?php echo $id; ?> .wpsm-heading-wrap{
	<?php echo ( $settings->top_space != '' ) ? 'margin-top: '.$settings->top_space.'px' : ''; ?>;
	<?php echo ( $settings->bottom_space != '' ) ? 'margin-bottom: '.$settings->bottom_space.'px' : ''; ?>;
	<?php echo ( $settings->sub_font_size != '' ) ? 'font-size: '.$settings->sub_font_size.'px;' : ''; ?>
}*/