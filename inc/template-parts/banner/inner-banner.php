<?php
$title = get_the_title();
$bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full');

if (!$bg_image) {
    $bg_image = get_template_directory_uri() . '/assets/images/default-banner.jpg';
}
?>


<section class="inner-banner relative bg-cover bg-center py-24"
    style="background-image: url('<?php echo esc_url($bg_image); ?>');">

    <div class="absolute inset-0 bg-[#0094f7]"></div>

    <div class="relative max-w-7xl mx-auto px-6 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold first-letter:uppercase">
    <?php echo esc_html($title); ?>
</h1>

    </div>
</section>
