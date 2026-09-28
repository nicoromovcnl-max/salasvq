<?php
/**
 * Archivo de eventos — página "Agenda" (/agenda/).
 * Usa la misma capa de datos que la home (salasvq_get_eventos), así que
 * en cuanto haya eventos reales en WP esta página los pinta igual.
 */

get_header();

$paged    = max( 1, get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
$eventos  = salasvq_get_eventos( array( 'limit' => 12 ) );
$categorias = salasvq_get_categorias();

$filtros = array_merge(
	array( array( 'slug' => 'todos', 'label' => 'Todos' ) ),
	array_map(
		function ( $cat ) {
			return array( 'slug' => $cat['slug'], 'label' => $cat['label'] );
		},
		$categorias['items']
	)
);
?>
<section class="agenda-hero" data-component="agenda-hero">
	<div class="agenda-hero__inner">
		<span class="agenda-hero__kicker">CARTELERA <?php echo esc_html( gmdate( 'Y' ) . ' — ' . ( gmdate( 'Y' ) + 1 ) ); ?></span>
		<h1 class="agenda-hero__titular">AGENDA</h1>
		<p class="agenda-hero__texto">Conciertos, monólogos, improvisación y otras propuestas culturales en el corazón de Sevilla.</p>
	</div>
	<div class="agenda-hero__media">
		<div class="ph-block">Foto de ambiente / público</div>
	</div>
</section>

<section class="section agenda-list" data-component="agenda-list">
	<nav class="filter-bar filter-bar--wide" data-filter-bar aria-label="Filtrar eventos por categoría">
		<span class="filter-bar__label">Filtrar por:</span>
		<?php foreach ( $filtros as $i => $filtro ) : ?>
			<button type="button" class="filter-bar__item<?php echo 0 === $i ? ' is-active' : ''; ?>" data-filter="<?php echo esc_attr( $filtro['slug'] ); ?>">
				<?php echo esc_html( mb_strtoupper( $filtro['label'] ) ); ?>
			</button>
		<?php endforeach; ?>
	</nav>

	<?php if ( ! empty( $eventos['is_demo'] ) ) : ?>
		<p class="demo-notice">Contenido de ejemplo — se sustituirá por eventos reales gestionados desde WordPress.</p>
	<?php endif; ?>

	<div class="event-grid event-grid--agenda" data-events-grid>
		<?php foreach ( $eventos['items'] as $evento ) : ?>
			<div class="event-grid__item" data-category="<?php echo esc_attr( $evento['categoria']['slug'] ); ?>">
				<?php get_template_part( 'template-parts/event/card', null, array( 'evento' => $evento ) ); ?>
			</div>
		<?php endforeach; ?>
	</div>

	<?php if ( empty( $eventos['is_demo'] ) ) : ?>
		<div class="agenda-list__pagination">
			<?php
			echo wp_kses_post(
				paginate_links(
					array(
						'current'   => $paged,
						'total'     => max( 1, ceil( wp_count_posts( 'evento' )->publish / 12 ) ),
						'prev_text' => '←',
						'next_text' => '→',
					)
				)
			);
			?>
		</div>
	<?php endif; ?>
</section>

<?php get_footer(); ?>
