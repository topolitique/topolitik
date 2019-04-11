
<article class="post-card video" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
          echo '<a class="post-thumbnail" href="'.esc_url( get_permalink() ).'">';
          topolitik_post_thumbnail();
          echo '</a>';
        }
      }
    } else {
      echo '<a class="post-thumbnail" href="'.esc_url( get_permalink() ).'">';
      topolitik_post_thumbnail();
      echo '</a>';
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
  <div class="post-card-info">
    <header class="post-card-header">
      <?php
  		if ( is_singular() ) :
        the_title( '<h1 class="post-card-title" ><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
  		else :
  			the_title( '<h1 class="post-card-title" ><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
  		endif;
      ?>
  	</header><!-- .entry-header -->

    <?php
      $postid = get_the_ID();
      $custom_fields = get_post_custom($postid);
      if (array_key_exists('abstract', $custom_fields)) {
        $my_custom_field = $custom_fields['abstract'];
        foreach ( $my_custom_field as $key => $value ) {
          if ($value) {
            echo "<p class='post-card-abstract'>" . $value . "</p>";
          }
        }
      }


      ?>
  	<footer class="entry-footer">
      <?php
      if ( 'post' === get_post_type() ) :
  			?>
  			<div class="post-card-meta">
          <?php
  				coauthors_posts_links();
          echo ", ";
          topolitik_posted_on()
  				?>
  			</div><!-- .entry-meta -->
  		<?php endif; ?>
  	</footer><!-- .entry-footer -->

  </div>
  <a href="<?php echo esc_url( get_permalink() ) ?>" class="post-card-playbutton__video">
    <svg width="56" height="56">
      <path d="M13 10 L36 23 L13 36 Z">
    </svg>
  </a>
</article><!-- #post-<?php the_ID(); ?> -->
