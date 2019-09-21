<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package topolitik
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function topolitik_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'topolitik_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function topolitik_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'topolitik_pingback_header' );

/**
 * Initialize global values for singular pages (articles and pages)
 * So that these values get retrieved only once.
 */
function topolitik_init_global_values() {
	if (is_singular()):
		while ( have_posts() ) :
			the_post();
			global $postid;
			$postid = get_the_ID();
			global $custom_fields;
			$custom_fields = get_post_custom($postid);
			
			// abstract / extract --> TODO: get extract if no abstract;
			global $abstract;
			$abstract = get_the_excerpt();
			if (array_key_exists('abstract', $custom_fields)) : 
				$abstract = $custom_fields['abstract'][0];
			endif;
		
			global $kicker;
			$kicker = "";
			if (array_key_exists('kicker', $custom_fields)) : 
				$kicker = $custom_fields['kicker'][0];
			endif;
				
			global $thumbnail;
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
	endif;
}
add_action( 'wp', 'topolitik_init_global_values' );

function topolitik_meta_tags() {
	?>
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
		<meta name="og:image:width" content="1920">
		<meta name="og:image:height" content="1080">
		<meta name="og:type" content="article">

	<?php
}
add_action( 'wp_head', 'topolitik_meta_tags' );

/**
 * Add and display Custom Field
 */
function apre_init_meta(){
	add_meta_box('ref_list', 'Références', 'apre_render_ref_list', 'post', 'normal', 'high');
	add_meta_box('guest_author_function', 'Fonction', 'apre_render_guest_author_function', 'guest-author');
	add_meta_box('kicker', 'Kicker', 'apto_render_kicker', 'kicker'); // remplaçé 'kicker' en 'post' ci-dessous
	add_meta_box('kicker', 'Kicker', 'apto_render_kicker', 'post', 'normal', 'high'); 
}
add_action('admin_init', 'apre_init_meta');

/**
 * Custom Field: Reference
 */
function apre_render_ref_list(){
	global $post;
	$post_id = (int)$post->ID;
	$meta_value = get_post_meta($post_id, 'ref_list', true);
	// TODO: exporter le style dans css
	?>

	<div class="meta-box-item-content">
	<div>
		<div class="wp-block editor-styles-wrapper" style="margin-left: auto; margin-right:auto">
			<textarea type="textarea" name="apre_ref_list" id="apre_ref_list" style="width:100%;min-height:300px;padding:12px;" placeholder="Références" value="<?php echo $meta_value; ?>">
				<?php echo $meta_value; ?>
			</textarea>
		</div>
	</div>
	</div>

	<?php
}

function apre_save_ref_list($post_id){ // $post-id est géré par wordpress
	# vardump($_POST);
	$field_name = 'apre_ref_list';
	$meta_value = $_POST['apre_ref_list'];
	$meta_key = 'ref_list';

	if (!isset($meta_value)): // Vérification qu'il y a bien un champs dédié // Manière détournée pour s'assurer que ça n'apparaît que dans la création des auteurs invités
	   return false; 
	endif;

	if(get_post_meta($post_id, $meta_key)): // Si la meta existe déjà, on actualise la meta
		update_post_meta($post_id, $meta_key, $meta_value);
	elseif ($meta_value === ''): // Si la valeur du champs est nulle, on supprime la meta
		delete_post_meta($post_id, $meta_key);
	else: // Autrement, on ajoute la meta
		add_post_meta($post_id, $meta_key, $meta_value);
	endif;
}
add_action('save_post', 'apre_save_ref_list');


/**
 * Custom Field: Guest author function
 */
function apre_render_guest_author_function(){
	global $post;
	$post_id = (int)$post->ID;
	$meta_value = get_post_meta($post_id, 'guest_author_function', true);
	// TODO: exporter le style dans css
	?>
		 <div class="meta-box-item-content">
			<input type="text" name="apre_guest_author_function" id="apre_guest_author_function" value="<?php echo $meta_value; ?>" style="min-width: 30%;" placeholder="Redacteur / Président / Chef de Pôle">
		 </div>
	<?php
}
 
 function apre_save_guest_author_function($post_id){
	# vardump($_POST);
	$meta_value = $_POST['apre_guest_author_function'];
	$meta_key = 'guest_author_function';
 
	if (!isset($meta_value)):
		return false; 
	endif;
 
	if(get_post_meta($post_id, $meta_key)):
		update_post_meta($post_id, $meta_key, $meta_value);
	elseif ($meta_value === ''):
		delete_post_meta($post_id, $meta_key);
	else:
		add_post_meta($post_id, $meta_key, $meta_value);
	endif;
}
add_action('save_post', 'apre_save_guest_author_function');


/**
 * Custom Field: Kicker
 */
function apto_render_kicker(){
	global $post;
	$post_id = (int)$post->ID;
	$meta_value = get_post_meta($post_id, 'kicker', true);
	// TODO: exporter le style dans css
	?>
		 <div class="meta-box-item-content">
			<input type="text" name="apto_kicker" id="apto_kicker" value="<?php echo $meta_value; ?>" >
		 </div>
	<?php
}
 
 function apre_save_kicker($post_id){
	# vardump($_POST);
	$meta_value = $_POST['apto_kicker'];
	$meta_key = 'kicker';
 
	if (!isset($meta_value)):
		return false; 
	endif;
 
	if(get_post_meta($post_id, $meta_key)):
		update_post_meta($post_id, $meta_key, $meta_value);
	elseif ($meta_value === ''):
		delete_post_meta($post_id, $meta_key);
	else:
		add_post_meta($post_id, $meta_key, $meta_value);
	endif;
}
add_action('save_post', 'apre_save_kicker');


/**
 * Custom Post Type: Topo TV
 */
function apto_custom_post_type_topotv() {

	// Permet de remplacer le texte des boutons de la partie Admin. Au lieu de 'Ajouter un article', on aura 'Ajouter une nouvelle vidéo'
	$labels = array(
		'name'                => _x( 'Vidéo Topo TV', 'Post Type General Name'),
		'singular_name'       => _x( 'Vidéo Topo TV', 'Post Type Singular Name'),
		'menu_name'           => __( 'Topo TV'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Toutes les vidéos'),
		'view_item'           => __( 'Voir les vidéos'),
		'add_new_item'        => __( 'Ajouter une nouvelle vidéo'),
		'add_new'             => __( 'Ajouter une vidéo'),
		'edit_item'           => __( 'Editer la vidéo'),
		'update_item'         => __( 'Modifier la vidéo'),
		'search_items'        => __( 'Rechercher une vidéo'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// Options
	
	$args = array(
		'label'               => __( 'Vidéo Topo TV'),
		'description'         => __( 'Toutes les vidéos de Topo TV'),
    'labels'              => $labels,
    'menu_icon'           => 'dashicons-video-alt2',
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
		'show_in_rest'        => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => false,
    'menu_position'       => 5

	);

	register_post_type( 'topotv', $args );
}
add_action( 'init', 'apto_custom_post_type_topotv', 0 );

