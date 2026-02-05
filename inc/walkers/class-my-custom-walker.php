<?php 

class My_Mega_Menu_Walker extends Walker_Nav_Menu {

    // UL start
    function start_lvl( &$output, $depth = 0, $args = null ) {

        if ($depth === 0) {
            // Mega menu wrapper
            $output .= '<div class="mega-menu absolute left-0 top-full w-full bg-white shadow-lg z-50"><div class="container mx-auto px-4 py-6"><ul class="flex gap-6">';
        } else {
            $output .= '<ul class="sub-menu mt-2 space-y-2">'; // simple vertical links
        }
    }

    // UL end
    function end_lvl( &$output, $depth = 0, $args = null ) {

        if ($depth === 0) {
            $output .= '</ul></div></div>';
        } else {
            $output .= '</ul>';
        }
    }

    // LI start
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $class_names = implode(' ', $classes);

        // MAIN MENU ITEM (Top Level)
        if ($depth === 0) {
            $output .= '<li class="group relative menu-item ' . esc_attr($class_names) . '">';
            $output .= '<a href="' . esc_url($item->url) . '" class="font-semibold text-gray-800 hover:text-blue-600">' . esc_html($item->title) . '</a>';
        }
        // MEGA MENU COLUMN (Second Level)
        elseif ($depth === 1) {
            $output .= '<li class="mega-column w-1/4">'; // 4 columns layout
            $output .= '<h4 class="mega-title font-bold mb-2">' . esc_html($item->title) . '</h4>';
        }
        // LINKS INSIDE COLUMN (Third Level)
        else {
            $output .= '<li class="mega-link">';
            $output .= '<a href="' . esc_url($item->url) . '" class="text-gray-600 hover:text-blue-500 block">' . esc_html($item->title) . '</a>';
        }
    }

    // LI end
    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
?>
