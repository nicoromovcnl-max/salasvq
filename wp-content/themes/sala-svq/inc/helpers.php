<?php
/**
 * Helpers: acceso a datos de eventos (WP real o demo mock), formateo.
 *
 * Toda la capa visual (template-parts) consume estas funciones, nunca
 * WP_Query ni ACF directamente. Así, cuando el contenido real esté
 * cargado en WordPress, las plantillas no cambian.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Categorías demo (label + color) usadas si aún no existen términos reales.
 */
function salasvq_demo_categorias() {
	return array(
		array(
			'slug'        => 'musica',
			'label'       => 'Música',
			'color'       => 'yellow',
			'descripcion' => 'Conciertos en directo, bandas emergentes y artistas consagrados sobre el escenario de Sala SVQ.',
			'imagen'      => SALASVQ_URI . '/assets/img/demo/cat-musica.svg',
		),
		array(
			'slug'        => 'humor',
			'label'       => 'Humor',
			'color'       => 'pink',
			'descripcion' => 'Monólogos y stand-up de la escena sevillana y nacional, en formato íntimo.',
			'imagen'      => SALASVQ_URI . '/assets/img/demo/cat-humor.svg',
		),
		array(
			'slug'        => 'escena',
			'label'       => 'Escena',
			'color'       => 'black',
			'descripcion' => 'Teatro contemporáneo, performance e improvisación fuera de los circuitos convencionales.',
			'imagen'      => SALASVQ_URI . '/assets/img/demo/cat-escena.svg',
		),
		array(
			'slug'        => 'sesiones',
			'label'       => 'Sesiones',
			'color'       => 'yellow',
			'descripcion' => 'Vinilos, DJs y noches de club dentro de la sala.',
			'imagen'      => SALASVQ_URI . '/assets/img/demo/cat-sesiones.svg',
		),
	);
}

/**
 * Eventos demo. SOLO PLACEHOLDER — nunca presentar como programación real.
 */
function salasvq_demo_eventos() {
	return array(
		array(
			'id'         => 'demo-1',
			'titulo'     => 'Los Estanques',
			'subtitulo'  => 'Concierto especial',
			'categoria'  => array( 'slug' => 'musica', 'label' => 'Música', 'color' => 'yellow' ),
			'fecha_dia'  => '17',
			'fecha_mes'  => 'OCT',
			'hora'       => '21:00 h',
			'precio'     => '16 €',
			'estado'     => 'Entradas disponibles',
			'imagen'     => SALASVQ_URI . '/assets/img/demo/evento-1.svg',
			'url'        => '#',
		),
		array(
			'id'         => 'demo-2',
			'titulo'     => 'Galder Varas',
			'subtitulo'  => 'Nuevo show',
			'categoria'  => array( 'slug' => 'humor', 'label' => 'Humor', 'color' => 'pink' ),
			'fecha_dia'  => '25',
			'fecha_mes'  => 'OCT',
			'hora'       => '20:30 h',
			'precio'     => '18 €',
			'estado'     => 'Entradas disponibles',
			'imagen'     => SALASVQ_URI . '/assets/img/demo/evento-2.svg',
			'url'        => '#',
		),
		array(
			'id'         => 'demo-3',
			'titulo'     => 'Club SVQ',
			'subtitulo'  => 'Vinilos toda la noche',
			'categoria'  => array( 'slug' => 'sesiones', 'label' => 'Sesiones', 'color' => 'yellow' ),
			'fecha_dia'  => '08',
			'fecha_mes'  => 'NOV',
			'hora'       => '23:00 h',
			'precio'     => '10 €',
			'estado'     => 'Últimas entradas',
			'imagen'     => SALASVQ_URI . '/assets/img/demo/evento-3.svg',
			'url'        => '#',
		),
		array(
			'id'         => 'demo-4',
			'titulo'     => 'Impro Sevilla',
			'subtitulo'  => 'Historias que no existían',
			'categoria'  => array( 'slug' => 'impro', 'label' => 'Impro', 'color' => 'black' ),
			'fecha_dia'  => '16',
			'fecha_mes'  => 'NOV',
			'hora'       => '20:30 h',
			'precio'     => '12 €',
			'estado'     => 'Entradas disponibles',
			'imagen'     => SALASVQ_URI . '/assets/img/demo/evento-4.svg',
			'url'        => '#',
		),
		array(
			'id'         => 'demo-5',
			'titulo'     => 'Ruido Local',
			'subtitulo'  => 'Bandas emergentes de Sevilla',
			'categoria'  => array( 'slug' => 'musica', 'label' => 'Música', 'color' => 'yellow' ),
			'fecha_dia'  => '29',
			'fecha_mes'  => 'NOV',
			'hora'       => '21:00 h',
			'precio'     => '10 €',
			'estado'     => 'Agotado',
			'imagen'     => SALASVQ_URI . '/assets/img/demo/evento-5.svg',
			'url'        => '#',
		),
		array(
			'id'         => 'demo-6',
			'titulo'     => 'La Tangente',
			'subtitulo'  => 'Performance en vivo',
			'categoria'  => array( 'slug' => 'escena', 'label' => 'Escena', 'color' => 'black' ),
			'fecha_dia'  => '13',
			'fecha_mes'  => 'DIC',
			'hora'       => '20:30 h',
			'precio'     => '14 €',
			'estado'     => 'Próximamente',
			'imagen'     => SALASVQ_URI . '/assets/img/demo/evento-6.svg',
			'url'        => '#',
		),
	);
}

/**
 * Devuelve eventos normalizados: reales desde WP si existen, si no, demo.
 *
 * @param array $args { limit, categoria_slug }
 * @return array{ items: array, is_demo: bool }
 */
function salasvq_get_eventos( $args = array() ) {
	$defaults = array(
		'limit'          => 8,
		'categoria_slug' => '',
	);
	$args = wp_parse_args( $args, $defaults );

	$query_args = array(
		'post_type'      => 'evento',
		'posts_per_page' => $args['limit'],
		'post_status'    => 'publish',
		'meta_key'       => 'fecha_evento',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
	);

	if ( ! empty( $args['categoria_slug'] ) && 'todos' !== $args['categoria_slug'] ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'categoria_evento',
				'field'    => 'slug',
				'terms'    => $args['categoria_slug'],
			),
		);
	}

	$query = new WP_Query( $query_args );

	if ( ! $query->have_posts() ) {
		$items = salasvq_demo_eventos();
		if ( ! empty( $args['categoria_slug'] ) && 'todos' !== $args['categoria_slug'] ) {
			$items = array_values(
				array_filter(
					$items,
					function ( $item ) use ( $args ) {
						return $item['categoria']['slug'] === $args['categoria_slug'];
					}
				)
			);
		}
		return array(
			'items'   => array_slice( $items, 0, $args['limit'] ),
			'is_demo' => true,
		);
	}

	$items = array();
	foreach ( $query->posts as $post ) {
		$items[] = salasvq_normalize_evento( $post );
	}

	return array(
		'items'   => $items,
		'is_demo' => false,
	);
}

/**
 * Normaliza un WP_Post de tipo evento al mismo shape que los datos demo.
 */
function salasvq_normalize_evento( $post ) {
	$fecha_raw = get_field( 'fecha_evento', $post->ID );
	$timestamp = $fecha_raw ? strtotime( $fecha_raw ) : strtotime( $post->post_date );

	$terms     = get_the_terms( $post->ID, 'categoria_evento' );
	$categoria = array( 'slug' => 'otros', 'label' => 'Otros', 'color' => 'grey' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$term            = $terms[0];
		$categoria = array(
			'slug'  => $term->slug,
			'label' => $term->name,
			'color' => get_term_meta( $term->term_id, 'color', true ) ?: 'grey',
		);
	}

	return array(
		'id'        => $post->ID,
		'titulo'    => get_the_title( $post ),
		'subtitulo' => get_field( 'subtitulo_evento', $post->ID ) ?: '',
		'categoria' => $categoria,
		'fecha_dia' => $timestamp ? date_i18n( 'd', $timestamp ) : '',
		'fecha_mes' => $timestamp ? mb_strtoupper( date_i18n( 'M', $timestamp ) ) : '',
		'hora'      => get_field( 'hora_evento', $post->ID ) ?: '',
		'precio'    => get_field( 'precio_evento', $post->ID ) ?: '',
		'estado'    => get_field( 'estado_evento', $post->ID ) ?: 'Entradas disponibles',
		'imagen'    => get_the_post_thumbnail_url( $post, 'evento-card' ) ?: SALASVQ_URI . '/assets/img/demo/evento-1.svg',
		'url'       => get_permalink( $post ),
	);
}

/**
 * Categorías reales si existen, si no, demo.
 */
function salasvq_get_categorias() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'categoria_evento',
			'hide_empty' => false,
		)
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return array(
			'items'   => salasvq_demo_categorias(),
			'is_demo' => true,
		);
	}

	$items = array();
	foreach ( $terms as $term ) {
		$items[] = array(
			'slug'        => $term->slug,
			'label'       => $term->name,
			'color'       => get_term_meta( $term->term_id, 'color', true ) ?: 'grey',
			'descripcion' => get_term_meta( $term->term_id, 'descripcion_categoria', true ) ?: $term->description,
			'imagen'      => get_term_meta( $term->term_id, 'imagen_categoria', true ) ?: ( SALASVQ_URI . '/assets/img/demo/cat-' . $term->slug . '.jpg' ),
			'url'         => get_term_link( $term ),
		);
	}

	return array(
		'items'   => $items,
		'is_demo' => false,
	);
}
