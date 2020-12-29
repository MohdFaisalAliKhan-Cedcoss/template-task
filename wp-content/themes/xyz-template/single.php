<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package xyz-template
 */

get_header();
?>


      <main id="primary" class="site-main">

        <?php
        while ( have_posts() ) :
          the_post();

          get_template_part( 'template-parts/content', get_post_type() );
        ?>
        <div class="container">
        <div class="row">
        <div class="col-lg-8">

        <?php
          the_post_navigation(
            array(
              'prev_text' => '<span class="nav-subtitle" style="padding:5px;background:gray;color:white;">' . esc_html__( 'Previous:', 'xyz-template' ) . '</span> <span class="nav-title">%title</span>',
              'next_text' => '<span class="nav-subtitle" style="padding:5px;background:gray;color:white;">' . esc_html__( 'Next:', 'xyz-template' ) . '</span> <span class="nav-title">%title</span>',
            )
          );
       
          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;

        endwhile; // End of the loop.
        ?>
      </div>

      <div class="col-lg-4">
        <div >
          <?php
            //  get_sidebar();
             ?> 
        </div>
      </div>
    </div>
  </div>
  </main><!-- #main -->

<?php
// get_sidebar();
get_footer();
