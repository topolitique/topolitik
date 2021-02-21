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
add_action( 'template_redirect', 'topolitik_init_global_values' ); // changed from 'wp' to 'template_redirect', only when post is rendered

function topolitik_meta_tags() {
	global $thumbnail, $abstract;
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
			<textarea type="textarea" name="apre_ref_list" id="apre_ref_list" style="width:100%;min-height:300px;padding:12px;" placeholder="Références" value="<?php echo $meta_value; ?>"><?php echo $meta_value; ?></textarea>
		</div>
	</div>
	</div>

	<?php
}

function apre_save_ref_list($post_id){ 
	if (defined(‘DOING_AUTOSAVE’) && DOING_AUTOSAVE) {
		return $post_id;
	}
	# vardump($_POST);
	$field_name = 'apre_ref_list';
	isset($_POST['apre_ref_list']) ? $meta_value = $_POST['apre_ref_list'] : $meta_value = '';
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
add_action('save_post', 'apre_save_ref_list', 10, 1);

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
	if (defined(‘DOING_AUTOSAVE’) && DOING_AUTOSAVE) {
		return $post_id;
	}

	# vardump($_POST);
	isset($_POST['apto_kicker']) ? $meta_value = $_POST['apto_kicker'] : $meta_value = '';
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
add_action('save_post', 'apre_save_kicker', 10, 1);

/**
 * Fix meta removals when post is scheduled 
 * Solution : don't save the post, it has already
 * been saved. Only change it's status
 */
function scheduled_to_published($post ) {
	// ONLY change the post's status, don't (re)save it !!! (wtf...)
	remove_action('save_post', 'apre_save_ref_list');
	remove_action('save_post', 'apre_save_kicker');
}
add_action(  'future_to_publish',  'scheduled_to_published', 9, 1);


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
	isset($_POST['apre_guest_author_function']) ? $meta_value = $_POST['apre_guest_author_function'] : $meta_value = '';
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
// add_action( 'init', 'apto_custom_post_type_topotv', 0 );


/**
 * Custom Post Type: Dossier
 */
function topolitik_post_type_dossier() {

	// Permet de remplacer le texte des boutons de la partie Admin. Au lieu de 'Ajouter un article', on aura 'Ajouter une nouvelle vidéo'
	$labels = array(
		'name'                => _x( 'Dossiers', 'Modifier les dossiers'),
		'singular_name'       => _x( 'Dossier', 'Modifier le dossier'),
		'menu_name'           => __( 'Dossiers'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Tous les dossiers'),
		'view_item'           => __( 'Voir les dossiers'),
		'add_new_item'        => __( 'Ajouter un nouveau dossier'),
		'add_new'             => __( 'Ajouter un dossier'),
		'edit_item'           => __( 'Modifier le dossier'),
		'update_item'         => __( 'Modifier le dossier'),
		'search_items'        => __( 'Rechercher un dossier'),
		'not_found'           => __( 'Non trouvé'),
		'not_found_in_trash'  => __( 'Non trouvé dans la corbeille'),
	);
	
	// Options
	
	$args = array(
		'label'               => __( 'Dossier'),
		'description'         => __( 'Tous les dossiers'),
    'labels'              => $labels,
    'menu_icon'           => 'dashicons-book-alt',
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
		'show_in_rest'        => true,
		'public'              => true,
		'has_archive'         => true,
    'menu_position'       => 4

	);

	register_post_type( 'dossier', $args );
}
add_action( 'init', 'topolitik_post_type_dossier', 0 );

function topolitik_save_articles($post_id){
	# vardump($_POST);
	$meta_key = 'dossier_articles';

	isset($_POST['dossier_articles_field']) ? $meta_value = $_POST['dossier_articles_field'] : $meta_value = '4752;';
	if (!isset($meta_value)):
		return false; 
	endif;
 


	if(get_post_meta($post_id, $meta_key)):
		update_post_meta($post_id, $meta_key, $meta_value);
	else:
		add_post_meta($post_id, $meta_key, $meta_value);
	endif;
}
add_action('save_post', 'topolitik_save_articles', 10, 1);

/**
 * Custom Field: Reference
 */
function topolitik_render_articles($post){
	wp_nonce_field( basename( __FILE__ ), 'dossier_articles' );
	$meta_value = get_post_meta($post->ID, 'dossier_articles', true);
	?>
		<div class="meta-box-item-content">
		 	<!-- dummy input value : hide it -->
			<input type="text" name="dossier_articles_field" id="dossier_articles_field" value="<?php echo $meta_value ?>">

			<table id="dossier_post_list"></table>

			<label class="dossier_label">Ajouter un article</label>
			<div
				id="dossier_articles_searchbar"
				onchange="onSearch()"
				placeholder="Rechercher"
				contenteditable="true"
				> 
				Rechercher...
			</div>
			<div id="dossier_articles_search_result"></div>

				<!-- JS interactive list that changes the input value 'dossiers_articles_field' -->
				<script>
					var field = document.getElementById('dossier_articles_field');
					var posts = field.value.split(';')
					posts = posts.filter(function(i){ return i !== ''});
					posts = posts.filter(function(v, i) { return posts.indexOf(v) === i });
					field.value = posts.join(';');

					for (let i = 0; i < posts.length; i++) {
						if (posts[i] !== '') {
							addPostElement(posts[i]);
						}
					};

					let searchBar = document.getElementById('dossier_articles_searchbar');
					searchBar.addEventListener("input", function() {
						var searchValue = searchBar.innerHTML;
						$.ajax({
							url: '/wp-json/wp/v2/search?subtype=post&search=' + searchValue
						}).done(function(response) {
							var results = document.getElementById('dossier_articles_search_result');
							results.innerHTML = '';

							for (let i = 0; i < response.length; i++) {
								const data = response[i];
								var item = document.createElement('div');
								item.className = "dossier_search_item";
								var itemTitle = document.createElement('div');
								itemTitle.className = "link";
								var itemTitleLink = document.createElement('a');
								itemTitle.appendChild(itemTitleLink);
								itemTitleLink.target = "_blank";
								itemTitleLink.href = data.url;
								itemTitleLink.innerHTML = data.title;

								var itemButton = document.createElement('div');
								var itemButtonLink = document.createElement('a');
								itemButton.appendChild(itemButtonLink);
								itemButtonLink.className = "button button-secondary";
								itemButtonLink.innerHTML = "+";
								itemButtonLink.title = "Ajouter";
								itemButtonLink.onclick = function() {
									addPost(data.id);
									item.className = "dossier_search_item added";
								}

								var posts = getPosts();
								if (posts.indexOf(data.id.toString()) >= 0) {
									item.className = "dossier_search_item added";
								}

								item.appendChild(itemTitle);
								item.appendChild(itemButton);
								results.appendChild(item);
							}
						}).fail(function(error) {
							console.error(error);
						})
					});

					var select = document.getElementById('dossier_new_post');
					select.onchange = function() {
						var id = select.value.split('##')[0];
						var title = select.value.split('##')[1];
						addPost(id);
					}

					function getPosts() {
						var field = document.getElementById('dossier_articles_field');
						var posts = field.value.split(';');
						posts = posts.filter(function(i){ return i !== ''});
						posts = posts.filter(function(v, i) { return posts.indexOf(v) === i });
						return posts;
					}
					function setPosts(posts) {
						var field = document.getElementById('dossier_articles_field');
						var value = posts.join(';');
						field.value = value;
						return value;
					}

					function addPost(id) {
						// Add to field
						var posts = getPosts();
						posts.push(id);
						setPosts(posts);
						// Add to HTML
						addPostElement(id);
					};

					function addPostElement(id, title = '...') {
						var list = document.getElementById('dossier_post_list');
						var item = document.createElement('tr');
						item.id = "dossier_article_" + id;
						var itemId = document.createElement('td');
						itemId.className = 'dossier_id_item';
						itemId.innerHTML = id;
						itemId.title = 'id';

						var itemTitle = document.createElement('td');
						itemTitle.className = 'dossier_title_item';
						var itemTitleLink = document.createElement('a');
						itemTitle.appendChild(itemTitleLink);
						itemTitleLink.innerHTML = title;
						itemTitleLink.title = title;
						itemTitleLink.target = "_blank";
						
						
						var itemRemove = document.createElement('td');
						itemRemove.className = 'dossier_remove_item';
						var itemRemoveButton = document.createElement('a');
						itemRemove.appendChild(itemRemoveButton);
						itemRemoveButton.className = "button button-primary";
						itemRemoveButton.innerHTML = 'x';
						itemRemoveButton.title = 'Remove article';
						itemRemoveButton.onclick = function() {
							removePost(id);
						}
						item.appendChild(itemTitle);
						item.appendChild(itemId);
						item.appendChild(itemRemove);
						list.appendChild(item);

						// Complete article info;
						$.ajax({
							url: '/wp-json/wp/v2/posts/' + id,
						}).done(function(response) {
							itemTitleLink.href = response.link;
							itemTitleLink.innerHTML = response.title.rendered;
						}).fail(function(response) {
							console.log('cant find article');
						});
					}

					function removePost(id) {
						// Remove from input value
						var field = document.getElementById('dossier_articles_field');
						var posts = field.value.split(';').filter(function(i) { return i !== id.toString()});
						posts = posts.filter(function(v, i) { return posts.indexOf(v) === i });
						field.value = posts.join(';');
						// Remove from list;
						var el = document.getElementById('dossier_article_' + id);
						el.parentElement.removeChild(el);
					}

				</script>
				<style>
					#dossier_articles_field {
						display: none;
					}
					#dossier_post_list {
						border-width: 0;
						border-collapse: collapse;
						width: 100%;
					}
					#dossier_post_list tr, #dossier_post_list td {
						border-width: 0;
						border-bottom: 1px solid #ddd;
						padding: 4pt;
					}
					#dossier_post_list tr:nth-child(even) {
						background-color: #f2f2f2;
					} 

					.dossier_remove_item {
						width: 30px;
					}
					.dossier_id_item {
						width: 80px;
					}

					.dossier_label {
						font-weight: bold;
						padding-top: 10pt;
					}
			
					#dossier_articles_searchbar {
						padding-top: 4pt;
						padding-bottom: 4pt;
						font-size: 1.25rem;
						background: rgb(250,250,250);
						border-style: solid;
						border-width: 1px;
						border-color: #ddd;
						border-radius: 2px;
						margin-bottom: 5pt;
					}

					#dossier_articles_search_result {
						min-height: 300px;
					}

					.dossier_search_item {
						float: left;
						width: calc(50% - 17pt);
						margin: 0;
						margin-right: 5pt;
						margin-bottom: 5pt;
						padding: 5pt;
						border-width: 4pt;
						border-style: solid;
						border-color: #ddd;
						border-width: 1px;
						display: flex;
					}
					.dossier_search_item.added {
						opacity: 0.7;
						background: #eee;
					}

					.dossier_search_item .link {
						flex: 1;
					}
					.dossier_search_item .button {
						width: 100%;
						text-align: center;
					}
				</style>
		 </div>
	<?php
}

/**
 * Add and display Custom Field
 */
function apre_init_meta(){
	add_meta_box('ref_list', 'Références', 'apre_render_ref_list', 'post', 'normal', 'high');
	add_meta_box('guest_author_function', 'Fonction', 'apre_render_guest_author_function', 'guest-author');
	// add_meta_box('kicker', 'Kicker', 'apto_render_kicker', 'kicker'); // remplaçé 'kicker' en 'post' ci-dessous
	add_meta_box('kicker', 'Kicker', 'apto_render_kicker', 'post', 'normal', 'high'); 

	add_meta_box('dossier_articles', "Articles liés au dossier", 'topolitik_render_articles', 'dossier', 'normal', 'high');
}
add_action('admin_init', 'apre_init_meta');

function topolitik_reading_time() {
	global $post;
	$content = get_post_field( 'post_content', $post->ID );
	$word_count = str_word_count( strip_tags( $content ) );
	$readingtime = "";
	$timer = ceil($word_count / 225); // higher --> 
	if ($readingtime == 1) {
		$readingtime = "Que dalle";
	} else {
		$readingtime = $timer." minutes";
	}
	return $readingtime;
}

