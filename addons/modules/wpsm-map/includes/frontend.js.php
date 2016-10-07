jQuery(document).ready(function( $ ) {
	
	function init_map(){
	
		var myOptions = {
			zoom: <?php echo $settings->zoom_level; ?>,
			center: new google.maps.LatLng(
				<?php echo $settings->lat; ?>,
				<?php echo $settings->long; ?>
			),
			<?php echo ( $settings->disable_scroll == 'yes' ) ? 'scrollwheel: false,' : '' ;?> 
			mapTypeId: google.maps.MapTypeId.<?php echo $settings->map_type; ?>
		};

		map = new google.maps.Map(
			$(".fl-node-<?php echo $id; ?> .wpsm-map-sparkz")[0], 
			myOptions);

		marker = new google.maps.Marker({
			map: map,
			
			<?php echo ( $settings->enable_anim == 'yes' ) ? 'animation:google.maps.Animation.BOUNCE,' : '' ;?> 
			position: new google.maps.LatLng(
				<?php echo $settings->lat; ?>,
				<?php echo $settings->long; ?>
				)
		});

		<?php if( $settings->enable_title == 'yes' ) { ?>
		infowindow = new google.maps.InfoWindow({
			content:"<strong><?php echo $settings->addname; ?></strong>"
		});

		google.maps.event.addListener(marker, 'click', function(){
			infowindow.open(map,marker);
		});

		/*infowindow.open(map,marker);*/
		<?php } ?>
	}

	init_map();
	
});