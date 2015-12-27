<?php

function customize_register($wp_customize) {
    geko_add_section($wp_customize, 'general', __('Main', 'geko'));
    geko_add_option($wp_customize,  'general', 'content_width_style', __('Content width style:', 'geko'), 'select', array('container-fluid'  => 'fluid', 'container' => 'default',));
    geko_add_option($wp_customize,  'general', 'front_end_show_edit', __('Show edit link on posts and pages:', 'geko'), 'select', array('yes'  => 'yes', 'no' => 'no',));
    geko_add_option($wp_customize,  'general', 'enable_lazy_load', __('Enable lazy load:', 'geko'), 'select', array('yes'  => 'yes', 'no' => 'no',));

    geko_add_section($wp_customize, 'head', __('Head tags', 'geko'));
    geko_add_option($wp_customize,  'head', 'keywords', __('Keywords:', 'geko'));
    geko_add_option($wp_customize,  'head', 'custom_head_tags', __('Custom tags:', 'geko'), 'textarea');
    
    geko_add_section($wp_customize, 'top', __('Top', 'geko'));
    geko_add_option($wp_customize,  'top', 'show_top_123', __('Show Top1, Top2 and Top3:', 'geko'), 'select', array('yes'  => 'yes', 'no' => 'no',));
    geko_add_option($wp_customize,  'top', 'top_123_height', __('Top1, Top2 and Top3 height:', 'geko'));
    
    geko_add_section($wp_customize, 'navbar', __('Nav bar', 'geko'));
    geko_add_option($wp_customize,  'navbar', 'navbar_style', __('Nav bar style:', 'geko'), 'select', array('inverse'  => 'inverse', 'default' => 'default',));
    
    geko_add_section($wp_customize, 'posts', __('Posts', 'geko'));
    geko_add_option($wp_customize,  'posts', 'show_posts_author', __('Show posts author:', 'geko'), 'select', array('yes'  => 'yes', 'no' => 'no',));
    
    geko_add_section($wp_customize, 'comments', __('Comments', 'geko'));
    geko_add_option($wp_customize,  'comments', 'comment_policy', __('Comment policy text:', 'geko'), 'textarea');
    
    geko_add_section($wp_customize, 'pages', __('Pages', 'geko'));
    geko_add_option($wp_customize,  'pages', 'show_pages_author', __('Show pages author:', 'geko'), 'select', array('yes'  => 'yes', 'no' => 'no',));
    geko_add_option($wp_customize,  'pages', 'show_home_page_title', __('Show home page title:', 'geko'), 'select', array('yes'  => 'yes', 'no' => 'no',));
    
    geko_add_section($wp_customize, 'footer', __('Footer', 'geko'));
    geko_add_option($wp_customize,  'footer', 'copyright_year', __('Copyright year:', 'geko'));
    geko_add_option($wp_customize,  'footer', 'copyright_text', __('Copyright text:', 'geko'), 'textarea');
    
    geko_add_section($wp_customize, 'social', __('Social', 'geko'));
    geko_add_option($wp_customize,  'social', 'twitter_user_name', __('Twitter user name:', 'geko'));
}
add_action( 'customize_register', 'customize_register' );
