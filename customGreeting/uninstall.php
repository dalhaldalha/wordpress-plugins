<?php

if (! defined('ABSPATH')){
    exit;
}

//Delete the plugin options upon unistall
delete_option('cg_options');
delete_site_option('cg_options');