/**
 *  Range
 */
(function($){
	
	$(document).live('acf/setup_fields', function(e, postbox){
		$(postbox).find('div.am_range_amount').each(function(){
			var box = $(this);
			var slider = box.find('div.am_range')
				, min_val = parseFloat(slider.attr('data-min'))
				, max_val = parseFloat(slider.attr('data-max'))
				, min_cur_val = parseFloat(slider.attr('data-min-cur'))
				, max_cur_val = parseFloat(slider.attr('data-max-cur'))
				, step_val = parseFloat(slider.attr('data-step'))
				, step_type = slider.attr('data-type');

			if( acf.helpers.is_clone_field(slider) )
			{
				return;
			}
			
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

		});
	});
	
	
})(jQuery);