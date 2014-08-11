<?php

class acf_field_range extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct() {
		
		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/
		
		$this->name = 'Range';
		
		
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		
		$this->label = __('Range', 'acf-range');
		
		
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		
		$this->category = 'jQuery';
		
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array(
			'font_size'	=> 14,
			'slider_type' => 'default',
			'min' => 0,
			'max' => 100,
			'default_value_1' => 0,
			'default_value_2' => 100,
			'step' => 1,
			'title' => __('Range','acf'),
			'separate' => '-',
			'prepend' => '',
			'append'  => ''
		);
		
		
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('FIELD_NAME', 'error');
		*/
		
		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'acf-range'),
		);
		
				
		// do not delete!
    	parent::__construct();

    	$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.1.2'
		);

    	
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/
		
		acf_render_field_setting( $field, array(
			'label'			=> __('Type','acf-range'),
			'instructions'	=> __('Choose the number or slider view','acf-range'),
			'type'			=> 'radio',
			'name'			=> 'slider_type',
			'choices'		=> array(
				'default'		=> __("Number",'acf'),
				'range'			=> __("Range",'acf'),
			),
			'layout'	=>	'horizontal',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Title','acf-range'),
			'instructions'	=> __('eg. Show extra content before numbers','acf-range'),
			'type'			=> 'text',
			'name'			=> 'title',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Prepend','acf-range'),
			'instructions'	=> __('Appears before the number','acf-range'),
			'type'			=> 'text',
			'name'			=> 'prepend',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Append','acf-range'),
			'instructions'	=> __('Appears after the number','acf-range'),
			'type'			=> 'text',
			'name'			=> 'append',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Separate Symbol','acf-range'),
			'instructions'	=> __('Choose the separator for two values for the Slider view','acf-range'),
			'type'			=> 'text',
			'name'			=> 'separate',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value #1','acf-range'),
			'instructions'	=> __('Appears when creating a new post','acf-range'),
			'type'			=> 'number',
			'name'			=> 'default_value_1',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value #2','acf-range'),
			'instructions'	=> __('Appears when creating a new post for the Slider view','acf-range'),
			'type'			=> 'number',
			'name'			=> 'default_value_2',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Minimum value','acf-range'),
			'type'			=> 'number',
			'name'			=> 'min',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Maximum Value','acf-range'),
			'type'			=> 'number',
			'name'			=> 'max',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Step size','acf-range'),
			'type'			=> 'number',
			'name'			=> 'step',
		));

	}
	
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {
		
		// var_dump( $field );
		/*
		*  Review the data of $field.
		*  This will show what data is available
		*/
		
		// echo '<pre>';
		// 	print_r( $field );
		// echo '</pre>';
		$step = $field['step'];
		if(empty($step))
			$step = 1;
		$slider_type = $field['slider_type'];
		if(empty($slider_type))
			$slider_type = 'default';
		$min = $field['min'];
		$max = $field['max'];
		$prepend = $field['prepend'];
		$append = $field['append'];
		$default_value_1 = $field['default_value_1'];
		$default_value_2 = $field['default_value_2'];
		$value = $field['value'];

		$title = '';
		if(!empty($field['title'])){
			$title = '<span class="am_range_amount_title"> '.$field['title'].' </span>';
		}
		
		$separate = '';
		if(!empty($field['separate'])){
			$separate = ' <span class="am_range_amount_sep">'.$field['separate'].'</span> ';
		}
		$min_cur = $default_value_1;
		$max_cur = $default_value_2;
		if($slider_type=='range'){
			if( isset( $value ) && $value != ''){
				$value_ar = explode(';', $value);
				if(isset($value_ar[0])){
					$min_cur = $value_ar[0];
				}
				if(isset($value_ar[1])){
					$max_cur = $value_ar[1];
				}
			}
			if($value===false){
				$value = $min_cur.';'.$max_cur;
			}
		}else{
			if( isset( $value ) && $value!=''){
				$min_cur = $max_cur = $value;
			}
			if( isset( $value ) && $value===false){
				$value = $min_cur;
			}
		}
		
		echo '<div class="am_range_amount">';
		
		if($slider_type=='range'){
			echo '<p>'.$title.$prepend.'<span class="am_range_amount_min"></span>'.$append.$separate.$prepend.'<span class="am_range_amount_max"></span>'.$append.'</p>';
		}else{
			echo '<p>'.$title.$prepend.'<span class="am_range_amount_min"></span>'.$append.'</p>';
		}
		
		echo '<div class="am_range" data-min="' . $min . '" data-max="' . $max . '" data-min-cur="' . $min_cur . '" data-max-cur="' . $max_cur . '" data-step="' . $step . '" data-type="' . $slider_type . '"></div>';
		
		echo '<input type="hidden" value="' . $value . '" name="' . $field['name'] . '" class="am_range_input" />';
		
		echo '</div>';
		
	}
	
		
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	
	
	function input_admin_enqueue_scripts() {
		
		$dir = plugin_dir_url( __FILE__ );
		
		
		wp_register_script('acf-input-range', $dir . 'js/input.js', array('acf-input'), $this->settings['version']);
		wp_register_style('acf-input-range', $dir . 'css/input.css', array('acf-input'), $this->settings['version']);


		// scripts
		wp_enqueue_script(array(
			'acf-input-range',
		));
		
		wp_enqueue_script( 'acf-am-range', $dir . 'js/range.js', array('acf-input-range', 'jquery-ui-slider'), $this->settings['version'], true );

		// styles
		wp_enqueue_style(array(
			'acf-input-range',
		));
		
		wp_enqueue_style('acf-am-jquery-ui',  $dir . 'css/jquery-ui.css',array(),$this->settings['version']);

		wp_enqueue_style('acf-am-range',  $dir . 'css/range.css',array('acf-input-range','acf-am-jquery-ui'),$this->settings['version']);
		
		
	}
	
	
	
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_head() {
	
		
		
	}
	
	*/
	
	
	/*
   	*  input_form_data()
   	*
   	*  This function is called once on the 'input' page between the head and footer
   	*  There are 2 situations where ACF did not load during the 'acf/input_admin_enqueue_scripts' and 
   	*  'acf/input_admin_head' actions because ACF did not know it was going to be used. These situations are
   	*  seen on comments / user edit forms on the front end. This function will always be called, and includes
   	*  $args that related to the current screen such as $args['post_id']
   	*
   	*  @type	function
   	*  @date	6/03/2014
   	*  @since	5.0.0
   	*
   	*  @param	$args (array)
   	*  @return	n/a
   	*/
   	
   	/*
   	
   	function input_form_data( $args ) {
	   	
		
	
   	}
   	
   	*/
	
	
	/*
	*  input_admin_footer()
	*
	*  This action is called in the admin_footer action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_footer)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_footer() {
	
		
		
	}
	
	*/
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	
	
	function field_group_admin_enqueue_scripts() {
		wp_enqueue_script( 'acf-range-admin', $this->settings['dir'] . 'js/range-admin.js', array('jquery'), $this->settings['version'], true );
	}
	
	

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add CSS and JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
	
	function field_group_admin_head() {
	
	}
	
	*/


	/*
	*  load_value()
	*
	*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	
	
	function load_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	
	
	
	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is saved in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	
	
	function update_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value which was loaded from the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*
	*  @return	$value (mixed) the modified value
	*/
		
	
	
	// function format_value( $value, $post_id, $field ) {
		
	// 	// bail early if no value
	// 	if( empty($value) ) {
		
	// 		return $value;
			
	// 	}
		
		
	// 	// apply setting
	// 	// if( $field['font_size'] > 12 ) { 
			
	// 		// format the value
	// 		// $value = 'something';
		
	// 	// }
		
		
	// 	// return
	// 	return $value;
	// }

	function format_value($value, $post_id, $field)
	{
		// format value
	    if( !$value )
	    {
	    	return 0;
	    }
	
	
	    if( $value == 'null' )
	    {
	    	return 0;
	    }
	    
	    $temp = explode(';', $value);
	    
	    $value_ar = array('min'=>0, 'max'=>0);
	    
	    if(isset($temp[0])){
		    $value_ar['min'] = floatval($temp[0]);
	    }
	    if(isset($temp[1])){
		    $value_ar['max'] = floatval($temp[1]);
	    }else{
		    if(isset($temp[0])){
			    $value_ar = floatval($temp[0]);
		    }
	    }
	
	    // return value
	    return $value_ar;
	}
	
	
	
	
	/*
	*  validate_value()
	*
	*  This filter is used to perform validation on the value prior to saving.
	*  All values are validated regardless of the field's required setting. This allows you to validate and return
	*  messages to the user if the value is not correct
	*
	*  @type	filter
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$valid (boolean) validation status based on the value and the field's required setting
	*  @param	$value (mixed) the $_POST value
	*  @param	$field (array) the field array holding all the field options
	*  @param	$input (string) the corresponding input name for $_POST value
	*  @return	$valid
	*/
	
	/*
	
	function validate_value( $valid, $value, $field, $input ){
		
		// Basic usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = false;
		}
		
		
		// Advanced usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = __('The value is too little!','acf-FIELD_NAME'),
		}
		
		
		// return
		return $valid;
		
	}
	
	*/
	
	
	/*
	*  delete_value()
	*
	*  This action is fired after a value has been deleted from the db.
	*  Please note that saving a blank value is treated as an update, not a delete
	*
	*  @type	action
	*  @date	6/03/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (mixed) the $post_id from which the value was deleted
	*  @param	$key (string) the $meta_key which the value was deleted
	*  @return	n/a
	*/
	
	/*
	
	function delete_value( $post_id, $key ) {
		
		
		
	}
	
	*/
	
	
	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0	
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	
	
	function load_field( $field ) {
		
		return $field;
		
	}	
	
	
	
	
	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	
	
	function update_field( $field ) {
		
		return $field;
		
	}	
	
	
	
	
	/*
	*  delete_field()
	*
	*  This action is fired after a field is deleted from the database
	*
	*  @type	action
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	n/a
	*/
	
	/*
	
	function delete_field( $field ) {
		
		
		
	}	
	
	*/
	
	
}


// create field
new acf_field_range();

?>