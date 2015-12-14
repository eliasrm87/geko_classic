<?php

require_once('geko_engine/engine.php');
require_once('settings.php');


function geko_setup()
{
    // This theme uses wp_nav_menu() in two locations.
    register_nav_menu('primary', __('Primary Navigation Menu', 'geko'));
    
    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150);
}
add_action('after_setup_theme', 'geko_setup');

function theme_styles()
{
    wp_enqueue_style('jquery_smartmenus_bootstrap_style', get_template_directory_uri() . '/css/jquery.smartmenus.bootstrap.css', array(), null, 'all');
}
add_action('wp_enqueue_scripts', 'theme_styles');

function theme_scripts()
{
    wp_enqueue_script('bootstrap', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js", array('jquery'), '', true);
    if (get_option('geko_enable_lazy_load') == "yes") {
        wp_enqueue_script('jquery_lazy_load', get_template_directory_uri() . '/js/jquery.lazyload.min.js', array('jquery'), '', true);
    }
//     wp_enqueue_script('jquery_easypiechart', get_template_directory_uri() . '/js/jquery.easypiechart.min.js', array('jquery'), '', true);
//     wp_enqueue_script('jquery_waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery_smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery_smartmenus_bootstrap', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.min.js', array('jquery'), '', true);

}
add_action('wp_enqueue_scripts', 'theme_scripts');

function widgets_init()
{
    $props = array(
        'description' => '',
        'class' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    );
    
    geko_register_sidebar_3("Top", "top", 3, $props);
    
    register_sidebar(array_merge(array('name' => 'Left',  'id' => 'left'), $props));
    register_sidebar(array_merge(array('name' => 'Right', 'id' => 'right'), $props));
    
    geko_register_sidebar_3("Footer", "footer", 3, $props);
    
    register_sidebar(array_merge(array('name'=>"Float top center",    'id'=>"float-top-center"), $props));
    register_sidebar(array_merge(array('name'=>"Float right center",  'id'=>"float-right-center"), $props));
    register_sidebar(array_merge(array('name'=>"Float bottom center", 'id'=>"float-bottom-center"), $props));
    register_sidebar(array_merge(array('name'=>"Float left center",   'id'=>"float-left-center"), $props));
    
}
add_action('widgets_init', 'widgets_init');

function custom_head_tags()
{
    echo get_option('geko_custom_head_tags', '');
}
add_action( 'wp_head', 'custom_head_tags');

//Eliminar barra admin wp
add_filter( 'show_admin_bar', '__return_false' );

//Lazy load
function filter_lazy_load($content)
{
    return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'preg_replace_lazy_load', $content);
}

function preg_replace_lazy_load($matches)
{
    // alter original img tag:
    // - add empty class attribute if no existing class attribute
    // - set src to placeholder image
    // - add back original src attribute, but rename it to "data-original"
    $replacement = $matches[1] . 'class="" src="' . '/wp-content/themes/geko_v0/img/grey.gif' . '" data-original' . substr($matches[2], 3) . $matches[3];
    
    // add "lazy" class to existing class attribute
    $replacement = preg_replace('/class\s*=\s*"/i', 'class="lazy ', $replacement);
    
    // add noscript fallback with original img tag inside
    $replacement .= '<noscript>' . $matches[0] . '</noscript>';
    return $replacement;
}

if (get_option('geko_enable_lazy_load') == "yes") {
    add_filter('the_content', 'filter_lazy_load');
    add_filter('wp_get_attachment_link', 'filter_lazy_load');
    add_filter('post_thumbnail_html', 'filter_lazy_load');
    add_filter('get_avatar', 'filter_lazy_load');
    add_filter('widget_text', 'filter_lazy_load');
}
