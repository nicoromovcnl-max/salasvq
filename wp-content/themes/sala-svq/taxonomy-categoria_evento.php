<?php
/**
 * Landing de categoría: /musica/, /humor/, /escena/, /sesiones/, /impro/.
 * Una sola plantilla; el color y el texto editorial cambian según el
 * término, para que cada categoría tenga matiz propio sin duplicar código.
 */

get_header();

$term  = get_queried_object();
$slug  = $term->slug;
$color = get_term_meta( $term->term_id, 'color', true ) ?: 'grey';

$editoriales = array(
	'musica'   => 'Sala SVQ nació como sala de conciertos, y la música sigue siendo el corazón de la programación: de bandas emergentes de Sevilla a artistas ya rodados que buscan un formato pequeño e íntimo. Sonido cuidado, aforo reducido, cero distancia con el escenario.',
	'humor'    => 'El humor en Sala SVQ no es relleno entre conciertos: tiene su propia noche, su propio público y su propio ritmo. Monólogos, work in progress y algún especial grabado en directo, siempre en formato de club.',
	'escena'   => 'La programación de artes escénicas de Sala SVQ apuesta por formatos breves y arriesgados: danza contemporánea, teatro documental, performance. Piezas de 30 a 50 minutos, pensadas para una sala pequeña, no para un teatro.',
	'sesiones' => 'Cuando el escenario se despeja, Sala SVQ se convierte en pista. Sesiones de vinilo, electrónica y DJs residentes hasta bien entrada la noche — la otra cara de la programación, la que empieza cuando termina el concierto.',
	'impro'    => 'La improvisación lleva en Sala SVQ casi tanto tiempo como la sala misma. Formatos de impro teatral en los que nunca se repite la función, construidos en directo a partir de lo que propone el público.',
);
$editorial = $editoriales[ $slug ] ?? $term->description;

/**
 * Personalidad por categoría: mismo sistema de diseño, distinta sensación.
 * musica = dinámica, humor = gráfica, escena = teatral/editorial,
 * sesiones = nocturna, impro = con sello rotado.
 */
$variant = in_array( $slug, array( 'musica', 'humor', 'escena', 'sesiones', 'impro' ), true ) ? $slug : 'otros';

$eventos_cat = salasvq_get_eventos( array( 'limit' => 7, 'categoria_slug' => $slug ) );
$destacado   = $eventos_cat['items'][0] ?? null;
$resto       = array_slice( $eventos_cat['items'], 1, 6 );
?>

<section class="cat-hero cat-hero--<?php echo esc_attr( $variant ); ?> tag--<?php echo esc_attr( $color ); ?>" data-component="cat-hero">
	<span class="cat-hero__index"><?php echo esc_html( mb_strtoupper( $term->name ) ); ?></span>
	<h1 class="cat-hero__titular"><?php echo esc_html( mb_strtoupper( $term->name ) ); ?></h1>
	<?php if ( 'impro' === $variant ) : ?>
		<span class="cat-hero__stamp" aria-hidden="true">IMPROVISADO EN DIRECTO</span>
	<?php endif; ?>
</section>

<?php if ( $destacado ) : ?>
<section class="section cat-destacado cat-destacado--<?php echo esc_attr( $variant ); ?>" data-component="cat-destacado">
	<div class="section__index">01</div>
	<h2 class="section__titular section__titular--tight"><span>PRÓXIMO</span><span>DESTACADO</span></h2>

	<article class="cat-destacado__card">
		<div class="cat-destacado__media">
			<img src="<?php echo esc_url( $destacado['imagen'] ); ?>" alt="<?php echo esc_attr( $destacado['titulo'] ); ?>">
		</div>
		<div class="cat-destacado__body">
			<span class="cat-destacado__fecha"><?php echo esc_html( $destacado['fecha_dia'] . ' ' . $destacado['fecha_mes'] ); ?></span>
			<h3 class="cat-destacado__titulo"><?php echo esc_html( $destacado['titulo'] ); ?></h3>
			<p class="cat-destacado__subtitulo"><?php echo esc_html( $destacado['subtitulo'] ); ?></p>
			<p class="cat-destacado__meta"><?php echo esc_html( $destacado['hora'] ); ?> &nbsp;|&nbsp; <?php echo esc_html( $destacado['precio'] ); ?></p>
			<a class="btn btn--yellow" href="<?php echo esc_url( $destacado['url'] ); ?>">
				<span>Ver evento</span>
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M3 9h11M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.6"/></svg>
			</a>
			<p class="cat-destacado__lugar meta-mono">SALA SVQ · C. ANICETO SÁENZ, 1 · SEVILLA</p>
		</div>
	</article>
</section>
<?php endif; ?>

<?php if ( ! empty( $resto ) ) : ?>
<section class="section cat-agenda" data-component="cat-agenda">
	<div class="section__head section__head--simple">
		<div class="section__index">02</div>
		<h2 class="section__titular section__titular--inline">AGENDA · <?php echo esc_html( mb_strtoupper( $term->name ) ); ?></h2>
	</div>
	<div class="event-grid">
		<?php foreach ( $resto as $evento ) : ?>
			<div class="event-grid__item">
				<?php get_template_part( 'template-parts/event/card', null, array( 'evento' => $evento, 'size' => 'secundario' ) ); ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>

<section class="section cat-editorial cat-editorial--<?php echo esc_attr( $variant ); ?>">
	<div class="section__index">03</div>
	<h2 class="section__titular section__titular--tight"><span>SOBRE</span><span><?php echo esc_html( mb_strtoupper( $term->name ) ); ?></span></h2>
	<p class="cat-editorial__texto <?php echo 'escena' === $variant ? 'lede' : ''; ?>"><?php echo esc_html( $editorial ); ?></p>
</section>

<?php
$galeria_fotos = wp_list_pluck( array_slice( $eventos_cat['items'], 0, 6 ), 'imagen' );
if ( count( $galeria_fotos ) < 3 ) {
	$relleno = array(
		salasvq_demo_photo( 'bar-interior-1', 'la-sala-2.svg' ),
		salasvq_demo_photo( 'standup-mic-1', 'evento-4.svg' ),
		salasvq_demo_photo( 'venue-empty-1', 'la-sala-1.svg' ),
	);
	foreach ( $relleno as $foto ) {
		if ( count( $galeria_fotos ) >= 3 && count( $galeria_fotos ) >= count( $eventos_cat['items'] ) ) {
			break;
		}
		if ( ! in_array( $foto, $galeria_fotos, true ) ) {
			$galeria_fotos[] = $foto;
		}
		if ( count( $galeria_fotos ) >= 3 ) {
			break;
		}
	}
}
?>
<section class="section gallery" data-component="gallery">
	<div class="section__head section__head--simple">
		<h2 class="section__titular section__titular--inline">GALERÍA</h2>
	</div>
	<div class="gallery__track">
		<?php foreach ( $galeria_fotos as $foto ) : ?>
			<figure class="gallery__item"><img src="<?php echo esc_url( $foto ); ?>" alt="" loading="lazy"></figure>
		<?php endforeach; ?>
	</div>
</section>

<section class="cta-strip tag--<?php echo esc_attr( $color ); ?>" data-component="cta-strip">
	<div class="cta-strip__inner">
		<span class="cta-strip__kicker"><?php echo esc_html( mb_strtoupper( $slug ) ); ?></span>
		<h2 class="cta-strip__titular"><span>NO TE PIERDAS</span><span>LA PRÓXIMA</span></h2>
		<a class="btn btn--black" href="<?php echo esc_url( home_url( '/agenda/' ) ); ?>">
			<span>Ver toda la agenda</span>
			<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M3 9h11M10 4l5 5-5 5" stroke="currentColor" stroke-width="1.6"/></svg>
		</a>
	</div>
</section>

<?php get_footer(); ?>
