<?php
/**
 * topolitik Theme Customizer
 *
 * @package topolitik
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function topolitik_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	/* 
	Homepage
	*/

	$wp_customize->add_section( 'homepage' , array(
		'title'      => __( "Page d'accueil", 'topolitik' ),
		'priority'   => 10,
	));
	$wp_customize->add_setting( 'homepage_section_1' , array(
		'default'    => 'derniersarticles',
	));
	$wp_customize->add_setting( 'homepage_section_1_header' , array(
		'default'    => 'Titre',
	));
	$wp_customize->add_setting( 'homepage_section_1_body' , array(
		'default'    => '',
	));
	$wp_customize->add_setting( 'homepage_section_2' , array(
		'default'    => null,
	));
	$wp_customize->add_setting( 'homepage_section_3' , array(
  	'capability' => 'edit_theme_options',
	));
	$wp_customize->add_setting( 'homepage_section_4' , array(
  	'capability' => 'edit_theme_options',
	));
	$wp_customize->add_setting( 'homepage_section_5' , array(
  	'capability' => 'edit_theme_options',
	));
	$wp_customize->add_setting( 'homepage_section_6' , array(
  	'capability' => 'edit_theme_options',
	));
	$wp_customize->add_setting( 'homepage_section_7' , array(
  	'capability' => 'edit_theme_options',
	));
	$wp_customize->add_setting( 'homepage_section_8' , array(
  	'capability' => 'edit_theme_options',
	));
	$wp_customize->add_setting( 'homepage_section_9' , array(
  	'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_1_', array(
		'label'      => __( 'Section 1', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_1',
		'type'       => 'select',
		'choices'     => array( 'derniersarticles' => 'Articles récents' ),
		'priority'   => 1,
	)));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_1_header_', array(
		'label'      => __( 'Section 1 : Titre', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_1_header',
		'priority'   => 2,
	)));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_1_body_', array(
		'label'      => __( 'Section 1 : Description', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_1_body',
		'priority'   => 3,
	)));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_2_', array(
		'label'      => __( 'Section 2', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_2',
		'priority'   => 1,
		'type'       => 'select',
		'choices'    => get_categories_select(),
		'priority'   => 5,
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_3_', array(
		'label'      => __( 'Section 3', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_3',
		'priority'   => 1,
		'type'       => 'select',
		'choices'    => get_categories_select(),
		'priority'   => 5,
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_4_', array(
		'label'      => __( 'Section 4', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_4',
		'priority'   => 1,
		'type'       => 'select',
		'choices'    => get_categories_select(),
		'priority'   => 5,
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_5_', array(
		'label'      => __( 'Section 5', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_5',
		'priority'   => 1,
		'type'       => 'select',
		'choices'    => get_categories_select(),
		'priority'   => 5,
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_6_', array(
		'label'      => __( 'Section 6', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_6',
		'priority'   => 1,
		'type'       => 'select',
		'choices'    => get_categories_select(),
		'priority'   => 5,
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_7_', array(
		'label'      => __( 'Section 7', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_7',
		'priority'   => 1,
		'type'       => 'select',
		'choices'    => get_categories_select(),
		'priority'   => 5,
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_8_', array(
		'label'      => __( 'Section 8', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_8',
		'priority'   => 1,
		'type'       => 'select',
		'choices'    => get_categories_select(),
		'priority'   => 5,
	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'homepage_section_9_', array(
		'label'      => __( 'Section 9', 'topolitik' ),
		'section'    => 'homepage',
		'settings'   => 'homepage_section_9',
		'priority'   => 1,
		'type'       => 'select',
		'choices'    => get_categories_select(),
		'priority'   => 5,
	)));

	/* 
		Header Additions
	*/

	$wp_customize->add_section( 'header_bigbanner' , array(
			'title'      => __( 'Image: bannière', 'topolitik' ),
			'priority'   => 20,
	));
	$wp_customize->add_setting( 'header_bigbanner_bg' , array(
    	'transport' => 'refresh',
	));
	$wp_customize->add_setting( 'header_bigbanner_link' , array(
    	'transport' => 'postMessage',
	));
	$wp_customize->add_setting( 'header_bigbanner_image' , array(
		'transport' => 'postMessage',
		'default'   => ''
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bigbanner_link_text', array(
		'label'      => __( 'Image (1400x250 px)', 'topolitik' ),
		'section'    => 'header_bigbanner',
		'settings'   => 'header_bigbanner_image',
		'priority'   => 1
	)));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bigbanner_background_color', array(
		'label'      => __( 'Couleur de fond', 'topolitik' ),
		'section'    => 'header_bigbanner',
		'settings'   => 'header_bigbanner_bg',
		'priority'   => 2
	)));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bigbanner_image_src', array(
		'label'      => __( 'URL', 'topolitik' ),
		'section'    => 'header_bigbanner',
		'settings'   => 'header_bigbanner_link',
		'priority'   => 3
	)));
	
	/* 
		Header Image: Small
	*/

	$wp_customize->add_section( 'header_smallbanner' , array(
		'title'      => __( 'Image: En-tête', 'topolitik' ),
		'priority'   => 30,
	));
	$wp_customize->add_setting( 'header_smallbanner_bg' , array(
		'transport' => 'refresh',
	));
	$wp_customize->add_setting( 'header_smallbanner_link' , array(
		'transport' => 'postMessage',
	));
	$wp_customize->add_setting( 'header_smallbanner_image' , array(
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'smallbanner_link_text', array(
		'label'      => __( 'Petite: Image (200x96px)', 'topolitik' ),
		'section'    => 'header_smallbanner',
		'settings'   => 'header_smallbanner_image',
		'priority'   => 1
	)));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'smallbanner_background_color', array(
		'label'      => __( 'Couleur de fond', 'topolitik' ),
		'section'    => 'header_smallbanner',
		'settings'   => 'header_smallbanner_bg',
		'priority'   => 2
	)));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'smallbanner_image_src', array(
		'label'      => __( 'Lien URL', 'topolitik' ),
		'section'    => 'header_smallbanner',
		'settings'   => 'header_smallbanner_link',
		'priority'   => 3
	)));

	/*
	Social media
	*/ 

	$wp_customize->add_section( 'social_media' , array(
			'title'      => __( 'Réseaux sociaux', 'topolitik' ),
			'priority'   => 40,
	));
	$wp_customize->add_setting( 'social_fb' , array(
    	'default'   => '#',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_fb_text', array(
		'label'      => __( 'Facebook', 'topolitik' ),
		'section'    => 'social_media',
		'settings'   => 'social_fb',
		'priority'   => 1
	)));
	$wp_customize->add_setting( 'social_twitter' , array(
    	'default'   => '#',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_tw_text', array(
		'label'      => __( 'Twitter', 'topolitik' ),
		'section'    => 'social_media',
		'settings'   => 'social_twitter',
		'priority'   => 2
	)));
	$wp_customize->add_setting( 'social_yt' , array(
    	'default'   => '#',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_yt_text', array(
		'label'      => __( 'Youtube', 'topolitik' ),
		'section'    => 'social_media',
		'settings'   => 'social_yt',
		'priority'   => 3
	)));
	$wp_customize->add_setting( 'social_insta' , array(
			'default'   => '#',
			'transport' => 'refresh',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_inst_text', array(
		'label'      => __( 'Instagram', 'topolitik' ),
		'section'    => 'social_media',
		'settings'   => 'social_insta',
		'priority'   => 4
	)));


	/*
		Google Analytics Settings
	*/

	$wp_customize->add_section( 'google_analytics' , array(
	    'title'      => __( 'Google Analytics', 'topolitik' ),
	    'priority'   => 150,
	));
	$wp_customize->add_setting( 'ga_code' , array(
    	'default'   => '',
    	'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ga_id', array(
		'label'      => __( 'ID de suivi', 'topolitik' ),
		'section'    => 'google_analytics',
		'settings'   => 'ga_code',
		'priority'   => 1
	)));

	/*
		Refresh
	*/
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'topolitik_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'topolitik_customize_partial_blogdescription',
		) );
		/* refresh customizer */
		$wp_customize->selective_refresh->add_partial( 'header_bigbanner', array(
			'selector'        => '#header-bigbanner-advert',
			'render_callback' => 'topolitik_customize_partial_header_big',
		));
		$wp_customize->selective_refresh->add_partial( 'header_smallbanner', array(
			'selector'        => '#header-smallbanner-advert',
			'render_callback' => 'topolitik_customize_partial_header_smallbanner',
		) );
	}

	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'custom_css' );
	$wp_customize->remove_section( 'header_image' );

}
add_action( 'customize_register', 'topolitik_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function topolitik_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function topolitik_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
function topolitik_customize_partial_header_bigbanner() {
	bloginfo( 'header_bigbanner' );
}
function topolitik_customize_partial_header_smallbanner() {
	bloginfo( 'header_smallbanner' );
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function topolitik_customize_preview_js() {
	wp_enqueue_script( 'topolitik-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'topolitik_customize_preview_js' );


function get_categories_select() {
  $teh_cats = get_categories();
  $results;
 
  $count = count($teh_cats);
  for ($i=0; $i < $count; $i++) {
    if (isset($teh_cats[$i]))
      $results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
    else
      $count++;
	}
	sprintf('hey,', $results);
  return $results;
}