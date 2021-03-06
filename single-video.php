<?php
/*
Template Name: Video

Template Post Type: post, page, product
*/

get_header();
?>

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/print.css" mce_href="<?php echo get_template_directory_uri()?>/print.css" media="print" />

	<div id="primary" class="content-area video">
			<article id="post-<?php the_ID(); ?>" class="post-container video">

				<?php
				while ( have_posts() ) :
					the_post();

					$postid = get_the_ID();
			    $custom_fields = get_post_custom($postid);
					if (array_key_exists('abstract', $custom_fields)) {
						$my_custom_field = $custom_fields['abstract'];
				    foreach ( $my_custom_field as $key => $value ) {
							if ($value) {
				      	echo '<meta property="og:description" content="' . $value .'">';
								echo '<meta property="twitter:description" content="' . $value .'">';
							}
				    }
					}
					if (array_key_exists('kicker', $custom_fields)) {
						$my_custom_field2 = $custom_fields['kicker'];
						foreach ( $my_custom_field2 as $key => $value ) {
							if ($value) {
								echo '<meta property="article:kicker" content="' . $value .'">';
								echo '<meta property="topo:kicker" content="' . $value .'">';
							}
						}
					}
					if (array_key_exists('arch_thumb', $custom_fields)) {
						$my_custom_field1 = $custom_fields['arch_thumb'];
						foreach ( $my_custom_field1 as $key => $value ) {
							if ($value) {
								$v = wp_get_attachment_image_src($value, "adv-pos-a-large")[0];
								echo '<meta property="og:image" content="' . $v .'">';
								echo '<meta property="twitter:image" content="' . $v .'">';
							} else {
								echo '<meta name="twitter:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'">' ;
								echo '<meta name="og:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'" >' ;

							}
						}
					} else if (array_key_exists('header_img', $custom_fields)) {
						$my_custom_field2 = $custom_fields['header_img'];
						foreach ( $my_custom_field2 as $key => $value ) {
							if ($value) {
								$v2 = wp_get_attachment_image_src($value, "adv-pos-a-large")[0];
								echo '<meta property="og:image" content="' . $v2 .'">';
								echo '<meta property="twitter:image" content="' . $v2 .'">';

							} else {
								echo '<meta property="twitter:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'">' ;
								echo '<meta property="og:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'" >' ;

							}
						}
					} else {
						echo '<meta property="twitter:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'">' ;
						echo '<meta property="og:image" content="'.get_the_post_thumbnail_url(false).'" >' ;
					}
				?>
				<meta property="og:title" content="<?php echo get_the_title(); ?>">
				<meta property="og:url" content="<?php echo get_permalink() ?>">
				<meta name="twitter:title" content="<?php echo get_the_title(); ?>">
				<meta name="twitter:card" content="summary_large_image">


				<!-- web page header -->

				<div class="video-block">
					<script type="text/javascript">

					</script>
						<?php
						$postid = get_the_ID();
						$custom_fields = get_post_custom($postid);
						if (array_key_exists('youtube_video', $custom_fields)) {
							$my_custom_field = $custom_fields['youtube_video'];
							foreach ( $my_custom_field as $key => $value ) {
								if ($value) {
									?>
										<div id="player"></div>
										<script type="text/javascript">
										// 2. This code loads the IFrame Player API code asynchronously.
										var tag = document.createElement('script');

										tag.src = "https://www.youtube.com/iframe_api";
										var firstScriptTag = document.getElementsByTagName('script')[0];
										firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

										// 3. This function creates an <iframe> (and YouTube player)
										//    after the API code downloads.
										var player;
										function onYouTubeIframeAPIReady() {
											player = new YT.Player('player', {
												videoId: '<?php echo $value; ?>',
												events: {
													'onReady': onPlayerReady,
												},
												playerVars: {
													color:"white",

												}
											});
										}

										// 4. The API will call this function when the video player is ready.
										function onPlayerReady(event) {
											console.log(event.target);
										}

										function onVideoClick(){
											document.getElementById('player').style.visibility="visible"
											document.getElementById('video-thumbnail-block').style.display="none"
											player.playVideo();
										}

										function stopVideo() {
											player.stopVideo();
										}
										</script>

									<?php
								}

							}
						}
						 ?>
						 <div class="video-thumbnail-block" id="video-thumbnail-block" onClick="onVideoClick()">
							 <?php
								 topolitik_post_thumbnail();
							 ?>
							 <div class="video-button">
								 	<svg>
								 		<path d="M28 18 L28 78 L78 48 Z" />
								 	</svg>
							 </div>
						 </div>
				</div>

				<div class="text-block">
					<header class="entry-header__video no-print video">
						<?php
						if ( is_singular() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;

						if ( 'post' === get_post_type() ) :
							?>
							<div class="entry-meta">
								<?php
								topolitik_posted_on();
								?>
							</div><!-- .entry-meta -->
						<?php endif; ?>
						<?php topolitik_video_footer(); ?>
					</header>
						<div <?php post_class(); ?> >
							<main id="main" class="site-main">

							<div class="entry-content__video">
								<?php
								the_content();
								?>
							</div><!-- .entry-content -->


						<!-- Références -->
						<?php

						$postid = get_the_ID();
						$custom_fields = get_post_custom($postid);
						if (array_key_exists('ref_list', $custom_fields)) {
							$my_custom_field = $custom_fields['ref_list'];
							foreach ( $my_custom_field as $key => $value ) {
								if ($value) {
									echo '<div class="post-references">';
									echo '<h2 class="post-references-title">Références</h2>';
									echo '<p>'.nl2br($value).'</p>';
									echo '</div>';
								}

							}
						}

						?>
						<!-- authors -->
						<?php
							// Get authors meta tags
							$coauthors = get_coauthors(get_the_ID());
							$index = 0;
							foreach ($coauthors as $coauthor) {

								$index++;
								$l = coauthors_get_avatar( $coauthor, 150 );
								$dom = new DOMDocument();
								$dom->loadXML($l);
								$o = $dom->getElementsByTagName('img')[0];
								$src = $o->getAttribute('src');
								echo '<meta property="article:author:'.$index.':image" content="'.$src.'" >' ;
								echo '<meta property="article:author:'.$index.':name" content="'.$coauthor->display_name.'" >' ;
								echo '<a class="author-block__video" href="'.get_site_url().'/author/'.$coauthor->user_login.'">';
								echo '<div class="avatar no-print" style="background-image:url('.$src.')"> </div>';
								echo '<img class="image-avatar just-print" src="'.$src.'"> </img>';
								echo '<div class="title">';
								echo '<h1 class="name">'.$coauthor->display_name.'</h1>';
								echo '</div>';
								echo '</a>';
							}


						// - these are comments
						/*echo '<div class="no-print">';
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						echo '</div>';*/

					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div>
				</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
