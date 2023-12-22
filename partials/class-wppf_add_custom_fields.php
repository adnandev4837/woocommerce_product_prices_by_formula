<?php
//HOOK FOR CUSTOM FIELDS IN PRODUCT DESCRIPTION(SIMPLE PRODUCT)
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
//HOOK FOR CUSTOM FIELDS IN PRODUCT DESCRIPTION(VARIABLE PRODUCT)
add_action('woocommerce_variation_options_pricing', 'woocommerce_add_custom_field_to_variations', 10, 4);

//FUNCTION TO DISPLAY CUSTOM FIELDS IN PRODUCT DESCRIPTION(SIMPLE PRODUCT)
function woocommerce_product_custom_fields()
{
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    woocommerce_wp_text_input(
        array(
            'id' => '_original_regular_price',
            'placeholder' => 'original Regular Price',
            'label' => __('Price in Pounds(GBP)', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_original_sale_price',
            'placeholder' => 'original Sale Price',
            'label' => __('Sale Price in Pounds(GBP)', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    echo '</div>';
}
//FUNCTION TO DISPLAY CUSTOM FIELDS IN PRODUCT DESCRIPTION(SIMPLE PRODUCT)
function woocommerce_add_custom_field_to_variations($loop, $variation_data, $variation)
{
    echo '<div class="form-field variable_regular_price_0_field form-row form-row-first">';
    woocommerce_wp_text_input(array(
        'id' => ' _original_regular_price[' . $loop . ']',
        'class' => 'short',
        'label' => __('Price in Pounds(GBP)', 'woocommerce'),
        'value' => get_post_meta($variation->ID, '_original_regular_price', true)
    ));
    echo '</div>';
    echo '<div class="form-field variable_regular_price_0_field form-row form-row-last">';
    woocommerce_wp_text_input(array(
        'id' => '_original_sale_price[' . $loop . ']',
        'class' => 'short',
        'label' => __('Sale Price in Pounds(GBP)', 'woocommerce'),
        'value' => get_post_meta($variation->ID, '_original_sale_price', true)
    ));
    echo '</div>';
}