<?php
// disable_jquery_migrate.php

/*
Plugin Name: Disable jQuery Migrate
Description: Disables additional jQuery Migrate script.<br />
*/

function intercept_jquery_migrate($scripts) {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_jquery_migrate']) && $settings['disable_jquery_migrate'] == 1) {
        if (isset($scripts->registered['jquery'])) {
            $jquery_dependencies = $scripts->registered['jquery']->deps;
            $jquery_dependencies = array_diff($jquery_dependencies, array('jquery-migrate'));
            $scripts->registered['jquery']->deps = $jquery_dependencies;
        }
    }
}
add_action('wp_default_scripts', 'intercept_jquery_migrate');

?>
