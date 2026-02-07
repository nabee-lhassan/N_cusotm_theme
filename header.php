<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
            });
        });
    </script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js"></script>
</head>
<body <?php body_class(); ?>>

<header class="bg-white shadow-md fixed w-full z-50">
    <div class="max-w-6xl mx-auto px-6 md:px-20 flex justify-between items-center h-20">
        


 
        <!-- Logo -->
<div class="site-logo">
    <?php 
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        ?>
        <a href="<?php echo home_url(); ?>" class="text-2xl font-bold text-blue-600">
            <?php bloginfo('name'); ?>
        </a>
        <?php
    }
    ?>
</div>

        <?php
        $parent_categories = get_terms([
            'taxonomy'   => 'supplier_category',
            'hide_empty' => false,
            'parent'     => 0,
            'order'      => 'ASC',
        ]);

        if (!empty($parent_categories) && !is_wp_error($parent_categories)):
        ?>
        <!-- Mega Menu -->
        <nav class="products-nav">
            <ul class="main-menu">
                <li class="group">
                    <a href="#" id="products-toggle">Categories</a>

                    <div class="mega-menu">
                        <div class="my-container">
                            <div class="mega-wrapper flex w-full">

                                <!-- Parent Categories Column -->
                                <ul class="parent-column">
                                    <?php foreach ($parent_categories as $parent):
                                        $icon_id  = get_term_meta($parent->term_id, 'category_icon_id', true);
                                        $icon_url = $icon_id ? wp_get_attachment_url($icon_id) : '';
                                    ?>
                                    <li class="parent-column-first-child" data-id="<?php echo $parent->term_id ?>">
                                        <?php if ($icon_url): ?>
                                            <img src="<?php echo esc_url($icon_url); ?>" 
                                                 alt="<?php echo esc_attr($parent->name); ?>" 
                                                 class="parent-icon">
                                        <?php endif; ?>

                                        <a href="<?php echo $parent->count == 0 ? esc_url(get_term_link($parent)) : 'javascript:void(0);'; ?>" 
                                           onclick="<?php if ($parent->count > 0) echo 'openSub(' . $parent->term_id . ')'; ?>">
                                            <?php echo esc_html($parent->name); ?>

                                            <?php if ($parent->count > 0): ?>
                                                <?php 
                                                $submenu_icon_id = 37; // change as needed
                                                $submenu_icon_url = wp_get_attachment_url($submenu_icon_id); 
                                                ?>
                                                <img src="<?php echo esc_url($submenu_icon_url); ?>" class="submenu_icon">
                                            <?php endif; ?>
                                        </a>

                                        <!-- Child Categories Column -->
                                        <ul class="child-column">
                                            <?php
                                            $child_terms = get_terms([
                                                'taxonomy'   => 'supplier_category',
                                                'hide_empty' => false,
                                                'parent'     => $parent->term_id,
                                                'order'      => 'ASC',
                                            ]);

                                            if (!empty($child_terms) && !is_wp_error($child_terms)):
                                                foreach ($child_terms as $term):
                                                    $term_link = get_term_link($term);
                                                    $image_id  = get_term_meta($term->term_id, 'category_image', true);
                                                    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';
                                                    $supplier_count = $term->count;
                                            ?>
                                            <li class="mega-column-group">
                                                <ul class="mega-menu-columns">
                                                    <li class="mega-column flex justify-center items-center gap-2">
                                                        <a href="<?php echo esc_url($term_link); ?>" class="flex items-center gap-2 text-black">
                                                            <?php if ($image_url): ?>
                                                                <img src="<?php echo esc_url($image_url); ?>" 
                                                                     alt="<?php echo esc_attr($term->name); ?>" 
                                                                     class="w-12 h-12 rounded-lg object-cover">
                                                            <?php endif; ?>
                                                            <div>
                                                                <h5 class="mega-sub-title"><?php echo esc_html($term->name); ?></h5>
                                                                <p><?php echo esc_html($supplier_count); ?> Products</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php endforeach; endif; ?>
                                        </ul>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <script>
            function openSub(parentId) {
                alert('Opening subcategories for ID: ' + parentId);
            }

            document.addEventListener("DOMContentLoaded", function() {
                const toggle = document.getElementById("products-toggle");
                const megaMenu = document.querySelector(".mega-menu");

                toggle.addEventListener("click", function(e) {
                    e.preventDefault();
                    megaMenu.classList.toggle("active");
                });

                megaMenu.addEventListener("click", function(e) {
                    e.stopPropagation();
                });

                document.addEventListener("click", function(e) {
                    if (e.target !== toggle) {
                        megaMenu.classList.remove("active");
                    }
                });
            });
        </script>
        <?php endif; ?>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center gap-8">
            <?php
            wp_nav_menu([
                'theme_location' => 'main-menu',
                'walker' => new My_Mega_Menu_Walker(),
                'menu_class' => 'flex gap-8',
            ]);
            ?>
        </nav>

    </div>
</header>

<style>
    /* -------------------------------
   Mega Menu Wrapper
---------------------------------*/

header .site-logo img {
    width: 200px;
}

.my-container{
    
    /* margin: 0 auto; */
    width: 100%;
}

.products-nav .mega-menu {
    position: fixed;
    top: 14%;
    left: 0;
    width: 100vw;
    background: #fff;
    box-shadow: 0 10px 15px rgba(0,0,0,0.2);
    display: none; /* Hidden by default */
    z-index: 9999;
}

/* Show mega menu when active */
.products-nav .mega-menu.active {
    display: flex;
}

/* Flex wrapper for parent and child columns */
.products-nav .mega-wrapper {
    display: flex;
    width: 100%;
}

/* -------------------------------
   Parent Column (Main Menu)
   Left side - 30% width
---------------------------------*/
.products-nav .parent-column {
    width: 30%;
    border-right: 1px solid #ddd;
    height: 50vh;
    overflow-y: auto;
    /* padding: 10px; */
    list-style: none;
}

.products-nav .parent-column li {
    display: flex;
    /* align-items: center; */
    gap: 8px;
    padding: 13px 10px;
    cursor: pointer;
    border-top: 1px solid #dcdcdc;
}

.products-nav .parent-column a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-decoration: none;
    color: #000;
    width: 100%;
    width: 100%;
}

.products-nav .parent-icon {
    width: 18px;
    height: 18px;
    object-fit: cover;
    border-radius: 4px;
}

/* Submenu icon next to parent with children */
.products-nav .submenu_icon {
    width: 18px;
    height: 18px;
    object-fit: cover;
    border-radius: 4px;
}

/* -------------------------------
   Child Column (Sub Menu)
   Right side - 70% width
---------------------------------*/
.products-nav .child-column {
    width: 70%;
    /* height: 100%; */
    max-height: 50vh;
    overflow-y: auto;
    padding: 13px 53px;
    display: none;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
    position: fixed;
    top: 18%;
    left: 25rem;
    /* background-color: black; */
    
}

.parent-column-first-child:hover .child-column {
    display: flex !important;
}

.products-nav .child-colu {
    width: 70%;
    padding: 10px 20px;
    display: none;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}

.hiden {
    display: none;
}

.show {
    display: flex;
} 

/* Individual sub-category box */
.products-nav .mega-column {
    width: 23%;
    padding: 10px;
    box-sizing: border-box;
    text-align: center;
}

.products-nav .mega-column img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    margin: 0 auto 10px;
    border-radius: 8px;
}

.products-nav .mega-column a {
    color: #2563eb;
    font-size: 14px;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.products-nav .mega-column a:hover {
    text-decoration: underline;
}

.mega-sub-title {
    font-weight: bold;
    font-size: 14px;
    text-align: center;
    margin-bottom: 6px;
    color: black;
}

/* -------------------------------
   Responsive
---------------------------------*/
@media (max-width: 992px){
    .products-nav .mega-wrapper {
        flex-direction: column;
    }
    .parent-column, .child-column {
        width: 100%;
        border: none;
    }
    .mega-column {
        width: 48%;
    }
}

@media (max-width: 480px){
    .mega-column {
        width: 100%;
    }
}

</style>
