<?php 

 // Get thumbnail 
 $thumbnail = get_the_post_thumbnail_url(null, 'dossier');

 if (array_key_exists('abstract', $custom_fields)) {
  $abstract = $custom_fields['abstract'][0];
} else {
  $abstract = get_the_excerpt();
}

?>
<div class="dossier_header" style="background-image: url(<?php echo $thumbnail; ?>);">
<!-- Headline and kicker -->
<label class="kicker">dossier</label>
<div>
<?php
  if ( is_singular() ) :
    the_title( '<h1 class="title">', '</h1>' );
  else :
    the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
  endif;
?>
</div>

<p class="description">
  <?php if ( is_singular() ) : echo $abstract; else : ?>
  <a href="<?php echo esc_url(get_permalink()) ?>"><?php echo $abstract; ?></a>
  <?php endif; ?>
</p>
</div>