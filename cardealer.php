<?php
/*
Plugin Name:	Car Dealer Meta-Box Extension by Mikk
Plugin URI:		https://github.com/MikkCZ/cardealer
Description:	Meta-box Extension Plugin (Meta Box 4.3.6+ required) based on CT-Car Dealer Meta-Box Extension by CinnTech.
Version:		1.0a1
Author:			Michal Stanke
Author URI:		http://www.mikk.cz/
License:		GPL2
Requirements:	Meta-Box plugin URI: http://wordpress.org/extend/plugins/meta-box/
*/

defined( 'ABSPATH' ) or die();

define( 'CARDEALER_PLUGIN_FILE', __FILE__ );
define( 'CARDEALER_PLUGIN_DIR', trailingslashit( plugin_dir_path( CARDEALER_PLUGIN_FILE ) ) );

require_once 'locales/cs.php';

function add_cardealer_thumbnail() {
	add_image_size( 'cardealer_thumbnail', 320, 180, false );
}
add_action( 'after_setup_theme', 'add_cardealer_thumbnail' );

spl_autoload_register( 'cardealer_autoload' );

/**
 * Handles plugin classes autoloading (all should be prefixed by 'Cardealer_').
 * 
 * @param string $class_name
 * @return true if the class has been loaded successfully
 */
function cardealer_autoload( $class_name ) {
	if( substr( $class_name, 0, strlen('Cardealer_') ) === 'Cardealer_' ) {
		$class_path = CARDEALER_PLUGIN_DIR . 'classes/' . str_replace( "\\", '/', $class_name )  . '.php';
		if( file_exists( $class_path ) ) {
			require $class_path;
			return true;
		}
	}
	return false;
}

// Plugin installation and admin options
register_activation_hook( CARDEALER_PLUGIN_FILE, array('Cardealer_Options', 'install') );
add_action( 'admin_notices', array('Cardealer_MetaBox_Functions', 'installed_notice') );
if ( is_admin() ) {
	add_action( 'admin_init', array('Cardealer_Options', 'register_settings') );
	add_action( 'admin_menu', array('Cardealer_Options', 'add_menu') );
	add_action( 'admin_enqueue_scripts', array('Cardealer_Options', 'enqueue_cardealer_admin_stylesheet') );
}

// For meta-box plugin
add_filter( 'rwmb_meta_boxes', array('Cardealer_MetaBox_Functions', 'register') );

// Cardealer shortcodes
add_shortcode( 'cardealer', array('Cardealer_Shortcode', 'display_car') );
add_shortcode( 'cardealer-list', array('Cardealer_Shortcode', 'display_list') );
add_shortcode( 'cardealer-new', array('Cardealer_Shortcode', 'display_new') );

