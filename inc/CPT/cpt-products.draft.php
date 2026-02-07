<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function register_product_cpt() {
    $labels = array(
        'name' => 'Products',
        'singular_name' => 'Product',
        'add_new_item' => 'Add New Product',
        'edit_item' => 'Edit Product',
        'all_items' => 'All Products',
        'menu_name' => 'Products',
    );

    $args = array(
        'label' => 'Products',
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-products',
        'supports' => array('title','editor','thumbnail','custom-fields'),
        'rewrite' => array('slug' => 'products'),
    );

    register_post_type('product', $args);
}
add_action('init', 'register_product_cpt');
