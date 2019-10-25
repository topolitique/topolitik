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
	<!-- Google Analytics -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_theme_mod('ga_code', ''); ?>"></script>
	<script>
  	window.dataLayer = window.dataLayer || [];
  	function gtag(){dataLayer.push(arguments);}
  	gtag('js', new Date());
  	gtag('config', '<?php echo get_theme_mod('ga_code', ''); ?>');
	</script>


	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,minimum-scale=1, initial-scale=1">

	<?php wp_head(); ?>
	<link rel="canonical" href="<?php echo get_permalink( get_queried_object_id() );?>">

	<!-- Matomo -->
	<script type="text/javascript">
		var _paq = window._paq || [];
		/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
		_paq.push(['trackPageView']);
		_paq.push(['enableLinkTracking']);
		(function() {
			var u="//stats.topolitique.news/";
			_paq.push(['setTrackerUrl', u+'piwik.php']);
			_paq.push(['setSiteId', '1']);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
		})();
	</script>
	<!-- End Matomo Code -->
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'topolitik' ); ?></a>


	<header class="site-header unem" id="site-header">
        <div class="section-container header-container">
            <div class="site-header-margin">
                <div class="site-header-about-links">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'menu-2',
										'menu_id'        => 'secondary-menu',
									) );
									?>
                </div>

                <div class="site-header-social-links">
                    <ul>
                      <li>
                        <a target="_blank" href="<?php echo get_theme_mod('social_insta', '#'); ?>"><i class="fab fa-instagram"></i></a>
                      </li>
                      <li>
                        <a target="_blank" href="<?php echo get_theme_mod('social_yt', '#'); ?>"><i class="fab fa-youtube"></i></a>
                      </li>
                      <li>
                        <a target="_blank" href="<?php echo get_theme_mod('social_twitter', '#'); ?>"><i class="fab fa-twitter"></i></a>
                      </li>
                      <li>
                        <a target="_blank" href="<?php echo get_theme_mod('social_fb', '#'); ?>"><i class="fab fa-facebook"></i></a>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="site-header-content">
                <div class="site-header-brand-container">
									<a class="site-header-logo-container" href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<svg class="site-header-logo" viewBox="0 0 200 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
											<g transform="matrix(0.172231,0,0,0.172231,-70.8749,9.76193)">
													<path d="M1489.79,98.866C1471.09,76.675 1454.99,62.277 1446.27,55.085C1445.14,54.158 1444.14,53.355 1443.27,52.665C1403.02,19.791 1351.67,0 1295.65,0C1223.48,0 1158.96,32.744 1116.11,84.172C1105.82,93.761 1088.1,94.402 1073.32,87.791C1059.07,81.417 1044.02,79.28 1028.75,78.998C1023.1,78.894 1017.45,78.801 1011.81,78.717L1011.81,78.493C1005.25,78.45 998.686,78.469 992.126,78.51C985.566,78.468 979.006,78.45 972.446,78.493L972.446,78.717C966.798,78.8 961.149,78.893 955.501,78.998C940.227,79.28 925.186,81.417 910.933,87.791C896.15,94.402 878.434,93.761 868.141,84.172C825.289,32.744 760.775,0 688.599,0C632.579,0 581.228,19.791 540.979,52.665C540.108,53.356 539.111,54.158 537.986,55.085C529.26,62.277 513.159,76.675 494.459,98.866C456.173,144.296 450.146,76.267 454.971,233.629C454.971,312.187 493.785,381.637 553.238,423.99C591.436,451.2 638.127,467.257 688.598,467.257C704.342,467.257 719.698,465.639 734.564,462.659C736.323,462.307 738.078,461.945 739.823,461.555C746.691,460.018 753.44,458.171 760.067,456.044C829.497,433.756 884.773,379.901 908.966,311.361C922.84,275.931 933.727,239.668 941.38,202.367C943.487,192.093 942.829,185.377 933.31,178.092C917.028,165.629 918.572,148.641 935.456,137.246C941.137,133.41 947.738,129.975 954.372,128.676C966.943,126.214 979.539,124.516 992.124,123.696C1004.71,124.516 1017.3,126.213 1029.88,128.676C1036.51,129.976 1043.11,133.411 1048.79,137.246C1065.68,148.641 1067.22,165.629 1050.94,178.092C1041.42,185.377 1040.76,192.094 1042.87,202.367C1050.52,239.668 1061.41,275.931 1075.28,311.361C1099.48,379.9 1154.75,433.756 1224.18,456.044C1230.81,458.171 1237.56,460.017 1244.43,461.555C1246.17,461.946 1247.93,462.307 1249.68,462.659C1264.55,465.639 1279.91,467.257 1295.65,467.257C1346.12,467.257 1392.81,451.2 1431.01,423.99C1490.46,381.636 1529.28,312.187 1529.28,233.629C1534.11,76.267 1528.08,144.296 1489.79,98.866ZM752.033,428.988C744.031,431.592 735.82,433.728 727.423,435.341C727.153,435.392 726.88,435.436 726.608,435.487C714.282,437.807 701.588,439.07 688.599,439.07C575.319,439.07 483.158,346.909 483.158,233.628C483.158,170.235 512.034,113.469 557.309,75.753C592.935,46.074 638.713,28.186 688.599,28.186C763.088,28.186 828.439,68.037 864.467,127.536C868.984,134.996 873.032,142.77 876.588,150.808C878.047,154.107 879.417,157.453 880.706,160.841C889.177,183.115 893.878,207.228 894.026,232.404C894.027,232.813 894.041,233.219 894.041,233.629C894.041,324.775 834.36,402.2 752.033,428.988ZM1295.65,439.07C1282.66,439.07 1269.97,437.806 1257.64,435.487C1257.37,435.436 1257.1,435.392 1256.83,435.341C1248.43,433.728 1240.22,431.592 1232.22,428.988C1149.89,402.2 1090.21,324.774 1090.21,233.628C1090.21,233.219 1090.22,232.812 1090.23,232.403C1090.38,207.227 1095.08,183.114 1103.55,160.84C1104.84,157.453 1106.2,154.106 1107.66,150.807C1111.22,142.769 1115.27,134.995 1119.79,127.535C1155.81,68.036 1221.16,28.185 1295.65,28.185C1345.54,28.185 1391.32,46.073 1426.94,75.752C1472.22,113.468 1501.09,170.235 1501.09,233.627C1501.09,346.909 1408.93,439.07 1295.65,439.07Z" style="fill:white;fill-rule:nonzero;"/>
											</g>
										</svg>					
									</a>

										<div class="site-header-title">
											<div>
												<span class="title"><?php bloginfo( 'name' ); ?></span>
												<span class="description"><?php bloginfo( 'description' ); ?></span>
											</div>
										</div>

									<?php if (get_theme_mod('header_smallbanner_image') !== '' ): ?>
										<style type="text/css">
											#header-smallbanner-advert { background-color: <?php echo get_theme_mod('header_smallbanner_bg', 'transparent'); ?> !important; }
										</style>
										<a id="header-smallbanner-advert" class="no-print" href="<?php echo esc_url(get_theme_mod('header_smallbanner_link', '#')); ?>" target="_blank">
												<img class="header-image no-print" src="<?php echo esc_url(get_theme_mod('header_smallbanner_image')); ?>">
										</a>
									<?php endif ?>

                  <div class="site-header-navigation-button unem" id="site-header-navigation-button" onclick="toggleMenu();">
                    <svg width="100%" height="100%" viewBox="0 0 128 128" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                      <g transform="matrix(0.534064,0,-1.11022e-16,0.839735,39.5986,5.67762)">
                        <rect x="39.03" y="25.984" width="13.319" height="86.939" style="fill:white;"/>
                      </g>
                      <g transform="matrix(3.2702e-17,0.534064,-0.839735,-5.96034e-17,122.322,39.5986)">
                        <rect x="39.03" y="25.984" width="13.319" height="86.939" style="fill:white;"/>
                      </g>
                    </svg>
                  </div>
                </div>
                
                <div class="site-header-categories" id="site-header-categories">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'menu-1',
											'menu_id'        => 'primary-menu',
										) );
									?>
                </div>
            </div>
        </div>
      </header>

	<?php echo get_theme_mod('header_bigbanner_image') ?>

	<!-- special events header -->
	<?php if (get_theme_mod('header_bigbanner_image') !== null ): ?>
		<style type="text/css">
      #header-bigbanner-advert { background-color: <?php echo get_theme_mod('header_bigbanner_bg', 'transparent'); ?> !important; }
  	</style>
		<a id="header-bigbanner-advert" class="no-print" href="<?php echo esc_url(get_theme_mod('header_bigbanner_link')); ?>" target="_blank" style="background-color: <?php echo get_theme_mod('header_bigbanner_bg', 'transparent'); ?> !important">
				<img class="header-image no-print" src="<?php echo esc_url(get_theme_mod('header_bigbanner_image')); ?>">
		</a>
	<?php endif ?>

	<div id="content" class="site-content">
