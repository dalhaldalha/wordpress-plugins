<?php

if (! defined('ABSPATH')){
    exit;
}

function cg_enqueue_assets() {
    wp_enqueue_style(
        'cg-style',
        CG_PLUGIN_URL . 'asssets/css/style.css'
    );
    wp_enqueue_script(
        'cg-script',
        CG_PLUGIN_URL . 'assets/js/script.js',
        array('jquery'),
        false,
        true
    );
}

add_action(wp_enqueue_scripts, 'cg_enqueue_assets');