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
   CATEGORY BACKGROUND (Attachment ID)
========================= */

// Add background field
add_action('supplier_category_add_form_fields', function () {
    ?>
    <div class="form-field">
        <label>Category Background Image (Attachment ID)</label>
        <input type="number" name="category_bg_id" placeholder="Enter background image attachment ID">
        <p class="description">
            Example: 20 (upload image to Media Library and enter its ID here)
        </p>
    </div>
    <?php
});

// Edit background field
add_action('supplier_category_edit_form_fields', function ($term) {
    $bg_id = get_term_meta($term->term_id, 'category_bg_id', true);
    ?>
    <tr class="form-field">
        <th><label>Category Background Image (Attachment ID)</label></th>
        <td>
            <input type="number" name="category_bg_id" value="<?php echo esc_attr($bg_id); ?>">
            <?php if($bg_id): 
                $bg_url = wp_get_attachment_url($bg_id);
                if($bg_url):
            ?>
                <p><img src="<?php echo esc_url($bg_url); ?>" style="max-width:100px;"></p>
            <?php endif; endif; ?>
            <p class="description">
                Enter the attachment ID of the background image from Media Library.
            </p>
        </td>
    </tr>
    <?php
});

// Save background
add_action('created_supplier_category', 'save_supplier_cat_bg_number');
add_action('edited_supplier_category', 'save_supplier_cat_bg_number');
function save_supplier_cat_bg_number($term_id) {
    if(isset($_POST['category_bg_id'])){
        update_term_meta($term_id, 'category_bg_id', intval($_POST['category_bg_id']));
    }
}
