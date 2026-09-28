<?php
/**
 * Sala SVQ theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SALASVQ_VERSION', '0.1.0' );
define( 'SALASVQ_DIR', get_template_directory() );
define( 'SALASVQ_URI', get_template_directory_uri() );

require SALASVQ_DIR . '/inc/setup.php';
require SALASVQ_DIR . '/inc/helpers.php';
require SALASVQ_DIR . '/inc/cpt-evento.php';
require SALASVQ_DIR . '/inc/acf-fields.php';
require SALASVQ_DIR . '/inc/acf-options.php';
require SALASVQ_DIR . '/inc/section-router.php';
