<?php
// disable_file_versioning.php

/*
Plugin Name: Disable WordPress File Versioning
Description: Disable file versioning in WordPress. Example: min.css<b>?ver=6.4.3</b><br />
*/

function disable_file_versioning() {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_file_versioning']) && $settings['disable_file_versioning'] == 1) {
        // Disable WordPress file versioning
        add_filter('style_loader_src', 'remove_version_from_style', 9999);
        add_filter('script_loader_src', 'remove_version_from_script', 9999);
    }
}

function remove_version_from_style($src) {
    if (strpos($src, 'ver=') !== false) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

function remove_version_from_script($src) {
    if (strpos($src, 'ver=') !== false) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

add_action('init', 'disable_file_versioning');

?>
