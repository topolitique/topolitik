<?php
/**
 * topolitik functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package topolitik
 */

if ( ! function_exists( 'topolitik_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function topolitik_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on topolitik, use a find and replace
		 * to change 'topolitik' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'topolitik', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'topolitik' ), // Categories
		) );
		register_nav_menus( array(
			'menu-2' => esc_html__( 'Secondary', 'topolitik' ), // Other links
		) );
		register_nav_menus( array(
			'menu-3' => esc_html__( 'Links', 'topolitik' ), // links are directly in the theme (because icons)
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'topolitik_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'topolitik_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function topolitik_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'topolitik_content_width', 640 );
}
add_action( 'after_setup_theme', 'topolitik_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function topolitik_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Bottom Bar', 'topolitik' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'topolitik' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Post Sidebar Right (general)', 'topolitik' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'topolitik' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Post Sidebar Left (specific)', 'topolitik' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'topolitik' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home widget', 'topolitik' ),
		'id'            => 'homepage-1',
		'description'   => esc_html__( 'Add widgets here.', 'topolitik' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'topolitik_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function topolitik_scripts() {
	wp_enqueue_style( 'topolitik-style', get_stylesheet_uri() );
	wp_enqueue_style( 'topolitik-style-main', get_template_directory_uri() . '/main.css' );

	wp_enqueue_script( 'topolitik-script-header', get_template_directory_uri() . '/js/header.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'topolitik_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * REST API
 */
add_action('rest_api_init', function() {
	$args = array(
    'type' => 'string',
    'single' => true,
    'show_in_rest' => true,
	);
	register_meta( 'post', 'kicker', $args);
	register_meta( 'post', 'youtube_video', $args);
	register_meta( 'post', 'arch_thumb', $args);
	register_meta( 'post', 'ref_list', $args);


	register_rest_field( 'post', 'coauthors', array(
		'get_callback' => function($data) {
			$authors = array();
			$coauthors = get_coauthors($data['id']);
			foreach ($coauthors as $coauthor) {
				$image = coauthors_get_avatar( $coauthor, 32 );
				if ($image) {
					$dom = new DOMDocument();
					$dom->loadXML($image);
					$imagesrc = $dom->getElementsByTagName('img')[0]->getAttribute('src');
	
					$author = array(
						"name" => $coauthor->display_name,
						"avatar" => $imagesrc
					);
					array_push($authors, $author);
				}
			}
			return $authors;
		}
	));

	register_rest_field( 'post', 'image', array(
		'get_callback' => function($data) {
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id( $data['id']), "large")[0];
			if (!isset($thumbnail)) {
				$custom_fields = get_post_custom( $data['id'] );
				$thumbnail = array_key_exists('header_img', $custom_fields) ? wp_get_attachment_image_src($custom_fields['header_img'][0], "large")[0] : '';
			}
			return $thumbnail;
		}
	));

	register_rest_route("topo/v1","/ui/", array(
	  'methods' => 'GET',
	  'callback' => function($request) {

			/* Categories */
			$categories = array();
			$menus = wp_get_nav_menus();
			foreach ($menus as $key => $wp_menu) {
				// code...
				$menu = (array) $wp_menu;

				if ($menu['name']) {

					$name = $menu['name'];
					$id = $menu['term_id'];

					$menu_items = array();
					$menu_pre_items = (array) wp_get_nav_menu_items( $id );
					foreach ($menu_pre_items as $key => $item) {
						$item = (array) $item;
						$menu_items[$key]['id'] = (int) $item['object_id'];
						$menu_items[$key]['name'] = $item['title'];
						$menu_items[$key]['url'] = $item['url'];
					}

					$categories[ $name ] = array();
					$categories[ $name ]['id']           = $menu['term_id'];
					$categories[ $name ]['name']         = $menu['name'];
					$categories[ $name ]['slug']         = $menu['slug'];
					$categories[ $name ]['description']  = $menu['description'];
					$categories[ $name ]['count']        = $menu['count'];
					$categories[ $name ]['data']         = $menu_items;

					}
			}

			/* Response */
			$response = new stdClass();
    	$response->code     = 'Success';
    	$response->message  = 'Posts Retreived';
			$response->menus = $categories;
			$response->social = array(
				"facebook" => get_theme_mod('social_fb', '#'),
				"twitter" => get_theme_mod('social_twitter', '#'),
				"instagram" => get_theme_mod('social_insta', '#'),
				"youtube" => get_theme_mod('social_yt', '#')
			);
    	return new WP_REST_Response( $response , 200 );
		}
	));

});
