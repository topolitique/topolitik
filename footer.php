<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package topolitik
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer no-print">
		<div class="layout-container site-footer-container">
			<div class="site-footer-notes colored">
				<b>TOPO</b>. Le média des étudiants genevois !
			</div><!-- .site-footer-notes -->

			<div class="site-footer-notes">
					Contact: <span class="size-footer-mail hinted">topo@unige.ch</span>
			</div><!-- .site-footer-notes -->
			<div class="site-footer-notes separator">
					Hébergement: 
					<a href="https://news.infomaniak.com/hebergement-gratuit-pour-les-etudiants/" target="_blank">
						<img 
							class="site-footer-host-logo"
							src="<?php echo get_template_directory_uri()?>/images/infomaniak_env.svg" 
						/>
					</a>
			</div><!-- .site-footer-notes --> 
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono:400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=EB+Garamond:400,400i,600,600i&display=swap" rel="stylesheet">
<!-- Fonts loaded after first load -->
<!-- Font Awesome - include after page is loaded -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/brands.css" integrity="sha384-1KLgFVb/gHrlDGLFPgMbeedi6tQBLcWvyNUN+YKXbD7ZFbjX6BLpMDf0PJ32XJfX" crossorigin="anonymous">

</body>
</html>
