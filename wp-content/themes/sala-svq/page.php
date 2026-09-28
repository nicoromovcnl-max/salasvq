<?php
/**
 * Página genérica: renderiza su propio "page_builder" (flexible content).
 * Si la página no tiene secciones definidas, cae al editor clásico/bloques.
 */

get_header();

while ( have_posts() ) :
	the_post();

	$sections = function_exists( 'get_field' ) ? get_field( 'page_builder' ) : false;

	if ( ! empty( $sections ) ) {
		salasvq_render_sections( $sections );
	} else {
		?>
		<article <?php post_class( 'section page-content' ); ?>>
			<h1 class="section__titular section__titular--inline"><?php the_title(); ?></h1>
			<div class="page-content__body"><?php the_content(); ?></div>
		</article>
		<?php
	}

endwhile;

get_footer();
