<<?php echo $settings->tag; ?> class="wpsm-anim-text-wrap">
	<?php if ( !empty( $settings->pre_text ) ) { ?>
	<span class="wpsm-prefix"><?php echo $settings->pre_text ?></span>
	<?php } ?>
	<span class="wpsm-animated"></span>
	<?php if ( !empty( $settings->suf_text ) ) { ?>
	<span class="wpsm-suffix"><?php echo $settings->suf_text ?></span>
	<?php } ?>
</<?php echo $settings->tag; ?>>