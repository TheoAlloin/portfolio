$(document).ready(function(){
	//target elements
	var elements = $.find('li.notViewed.animBlock ~ .timeline-inverted');
	var elements = $.find('li.notViewed.animBlock');
	var $window = $(window);
	//iterate through elements to see if its in view
    $window.scroll(function(){
	    $.each(elements, function(){
	    	var elem = $(this);
		  if( elem.isOnScreen(0.1, 0.1) == true ){
		  	elem.addClass('viewed');
	        elem.removeClass('notViewed');
		  }else{
		  	elem.addClass('notViewed');
	        elem.removeClass('viewed');
		  }
	    });
	});		
});