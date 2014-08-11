/**
 *  Slider Range
 */
(function($){
	
	$('.field_option_slider_range_type input[type="radio"]').change(function(e) { // Select the radio input group
	
	    if($(this).val()=='range'){
		    $('.field_option_slider_range_separate').show(0);
	    }else{
		    $('.field_option_slider_range_separate').hide(0);
	    }
	
	});
	
	
})(jQuery);