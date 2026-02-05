<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function register_supplier_taxonomies() {
    // Example: Category
    register_taxonomy(
        'supplier_category',
        'supplier',
        array(
            'label' => 'Supplier Categories',
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'supplier-category')
        )
    );
}
add_action('init', 'register_supplier_taxonomies');
