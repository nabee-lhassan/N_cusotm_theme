<?php get_header(); ?>

<?php
$term = get_queried_object(); // current category
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
.category-content {
    flex: 1;
}
.category-header {
    text-align: center;
    margin-bottom: 30px;
    padding: 50px 20px;
    border-radius: 12px;
    color: #fff;
    position: relative;
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
    transition: all 0.3s ease;
}
.supplier-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.supplier-card img {
    max-width: 80px;
    margin-bottom: 10px;
}
.supplier-card h3 {
    font-size: 16px;
    margin-bottom: 5px;
}
</style>

<div class="category-header" style="<?php echo $bg_url ? 'background-image:url('.esc_url($bg_url).');' : 'background:#333;'; ?>">
    <?php if($icon_url): ?>
        <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($term->name); ?>">
    <?php endif; ?>
    <h1><?php echo esc_html($term->name); ?></h1>
    <?php if($term->description): ?>
        <p><?php echo esc_html($term->description); ?></p>
    <?php endif; ?>
</div>

<div class="category-page">
    <!-- Sidebar Filters -->
    <div class="category-sidebar">
        <h3>Filters</h3>
        <hr>
        <h4>Locations</h4>
        <ul>
        <?php
        // List all unique locations of suppliers in this category
        $suppliers = get_posts([
            'post_type' => 'supplier',
            'tax_query' => [
                [
                    'taxonomy' => 'supplier_category',
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ]
            ],
            'posts_per_page' => -1,
        ]);
        $locations = [];
        foreach($suppliers as $s){
            $loc = get_post_meta($s->ID,'location',true);
            if($loc) $locations[$loc] = $loc;
        }
        foreach($locations as $loc){
            echo '<li><a href="#">'.esc_html($loc).'</a></li>';
        }
        ?>
        </ul>
    </div>

    <!-- Right Content -->
    <div class="category-content">
        <div class="suppliers-wrapper">
        <?php
        if($suppliers):
            foreach($suppliers as $supplier):
                $logo_id = get_post_meta($supplier->ID, 'logo', true);
                $logo_url = $logo_id ? wp_get_attachment_url($logo_id) : 'https://via.placeholder.com/80';
                $website = get_post_meta($supplier->ID,'website',true);
                $location = get_post_meta($supplier->ID,'location',true);
        ?>
            <div class="supplier-card">
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($supplier->post_title); ?>">
                <h3><?php echo esc_html($supplier->post_title); ?></h3>
                <?php if($website): ?><a href="<?php echo esc_url($website); ?>" target="_blank"><?php echo esc_html($website); ?></a><?php endif; ?>
                <?php if($location): ?><p><?php echo esc_html($location); ?></p><?php endif; ?>

                <?php
                // Featured products
                $featured_products = get_post_meta($supplier->ID,'featured_products',true);
                if($featured_products):
                    echo '<ul style="text-align:left; margin-top:10px;">';
                    foreach($featured_products as $p_id){
                        $p = get_post($p_id);
                        if($p){
                            echo '<li><a href="'.get_permalink($p_id).'">'.esc_html($p->post_title).'</a></li>';
                        }
                    }
                    echo '</ul>';
                endif;
                ?>
            </div>
        <?php
            endforeach;
        else:
            echo '<p>No suppliers found in this category.</p>';
        endif;
        ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
