<?php
/**
 * Componente: Gallery.
 * Recibe $section (array normalizado del flexible content 'galeria').
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $args ) && is_array( $args ) ) {
	extract( $args, EXTR_SKIP );
}

$titular  = $section['titular'] ?? 'GALERÍA';
$imagenes = ! empty( $section['imagenes'] ) ? $section['imagenes'] : array();

if ( empty( $imagenes ) ) {
	$imagenes = array(
		salasvq_demo_photo( 'concert-lights-2', 'evento-1.svg' ),
		salasvq_demo_photo( 'mic-closeup-1', 'evento-2.svg' ),
		salasvq_demo_photo( 'vinyl-shelf-1', 'evento-3.svg' ),
		salasvq_demo_photo( 'crowd-silhouette-1', 'la-sala-1.svg' ),
		salasvq_demo_photo( 'guitar-player-1', 'evento-5.svg' ),
		salasvq_demo_photo( 'headphones-1', 'evento-6.svg' ),
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
