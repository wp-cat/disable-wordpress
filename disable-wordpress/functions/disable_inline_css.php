<?php
/*
Plugin Name: Disable Inline CSS
Description: Disables all inline CSS. <br />
*/

function remove_inline_css() {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_inline_css']) && $settings['disable_inline_css'] == 1) {
        // Disable inline CSS
        add_action('wp_head', function() {
            ob_start(function($buffer) {
                return preg_replace('/<style.*?>.*?<\/style>/s', '', $buffer);
            });
        }, 0);
    }
}
add_action('init', 'remove_inline_css');
?>
