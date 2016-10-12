(function( $ ) {
	$(document).ready(function() {

		$('.fl-builder-panel-close').after('<input type="text" id="wpsm-search" placeholder="Search" style="height: 40px; max-height: 40px; border: 0;">');
		$('#wpsm-search').focus();
	    
		var panel 			= $('.fl-builder-panel-content-wrap'),
			panelsection	= panel.find('.fl-builder-blocks-section'),
			panelblock 		= panel.find('.fl-builder-block');


	    $('.fl-builder-add-content-button').click(function(e) {
	    	$('#wpsm-search').val('');
	    	panelsection.removeClass('fl-active');
	    	panelblock.show();
	    	$('#wpsm-search').focus();
	    });


	    $('#wpsm-search').keyup(function(){
			panelblock.hide();
			var srch 	=	$(this).val().toLowerCase();
			
		    if( $.trim( srch ) == '' ) {
				panelsection.removeClass('fl-active');
	    		panelblock.show();
				return;            	
            }
			
			panelsection.each(function() {
				var srch_cnt = 0,
					section = $(this);

				section.find('.fl-builder-block-title').each(function() {
					var $this = $(this),
			         	s = $this.text().toLowerCase();

			        if ( s.indexOf(srch) !== -1 ) {
						var block = $this.closest('.fl-builder-block');
				        
				        srch_cnt = ++srch_cnt;
				        block.show();
				        section.addClass('fl-active');
			        }
			    });
			    if ( srch_cnt < 1 ) {
			    	section.removeClass('fl-active');
			    };
			});
		});
	});
})( jQuery );