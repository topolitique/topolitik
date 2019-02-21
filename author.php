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
		<div class="container">
		<?php if ( have_posts() ) : ?>


			<div class="page-header author">
				<div class="author-info">
				<?php
				$newauthor = wp_title('', false);
				if ( function_exists( 'get_coauthors' ) ) {

  				$coauthors = get_coauthors();
  				foreach ( $coauthors as $coauthor ) {
						if ( trim($coauthor->display_name) === trim($newauthor)) {
							$archive_link = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
	    				$link_title = 'Articles par ' . $coauthor->display_name;
	    				?>
	    				<a href="<?php esc_url( $archive_link ); ?>" class="author-link" title="<?php echo esc_attr( $link_title ); ?>"><?php echo coauthors_get_avatar( $coauthor, 128 ); ?></a>

							<?php
						}
  				}
					// treat author output normally
				}

				echo "<h1 class='author-title'>";
				echo $newauthor;
				echo "</h1>";
				the_archive_description( '<div class="author-description">', '</div>' );
				?>
			</div>
		</div><!-- .page-header -->

			<?php
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
