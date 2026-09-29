<?php
/**
 * Componente: EventCard.
 * Espera $evento (array normalizado por salasvq_get_eventos / salasvq_normalize_evento).
 * Opcional $size: 'destacado' | 'secundario' | 'compacto' (default) — controla
 * el peso visual dentro de la cartelera de Agenda. El compacto se renderiza
 * como fila editorial (fecha grande + título + meta) en vez de tarjeta.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $args ) && is_array( $args ) ) {
	extract( $args, EXTR_SKIP );
}

if ( empty( $evento ) ) {
	return;
}

$size = isset( $size ) ? $size : 'compacto';

$color_class    = 'tag--' . esc_attr( $evento['categoria']['color'] ?? 'grey' );
$estado         = $evento['estado'] ?? '';
$estado_slug    = sanitize_html_class( remove_accents( strtolower( str_replace( ' ', '-', $estado ) ) ) );
$estado_visible = $estado && 'entradas-disponibles' !== $estado_slug;

if ( 'compacto' === $size ) :
	?>
	<article class="event-row<?php echo 'agotado' === $estado_slug ? ' is-agotado' : ''; ?>" data-component="event-card">
		<a class="event-row__link" href="<?php echo esc_url( $evento['url'] ); ?>">
			<div class="event-row__fecha">
				<span class="event-row__day"><?php echo esc_html( $evento['fecha_dia'] ); ?></span>
				<span class="event-row__month"><?php echo esc_html( $evento['fecha_mes'] ); ?></span>
			</div>

			<div class="event-row__media">
				<img src="<?php echo esc_url( $evento['imagen'] ); ?>" alt="<?php echo esc_attr( $evento['titulo'] ); ?>" loading="lazy">
			</div>

			<div class="event-row__body">
				<span class="tag <?php echo esc_attr( $color_class ); ?> event-row__tag"><?php echo esc_html( $evento['categoria']['label'] ); ?></span>
				<h3 class="event-row__title"><?php echo esc_html( $evento['titulo'] ); ?></h3>
				<?php if ( ! empty( $evento['subtitulo'] ) ) : ?>
					<p class="event-row__subtitle"><?php echo esc_html( $evento['subtitulo'] ); ?></p>
				<?php endif; ?>
			</div>

			<div class="event-row__meta">
				<?php if ( $estado_visible ) : ?>
					<span class="event-card__estado event-card__estado--<?php echo esc_attr( $estado_slug ); ?>"><?php echo esc_html( $estado ); ?></span>
				<?php endif; ?>
				<span class="meta-mono"><?php echo esc_html( $evento['hora'] ); ?></span>
				<?php if ( ! empty( $evento['precio'] ) ) : ?>
					<span class="meta-mono event-row__precio"><?php echo esc_html( $evento['precio'] ); ?></span>
				<?php endif; ?>
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true" class="event-row__arrow"><path d="M3 9h11M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.6"/></svg>
			</div>
		</a>
	</article>
	<?php
	return;
endif;
?>
<article class="event-card event-card--<?php echo esc_attr( $size ); ?><?php echo 'agotado' === $estado_slug ? ' is-agotado' : ''; ?>" data-component="event-card">
	<a class="event-card__link" href="<?php echo esc_url( $evento['url'] ); ?>">
		<div class="event-card__media">
			<img src="<?php echo esc_url( $evento['imagen'] ); ?>" alt="<?php echo esc_attr( $evento['titulo'] ); ?>" loading="lazy">

			<div class="event-card__date">
				<span class="event-card__day"><?php echo esc_html( $evento['fecha_dia'] ); ?></span>
				<span class="event-card__month"><?php echo esc_html( $evento['fecha_mes'] ); ?></span>
			</div>

			<?php if ( $estado_visible ) : ?>
				<span class="event-card__estado event-card__estado--<?php echo esc_attr( $estado_slug ); ?>"><?php echo esc_html( $estado ); ?></span>
			<?php endif; ?>

			<span class="tag <?php echo esc_attr( $color_class ); ?>"><?php echo esc_html( $evento['categoria']['label'] ); ?></span>
		</div>

		<div class="event-card__body">
			<h3 class="event-card__title"><?php echo esc_html( $evento['titulo'] ); ?></h3>
			<?php if ( ! empty( $evento['subtitulo'] ) ) : ?>
				<p class="event-card__subtitle"><?php echo esc_html( $evento['subtitulo'] ); ?></p>
			<?php endif; ?>

			<div class="event-card__meta">
				<span><?php echo esc_html( $evento['hora'] ); ?><?php echo ! empty( $evento['precio'] ) ? ' &nbsp;|&nbsp; ' . esc_html( $evento['precio'] ) : ''; ?></span>
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true" class="event-card__arrow"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"/></svg>
			</div>
		</div>
	</a>
</article>
