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
                        <li><a href="#">12 Comments</a></li>
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
                <!-- <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="assets/images/blog-post-02.jpg" alt="">
                    </div>
                    <div class="down-content">
                      <span>Healthy</span>
                      <a href="post-details.html"><h4>Etiam id diam vitae lorem dictum</h4></a>
                      <ul class="post-info">
                        <li><a href="#">Admin</a></li>
                        <li><a href="#">May 24, 2020</a></li>
                        <li><a href="#">36 Comments</a></li>
                      </ul>
                      <p>You can support us by contributing a little via PayPal. Please contact <a rel="nofollow" href="https://templatemo.com/contact" target="_parent">TemplateMo</a> via Live Chat or Email. If you have any question or feedback about this template, feel free to talk to us. Also, you may check other CSS templates such as <a rel="nofollow" href="https://templatemo.com/tag/multi-page" target="_parent">multi-page</a>, <a rel="nofollow" href="https://templatemo.com/tag/resume" target="_parent">resume</a>, <a rel="nofollow" href="https://templatemo.com/tag/video" target="_parent">video</a>, etc.</p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="#">Best Templates</a>,</li>
                              <li><a href="#">TemplateMo</a></li>
                            </ul>
                          </div>
                          <div class="col-6">
                            <ul class="post-share">
                              <li><i class="fa fa-share-alt"></i></li>
                              <li><a href="#">Facebook</a>,</li>
                              <li><a href="#">Twitter</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="assets/images/blog-post-03.jpg" alt="">
                    </div>
                    <div class="down-content">
                      <span>Fashion</span>
                      <a href="post-details.html"><h4>Donec tincidunt leo nec magna</h4></a>
                      <ul class="post-info">
                        <li><a href="#">Admin</a></li>
                        <li><a href="#">May 14, 2020</a></li>
                        <li><a href="#">48 Comments</a></li>
                      </ul>
                      <p>Nullam at quam ut lacus aliquam tempor vel sed ipsum. Donec pellentesque tincidunt imperdiet. Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc, gravida in erat sit amet, feugiat viverra leo. Phasellus interdum, diam commodo egestas rhoncus, turpis nisi consectetur nibh, in vehicula eros orci vel neque.</p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="#">HTML CSS</a>,</li>
                              <li><a href="#">Photoshop</a></li>
                            </ul>
                          </div>
                          <div class="col-6">
                            <ul class="post-share">
                              <li><i class="fa fa-share-alt"></i></li>
                              <li><a href="#">Facebook</a>,</li>
                              <li><a href="#">Twitter</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
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
                <div class="col-lg-12">
                  <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="#">
                      <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                    </form>
                  </div>
                </div>
                
                    <div class="col-lg-12">
                    <div class="sidebar-item recent-posts">
                        <div class="sidebar-heading">
                        <h2>Recent Posts</h2>
                        </div>
                        <?php
                    $blog_posts = new WP_Query( array( 'post_type' => 'post', 'post_status’' => 'publish', 'posts_per_page' => -1 ) );
                    ?>
                    <?php if ( $blog_posts->have_posts() ) : ?>
                    <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); 
                ?>
                        <div class="content">
                        <ul>
                            <li>
                            <h5><a href="#"><?php echo get_the_title();?></a></h5>
                            <span><?php echo get_the_date();?></span>
                            </li>
                        </ul>
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
                <div class="col-lg-12">
                  <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                      <h2>Categories</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <?php
                        $categories = get_categories();
                        foreach($categories as $category) {
                           echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                        }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                      <h2>Tag Clouds</h2>
                    </div>
                    <div class="content">
                      <ul>
                      <?php
                        $tags = get_tags();
                        if ( $tags ) :
                            foreach ( $tags as $tag ) : ?>
                                <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( $tag->name ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php get_footer(); ?>







