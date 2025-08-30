<?php

/**
 * Template Name: Full Width Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package transportex
 */

get_header(); 
get_template_part('index','banner'); ?>

<main id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="primary" class="content-area">
          <main id="main" class="site-main" role="main">
          <div class="transportex-card-box">
				    <?php while (have_posts()) : the_post();
              		if(has_post_thumbnail()) { ?>
						<figure class="post-thumbnail">
						<a href="<?php the_permalink(); ?>" >
							<?php the_post_thumbnail('full',['class' => 'attachment-full size-full img-fluid']); ?>
						</a>        
						</figure>
					  <?php }				    

				the_content(); 

			 endwhile; // End of the loop. 

      // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;
        transportex_edit_link();

      ?>
      </div>
          </main>
          <!-- #main --> 
        </div>
        <!-- #primary --> 
      </div>
    </div>
  </div>
</main>
<?php
get_footer();