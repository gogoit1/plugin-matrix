.fl-node-<?php echo $id; ?> .wpsm-spacer-gap{
	height: <?php echo $settings->height; ?>px;
}

/* Responsive css */
<?php if($global_settings->responsive_enabled) : // Responsive Sizes ?>

	<?php if( $settings->medium_height != '') : ?>
	@media(max-width: <?php echo $global_settings->medium_breakpoint; ?>px) {
		.fl-node-<?php echo $id; ?> .wpsm-spacer-gap{
			height: <?php echo $settings->medium_height; ?>px;
		}
	}
	<?php endif; ?>
	
	<?php if($settings->small_height != '') : ?>
	@media(max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
		.fl-node-<?php echo $id; ?> .wpsm-spacer-gap{
			height: <?php echo $settings->small_height; ?>px;
		}
	}
	<?php endif; ?>
	
<?php endif; ?>