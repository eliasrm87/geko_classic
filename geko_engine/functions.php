<?php

function geko_engine_setup()
{
    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');
    
    // Switches default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );
}
add_action('after_setup_theme', 'geko_engine_setup');

//eliminar codigo basura de cabecera
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

//Automatically move JavaScript code to page footer, speeding up page loading time.
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);

function geko_new_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'geko_new_excerpt_more');

function geko_custom_excerpt_length($length)
{
    return 80;
}
add_filter('excerpt_length', 'geko_custom_excerpt_length', 999);

//desactivar pings propios
function geko_disable_self_pings(&$links)
{
    foreach ($links as $l => $link)
        if (0 === strpos($link, home_url()))
            unset($links[$l]);
}
add_action('pre_ping', 'geko_disable_self_pings');

//generar metadescription articulos
function geko_generate_metadescriptoons()
{
    global $post;
    if (!is_single()) {
        return;
    }
    $meta = strip_tags($post->post_content);
    $meta = strip_shortcodes($post->post_content);
    $meta = str_replace(array(
        "\n",
        "\r",
        "\t"
    ), ' ', $meta);
    $meta = substr($meta, 0, 125);
    echo "<meta name='description' content='$meta' />";
}
add_action('wp_head', 'geko_generate_metadescriptoons');

//Retrasar publicacion de articulos en rss
function geko_delay_rss($where)
{
    global $wpdb;
    if (is_feed()) {
        $now    = gmdate('Y-m-d H:i:s');
        $wait   = '10'; // Valor en minutos del retraso de los articulos
        $device = 'MINUTE'; //MINUTE, HOUR, DAY, WEEK, MONTH, YEAR
        $where .= " AND TIMESTAMPDIFF($device, $wpdb->posts.post_date_gmt, '$now') > $wait ";
    }
    return $where;
}
add_filter('posts_where', 'geko_delay_rss');

//Activar todos los botones del editor
function geko_show_al_mcel_buttons($buttons)
{
    $buttons[] = 'fontselect'; //Selector de tipo de fuente
    $buttons[] = 'fontsizeselect'; //Selector de tamaño de fuente
    $buttons[] = 'styleselect'; //Selector de estilos de párrafo mucho más amplio
    $buttons[] = 'backcolor'; //Color de fondo de párrafo
    $buttons[] = 'newdocument'; //Nuevo documento inline
    $buttons[] = 'cut'; //Cortar texto
    $buttons[] = 'copy'; //Copiar texto
    $buttons[] = 'charmap'; //Mapa de caracteres
    $buttons[] = 'hr'; //Línea horizontal
    $buttons[] = 'visualaid'; //Ayudas visuales del editor
    $buttons[] = 'sub';
    $buttons[] = 'sup';
    $buttons[] = 'cleanup';
    
    return $buttons;
}
add_filter("mce_buttons_3", "geko_show_al_mcel_buttons");


//Eliminar cadena de consulta archivos estaticos
function geko_remove_script_version($src)
{
    $parts = explode('?', $src);
    return $parts[0];
}
add_filter('script_loader_src', 'geko_remove_script_version', 15, 1);
add_filter('style_loader_src', 'geko_remove_script_version', 15, 1);
