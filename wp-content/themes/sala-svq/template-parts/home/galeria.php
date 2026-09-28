<?php
/**
 * Componente: Gallery.
 * Recibe $section (array normalizado del flexible content 'galeria').
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$titular  = $section['titular'] ?? 'GALERÍA';
$imagenes = ! empty( $section['imagenes'] ) ? $section['imagenes'] : array();

if ( empty( $imagenes ) ) {
	$imagenes = array(
		SALASVQ_URI . '/assets/img/demo/evento-1.jpg',
		SALASVQ_URI . '/assets/img/demo/evento-2.jpg',
		SALASVQ_URI . '/assets/img/demo/evento-3.jpg',
	);
}
?>
<section class="section gallery" data-component="gallery">
	<div class="section__head section__head--simple">
		<h2 class="section__titular section__titular--inline"><?php echo esc_html( $titular ); ?></h2>
	</div>

	<div class="gallery__track">
		<?php foreach ( $imagenes as $img ) : ?>
			<figure class="gallery__item">
				<img src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy">
			</figure>
		<?php endforeach; ?>
	</div>
</section>
