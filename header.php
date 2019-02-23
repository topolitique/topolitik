<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package topolitik
 */

?>
<!doctype html>
<html amp <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,minimum-scale=1, initial-scale=1">
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<link rel="canonical" href="<?php echo get_permalink( get_queried_object_id() );?>">
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,500,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif" rel="stylesheet">
</head>

<body <?php body_class(); ?>>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/brands.css" integrity="sha384-1KLgFVb/gHrlDGLFPgMbeedi6tQBLcWvyNUN+YKXbD7ZFbjX6BLpMDf0PJ32XJfX" crossorigin="anonymous">

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'topolitik' ); ?></a>
	<div class="no-print">
		<div class="overheader">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'menu_id'        => 'secondary-menu',
			) );
			?>

			<ul id="links-menu">
				<li> <a href="https://www.youtube.com/channel/UC6PeO7m3__Qs8qHdctK9OGQ" target="_blank"><i class="fab fa-youtube"></i></a> </li>
				<li> <a href="http://twitter.com/TOPOlitique" target="_blank"><i class="fab fa-twitter"></i></a> </li>
				<li> <a href="http://facebook.com/topounige" target="_blank"><i class="fab fa-facebook"></i></a> </li>
				<li> <a href="http://instagram.com/topo.geneve" target="_blank"><i class="fab fa-instagram"></i></a> </li>

			</ul>

		</div>
	</div>
	<header id="masthead" class="site-header">
		<div class="site-branding no-print">
			<div class="top-links">
			<?php

				the_custom_logo();
			?>
			</div>
			<?php

			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$topolitik_description = get_bloginfo( 'description', 'display' );
			if ( $topolitik_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $topolitik_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation container no-print" style="margin-bottom:0px">
			<div class="scroll-container">
				<div class="inner-container">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
					?>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->


	<!-- special events header -->
	<?php if (has_header_image()): ?>
		<style type="text/css">
      #header-advert { background-color: <?php echo get_theme_mod('header_bg', '#000000'); ?>; }
  	</style>
		<a id="header-advert" href="<?php echo get_theme_mod('header_link', '#'); ?>" target="_blank">
				<img class="header-image" src="<?php echo get_header_image() ?>">
		</a>
	<?php endif ?>

	<div id="content" class="site-content">
