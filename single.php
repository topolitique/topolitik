<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package topolitik
 */


// inject header's code
get_header();


// global constants / variables

while ( have_posts() ) :
	the_post();
	$postid = get_the_ID();
	$custom_fields = get_post_custom($postid);
	
	// abstract / extract --> TODO: get extract if no abstract;
	$abstract = "";
	if (array_key_exists('abstract', $custom_fields)) : 
		$abstract = $custom_fields['abstract'][0];
	endif;

	$kicker = "";
	if (array_key_exists('kicker', $custom_fields)) : 
		$kicker = $custom_fields['kicker'][0];
	endif;
		
	$thumbnail = get_the_post_thumbnail_url(get_the_ID());
	if (array_key_exists('arch_thumb', $custom_fields)) : 
			$thumbnail_id = $custom_fields['arch_thumb'][0];
			if ($thumbnail_id) {
				$thumbnail = wp_get_attachment_image_src($thumbnail_id, "adv-pos-a-large")[0];
			};
	elseif (array_key_exists('header_img', $custom_fields)) : 
			$thumbnail_id = $custom_fields['header_img'][0];
			if ($thumbnail_id) {
				$thumbnail = wp_get_attachment_image_src($thumbnail_id, "adv-pos-a-large")[0];
			}
	endif;
endwhile;
?>
	<!-- TODO : include in functions.php -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/print.css" mce_href="<?php echo get_template_directory_uri()?>/print.css" media="print" />

	<div id="primary">
		<article id="post-<?php the_ID(); ?>" class="article-content content">
				<!-- Can these go to the header ? -->
				<!-- image -->
				<meta property="og:image" content="<?php echo $thumbnail; ?>">
				<meta property="twitter:image" content="<?php echo $thumbnail; ?>" >
				<!-- title -->
				<meta property="og:title" content="<?php echo get_the_title(); ?>" >
				<meta name="twitter:title" content="<?php echo get_the_title(); ?>">
				<!-- url-->
				<meta property="og:url" content="<?php echo get_permalink(); ?>" >
				<!-- description -->
				<meta property="og:description" content="<?php echo $abstract; ?>">
				<meta property="twitter:description" content="<?php echo $abstract; ?>">
				<!-- more -->
				<meta name="twitter:card" content="summary_large_image">
			
			<!-- Headline -->
			<div class="page-container">
				<div class="article-margin article-margin-authors">
					<!-- Author and article info -->
					<?php if (!is_page()): ?>
					<?php 
					$coauthors = get_coauthors($postid);
					$index = 0;
					foreach ($coauthors as $coauthor): 
						$index++;
						$avatar = coauthors_get_avatar( $coauthor, 150 );
						$src = '';
						if ($avatar) {
							$dom = new DOMDocument();
							$dom->loadXML($avatar);
							$o = $dom->getElementsByTagName('img')[0];
							$src = $o->getAttribute('src');							
						};
						?>
							<a href="<?php echo get_site_url();?>/author/<?php echo $coauthor->user_login; ?>" class="article-author-container">
								<div class="article-author-avatar" style="background-image: url(<?php echo $src; ?>)">
								
								</div>
								<div class="article-author-name">
									<?php echo $coauthor->display_name; ?>
								</div>
							</a>
					<?php endforeach;?>
					<?php endif; ?>
				</div>
				<div class="article-content article-headline-container">
					<!-- Headline and kicker -->
					<?php						
						if ($kicker) {
							echo "<h2 class='article-content-kicker'>".$kicker."</h2>";
						};
					?>
					<?php
						if ( is_singular() ) :
							the_title( '<h1 class="article-content-title">', '</h1>' );
						else :
							the_title( '<h2 class="article-content-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;
					?>
				</div>
				<div class="article-sidebar">

				</div>
			</div>
			<!-- Thumbnail -->
			<?php if ($thumbnail != ''): ?>
			<div class="page-container article-thumbnail-container" style="background-image: url(<?php echo $thumbnail; ?>);">
				<div class="article-margin article-margin-thumbnail">
					<div class="article-margin-thumbnail-image" style="background-image: url(<?php echo $thumbnail; ?>);">

					</div>
					<p class="article-abstract-in-thumbnail">
						<?php echo $abstract; ?>
						<br />
						<br />
						<?php if ( 'post' === get_post_type() ) {topolitik_posted_on(); }; ?>
					</p>
					<div class="article-date-in-thumbnail">
					</div>
				</div>
				<div class="article-content">
				</div>
				<div class="article-sidebar">

				</div>
			</div>
			<?php endif;?>
			<!-- Content -->
			<div class="page-container">
				<div class="article-margin">
					<div class="article-margin-tags"><?php topolitik_get_categories(); ?></div>
				</div>
				<div class="article-content">
					<div class="article-body">
						<?php the_content(); ?>
						<div class="article-body-footer-separator"></div>
						<div class="article-body-footer-authors">
							<?php coauthors_posts_links(); ?>, le <?php topolitik_posted_on(); ?>
						</div>
						<div class="article-body-footer-tags">
							<?php topolitik_get_categories(); ?>
						</div>
					</div>
					<?php if (array_key_exists('ref_list', $custom_fields)) : ?>
					<div class="article-references">
							<span class="article-references-title">Références</span>
							<?php 
									foreach ( $custom_fields['ref_list'] as $key => $value ) {
										$text = str_replace("\n", "\n\n", $value); // ensure reference is in new paragraph
								
										include 'packages/parsedown-1.7.3/Parsedown.php';
										$Parsedown = new Parsedown();
										if ($text) {
											echo $Parsedown->text($text);
										}
								
									}
							?>
					</div>
					<?php endif; ?>
				</div>
				<div class="article-sidebar">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			</div>
				<!-- printing header -->
				<!-- <header class="print-header just-print">
					<div class="branding">
						<img
							class="brand-left"
							src="<?php echo get_template_directory_uri()?>/images/topo-print-1.png"
							/>
						<img class="brand-right" src="<?php echo get_template_directory_uri()?>/images/topo-print-2.png"></img>
					</div>
					<div class="article-print">
						<div class="title">
							<?php the_title( '<h1 class="title-text">', '</h1>' ); ?>
						</div>
						<div class="info">
							<?php
							echo "<div class='authors'>";
							coauthors_posts_links();
							echo "</div>";
							topolitik_posted_on();
							?>
						</div>
					</div>
					<div>

					</div>
				</header> -->
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- #primary -->
</main><!-- #main -->
<?php
get_sidebar();
get_footer();
