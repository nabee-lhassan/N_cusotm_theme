<?php 
/*
 * Template Name: Contact Page
 */
?>
<?php get_header() ?>


<?php get_template_part('inc/template-parts/banner/inner-banner'); ?>





<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-16">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl p-8">

        <h2 class="text-3xl font-bold text-gray-800 mb-2">Contact Us</h2>
        <p class="text-gray-500 mb-6">
            Have questions? Fill out the form below and we’ll get back to you soon.
        </p>

        <!-- Message Box -->
        <div id="form-message" class="mb-4"></div>

        <form id="ajax-contact-form" class="space-y-5">

            <?php wp_nonce_field('ajax_contact_nonce', 'security'); ?>

            <!-- Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Name
                </label>
                <input type="text" name="name" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Email
                </label>
                <input type="email" name="email" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>

            <!-- Message -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Message
                </label>
                <textarea name="message" rows="5" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition resize-none"></textarea>
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                Send Message
            </button>

        </form>

    </div>

</div>



<script>
document.getElementById('ajax-contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'ajax_contact_form',
            security: form.querySelector('[name="security"]').value,
            name: formData.get('name'),
            email: formData.get('email'),
            message: formData.get('message')
        })
    })
    .then(response => response.json())
    .then(data => {
        const msgBox = document.getElementById('form-message');

        if (data.success) {
            msgBox.innerHTML = '<div class="alert alert-success">' + data.data + '</div>';
            form.reset();
        } else {
            msgBox.innerHTML = '<div class="alert alert-danger">' + data.data + '</div>';
        }
    });
});
</script>



<?php get_footer(); ?>