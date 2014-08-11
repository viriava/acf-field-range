(function($){
	
	
	function initialize_field( $el ) {

		
		var box = $el;
			var slider = box.find('div.am_range')
				, min_val = parseFloat(slider.attr('data-min'))
				, max_val = parseFloat(slider.attr('data-max'))
				, min_cur_val = parseFloat(slider.attr('data-min-cur'))
				, max_cur_val = parseFloat(slider.attr('data-max-cur'))
				, step_val = parseFloat(slider.attr('data-step'))
				, step_type = slider.attr('data-type');
		// console.log(acf);

		// 	if( slider != undefined && acf.helpers.is_clone_field(slider) )
		// 	{
		// 		return;
		// 	}
			
			if(step_type=='range'){
				slider.slider({
					range: true,
					step: step_val,
					min: min_val,
					max: max_val,
					values: [ min_cur_val, max_cur_val ],
					slide: function( event, ui ) {
						box.find('span.am_range_amount_min').html(ui.values[ 0 ]);
						box.find('span.am_range_amount_max').html(ui.values[ 1 ]);
						box.find('input.am_range_input').val(ui.values[ 0 ]+';'+ui.values[ 1 ]);
					}
				});
				box.find('span.am_range_amount_min').html(slider.slider( "values", 0 ));
				box.find('span.am_range_amount_max').html(slider.slider( "values", 1 ));
			}else{
				slider.slider({
					range: false,
					step: step_val,
					min: min_val,
					max: max_val,
					value: min_cur_val,
					slide: function( event, ui ) {
						box.find('span.am_range_amount_min').html(ui.value);
						box.find('input.am_range_input').val(ui.value);
					}
				});
				box.find('span.am_range_amount_min').html(slider.slider( "value"));
			}
		
	}
	
	
	if( typeof acf.add_action !== 'undefined' ) {
	
		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/
		
		acf.add_action('ready append', function( $el ){
			
			// search $el for fields of type 'FIELD_NAME'
			acf.get_fields({ type : 'Range'}, $el).each(function(){
				
				initialize_field( $(this) );
				
			});
			
		});
		
		
	} else {
		
		
		/*
		*  acf/setup_fields (ACF4)
		*
		*  This event is triggered when ACF adds any new elements to the DOM. 
		*
		*  @type	function
		*  @since	1.0.0
		*  @date	01/01/12
		*
		*  @param	event		e: an event object. This can be ignored
		*  @param	Element		postbox: An element which contains the new HTML
		*
		*  @return	n/a
		*/
		
		$(document).live('acf/setup_fields', function(e, postbox){
			
			$(postbox).find('.field[data-field_type="range"]').each(function(){
				
				initialize_field( $(this) );
				
			});
		
		});
	
	
	}


})(jQuery);

// Required if you want to format numbers
// Number.prototype.format = function(n, x) {
//     var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
//     return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$& ');
// };
