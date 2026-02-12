<?php
/* =========================
   CATEGORY ICON (Attachment ID)
========================= */

// Add icon field
add_action('supplier_category_add_form_fields', function () {
    ?>
    <div class="form-field">
        <label>Category Icon (Attachment ID)</label>
        <input type="number" name="category_icon_id" placeholder="Enter image attachment ID">
        <p class="description">
            Example: 14 (upload image to Media Library and enter its ID here)
        </p>
    </div>
    <?php
});

// Edit icon field
add_action('supplier_category_edit_form_fields', function ($term) {
    $icon_id = get_term_meta($term->term_id, 'category_icon_id', true);
    ?>
    <tr class="form-field">
        <th><label>Category Icon (Attachment ID)</label></th>
        <td>
            <input type="number" name="category_icon_id" value="<?php echo esc_attr($icon_id); ?>">
            <?php if($icon_id): 
                $icon_url = wp_get_attachment_url($icon_id);
                if($icon_url):
            ?>
                <p><img src="<?php echo esc_url($icon_url); ?>" style="max-width:60px;"></p>
            <?php endif; endif; ?>
            <p class="description">
                Enter the attachment ID of the icon image from Media Library.
            </p>
        </td>
    </tr>
    <?php
});

// Save icon
add_action('created_supplier_category', 'save_supplier_cat_icon_number');
add_action('edited_supplier_category', 'save_supplier_cat_icon_number');
function save_supplier_cat_icon_number($term_id) {
    if(isset($_POST['category_icon_id'])){
        update_term_meta($term_id, 'category_icon_id', intval($_POST['category_icon_id']));
    }
}




/* =========================
   CATEGORY EXTRA FIELDS
========================= */


/* ========= ADD FIELDS (ADD NEW TERM PAGE) ========= */
add_action('supplier_category_add_form_fields', function () {
?>
    <!-- Icon -->
    <div class="form-field">
        <label>Category Icon (Attachment ID)</label>
        <input type="number" name="category_icon_id" placeholder="Enter image attachment ID">
    </div>

    <!-- Background -->
    <div class="form-field">
        <label>Category Background Image (Attachment ID)</label>
        <input type="number" name="category_bg_id" placeholder="Enter background image attachment ID">
    </div>

    <!-- Website (NEW) -->
    <div class="form-field">
        <label>Category Website URL</label>
        <input type="url" name="category_website_url" placeholder="https://example.com">
    </div>
<?php
});


/* ========= EDIT FIELDS (EDIT TERM PAGE) ========= */
add_action('supplier_category_edit_form_fields', function ($term) {

    $icon_id  = get_term_meta($term->term_id, 'category_icon_id', true);
    $bg_id    = get_term_meta($term->term_id, 'category_bg_id', true);
    $website  = get_term_meta($term->term_id, 'category_website_url', true);
?>
    <!-- Icon -->
    <tr class="form-field">
        <th><label>Category Icon (Attachment ID)</label></th>
        <td>
            <input type="number" name="category_icon_id" value="<?php echo esc_attr($icon_id); ?>">
            <?php if($icon_id): ?>
                <p><img src="<?php echo esc_url(wp_get_attachment_url($icon_id)); ?>" style="max-width:60px;"></p>
            <?php endif; ?>
        </td>
    </tr>

    <!-- Background -->
    <tr class="form-field">
        <th><label>Category Background Image (Attachment ID)</label></th>
        <td>
            <input type="number" name="category_bg_id" value="<?php echo esc_attr($bg_id); ?>">
            <?php if($bg_id): ?>
                <p><img src="<?php echo esc_url(wp_get_attachment_url($bg_id)); ?>" style="max-width:100px;"></p>
            <?php endif; ?>
        </td>
    </tr>

    <!-- Website (NEW) -->
    <tr class="form-field">
        <th><label>Category Website URL</label></th>
        <td>
            <input type="url" name="category_website_url" value="<?php echo esc_attr($website); ?>" style="width:100%;">
            <?php if($website): ?>
                <p>
                    <a href="<?php echo esc_url($website); ?>" target="_blank">
                        Visit Website
                    </a>
                </p>
            <?php endif; ?>
        </td>
    </tr>

<?php
});


/* ========= SAVE ALL FIELDS ========= */
add_action('created_supplier_category', 'save_supplier_category_fields');
add_action('edited_supplier_category', 'save_supplier_category_fields');

function save_supplier_category_fields($term_id){

    if(isset($_POST['category_icon_id'])){
        update_term_meta($term_id, 'category_icon_id', intval($_POST['category_icon_id']));
    }

    if(isset($_POST['category_bg_id'])){
        update_term_meta($term_id, 'category_bg_id', intval($_POST['category_bg_id']));
    }

    if(isset($_POST['category_website_url'])){
        update_term_meta($term_id, 'category_website_url', esc_url_raw($_POST['category_website_url']));
    }
}
