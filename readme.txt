=== Advanced Custom Fields: Range Field ===
Contributors: viriava
Donate link: http://www.crazyxhtml.com
Tags: acf, field, range, jquery
Requires at least: 3.0.1
Tested up to: 3.8
Stable tag: 1.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

jQuery Range Slider field for Advanced Custom Fields

== Description ==

This is an add-on for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin, that allows you to add a jQuery Range Slider field type. http://jqueryui.com/slider/

Read more here: https://github.com/viriava/acf-field-range

== Installation ==

This add-on can be treated as both a WP plugin and a theme include.

= Plugin =
1. Copy the 'acf-range' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

= Include =
1.	Copy the 'acf-range' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.	Edit your functions.php file and add the code below (Make sure the path is correct to include the acf-range.php file)

`
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('acf-range/acf-range.php');
}

`

== Frequently Asked Questions ==

= What does it return? =

If the type is Default, it returns the number. 

If the type is Range, it returns an array of minimum and maximum numbers. 


		array(2) { 
			["min"]=> float(0) 
			["max"]=> float(0) 
		}


== Screenshots ==

1. Default look

== Changelog ==

= 1.1.2 =
* ZERO bug fixed

= 1.1.1 =
* Updated parseInt to parseFloat

= 1.1.0 =
* Added descriptions for fields
* Added default values
* Updated prepend and append functionality

= 1.0.0 =
* Initial version