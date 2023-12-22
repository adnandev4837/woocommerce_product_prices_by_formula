<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://example.com/plugin-name
 * @since             1.0.0
 * @package           Woocommerce_product_prices_by_formula
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Product Prices By Formula
 * Plugin URI:        https://example.com/woocommerce_product_prices_by_formula
 * Description:       This plugin update all product prices by formula according to your currency rate.
 * Version:           1.0.0
 * Author:            Muhammad Adnan
 * Author URI:        https://example.com/plugin-name
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce_product_prices_by_formula
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WOOCOMMERCE_PRODUCT_PRICES_BY_FORMULA_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce_product_prices_by_formula-activator.php
 */
function activate_woocommerce_product_prices_by_formula()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-wppf-activator.php';
	Woocommerce_product_prices_by_formula_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce_product_prices_by_formula-deactivator.php
 */
function deactivate_woocommerce_product_prices_by_formula()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-wppf-deactivator.php';
	Woocommerce_product_prices_by_formula_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_woocommerce_product_prices_by_formula');
register_deactivation_hook(__FILE__, 'deactivate_woocommerce_product_prices_by_formula');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wppf-main.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_product_prices_by_formula()
{

	$plugin = new Woocommerce_product_prices_by_formula();
	$plugin->run();
}
run_woocommerce_product_prices_by_formula();