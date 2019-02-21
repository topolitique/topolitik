<?php
/*
Template Name: Auteurs
*/

get_header();
?>

	<div id="primary" class="content-area">
			<article class="post-container">

				<div class="post-info right-sidebar">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
				<main id="main" class="site-main authors">
					<header class="entry-header">
							<h1>Qui se cache derrière TOPO ?</h1>
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
