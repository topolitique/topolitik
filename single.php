<?php if (is_user_logged_in()) {echo 'single.php';} get_header(); ?>
	<!-- TODO : include in functions.php COMMENT: @Mark Est-ce qu'on pense pourvoir gérer l'impression mieux que Firefox ? -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/print.css" mce_href="<?php echo get_template_directory_uri()?>/print.css" media="print" />

	<div id="primary">
		<article id="post-<?php the_ID(); ?>" class="article-content content">
			
			<!-- Headline -->
			<div class="layout-container">
				<div class="layout-margin article-margin-authors">
				</div>
				<div class="layout-content article-headline-container">
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
				<div class="layout-sidebar">

				</div>
			</div>
			<!-- Thumbnail -->
			<?php if ($thumbnail != ''): ?>
			<div class="layout-container article-thumbnail-container" style="background-image: url(<?php echo $thumbnail; ?>);">
				<div class="layout-margin article-margin-thumbnail">
					<div class="article-margin-thumbnail-image" style="background-image: url(<?php echo $thumbnail; ?>);">

					</div>
					<div class="article-margin-authors">
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
							$dom = new DOMDocument(); // COMMENT: @Mark Est-ce que c'est toi qui a écrit ça ?
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
					<p class="article-abstract-in-thumbnail">
						<?php echo $abstract; ?>
					</p>
				</div>
				<div class="layout-content">
				</div>
				<div class="layout-sidebar">

				</div>
			</div>
			<?php endif;?>
			<!-- Content -->
			<div class="layout-container">
				<div class="layout-margin">
					<div class="article-margin-tags"> <!-- TODO: rename class -->
						<?php topolitik_get_categories(); ?>
					</div>
					<div class="article-margin-extra-info">
						<i class="fas fa-clock"></i>
						<?php echo topolitik_reading_time(); ?>
					</div>
					<?php if ( 'post' === get_post_type() ): ?>
					<div class="article-margin-extra-info">
						<i class="fas fa-calendar-alt"></i>
						<?php topolitik_posted_on(); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="layout-content">
					<div class="article-body">
						<?php the_content(); ?>
						<div class="article-body-footer-separator"></div>
						<div class="article-body-footer-authors">
							<?php coauthors_posts_links(); ?>, le <?php topolitik_posted_on(); ?>.
							<?php if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ): 
								$updated_time_string = sprintf( '<time class="entry-date updated" datetime="%1$s">%2$s</time>',
									esc_attr( get_the_modified_date( DATE_W3C ) ),
									esc_html( get_the_modified_date() )
								);
								echo 'Dernière modification le '.$updated_time_string;
							endif; ?>
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
				<div class="layout-sidebar">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			</div>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- #primary -->
</main><!-- #main -->
<?php
get_sidebar();
get_footer();
