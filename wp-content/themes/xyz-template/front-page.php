<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 * Template Name: Faisal-template
 * 
 * @package xyz-template
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">


 <!-- Header -->





	<header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><h2><?php bloginfo( 'name' ); ?><em>.</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
		  <?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
          'menu_class'     => 'navbar-nav ml-auto',     
          'container'        => 'ul'    
				)
			);
			?>
          </div>
        </div>
      </nav>
    </header>
<!-- #masthead -->
<!-- Banner Starts Here -->
<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
        <?php
        $blog_posts = new WP_Query( array( 'post_type' => 'post', 'post_status’' => 'publish', 'posts_per_page' => -1 ) );
        ?>
        <?php if ( $blog_posts->have_posts() ) : ?>
        <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
          <div class="item">
          <?php if ( has_post_thumbnail() ) { 
              the_post_thumbnail( get_the_ID(), 'full' );
             } ?>
           
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span><?php the_category(', '); ?></span>
                </div>
                <a href="<?php the_permalink();?>"><h4><?php the_title(); ?></h4></a>
                <ul class="post-info">
                  <li><a href="#"><?php the_author(); ?></a></li>
                  <li><a href="#"><?php the_date(); ?></a></li>
                  <li><a href="#"><?php comments_number(); ?></a></li>
                </ul>
              </div>
            </div>
          </div>
          <?php endwhile;?>
          <?php else: ?>
            <p class = "no-blog-posts">
            <?php esc_html_e('Sorry, no posts matched your criteria.', 'theme-domain'); ?> 
            </p>
            <?php endif; 
               wp_reset_postdata(); 
            ?>

        </div>
    </div>
</div>

<!-- Banner ends here -->
<section class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="main-content">
              <div class="row">
                <div class="col-lg-8">
                  <span>Stand Blog HTML5 Template</span>
                  <h4>Creative HTML Template For Bloggers!</h4>
                </div>
                <div class="col-lg-4">
                  <div class="main-button">
                    <a rel="nofollow" href="https://templatemo.com/tm-551-stand-blog" target="_parent">Download Now!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ///////////////////////////////////////////////////////////// -->

    
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
                <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
              
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
                <?php endwhile;?>
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
<?php get_footer(); ?>







