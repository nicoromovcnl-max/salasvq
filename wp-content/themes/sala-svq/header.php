<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( ! has_site_icon() ) : ?>
		<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( SALASVQ_URI . '/assets/img/brand/logo.svg' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Saltar al contenido', 'sala-svq' ); ?></a>

<?php get_template_part( 'template-parts/layout/header' ); ?>

<main id="main">
