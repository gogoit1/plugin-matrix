(function($){

	FLBuilder.registerModuleHelper('wpsm-spacer', {

		rules: {
			height: {
				required: true,
				number: true
			},
			medium_height: {
				number: true
			},
			small_height: {
				number: true
			},
			
		}
	});

})(jQuery);