<?php

/**
 * Cardealer_Options is singleton handling the plugin options and its installation.
 * 
 * @author Michal Stanke <michal.stanke@mikk.cz>
 */
class Cardealer_Options {

	private static $instance = NULL;
	private $option_group = 'cardealer-option-group';

	/**
	 * Handles the plugin installation and its options registration (including default values).
	 */
	public function install() {
		$cardealer_options = self::getInstance();
		//add_option( $cardealer_options->option, 'value' );
	}

	public function enqueue_cardealer_admin_stylesheet() {
		wp_register_style( 'cardealer-admin', plugins_url( 'css/admin.css', __FILE__ ) );
		wp_enqueue_style( 'cardealer-admin' );
	}

	/**
	 * Registers the plugin settings.
	 */
	public function register_settings() {
		$cardealer_options = self::getInstance();
		//register_setting( $cardealer_options->option_group, $cardealer_options->option );
	}

	/**
	 * Registers the plugin page in the admin menu.
	 */
	public function add_menu() {
//		add_options_page(
//			'Cardealer Settings',
//			'Cardealer Settings',
//			'manage_options',
//			'Cardealer_Settings_Page.php',
//			array( new Cardealer_Settings_Page( self::getInstance()->option_group ), 'main' )
//		);
	}

	/**
	 * Returns the Cardealer_Options singleton instance.
	 */
	public static function getInstance() {
		if ( self::$instance == NULL ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {}

}
