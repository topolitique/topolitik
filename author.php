<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package topolitik
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="section-container">
		<?php if ( have_posts() ) : ?>


			<div class="author-header">
				<?php
				$newauthor = wp_title('', false);
				if ( function_exists( 'get_coauthors' ) ) {

  				$coauthors = get_coauthors();
  				foreach ( $coauthors as $coauthor ) {
						if ( trim($coauthor->display_name) === trim($newauthor)) {
							$archive_link = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
							$link_title = 'Articles par ' . $coauthor->display_name;
							$function = get_post_meta($coauthor->ID, 'guest_author_function', true);
	    				?>
								
								<?php echo coauthors_get_avatar( $coauthor, 128 ); ?>
								<h2 class="author-name"><?php echo $newauthor; ?></h2>
								<p class="author-function"><?php echo $function ?></p>
								<?php the_archive_description( '<p class="author-description">', '</p>' ); ?>
								<p class="author-url"><?php echo esc_url( $archive_link ); ?></p>
								<?php
						}
  				}
					// treat author output normally
				}
				?>
			</div><!-- .author-header -->
			</div>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				set_query_var( 'archive_type', 'author' );
				get_template_part( 'template-parts/article-card', get_post_type() );

			endwhile;


		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
