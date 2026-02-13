<?php get_header(); ?>

<?php
while (have_posts()) : the_post();

    $website  = get_post_meta(get_the_ID(), 'website', true);
    $location = get_post_meta(get_the_ID(), 'location', true);
    $logo_id  = get_post_meta(get_the_ID(), 'logo', true);
    $contact_details = get_post_meta(get_the_ID(), 'contact_details', true);

    // Current post categories (for standard 'category' taxonomy)
    $categories = wp_get_post_terms(get_the_ID(), 'category', ['fields' => 'ids']);
?>

<section class="max-w-7xl mx-auto px-6 py-12 ">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-[150px]">

        <!-- LEFT SIDE IMAGE -->
        <div class="bg-gray-100 rounded-2xl p-8">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', ['class' => 'w-full rounded-xl']); ?>
            <?php else: ?>
                <div class="h-80 flex items-center justify-center text-gray-400">
                    No Image
                </div>
            <?php endif; ?>
        </div>

        <!-- RIGHT SIDE -->
        <div class="space-y-6">

            <!-- Logo -->
            <?php if ($logo_id): ?>
                <div>
                    <?php echo wp_get_attachment_image($logo_id, 'medium', false, ['class' => 'h-16 mb-4']); ?>
                </div>
            <?php endif; ?>

            <!-- Title -->
            <h1 class="text-3xl font-semibold">
                <?php the_title(); ?>
            </h1>

            <!-- Location -->
            <?php if ($location): ?>
                <p class="text-gray-500 text-sm">
                    📍 <?php echo esc_html($location); ?>
                </p>
            <?php endif; ?>

            <!-- Shop Now Button -->
            <?php if ($website): ?>
                <a href="<?php echo esc_url($website); ?>" 
                   target="_blank"
                   class="inline-block bg-[#0094f7] text-white px-6 py-3 rounded-xl font-medium hover:bg-blue-700 transition">
                    Shop Now
                </a>
            <?php endif; ?>

            <!-- Description -->
            <div class="border rounded-2xl p-6 bg-white shadow-sm">
                <h3 class="text-lg font-semibold mb-3">Item Details</h3>
                <div class="text-gray-600 text-sm leading-6">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- Contact -->
            <?php if ($contact_details): ?>
                <a href="tel:<?php echo esc_attr($contact_details); ?>" class="block bg-[#0094f7] text-gray-700 px-4 py-2 w-fit text-white rounded-lg text-sm hover:bg-gray-300 transition">
                     <?php echo esc_html($contact_details); ?>
                </a>
            <?php endif; ?>

            <!-- Related Products -->
            <?php if ($categories): ?>
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-3">Related Products</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <?php
                        $related_posts = new WP_Query([
                            'post_type'      => 'product', // Agar aap custom post type 'product' use kar rahe hain
                            'posts_per_page' => 4,
                            'post__not_in'   => [get_the_ID()], // Current post exclude
                            'tax_query'      => [
                                [
                                    'taxonomy' => 'category', // ya aapka custom taxonomy
                                    'field'    => 'term_id',
                                    'terms'    => $categories,
                                ],
                            ],
                        ]);

                        if ($related_posts->have_posts()) :
                            while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="border rounded-xl p-4 flex items-center space-x-4 hover:shadow-md transition">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="w-20 h-20 flex-shrink-0">
                                            <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover rounded']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="flex-1">
                                        <h4 class="font-medium"><?php the_title(); ?></h4>
                                        <p class="text-sm text-gray-500"><?php echo wp_trim_words(get_the_content(), 10, '...'); ?></p>
                                    </div>
                                </a>
                            <?php endwhile;
                            wp_reset_postdata();
                        else:
                            echo '<p class="text-gray-500">No related products found.</p>';
                        endif;
                        ?>

                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

</section>

<?php endwhile; ?>

<?php get_footer(); ?>
