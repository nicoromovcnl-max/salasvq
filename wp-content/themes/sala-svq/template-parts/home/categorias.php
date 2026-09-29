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

// En Home solo se muestran 4: una fila completa, sin dejar una segunda
// fila con 1-2 tarjetas sueltas y espacio vacío al lado. Se priorizan las
// 4 categorías del menú principal (Música/Humor/Escena/Sesiones) sobre
// Impro/Otros, que quedaban delante solo por orden alfabético.
$orden_preferido = array( 'musica', 'humor', 'escena', 'sesiones' );
usort(
	$categorias['items'],
	function ( $a, $b ) use ( $orden_preferido ) {
		$pos_a = array_search( $a['slug'], $orden_preferido, true );
		$pos_b = array_search( $b['slug'], $orden_preferido, true );
		$pos_a = false === $pos_a ? 99 : $pos_a;
		$pos_b = false === $pos_b ? 99 : $pos_b;
		return $pos_a <=> $pos_b;
	}
);
$categorias['items'] = array_slice( $categorias['items'], 0, 4 );
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
