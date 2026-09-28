<?php
/**
 * Campos ACF para el CPT Evento.
 * Registrados vía PHP (local) para no depender de exportar JSON:
 * funciona igual con ACF gratis o ACF PRO.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function salasvq_acf_evento_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_evento',
			'title'  => 'Detalles del evento',
			'fields' => array(
				array(
					'key'   => 'field_subtitulo_evento',
					'label' => 'Subtítulo / tipo de evento',
					'name'  => 'subtitulo_evento',
					'type'  => 'text',
					'instructions' => 'Ej: "Concierto especial", "Nuevo show".',
				),
				array(
					'key'   => 'field_fecha_evento',
					'label' => 'Fecha',
					'name'  => 'fecha_evento',
					'type'  => 'date_picker',
					'display_format' => 'd/m/Y',
					'return_format'  => 'Ymd',
					'required' => 1,
				),
				array(
					'key'   => 'field_hora_evento',
					'label' => 'Hora',
					'name'  => 'hora_evento',
					'type'  => 'text',
					'placeholder' => '21:00 h',
				),
				array(
					'key'   => 'field_apertura_puertas',
					'label' => 'Apertura de puertas',
					'name'  => 'apertura_puertas',
					'type'  => 'text',
					'placeholder' => '20:00 h',
				),
				array(
					'key'   => 'field_precio_evento',
					'label' => 'Precio',
					'name'  => 'precio_evento',
					'type'  => 'text',
					'placeholder' => '16 € anticipada / 20 € taquilla',
				),
				array(
					'key'     => 'field_estado_evento',
					'label'   => 'Estado',
					'name'    => 'estado_evento',
					'type'    => 'select',
					'choices' => array(
						'Entradas disponibles' => 'Entradas disponibles',
						'Últimas entradas'     => 'Últimas entradas',
						'Agotado'              => 'Agotado',
						'Próximamente'         => 'Próximamente',
					),
					'default_value' => 'Entradas disponibles',
				),
				array(
					'key'   => 'field_url_entradas',
					'label' => 'Enlace de entradas',
					'name'  => 'url_entradas',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_artista_nombre',
					'label' => 'Nombre del artista / compañía',
					'name'  => 'artista_nombre',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_artista_descripcion',
					'label' => 'Descripción del artista',
					'name'  => 'artista_descripcion',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_artista_imagen',
					'label' => 'Imagen del artista',
					'name'  => 'artista_imagen',
					'type'  => 'image',
					'return_format' => 'url',
					'preview_size'  => 'thumbnail',
				),
				array(
					'key'   => 'field_galeria_evento',
					'label' => 'Galería',
					'name'  => 'galeria_evento',
					'type'  => 'gallery',
					'return_format' => 'url',
					'preview_size'  => 'medium',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'evento',
					),
				),
			),
		)
	);

	// Metadatos de la taxonomía categoria_evento (color + descripción + imagen).
	acf_add_local_field_group(
		array(
			'key'    => 'group_categoria_evento',
			'title'  => 'Apariencia de la categoría',
			'fields' => array(
				array(
					'key'     => 'field_color_categoria',
					'label'   => 'Color de acento',
					'name'    => 'color',
					'type'    => 'select',
					'choices' => array(
						'yellow' => 'Amarillo',
						'pink'   => 'Rosa',
						'black'  => 'Negro',
						'grey'   => 'Gris',
					),
					'default_value' => 'grey',
				),
				array(
					'key'   => 'field_descripcion_categoria',
					'label' => 'Descripción larga',
					'name'  => 'descripcion_categoria',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_imagen_categoria',
					'label' => 'Imagen destacada',
					'name'  => 'imagen_categoria',
					'type'  => 'image',
					'return_format' => 'url',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'taxonomy',
						'operator' => '==',
						'value'    => 'categoria_evento',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'salasvq_acf_evento_fields' );
