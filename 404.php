<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
//status_header(404);
get_header(); ?>


    <div class="band" id="content">
        <div class="container group" style="text-align:center">

            <h1><?php _e( 'Not Found', 'twentyten' ); ?></h1>
            <img src="https://fliplet.com/wp-content/uploads/2018/02/404Image-1.png"   class="img-responsive" style="margin:0 auto;width:400px;"/>
            
              <a href="https://fliplet.com/"><button>Go to homepage</button></a>
            

            <script type="text/javascript">
                // focus on search field after it has loaded
                document.getElementById('s') && document.getElementById('s').focus();
            </script>
        </div>
    </div>

<?php get_footer(); ?>