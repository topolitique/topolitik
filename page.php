<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package topolitik
 */

get_header();
?>

	<div id="primary" class="content-area">
			<article id="post-<?php the_ID(); ?>" class="post-container">
				<?php
				while ( have_posts() ) :
					the_post();
				?>
				<header class="entry-header">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;

					if ( 'post' === get_post_type() ) :
						?>
						<div class="entry-meta">
							<?php
							topolitik_posted_on();
							echo " <b> / </b> ";
							coauthors_posts_links();
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
					<?php topolitik_entry_footer(); ?>
				</header><!-- .entry-header -->
				<div style="flex:1 100% !important;width:100%;height:2px !important;display:block;"></div>
				<div class="post-info right-sidebar">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
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
		<div class="right-sidebar">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
