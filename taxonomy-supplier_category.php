<?php get_header(); ?>

<?php
$term = get_queried_object();
$taxonomy = $term->taxonomy;

$icon_id = get_term_meta($term->term_id, 'category_icon_id', true);
$icon_url = $icon_id ? wp_get_attachment_url($icon_id) : '';

$bg_id = get_term_meta($term->term_id, 'category_bg_id', true);
$bg_url = $bg_id ? wp_get_attachment_url($bg_id) : '';
?>

<style>
.category-page {
    display: flex;
    gap: 20px;
    padding: 30px;
}
.category-sidebar {
    width: 250px;
    flex-shrink: 0;
    border: 1px solid #eee;
    padding: 20px;
    border-radius: 12px;
    background: #fff;
}
.category-content { flex: 1; }
.category-header {
    text-align: center;
    margin-bottom: 30px;
    padding: 50px 20px;
    border-radius: 12px;
    color: #fff;
    background-size: cover;
    background-position: center;
}
.category-header img {
    max-width: 80px;
    display: block;
    margin: 0 auto 10px;
}
.suppliers-wrapper {
    display: grid;
    gap: 20px;
}
.supplier-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 15px;
    text-align: center;
    transition: 0.3s ease;
}
.div-brand-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.products-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}
.product-item {
    width: 120px;
    text-align: center;
}
.product-item img {
    max-width: 100%;
    border-radius: 8px;
}
</style>

<!-- Header -->
<div class="category-header" style="<?php echo $bg_url ? 'background-color:#0094f7;' : 'background:#0094f7;'; ?> min-height:350px;display:flex;flex-direction:column;justify-content:center;align-items:center;">
    <?php if($icon_url): ?>
        <!-- <img src="<?php echo esc_url($icon_url); ?>"> -->
    <?php endif; ?>
    <?php if($term->name): ?>
    <h1 class="text-[35px] font-semibold"><?php echo esc_html($term->name); ?></h1>
    <?php else: ?>
    <h1>Category: <?php echo esc_html($term->name); ?></h1>
    <?php endif; ?>
    <?php if($term->description): ?>
        <p><?php echo esc_html($term->description); ?></p>
    <?php endif; ?>
</div>

<div class="category-page">

    <!-- Sidebar -->
    <div class="category-sidebar">
        <h3>Sub Categories</h3>
        <hr>
        <ul>
        <?php
        $sidebar_terms = get_terms([
            'taxonomy' => $taxonomy,
            'parent'   => $term->term_id,
            'hide_empty' => false,
        ]);

        if(!empty($sidebar_terms) && !is_wp_error($sidebar_terms)){
            foreach($sidebar_terms as $st){
                echo '<li><a href="'.esc_url(get_term_link($st)).'">'.esc_html($st->name).'</a></li>';
            }
        } else {
            echo '<li>No sub categories</li>';
        }
        ?>
        </ul>
    </div>

    <!-- Content -->
    <div class="category-content">
        <div class="suppliers-wrapper">
        <?php

        // Get child terms to display
        $display_terms = [];

        if($term->parent == 0){
            // Parent level: get grandchildren
            $children = get_terms([
                'taxonomy' => $taxonomy,
                'parent'   => $term->term_id,
                'hide_empty' => false,
            ]);

            foreach($children as $child){
                $grandchildren = get_terms([
                    'taxonomy' => $taxonomy,
                    'parent'   => $child->term_id,
                    'hide_empty' => false,
                ]);

                if(!empty($grandchildren)){
                    $display_terms = array_merge($display_terms, $grandchildren);
                }
            }

        } else {
            // Child level: get direct children
            $display_terms = get_terms([
                'taxonomy' => $taxonomy,
                'parent'   => $term->term_id,
                'hide_empty' => false,
            ]);
        }

        if(!empty($display_terms) && !is_wp_error($display_terms)){
            foreach($display_terms as $dt){
                $website = get_term_meta($dt->term_id, 'category_website_url', true);
                ?>
                <div class="supplier-card">
                    <div class="div-brand-row">
                        <h3>
                            <span class="text-[18px] font-medium">
                                <?php echo esc_html($dt->name); ?>
    </span>
                        </h3>
                        <?php if($website): ?>
                            <p><a class="bg-[#0094f7] text-white px-[15px] py-[10px] rounded-[5px]" href="<?php echo esc_url($website); ?>" target="_blank">Visit Website</a></p>
                        <?php endif; ?>
                    </div>

                    <?php if($dt->description): ?>
                        <div class="category-description text-left my-10"><?php echo esc_html($dt->description); ?></div>
                    <?php endif; ?>

                    <?php
                    // Check if this term has children
                    $child_check = get_terms([
                        'taxonomy' => $taxonomy,
                        'parent'   => $dt->term_id,
                        'hide_empty' => false,
                    ]);

                    // If no children, show products
                    if(empty($child_check)){
                     $products = new WP_Query([
    'post_type' => 'supplier', 
    'posts_per_page' => 6,
    'tax_query' => [
        [
            'taxonomy' => $taxonomy, 
            'field'    => 'term_id',
            'terms'    => $dt->term_id,
        ]
    ]
]);


                        if($products->have_posts()){
                            echo '<div class="products-list">';
                            while($products->have_posts()){
                                $products->the_post();
                                ?>
                                <div class="product-item">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                        <p><?php the_title(); ?></p>
                                    </a>
                                </div>
                                <?php
                            }
                            echo '</div>';
                            wp_reset_postdata();
                        } else {
                            echo '<p>No products found.</p>';
                        }
                    }
                    ?>
                </div>
                <?php
            }
        } else {
            echo '<p>No child categories found.</p>';
        }

        ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
