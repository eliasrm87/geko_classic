<?php

function add_youtube_button() {
    // Don't bother doing this stuff if the current user lacks permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
        return;

    // Add only in Rich Editor mode
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "add_youtube_tinymce_plugin");
        add_filter('mce_buttons', 'register_youtube_button');
    }
}

function register_youtube_button($buttons) {
    array_push($buttons, "|", "gekoyoutube");
    return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_youtube_tinymce_plugin($plugin_array) {
    $plugin_array['gekoyoutube'] = get_bloginfo('template_url').'/geko_engine/tinymce/js/gekoyoutube.js';
    return $plugin_array;
}

add_action('init', 'add_youtube_button');
