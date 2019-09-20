<?php 
  if ( have_posts() ) :
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/article-card', get_post_type() );
    endwhile;
  endif;
?>