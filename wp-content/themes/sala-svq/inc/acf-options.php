<?php
/**
 * Constructor de páginas (Flexible Content) sobre el CPT nativo "Página",
 * y Ajustes globales (logo, colores, redes, contacto) en la Options Page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function salasvq_acf_options_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_page_builder',
			'title'    => 'Constructor de contenido',
			'fields'   => array(
				array(
					'key'     => 'field_page_builder',
					'label'   => 'Secciones de la página',
					'name'    => 'page_builder',
					'type'    => 'flexible_content',
					'instructions' => 'Añade, reordena o elimina secciones. Cada bloque corresponde a un componente del theme. La portada (Ajustes → Lecturas → Página de inicio) se construye igual que cualquier otra página.',
					'button_label' => 'Añadir sección',
					'layouts' => array(
						'layout_hero'       => array(
							'key'    => 'layout_hero',
							'name'   => 'hero',
							'label'  => 'Hero',
							'display' => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_hero_kicker',
									'label' => 'Kicker (texto pequeño superior)',
									'name'  => 'kicker',
									'type'  => 'text',
									'default_value' => 'SEVILLA EN DIRECTO',
								),
								array(
									'key'   => 'field_hero_titular',
									'label' => 'Titular grande',
									'name'  => 'titular',
									'type'  => 'text',
									'default_value' => 'MÚSICA\nHUMOR\nESCENA',
									'instructions' => 'Usa saltos de línea para forzar el corte de línea del titular.',
								),
								array(
									'key'   => 'field_hero_texto',
									'label' => 'Texto de apoyo',
									'name'  => 'texto',
									'type'  => 'textarea',
									'rows'  => 3,
									'default_value' => 'Un espacio cercano y sin filtros para la música, el humor, la improvisación y otras formas de encuentro en el corazón de Sevilla.',
								),
								array(
									'key'   => 'field_hero_cta_texto',
									'label' => 'Texto del CTA',
									'name'  => 'cta_texto',
									'type'  => 'text',
									'default_value' => 'Ver agenda',
								),
								array(
									'key'   => 'field_hero_cta_url',
									'label' => 'Enlace del CTA',
									'name'  => 'cta_url',
									'type'  => 'url',
								),
								array(
									'key'   => 'field_hero_imagen',
									'label' => 'Fotografía principal',
									'name'  => 'imagen',
									'type'  => 'image',
									'return_format' => 'url',
								),
								array(
									'key'   => 'field_hero_sello',
									'label' => 'Texto del sello circular',
									'name'  => 'sello_texto',
									'type'  => 'text',
									'default_value' => 'SALA SVQ · SEVILLA · PUMAREJO',
								),
							),
						),
						'layout_eventos'     => array(
							'key'    => 'layout_eventos',
							'name'   => 'eventos',
							'label'  => 'Próximos eventos',
							'display' => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_eventos_titular',
									'label' => 'Titular',
									'name'  => 'titular',
									'type'  => 'text',
									'default_value' => "PRÓXIMOS\nEVENTOS",
								),
								array(
									'key'   => 'field_eventos_numero',
									'label' => 'Número máximo a mostrar',
									'name'  => 'limite',
									'type'  => 'number',
									'default_value' => 4,
								),
							),
						),
						'layout_la_sala'     => array(
							'key'    => 'layout_la_sala',
							'name'   => 'la_sala',
							'label'  => 'La Sala',
							'display' => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_lasala_titular',
									'label' => 'Titular',
									'name'  => 'titular',
									'type'  => 'text',
									'default_value' => "LA\nSALA",
								),
								array(
									'key'   => 'field_lasala_texto',
									'label' => 'Texto',
									'name'  => 'texto',
									'type'  => 'textarea',
									'rows'  => 4,
									'default_value' => 'Un espacio cultural en el corazón de Sevilla donde la música, el humor, la improvisación y las artes escénicas conviven sin demasiadas reglas.',
								),
								array(
									'key'   => 'field_lasala_cta_texto',
									'label' => 'Texto del CTA',
									'name'  => 'cta_texto',
									'type'  => 'text',
									'default_value' => 'Conoce la sala',
								),
								array(
									'key'   => 'field_lasala_cta_url',
									'label' => 'Enlace del CTA',
									'name'  => 'cta_url',
									'type'  => 'url',
								),
								array(
									'key'   => 'field_lasala_imagen',
									'label' => 'Fotografía',
									'name'  => 'imagen',
									'type'  => 'image',
									'return_format' => 'url',
								),
								array(
									'key'   => 'field_lasala_imagen_secundaria',
									'label' => 'Fotografía secundaria (público)',
									'name'  => 'imagen_secundaria',
									'type'  => 'image',
									'return_format' => 'url',
								),
							),
						),
						'layout_categorias' => array(
							'key'    => 'layout_categorias',
							'name'   => 'categorias',
							'label'  => 'Categorías / programación',
							'display' => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_categorias_titular',
									'label' => 'Titular',
									'name'  => 'titular',
									'type'  => 'text',
									'default_value' => 'PROGRAMACIÓN',
								),
							),
						),
						'layout_cta'        => array(
							'key'    => 'layout_cta',
							'name'   => 'cta',
							'label'  => 'CTA franja',
							'display' => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_cta_kicker',
									'label' => 'Kicker',
									'name'  => 'kicker',
									'type'  => 'text',
									'default_value' => 'SVQ',
								),
								array(
									'key'   => 'field_cta_titular',
									'label' => 'Titular',
									'name'  => 'titular',
									'type'  => 'text',
									'default_value' => "UN ESPACIO\nPARA LO\nINESPERADO",
								),
								array(
									'key'   => 'field_cta_texto',
									'label' => 'Texto del botón',
									'name'  => 'cta_texto',
									'type'  => 'text',
									'default_value' => 'Entradas',
								),
								array(
									'key'   => 'field_cta_url',
									'label' => 'Enlace del botón',
									'name'  => 'cta_url',
									'type'  => 'url',
								),
							),
						),
						'layout_galeria'    => array(
							'key'    => 'layout_galeria',
							'name'   => 'galeria',
							'label'  => 'Galería',
							'display' => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_galeria_titular',
									'label' => 'Titular',
									'name'  => 'titular',
									'type'  => 'text',
									'default_value' => 'GALERÍA',
								),
								array(
									'key'   => 'field_galeria_imagenes',
									'label' => 'Imágenes',
									'name'  => 'imagenes',
									'type'  => 'gallery',
									'return_format' => 'url',
								),
							),
						),
						'layout_marquee'    => array(
							'key'    => 'layout_marquee',
							'name'   => 'marquee',
							'label'  => 'Marquee (texto en movimiento)',
							'display' => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_marquee_texto',
									'label' => 'Texto repetido',
									'name'  => 'texto',
									'type'  => 'text',
									'default_value' => 'MÚSICA · HUMOR · ESCENA · SEVILLA ·',
								),
							),
						),
						'layout_contacto'   => array(
							'key'    => 'layout_contacto',
							'name'   => 'contacto',
							'label'  => 'Contacto',
							'display' => 'block',
							'sub_fields' => array(
								array(
									'key'   => 'field_contacto_titular',
									'label' => 'Titular',
									'name'  => 'titular',
									'type'  => 'text',
									'default_value' => 'CONTACTO',
								),
								array(
									'key'   => 'field_contacto_texto',
									'label' => 'Texto',
									'name'  => 'texto',
									'type'  => 'textarea',
									'rows'  => 3,
									'default_value' => 'Si tienes alguna duda, propuesta, quieres colaborar o simplemente venir a tomar algo, escríbenos. Nos encantará leerte.',
								),
								array(
									'key'   => 'field_contacto_imagen',
									'label' => 'Fotografía',
									'name'  => 'imagen',
									'type'  => 'image',
									'return_format' => 'url',
								),
							),
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_site_identity',
			'title'  => 'Identidad y color',
			'fields' => array(
				array(
					'key'   => 'field_site_logo',
					'label' => 'Logo (opcional, sustituye al lettering SALA / SVQ)',
					'name'  => 'logo',
					'type'  => 'image',
					'return_format' => 'url',
				),
				array(
					'key'     => 'field_site_palette',
					'label'   => 'Variante de paleta',
					'name'    => 'palette',
					'type'    => 'select',
					'choices' => array(
						''     => 'Base (logo original)',
						'deep' => 'Deep — terracota quemado / verde profundo',
						'sand' => 'Sand — terracota cálido / verde claro',
					),
					'default_value' => '',
					'instructions' => 'Los colores de abajo siguen mandando; esto solo cambia el punto de partida.',
				),
				array(
					'key'   => 'field_color_paper',
					'label' => 'Color papel (fondo)',
					'name'  => 'color_paper',
					'type'  => 'color_picker',
					'default_value' => '#F3EFE8',
				),
				array(
					'key'   => 'field_color_black',
					'label' => 'Color negro (texto/base)',
					'name'  => 'color_black',
					'type'  => 'color_picker',
					'default_value' => '#171512',
				),
				array(
					'key'   => 'field_color_yellow',
					'label' => 'Color acento principal (terracota)',
					'name'  => 'color_yellow',
					'type'  => 'color_picker',
					'default_value' => '#B8452F',
					'instructions' => 'Se guarda en la variable --yellow por compatibilidad con el código, pero el valor es libre.',
				),
				array(
					'key'   => 'field_color_pink',
					'label' => 'Color acento secundario (verde salvia)',
					'name'  => 'color_pink',
					'type'  => 'color_picker',
					'default_value' => '#9FBFA9',
					'instructions' => 'Se guarda en la variable --pink por compatibilidad con el código, pero el valor es libre.',
				),
				array(
					'key'   => 'field_color_grey',
					'label' => 'Color gris',
					'name'  => 'color_grey',
					'type'  => 'color_picker',
					'default_value' => '#DED7C9',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'sala-svq-settings',
					),
				),
			),
			'position' => 'side',
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_site_info',
			'title'  => 'Datos del local y redes',
			'fields' => array(
				array(
					'key'   => 'field_site_direccion',
					'label' => 'Dirección (línea 1)',
					'name'  => 'direccion_linea1',
					'type'  => 'text',
					'default_value' => 'C. Aniceto Sáenz, 1',
				),
				array(
					'key'   => 'field_site_direccion2',
					'label' => 'Dirección (línea 2)',
					'name'  => 'direccion_linea2',
					'type'  => 'text',
					'default_value' => '41003 Sevilla',
				),
				array(
					'key'   => 'field_site_direccion3',
					'label' => 'Referencia',
					'name'  => 'direccion_referencia',
					'type'  => 'text',
					'default_value' => 'Junto a la Plaza del Pumarejo',
				),
				array(
					'key'   => 'field_site_entradas_url',
					'label' => 'Enlace general de entradas',
					'name'  => 'entradas_url',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_site_instagram',
					'label' => 'Instagram',
					'name'  => 'url_instagram',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_site_tiktok',
					'label' => 'TikTok',
					'name'  => 'url_tiktok',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_site_spotify',
					'label' => 'Spotify',
					'name'  => 'url_spotify',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_site_youtube',
					'label' => 'YouTube',
					'name'  => 'url_youtube',
					'type'  => 'url',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'sala-svq-settings',
					),
				),
			),
			'position' => 'side',
		)
	);
}
add_action( 'acf/init', 'salasvq_acf_options_fields' );

/**
 * Devuelve las secciones (flexible content "page_builder") de una página
 * concreta -por defecto la asignada como portada en Ajustes → Lecturas-,
 * con fallback completo a contenido demo si aún no hay nada editado.
 *
 * Así la Home no es un caso especial: usa el mismo constructor que
 * cualquier otra página del sitio.
 */
function salasvq_get_home_sections( $page_id = null ) {
	if ( null === $page_id ) {
		$page_id = 'page' === get_option( 'show_on_front' ) ? (int) get_option( 'page_on_front' ) : 0;
	}

	$sections = ( $page_id && function_exists( 'get_field' ) ) ? get_field( 'page_builder', $page_id ) : false;

	if ( ! empty( $sections ) ) {
		return $sections;
	}

	// Fallback demo: orden por defecto descrito en el brief.
	return array(
		array( 'acf_fc_layout' => 'hero' ),
		array( 'acf_fc_layout' => 'eventos' ),
		array( 'acf_fc_layout' => 'la_sala' ),
		array( 'acf_fc_layout' => 'categorias' ),
		array( 'acf_fc_layout' => 'cta' ),
	);
}

function salasvq_option( $name, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $name, 'option' );
		if ( ! empty( $value ) ) {
			return $value;
		}
	}
	return $default;
}

/**
 * Imprime los tokens de color como custom properties inline, sobrescribiendo
 * los valores por defecto de main.css cuando el usuario los cambia desde
 * Ajustes → Sala SVQ → Identidad y color.
 */
function salasvq_print_color_overrides() {
	$map = array(
		'color_paper'  => '--paper',
		'color_black'  => '--black',
		'color_yellow' => '--yellow',
		'color_pink'   => '--pink',
		'color_grey'   => '--grey',
	);

	$css = '';
	foreach ( $map as $field => $var ) {
		$value = salasvq_option( $field );
		if ( ! empty( $value ) ) {
			$css .= $var . ':' . $value . ';';
		}
	}

	if ( $css ) {
		echo '<style id="salasvq-color-overrides">:root{' . esc_html( $css ) . '}</style>' . "\n";
	}
}
add_action( 'wp_head', 'salasvq_print_color_overrides', 20 );

/**
 * Aplica la variante de paleta elegida (data-palette) en <body>.
 */
function salasvq_body_palette_class( $classes ) {
	$palette = salasvq_option( 'palette', '' );
	if ( $palette ) {
		$classes[] = 'palette-' . sanitize_html_class( $palette );
	}
	return $classes;
}
add_filter( 'body_class', 'salasvq_body_palette_class' );
