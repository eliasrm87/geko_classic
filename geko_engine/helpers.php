<?php

function geko_paging_nav()
{
    if (is_singular()) {
        return;
    }
    global $wp_query;
    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1) {
        return;
    }
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);
    /** Add current page to the array */
    if ($paged >= 1) {
        $links[] = $paged;
    }
    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '<div class="pagination_wrapper text-center"><ul class="pagination">' . "\n";
    /** Previous Post Link */
    if (get_previous_posts_link()) {
        printf('<li>%s</li>' . "\n", get_previous_posts_link("<<"));
    }
    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="first active"' : ' class="first"';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');
        if (!in_array(2, $links)) {
            echo '<li><span class="btn disabled">...</span></li>' . "\n";
        }
    }
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="last active"' : ' class="last"';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }
    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) {
            echo '<li><span class="btn disabled">...</span></li>' . "\n";
        }
        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }
    /** Next Post Link */
    if (get_next_posts_link()) {
        printf('<li>%s</li>' . "\n", get_next_posts_link(">>"));
    }
    echo '</ul></div>' . "\n";
}

function AutoThreeCols($col1, $col2, $col3, $row = true)
{
    $col1_active  = is_active_sidebar($col1);
    $col2_active  = is_active_sidebar($col2);
    $col3_active  = is_active_sidebar($col3);
    
    if ($row && ($col1_active || $col2_active || $col3_active))
        echo '<div class="row">';
    
    if ($col1_active && $col2_active && $col3_active) {
        echo '<div id="' . $col1 . '" class="xcol col-lg-4 col-md-4 col-sm-12 col-xs-12">';
        dynamic_sidebar($col1);
        echo '</div>';
        echo '<div id="' . $col2 . '" class="xcol col-lg-4 col-md-4 col-sm-12 col-xs-12">';
        dynamic_sidebar($col2);
        echo '</div>';
        echo '<div id="' . $col3 . '" class="xcol col-lg-4 col-md-4 col-sm-12 col-xs-12">';
        dynamic_sidebar($col3);
        echo '</div>';
    } elseif ($col1_active && $col2_active) {
        echo '<div id="' . $col1 . '" class="xcol col-lg-6 col-md-6 col-sm-12 col-xs-12">';
        dynamic_sidebar($col1);
        echo '</div>';
        echo '<div id="' . $col2 . '" class="xcol col-lg-6 col-md-6 col-sm-12 col-xs-12">';
        dynamic_sidebar($col2);
        echo '</div>';
    } elseif ($col1_active && $col3_active) {
        echo '<div id="' . $col1 . '" class="xcol col-lg-4 col-md-4 col-sm-12 col-xs-12">';
        dynamic_sidebar($col1);
        echo '</div>';
        echo '<div id="' . $col2 . '" class="xcol col-lg-8 col-md-8 col-sm-12 col-xs-12">';
        dynamic_sidebar($col3);
        echo '</div>';
    } elseif ($col2_active && $col3_active) {
        echo '<div id="' . $col2 . '" class="xcol col-lg-8 col-md-8 col-sm-12 col-xs-12">';
        dynamic_sidebar($col2);
        echo '</div>';
        echo '<div id="' . $col3 . '" class="xcol col-lg-4 col-md-4 col-sm-12 col-xs-12">';
        dynamic_sidebar($col3);
        echo '</div>';
    } elseif ($col1_active) {
        echo '<div id="' . $col1 . '" class="xcol col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        dynamic_sidebar($col1);
        echo '</div>';
    } elseif ($col2_active) {
        echo '<div id="' . $col2 . '" class="xcol col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        dynamic_sidebar($col2);
        echo '</div>';
    } elseif ($col3_active) {
        echo '<div id="' . $col3 . '" class="xcol col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        dynamic_sidebar($col3);
        echo '</div>';
    } else {
        return;
    }
    if ($row && ($col1_active || $col2_active || $col3_active || $col12_active || $col23_active))
        echo '</div>';
}

function geko_register_sidebar_3($name, $id, $n, $props) {
    for ($i = 1; $i <= $n; $i++) {
        $fid = $id . $i;
        $fname = $name . " " . $i;
        register_sidebar(array_merge(array('name' => $fname, 'id' => $fid), $props));
    }
}

function geko_add_section($wp_customize, $section_id, $section_name) {
    $wp_customize->add_section( 'geko_' . $section_id, array(
        'title'          => __( $section_name, 'geko' ),
//         'priority'   => 30,
    ) );
}

function geko_add_option($wp_customize, $section_id, $setting_id, $setting_name, $control_type = 'text', $choices = array(), $setting_type = "option") {
    $section_id = 'geko_' . $section_id;
    $setting_id = 'geko_' . $setting_id;
    
    if (empty($choices)) {
        $default = '';
    } else {
        $default = $choices[0];
    }
    
    $wp_customize->add_setting($setting_id, array(
        'default'        => $default,
        'capability'     => 'edit_theme_options',
        'type'           => $setting_type, //option for get_option(), theme_mod for get_theme_mod()
    ) );
    
    $wp_customize->add_control( $setting_id, array(
        'label'      => __( $setting_name, 'geko' ),
        'section'    => $section_id,
        'settings'   => $setting_id,
        'type'       => $control_type,
        'choices'    => $choices,
    ) );
}
