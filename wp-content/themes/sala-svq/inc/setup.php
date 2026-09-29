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

/**
 * ESTE THEME REQUIERE ACF PRO, NO SOLO ACF (gratuito).
 *
 * El constructor de páginas (`page_builder`, campo `flexible_content`),
 * las galerías (`galeria_evento`, layout `galeria`) y la página de
 * opciones (`acf_add_options_page`) son funcionalidades EXCLUSIVAS de
 * ACF PRO. Con la versión gratuita de Advanced Custom Fields:
 *
 * - El campo `page_builder` no se registra (tipo de campo inexistente),
 *   así que no se puede editar ninguna sección desde wp-admin.
 * - `acf_add_options_page()` no existe → no aparece "Sala SVQ" en el
 *   menú de ajustes, y logo/colores/redes/contacto no son editables.
 * - El campo de galería del evento tampoco se registra.
 *
 * Sin ACF (ni gratis ni PRO) activo, el theme sigue funcionando con el
 * contenido DEMO definido en inc/helpers.php (fallback automático),
 * pero nada es editable desde WordPress.
 */
function salasvq_check_acf_pro() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		add_action(
			'admin_notices',
			function () {
				echo '<div class="notice notice-error"><p><strong>Sala SVQ:</strong> este theme necesita el plugin <strong>Advanced Custom Fields PRO</strong> activo. Sin él, el CPT Eventos se ve pero no tiene campos, y la web funciona solo con el contenido demo de ejemplo (no editable).</p></div>';
			}
		);
		return;
	}

	if ( ! defined( 'ACFPRO_VERSION' ) ) {
		add_action(
			'admin_notices',
			function () {
				echo '<div class="notice notice-warning"><p><strong>Sala SVQ:</strong> tienes ACF (gratuito) activo, pero este theme necesita <strong>ACF PRO</strong> para el constructor de páginas, la página de ajustes (logo/colores/redes/contacto) y la galería de cada evento. Con la versión gratuita esas partes no aparecerán en el admin y la web caerá al contenido demo.</p></div>';
			}
		);
	}
}
add_action( 'admin_init', 'salasvq_check_acf_pro' );
