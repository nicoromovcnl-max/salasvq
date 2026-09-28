<?php
/**
 * Single Evento (/eventos/nombre-evento/).
 */

get_header();

while ( have_posts() ) :
	the_post();

	$evento = salasvq_normalize_evento( get_post() );

	$apertura   = get_field( 'apertura_puertas' ) ?: '';
	$artista    = get_field( 'artista_nombre' ) ?: $evento['titulo'];
	$artista_desc = get_field( 'artista_descripcion' ) ?: '';
	$artista_img  = get_field( 'artista_imagen' ) ?: '';
	$galeria      = get_field( 'galeria_evento' ) ?: array();
	$entradas_url = get_field( 'url_entradas' ) ?: salasvq_option( 'entradas_url', '#' );

	$relacionados = salasvq_get_eventos( array( 'limit' => 4 ) );
	?>

	<article class="evento-single" data-component="evento-single">
		<div class="evento-single__back">
			<a href="<?php echo esc_url( home_url( '/agenda/' ) ); ?>">← Volver a la agenda</a>
		</div>

		<header class="evento-single__head">
			<div class="evento-single__intro">
				<span class="tag tag--<?php echo esc_attr( $evento['categoria']['color'] ); ?>"><?php echo esc_html( $evento['categoria']['label'] ); ?></span>
				<h1 class="evento-single__titular"><?php echo esc_html( $evento['titulo'] ); ?></h1>
				<?php if ( ! empty( $evento['subtitulo'] ) ) : ?>
					<p class="evento-single__subtitulo"><?php echo esc_html( mb_strtoupper( $evento['subtitulo'] ) ); ?></p>
				<?php endif; ?>
				<?php if ( get_the_excerpt() ) : ?>
					<p class="evento-single__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>

			<div class="evento-single__quickinfo">
				<div class="evento-single__date-box">
					<span class="evento-single__day"><?php echo esc_html( $evento['fecha_dia'] ); ?></span>
					<span class="evento-single__month"><?php echo esc_html( $evento['fecha_mes'] ); ?></span>
				</div>

				<p><?php echo esc_html( $evento['hora'] ); ?></p>
				<p>Sala SVQ<br><span class="evento-single__muted">C. Aniceto Sáenz, 1, Sevilla</span></p>

				<a class="btn btn--yellow" href="<?php echo esc_url( $entradas_url ); ?>">
					<span>Entradas</span>
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"/></svg>
				</a>

				<?php if ( ! empty( $evento['precio'] ) ) : ?>
					<p class="evento-single__precio"><?php echo esc_html( $evento['precio'] ); ?></p>
				<?php endif; ?>
			</div>

			<div class="evento-single__media">
				<div class="ph-block">Foto principal del evento</div>
			</div>
		</header>

		<div class="section evento-single__body">
			<div class="evento-single__detalles">
				<h2 class="evento-single__label">Detalles</h2>
				<dl>
					<dt>Fecha</dt><dd><?php echo esc_html( $evento['fecha_dia'] . ' ' . $evento['fecha_mes'] ); ?></dd>
					<dt>Hora</dt><dd><?php echo esc_html( $evento['hora'] ); ?></dd>
					<?php if ( $apertura ) : ?>
						<dt>Apertura puertas</dt><dd><?php echo esc_html( $apertura ); ?></dd>
					<?php endif; ?>
					<dt>Precio</dt><dd><?php echo esc_html( $evento['precio'] ?: 'Consultar' ); ?></dd>
					<dt>Sala</dt><dd>Sala SVQ</dd>
					<dt>Dirección</dt><dd>C. Aniceto Sáenz, 1 (Sevilla)</dd>
				</dl>
			</div>

			<div class="evento-single__contenido">
				<h2 class="evento-single__label">Sobre el evento</h2>
				<div class="evento-single__texto"><?php the_content(); ?></div>
			</div>

			<div class="evento-single__artista">
				<h2 class="evento-single__label">Artista</h2>
				<div class="evento-single__artista-card">
					<div class="evento-single__artista-avatar">
						<?php if ( $artista_img ) : ?>
							<img src="<?php echo esc_url( $artista_img ); ?>" alt="<?php echo esc_attr( $artista ); ?>">
						<?php else : ?>
							<div class="ph-block ph-block--sm">Foto</div>
						<?php endif; ?>
					</div>
					<div>
						<p class="evento-single__artista-nombre"><?php echo esc_html( $artista ); ?></p>
						<?php if ( $artista_desc ) : ?>
							<p class="evento-single__artista-desc"><?php echo esc_html( $artista_desc ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php if ( ! empty( $galeria ) ) : ?>
			<section class="section evento-single__galeria">
				<h2 class="evento-single__label">Galería</h2>
				<div class="gallery__track">
					<?php foreach ( $galeria as $img ) : ?>
						<figure class="gallery__item"><img src="<?php echo esc_url( $img ); ?>" alt=""></figure>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="section evento-single__relacionados">
			<div class="section__head section__head--simple">
				<h2 class="section__titular section__titular--inline">También te puede interesar</h2>
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
						<?php get_template_part( 'template-parts/event/card', null, array( 'evento' => $rel ) ); ?>
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
