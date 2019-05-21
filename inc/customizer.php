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

	// Special Banner
	$wp_customize->add_section( 'header_image' , array(
			'title'      => __( 'Bannière Spéciale', 'topolitik' ),
			'priority'   => 30,
	));
	$wp_customize->add_setting( 'header_bg' , array(
    	'default'   => '#FAFAFA',
    	'transport' => 'refresh',
	));
	$wp_customize->add_setting( 'header_link' , array(
    	'default'   => 'http://topolitique.ch',
    	'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
		'label'      => __( 'Couleur de fond', 'topolitik' ),
		'section'    => 'header_image',
		'settings'   => 'header_bg',
		'priority'   => 2
	)));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'link_text', array(
		'label'      => __( 'Lien URL', 'topolitik' ),
		'section'    => 'header_image',
		'settings'   => 'header_link',
		'priority'   => 1
	)));

	// Google Analytics
	$wp_customize->add_section( 'google_analytics' , array(
	    'title'      => __( 'Google Analytics', 'topolitik' ),
	    'priority'   => 100,
	));
	$wp_customize->add_setting( 'ga_code' , array(
    	'default'   => '',
    	'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'link_text', array(
		'label'      => __( 'ID de suivi', 'topolitik' ),
		'section'    => 'google_analytics',
		'settings'   => 'ga_code',
		'priority'   => 1

	)));

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
		$wp_customize->selective_refresh->add_partial( 'header_bg', array(
			'selector'        => '#header-advert',
			'render_callback' => 'topolitik_customize_partial_header_bg',
		) );
	}
}
add_action( 'customize_register', 'topolitik_customize_register', 99 );

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
function topolitik_customize_partial_header_bg() {
	bloginfo( 'header_bg' );
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function topolitik_customize_preview_js() {
	wp_enqueue_script( 'topolitik-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'topolitik_customize_preview_js' );
