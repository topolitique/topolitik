<?php if (is_user_logged_in()) {echo '404.php';}
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package topolitik
 */

get_header();
?>

	<div id="primary" class="error-404">
		<main id="main" class="site-main">

			<section class="not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Erreur 404', 'topolitik' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( "Ce lien n'existe pas...", 'topolitik' ); ?></p>
					<p><?php esc_html_e( "Il s'agit peut-être d'une erreur de notre part. Si c'est le cas, contactez-nous par e-mail: topo@unige.ch", 'topolitik' ); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
