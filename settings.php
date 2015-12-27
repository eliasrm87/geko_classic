<?php

function customize_register($wp_customize) {
    geko_add_section($wp_customize, 'general', 'General');
    geko_add_option($wp_customize,  'general', 'content_width_style', 'Content width style:', 'select', array('container-fluid'  => 'fluid', 'container' => 'default',));
    geko_add_option($wp_customize,  'general', 'front_end_show_edit', 'Show edit link on posts and pages:', 'select', array('yes'  => 'yes', 'no' => 'no',));
    geko_add_option($wp_customize,  'general', 'enable_lazy_load', 'Enable lazy load:', 'select', array('yes'  => 'yes', 'no' => 'no',));

    geko_add_section($wp_customize, 'head', 'Head tags');
    geko_add_option($wp_customize,  'head', 'keywords',         'Keywords:');
    geko_add_option($wp_customize,  'head', 'custom_head_tags', 'Custom tags:', 'textarea');
    
    geko_add_section($wp_customize, 'top', 'Top');
    geko_add_option($wp_customize,  'top', 'show_top_123', 'Show Top1, Top2 and Top3:', 'select', array('yes'  => 'yes', 'no' => 'no',));
    geko_add_option($wp_customize,  'top', 'top_123_height', 'Top1, Top2 and Top3 height:');
    
    geko_add_section($wp_customize, 'navbar', 'Nav bar');
    geko_add_option($wp_customize,  'navbar', 'navbar_style', 'Nav bar style:', 'select', array('inverse'  => 'inverse', 'default' => 'default',));
    
    geko_add_section($wp_customize, 'posts', 'Posts');
    geko_add_option($wp_customize,  'posts', 'show_posts_author', 'Show posts author:', 'select', array('yes'  => 'yes', 'no' => 'no',));
    
    geko_add_section($wp_customize, 'comments', 'Comments');
    geko_add_option($wp_customize,  'comments', 'comment_policy', 'Comment policy text:', 'textarea');
    
    geko_add_section($wp_customize, 'pages', 'Pages');
    geko_add_option($wp_customize,  'pages', 'show_pages_author', 'Show pages author:', 'select', array('yes'  => 'yes', 'no' => 'no',));
    geko_add_option($wp_customize,  'pages', 'show_home_page_title', 'Show home page title:', 'select', array('yes'  => 'yes', 'no' => 'no',));
    
    geko_add_section($wp_customize, 'footer', 'Footer');
    geko_add_option($wp_customize,  'footer', 'copyright_year', 'Copyright year:');
    geko_add_option($wp_customize,  'footer', 'copyright_text', 'Copyright text:', 'textarea');
    
    geko_add_section($wp_customize, 'social', 'Social');
    geko_add_option($wp_customize,  'social', 'twitter_user_name', 'Twitter user name:');
}
add_action( 'customize_register', 'customize_register' );
