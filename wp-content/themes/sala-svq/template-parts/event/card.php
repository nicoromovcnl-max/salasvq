<?php
/**
 * Componente: EventCard.
 * Espera $evento (array normalizado por salasvq_get_eventos / salasvq_normalize_evento).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $evento ) ) {
	return;
}

$color_class  = 'tag--' . esc_attr( $evento['categoria']['color'] ?? 'grey' );
$estado       = $evento['estado'] ?? '';
$estado_slug  = sanitize_html_class( remove_accents( strtolower( str_replace( ' ', '-', $estado ) ) ) );
$estado_visible = $estado && 'entradas-disponibles' !== $estado_slug;
?>
<article class="event-card<?php echo 'agotado' === $estado_slug ? ' is-agotado' : ''; ?>" data-component="event-card">
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
