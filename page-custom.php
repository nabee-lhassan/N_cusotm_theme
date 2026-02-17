<?php
/* 
Template Name: Custom Home 
*/
?>
<?php get_header(); ?>

 <?php 
$Site_url_main = get_site_url();
$Site_url_home = $Site_url_main . '/wp-content/uploads/2026/02/';

?>

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








<section class="bg-gray-100 py-16">
  <div class="max-w-7xl mx-auto px-6">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
      
      <!-- Item 1 -->
      <div>
        <div class="w-16 h-16 mx-auto md:mx-0 flex items-center justify-center rounded-xl border border-blue-300 bg-blue-50 mb-6">
          <!-- Tag Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" 
               class="w-8 h-8 text-blue-600" 
               fill="none" 
               viewBox="0 0 24 24" 
               stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M7 7h.01M3 11l8-8a2 2 0 012.828 0l7.172 7.172a2 2 0 010 2.828l-8 8a2 2 0 01-2.828 0L3 13.828A2 2 0 013 11z"/>
          </svg>
        </div>
        <h3 class="text-2xl font-semibold text-gray-900 mb-4">
          Deals and steals
        </h3>
        <p class="text-gray-600 leading-relaxed">
          Looking for a wholesale bargain? Exclusive deals and promotions are 
          posted daily for registered buyers by the approved wholesalers on Wholesale Central.
        </p>
      </div>

      <!-- Item 2 -->
      <div>
        <div class="w-16 h-16 mx-auto md:mx-0 flex items-center justify-center rounded-xl border border-yellow-300 bg-yellow-50 mb-6">
          <!-- Lightning Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" 
               class="w-8 h-8 text-yellow-500" 
               fill="none" 
               viewBox="0 0 24 24" 
               stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <h3 class="text-2xl font-semibold text-gray-900 mb-4">
          Instant Checkout
        </h3>
        <p class="text-gray-600 leading-relaxed">
          Purchase merchandise with the click of a button with our instant checkout feature. 
          Pay with credit card, digital wallets, bank transfers and more to make wholesale buying a breeze.
        </p>
      </div>

      <!-- Item 3 -->
      <div>
        <div class="w-16 h-16 mx-auto md:mx-0 flex items-center justify-center rounded-xl border border-orange-300 bg-orange-50 mb-6">
          <!-- Thumbs Up Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" 
               class="w-8 h-8 text-orange-500" 
               fill="none" 
               viewBox="0 0 24 24" 
               stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M14 9V5a3 3 0 00-6 0v4H5a2 2 0 00-2 2v2a2 2 0 002 2h3l1 5h7a2 2 0 002-2v-7a2 2 0 00-2-2h-2z"/>
          </svg>
        </div>
        <h3 class="text-2xl font-semibold text-gray-900 mb-4">
          True wholesale pricing
        </h3>
        <p class="text-gray-600 leading-relaxed">
          Other marketplaces charge suppliers hefty commissions—costs that get passed on to you. 
          At Wholesale Central, suppliers pay 0% commission, so you get the best prices with no extra markup.
        </p>
      </div>

    </div>

  </div>
</section>


<section class="bg-gray-50 py-16">
  <div class="max-w-7xl mx-auto px-6">
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      
      <!-- LEFT CONTENT -->
      <div>
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 leading-snug mb-10">
          Sourcing wholesale has <br class="hidden md:block"> never been easier
        </h2>

        <!-- Item 1 -->
        <div class="flex gap-5 mb-8">
          <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-blue-600 text-white">
            🔍
          </div>
          <div>
            <h4 class="text-xl font-semibold text-gray-900 mb-1">Search for products</h4>
            <p class="text-gray-600">
              Search and filter from our vast product and supplier offerings 
              to find exactly what your business needs.
            </p>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="flex gap-5 mb-8">
          <div class="w-14 h-14 flex items-center justify-center rounded-xl border border-orange-300 bg-orange-50 text-orange-500">
            🏷️
          </div>
          <div>
            <h4 class="text-xl font-semibold text-gray-900 mb-1">Find the best deal</h4>
            <p class="text-gray-600">
              See wholesale pricing from hundreds of wholesale suppliers 
              with just one account.
            </p>
          </div>
        </div>

        <!-- Item 3 -->
        <div class="flex gap-5 mb-8">
          <div class="w-14 h-14 flex items-center justify-center rounded-xl border border-yellow-300 bg-yellow-50 text-yellow-500">
            ⚡
          </div>
          <div>
            <h4 class="text-xl font-semibold text-gray-900 mb-1">Effortless ordering</h4>
            <p class="text-gray-600">
              Your favorite payment method will be securely stored so you can 
              checkout as soon as you find what you’re looking for.
            </p>
          </div>
        </div>

        <!-- Item 4 -->
        <div class="flex gap-5 mb-10">
          <div class="w-14 h-14 flex items-center justify-center rounded-xl border border-blue-300 bg-blue-50 text-blue-500">
            ✉️
          </div>
          <div>
            <h4 class="text-xl font-semibold text-gray-900 mb-1">Stay in the loop</h4>
            <p class="text-gray-600">
              Never miss out on promotions, news, and industry trends with our 
              Buyer’s Network Newsletter.
            </p>
          </div>
        </div>

        <!-- CTA Button -->
        <a href="#" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
          Create your free account →
        </a>
      </div>


      <!-- RIGHT IMAGE SIDE -->
      <div class="relative flex justify-center">
        
        <!-- Background Shape -->
        <div class="absolute w-80 h-80 bg-blue-100 rounded-3xl top-10 right-10 hidden md:block"></div>

        <!-- Main Image -->
        <img src="<?php echo esc_url($Site_url_home); ?>image-17.jpg"
             alt="Business person"
             class="relative rounded-2xl shadow-lg w-72 md:w-96">

        <!-- Floating Search Box -->
        <!-- <div class="absolute bottom-6 left-6 bg-white shadow-lg rounded-full px-4 py-2 flex items-center gap-3 text-sm hidden md:flex">
          <span class="text-gray-600">Search for <span class="text-blue-600 font-medium">headphones</span></span>
          <div class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded-full">
            🔍
          </div>
        </div> -->

      </div>

    </div>

  </div>
</section>




<?php
$categories = get_terms([
    'taxonomy'   => 'supplier_category',
    'hide_empty' => false,
    'parent'     => 0,
    'order'      => 'ASC',
]);

if(!empty($categories) && !is_wp_error($categories)):
?>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-12">
            Discover even more
        </h2>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <?php foreach($categories as $cat): ?>
                
                <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                   class="flex items-center justify-between px-6 py-4 bg-white border border-gray-300 rounded-xl 
                          hover:border-gray-400 hover:shadow-sm transition duration-200 group">

                    <span class="text-gray-800 font-medium">
                        <?php echo esc_html($cat->name); ?>
                    </span>

                    <!-- Arrow -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="w-5 h-5 text-gray-500 group-hover:translate-x-1 transition-transform duration-200"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7" />
                    </svg>

                </a>

            <?php endforeach; ?>

        </div>

    </div>
</section>

<?php endif; ?>



<?php get_footer(); ?>
