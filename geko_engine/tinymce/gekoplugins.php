<?php

add_action('init', function () {
    global $tinymce_geko_plugins;
    
//     // Locate plugins
//     $tinymce_geko_plugins = array();
//     $dir = dirname(__FILE__).'/js/';
//     $dir_strlen = strlen($dir);
//     $files = glob($dir.'*.{js}', GLOB_BRACE);
//     foreach($files as $file) {
//         array_push($tinymce_geko_plugins, substr($file, $dir_strlen, -3));
//     }
    
    $tinymce_geko_plugins = array('gekoyoutube', 'gekogrid', 'gekopagecontent', 'gekoalert', 'gekogallery', 'gekoimagebox');

    // Don't bother doing this stuff if the current user lacks permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
        return;

    // Add only in Rich Editor mode
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", function($plugin_array) {
            global $tinymce_geko_plugins;
            foreach ($tinymce_geko_plugins as $key => $value) {
                $plugin_array[$value] = get_template_directory_uri().'/geko_engine/tinymce/js/'.$value.'.js';
            }
            return $plugin_array;
        });
    }
    
    add_filter('mce_buttons', function ($buttons) {
        global $tinymce_geko_plugins;
        array_push($buttons, "|");
        $buttons = array_merge($buttons, $tinymce_geko_plugins);
        return $buttons;
    });
});


//Script to set variables for TinyMCE plugins (gekopagecontent)
function pagecontent_admin_head() {
    //All pages IDs and titles
    $pages_data = get_pages();
    $pages = "[";
    foreach ($pages_data as $page) {
        $pages .= "{text:'" . $page->post_title . "', value:'" . $page->ID . "'}, ";
    }
    //All posts IDs and titles
    $pages_data = get_posts();
    foreach ($pages_data as $page) {
        $pages .= "{text:'" . $page->post_title . "', value:'" . $page->ID . "'}, ";
    }
    $pages .= "]";
    ?>
    <!-- TinyMCE Shortcode GekoPageContent -->
    <script type='text/javascript'>
        var geko_pagecontent_ids = <?php echo $pages; ?>;
    </script>
    <!-- TinyMCE Shortcode GekoPageContent -->
    <?php
}
add_action( "admin_head-post-new.php", 'pagecontent_admin_head' );
add_action( "admin_head-post.php", 'pagecontent_admin_head' );