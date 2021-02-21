<?php get_header(); ?>
	<!-- TODO : include in functions.php COMMENT: @Mark Est-ce qu'on pense pourvoir gérer l'impression mieux que Firefox ? -->
	<div id="primary" class="dossier-container">
		<div id="post-<?php the_ID(); ?>">
			<!-- Headline -->
			<div class="layout-container">
				<div class="layout-margin" >
          <div class="sticky-margin-container">
            <?php get_template_part( 'template-parts/dossier-card' ); ?>
          </div>
				</div>
        <div class="layout-content">
          <label class="article-content-kicker">dossier</label>
          <?php the_title( '<h1 class="article-content-title">', '</h1>' ); ?>
          <?php the_content(); ?>
          <div></div>
          <?php 
            $custom = get_post_custom();
            if(isset($custom['dossier_articles'])) {
              $field = $custom['dossier_articles'][0];
              $articles = explode(";", $field);
              
              $dossier_query = new WP_Query( array(
                'post_type' => 'post',
                'post__in' => $articles,
                'nopaging' => true,
                'orderby' => 'date',
                'order' => 'DESC'
              ));

              while ($dossier_query->have_posts()) {
                $dossier_query->the_post();
                set_query_var( 'archive_type', 'author' );
                get_template_part( 'template-parts/article-card', get_post_type() );
              }
            }
          ?>

				</div>
				<div class="layout-sidebar">
        <?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			</div>
		</div>
  </div><!-- #post-<?php the_ID(); ?> -->
</div><!-- #primary -->
</main><!-- #main -->
<?php
get_sidebar();
get_footer();
