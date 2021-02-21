<?php
/**
 * Template Name: Home
 * 
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package topolitik
 */
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<!-- NEW Section 1 -->
		<div class="layout-container">
			<div class="homepage-section">
				<div class="homepage-section-margin latest">
					<div class="homepage-section-latest-presentation">
						<h1 class="homepage-section-title no-mobile"><?php echo get_theme_mod('homepage_section_1_header') ?></h1>
						<p class="homepage-section-description no-mobile"><?php echo get_theme_mod('homepage_section_1_body') ?></p>
					</div>

				</div>
				<div class="homepage-section-content">
					<div class="homepage-section-content-first-articles">
						<?php
							$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 5, 'cat' => '-593' ) );

							if ( $latest_blog_posts->have_posts() ) {
								while ( $latest_blog_posts->have_posts() ) {

									$latest_blog_posts->the_post();

									$isVideo = false;
									$show = true;

									$categories = wp_get_post_categories($post_id=get_the_ID());
									foreach ($categories as $cat) {
										// code...
										echo ' ';
										if (get_cat_name($cat)=="TV") {
											$isVideo = true;
										}
									}
									
									set_query_var( 'archive_type', 'home' );
									get_template_part( 'template-parts/article-card', get_post_type() );

									if ($latest_blog_posts->current_post === 1) {
										// add div after first post
										echo '</div><div class="homepage-section-content-last-articles">';
									}

								}
							}
						?>
					</div><!-- .homepage-section-content-last-articles -->
				</div><!-- .homepage-section-content -->
			</div><!-- .homepage-section -->
		</div><!-- .section-container -->
		<!-- NEW Section 1 -->
		

		<!-- NEW Section 2 - Dossiers -->
		<div class="layout-container">
			<div class="homepage-section">
				<div class="homepage-section-margin latest">
					<div class="homepage-section-latest-presentation">
						<h1 class="homepage-section-title no-mobile">Dossiers</h1>
						<p class="homepage-section-description no-mobile">
							Explorez nos series d'articles concoctés rien que pour vous.
						</p>
					</div>

				</div>
				<div class="homepage-section-content">
					<div class="homepage-section-content-first-articles">
						<?php
							$dossiers = new WP_Query(array(
								'posts_per_page' => 5,
								'post_type' => 'dossier',
								'orderby' => 'post_date', // Order by date
							));

							if ( $dossiers->have_posts() ) {
								while ( $dossiers->have_posts() ) {
									$dossiers->the_post();
									?> 
									<div class="home-dossier-container">
										<?php get_template_part( 'template-parts/dossier-card' ); ?>
									</div>
									<?php
								}
							}
						?>
					</div><!-- .homepage-section-content-last-articles -->
				</div><!-- .homepage-section-content -->
			</div><!-- .homepage-section -->
		</div><!-- .section-container -->
		<!-- NEW Section 2 -->

		<!-- NEW Sections 2 to 5 -->
		<?php 

			foreach (range(2, 8) as $section_number): 
				$category = null;
				$category = get_theme_mod('homepage_section_'.$section_number);
				if ($category):
					$categoryObj = get_category_by_slug($category); 
			?>
		<div class="layout-container">
			<div class="homepage-section">
				<div class="homepage-section-margin">
					<h1 class="homepage-section-title"><?php echo $categoryObj->name ?></h1>
					<p class="homepage-section-description"><?php echo $categoryObj->description ?></p>
					<a target="_blank" href="<?php echo esc_url(get_category_link($categoryObj->term_id))?>">Plus d'articles</a>
					<p><?php echo $categoryObj->count ?> articles</p>
				</div>
				<div class="homepage-section-content">
					<div class="homepage-section-content-first-articles">
					<?php
						$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 5, 'category_name'=> $category, 'cat' => '-593' ) );

						if ( $latest_blog_posts->have_posts() ) {
							while ( $latest_blog_posts->have_posts() ) {
								$latest_blog_posts->the_post();

								$isVideo = false;
								$show = true;

								$categories = wp_get_post_categories($post_id=get_the_ID());
								foreach ($categories as $cat) {
									// code...
									echo ' ';
									if (get_cat_name($cat)=="TV") {
										$isVideo = true;
									}
								}
								get_template_part( 'template-parts/article-card', get_post_type() );

								if ($latest_blog_posts->current_post === 1) {
									// add div after first post
									echo '</div><div class="homepage-section-content-last-articles">';
								}

							}
						}
					?>
					</div><!-- .homepage-section-content-last-articles -->
				</div><!-- .homepage-section-content-->
			</div><!-- .homepage-section -->
		</div><!-- .section-container -->
		<?php endif;endforeach; ?>
		<!-- NEW Sections 2 to 5 -->


		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
