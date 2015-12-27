 <?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

        <?php
        if ( comments_open()) {
            $comment_policy = get_option('geko_comment_policy');
            if ($comment_policy != '') {
                echo $comment_policy;
            }
        }
        ?>

	<?php if ( have_comments() ) : ?>   
           
            <h4 class="comments-title">
                    <?php
                            printf( _nx( 'Una respuesta para &ldquo;%2$s&rdquo;', '%1$s respuestas para &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'geko' ),
                                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                    ?>
            </h4>

            <div class="comment-list">
                <?php
                    $args = array(
                        'walker'            => new Bootstrap_Comment_Walker(),
                        'max_depth'         => '',
                        'style'             => 'div',
                        'callback'          => null,
                        'end-callback'      => null,
                        'type'              => 'all',
//                                     'reply_text'        => null,
                        'page'              => '',
                        'per_page'          => '',
                        'avatar_size'       => 48,
                        'reverse_top_level' => null,
                        'reverse_children'  => '',
                        'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
                        'short_ping'        => false,   // @since 3.6
                        'echo'              => true     // boolean, default is true
                    );
                    wp_list_comments($args);
                ?>
            </div><!-- .comment-list -->

            <?php
                // Are there comments to navigate through?
                if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
                <nav class="navigation comment-navigation" role="navigation">
                    <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'geko' ); ?></h1>
                    <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'geko' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'geko' ) ); ?></div>
                </nav><!-- .comment-navigation -->
            <?php endif; // Check for comment navigation ?>

            <?php if ( ! comments_open() && get_comments_number() ) : ?>
                <p class="no-comments"><?php _e( 'Comments are closed.' , 'geko' ); ?></p>
            <?php endif; ?>
	<?php endif; // have_comments() ?>

        <?php
            ob_start();
            comment_form();
            $string = str_replace('class="comment-form"', 'class="form-horizontal"', ob_get_contents());
            $string = str_replace('id="comment"', 'id="comment" class="form-control"', $string);
            $string = str_replace('id="author"', 'id="author" class="form-control"', $string);
            $string = str_replace('id="email"', 'id="email" class="form-control"', $string);
            $string = str_replace('id="url"', 'id="url" class="form-control"', $string);
            $string = str_replace('<input name="submit"', '<input class="btn btn-default" name="submit" ', $string);
            ob_end_clean();

            // submit
            echo $string;
        ?>
	
</div><!-- #comments -->
