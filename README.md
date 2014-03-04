# ACF Range Field

Adds a 'Range' field type for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin.

-----------------------

### Works with ACF 4.2.0

### Overview

This is an add-on for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) WordPress plugin, that allows you to add a jQuery Range Slider field type. http://jqueryui.com/slider/

### Compatibility

This add-on will work with:

* Advanced Custom Fields version 4 and up

### Installation


This add-on can be treated as both a WP plugin and a theme include.

**Install as Plugin**

1. Copy the 'acf-range' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

**Include within theme**

1.	Copy the 'acf-range' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.	Edit your functions.php file and add the code below (Make sure the path is correct to include the acf-range.php file)

```php
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	include_once('acf-range/acf-range.php');
}
```

### Frequently Asked Questions 


**What does it return?**

If the type is Default, it returns the number. 

If the type is Range, it returns an array of minimum and maximum numbers. 


		array(2) { 
			["min"]=> float(0) 
			["max"]=> float(0) 
		}