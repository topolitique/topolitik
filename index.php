<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


		<div class="container section-header latest">
			<h1>Derniers articles</h1>
		</div>
		<div class="container latest">
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post-card', get_post_type() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</div>
			<?php
				the_posts_navigation();
			?>
		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
