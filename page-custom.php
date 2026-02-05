<?php
/* 
Template Name: Custom Home 
*/
?>
<?php get_header(); ?>

<section class="bg-blue-50 py-20">
  <div class="max-w-5xl mx-auto px-5 text-center">

    <!-- Small heading -->
    <p class="text-sm text-gray-700 mb-4">US America's wholesale hub since 1997</p>

    <!-- Main heading -->
    <h1 class="text-3xl sm:text-4xl text-[3.5rem] leading-tight text-gray-900 mb-8 flex flex-wrap justify-center items-center gap-2">
      Connect 
      <?php 
      $person1_id = 9; // yahan apna image attachment ID dalen
      $person1_url = wp_get_attachment_url($person1_id); 
      ?>
      <img src="<?php echo esc_url($person1_url); ?>" alt="person1" class="w-12 h-12 rounded-full inline-block">

      with top wholesale suppliers & find products 
      <?php 
      $person2_id = 10; // yahan apna image attachment ID dalen
      $person2_url = wp_get_attachment_url($person2_id); 
      ?>
      <img src="<?php echo esc_url($person2_url); ?>" alt="person2" class="w-20 h-12 rounded-full inline-block">
      that sell
    </h1>

    <!-- Search bar -->
    <div class="mt-6 flex justify-center">
      <form class="flex w-full max-w-2xl border border-gray-300 rounded-lg overflow-hidden shadow-sm">
        <input type="text" placeholder="Search for skincare" class="flex-1 px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 rounded-l-lg">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-r-lg hover:bg-blue-700 transition-colors">Search</button>
      </form>
    </div>

  </div>
</section>



<?php
$categories = get_terms([
    'taxonomy'   => 'supplier_category',
    'hide_empty' => false,
    'order'      => 'ASC',
]);

if(!empty($categories) && !is_wp_error($categories)):
?>

<section class="supplier-category-slider-section">

<?php if(!empty($categories)): ?>

<div class="swiper myCategorySwiper">
<div class="swiper-wrapper">

<?php foreach($categories as $cat):

    $icon_id  = get_term_meta($cat->term_id, 'category_icon_id', true);
    $icon_url = $icon_id ? wp_get_attachment_url($icon_id) : '';

?>

<div class="swiper-slide">
<div class="category-card-grid">
<a href="<?php echo esc_url(get_term_link($cat)); ?>">

<?php if($icon_url): ?>
<img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($cat->name); ?>">
<?php endif; ?>

<div class="text-wrapper">
<h3><?php echo esc_html($cat->name); ?></h3>
<span>+<?php echo esc_html($cat->count); ?> products</span>
</div>

</a>
</div>
</div>

<?php endforeach; ?>

</div>

<!-- Navigation -->
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>

</div>

<?php else: ?>
<div class="no-categories">No categories found!</div>
<?php endif; ?>

</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        new Swiper(".supplier-category-slider-section .myCategorySwiper", {
            loop: true, // loop must be true for continuous scroll
            slidesPerView: 5,
            spaceBetween: 20,
            speed: 5000, // jitna bada speed utna slow aur smooth scroll
            autoplay: {
                delay: 0, // no delay between slides
                disableOnInteraction: false, // user interaction won't stop it
            },
            allowTouchMove: false, // optional: agar swipe disable karni ho
            breakpoints: {
                320: { slidesPerView: 1 },
                480: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 5 }
            }
        });
    }
});
</script>


<?php endif; ?>









<?php
$categories = get_terms([
    'taxonomy'   => 'supplier_category',
    'hide_empty' => false,
    'order'      => 'ASC',
]);

if(!empty($categories) && !is_wp_error($categories)):
?>


<section class="supplier-category-grid-section-heading">
    <div class="container">
        <div class="heading-wrapper">
            <p>Wholesale Products Across 120+ Categories for Every Type of Reseller</p>
        </div>
    </div>
</section>


<section class="supplier-category-grid-section">
    <div class="categories-wrapper">
        <?php foreach($categories as $cat):
            $icon_id  = get_term_meta($cat->term_id, 'category_icon_id', true);
            $icon_url = $icon_id ? wp_get_attachment_url($icon_id) : '';
        ?>
        <div class="category-card-grid">
            <a href="<?php echo esc_url(get_term_link($cat)); ?>">
                <?php if($icon_url): ?>
                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($cat->name); ?>">
                <?php endif; ?>

                <div class="text-wrapper">
                    <h3><?php echo esc_html($cat->name); ?></h3>
                    <span>+<?php echo esc_html($cat->count); ?> products</span>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php endif; ?>





<?php
// Get all suppliers
$suppliers = get_posts([
    'post_type' => 'supplier',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
]);

if($suppliers){
    echo '<div class="suppliers-wrapper grid grid-cols-3 gap-6">';

    foreach($suppliers as $supplier){
        $supplier_id = $supplier->ID;

        // --- Logo ---
        $logo_id = get_post_meta($supplier_id, 'logo', true);
        $logo_url = $logo_id ? wp_get_attachment_url($logo_id) : 'https://via.placeholder.com/150';

        // --- Website ---
        $website = get_post_meta($supplier_id, 'website', true);

        // --- Location ---
        $location = get_post_meta($supplier_id, 'location', true);

        // --- Featured Products ---
        $featured_products = get_post_meta($supplier_id, 'featured_products', true); // returns array

        echo '<div class="supplier-card border p-4 rounded">';
        
        // Logo
        echo '<img src="'.esc_url($logo_url).'" alt="'.esc_html($supplier->post_title).' Logo" class="w-32 h-auto mb-2">';

        // Title + website
        echo '<h3 class="font-bold text-lg">'.esc_html($supplier->post_title).'</h3>';
        if($website){
            echo '<a href="'.esc_url($website).'" target="_blank" class="text-blue-600 text-sm block mb-1">'.esc_html($website).'</a>';
        }

        // Location
        if($location){
            echo '<p class="text-sm text-gray-500 mb-2">'.esc_html($location).'</p>';
        }

        // Featured Products
        if($featured_products){
            echo '<ul class="featured-products list-disc list-inside">';
            foreach($featured_products as $product_id){
                $product = get_post($product_id);
                if($product){
                    echo '<li><a href="'.get_permalink($product_id).'" class="text-blue-500 hover:underline">'.esc_html($product->post_title).'</a></li>';
                }
            }
            echo '</ul>';
        }

        echo '</div>'; // supplier-card
    }

    echo '</div>'; // suppliers-wrapper
}
?>









<?php get_footer(); ?>
