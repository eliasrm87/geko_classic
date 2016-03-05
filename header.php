<!DOCTYPE html>
<html <?php language_attributes(); ?>>
      <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="description" content="<?php bloginfo( 'description' ); ?>">
      <meta name="keywords" content="<?php echo get_option('keywords', ''); ?>" />
      <meta property="og:locale" content="<?php echo get_locale() ?>" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="<?php echo get_site_url(); ?>" />
      <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
      <meta name="twitter:card" content="summary" />
      <meta name="twitter:site" content="<?php echo get_option('geko_twitter_user_name', ''); ?>" />
      <meta name="twitter:creator" content="<?php echo get_option('geko_twitter_user_name', ''); ?>" />
      <?php if ( !is_singular() ): ?>
      <meta name="twitter:description" content="<?php bloginfo( 'description' ); ?>">
      <?php endif; ?>
      <link rel="profile" href="http://gmpg.org/xfn/11">
      <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen">
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
      <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
      <?php wp_head(); ?>
   </head>
   <body <?php body_class(); ?>>
      <?php if (get_option('geko_show_top_123') == "yes"): ?>
      <div class="top" style="height: <?php echo get_option('geko_top_123_height') ?>px;">
         <div class="<?php echo get_option('geko_content_width_style') ?>">
            <?php AutoThreeCols ("top1", "top2", "top3", false); ?>
         </div>
      </div>
      <?php endif; ?>
      <div id="nav-wrapper" data-spy="affix" data-offset-top="<?php echo get_option('geko_top_123_height')+1 ?>">
         <nav class="navbar navbar-<?php echo get_option('geko_navbar_style') ?>" role="navigation">
            <div class="<?php echo get_option('geko_content_width_style') ?>">
               <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                </div>

               <?php
                     wp_nav_menu( array(
                        'menu'              => 'primary',
                        'theme_location'    => 'primary',
                        'depth'             => 3,
                        'container'         => 'div',
                        'container_class'   => 'navbar-collapse collapse',
                        'container_id'      => 'navbar-collapse-1',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                     );
               ?>
            </div>
         </nav>
      </div>

<!--        <div class="" style="height: <?php //echo get_option('top_123_height')+50; ?>px;"></div> -->
      <div class="<?php echo get_option('geko_content_width_style') ?>">
