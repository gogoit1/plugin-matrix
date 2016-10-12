(function($){

	FLBuilder.registerModuleHelper('wpsm-divider', {

		rules: {
			height: {
				required: true,
				number: true
			},
			width: {
				number: true
			},
			top_space: {
				number: true
			},
			bottom_space: {
				number: true
			},
		}
	});

})(jQuery);