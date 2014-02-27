=== Advanced Custom Fields: Range Field ===
Contributors: viriava
Tags:
Requires at least: 4.2.0
Tested up to: 4.3.2
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

jQuery Range Slider field for Advanced Custom Fields

== Description ==

This is an add-on for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin, that allows you to add a jQuery Range Slider field type.

= Compatibility =

This add-on will work with:

* Advanced Custom Fields version 4 and up

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
== Frequently Asked Questions  ==


**What does it return?**

If the type is Default, it returns the number. If the type is Range, it returns an array of minimum and maximum numbers. array('min'=>0, 'max'=>0)


== Changelog ==

= 1.0.0 =
* Initial version

= 1.1.0 =
* Added descriptions for fields
* Added default values
* Updated prepend and append functionality
