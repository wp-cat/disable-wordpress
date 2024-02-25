<?php
// disable_all_rss_feeds.php

/*
Plugin Name: Disable All RSS Feeds
Description: Disable all RSS feeds <i>example.com/rss or example.com/feed</i><br />
*/

function disable_all_rss_feeds() {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_all_rss_feeds']) && $settings['disable_all_rss_feeds'] == 1) {
        // Disable all RSS feeds
        remove_action('do_feed', 'do_feed', 10);
        remove_action('do_feed_rdf', 'do_feed_rdf', 10);
        remove_action('do_feed_rss', 'do_feed_rss', 10);
        remove_action('do_feed_rss2', 'do_feed_rss2', 10);
        remove_action('do_feed_atom', 'do_feed_atom', 10);
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'rel_canonical');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'parent_post_rel_link');
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'adjacent_posts_rel_link');
    }
}
add_action('init', 'disable_all_rss_feeds');

?>
