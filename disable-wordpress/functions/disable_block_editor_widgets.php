<?php
// disable_block_editor_widgets.php

/*
Plugin Name: Disable Block Editor in Widgets
Description: Disables the block editor for widgets. <b>Enable old classic widgets feature</b><br />
*/

function disable_block_editor_widgets() {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_block_editor_widgets']) && $settings['disable_block_editor_widgets'] == 1) {
        // Disable block editor for widgets
        add_filter('use_widgets_block_editor', '__return_false', 10);
    }
}
add_action('init', 'disable_block_editor_widgets');
?>
