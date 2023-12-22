<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://example.com/plugin-name
 * @since      1.0.0
 *
 * @package    Woocommerce_product_prices_by_formula
 * @subpackage Woocommerce_product_prices_by_formula/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_product_prices_by_formula
 * @subpackage Woocommerce_product_prices_by_formula/includes
 * @author     Muhammad Adnan <adnanmalik4837@gmail.com>
 */
class Woocommerce_product_prices_by_formula_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce_product_prices_by_formula',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
