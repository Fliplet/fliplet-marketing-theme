<footer>
  <div class="footer-column">
    <h3>Company</h3>
    <?php
      wp_nav_menu(
        array(
          'theme_location' => 'footer_menu_one',
          'menu_class' => 'footer-menu'
        )
      );
    ?>
  </div>
  <div class="footer-column">
    <h3>Product links</h3>
    <?php
      wp_nav_menu(
        array(
          'theme_location' => 'footer_menu_two',
          'menu_class' => 'footer-menu'
        )
      );
    ?>
  </div>
  <div class="footer-column">
    <h3>Resources</h3>
    <?php
      wp_nav_menu(
        array(
          'theme_location' => 'footer_menu_three',
          'menu_class' => 'footer-menu'
        )
      );
    ?>
  </div>
  <div class="footer-column last">
    <h3>Stay in touch</h3>
    <!-- <a href="/resources"><p style="margin-bottom: 10px;">Get our newsletter</p></a> -->

    <a class="social-ico" href="https://twitter.com/flipletapp" target="_blank" rel="noopener"><img class="size-full wp-image-32514" src="/wp-content/uploads/2017/02/Twitter.png" alt="twitter" width="25" height="24" /></a>
    <a class="social-ico" href="https://www.linkedin.com/company/flipletapps/" target="_blank"><img class="size-full wp-image-32517" src="/wp-content/uploads/2017/02/Linkedin.png" alt="Linkedin-1" width="25" height="24" /></a>
    <a class="social-ico" href="https://www.facebook.com/Fliplet" target="_blank" rel="noopener"><img class="size-full wp-image-32515" src="/wp-content/uploads/2017/02/Facebook.png" alt="FB" width="25" height="24" /></a>

  </div>
</footer>

	<?php
		/* Always have wp_footer() just before the closing </body>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to reference JavaScript files.
		 */

		wp_footer();

	?>

<?php /* Intercom setup */ ?>
  <script>
    window.intercomSettings = {
      app_id: "eo99qllm",
      horizontal_padding: 20,
      vertical_padding: 20,
      hide_default_launcher: false
    };
  </script>

  <script>
  // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/eo99qllm'
  (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/eo99qllm';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
  </script>

</body>
</html>
