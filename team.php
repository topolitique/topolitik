<?php
/*
Template Name: Auteurs
*/

get_header();
?>

	<div id="primary" class="content-area">
			<article class="post-container">
				<?php
				while ( have_posts() ) :
					the_post();
				?>
				<div class="post-info right-sidebar">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
				<main id="main" class="site-main authors">

					<header class="entry-header">
						<?php
						if ( is_singular() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;
						?>
					</header><!-- .entry-header -->


					<div <?php post_class(); ?> >
						<main id="main" class="site-main">

						<div class="entry-content">
							<?php
							the_content( sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'topolitik' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							) );

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'topolitik' ),
								'after'  => '</div>',
							) );
							?>
						</div><!-- .entry-content -->

					<?php

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;


					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
					</div>


					<!-- Liste des rédacteurs -->
					<header class="entry-header">
							<h1>Les rédacteurs</h1>
							<div class="entry-meta">

							</div><!-- .entry-meta -->
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php
							if ( function_exists( 'coauthors_authors' ) ) {
								coauthors_authors();
							} else {
    						wp_list_authors();
							}
						?>
					</div><!-- .entry-content -->

				</main><!-- #main -->
		<div class="right-sidebar">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
	</article>
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
