<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xyz-template
 */

?>

	

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="social-icons">
			 <?php
			 wp_nav_menu( array( 'theme_location' => 'new-menu' ) );
			 ?>
            </ul>
          </div>
          <div class="col-lg-12">
            <div class="copyright-text">
              <?php echo printf( esc_html__( 'Theme: %1$s by %2$s.', 'xyz-template' ), 'xyz-template', '<a href="http://underscores.me/">Underscores.me</a>' );?>
            </div>
          </div>
        </div>
      </div>
    </footer>




</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
