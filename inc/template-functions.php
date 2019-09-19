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
 * Add and display Custom Field
 */
add_action('admin_init', 'apre_init_meta');
function apre_init_meta(){
	add_meta_box('ref_list', 'Références', 'apre_render_ref_list', 'post');
	add_meta_box('guest_author_function', 'Fonction', 'apre_render_guest_author_function', 'guest-author');
}
add_action('save_post', 'apre_save_ref_list');
add_action('save_post', 'apre_save_guest_author_function');

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
		 <textarea type="textarea" name="apre_ref_list" id="apre_ref_list" value="<?php echo $meta_value; ?>" style="width: 100%; min-height: 200px; border: 1px solid rgb(120, 120, 120);"><?php echo $meta_value; ?></textarea>
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

/**
 * Custom Field: Guest author function
 */
function apre_render_guest_author_function(){
	global $post;
	$post_id = (int)$post->ID;
	$meta_value = get_post_meta($post_id, 'guest_author_function', true);
	// TODO: exporter le style dans css
	?>
	   <div class="meta-box-item-title">Fonction</div>
		 <div class="meta-box-item-content">
			<input type="text" name="apre_guest_author_function" id="apre_guest_author_function" value="<?php echo $meta_value; ?>" style="width: 50%; border: 1px solid rgb(120, 120, 120);">
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