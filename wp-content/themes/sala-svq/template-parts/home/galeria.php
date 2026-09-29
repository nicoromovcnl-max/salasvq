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
		salasvq_demo_photo( 'singer-portrait-1', 'evento-2.svg' ),
		salasvq_demo_photo( 'vinyl-shelf-1', 'evento-3.svg' ),
		salasvq_demo_photo( 'bar-interior-2', 'la-sala-1.svg' ),
		salasvq_demo_photo( 'standup-mic-1', 'evento-4.svg' ),
		salasvq_demo_photo( 'venue-empty-1', 'evento-5.svg' ),
		salasvq_demo_photo( 'headphones-1', 'evento-6.svg' ),
	);
}
?>
<section class="section gallery gallery--marquee" data-component="gallery">
	<div class="section__head section__head--simple">
		<h2 class="section__titular section__titular--inline"><?php echo esc_html( $titular ); ?></h2>
	</div>

	<div class="gallery__viewport">
		<div class="gallery__track" data-marquee>
			<?php
			// Se duplica la tira una vez para poder desplazarla -50% y que el
			// bucle sea perfecto (marquee infinito, sin scrollbar visible).
			for ( $rep = 0; $rep < 2; $rep++ ) :
				foreach ( $imagenes as $img ) :
					?>
					<figure class="gallery__item" <?php echo $rep > 0 ? 'aria-hidden="true"' : ''; ?>>
						<img src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy">
					</figure>
					<?php
				endforeach;
			endfor;
			?>
		</div>
	</div>
</section>
