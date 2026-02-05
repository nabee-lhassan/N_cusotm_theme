<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>

<!-- Tailwind -->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js"></script>


</head>
<body <?php body_class(); ?>>


<header class="bg-white shadow-md fixed w-full z-50">
   <div class="max-w-6xl mx-auto px-6 md:px-20 flex justify-between items-center h-20">

    <!-- Logo -->
    <a href="<?php echo home_url(); ?>" class="text-2xl font-bold text-blue-600">
        MySite
    </a>

<?php
$parent_categories = get_terms([
    'taxonomy'   => 'supplier_category',
    'hide_empty' => false,
    'parent'     => 0,
    'order'      => 'ASC',
]);

if (!empty($parent_categories) && !is_wp_error($parent_categories)):
?>
<nav class="suppliers-nav">
    <ul class="main-menu">
        <li class="group">
            <a href="#" id="suppliers-toggle">Categories</a>

            <!-- Mega Menu Start -->
            <div class="mega-menu">
                <div class="container">
                    <div class="mega-wrapper">

                        <!-- Parent Categories Column -->
                       <ul class="parent-column">
    <?php foreach ($parent_categories as $parent) : 
        // Parent category icon ID fetch karo
        $icon_id  = get_term_meta($parent->term_id, 'category_icon_id', true);
    $icon_url = $icon_id ? wp_get_attachment_url($icon_id) : '';
    ?>
        <li class="border-t border-gray-300">
            <?php if ($icon_url): ?>
                <img src="<?php echo esc_url($icon_url); ?>" 
                     alt="<?php echo esc_attr($parent->name); ?>" 
                     class="parent-icon">
            <?php endif; ?>
            <a href="<?php echo esc_url(get_term_link($parent)); ?>">

       
                <?php echo esc_html($parent->name); ?>
                <?php if ($parent->count > 0): ?>
                         <?php 
      $submenu_icon_id = 37; // yahan apna image attachment ID dalen
      $submenu_icon_url = wp_get_attachment_url($submenu_icon_id); 
      ?>
      <img src="<?php echo esc_url($submenu_icon_url); ?>" alt="submenu_icon_url" class="submenu_icon">
<?php echo esc_html($parent->count); ?> 

                   
                <?php endif ?>
                    
                
            </a>
        </li>
    <?php endforeach; ?>
</ul>


                        <!-- Child Categories Column -->
    <ul class="child-column">
    <?php foreach ($parent_categories as $parent) :

        // Get posts under this parent category
        $child_posts = get_posts([
            'post_type'      => 'supplier', 
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
            'tax_query'      => [
                [
                    'taxonomy' => 'supplier_category', // your taxonomy
                    'field'    => 'term_id',
                    'terms'    => $parent->term_id,
                    'include_children' => true, // includes posts in child categories if any
                ]
            ],
        ]);

         $post_count = count($child_posts);

        if (!empty($child_posts)) :
    ?>
        <li class="mega-column-group">

            <h4 class="mega-title">
                <?php echo esc_html($parent->name); ?>
            </h4>

            <ul class="mega-menu-columns">
                <?php foreach ($child_posts as $post) : setup_postdata($post); 
                    // $image_id  = get_post_meta($post->ID, 'category_image', true); // if saved as post meta
                    // $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

                        $image_url = get_the_post_thumbnail_url($post->ID, 'full'); // 'full' ya 'medium', 'thumbnail'


                ?>

                
                    <li class="mega-column" style="display: flex; justify-content: center; align-items: center;gap: 10px;">

                        <a href="<?php echo esc_url(get_permalink($post)); ?>">
                        
                        <?php if ($image_url) : ?>
                            <img style="width: 50px; height:50px; border-radius: 10px; object-fit: cover;" src="<?php echo esc_url($image_url); ?>" 
                                 alt="<?php echo esc_attr(get_the_title($post)); ?>">
                        <?php endif; ?>

                        <div>
                            <h5 class="mega-sub-title">
                            <?php echo esc_html(get_the_title($post)); ?>
                        </h5>

                                <p><?php echo esc_html($post_count); ?> Suppliers</p>
                        </a>

                        </div>

                        

                    </li>

                <?php endforeach; wp_reset_postdata(); ?>
            </ul>

        </li>

    <?php 
        endif;
    endforeach; 
    ?>
</ul>



                    </div>
                </div>
            </div>
            <!-- Mega Menu End -->

        </li>
    </ul>
</nav>
<?php
endif;
?>

<style>

/* Navigation */
.suppliers-nav {
    position: relative;
}

.suppliers-nav .parent-column li {
    display: flex;
    align-items: center;
    gap: 8px; /* Icon aur text ke beech space */
    padding: 8px 10px;
}

.suppliers-nav .parent-column li a{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.suppliers-nav .parent-icon {
    width: 14px;
    height: 14px;
    object-fit: cover;
    display: inline-block;
    color: gray;
    border-radius: 4px; /* agar chahen to rounded */
}
.suppliers-nav .submenu_icon {
    width: 18px;
    height: 18px;
    object-fit: cover;
    display: inline-block;
    border-radius: 4px; /* agar chahen to rounded */
}


/* Main Menu */
.suppliers-nav .main-menu {
    list-style: none;
    margin: 0;
    padding: 0;
}

.suppliers-nav .main-menu li {
    position: relative;
}

/* Toggle Link */
.suppliers-nav #suppliers-toggle {
    font-weight: bold;
    color: #000;
    text-decoration: none;
    padding: 10px;
    display: inline-block;
}

/* Mega Menu Wrapper */
.suppliers-nav .mega-menu {
    position: fixed;
    top: 14%;
    left: 0;
    width: 100vw;
    background: #ffffff;
    box-shadow: 0 10px 15px rgba(0,0,0,0.2);
    z-index: 9999;
    display: none;
}

/* Active State (For Click) */
.suppliers-nav .mega-menu.active {
    display: block;
}

/* Layout Wrapper */
.suppliers-nav .mega-wrapper {
    display: flex;
    width: 100%;
}

/* Parent Column */
.suppliers-nav .parent-column {
    width: 30%;
    list-style: none;
    padding: 10px;
    border-right: 1px solid #ddd;
}

.suppliers-nav .parent-column li {
    padding: 8px 10px;
}

.suppliers-nav .parent-column a {
    color: #000;
    text-decoration: none;
    font-weight: 400;
    display: block;
}

/* Child Column */
.suppliers-nav .child-column {
    width: 70%;
    list-style: none;
    padding: 10px 20px;
}

/* Child Grid */
.suppliers-nav .mega-menu-columns {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
    padding: 0;
}

/* Individual Column */
.suppliers-nav .mega-column {
    width: 23%;
    padding: 10px;
    box-sizing: border-box;
    text-align: center;
}

/* Images */
.suppliers-nav .mega-column img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    display: block;
    margin: 0 auto 10px;
}

/* Titles */
.suppliers-nav .mega-title {
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 18px;
}

.suppliers-nav .mega-sub-title {
    font-weight: bold;
    margin-bottom: 6px;
    font-size: 14px;
    color: black;
    text-decoration: none;
    text-align: left;
}

/* Links */
.suppliers-nav .mega-column a {
    color: #2563eb;
    font-size: 14px;
    text-decoration: none;
}

.suppliers-nav .mega-column a:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 992px) {
    .suppliers-nav .mega-wrapper {
        flex-direction: column;
    }

    .parent-column,
    .suppliers-nav .child-column {
        width: 100%;
        border: none;
    }

    .suppliers-nav .mega-column {
        width: 48%;
    }
}

@media (max-width: 480px) {
    .suppliers-nav .mega-column {
        width: 100%;
    }
}

</style>


<script>

document.addEventListener("DOMContentLoaded", function() {

    const toggle = document.getElementById("suppliers-toggle");
    const megaMenu = document.querySelector(".mega-menu");

    // Open on Click
    toggle.addEventListener("click", function(e) {
        e.preventDefault();
        megaMenu.classList.toggle("active");
    });

    // Prevent closing when clicking inside mega menu
    megaMenu.addEventListener("click", function(e) {
        e.stopPropagation();
    });

    // Close when clicking anywhere outside
    document.addEventListener("click", function(e) {
        if (e.target !== toggle) {
            megaMenu.classList.remove("active");
        }
    });

});

</script>

    <!-- Desktop Menu -->
    <nav class="hidden md:flex items-center space-x-8">
        <?php
        // wp_nav_menu([
        //     'theme_location' => 'main-menu',
        //     'container' => false,
        //     'menu_class' => 'flex space-x-8',
        //     'fallback_cb' => false,
        //     'depth' => 1,
        // ]);


//         wp_nav_menu([
//     'theme_location' => 'main-menu',
//     'container'      => false,
//     'menu_class'     => 'flex space-x-8',
//     'fallback_cb'    => false,
//     'walker'         => new My_Mega_Menu_Walker(),
// ]);

        wp_nav_menu([
    'theme_location' => 'main-menu',
    'walker' => new My_Mega_Menu_Walker(),
    'menu_class' => 'flex gap-8',
]);



        ?>
    </nav>

   

   

</div>






</header>
 

