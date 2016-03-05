<?php
?>
        </div><!-- #container -->
   <footer id="footer">
      <?php AutoThreeCols ("footer1", "footer2", "footer3", true); ?>
      <div class="copyright">
         <p><?php echo get_option('geko_copyright_year', '') . ' - ' . date("Y") . ' | ' . get_bloginfo('name') . get_option('geko_copyright_text', ''); ?>
      </div>
   </footer>

    <?php
        wp_footer();
    ?>

    <script>
//     <![CDATA[
        <?php if (get_option('geko_enable_lazy_load') == "yes"): ?>
            jQuery("img.lazy").show().lazyload({
                effect: "fadeIn",
                failure_limit: 10
            });
        <?php endif; ?>

        jQuery("a[href^='#scroll_']").on('click', function(e) {
            // prevent default anchor click behavior
            e.preventDefault();

            // store hash
            var hash = this.hash;

            // animate
            jQuery('html, body').animate({
                scrollTop: jQuery(this.hash.replace("#scroll_", "#")).offset().top - 70
            }, 600, function() {
                // when done, add hash to url
                // (default click behaviour)
                //window.location.hash = hash;
            });
        });

        jQuery('article.post.list').each(function(){
            jQuery(this).click(function(){
                window.location.href = jQuery(this).find('h2 a:first').attr('href');
            });
        });

        jQuery(document).ready(function() {
            var docHeight = jQuery(window).height();
            var footerBot = jQuery('#footer').position().top + jQuery('#footer').outerHeight();
            var pageHeigth = jQuery('.pagina').outerHeight();

            if (footerBot < docHeight) {
                jQuery('.pagina').css('min-height', pageHeigth + (docHeight - footerBot) + 'px');
            }
        });
//     ]]>
    </script>


</body>
</html>
