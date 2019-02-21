<?php
/*
Template Name: Front Page (TOPO)
*/

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


		<!-- First section : latest posts -->
		<div class="container section-header latest">
			<h1>Derniers articles</h1>
			<a href="<?php echo esc_url(join("", array(get_permalink(),"latest") ) ) ?> ">plus d'articles</a>
		</div>
		<div class="container index latest">
		<?php
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 5 ) );
		if ( $latest_blog_posts->have_posts() ) {
			while ( $latest_blog_posts->have_posts() ) {
				$latest_blog_posts->the_post();
				get_template_part( 'template-parts/post-card', get_post_type() );
			}
		}
		?>
		</div>

		<!-- Second section : international -->
		<div class="container section-header international">
			<h1>International</h1>
			<a href="<?php echo esc_url(get_category_link( get_cat_ID( 'international' ))); ?> ">plus d'articles</a>
		</div>
		<div class="container index section international">
		<?php
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 6, 'category_name'=>'international' ) );
		if ( $latest_blog_posts->have_posts() ) {
			while ( $latest_blog_posts->have_posts() ) {
				$latest_blog_posts->the_post();
				get_template_part( 'template-parts/post-card-small', get_post_type() );
			}
		}
		?>
		</div>

		<!-- Third section : Société et histoire -->
		<div class="container section-header suisse">
			<h1>Suisse</h1>
			<a href="<?php echo esc_url(get_category_link( get_cat_ID( 'suisse' ))); ?> ">plus d'articles</a>
		</div>
		<div class="container index section international">
		<?php
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 3, 'category_name'=>'suisse' ) );
		if ( $latest_blog_posts->have_posts() ) {
			while ( $latest_blog_posts->have_posts() ) {
				$latest_blog_posts->the_post();
				get_template_part( 'template-parts/post-card-small', get_post_type() );
			}
		}
		?>
		</div>

		<div class="container section-header topotv">
			<h1><i class="fas fa-video"></i>   TOPO TV</h1>
			<a href="https://www.youtube.com/channel/UC6PeO7m3__Qs8qHdctK9OGQ">plus de vidéos</a>
		</div>
		<div class="container home-widget-section youtube">
			<?php dynamic_sidebar( 'homepage-1' ); ?>
		</div>

		<!-- Third section : Genre -->
		<div class="container section-header genre">
			<h1>Genre et Identité</h1>
			<a href="<?php echo esc_url(get_category_link( 460 )); ?> ">plus d'articles</a>
		</div>
		<div class="container index section international">
		<?php
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 3, 'category_name'=>'genreetidentite' ) );
		if ( $latest_blog_posts->have_posts() ) {
			while ( $latest_blog_posts->have_posts() ) {
				$latest_blog_posts->the_post();
				get_template_part( 'template-parts/post-card-small', get_post_type() );
			}
		}
		?>
		</div>

		<!-- Third section : Edito -->
		<div class="container section-header edito">
			<h1>Edito</h1>
			<a href="<?php echo esc_url(get_category_link( get_cat_ID( 'edito' ))); ?> ">plus d'articles</a>
		</div>
		<div class="container index section international">
		<?php
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 3, 'category_name'=>'edito' ) );
		if ( $latest_blog_posts->have_posts() ) {
			while ( $latest_blog_posts->have_posts() ) {
				$latest_blog_posts->the_post();
				get_template_part( 'template-parts/post-card-small', get_post_type() );
			}
		}
		?>
		</div>


		<!-- Third section : Culture -->
		<div class="container section-header culture">
			<h1>Culture</h1>
			<a href="<?php echo esc_url(get_category_link( get_cat_ID( 'culture' ))); ?> ">plus d'articles</a>
		</div>
		<div class="container index section international">
		<?php
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 6, 'category_name'=>'culture' ) );
		if ( $latest_blog_posts->have_posts() ) {
			while ( $latest_blog_posts->have_posts() ) {
				$latest_blog_posts->the_post();
				get_template_part( 'template-parts/post-card-small', get_post_type() );
			}
		}
		?>
		</div>


		<!-- Third section : Société et histoire -->
		<div class="container section-header societe-histoire">
			<h1>Société et Histoire</h1>
			<a href="<?php echo esc_url(get_category_link( 4 )); ?> ">plus d'articles</a>
		</div>
		<div class="container index section international">
		<?php
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 3, 'category_name'=>'societe-histoire' ) );
		if ( $latest_blog_posts->have_posts() ) {
			while ( $latest_blog_posts->have_posts() ) {
				$latest_blog_posts->the_post();
				get_template_part( 'template-parts/post-card-small', get_post_type() );
			}
		}
		?>
		</div>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
