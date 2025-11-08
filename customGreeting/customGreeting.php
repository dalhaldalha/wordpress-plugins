<?php
/*
 * Plugin Name: Custom Greeting
 * Plugin URI:  https://bakandamiya.com/custom-greeting
 * Description: Adds a configurable greeting to posts. Demonstrates activation, deactivation, settings page, shortcode, assets, and organized includes.
 * Version:     1.0
 * Author:      Bakandamiya Technolgies
 * Author URI:  https://bakandamiya.com
 * licence:     GPL2
 * Text Domain: custom-greeting
 */

if (! defined('ABSPATH')){
    exit;
};

define( 'CG_PLUGIN_DIR', plugin_dir_path(__FILE__));
define( 'CG_PLUGIN URL', plugin_dir_url(__FILE__));

// Activation Hook
function cg_activate() {
    // This code runs once when the plugin is activated
    add_option('customgreeting_installed_time', time());
	error_log("CG Plugin activated at " . date('Y-m-d H:i:s', time()));

    // Example: schedule a recurring event
    if (!wp_next_scheduled('customgreeting_daily_event')) {
        wp_schedule_event(time(), 'daily', 'customgreeting_daily_event');
    }

    // You can also create database tables or default settings here
}
register_activation_hook(
	__FILE__,
	'cg_activate'
);


// Deactivation Hook
function cg_deactivate() {
    // This code runs once when the plugin is deactivated

    // Example: clear the scheduled event
    wp_clear_scheduled_hook('customgreeting_daily_event');
	error_log("CG Plugin deactivated at " . date('Y-m-d H:i:s', time()));

    // Optional: remove temporary data
    // delete_option('testplugin_installed_time');
}
register_deactivation_hook(
	__FILE__, 
	'cg_deactivate'
);

require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . "admin/settings-page.php";

