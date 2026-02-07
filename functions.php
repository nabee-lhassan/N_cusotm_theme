<?php
function mytheme_assets() {

    /* =======================
       Theme CSS
    ======================= */
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('basic-css', get_template_directory_uri() . '/assets/css/basic.css');
    wp_enqueue_style('mega-menu-css', get_template_directory_uri() . '/assets/css/mega_menu.css');
    wp_enqueue_style('product-css', get_template_directory_uri() . '/assets/css/product.css');
    wp_enqueue_style('category-css', get_template_directory_uri() . '/assets/css/category.css');

    /* =======================
       Bootstrap
    ======================= */
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
    );

    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [],
        null,
        true
    );

      /* =======================
           Swiper CSS
       ======================= */
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        null
    );

    /* =======================
           Swiper JS
       ======================= */
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        null,
        true
    );

    /* =======================
       Dashicons (Frontend)
    ======================= */
    wp_enqueue_style('dashicons');

    /* =======================
       Custom JS (DEPENDENCY FIX)
    ======================= */
    wp_enqueue_script(
        'custom-js',
        get_template_directory_uri() . '/assets/js/main.js',
        ['swiper-js'], // 👈 VERY IMPORTANT
        false,
        true
    );
}
add_action('wp_enqueue_scripts', 'mytheme_assets');


/* =======================
   Theme Supports
======================= */
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');



// Custom Logo Support - OPTIONAL (can be used via ACF or customizer)



function mytheme_custom_logo_setup() {
    add_theme_support('custom-logo', [
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}
add_action('after_setup_theme', 'mytheme_custom_logo_setup');



/* =======================
   Menus
======================= */
register_nav_menus([
    'main-menu'      => __('Main Menu'),
    'footer_menu_1'  => __('Footer Menu 1'),
    'footer_menu_2'  => __('Footer Menu 2'),
]);

/* =======================
   Includes
======================= */
require get_template_directory() . '/inc/walkers/class-my-custom-walker.php';

// CPTs
require get_template_directory() . '/inc/CPT/cpt-products.php';
// require get_template_directory() . '/inc/CPT/cpt-products.draft.php';
require get_template_directory() . '/inc/CPT/taxonomies.php';
require get_template_directory() . '/inc/CPT/taxonomy-category-icon.php';





require get_template_directory() . '/inc/allowFiles.php';



