<?php
/**
 * Fallback genérico requerido por WordPress.
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'section page-content' ); ?>>
			<h1 class="section__titular section__titular--inline"><?php the_title(); ?></h1>
			<div class="page-content__body"><?php the_content(); ?></div>
		</article>
		<?php
	endwhile;
else :
	?>
	<section class="section">
		<h1 class="section__titular section__titular--inline">Nada por aquí</h1>
	</section>
	<?php
endif;

get_footer();
