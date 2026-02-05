<!-- Variant Popup -->
<div id="variant-popup" class="fixed inset-0 bg-black/60 hidden z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-lg p-6 relative rounded-lg shadow-lg">

        <!-- Close Button -->
        <button id="close-popup" class="absolute top-3 right-3 text-2xl font-bold">&times;</button>

        <!-- AJAX Product Form -->
        <div id="popup-content">
            <!-- AJAX content will load here -->
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const popup = document.getElementById('variant-popup');
    const popupContent = document.getElementById('popup-content');

    // Open popup
    document.querySelectorAll('.open-variant-popup').forEach(btn => {
        btn.addEventListener('click', function () {

            const productId = this.dataset.productId;
            popup.classList.remove('hidden');

            // Lock scroll
            document.body.style.overflow = 'hidden';

            // AJAX request to load variation form
            fetch('<?php echo admin_url("admin-ajax.php"); ?>?action=load_product_popup&product_id=' + productId)
                .then(res => res.text())
                .then(html => popupContent.innerHTML = html);
        });
    });

    // Close popup
    document.getElementById('close-popup').addEventListener('click', function () {
        popup.classList.add('hidden');
        popupContent.innerHTML = '';
        document.body.style.overflow = '';
    });

    // Close on overlay click
    popup.addEventListener('click', function(e) {
        if (e.target === this) {
            popup.classList.add('hidden');
            popupContent.innerHTML = '';
            document.body.style.overflow = '';
        }
    });

});
</script>


<footer class="site-footer">
    <div class="footer-columns">

<div class="footer-col">
</div>


<?php if (has_nav_menu('footer_menu_1')) : ?>
            <div class="footer-col">
                <?php wp_nav_menu(['theme_location' => 'footer_menu_1']); ?>
            </div>
        <?php endif; ?>

<?php if (has_nav_menu('footer_menu_2')) : ?>
    <?php wp_nav_menu(['theme_location' => 'footer_menu_2']); ?>
</div>
<?php endif; ?>

<div class="footer-col">
</div>

    </div>



<div>

  <p>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>

</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
