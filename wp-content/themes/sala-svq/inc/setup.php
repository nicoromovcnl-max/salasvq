<?php
/**
 * Theme support, menus, assets.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function salasvq_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo' );

	add_image_size( 'evento-card', 640, 800, true );
	add_image_size( 'evento-hero', 1400, 1600, true );
	add_image_size( 'evento-wide', 1600, 900, true );

	register_nav_menus(
		array(
			'primary' => __( 'Menú principal', 'sala-svq' ),
			'footer'  => __( 'Menú footer', 'sala-svq' ),
		)
	);
}
add_action( 'after_setup_theme', 'salasvq_setup' );

function salasvq_assets() {
	wp_enqueue_style(
		'salasvq-fonts',
		'https://fonts.googleapis.com/css2?family=Anton&family=Archivo:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&family=Caveat:wght@600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'salasvq-main', SALASVQ_URI . '/assets/css/main.css', array(), SALASVQ_VERSION );
	wp_enqueue_script( 'salasvq-main', SALASVQ_URI . '/assets/js/main.js', array(), SALASVQ_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'salasvq_assets' );

/**
 * ACF options page (theme-wide + home sections).
 */
function salasvq_acf_options_pages() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => 'Ajustes Sala SVQ',
			'menu_title' => 'Sala SVQ',
			'menu_slug'  => 'sala-svq-settings',
			'capability' => 'edit_theme_options',
			'icon_url'   => 'dashicons-microphone',
			'position'   => 2,
			'redirect'   => false,
		)
	);
}
add_action( 'acf/init', 'salasvq_acf_options_pages' );
