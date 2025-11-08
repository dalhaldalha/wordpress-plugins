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
define( 'CG_PLUGIN_URL', plugin_dir_url(__FILE__));
define( 'CG_OPTION_NAME', 'cg_options');

// Activation Hook
function cg_activate() {

    // Set default options
    $defaults = array(
        'greeting_text' => 'Welcom to my site!',
        'position' => 'top',
        'enabled' => 1,
    );

    // checks if the option already exists in the database
    if ( false === get_option(CG_OPTION_NAME)) {
        add_option(CG_OPTION_NAME, $defaults);
    } else {
        // Retreives options and merges with defaults then updates
        $opts = get_option(CG_OPTION_NAME, array());
        $opts = wp_parse_args( $opts, $defaults );
        update_option(CG_OPtion_NAME, $opts);
    }

    //Logs date and time of activation
	error_log("CG Plugin activated at " . date('Y-m-d H:i:s', time()));
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

