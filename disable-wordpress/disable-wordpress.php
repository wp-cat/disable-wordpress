<?php
/*
Plugin Name: Disable WordPress
Description: Plugin to disable specific WordPress features for performance and better control.
Version: 1.0
Author: WP-Cat
Author URI: wp-cat.net
Plugin URI: https://wp-cat.net/download/disable-wordpress/
Requires at least: 5.4
Tested up to: 6.4.3
*/

/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 
	2 of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	with this program. If not, visit: https://www.gnu.org/licenses/
	
*/

// Add a settings link on the plugin page
function disable_wordpress_settings_link($links) {
    $settings_link = '<a href="admin.php?page=disable_wordpress">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'disable_wordpress_settings_link');

// Add admin menu item
add_action('admin_menu', 'disable_wordpress_menu');

function disable_wordpress_menu() {
    add_menu_page(
        'Disable WordPress',   // page title
        'Disable WordPress',   // menu title
        'manage_options',      // capability
        'disable_wordpress',   // menu slug
        'disable_wordpress_settings_page', // callback function
        'dashicons-admin-tools', // icon
        60 // position
    );
}

// Include all functions files from the 'functions' directory
foreach (glob(plugin_dir_path(__FILE__) . "functions/*.php") as $file) {
    include_once $file;
}

// Callback function for settings page
function disable_wordpress_settings_page() {
    ?>
    <div class="wrap">
        <h1>Disable WordPress Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('disable_wordpress_options');
            $settings = get_option('disable_wordpress_settings');
            // Add a checkbox for each function
            $functions_dir = plugin_dir_path(__FILE__) . "functions/";
            $files = glob($functions_dir . "*.php");
            if ($files !== false) {
                foreach ($files as $file) {
                    $function_name = basename($file, '.php');
                    // Get the description from the file
                    $description = get_function_description($file);
                    ?>
                    <label for="<?php echo $function_name; ?>">
                        <input type="checkbox" id="<?php echo $function_name; ?>" name="disable_wordpress_settings[<?php echo $function_name; ?>]" value="1" <?php checked(1, $settings[$function_name] ?? 0); ?>>
                        <?php echo $description; ?>
                    </label><br>
                    <?php
                }
            }
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <h2>Do you like plugin?</h2>
    
    <a href="https://www.paypal.com/paypalme/apokalypsa" target="_blank">
    <img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" alt="PayPal - The safer, easier way to pay online!">
</a>

    <?php
}

// Callback function to apply settings
function apply_disable_wordpress_settings() {
    $settings = get_option('disable_wordpress_settings');
    $functions_dir = plugin_dir_path(__FILE__) . "functions/";

    // Get all PHP files in the functions directory
    $files = glob($functions_dir . "*.php");

    if ($files !== false) {
        foreach ($files as $file) {
            $function_name = basename($file, '.php');

            // Check if the function is enabled in settings
            if (isset($settings[$function_name]) && $settings[$function_name] == 1) {
                include_once $file;
            }
        }
    }
}


// Hook to apply settings
add_action('after_setup_theme', 'apply_disable_wordpress_settings');

// Function to get description from the file
function get_function_description($file_path) {
    $file_contents = file_get_contents($file_path);
    preg_match('/Description:(.*)/', $file_contents, $matches);
    if (!empty($matches[1])) {
        return trim($matches[1]);
    } else {
        return 'No description available';
    }
}

// Register settings
add_action('admin_init', 'disable_wordpress_register_settings');

function disable_wordpress_register_settings() {
    // Register a setting and its sanitization callback
    register_setting('disable_wordpress_options', 'disable_wordpress_settings', 'sanitize_disable_wordpress_settings');
}

// Sanitize settings
function sanitize_disable_wordpress_settings($input) {
    // Ensure each setting is either 0 or 1
    foreach ($input as $key => $value) {
        $input[$key] = ($value == 1) ? 1 : 0;
    }
    return $input;
}


?>


