<?php
/**
 * Product Card Layout
 */
global $product;
?>

<div class="product-card border p-4 rounded shadow hover:shadow-lg transition">

    <a href="<?php the_permalink(); ?>" class="product-thumb block mb-2">
        <?php echo woocommerce_get_product_thumbnail(); ?>
    </a>

    <h3 class="product-title mb-2">
        <a href="<?php the_permalink(); ?>" class="font-semibold hover:text-blue-600">
            <?php the_title(); ?>
        </a>
    </h3>

    <span class="price mb-4 block font-bold">
        <?php echo $product->get_price_html(); ?>
    </span>

    <?php if ( $product->is_type('variable') ) : ?>
        <button 
            class="btn-add-cart bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 open-variant-popup"
            data-product-id="<?php echo $product->get_id(); ?>">
            Select Options
        </button>
    <?php else : ?>
        <?php woocommerce_template_loop_add_to_cart(); ?>
    <?php endif; ?>

</div>


