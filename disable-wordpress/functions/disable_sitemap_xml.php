<?php
// disable_sitemap_xml.php

/*
Plugin Name: Disable Sitemap XML
Description: Disable  sitemap.xml functionality  <br />
*/

function disable_sitemap_xml() {
    $settings = get_option('disable_wordpress_settings');
    if (isset($settings['disable_sitemap_xml']) && $settings['disable_sitemap_xml'] == 1) {
        add_filter('wp_sitemaps_enabled', '__return_false');
    }
}
add_action('init', 'disable_sitemap_xml', 100);


?>
