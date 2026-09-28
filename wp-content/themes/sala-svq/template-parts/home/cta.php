<?php
/**
 * Componente: CTA franja.
 * Recibe $section (array normalizado del flexible content 'cta').
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$kicker    = $section['kicker'] ?? 'SVQ';
$titular   = $section['titular'] ?? "UN ESPACIO\nPARA LO\nINESPERADO";
$cta_texto = $section['cta_texto'] ?? 'Entradas';
$cta_url   = ! empty( $section['cta_url'] ) ? $section['cta_url'] : salasvq_option( 'entradas_url', '#' );
$lineas    = array_filter( array_map( 'trim', explode( "\n", $titular ) ) );
?>
<section class="cta-strip" data-component="cta-strip">
	<div class="cta-strip__inner">
		<span class="cta-strip__kicker"><?php echo esc_html( $kicker ); ?></span>

		<h2 class="cta-strip__titular">
			<?php foreach ( $lineas as $linea ) : ?>
				<span><?php echo esc_html( $linea ); ?></span>
			<?php endforeach; ?>
		</h2>

		<a class="btn btn--black" href="<?php echo esc_url( $cta_url ); ?>">
			<span><?php echo esc_html( $cta_texto ); ?></span>
			<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M3 9h11M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.6"/></svg>
		</a>
	</div>
</section>
