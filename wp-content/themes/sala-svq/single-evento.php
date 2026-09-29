<?php
/**
 * Single Evento (/eventos/nombre-evento/).
 *
 * Tratado como un cartel editorial digital: portada tipo póster (fecha
 * enorme + categoría + título a escala brutal + imagen a pantalla completa),
 * seguido de un magazine spread (info/artista/texto) y cierre en galería +
 * relacionados. No es una ficha de producto.
 */

get_header();

while ( have_posts() ) :
	the_post();

	$evento = salasvq_normalize_evento( get_post() );

	$apertura     = get_field( 'apertura_puertas' ) ?: '';
	$artista      = get_field( 'artista_nombre' ) ?: $evento['titulo'];
	$artista_desc = get_field( 'artista_descripcion' ) ?: '';
	$artista_img  = get_field( 'artista_imagen' ) ?: '';
	$galeria      = get_field( 'galeria_evento' ) ?: array();
	$entradas_url = get_field( 'url_entradas' ) ?: salasvq_option( 'entradas_url', '#' );

	$relacionados = salasvq_get_eventos( array( 'limit' => 4 ) );

	$titulo_palabras = preg_split( '/\s+/', trim( $evento['titulo'] ) );
	?>

	<article class="evento-poster" data-component="evento-single">
		<div class="evento-poster__back">
			<a href="<?php echo esc_url( home_url( '/agenda/' ) ); ?>">← Volver a la agenda</a>
		</div>

		<section class="evento-poster__cover">
			<div class="evento-poster__cover-media">
				<img src="<?php echo esc_url( $evento['imagen'] ); ?>" alt="<?php echo esc_attr( $evento['titulo'] ); ?>">
			</div>

			<div class="evento-poster__cover-grid">
				<div class="evento-poster__fecha">
					<span class="evento-poster__fecha-dia"><?php echo esc_html( $evento['fecha_dia'] ); ?></span>
					<span class="evento-poster__fecha-mes"><?php echo esc_html( $evento['fecha_mes'] ); ?></span>
					<span class="evento-poster__fecha-anio"><?php echo esc_html( date_i18n( 'Y', strtotime( get_the_date( 'Y-m-d' ) ) ) ); ?></span>
				</div>

				<span class="tag tag--<?php echo esc_attr( $evento['categoria']['color'] ); ?> evento-poster__tag"><?php echo esc_html( mb_strtoupper( $evento['categoria']['label'] ) ); ?></span>

				<h1 class="evento-poster__titular">
					<?php foreach ( $titulo_palabras as $palabra ) : ?>
						<span><?php echo esc_html( $palabra ); ?></span>
					<?php endforeach; ?>
				</h1>

				<?php if ( ! empty( $evento['subtitulo'] ) ) : ?>
					<p class="evento-poster__subtitulo"><?php echo esc_html( mb_strtoupper( $evento['subtitulo'] ) ); ?></p>
				<?php endif; ?>
			</div>

			<span class="evento-poster__stamp" aria-hidden="true">SALA SVQ · SEVILLA</span>
		</section>

		<section class="evento-poster__ficha">
			<div class="evento-poster__ficha-item">
				<span class="meta-mono">HORA</span>
				<p><?php echo esc_html( $evento['hora'] ); ?></p>
			</div>
			<?php if ( $evento['precio'] ) : ?>
				<div class="evento-poster__ficha-item">
					<span class="meta-mono">PRECIO</span>
					<p><?php echo esc_html( $evento['precio'] ); ?></p>
				</div>
			<?php endif; ?>
			<div class="evento-poster__ficha-item">
				<span class="meta-mono">SALA</span>
				<p>Sala SVQ<br><span class="evento-poster__muted">C. Aniceto Sáenz, 1</span></p>
			</div>
			<a class="btn btn--yellow evento-poster__cta" href="<?php echo esc_url( $entradas_url ); ?>">
				<span>Comprar entradas</span>
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M3 9h11M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.6"/></svg>
			</a>
		</section>

		<section class="section evento-poster__spread">
			<div class="evento-poster__col-texto">
				<div class="section__index">01</div>
				<h2 class="evento-poster__label">Sobre el evento</h2>
				<div class="evento-poster__texto"><?php the_content(); ?></div>

				<dl class="evento-poster__detalles">
					<?php if ( $apertura ) : ?>
						<dt>Apertura de puertas</dt><dd><?php echo esc_html( $apertura ); ?></dd>
					<?php endif; ?>
					<dt>Dirección</dt><dd>C. Aniceto Sáenz, 1 (Sevilla)</dd>
					<dt>Edad</dt><dd>Todos los públicos</dd>
				</dl>
			</div>

			<div class="evento-poster__col-artista">
				<span class="eyebrow">ARTISTA</span>
				<div class="evento-poster__artista-media">
					<?php if ( $artista_img ) : ?>
						<img src="<?php echo esc_url( $artista_img ); ?>" alt="<?php echo esc_attr( $artista ); ?>">
					<?php else : ?>
						<img src="<?php echo esc_url( $evento['imagen'] ); ?>" alt="<?php echo esc_attr( $artista ); ?>">
					<?php endif; ?>
				</div>
				<p class="evento-poster__artista-nombre"><?php echo esc_html( $artista ); ?></p>
				<?php if ( $artista_desc ) : ?>
					<p class="evento-poster__artista-desc"><?php echo esc_html( $artista_desc ); ?></p>
				<?php endif; ?>
			</div>
		</section>

		<?php if ( ! empty( $galeria ) ) : ?>
			<section class="section evento-poster__galeria">
				<div class="section__head section__head--simple">
					<div class="section__index">02</div>
					<h2 class="section__titular section__titular--inline">GALERÍA</h2>
				</div>
				<div class="gallery__track">
					<?php foreach ( $galeria as $img ) : ?>
						<figure class="gallery__item"><img src="<?php echo esc_url( $img ); ?>" alt=""></figure>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="section evento-poster__relacionados">
			<div class="section__head section__head--simple">
				<div class="section__index">03</div>
				<h2 class="section__titular section__titular--inline">TAMBIÉN TE PUEDE INTERESAR</h2>
				<a class="section__link" href="<?php echo esc_url( home_url( '/agenda/' ) ); ?>"><span>Ver toda la agenda</span><span class="section__link-arrow">&rarr;</span></a>
			</div>

			<div class="event-grid">
				<?php
				$count = 0;
				foreach ( $relacionados['items'] as $rel ) :
					if ( $rel['id'] === $evento['id'] ) {
						continue;
					}
					if ( $count >= 3 ) {
						break;
					}
					++$count;
					?>
					<div class="event-grid__item">
						<?php get_template_part( 'template-parts/event/card', null, array( 'evento' => $rel, 'size' => 'secundario' ) ); ?>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</section>
	</article>

	<?php
endwhile;

get_footer();
