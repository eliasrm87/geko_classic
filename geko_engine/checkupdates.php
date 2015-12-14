<?php

// set_site_transient('update_themes', null);

function geko_check_update( $transient ) {
    if ( empty( $transient->checked ) ) {
        return $transient;
    }

    $theme_data = wp_get_theme();
    $theme_slug = $theme_data->get_template();
    
    $result = json_decode(wp_remote_get("http://linuxgnublog.org/update.json")['body'], true);
    
    if (version_compare($theme_data->version, $result['new_version'], '<')) {
        $transient->response[$theme_slug] = array(
            'theme'       => $theme_slug,
            'new_version' => $result['new_version'],
            'url'         => $result['url'],
            'package'     => $result['package'],
        );
    }
        
    return $transient;
}

// add_filter( 'pre_set_site_transient_update_themes', 'geko_check_update' );
