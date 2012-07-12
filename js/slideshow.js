var Slideshow = new function() {

	var wrapper = document.getElementById('slideshow-wrapper'),
		slides = $('div.slide', wrapper),
		loader = $('#loader'),
		timer = null,
		index = -1;
		
	var loader = function(callback) {
	
		$('#loader').fadeIn(800, function() {
		
			setTimeout(function() {
			
			
				$('#loader').fadeOut(800, function() {
				
					callback();
				
				
				});
			
			
			}, 1500);
		
		
		});
	
	
	
	};
	
	var reveal = function() {
	
		timer = setInterval(function() {
		
			index++;
			
			if(index == slides.length) {
			
				index = 0;
			
			}
			
			var slide = slides.eq(index);
			
			slide.fadeIn(1000, function() {
			
				$('div.caption', slide).slideDown(1000, function() {
				
					$(this).fadeOut(1000)
				
				
				});
			
			
			}).siblings().hide();
		
		
		
		}, 3000);
	
	
	};



	this.init = function() {
	
		loader(reveal);
	
	
	};

}();


$(function() {

	Slideshow.init();


});