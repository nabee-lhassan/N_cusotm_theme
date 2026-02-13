<?php
if (!defined('ABSPATH')) exit;

// ---- 1. Register Supplier CPT ----
function register_supplier_cpt() {
    $labels = array(
        'name' => 'Products',
        'singular_name' => 'Supplier',
        'add_new_item' => 'Add New Supplier',
        'edit_item' => 'Edit Supplier',
        'all_items' => 'All Products',
        'menu_name' => 'Products',
    );

    $args = array(
        'label' => 'Products',
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-store',
        'supports' => array('title','editor','thumbnail','custom-fields'),
        'rewrite' => array('slug' => 'Products'),
    );

    register_post_type('supplier', $args);
}
add_action('init', 'register_supplier_cpt');

// ---- 2. Add Supplier Meta Boxes ----
function supplier_add_meta_boxes() {
    add_meta_box(
        'supplier_details',
        'Supplier Details',
        'supplier_meta_box_html',
        'supplier',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'supplier_add_meta_boxes');

function supplier_meta_box_html($post) {
    $logo = get_post_meta($post->ID, 'logo', true);
    $website = get_post_meta($post->ID, 'website', true);
    $location = get_post_meta($post->ID, 'location', true);
    $contact_details = get_post_meta($post->ID, 'contact_details', true);

    ?>
    <p>
        <label>Website: </label>
        <input type="text" name="supplier_website" value="<?php echo esc_attr($website); ?>" class="widefat">
    </p>
    <p>
        <label>Location: </label>
        <input type="text" name="supplier_location" value="<?php echo esc_attr($location); ?>" class="widefat">
    </p>
    <p>
        <label>Logo (Attachment ID): </label>
        <input type="number" name="supplier_logo" value="<?php echo esc_attr($logo); ?>" class="widefat">
    </p>
    <p>
        <label>Contact Details: </label>
        <input type="text" name="supplier_contact_details" value="<?php echo esc_attr($contact_details); ?>" class="widefat">
    </p>
    <?php
}

// ---- 3. Save Meta ----
function supplier_save_meta($post_id) {
    if (isset($_POST['supplier_website'])) {
        update_post_meta($post_id, 'website', sanitize_text_field($_POST['supplier_website']));
    }
    if (isset($_POST['supplier_location'])) {
        update_post_meta($post_id, 'location', sanitize_text_field($_POST['supplier_location']));
    }
    if (isset($_POST['supplier_logo'])) {
        update_post_meta($post_id, 'logo', intval($_POST['supplier_logo']));
    }
    if (isset($_POST['supplier_contact_details'])) {
        update_post_meta($post_id, 'contact_details', sanitize_text_field($_POST['supplier_contact_details']));
    }
}
add_action('save_post', 'supplier_save_meta');
