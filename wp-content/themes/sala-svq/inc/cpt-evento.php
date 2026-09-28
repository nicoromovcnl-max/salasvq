<?php
/**
 * Custom Post Type: Evento + taxonomía Categoría de evento.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function salasvq_register_evento_cpt() {
	$labels = array(
		'name'                  => 'Eventos',
		'singular_name'         => 'Evento',
		'menu_name'             => 'Eventos',
		'add_new_item'          => 'Añadir evento',
		'edit_item'             => 'Editar evento',
		'new_item'              => 'Nuevo evento',
		'view_item'             => 'Ver evento',
		'all_items'             => 'Todos los eventos',
		'search_items'          => 'Buscar eventos',
		'not_found'             => 'No se encontraron eventos',
		'not_found_in_trash'    => 'No hay eventos en la papelera',
		'featured_image'        => 'Imagen destacada del evento',
	);

	register_post_type(
		'evento',
		array(
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => 'agenda',
			'menu_icon'     => 'dashicons-tickets-alt',
			'menu_position' => 5,
			'rewrite'       => array( 'slug' => 'eventos', 'with_front' => false ),
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
			'show_in_rest'  => true,
		)
	);
}
add_action( 'init', 'salasvq_register_evento_cpt' );

function salasvq_register_categoria_evento_tax() {
	$labels = array(
		'name'          => 'Categorías de evento',
		'singular_name' => 'Categoría de evento',
		'menu_name'     => 'Categorías',
		'all_items'     => 'Todas las categorías',
		'edit_item'     => 'Editar categoría',
		'add_new_item'  => 'Añadir categoría',
	);

	register_taxonomy(
		'categoria_evento',
		array( 'evento' ),
		array(
			'labels'       => $labels,
			'public'       => true,
			'hierarchical' => false,
			'rewrite'      => array( 'slug' => 'categoria' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'salasvq_register_categoria_evento_tax' );

/**
 * Categorías por defecto: música, humor, escena, sesiones, impro, otros.
 * Cada una lleva un color de acento guardado como term meta 'color'.
 */
function salasvq_default_categorias() {
	$defaults = array(
		'musica'   => array( 'label' => 'Música', 'color' => 'yellow' ),
		'humor'    => array( 'label' => 'Humor', 'color' => 'pink' ),
		'escena'   => array( 'label' => 'Escena', 'color' => 'black' ),
		'sesiones' => array( 'label' => 'Sesiones', 'color' => 'yellow' ),
		'impro'    => array( 'label' => 'Impro', 'color' => 'pink' ),
		'otros'    => array( 'label' => 'Otros', 'color' => 'grey' ),
	);

	foreach ( $defaults as $slug => $data ) {
		if ( ! term_exists( $slug, 'categoria_evento' ) ) {
			$term = wp_insert_term( $data['label'], 'categoria_evento', array( 'slug' => $slug ) );
			if ( ! is_wp_error( $term ) ) {
				update_term_meta( $term['term_id'], 'color', $data['color'] );
			}
		}
	}
}
add_action( 'after_switch_theme', 'salasvq_default_categorias' );

register_activation_hook( __FILE__, 'salasvq_default_categorias' );
