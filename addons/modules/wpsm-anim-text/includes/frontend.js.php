(function($){
    $(".fl-node-<?php echo $id; ?> .wpsm-animated").typed({
        strings: [<?php
        			$output = ''; 
        			foreach ($settings->anim_text as $value) {
        				$output .= '"'.$value.'", ';
        			}
        			echo rtrim( $output, ', ' );
        		 ?>],
        
        // typing speed
        typeSpeed: <?php echo wpsm_get_value( $settings->typeSpeed, '150'); ?>,
        
        // time before typing starts
        startDelay: <?php echo wpsm_get_value( $settings->startDelay, '20'); ?>,
        
        // backspacing speed
        backSpeed: <?php echo wpsm_get_value( $settings->backSpeed, '50'); ?>,
        
        // time before backspacing
        backDelay: <?php echo wpsm_get_value( $settings->backDelay, '500'); ?>,
        
        // loop
        loop: <?php echo $settings->loop; ?>,
        
        <?php if ( $settings->loop == true ) { ?>
        	// false = infinite
        	loopCount: <?php echo wpsm_get_value( $settings->loopCount, 'false'); ?>,
        <?php } ?>
        
        // show cursor
        showCursor: <?php echo $settings->showCursor; ?>,

        <?php if ( $settings->showCursor == true ) { ?>
	        // character for cursor
    	    cursorChar: "<?php echo wpsm_get_value( $settings->cursorChar, '|'); ?>",
       	<?php } ?>
    });
})(jQuery);