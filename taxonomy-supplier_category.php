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
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
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
.supplier-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
</style>

<!-- Header -->
<div class="category-header" style="<?php echo $bg_url ? 'background-image:url('.esc_url($bg_url).');' : 'background:#333;'; ?>">
    <?php if($icon_url): ?>
        <img src="<?php echo esc_url($icon_url); ?>">
    <?php endif; ?>
    <h1><?php echo esc_html($term->name); ?></h1>
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

        $display_terms = [];

        // Agar current term parent level par hai
        if($term->parent == 0){

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

            // Agar already child level par hai
            $display_terms = get_terms([
                'taxonomy' => $taxonomy,
                'parent'   => $term->term_id,
                'hide_empty' => false,
            ]);
        }

        $website = get_term_meta($term->term_id, 'category_website_url', true);


        if(!empty($display_terms) && !is_wp_error($display_terms)){
            foreach($display_terms as $dt){
                ?>
                <div class="supplier-card">
                    <h3>
                        <a href="<?php echo esc_url(get_term_link($dt)); ?>">
                            <?php echo esc_html($dt->name); ?>
                        </a>
                    </h3>
                    
                    <?php if($website): ?>
                        <p><a href="<?php echo esc_url($website); ?>" target="_blank">Visit Website</a></p>
                    <?php endif; ?>
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
