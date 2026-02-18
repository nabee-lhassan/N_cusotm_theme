<footer class="bg-gray-900 text-gray-300 pt-14 pb-8">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            <!-- Column 1 : Logo + Tagline -->
            <div>
                <div class="mb-4">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<h2 class="text-xl font-semibold text-white">' . get_bloginfo('name') . '</h2>';
                    }
                    ?>
                </div>

                <p class="text-sm text-gray-400">
                    Your trusted wholesale marketplace. Discover quality products 
                    across hundreds of categories for every reseller.
                </p>
            </div>


            <!-- Column 2 : Footer Menu 1 -->
            <div>
                <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                <?php if (has_nav_menu('footer_menu_1')) :
                    wp_nav_menu([
                        'theme_location' => 'footer_menu_1',
                        'menu_class'     => 'space-y-2',
                        'container'      => false,
                        'link_before'    => '<span class="hover:text-white transition">',
                        'link_after'     => '</span>',
                    ]);
                endif; ?>
            </div>


            <!-- Column 3 : Footer Menu 2 -->
            <div>
                <h3 class="text-white font-semibold mb-4">Resources</h3>
                <?php if (has_nav_menu('footer_menu_2')) :
                    wp_nav_menu([
                        'theme_location' => 'footer_menu_2',
                        'menu_class'     => 'space-y-2',
                        'container'      => false,
                        'link_before'    => '<span class="hover:text-white transition">',
                        'link_after'     => '</span>',
                    ]);
                endif; ?>
            </div>


            <!-- Column 4 : Social Media -->
            <div>
                <h3 class="text-white font-semibold mb-4">Follow Us</h3>

                <div class="flex space-x-4">

                    <!-- Facebook -->
                    <a href="#" target="_blank" 
                       class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 hover:bg-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="w-5 h-5 text-white" 
                             fill="currentColor" 
                             viewBox="0 0 24 24">
                            <path d="M22 12a10 10 0 10-11.6 9.9v-7h-2.7V12h2.7V9.8c0-2.7 1.6-4.2 4.1-4.2 1.2 0 2.4.2 2.4.2v2.6h-1.3c-1.3 0-1.7.8-1.7 1.6V12h2.9l-.5 2.9h-2.4v7A10 10 0 0022 12z"/>
                        </svg>
                    </a>

                    <!-- Instagram -->
                    <a href="#" target="_blank"
                       class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 hover:bg-pink-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="w-5 h-5 text-white" 
                             fill="currentColor" 
                             viewBox="0 0 24 24">
                            <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm5 5.5A4.5 4.5 0 1112 17a4.5 4.5 0 010-9zm5.8-1.3a1.1 1.1 0 110 2.2 1.1 1.1 0 010-2.2zM12 9a3 3 0 100 6 3 3 0 000-6z"/>
                        </svg>
                    </a>

                </div>
            </div>

        </div>

        <!-- Bottom Copyright -->
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-sm text-gray-500">
            © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
        </div>

    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>