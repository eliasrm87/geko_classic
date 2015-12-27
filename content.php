<?php if (is_singular()): ?>
<article id="post-<?php the_ID(); ?>" <?php post_class("singular"); ?>>
<?php else: ?>
<article id="post-<?php the_ID(); ?>" <?php post_class("list"); ?>>
<?php endif; ?>
    <header class="entry-header">
        <?php if ( is_singular() ): ?>
            <meta property="og:title" content="<?php bloginfo( 'title' ); ?>" />   
            <meta property="og:description" content="<?php echo esc_attr(strip_tags(get_the_excerpt())); ?>" />
            <meta name="twitter:title" content="<?php the_title(); ?>" />
            <meta name="twitter:description" content="<?php echo esc_attr(strip_tags(get_the_excerpt())); ?>" />
            <meta name="twitter:image" content="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' )[0]; ?>" />
        <?php endif; ?>
        <?php if (!is_front_page() || (get_option('geko_show_home_page_title') == "yes")) : ?>
            <div class="title">
                <?php
                if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
                    echo '<div class="date">'.
                    '<span class="month">'.get_the_date("M").'</span>'.
                    '<span class="day">'.get_the_date("d").'</span>'.
                    '<span class="year">'.get_the_date("Y").'</span>'.
                    '</div>';
                ?>
            
                <h2>
                <?php if ( is_single() ) : ?>
                    <?php the_title(); ?>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                <?php endif; ?>
                </h2>
                <?php 
                    if (get_option('geko_front_end_show_edit') == "yes") {
                        edit_post_link( __( 'Edit', 'geko' ), '<div class="edit-link"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ', '</div>' );
                    }
                ?>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
        
        <div class="clear"></div>
        
    </header>

    <?php if ( is_single() ||  is_page() ) : ?>
        <div class="entry-content">
            <?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'geko' ) ); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'geko' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        </div><!-- .entry-content -->
    <?php else : ?>
        <div class="entry-summary">
            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
            <?php endif; ?>
            <?php the_excerpt(); ?>
            <div class="clear"></div>
        </div><!-- .entry-summary -->
    <?php endif; ?>

    <div class="clear"></div>
    
    <div class="entry-meta">
        <div>
            <div class="comments-link">
                <?php  if ( comments_open() && ! is_single() ) : ?>
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    <?php comments_popup_link(__( '0', 'geko' ), __( '1', 'geko' ), __( '%', 'geko' ) ); ?>
                <?php endif; ?>
            </div>
            <?php if ( get_the_category_list() ) : ?>
                <div class="categories-links">
                    <?php echo get_the_category_list(', ') ?>
                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                </div>
            <?php endif; ?>
        </div>
        <div>
            <div class="author-link">
                <?php if ( (is_page() && get_option('geko_show_pages_author') == "yes") || (!is_page() && get_option('geko_show_posts_author') == "yes") ) : ?>
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php the_author_posts_link(); ?>
                <?php endif; ?>
            </div>
            <div class="tags-link">
                <?php the_tags('', ', ', ''); ?>
                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            </div>
        </div>
        <div class="clear"></div>
    </div><!-- .entry-meta -->
    <?php comments_template(); ?>
</article><!-- #post -->
