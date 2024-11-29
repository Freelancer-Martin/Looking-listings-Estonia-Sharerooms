<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       developerforwebsites.com
 * @since      1.0.0
 *
 * @package    Front_End_Looking_Listings
 * @subpackage Front_End_Looking_Listings/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Front_End_Looking_Listings
 * @subpackage Front_End_Looking_Listings/includes
 * @author     Freelancer Martin <developerforwebsites@gmail.com>
 */
class Front_End_Looking_Listings_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'front-end-looking-listings',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
