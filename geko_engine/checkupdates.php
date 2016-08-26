<?php

// set_site_transient('update_themes', null);

function geko_check_update( $transient ) {
    if ( empty( $transient->checked ) ) {
        return $transient;
    }

    $theme_data = wp_get_theme(wp_get_theme()->template);
    $theme_slug = $theme_data->get_template();
    //Delete '-master' from the end of slug
    $theme_uri_slug = preg_replace('/-master$/', '', $theme_slug);

    $remote_version = '0.0.0';
    $style_css = wp_remote_get("https://raw.githubusercontent.com/erm2587/".$theme_uri_slug."/master/style.css")['body'];
    if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( 'Version', '/' ) . ':(.*)$/mi', $style_css, $match ) && $match[1] )
        $remote_version = _cleanup_header_comment( $match[1] );

    if (version_compare($theme_data->version, $remote_version, '<')) {
        $transient->response[$theme_slug] = array(
            'theme'       => $theme_slug,
            'new_version' => $remote_version,
            'url'         => 'https://github.com/erm2587/'.$theme_uri_slug,
            'package'     => 'https://github.com/erm2587/'.$theme_uri_slug.'/archive/master.zip',
        );
    }

    return $transient;
}

add_filter( 'pre_set_site_transient_update_themes', 'geko_check_update' );
