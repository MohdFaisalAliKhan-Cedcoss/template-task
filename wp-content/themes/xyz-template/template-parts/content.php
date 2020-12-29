<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xyz-template
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		// if ( is_singular() ) :
			// the_title( '<h1 class="entry-title">', '</h1>' );
		// else :
			// the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		// endif;

		// if ( 'post' === get_post_type() ) :
			?>
			<!-- <div class="entry-meta"> -->
				<?php
				// xyz_template_posted_on();
				// xyz_template_posted_by();
				?>
			<!-- </div> -->
			<!-- .entry-meta -->
		<?php
	//  endif; 
	 ?>
	</header><!-- .entry-header -->
    
    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
              <?php
                $blog_posts = new WP_Query( array( 'post_type' => 'post', 'post_status’' => 'publish', 'posts_per_page' => -1 ) );
                ?>
                <?php if ( $blog_posts->have_posts() ) : ?>
				<?php 
					// while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
				 ?>
              
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                    <?php if ( has_post_thumbnail() ) { 
                        the_post_thumbnail( get_the_ID(), 'full' );
                        } ?>
                    </div>
                    <div class="down-content">
                      <span><?php echo the_category();?></span>
                      <a href="<?php the_permalink();?>"><h4><?php echo get_the_title();?></h4></a>
                      <ul class="post-info">
                        <li><a href="#"><?php echo get_the_title();?></a></li>
                        <li><a href="#"><?php echo get_the_date();?></a></li>
                        <li><a href="#"><?php echo comments_number();?></a></li>
                      </ul>
                      <?php echo the_content(); ?>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <?php
                              $post_tags = get_the_tags();
                              
                              if ( $post_tags ) {
                                  foreach( $post_tags as $tag ) {
                                  echo $tag->name . ', '; 
                                  }
                              }
                              
                              ?>
                            </ul>
                          </div>
                          <div class="col-6">
                            <ul class="post-share">
                            <li><i class="fa fa-share-alt"></i></li>
                            <?php
                                wp_nav_menu( array( 'theme_location' => 'new-menu' ) );
                                ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				<?php
			    //   endwhile;
			 ?>
                <?php else: ?>
                    <p class = "no-blog-posts">
                    <?php esc_html_e('Sorry, no posts matched your criteria.', 'theme-domain'); ?> 
                    </p>
                    <?php endif; 
                      wp_reset_postdata(); 
                    ?>
                <div class="col-lg-12">
                  <div class="main-button">
                    <a href="blog.html">View All Posts</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                
                <?php get_sidebar();?>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>







	<!-- Container -->
	
	<!-- .entry-content -->

	<!-- <footer class="entry-footer">
		<?php 
		// xyz_template_entry_footer(); 
		?>
	</footer>.entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
