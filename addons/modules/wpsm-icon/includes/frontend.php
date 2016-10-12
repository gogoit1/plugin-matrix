<span class="wpsm-icon-wrap">
	<?php if( $settings->icon_type == 'icon_only' ) : ?>
	<span class="wpsm-icon">
		<?php if(!empty($settings->link)) : ?>
		<a href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>">
		<?php endif; ?>
		<i class="<?php echo $settings->icon; ?>"></i> 
		<?php if(!empty($settings->link)) : ?></a><?php endif; ?>
	</span>
	<?php endif; ?>

	<?php if( $settings->icon_type == 'icon_text' ) : ?>
	<?php echo $module->renderIcon( 'before'); ?>
	<span class="wpsm-icon-text wpsm-icon-text-<?php echo $settings->icon_position; ?>">
		<?php if(!empty($settings->link)) : ?>
		<a href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>">
		<?php endif; ?>
		<?php echo $settings->text; ?>
		<?php if(!empty($settings->link)) : ?></a><?php endif; ?>
	</span>
	<?php echo $module->renderIcon('after'); ?>
	<?php endif; ?>

</span>
