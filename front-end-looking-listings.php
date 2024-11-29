<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              developerforwebsites.com
 * @since             1.0.0
 * @package           Front_End_Looking_Listings
 *
 * @wordpress-plugin
 * Plugin Name:       Front End Looking Listings
 * Plugin URI:        developerforwebsites.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Freelancer Martin
 * Author URI:        developerforwebsites.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       front-end-looking-listings
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FRONT_END_LOOKING_LISTINGS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-front-end-looking-listings-activator.php
 */
function activate_front_end_looking_listings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-front-end-looking-listings-activator.php';
	Front_End_Looking_Listings_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-front-end-looking-listings-deactivator.php
 */
function deactivate_front_end_looking_listings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-front-end-looking-listings-deactivator.php';
	Front_End_Looking_Listings_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_front_end_looking_listings' );
register_deactivation_hook( __FILE__, 'deactivate_front_end_looking_listings' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-front-end-looking-listings.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_front_end_looking_listings() {

	$plugin = new Front_End_Looking_Listings();
	$plugin->run();

}
run_front_end_looking_listings();
