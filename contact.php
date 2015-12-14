<?php
/*
Template Name: Contacto
*/
?>
<?php get_header(); ?>
<div class="pagina">
      <?php AutoThreeCols ("user1", "user2", "user3", "user1-2", "user2-3", 4, 4, 4, true); ?>
      <?php AutoThreeCols ("user4", "user5", "user6", "user4-5", "user5-6", 4, 4, 4, true); ?>
      <?php AutoThreeCols ("user7", "user8", "user9", "user7-8", "user8-9", 4, 4, 4, true); ?>

      <?php
         $left_active = is_active_sidebar('left');
         $right_active = is_active_sidebar('right');
      ?>
      
      <div class="row">
      
         <?php if ( $left_active ) : ?>
         <div id="left" class="xcol col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <ul>
               <?php dynamic_sidebar("left"); ?>
            </ul>
         </div>
         <?php endif; ?>
         
         
         <?php if ( $left_active && $right_active ) : ?>
            <div id="content" class="xcol col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <?php elseif ( $left_active || $right_active ) : ?>
            <div id="content" class="xcol col-lg-9 col-md-9 col-sm-12 col-xs-12">
         <?php else : ?>
            <div id="content" class="xcol col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <?php endif; ?>
         
         <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
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
                  
                  <div class="clear"></div>
               </div>
               
               <?php edit_post_link( __( 'Editar', 'igk_rwd' ), '<div class="edit-link"><i class="icon-pencil"></i> ', '</div>' ); ?>
               
               <div class="clear"></div>
               
            </header>
            
            <div class="entry-content">
               <?php the_post(); the_content( __( 'Continuar leyendo <span class="meta-nav">&rarr;</span>', 'igk_rwd' ) ); ?>
               <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Páginas:', 'igk_rwd' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
            </div><!-- .entry-content -->
            
            <?php
            $num1 = rand(1, 5);
            $num3 = rand(6, 10);
            if($_POST[sent]){
               $error = "";
               if(!trim($_POST[tu_nombre])){
                  $error .= "<li>No has indicado tu nombre...</li>";
               }
               if(!filter_var(trim($_POST[tu_email]),FILTER_VALIDATE_EMAIL)){
                  $error .= "<li>El email no es válido...</li>";
               }
               if(!trim($_POST[tu_mensaje])){
                  $error .= "<li>Olvidaste el mensaje...</li>";
               }
               if(($_POST[anti_spam] + $_POST[num1]) != $_POST[num3]){
                  $error .= "<li>No has respondido la pregunta de seguridad correctamente...</li>";
               }
               if(!$error){
                  $email = wp_mail(get_option("admin_email"),trim($_POST[tu_nombre])." le ha enviado un mensaje desde ".get_option("blogname"),stripslashes(trim($_POST[tu_mensaje])),"De: ".trim($_POST[tu_nombre])." <".trim($_POST[tu_email]).">\r\nReply-To:".trim($_POST[tu_email]));
               }
            }
            if($email){ ?>
            <p class="bg-success"><strong>Mensaje enviado. Te responderemos lo antes posible</strong></p>
            <?php } else { if($error) { ?>
            <div class="bg-danger"><strong>Tu mensaje no ha sido enviado por las siguientes razones:</strong><br/>
            <?php echo "<ul>" . $error . "</ul></div>"; } ?>
            <form role="form" action="<?php the_permalink(); ?>" id="contacto" method="post">
            <div class="form-group">
               <label for="tu_nombre">Nombre (requerido)</label>
               <input type="text" class="form-control" id="tu_nombre" name="tu_nombre" placeholder="Escribe tu nombre" value="<?php echo $_POST[tu_nombre];?>" />
            </div>
            <div class="form-group">
               <label for="tu_email">Email (requerido)</label>
               <input type="email" class="form-control" id="tu_email" name="tu_email" placeholder="Escribe tu email" value="<?php echo $_POST[tu_email];?>" />
            </div>
            <div class="form-group">
               <label for="el_asunto">Asunto</label>
               <input type="text" class="form-control" id="el_asunto" name="el_asunto" placeholder="Pon un asunto" value="<?php echo $_POST[el_asunto];?>" />
            </div>
            <div class="form-group">
               <label for="tu_mensaje">Tu mensaje (requerido)</label>
               <textarea class="form-control" id="tu_mensaje" name="tu_mensaje" rows="3"><?php echo stripslashes($_POST[tu_mensaje]); ?></textarea>
            </div>
            <div class="form-group">
               <label for="anti_spam">&iquest;Cu&aacute;nto hay que sumarle a <?php echo $num1; ?> para obtener <?php echo $num3; ?>? (requerido)</label>
               <input type="text" class="form-control" id="anti_spam" name="anti_spam" placeholder="Pista: <?php echo $num3; ?> menos <?php echo $num1; ?>" />
            </div>
            <input type="hidden" name="sent" id="sent" value="1" />
            <input type="hidden" name="num1" id="num1" value="<?php echo $num1; ?>" />
            <input type="hidden" name="num3" id="num3" value="<?php echo $num3; ?>" />
            <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            <?php } ?>
            
         </article><!-- #post -->
            
         </div>
         
         <?php if ( $right_active ) : ?>
         <div id="right" class="xcol col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <ul>
               <?php dynamic_sidebar("right"); ?>
            </ul>
         </div>
         <?php endif; ?>
      
      </div>
      
      <?php AutoThreeCols ("user10", "user11", "user12", "user10-11", "user11-12", 4, 4, 4, true); ?>
      <?php AutoThreeCols ("user13", "user14", "user15", "user13-14", "user14-15", 4, 4, 4, true); ?>
      <?php AutoThreeCols ("user16", "user17", "user18", "user16-17", "user17-18", 4, 4, 4, true); ?>

</div>
<?php get_footer(); ?>
