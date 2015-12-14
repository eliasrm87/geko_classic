<?php
?>
	</div><!-- #container -->
   <footer id="footer">
      <?php AutoThreeCols ("footer1", "footer2", "footer3", true); ?>
      <div class="copyright">
         <p><?php echo get_option('geko_copyright_year', '') . ' - ' . date("Y") . ' | ' . get_bloginfo('name') . get_option('geko_copyright_text', ''); ?>   
      </div> 
   </footer>
	
	<?php wp_footer(); ?>
	
<script>
// <![CDATA[
    <?php if (get_option('geko_enable_lazy_load') == "yes"): ?>
        jQuery("img.lazy").show().lazyload({
            effect: "fadeIn",
            failure_limit: 10
        });
    <?php endif; ?>

    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-44248276-1', 'auto');
    ga('send', 'pageview');

    jQuery("a[href^='#']").on('click', function(e) {
        // prevent default anchor click behavior
        e.preventDefault();

        // store hash
        var hash = this.hash;

        // animate
        jQuery('html, body').animate({
            scrollTop: jQuery(this.hash).offset().top - 70
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
    
//     jQuery('.chart').each(function(){
//         var chart = jQuery(this);
//         chart.waypoint(function(){
//             var barColor = chart.children(".percent").css('color');
//             chart.easyPieChart({
//                 size:120,
//                 animate: 2000,
//                 lineCap:'butt',
//                 scaleColor: false,
//                 barColor: barColor,
//                 lineWidth: 10,
//                 onStep: function(from, to, percent) {
//                     jQuery(this.el).find('.percent').text(Math.round(percent));
//                 }
//             });
//         },{offset:'80%'});
//     });

// ]]>
</script>


</body>
</html>