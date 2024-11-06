<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://frankremmy.com
 * @since             1.0.0
 * @package           Custom_Code_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Code Manager
 * Plugin URI:        https://frankremmy.com
 * Description:       A plugin that lets you add a PHP, HTML, and JavaScript code snippets directly into your WordPress site without modifying theme files.
 * Version:           1.0.0
 * Author:            Frank Remmy
 * Author URI:        https://frankremmy.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-code-manager
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
define( 'CUSTOM_CODE_MANAGER_VERSION', '1.0.0' );
define( 'CUSTOM_CODE_MANAGER_PATH', plugin_dir_path( __FILE__ ) );
define( 'CUSTOM_CODE_MANAGER_URL', plugin_dir_url( __FILE__ ) );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-code-manager-activator.php
 */
function activate_custom_code_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-code-manager-activator.php';
	Custom_Code_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-code-manager-deactivator.php
 */
function deactivate_custom_code_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-code-manager-deactivator.php';
	Custom_Code_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_code_manager' );
register_deactivation_hook( __FILE__, 'deactivate_custom_code_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-code-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_code_manager() {

	$plugin = new Custom_Code_Manager();
	$plugin->run();

}
run_custom_code_manager();
