<?php
// disable_wp_block_library_css.php

/*
Plugin Name: Disable wp-block-library-css
Description: Disables wp-block-library-css in WordPress.<br />
*/

function disable_wp_block_library_css() {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_wp_block_library_css']) && $settings['disable_wp_block_library_css'] == 1) {
        // Disable wp-block-library-css
        wp_dequeue_style('wp-block-library'); // Dequeue the CSS file
        wp_dequeue_style('wp-block-library-theme'); // Dequeue the theme CSS file
    }
}
add_action('wp_enqueue_scripts', 'disable_wp_block_library_css', 100);

?>
