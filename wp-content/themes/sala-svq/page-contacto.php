<?php
/**
 * Template Name: Contacto
 */

get_header();

$direccion  = salasvq_option( 'direccion_linea1', 'C. Aniceto Sáenz, 1' );
$direccion2 = salasvq_option( 'direccion_linea2', '41003 Sevilla' );
$referencia = salasvq_option( 'direccion_referencia', 'Junto a la Plaza del Pumarejo' );
$maps_query = rawurlencode( $direccion . ', ' . $direccion2 );
?>

<section class="contacto-hero" data-component="contacto-hero">
	<h1 class="section__titular contacto-hero__titular">CONTACTO</h1>
	<p class="contacto-hero__texto">Si tienes alguna duda, propuesta, quieres colaborar o simplemente venir a tomar algo, escríbenos. Nos encantará leerte.</p>
	<span class="mark mark--yellow contacto-hero__mark">SEVILLA SIEMPRE RESPONDE</span>
</section>

<section class="section contacto-info">
	<div class="contacto-info__grid">
		<div class="contacto-info__item">
			<span class="contacto-info__label">Dirección</span>
			<p><?php echo esc_html( $direccion ); ?><br><?php echo esc_html( $direccion2 ); ?><br><?php echo esc_html( $referencia ); ?></p>
		</div>
		<div class="contacto-info__item">
			<span class="contacto-info__label">Email</span>
			<p><a href="mailto:hola@salasvq.demo">hola@salasvq.demo</a><br><span class="contacto-info__nota">Intentamos responder en menos de 24 h.</span></p>
		</div>
		<div class="contacto-info__item">
			<span class="contacto-info__label">Teléfono</span>
			<p>+34 955 123 456<br><span class="contacto-info__nota">De martes a domingo, desde las 17:00 h.</span></p>
		</div>
		<div class="contacto-info__item">
			<span class="contacto-info__label">Horario</span>
			<p>Apertura de sala según eventos.<br><span class="contacto-info__nota">Consulta la programación en la agenda.</span></p>
		</div>
	</div>
</section>

<section class="contacto-mapa" data-component="contacto-mapa">
	<div class="contacto-mapa__frame">
		<iframe
			src="https://www.google.com/maps?q=<?php echo esc_attr( $maps_query ); ?>&output=embed"
			width="100%" height="100%" style="border:0;filter:grayscale(1) contrast(1.1);" loading="lazy"
			referrerpolicy="no-referrer-when-downgrade" title="Mapa Sala SVQ"></iframe>
	</div>
	<div class="contacto-mapa__llegar">
		<h2 class="evento-single__label">Cómo llegar</h2>
		<ul class="contacto-mapa__lista">
			<li><strong>A pie</strong> — A 10 min de la Alameda de Hércules y 15 min del centro.</li>
			<li><strong>Autobús</strong> — Líneas C3, C4, 27 (parada Plaza del Pumarejo).</li>
			<li><strong>En bici</strong> — Aparcamiento de bicicletas en la propia plaza.</li>
			<li><strong>En coche</strong> — Aparcamiento público a 5 min andando.</li>
		</ul>
		<a class="btn btn--outline" href="https://www.google.com/maps?q=<?php echo esc_attr( $maps_query ); ?>" target="_blank" rel="noopener">
			<span>Abrir en Google Maps</span>
			<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M3 9h11M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.6"/></svg>
		</a>
	</div>
</section>

<section class="section contacto-form-section">
	<div class="contacto-form-section__intro">
		<h2 class="section__titular section__titular--tight"><span>ESCRÍBENOS</span></h2>
	</div>
	<form class="contacto__form" action="#" method="post" onsubmit="return false">
		<div class="contacto__form-row">
			<div>
				<label class="sr-only" for="c-nombre">Nombre</label>
				<input type="text" id="c-nombre" name="nombre" placeholder="Nombre" required>
			</div>
			<div>
				<label class="sr-only" for="c-email">Email</label>
				<input type="email" id="c-email" name="email" placeholder="Email" required>
			</div>
		</div>
		<label class="sr-only" for="c-asunto">Tipo de consulta</label>
		<select id="c-asunto" name="asunto" class="contacto__form-select">
			<option value="">Tipo de consulta</option>
			<option value="general">Consulta general</option>
			<option value="alquiler">Alquiler de la sala</option>
			<option value="prensa">Prensa</option>
			<option value="colaboracion">Propuesta de colaboración</option>
		</select>
		<label class="sr-only" for="c-mensaje">Mensaje</label>
		<textarea id="c-mensaje" name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
		<button type="submit" class="btn btn--yellow">
			<span>Enviar mensaje</span>
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"/></svg>
		</button>
	</form>
</section>

<section class="section contacto-faq">
	<h2 class="section__titular section__titular--tight"><span>PREGUNTAS</span><span>FRECUENTES</span></h2>
	<div class="faq-list">
		<details class="faq-item">
			<summary>¿Cómo puedo comprar entradas?</summary>
			<p>Desde la ficha de cada evento en la <a href="/agenda/">agenda</a>, o directamente en taquilla el día del concierto si quedan disponibles.</p>
		</details>
		<details class="faq-item">
			<summary>¿Se puede reservar la sala para un evento privado?</summary>
			<p>Sí — mira la sección <a href="/la-sala/#alquila-la-sala">Alquila la sala</a> más arriba y escríbenos contándonos qué necesitas.</p>
		</details>
		<details class="faq-item">
			<summary>¿Cuál es el aforo?</summary>
			<p>220 personas de pie, 120 en configuración con sillas para formatos más íntimos (monólogos, presentaciones).</p>
		</details>
		<details class="faq-item">
			<summary>¿Hay acceso para personas con movilidad reducida?</summary>
			<p>Sí, la sala es accesible desde la entrada principal, sin escalones. Escríbenos si necesitas más información concreta.</p>
		</details>
	</div>
</section>

<?php get_footer(); ?>
