<?php

function geko_engine_customize_register($wp_customize) {
    geko_add_section($wp_customize, 'google', __('Google analytics', 'geko'));
    geko_add_option($wp_customize,  'google', 'google_analytics_id', __('ID:', 'geko'));
}
add_action( 'customize_register', 'geko_engine_customize_register' );
