/**
*  Row CSS
*/
<?php if ( $rsetting->enable_top_separator == 'yes' ) { ?>
					
	.fl-node-<?php echo $row->node; ?> .wpsm-separator--top {
		fill: #<?php echo $rsetting->s_top_color; ?>;
	}

	.fl-node-<?php echo $row->node; ?> .wpsm-separator--css.wpsm-separator--top {
		height: <?php echo $rsetting->s_top_height; ?>px;
		border-color: #<?php echo $rsetting->s_top_color; ?>;
	}
<?php } ?>
		
<?php if ( $rsetting->enable_bottom_separator == 'yes' ) { ?>
					
	.fl-node-<?php echo $row->node; ?> .wpsm-separator--bottom {
		fill: #<?php echo $rsetting->s_bottom_color; ?>;
	}

	.fl-node-<?php echo $row->node; ?> .wpsm-separator--css.wpsm-separator--bottom {
		height: <?php echo $rsetting->s_bottom_height; ?>px;
		border-color: #<?php echo $rsetting->s_bottom_color; ?>;
	}
<?php } ?>

<?php if ( $rsetting->enable_img_separator == 'yes' ) { ?>
	
	.fl-node-<?php echo $row->node; ?> .wpsm-img-separator-wrap,
	.fl-node-<?php echo $row->node; ?> .wpsm-img-separator-wrap img {
		width: <?php echo $rsetting->img_width; ?>px;
	}
	
	<?php if ( $rsetting->img_position == 'top' ) { ?>
		.fl-node-<?php echo $row->node; ?> .wpsm-img-separator-top {
			top: 0px;
			<?php if( $rsetting->img_lr_value != '' ) {
			$img_gutter = ( $rsetting->img_gutter != '' ) ? $rsetting->img_gutter : '50';	
			echo ( $rsetting->img_lr_position == 'left' ) ? 'right: auto;' : 'left: auto;';
			echo $rsetting->img_lr_position.': '.$rsetting->img_lr_value.'%;'; ?>
			-webkit-transform: translate(0, -<?php echo $img_gutter; ?>%);
		        -ms-transform: translate(0, -<?php echo $img_gutter; ?>%);
		            transform: translate(0, -<?php echo $img_gutter; ?>%);
			
			<?php } elseif( $rsetting->img_gutter != '' ) { ?>
			-webkit-transform: translate(-50%, -<?php echo $rsetting->img_gutter; ?>%);
		        -ms-transform: translate(-50%, -<?php echo $rsetting->img_gutter; ?>%);
		            transform: translate(-50%, -<?php echo $rsetting->img_gutter; ?>%);
			<?php } ?>
		}
	<?php } ?>

	<?php if ( $rsetting->img_position == 'bottom' ) { ?>
		.fl-node-<?php echo $row->node; ?> .wpsm-img-separator-bottom {
			bottom: 0px;
			<?php if( $rsetting->img_lr_value != '' ) {
			$img_gutter = ( $rsetting->img_gutter != '' ) ? $rsetting->img_gutter : '50';
			echo ( $rsetting->img_lr_position == 'left' ) ? 'right: auto;' : 'left: auto;';
			echo $rsetting->img_lr_position.': '.$rsetting->img_lr_value.'%;'; ?>
			-webkit-transform: translate(0, <?php echo $img_gutter; ?>%);
		        -ms-transform: translate(0, <?php echo $img_gutter; ?>%);
		            transform: translate(0, <?php echo $img_gutter; ?>%);
			
			<?php } elseif( $rsetting->img_gutter != '' ) { ?>
			-webkit-transform: translate(-50%, <?php echo $rsetting->img_gutter; ?>%);
		        -ms-transform: translate(-50%, <?php echo $rsetting->img_gutter; ?>%);
		            transform: translate(-50%, <?php echo $rsetting->img_gutter; ?>%);
			<?php } ?>
		}
	<?php } ?>
<?php } ?>