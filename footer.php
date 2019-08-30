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

		<div class="site-footer-notes">
			Topolitique. Le média des étudiants genevois !
		</div><!-- .site-footer-notes -->

		<div class="site-footer-notes">
				Contact: <span class="size-footer-mail">topo@unige.ch</span>
		</div><!-- .site-footer-notes -->

		<div class="site-footer-notes">
				hébergé par...
				<img 
					class="site-footer-host-logo"
					src="<?php echo get_template_directory_uri()?>/images/logo_infomaniak_environnement_blanc.svg" 
				/>
		</div><!-- .site-footer-notes -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!--  links that can be loaded later -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/brands.css" integrity="sha384-oT8S/zsbHtHRVSs2Weo00ensyC4I8kyMsMhqTD4XrWxyi8NHHxnS0Hy+QEtgeKUE" crossorigin="anonymous">
</body>
</html>
