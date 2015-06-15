<?php
/*
Plugin Name: WP Admin Classic Colors
Plugin URI: http://webshoplogic.com/
Description: Add a new admin color scheme to your WP site, strikes a balance between earlier classical view and new flat view. Colors are similar to WordPress classical light grey and blue colors of admin page, the new color scheme makes visible menu separators between menu blocks and menu items. 
Version: 1.0.1
Author: WebshopLogic
Author URI: http://webshoplogic.com/
License: GPLv2 or later
Text Domain: wacc
Requires at least: 3.8
Tested up to: 4.1.1.
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
$options = get_option( 'wacc_general_settings' );
if (1==$options['enable_plugin']) {
	add_action('admin_init', 'additional_admin_color_schemes');  
}


function wacc_admin_menu () {
	
	//add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	add_options_page( __('WP Admin Classic Colors','wacc'),__('WP Admin Classic Colors','wacc')
		,'manage_options','wp-admin-classic-colors', 'add_options_page_callback' );
}
add_action( 'admin_menu', 'wacc_admin_menu' ) ;

function wacc_admin_init()
{

	//register_setting( $option_group, $option_name, $sanitize_callback );        
	register_setting(
		'wacc_general_settings', // Option group / tab page
		'wacc_general_settings', // Option name
		'sanitize' // Sanitize
	);

	add_settings_section(
		'wacc_general_section', // ID 
		__('General Settings','wacc'), // Title //ML
		'print_section_info', // Callback 
		'wacc_general_settings' // Page / tab page
	);
	
	//add_settings_field( $id, $title, $callback, $page, $section, $args );
	add_settings_field(
		'enable_plugin', // ID
		__('Enable WP Admin Classic Colors Plugin','wacc'), // Title 
		'posttype_callback', // Callback
		'wacc_general_settings', // Page / tab page
		'wacc_general_section' // Section           
	);

}
add_action( 'admin_init', 'wacc_admin_init' );

function add_options_page_callback()
{
	wp_enqueue_style( 'wacc-admin', plugins_url('wacc-admin.css', __FILE__) );
	
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e('WP Admin Classic Colors by WebshopLogic','wacc') ?></h2>    
		
		<div style="float:left; width: 70%">
		
			<form method="post" action="options.php"><!--form-->  
				
				<?php
	
				settings_fields( 'wacc_general_settings' );					
				$options = get_option( 'wacc_general_settings' ); //option_name
	
				?>
				<h3><?php _e('General Settings','wacc') ?></h3>
				<?php 
				//echo __('Enter your settings below','wacc') . ':' 
				?>
	
				<table class="form-table">
	
					<tr valign="top">
						<th scope="row"><?php echo __('Enable WP Admin Classic Colors Plugin','wacc') . ':' ?></th>
						<td>
							<?php
							printf(
								'<input type="checkbox" id="enable_plugin" name="wacc_general_settings[enable_plugin]"
								value="1"' . checked( 1, esc_attr( $options['enable_plugin']), false ) . ' />'
							);

							?>    
						</td>
					</tr>							
	
				</table>

				<?php echo '<b>' . __('IMPORTANT: After enable this plugin, go to Users -> Your Profile menu, and select WP Admin Classic Colors scheme.','wacc') . '</b>'; ?>				
	
				<?php
				submit_button();
				?>
	
			</form><!--end form-->

		</div><!--emd float:left; width: 70% / 100% -->
	
		<div class="wri_admin_left_sidebar" style="float:right; ">
			
			<style>
				a.wli_pro:link {color: black; text-decoration:none;}
				a.wli_pro:visited {color: black; text-decoration:none;}
				a.wli_pro:hover {color: black; text-decoration:underline;}
				a.wli_pro:active {color: black; text-decoration:none;}
			</style>

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="RQVXD24KQ9ZNQ">
			<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			
			<hr>
			
			<a href="http://webshoplogic.com/products/" class="wli_pro" target="_blank">
				<h2><?php _e('Try out WP Related Items plugin', 'wacc'); ?></h2>
			</a>							
			
			<a href="http://webshoplogic.com/products/" class="wli_pro" target="_blank">
				<img src="http://emberpalanta.hu/wp-content/plugins/wp-related-items/images/WLI_product_box_PRO_upgrade_right_v1_2e_235x235.png" alt="Upgrade to PRO">
			</a>

			<?php echo __('WP Related Items plugin makes visible every kind of hidden connections of your WordPress site for your business.','wacc') . '<br><br>' ; ?>				
			<?php echo __('Would you like to offer some related products to your blog posts? Do you have an event calendar plugin, and want to suggest some programs connected to an article? Do you have a custom movie catalog plugin and want to associate some articles to your movies?','wacc') ; ?>
		
		</div>

	</div>
	<?php

}

function sanitize( $input )
{
	if( !is_numeric( $input['id_number'] ) )
		$input['id_number'] = '';  

	if( !empty( $input['title'] ) )
		$input['title'] = sanitize_text_field( $input['title'] );

	return $input;
}

?>