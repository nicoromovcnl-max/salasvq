<?php
/**
 * Template Name: La Sala
 * Página editorial completa sobre el espacio + sección "Alquila la sala".
 * Contenido fijo en el template (no depende de ACF Pro): esta página no
 * necesita flexible content, es contenido propio de La Sala.
 */

get_header();
?>

<section class="lasala-hero" data-component="lasala-hero">
	<div class="lasala-hero__media cutout-frame">
		<img src="<?php echo esc_url( salasvq_demo_photo( 'bar-interior-2', 'la-sala-1.svg' ) ); ?>" alt="" id="lasala-hero-img">
		<span class="tape-mark tape-mark--top" aria-hidden="true"></span>
		<span class="tape-mark tape-mark--bottom" aria-hidden="true"></span>
	</div>
	<div class="lasala-hero__copy">
		<span class="mark mark--yellow">SALA SVQ · SEVILLA</span>
		<h1 class="lasala-hero__titular">LA<br>SALA</h1>
		<p class="lasala-hero__texto">Un espacio cultural en el corazón del Pumarejo. Música, humor, escena y sesiones conviven aquí sin demasiadas reglas desde hace más de una década.</p>
		<span class="hand-note">— desde 2014</span>
	</div>
</section>

<section class="section lasala-detalle">
	<div class="section__index">01</div>
	<h2 class="section__titular section__titular--tight"><span>UN ESCENARIO</span><span>PEQUEÑO</span></h2>
	<p class="lasala-detalle__texto">Sala SVQ nació para ser un sitio de cercanía: aforo reducido, sonido cuidado y una programación que no distingue entre música, humor e improvisación. Aquí el público está a un metro del escenario, y eso cambia cómo se vive un concierto o un monólogo.</p>
	<p class="lede lasala-detalle__pull">«El público está a un metro del escenario, y eso lo cambia todo.»</p>
	<p class="lasala-detalle__texto">El espacio combina una estructura de nave industrial reconvertida con detalles propios: la barra a un lado, el escenario elevado apenas unos centímetros, y una acústica pensada tanto para un trío acústico como para una sesión de vinilos hasta la madrugada.</p>
</section>

<section class="lasala-palabras" data-component="lasala-palabras">
	<span class="eyebrow lasala-palabras__eyebrow">02 — LO QUE PASA AQUÍ</span>
	<ul class="lasala-palabras__lista">
		<li><a href="/musica/">MÚSICA</a></li>
		<li><a href="/humor/">HUMOR</a></li>
		<li><a href="/escena/">ESCENA</a></li>
		<li><a href="/impro/">IMPRO</a></li>
		<li><a href="/sesiones/">SESIONES</a></li>
	</ul>
</section>

<section class="lasala-gallery" data-component="lasala-gallery">
	<figure class="lasala-gallery__item lasala-gallery__item--tall lasala-gallery__item--tilt-left">
		<img src="<?php echo esc_url( salasvq_demo_photo( 'standup-mic-1', 'evento-4.svg' ) ); ?>" alt="Escenario" id="lasala-img-escenario">
		<span class="tape-mark tape-mark--corner" aria-hidden="true"></span>
		<figcaption>Escenario</figcaption>
	</figure>
	<figure class="lasala-gallery__item">
		<img src="<?php echo esc_url( salasvq_demo_photo( 'concert-crowd-1', 'la-sala-1.svg' ) ); ?>" alt="Público" id="lasala-img-publico">
		<figcaption>Público</figcaption>
	</figure>
	<figure class="lasala-gallery__item">
		<img src="<?php echo esc_url( salasvq_demo_photo( 'venue-empty-1', 'evento-3.svg' ) ); ?>" alt="Barra" id="lasala-img-barra">
		<figcaption>Barra</figcaption>
	</figure>
	<figure class="lasala-gallery__item lasala-gallery__item--wide lasala-gallery__item--tilt-right">
		<img src="<?php echo esc_url( salasvq_demo_photo( 'bar-interior-1', 'la-sala-2.svg' ) ); ?>" alt="Interior" id="lasala-img-interior">
		<span class="tape-mark tape-mark--corner" aria-hidden="true"></span>
		<figcaption>Interior</figcaption>
	</figure>
	<figure class="lasala-gallery__item">
		<img src="<?php echo esc_url( salasvq_demo_photo( 'neon-sign-1', 'evento-2.svg' ) ); ?>" alt="Detalle" id="lasala-img-detalle">
		<figcaption>Detalle</figcaption>
	</figure>
</section>

<section class="section lasala-datos">
	<div class="section__index">02</div>
	<h2 class="section__titular section__titular--inline">FICHA TÉCNICA</h2>
	<div class="lasala-datos__grid">
		<div class="lasala-datos__item">
			<span class="lasala-datos__num" aria-hidden="true">01</span>
			<span class="lasala-datos__label">Aforo</span>
			<p class="lasala-datos__valor">220</p>
			<p class="lasala-datos__desc">personas de pie · 120 sentadas</p>
		</div>
		<div class="lasala-datos__item">
			<span class="lasala-datos__num" aria-hidden="true">02</span>
			<span class="lasala-datos__label">Equipamiento</span>
			<p class="lasala-datos__desc">PA line array, mesa digital de 32 canales, iluminación DMX, backline básico bajo petición.</p>
		</div>
		<div class="lasala-datos__item">
			<span class="lasala-datos__num" aria-hidden="true">03</span>
			<span class="lasala-datos__label">Ubicación</span>
			<p class="lasala-datos__desc">C. Aniceto Sáenz, 1 — junto a la Plaza del Pumarejo, a 10 min de la Alameda.<br><a href="/contacto/#como-llegar" class="lasala-datos__link">Ver mapa y cómo llegar →</a></p>
		</div>
		<div class="lasala-datos__item">
			<span class="lasala-datos__num" aria-hidden="true">04</span>
			<span class="lasala-datos__label">Barra</span>
			<p class="lasala-datos__desc">Cócteles de autor, cervezas artesanas locales y buena selección sin alcohol.</p>
		</div>
	</div>
</section>

<section class="alquiler" data-component="alquiler" id="alquila-la-sala">
	<div class="alquiler__inner">
		<div class="section__index">03</div>
		<h2 class="alquiler__titular">ALQUILA<br>LA SALA</h2>

		<p class="alquiler__pregunta">¿Tienes un proyecto, una presentación,<br>una fiesta o un evento?</p>
		<p class="alquiler__texto">Sala SVQ también puede convertirse en tu espacio.</p>

		<ul class="alquiler__lista">
			<li>Conciertos</li>
			<li>Eventos privados</li>
			<li>Presentaciones</li>
			<li>Rodajes</li>
			<li>Sesiones</li>
			<li>Fiestas</li>
			<li>Empresas</li>
			<li>Actividades culturales</li>
		</ul>

		<a class="btn btn--yellow alquiler__cta" href="/contacto/?asunto=alquiler">
			<span>Solicitar información</span>
			<svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M3 10h13M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.8"/></svg>
		</a>
		<span class="hand-note hand-note--light">¡te esperamos!</span>
	</div>
</section>

<?php get_footer(); ?>
