<?php

//HOOK FOR CUSTOM FIELDS IN PRODUCT DESCRIPTION(SIMPLE PRODUCT)
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save', 10, 4);

//HOOK TO SAVE CUSTOM FIELDS IN PRODUCT DESCRIPTION(VARIABLE PRODUCT)
add_action('woocommerce_save_product_variation', 'woocommerce_save_custom_field_variations', 10, 2);

//FUNCTION TO SAVE VALUES OF CUSTOM FIELDS(SIMPLE PRODUCT)
function woocommerce_product_custom_fields_save($post_id)
{
    //SAVING ORIGINAL REGULAR PRICE
    $woocommerce_custom_product_original_regular_price = $_POST['_original_regular_price'];
    if (!empty($woocommerce_custom_product_original_regular_price))
        update_post_meta($post_id, '_original_regular_price', esc_attr($woocommerce_custom_product_original_regular_price));
    //SAVING ORIGINAL SALE PRICE 
    $woocommerce_custom_product_original_sale_price = $_POST['_original_sale_price'];
    if (!empty($woocommerce_custom_product_original_sale_price))
        update_post_meta($post_id, '_original_sale_price', esc_attr($woocommerce_custom_product_original_sale_price));
}

//FUNCTION TO SAVE VALUES OF CUSTOM FIELDS(VARIABLE PRODUCT)
function woocommerce_save_custom_field_variations($variation_id, $i)
{
    //SAVING ORIGINAL REGULAR PRICE
    $save_original_regular_price = $_POST['_original_regular_price'][$i];
    if (isset($save_original_regular_price)) update_post_meta($variation_id, '_original_regular_price', esc_attr($save_original_regular_price));
    //SAVING ORIGINAL SALE PRICE
    $save_original_sale_price = $_POST['_original_sale_price'][$i];
    if (isset($save_original_sale_price)) update_post_meta($variation_id, '_original_sale_price', esc_attr($save_original_sale_price));
}