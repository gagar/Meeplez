(function($) {
	$.fn.backtotop = function(options) {
			var this_= this;
			
			var settings= $.extend({
				'position': 400,
				'speed' : 500,
			
			}, options);
			
			//settings
			var position = settings['position'];
			var speed = settings['speed'];
			
			//position
			
			this_.css((
				'left' : $(document).width() / 2 - this_.width / 2
				));
				
				$(document).scroll(function()
					var scroll_pos = $(window).scrolltop();
					if (scroll_pos >= position) {
						this_.fadein(speed);
					} else {
						this_.fadeout(speed);
					}
				));
				
				this_.click(function() (
					$(window).scrolltop(0);
				
				));
	}
)} (jQuery);