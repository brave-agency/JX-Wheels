(function($) {

	// Setup and initialise our gallery lightboxes
	
	
	$('.slide-item.smtw-item').on('click', function (event) {

		window.console.log("gallery item clicked");
		
		event = event || window.event;
		var target = event.target || event.srcElement,
		link = target.src ? target.parentNode : target,
		options = {
			index: link, 
			event: event,
			container: '.blueimp-gallery.smtw-gallery',
		},

		// links = $('.slide-link:not(:hidden) .slide-link'); //

		links = this.getElementsByTagName('a');
		
		
  		var gallery_lightbox = blueimp.Gallery(links, options);

	});
	

})(jQuery);