<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://example.com/plugin-name
 * @since      1.0.0
 *
 * @package    Woocommerce_product_prices_by_formula
 * @subpackage Woocommerce_product_prices_by_formula/public/partials
 * Authors : Muhammad Adnan , Muhammad Talha 
 * Developed By: Codistan
 */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    function my_plugin_menu()
    {
        add_menu_page("Update Prices", "WPPF", "manage_options", "Update Prices", "price_update_function", 'dashicons-update', 6);
    }
    add_action('admin_menu', 'my_plugin_menu');
} else {
    //echo "Please Activate Woocommerce Plugin For this plugin working";
}

//THIS FUNCTION GETS ALL PRODUCTS PRICES AND UPDATE THEIR PRICES
function price_update_function()
{
    $css = file_get_contents(plugin_dir_path( __FILE__ ).'style.css');
    echo $css;
    //PLUGIN DISPLAY ON DASHBOARD
    echo '
    <div class="tabset">
  <!-- Tab 1 -->
  <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
  <label for="tab1">Import Data</label>
  <!-- Tab 2 -->
  <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
  <label for="tab2">Update Prices</label>
  
  <div class="tab-panels ">
    <section id="marzen" class="tab-panel">
    <div style="align-items:left;  ">
    <p style="font-size:25px;font-weight:50px;  ">IMPORT DATA ON ADDING NEW PRODUCTS </p>
    <p style="font-size:15px;">Copy all regular and sale prices.</p>
    <form method="post" style="display:flex;flex-direction:column;align-items:left;justify-content-left;">
        <input type="submit" class="button button-primary button-large" style="font-weight:400px;font-size:1em;height:3em;width:9em;margin-top:2%;"name="pressed" value="IMPORT">
    </form>
    </div>
    </section>
    <section id="rauchbier" class="tab-panel">
    <div style="align-items:left;  ">
    <p style="font-size:25px;font-weight:50px;" >WOOCOMMERCE PRICES UPDATE SETTINGS</p>
    <p style="font-size:15px;">Update prices of all products according to current GBP rate.</p>
    <form method="post" style="display:flex;flex-direction:column;align-items:left;">
        <input style="margin-top:2%;height:3em;width:19em;" placeholder="GBP Rate" type="text" id="price" name="rate" value=""><br>
        <input type="submit" class="button button-primary button-large" style="font-weight:400px;font-size:1em;height:3em;width:9em;margin-top:2%;"name="insert" value="UPDATE">
    </form>
    </div>
    </section>
  </div>
  
</div>';
    //CODE FOR COPYING PRICES OD NEWLY ADDED PRODUCTS
    if (isset($_POST['pressed'])) {
        $products = wc_get_products(array('status' => 'publish', 'limit' => -1));
                //ITERATING THROUGH ALL PRODUCTS
                foreach ($products as $product) {
                    //FOR SIMPLE PRODUCTS
                    if ($product->is_type('simple')) {
                        $regular_price = get_post_meta($product->get_id(), '_regular_price', true);
                        $sale_price = get_post_meta($product->get_id(), '_sale_price', true);
                          $woocommerce_custom_product_original_regular_price = get_post_meta($product->get_id(), '_original_regular_price', true);
                         $woocommerce_custom_product_original_sale_price = get_post_meta($product->get_id(), '_original_sale_price', true);
                        //FOR SIMPLE PRODUCTS THAT ARE NOT ON SALE
                        if ($sale_price == null) {
                        
            if ($woocommerce_custom_product_original_regular_price == null)
            {
                             update_post_meta($product->get_id(), '_original_regular_price', $regular_price);
            }
                        }
                        //FOR SIMPLE PRODUCTS THAT ARE ON SALE
                        else {
                              
            if (($woocommerce_custom_product_original_sale_price== null) && ($woocommerce_custom_product_original_regular_price== null) )
            {
                            update_post_meta($product->get_id(), '_original_sale_price', $sale_price);
                            update_post_meta($product->get_id(), '_original_regular_price', $regular_price);
                        }
                       }
                    }
                    //FOR VARIABLE PRODUCTS
                    if ($product->is_type('variable')) {
                        //GETTING ALL AVAILABLE VARIATIONS OF THE PRODUCT
                        foreach ($product->get_available_variations() as $variation_values) {
                            $variation_id = $variation_values['variation_id'];
                            //GETTING PRICES
                            $regular_price = get_post_meta($variation_id, '_regular_price', true);
                            $sale_price = get_post_meta($variation_id, '_sale_price', true);
                            $save_original_regular_price = get_post_meta($variation_id, '_original_regular_price', true);
                            $save_original_sale_price = get_post_meta($variation_id, '_original_regular_price', true);
                            //echo $save_original_regular_price;
                            //echo $save_original_sale_price;
                            //FOR VARIABLE PRODUCTS THAT ARE NOT ON SALE
                            if ($sale_price == null) {
                                 if ($save_original_regular_price== null)
                                 {
                                 update_post_meta($variation_id, '_original_regular_price', $regular_price);
                                 }
                            }
                            //FOR VARIABLE PRODUCTS THAT ARE NOT ON SALE 
                            else {
                                 if (($save_original_regular_price== null) && ($save_original_sale_price== null)  )
                                 {
                                update_post_meta($variation_id, '_original_sale_price', $sale_price);
                                update_post_meta($variation_id, '_original_regular_price', $regular_price);
                                 }
                            }
                        }
                    }
                }
        }

    //THIS FUNCTION WORKS WHEN UPDATE BUTTON IS PRESSED IN PLUGIN
    if (isset($_POST['insert'])) {
        //GETTING ALL THE PRODUCTS
        $products = wc_get_products(array('status' => 'publish', 'limit' => -1));
        //ITERATING THROUGH ALL PRODUCTS
        foreach ($products as $product) {
            //FOR SIMPLE PRODUCTS
            if ($product->is_type('simple')) {
                $original_sale_price = get_post_meta($product->get_id(), '_original_sale_price', true);
                $original_regular_price = get_post_meta($product->get_id(), '_original_regular_price', true);
                //FOR SIMPLE PRODUCTS THAT ARE NOT ON SALE
                if ($original_sale_price == null) {
                    update_post_meta($product->get_id(), '_regular_price', formula_function($original_regular_price));
                    update_post_meta($product->get_id(), '_price', formula_function($original_regular_price));
                }
                //FOR SIMPLE PRODUCTS THAT ARE ON SALE 
                else {
                    update_post_meta($product->get_id(), '_sale_price', formula_function($original_sale_price));
                    update_post_meta($product->get_id(), '_regular_price', formula_function($original_regular_price));
                    update_post_meta($product->get_id(), '_price', formula_function($original_sale_price));
                }
            }
            //FOR VARIABLE PRODUCTS
            if ($product->is_type('variable')) {
                //GETTING ALL AVAILABLE VARIATIONS OF THE PRODUCT
                foreach ($product->get_available_variations() as $variation_values) {
                    $variation_id = $variation_values['variation_id'];
                    //GETTING PRICES
                    $original_variation_sale_price = get_post_meta($variation_id, '_original_sale_price', true);
                    $original_variation_regular_price = get_post_meta($variation_id, '_original_regular_price', true);
                    //FOR VARIABLE PRODUCTS THAT ARE NOT ON SALE
                    if ($original_variation_sale_price == null) {
                        update_post_meta($variation_id, '_regular_price', formula_function($original_variation_regular_price));
                        update_post_meta($variation_id, '_price', formula_function($original_variation_regular_price));
                    }
                    //FOR VARIABLE PRODUCTS THAT ARE NOT ON SALE 
                    else {
                        update_post_meta($variation_id, '_sale_price', formula_function($original_variation_sale_price));
                        update_post_meta($variation_id, '_regular_price', formula_function($original_variation_regular_price));
                        update_post_meta($variation_id, '_price', formula_function($original_variation_sale_price));
                    }
                    // Clear/refresh the variation cache
                    wc_delete_product_transients($variation_id);
                }
                // Clear/refresh the variable product cache
                wc_delete_product_transients($post->ID);
            }
        }
    }
}
//FUNCTION TO GET UPDATED PRICE AFTER CONVERSION AND ADDING FACTOR
function formula_function($price)
{
    if ($price == null) {
        return 1;
    }
    $pound_rate = $_POST['rate'];
    $price_in_pkr = $pound_rate * ($price+3);
    if ($price >= 501) {
        $price_in_pkr = $price_in_pkr + $price_in_pkr * 0.25;
    } else if ($price >= 301) {
        $price_in_pkr = $price_in_pkr + $price_in_pkr * 0.3;
    } else if ($price >= 101) {
        $price_in_pkr = $price_in_pkr + $price_in_pkr * 0.35;
    } else if ($price >= 41) {
        $price_in_pkr = $price_in_pkr +  $price_in_pkr * 0.4;
    } else if ($price >= 21) {
        $price_in_pkr = $price_in_pkr +  $price_in_pkr * 0.45;
    } else if ($price >= 11) {
        $price_in_pkr = $price_in_pkr +  $price_in_pkr * 0.5;
    } else if ($price >= 6) {
        $price_in_pkr = $price_in_pkr +  $price_in_pkr * 0.6;
    } else if ($price <= 5) {
        $price_in_pkr = $price_in_pkr +  $price_in_pkr * 0.8;
    }
    //ROUNDING OFF TO NEAREST 100
    $intVal = $price_in_pkr%100;
    if ($intVal < 50) {
        $result = floor($price_in_pkr / 100) * 100;
    } else {
        $result = ceil($price_in_pkr / 100) * 100;
    }
    //RETURNING THE RESULT
    return $result;
}