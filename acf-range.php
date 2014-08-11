<?php
/*
Plugin Name: Advanced Custom Fields: Range
Plugin URI: https://github.com/viriava/acf-field-range
Description: jQuery Range Slider field for Advanced Custom Fields
Version: 1.1.3
Author: viriava
Author URI: http://www.crazyxhtml.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


class acf_field_range_plugin
{
	/*
	*  Construct
	*
	*  @description:
	*  @since: 3.6
	*  @created: 1/04/13
	*/

	function __construct()
	{
		// set text domain
		/*
		$domain = 'acf-range';
		$mofile = trailingslashit(dirname(__File__)) . 'lang/' . $domain . '-' . get_locale() . '.mo';
		load_textdomain( $domain, $mofile );
		*/


		// version 4+
		add_action('acf/register_fields', array($this, 'register_fields'));

		// version 5+
		add_action('acf/include_field_types', array($this, 'include_field_types_range') );
	}


	/*
	*  Init
	*
	*  @description:
	*  @since: 3.6
	*  @created: 1/04/13
	*/

	function init()
	{
	}

	/*
	*  register_fields
	*
	*  @description:
	*  @since: 3.6
	*  @created: 1/04/13
	*/

	function register_fields()
	{
		include_once('range-v4.php');

	}

	function include_field_types_range() {
		include_once('range-v5.php');
	}

}

new acf_field_range_plugin();

?>