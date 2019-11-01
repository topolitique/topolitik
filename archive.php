<?php get_header(); ?>

	<div id="primary">
		<main id="main" class="layout-container">
			<div class="layout-margin">
			<h1 class='homepage-section-title'><?php wp_title($sep="", null);?> </h1>
			<?php
					echo "<h2 class='homepage-section-title'>";
					wp_title($sep="");
					echo "</h2>";
					the_archive_description( '<div class="homepage-section-description">', '</div>' );
					?>
			</div>
			<div class="layout-content archive-content" id="archive-content">
			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					set_query_var( 'archive_type', 'home' );
					get_template_part( 'template-parts/article-card', get_post_type() );

				endwhile;


			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
			</div>
		<div class="layout-sidebar">

		</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
