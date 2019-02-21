
<article class="post-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
    $postid = get_the_ID();
    $custom_fields = get_post_custom($postid);

    if (array_key_exists('arch_thumb', $custom_fields)) {
      $my_custom_field = $custom_fields['arch_thumb'];
      foreach ( $my_custom_field as $key => $value ) {
        if ($value) {
          $v = wp_get_attachment_image_src($value, "adv-pos-a-large")[0];
          echo '<a class="post-thumbnail" href="'.esc_url( get_permalink() ).'">';
          echo '<img src="'.nl2br($v).'"></img>';
          echo '</a>';
        } else {
          topolitik_post_thumbnail();
        }
      }
    } else {
      topolitik_post_thumbnail();
    }
   ?>
  <?php
    $postid = get_the_ID();
    $custom_fields = get_post_custom($postid);
    if (array_key_exists('kicker', $custom_fields)) {
      $my_custom_field = $custom_fields['kicker'];
      foreach ( $my_custom_field as $key => $value ) {
        if ($value) {
          echo "<a class='post-card-kicker' href='". esc_url( get_permalink() ) . "'>". $value . "</a>";
        }
      }
    }

    ?>
	<header class="post-card-header">
    <?php
		if ( is_singular() ) :
      the_title( '<h1 class="post-card-title" ><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		else :
			the_title( '<h1 class="post-card-title" ><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
    ?>
	</header><!-- .entry-header -->
	<footer class="entry-footer">
    <?php
    if ( 'post' === get_post_type() ) :
			?>
			<div class="post-card-meta">
        <?php
				coauthors_posts_links();
        echo ", créé le ";
        topolitik_posted_on()
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
