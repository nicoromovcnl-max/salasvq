<?php
/**
 * Componente: CategoryGrid.
 * Recibe $section (array normalizado del flexible content 'categorias').
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $args ) && is_array( $args ) ) {
	extract( $args, EXTR_SKIP );
}

$titular    = $section['titular'] ?? 'PROGRAMACIÓN';
$categorias = salasvq_get_categorias();
?>
<section class="section categorias" data-component="category-grid">
	<div class="section__head section__head--simple">
		<div class="section__index">03</div>
		<h2 class="section__titular section__titular--inline"><?php echo esc_html( $titular ); ?></h2>
	</div>

	<div class="category-grid">
		<?php foreach ( $categorias['items'] as $cat ) : ?>
			<a class="category-card tag--<?php echo esc_attr( $cat['color'] ); ?>" href="<?php echo esc_url( $cat['url'] ?? '#' ); ?>">
				<div class="category-card__media">
					<img src="<?php echo esc_url( $cat['imagen'] ); ?>" alt="" loading="lazy">
				</div>
				<div class="category-card__body">
					<h3><?php echo esc_html( mb_strtoupper( $cat['label'] ) ); ?></h3>
					<p><?php echo esc_html( $cat['descripcion'] ); ?></p>
					<span class="category-card__arrow">&rarr;</span>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
</section>
