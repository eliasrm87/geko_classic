<?php get_header(); ?>
<div class="pagina">
      <?php
         $left_active = is_active_sidebar('left');
         $right_active = is_active_sidebar('right');
      ?>
      
      <div class="row">
      
         <?php if ( $left_active ) : ?>
         <div id="left" class="xcol col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?php dynamic_sidebar("left"); ?>
         </div>
         <?php endif; ?>
         
         
         <?php if ( $left_active && $right_active ) : ?>
            <div id="content" class="xcol col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <?php elseif ( $left_active || $right_active ) : ?>
            <div id="content" class="xcol col-lg-9 col-md-9 col-sm-12 col-xs-12">
         <?php else : ?>
            <div id="content" class="xcol col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <?php endif; ?>
         
         <?php if ( have_posts() ) : ?>

            <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
               <?php get_template_part( 'content', get_post_format() ); ?>
            <?php endwhile; ?>

            <?php geko_paging_nav(); ?>

         <?php else : ?>
            <?php get_template_part( 'content', 'none' ); ?>
         <?php endif; ?>
         
         </div>
         
         <?php if ( $right_active ) : ?>
         <div id="right" class="xcol col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?php dynamic_sidebar("right"); ?>
         </div>
         <?php endif; ?>
      
      </div>
      
      <?php if (is_active_sidebar("float-top-center")) : ?>
        <div class="float top-center">
            <?php dynamic_sidebar("float-top-center"); ?>
        </div>
      <?php endif; ?>
      <?php if (is_active_sidebar("float-right-center")) : ?>
        <div class="float right-center">
            <?php dynamic_sidebar("float-right-center"); ?>
        </div>
      <?php endif; ?>
            <?php if (is_active_sidebar("float-bottom-center")) : ?>
        <div class="float bottom-center">
            <?php dynamic_sidebar("float-bottom-center"); ?>
        </div>
      <?php endif; ?>
            <?php if (is_active_sidebar("float-left-center")) : ?>
        <div class="float left-center">
            <?php dynamic_sidebar("float-left-center"); ?>
        </div>
      <?php endif; ?>

</div>
<?php get_footer(); ?>