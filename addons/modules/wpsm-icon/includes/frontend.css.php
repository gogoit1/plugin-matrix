<?php

if($settings->three_d) {
	$bg_grad_start = FLBuilderColor::adjust_brightness($settings->bg_color, 30, 'lighten');
	$border_color = FLBuilderColor::adjust_brightness($settings->bg_color, 20, 'darken');
}
if($settings->three_d && !empty($settings->bg_hover_color)) {
	$bg_hover_grad_start = FLBuilderColor::adjust_brightness($settings->bg_hover_color, 30, 'lighten');
	//$border_hover_color = FLBuilderColor::adjust_brightness($settings->bg_hover_color, 20, 'darken');
}

?>
<?php // Alignment ?>
<?php if(!isset($settings->exclude_wrapper)) : ?>
.fl-node-<?php echo $id; ?>.fl-module-wpsm-icon {
	text-align: <?php echo $settings->align; ?>
}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .fl-module-content .wpsm-icon i,
.fl-node-<?php echo $id; ?> .fl-module-content .wpsm-icon i:before {
	<?php if($settings->color) : ?>
	color: #<?php echo $settings->color; ?>;
	<?php endif; ?>
	font-size: <?php echo $settings->size; ?>px;
	
	<?php if( $settings->iconStyle == 'none' ) : // None Style ?>
	height: auto;
	width: auto;
	<?php endif; // End Simple Style ?>
	
	<?php if( $settings->iconStyle != 'none' ) : // Other than None Style ?>
	<?php if($settings->bg_color) : ?>
	background: #<?php echo $settings->bg_color; ?>;
	<?php endif; ?>
	line-height: <?php echo $settings->bg_size; ?>px;
	height: <?php echo $settings->bg_size; ?>px;
	width: <?php echo $settings->bg_size; ?>px;
	text-align: center;
	<?php if( !empty( $settings->border_width ) ) : ?>
	border-style: <?php echo $settings->border; ?>;
	border-width: <?php echo $settings->border_width; ?>px;
	border-color: #<?php echo $settings->border_color; ?>;
	<?php endif; ?>
	
	<?php if( $settings->iconStyle == 'circle' ) : // Circle Style ?>
		    border-radius: 100%;
	   -moz-border-radius: 100%;
	-webkit-border-radius: 100%;
	<?php endif; // End Circle Style ?>
	<?php if( $settings->iconStyle == 'custom' ) : // custom Style ?>
		    border-radius: <?php echo $settings->border_radius; ?>px;
	   -moz-border-radius: <?php echo $settings->border_radius; ?>px;
	-webkit-border-radius: <?php echo $settings->border_radius; ?>px;
	<?php endif; // End custom Style ?>
	<?php endif; // End Other than None Style ?>

	/* Three d */
	<?php if($settings->bg_color && $settings->three_d) : // 3D Styles ?>
	background: -moz-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%, #<?php echo $settings->bg_color; ?> 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $bg_grad_start; ?>), color-stop(100%,#<?php echo $settings->bg_color; ?>)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $bg_grad_start; ?>', endColorstr='#<?php echo $settings->bg_color; ?>',GradientType=0 ); /* IE6-9 */
	/*border: 1px solid #<?php echo $border_color; ?>;*/
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .fl-module-content .wpsm-icon i:hover,
.fl-node-<?php echo $id; ?> .fl-module-content .wpsm-icon i:hover:before,
.fl-node-<?php echo $id; ?> .fl-module-content .wpsm-icon a:hover i,
.fl-node-<?php echo $id; ?> .fl-module-content .wpsm-icon a:hover i:before {
	<?php if(!empty($settings->bg_hover_color)) : ?>
	background: #<?php echo $settings->bg_hover_color; ?>;
	<?php endif; ?>
	<?php if( !empty($settings->border_hover_color) && !empty($settings->border_width) ) : ?>
	border-color: #<?php echo $settings->border_hover_color; ?>;
	<?php endif; ?>
	<?php if($settings->three_d && !empty($settings->bg_hover_color)) : // 3D Styles ?>
	background: -moz-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%, #<?php echo $settings->bg_hover_color; ?> 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $bg_hover_grad_start; ?>), color-stop(100%,#<?php echo $settings->bg_hover_color; ?>)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $bg_hover_grad_start; ?>', endColorstr='#<?php echo $settings->bg_hover_color; ?>',GradientType=0 ); /* IE6-9 */
	/*border: 1px solid #<?php echo $border_hover_color; ?>;*/
	<?php endif; ?>
	<?php if(!empty($settings->hover_color)) : ?>
	color: #<?php echo $settings->hover_color; ?>;
	<?php endif; ?>
}

/*.fl-node-<?php echo $id; ?> .fl-module-content .wpsm-icon-text {
	height: <?php echo $settings->size * 1.75; ?>px;
}*/