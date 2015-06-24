<?php
/*
Plugin Name: WP Admin Classic Colors
Plugin URI: http://webshoplogic.com/
Description: Add a new admin color scheme to your WP site, strikes a balance between earlier classical view and new flat view. Colors are similar to WordPress classical light grey and blue colors of admin page, the new color scheme makes visible menu separators between menu blocks and menu items. 
Version: 1.0.2
Author: WebshopLogic
Author URI: http://webshoplogic.com/
License: GPLv2 or later
Text Domain: wacc
Requires at least: 3.8
Tested up to: 4.2.2.
*/

function additional_admin_color_schemes() {  
    //Get the plugin URL
	$plugin_url = untrailingslashit( plugins_url( '/', __FILE__ ) );

	wp_admin_css_color( 'wp-admin-classic-colors', __( 'WP Admin Classic Colors', 'wacc' ),
		$plugin_url . '/css/colors.min.css',
		array( '#ffffff', '#e5e5e5', '#888', '#21759b',  ),
		array( 'base' => '#999', 'focus' => '#ccc', 'current' => '#ccc' )
	);	
	
}  

//INIT PLUGIN
add_action('admin_init', 'additional_admin_color_schemes');  


?>