<?php
/**
 * Componente: Hero.
 * Recibe $section (array normalizado del flexible content 'hero').
 * Preparado para admitir variantes futuras vía $section['variante'].
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $args ) && is_array( $args ) ) {
	extract( $args, EXTR_SKIP );
}

$kicker   = $section['kicker'] ?? 'SEVILLA EN DIRECTO';
$titular  = $section['titular'] ?? "MÚSICA\nHUMOR\nESCENA";
$texto    = $section['texto'] ?? 'Un espacio cercano y sin filtros para la música, el humor, la improvisación y otras formas de encuentro en el corazón de Sevilla.';
$cta_texto = $section['cta_texto'] ?? 'Ver agenda';
$cta_url   = ! empty( $section['cta_url'] ) ? $section['cta_url'] : home_url( '/agenda/' );
$imagen    = ! empty( $section['imagen'] ) ? $section['imagen'] : salasvq_demo_photo( 'singer-portrait-1', 'hero.svg' );
$sello     = $section['sello_texto'] ?? 'SALA SVQ · SEVILLA · PUMAREJO';

$lineas = array_filter( array_map( 'trim', explode( "\n", $titular ) ) );

// Fotos de los próximos shows para el ciclo de imágenes del hero (efecto
// "pixelated image reveal"): la principal + 2-3 siguientes eventos, sin
// repetir la misma imagen dos veces seguidas.
$rotacion = array( $imagen );
foreach ( salasvq_get_eventos( array( 'limit' => 4 ) )['items'] as $ev_rot ) {
	if ( ! empty( $ev_rot['imagen'] ) && ! in_array( $ev_rot['imagen'], $rotacion, true ) ) {
		$rotacion[] = $ev_rot['imagen'];
	}
	if ( count( $rotacion ) >= 4 ) {
		break;
	}
}
?>
<section class="hero" data-component="hero">
	<div class="hero__grid">
		<div class="hero__copy">
			<p class="hero__kicker"><span class="mark mark--yellow"><?php echo esc_html( $kicker ); ?></span></p>

			<div class="hero__titular-wrap" data-flashlight-text>
				<h1 class="hero__titular">
					<?php foreach ( $lineas as $linea ) : ?>
						<span class="hero__titular-line"><?php echo esc_html( $linea ); ?></span>
					<?php endforeach; ?>
				</h1>
			</div>

			<p class="hero__texto"><?php echo esc_html( $texto ); ?></p>

			<a class="btn btn--outline" href="<?php echo esc_url( $cta_url ); ?>">
				<span><?php echo esc_html( $cta_texto ); ?></span>
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M3 9h11M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.6"/></svg>
			</a>
		</div>

		<div class="hero__media">
			<figure class="hero__figure" data-rotate-images='<?php echo esc_attr( wp_json_encode( array_slice( $rotacion, 1 ) ) ); ?>'>
				<img src="<?php echo esc_url( $imagen ); ?>" alt="" loading="eager">
				<span class="hero__figure-tab"></span>
			</figure>

			<span class="hero__badge" data-hero-badge>01 / <?php echo esc_html( sprintf( '%02d', count( $rotacion ) ) ); ?></span>

			<div class="hero__stamp" aria-hidden="true">
				<svg viewBox="0 0 140 140" width="120" height="120">
					<circle cx="70" cy="70" r="66" fill="none" stroke="currentColor" stroke-width="1"/>
					<circle cx="70" cy="70" r="4" fill="currentColor"/>
					<path id="salasvq-stamp-path" fill="none" d="M70,70 m-52,0 a52,52 0 1,1 104,0 a52,52 0 1,1 -104,0" />
					<text font-size="9.6" letter-spacing="3">
						<textPath href="#salasvq-stamp-path"><?php echo esc_html( $sello ); ?> · </textPath>
					</text>
				</svg>
			</div>
		</div>
	</div>
</section>
