<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<header class="page-header">
	<h2 class="page-title"><?php _e( 'No se ha encontrado nada.', 'igk_rwd' ); ?></h2>
</header>

<div class="page-content">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

    <p><?php printf( __( 'Listo para publicar tu primer post? <a href="%1$s">Empieza aquí</a>.', 'igk_rwd' ), admin_url( 'post-new.php' ) ); ?></p>

    <?php elseif ( is_search() ) : ?>

    <p><?php _e( 'Lo sentimos, pero nada coincide con tu búsqueda. Por favor, prueba de nuevo con diferentes palabras clave.', 'igk_rwd' ); ?></p>
    <?php get_search_form(); ?>

    <?php else : ?>

    <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'igk_rwd' ); ?></p>
    <?php get_search_form(); ?>

    <?php endif; ?>
</div><!-- .page-content -->