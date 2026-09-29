<?php
/**
 * Componente: ImageTextSection ("La Sala").
 * Recibe $section (array normalizado del flexible content 'la_sala').
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $args ) && is_array( $args ) ) {
	extract( $args, EXTR_SKIP );
}

$titular   = $section['titular'] ?? "LA\nSALA";
$texto     = $section['texto'] ?? 'Un espacio cultural en el corazón de Sevilla donde la música, el humor, la improvisación y las artes escénicas conviven sin demasiadas reglas.';
$cta_texto = $section['cta_texto'] ?? 'Conoce la sala';
$cta_url   = ! empty( $section['cta_url'] ) ? $section['cta_url'] : home_url( '/la-sala/' );
$imagen    = ! empty( $section['imagen'] ) ? $section['imagen'] : salasvq_demo_photo( 'bar-interior-1', 'la-sala-2.svg' );
$imagen2   = ! empty( $section['imagen_secundaria'] ) ? $section['imagen_secundaria'] : salasvq_demo_photo( 'venue-empty-1', 'la-sala-1.svg' );
$lineas    = array_filter( array_map( 'trim', explode( "\n", $titular ) ) );
?>
<section class="section la-sala" data-component="image-text-section">
	<figure class="la-sala__media la-sala__media--main">
		<img src="<?php echo esc_url( $imagen2 ); ?>" alt="" loading="lazy">
	</figure>

	<div class="la-sala__copy">
		<div class="section__index">02</div>

		<h2 class="section__titular section__titular--tight">
			<?php foreach ( $lineas as $linea ) : ?>
				<span><?php echo esc_html( $linea ); ?></span>
			<?php endforeach; ?>
		</h2>

		<p class="la-sala__texto"><?php echo esc_html( $texto ); ?></p>

		<a class="btn btn--outline" href="<?php echo esc_url( $cta_url ); ?>">
			<span><?php echo esc_html( $cta_texto ); ?></span>
			<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M3 9h11M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.6"/></svg>
		</a>

		<ul class="la-sala__list">
			<li>Conciertos</li>
			<li>Monólogos</li>
			<li>Improvisación</li>
			<li>Sesiones</li>
			<li>Talleres</li>
			<li>Y más</li>
		</ul>
	</div>

	<figure class="la-sala__media la-sala__media--secondary">
		<img src="<?php echo esc_url( $imagen ); ?>" alt="" loading="lazy">
	</figure>
</section>
