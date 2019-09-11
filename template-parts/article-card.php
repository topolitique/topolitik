
<article class="article-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?> href="<?php get_the_permalink() ?>">
  
  <?php
    $postid = get_the_ID(); // TODO : remove ?
    $custom_fields = get_post_custom(get_the_ID());

    // Get thumbnail 
    $thumbnail = get_the_post_thumbnail_url();
    if (array_key_exists('arch_thumb', $custom_fields)) {
      $custom_thumbnail = $custom_fields['arch_thumb'][0];
      if ($custom_thumbnail) {
        $custom_thumbnail_url = wp_get_attachment_image_src($custom_thumbnail, "adv-pos-a-large")[0];
        if ($custom_thumbnail_url) {
          $thumbnail = $custom_thumbnail_url;
        }
      }
    }
   ?>

  <a class="article-card-thumbnail" href="<?php echo esc_url( get_permalink()); ?>" style="background-image: url('<?php echo $thumbnail ?>')"> </a>
	<div class="article-card-text" >
    <?php

    if (array_key_exists('kicker', $custom_fields)) {
      $kicker = $custom_fields['kicker'][0];
      if ($kicker) {
        echo "<div class='article-card-kicker-container'><a class='article-card-kicker' href='".esc_url( get_permalink()). "'>". $kicker . "</a></div>";
      }
    }

    echo '<a class="article-card-title" href="'.esc_url( get_permalink()).'" >'.get_the_title().'</a>';

    if (array_key_exists('abstract', $custom_fields)) {
      $abstract = $custom_fields['abstract'][0];
    } else {
      $abstract = get_the_excerpt();
    }

    if ($abstract) {
      echo "<a href='".esc_url( get_permalink())."'><p class='article-card-abstract'>" . $abstract . "<br/></p></a>";
    }


    ?>
    <?php
    if ( 'post' === get_post_type() ) :
			?>
			<div class="article-card-meta">
        
        <?php
          $coauthors = get_coauthors(get_the_ID());
          $index = 0;
          foreach ($coauthors as $coauthor) { 
            $avatar = coauthors_get_avatar( $coauthor, 150 );
            if ($avatar) {
              $dom = new DOMDocument();
              $dom->loadXML($avatar);
              $o = $dom->getElementsByTagName('img')[0];
              $avatar_src = $o->getAttribute('src');
              echo '<div class="article-card-author-avatar" style="background-image: url('.$avatar_src.')"></div>';
            }
          }
          echo '<div class="article-card-author-text">';
          coauthors_posts_links();
          echo ', ';
          topolitik_posted_on();
          echo '</div>';
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
    </div><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->