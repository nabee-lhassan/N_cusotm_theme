<?php

// 1️⃣ Allow all common image types + SVG
function allow_custom_uploads($mimes) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    $mimes['jpg']  = 'image/jpeg';
    $mimes['jpeg'] = 'image/jpeg';
    $mimes['png']  = 'image/png';
    $mimes['gif']  = 'image/gif';
    return $mimes;
}
add_filter('upload_mimes', 'allow_custom_uploads');

// 2️⃣ Optional: Disable SVG sanitization check if you want full freedom
add_filter('wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if($ext === 'svg'){
        $data['ext']  = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}, 10, 4);

// 3️⃣ Optional: Remove max upload size restrictions (if needed)
// add_filter('upload_size_limit', function($size) { return 1024*1024*10; }); // 10MB


?>