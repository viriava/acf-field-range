<?php

class acf_field_range extends acf_field
{
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options


	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/

	function __construct()
	{
		// vars
		$this->name = 'range';
		$this->label = __('Range');
		$this->category = __("jQuery",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
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


		// do not delete!
    parent::__construct();


    // settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.1.2'
		);

	}


	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/

	function create_options($field)
	{
		// defaults?
		$field = array_merge($this->defaults, $field);


		// key is needed in the field names to correctly save the data
		$key = $field['name'];


		// Create Field Options HTML
		?>
<tr class="field_option field_option_range_type field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Type",'acf'); ?></label>
		<p class="description"><?php _e('Choose the number or slider view','acf'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'radio',
				'name'  => 'fields[' . $key . '][slider_type]',
				'choices'  => array('default'=>__('Number','acf'), 'range'=>__('Range','acf')),
				'value' => $field['slider_type'],
				'layout'  => 'horizontal'
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Title",'acf'); ?></label>
		<p class="description"><?php _e('eg. Show extra content before numbers','acf'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'text'
				, 'name'  => 'fields[' . $key . '][title]'
				, 'value' => $field['title']
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Prepend",'acf'); ?></label>
		<p class="description"><?php _e('Appears before the number','acf'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'text'
				, 'name'  => 'fields[' . $key . '][prepend]'
				, 'value' => $field['prepend']
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Append",'acf'); ?></label>
		<p class="description"><?php _e('Appears after the number','acf'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'text'
				, 'name'  => 'fields[' . $key . '][append]'
				, 'value' => $field['append']
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_range_separate field_option_<?php echo $this->name; ?>" <?php /*if( $field['slider_type']!='range' ): ?>style="display:none"<?php endif;*/ ?>>
	<td class="label">
		<label><?php _e("Separate Symbol",'acf'); ?></label>
		<p class="description"><?php _e('Choose the separator for two values for the Slider view','acf'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'text'
				, 'name'  => 'fields[' . $key . '][separate]'
				, 'value' => $field['separate']
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Default Value #1",'acf'); ?></label>
		<p class="description"><?php _e('Appears when creating a new post','acf'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'number'
				, 'name'  => 'fields[' . $key . '][default_value_1]'
				, 'value' => $field['default_value_1']
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Default Value #2",'acf'); ?></label>
		<p class="description"><?php _e('Appears when creating a new post for the Slider view','acf'); ?></p>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'number'
				, 'name'  => 'fields[' . $key . '][default_value_2]'
				, 'value' => $field['default_value_2']
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Minimum Value",'acf'); ?></label>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'number'
				, 'name'  => 'fields[' . $key . '][min]'
				, 'value' => $field['min']
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Maximum Value",'acf'); ?></label>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'number'
				, 'name'  => 'fields[' . $key . '][max]'
				, 'value' => $field['max']
			) );
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Step Size",'acf'); ?></label>
	</td>
	<td>
		<?php
		do_action('acf/create_field', array(
				'type'    => 'number'
				, 'name'  => 'fields[' . $key . '][step]'
				, 'value' => $field['step']
			) );
		?>
	</td>
</tr>
		<?php

	}


	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function create_field( $field )
	{
		// vars
		$field = array_merge($this->defaults, $field);
		
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
			if($value!=''){
				$value_ar = explode(';', $value);
				if(isset($value_ar[0])){
					$min_cur = $value_ar[0];
				}
				if(isset($value_ar[0])){
					$max_cur = $value_ar[1];
				}
			}
			if($value===false){
				$value = $min_cur.';'.$max_cur;
			}
		}else{
			if($value!=''){
				$min_cur = $max_cur = $value;
			}
			if($value===false){
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
	*  Use this action to add css + javascript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used


		// register acf scripts
		wp_register_script('acf-input-range', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version']);
		wp_register_style('acf-input-range', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version']);


		// scripts
		wp_enqueue_script(array(
			'acf-input-range',
		));
		
		wp_enqueue_script( 'acf-am-range', $this->settings['dir'] . 'js/range.js', array('acf-input-range', 'jquery-ui-slider'), $this->settings['version'], true );

		// styles
		wp_enqueue_style(array(
			'acf-input-range',
		));
		
		wp_enqueue_style('acf-am-jquery-ui',  $this->settings['dir'] . 'css/jquery-ui.css',array(),$this->settings['version']);

		wp_enqueue_style('acf-am-range',  $this->settings['dir'] . 'css/range.css',array('acf-input-range','acf-am-jquery-ui'),$this->settings['version']);

	}


	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add css and javascript to assist your create_field() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add css + javascript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
		wp_enqueue_script( 'acf-range-admin', $this->settings['dir'] . 'js/range-admin.js', array('jquery'), $this->settings['version'], true );
	}


	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add css and javascript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  load_value()
	*
	*  This filter is appied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded from
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in te database
	*/

	function load_value($value, $post_id, $field)
	{
		// Note: This function can be removed if not used
		return $value;
	}


	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/

	function update_value($value, $post_id, $field)
	{
		// Note: This function can be removed if not used
		return $value;
	}


	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/

	function format_value($value, $post_id, $field)
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/

		// perhaps use $field['preview_size'] to alter the $value?


		// Note: This function can be removed if not used
		return $value;
	}


	/*
	*  format_value_for_api()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/

	function format_value_for_api($value, $post_id, $field)
	{
		// format value
	    if ( empty($value) ) {
			
			if ( empty($field['default_value_1']) ) {
				$default_value_1 = 0;
			} else {
				$default_value_1 = $field['default_value_1'];
			}

			if ( empty($field['default_value_2']) ) {
				$default_value_2 = 0;
			} else {
				$default_value_2 = $field['default_value_2'];
			}

			if ( $field['slider_type'] == 'range' ) {
				$value = $default_value_1.';'.$default_value_2;
			} else {
				$value = $default_value_1;
			}
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
	*  load_field()
	*
	*  This filter is appied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/

	function load_field($field)
	{
		// Note: This function can be removed if not used
		return $field;
	}


	/*
	*  update_field()
	*
	*  This filter is appied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field($field, $post_id)
	{
		// Note: This function can be removed if not used
		return $field;
	}


}


// create field
new acf_field_range();

?>