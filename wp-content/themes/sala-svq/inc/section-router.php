<?php
/**
 * Traduce cada layout del flexible content "page_builder" a su
 * template-part. Único punto que conoce el mapeo nombre-ACF -> componente,
 * para poder añadir nuevos bloques sin tocar page.php/front-page.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function salasvq_render_sections( $sections ) {
	$map = array(
		'hero'       => 'template-parts/home/hero',
		'eventos'    => 'template-parts/home/eventos',
		'la_sala'    => 'template-parts/home/la-sala',
		'categorias' => 'template-parts/home/categorias',
		'cta'        => 'template-parts/home/cta',
		'galeria'    => 'template-parts/home/galeria',
		'marquee'    => 'template-parts/home/marquee',
	);

	foreach ( $sections as $section ) {
		$layout = $section['acf_fc_layout'] ?? '';

		if ( isset( $map[ $layout ] ) ) {
			get_template_part( $map[ $layout ], null, array( 'section' => $section ) );
		}
	}
}
