<?php
/* 
Template Name: Custom Home 
*/
?>
<?php get_header(); ?>

<section class="bg-blue-50 py-20 ">
  <div class="max-w-5xl mx-auto px-5 mt-20 text-center">

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
     'parent'     => 0,   // ⭐ ONLY parent terms
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
<?php if($icon_id): ?>
<img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($cat->name); ?>">
<?php endif; ?>
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />

<?php
$categories_slide = get_terms([
    'taxonomy'   => 'supplier_category',
    'hide_empty' => false,
    'parent'     => 0,
    'order'      => 'ASC',
]);

if(!empty($categories_slide) && !is_wp_error($categories_slide)):
?>

<div class="swiper supplierCatSlider" style="height:400px;">
  <div class="swiper-wrapper">

    <?php foreach($categories_slide as $cat):
        $bg_id  = get_term_meta($cat->term_id, 'category_bg_id', true);
        $bg_url = $bg_id ? wp_get_attachment_url($bg_id) : '';
    ?>
    
    <?php if($bg_url): ?>
      <div class="swiper-slide">
        <a href="<?php echo esc_url(get_term_link($cat)); ?>" 
           class="slide-inner"
           style="background-image: url('<?php echo esc_url($bg_url); ?>');">

            <div class="text-wrapper">
                <h3><?php echo esc_html($cat->name); ?></h3>
                <span>+<?php echo esc_html($cat->count); ?> products</span>
            </div>

        </a>
      </div>
    <?php endif; ?>

    <?php endforeach; ?>
  </div>

  <!-- <div class="swiper-pagination"></div> -->
</div>

<?php endif; ?>

<style>
.supplierCatSlider {
  width: 95%;
  margin: 40px auto;
}

.supplierCatSlider .swiper-slide {
  border-radius: 20px;
  overflow: hidden;
}

.supplierCatSlider .slide-inner {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  border-radius: 20px;
}

/* Dark overlay */
.supplierCatSlider .slide-inner::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.1));
  border-radius: 20px;
}

/* Text bottom-left */
.supplierCatSlider .text-wrapper {
position: absolute;
  bottom: 30px;  /* thoda upar shift karke balance */
  left: 40px;    /* left spacing badhaya */
  color: #fff;
  z-index: 2;
}

.supplierCatSlider h3 {
  margin: 0;
  font-size: 22px;
  font-weight: 600;
}

.supplierCatSlider span {
  font-size: 14px;
  opacity: 0.9;
}
</style>

  <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>


<!-- JS -->
<script>
var swiper = new Swiper(".supplierCatSlider", {
  slidesPerView: 4,       // 1 line me 4 slides desktop
  spaceBetween: 30,       // slide ke beech gap
  loop: true,             // infinite loop
  autoplay: {
    delay: 2500,          // auto slide delay
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {          // responsive
    320: { slidesPerView: 1, spaceBetween: 10 },
    640: { slidesPerView: 2, spaceBetween: 20 },
    768: { slidesPerView: 3, spaceBetween: 20 },
    1024: { slidesPerView: 4, spaceBetween: 30 },
  }
});
</script>


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
     'parent'     => 0,   // ⭐ ONLY parent terms
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



<div x-data="{ tab: 'buyers' }" class="max-w-7xl mx-auto px-4 py-12">
  
  <!-- Tabs -->
  <div class="flex border-b border-gray-200 mb-6">
    <button 
      @click="tab = 'buyers'"
      :class="tab === 'buyers' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600'"
      class="flex items-center px-4 py-2 border-b-2 font-medium text-sm mr-4 transition-colors duration-200">
      <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H4z"/>
      </svg>
      For buyers
    </button>

    <button 
      @click="tab = 'suppliers'"
      :class="tab === 'suppliers' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600'"
      class="flex items-center px-4 py-2 border-b-2 font-medium text-sm transition-colors duration-200">
      <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4z"/>
      </svg>
      For suppliers
    </button>
  </div>

  <!-- Tab Content -->
  <div class="grid md:grid-cols-2 gap-8 items-center">

  <?php 
$Site_url_main = get_site_url();
$Site_url_home = $Site_url_main . '/wp-content/uploads/2026/02/';

?>


    <!-- Buyers Tab -->
    <div x-show="tab === 'buyers'" class="transition duration-300">
      <img src="<?php echo esc_url($Site_url_home); ?>image-15-2.jpg" alt="Buyers Image" class="rounded-lg shadow-lg w-full">
    </div>

    <div x-show="tab === 'buyers'" class="transition duration-300">
      <h2 class="text-3xl font-semibold mb-4">Simplify your sourcing</h2>
      <p class="text-gray-600 mb-6">
        Gain free access to the web’s original wholesale marketplace and start sourcing from America’s top wholesalers all in one place
      </p>
      <a href="<?php echo esc_url(home_url('/#')); ?>"
         class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
        Create your free account →
      </a>
    </div>

    <!-- Suppliers Tab -->

    <div x-show="tab === 'suppliers'" class="transition duration-300">
      <img src="<?php echo esc_url($Site_url_home); ?>image-16.jpg" alt="Suppliers Image" class="rounded-lg shadow-lg w-full">
    </div>

    <div x-show="tab === 'suppliers'" class="transition duration-300">
      <h2 class="text-3xl font-semibold mb-4">Grow your wholesale business</h2>
      <p class="text-gray-600 mb-6">
        Connect with verified buyers and expand your reach to the most trusted wholesale marketplace
      </p>
      <a href="<?php echo esc_url(home_url('/apply')); ?>"
         class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
        Start selling today →
      </a>
    </div>

  </div>

</div>

<!-- Alpine.js CDN -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>















<?php get_footer(); ?>
