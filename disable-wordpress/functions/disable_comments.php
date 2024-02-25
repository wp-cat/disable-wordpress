<?php
// disable_comments_form.php

/*
Plugin Name: Disable Comments Form
Description: Disable comments form and hides existing comments.<br />
*/

function disable_comments_form() {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_comments_form']) && $settings['disable_comments_form'] == 1) {
        // Disable comments form
        add_filter( 'comments_open', '__return_false', 20, 2 );
        add_filter( 'pings_open', '__return_false', 20, 2 );
        add_filter( 'comments_array', '__return_empty_array', 10, 2 );
        add_action( 'admin_init', 'disable_comments_admin_menu' );
        add_action( 'admin_menu', 'disable_comments_admin_menu' );
        add_action( 'init', 'disable_comments_post_types_support' );
        add_action( 'wp_before_admin_bar_render', 'disable_admin_bar_comments_link' );
    }
}

function disable_comments_admin_menu() {
    remove_menu_page( 'edit-comments.php' );
}

function disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ( $post_types as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
}

function disable_admin_bar_comments_link() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}

add_action('init', 'disable_comments_form');

// Override comments template
add_filter( 'comments_template', 'disable_comments_template' );
function disable_comments_template() {
    return function() {
        echo ''; // Output an empty string to prevent comments from being displayed
    };
}
?>