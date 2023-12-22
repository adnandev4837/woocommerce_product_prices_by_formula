<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://example.com/plugin-name
 * @since      1.0.0
 *
 * @package    Woocommerce_product_prices_by_formula
 * @subpackage Woocommerce_product_prices_by_formula/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woocommerce_product_prices_by_formula
 * @subpackage Woocommerce_product_prices_by_formula/public
 * @author     Muhammad Adnan <adnanmalik4837@gmail.com>
 */
class class_partials_loader
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_product_prices_by_formula_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_product_prices_by_formula_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wppf-style.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_product_prices_by_formula_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_product_prices_by_formula_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wppf-script.js', array('jquery'), $this->version, false);
	}
}
require plugin_dir_path(__FILE__) . 'partials/class-wppf_price_update.php';
require plugin_dir_path(__FILE__) . 'partials/class-wppf_add_custom_fields.php';
require plugin_dir_path(__FILE__) . 'partials/class-wppf_save_custom_fields.php';