<?php
/**
 * Home. Usa el mismo constructor de secciones (page_builder) que
 * cualquier página, leído de la página asignada como portada en
 * Ajustes → Lecturas, con fallback a contenido demo si aún no se ha editado.
 */

get_header();

$sections = salasvq_get_home_sections();
salasvq_render_sections( $sections );

get_footer();
