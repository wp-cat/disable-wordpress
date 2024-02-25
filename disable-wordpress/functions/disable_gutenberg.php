<?php
// disable_gutenberg.php

/*
Plugin Name: Disable Gutenberg
Description: Disable the Gutenberg editor in WordPress. <b>Enable classic editor</b><br />
*/

function disable_gutenberg() {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_gutenberg']) && $settings['disable_gutenberg'] == 1) {
        // Disable Gutenberg editor for posts
        add_filter('use_block_editor_for_post', '__return_false', 10);
    }
}
add_action('init', 'disable_gutenberg');

?>
