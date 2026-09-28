<?php
/**
 * Componente: Marquee.
 * Recibe $section (array normalizado del flexible content 'marquee').
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$texto = $section['texto'] ?? 'MÚSICA · HUMOR · ESCENA · SEVILLA ·';
?>
<section class="marquee" data-component="marquee" aria-hidden="true">
	<div class="marquee__track">
		<?php for ( $i = 0; $i < 6; $i++ ) : ?>
			<span><?php echo esc_html( $texto ); ?></span>
		<?php endfor; ?>
	</div>
</section>
