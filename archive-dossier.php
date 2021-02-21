<?php get_header(); ?>

	<div id="primary">
		<main id="main" class="layout-container">
			<div class="layout-margin">
			  <h1 class='homepage-section-title'><?php wp_title($sep="", null);?> </h1>
			  <h2>Dossiers</h2>
			</div>
			<div class="layout-content archive-content" id="archive-content">
			</div>
		<div class="layout-sidebar">

		</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
