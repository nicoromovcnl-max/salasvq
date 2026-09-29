<?php
/**
 * Componente: EventGrid + FilterBar (sección "Próximos eventos").
 * Recibe $section (array normalizado del flexible content 'eventos').
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $args ) && is_array( $args ) ) {
	extract( $args, EXTR_SKIP );
}

$titular = $section['titular'] ?? "PRÓXIMOS\nEVENTOS";
$limite  = ! empty( $section['limite'] ) ? (int) $section['limite'] : 4;
$lineas  = array_filter( array_map( 'trim', explode( "\n", $titular ) ) );

$categorias = salasvq_get_categorias();
$eventos    = salasvq_get_eventos( array( 'limit' => $limite ) );

$filtros = array_merge(
	array( array( 'slug' => 'todos', 'label' => 'Todos' ) ),
	array_map(
		function ( $cat ) {
			return array( 'slug' => $cat['slug'], 'label' => $cat['label'] );
		},
		array_slice( $categorias['items'], 0, 4 )
	)
);
?>
<section class="section eventos" data-component="event-grid" id="agenda">
	<div class="section__head">
		<div class="section__index">01</div>

		<h2 class="section__titular">
			<?php foreach ( $lineas as $linea ) : ?>
				<span><?php echo esc_html( $linea ); ?></span>
			<?php endforeach; ?>
		</h2>

		<a class="section__link" href="<?php echo esc_url( home_url( '/agenda/' ) ); ?>">
			<span class="section__link-arrow">&rarr;</span>
			<span>Ver toda la agenda</span>
		</a>

		<nav class="filter-bar" data-filter-bar aria-label="Filtrar eventos por categoría">
			<?php foreach ( $filtros as $i => $filtro ) : ?>
				<button type="button" class="filter-bar__item<?php echo 0 === $i ? ' is-active' : ''; ?>" data-filter="<?php echo esc_attr( $filtro['slug'] ); ?>">
					<?php echo esc_html( mb_strtoupper( $filtro['label'] ) ); ?>
				</button>
			<?php endforeach; ?>
		</nav>
	</div>

	<?php if ( ! empty( $eventos['is_demo'] ) ) : ?>
		<p class="demo-notice">Contenido de ejemplo — se sustituirá por eventos reales gestionados desde WordPress.</p>
	<?php endif; ?>

	<div class="event-grid" data-events-grid>
		<?php foreach ( $eventos['items'] as $evento ) : ?>
			<div class="event-grid__item" data-category="<?php echo esc_attr( $evento['categoria']['slug'] ); ?>">
				<?php get_template_part( 'template-parts/event/card', null, array( 'evento' => $evento, 'size' => 'secundario' ) ); ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
