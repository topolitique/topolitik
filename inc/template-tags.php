<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package topolitik
 */

if ( ! function_exists( 'topolitik_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function topolitik_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'topolitik' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'topolitik_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function topolitik_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'topolitik' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'topolitik_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function topolitik_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$categories = wp_get_post_categories($post_id=get_the_ID());
			if ( $categories ) {
				foreach ($categories as $cat) {
					$c_name = get_cat_name($cat);
					if ($c_name != "Non répertorié" && $c_name != "Non classé") {
						echo $c_name;
					}
				};
			};

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'topolitik' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links">' . esc_html__( 'tags: %1$s', 'topolitik' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'topolitik' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}


	}
endif;

if ( ! function_exists( 'topolitik_video_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function topolitik_video_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'topolitik' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links">' . esc_html__( 'tags: %1$s', 'topolitik' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'topolitik_get_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function topolitik_get_categories() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$categories = wp_get_post_categories($post_id=get_the_ID());
			if ( $categories ) {
				foreach ($categories as $cat) {
					$c_name = get_cat_name($cat);
					if ($c_name != "Non répertorié" && $c_name != "Non classé") {
						echo $c_name;
					}
				};
			};

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'topolitik' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links">' . esc_html__( 'tags: %1$s', 'topolitik' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'topolitik' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}


	}
endif;

if ( ! function_exists( 'topolitik_video_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function topolitik_video_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'topolitik' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links">' . esc_html__( 'tags: %1$s', 'topolitik' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;


if ( ! function_exists( 'topolitik_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function topolitik_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			?>
			<!-- NO THUMBNAIL >

			-->
			<?php
		}

		else if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


