(function($){

	FLBuilder.registerModuleHelper('wpsm-icon', {
		
		rules: {
			icon: {
				required: true
			},
			size: {
				number: true,
				required: true
			}
		},

		init: function()
		{
			var form        = $('.fl-builder-settings'),
				iconStyle   = form.find('select[name=iconStyle]');
			
			// Init validation events.
			this._iconStyleChanged();
			
			// Validation events.
			iconStyle.on('change', this._iconStyleChanged);
			
		},
		
		_iconStyleChanged: function()
		{
			var form        	= $('.fl-builder-settings'),
				iconStyle   	= form.find('select[name=iconStyle]').val(),
				border_width	= form.find('#fl-field-border_width');
								
			if( iconStyle == 'none') {
				border_width.hide();
			}
			else {
				border_width.show();
			}
		},
	});

})(jQuery);