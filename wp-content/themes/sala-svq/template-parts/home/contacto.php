<?php
/**
 * Componente: Contacto.
 * Recibe $section (array normalizado del flexible content 'contacto').
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $args ) && is_array( $args ) ) {
	extract( $args, EXTR_SKIP );
}

$titular = $section['titular'] ?? 'CONTACTO';
$texto   = $section['texto'] ?? 'Si tienes alguna duda, propuesta, quieres colaborar o simplemente venir a tomar algo, escríbenos. Nos encantará leerte.';
$imagen  = ! empty( $section['imagen'] ) ? $section['imagen'] : salasvq_demo_photo( 'bar-interior-2', 'contacto.svg' );

$direccion = salasvq_option( 'direccion_linea1', 'C. Aniceto Sáenz, 1' ) . ', ' . salasvq_option( 'direccion_linea2', '41003 Sevilla' );
$referencia = salasvq_option( 'direccion_referencia', 'Junto a la Plaza del Pumarejo' );
?>
<section class="section contacto" data-component="contacto">
	<div class="contacto__intro">
		<h1 class="section__titular"><?php echo esc_html( $titular ); ?></h1>
		<p class="contacto__texto"><?php echo esc_html( $texto ); ?></p>
	</div>

	<div class="contacto__media">
		<img src="<?php echo esc_url( $imagen ); ?>" alt="">
	</div>

	<div class="contacto__info-grid">
		<div class="contacto__info-item">
			<span class="contacto__info-label">Dirección</span>
			<p><?php echo esc_html( $direccion ); ?><br><?php echo esc_html( $referencia ); ?></p>
		</div>
		<div class="contacto__info-item">
			<span class="contacto__info-label">Email</span>
			<p><a href="mailto:hola@salasvq.com">hola@salasvq.com</a></p>
		</div>
		<div class="contacto__info-item">
			<span class="contacto__info-label">Teléfono</span>
			<p>De martes a domingo, a partir de las 17:00 h</p>
		</div>
		<div class="contacto__info-item">
			<span class="contacto__info-label">Horario</span>
			<p>Apertura de sala según eventos. Consulta la programación en la agenda.</p>
		</div>
	</div>

	<form class="contacto__form" action="#" method="post">
		<h2 class="evento-single__label">Escríbenos</h2>
		<div class="contacto__form-row">
			<div>
				<label class="sr-only" for="contacto-nombre">Nombre</label>
				<input type="text" id="contacto-nombre" name="nombre" placeholder="Nombre" required>
			</div>
			<div>
				<label class="sr-only" for="contacto-email">Email</label>
				<input type="email" id="contacto-email" name="email" placeholder="Email" required>
			</div>
		</div>
		<label class="sr-only" for="contacto-mensaje">Mensaje</label>
		<textarea id="contacto-mensaje" name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
		<button type="submit" class="btn btn--yellow">
			<span>Enviar mensaje</span>
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"/></svg>
		</button>
	</form>
</section>
