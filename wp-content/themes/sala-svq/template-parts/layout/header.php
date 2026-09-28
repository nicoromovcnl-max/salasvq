<?php
/**
 * Componente: Header.
 * Reutilizable en toda la web, no solo en la home.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$entradas_url = salasvq_option( 'entradas_url', '#' );
$logo         = salasvq_option( 'logo', '' );
?>
<header class="site-header" data-component="header">
	<div class="site-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo" aria-label="Sala SVQ — Inicio">
			<?php if ( $logo ) : ?>
				<img src="<?php echo esc_url( $logo ); ?>" alt="Sala SVQ" class="site-header__logo-img">
			<?php else : ?>
				<span>SALA</span>
				<span>SVQ</span>
			<?php endif; ?>
		</a>

		<nav class="site-header__nav" aria-label="Navegación principal">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'depth'          => 1,
					)
				);
			} else {
				?>
				<a href="<?php echo esc_url( home_url( '/agenda/' ) ); ?>">Agenda</a>
				<a href="<?php echo esc_url( home_url( '/musica/' ) ); ?>">Música</a>
				<a href="<?php echo esc_url( home_url( '/humor/' ) ); ?>">Humor</a>
				<a href="<?php echo esc_url( home_url( '/escena/' ) ); ?>">Escena</a>
				<a href="<?php echo esc_url( home_url( '/la-sala/' ) ); ?>">La Sala</a>
				<a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a>
				<?php
			}
			?>
		</nav>

		<div class="site-header__actions">
			<a class="btn btn--yellow" href="<?php echo esc_url( $entradas_url ); ?>">
				<span>Entradas</span>
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"/></svg>
			</a>

			<button class="site-header__icon-btn" type="button" aria-label="Buscar">
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/><path d="M16 16l-3.5-3.5" stroke="currentColor" stroke-width="1.5"/></svg>
			</button>

			<button class="site-header__burger" type="button" aria-label="Abrir menú" aria-expanded="false" data-menu-toggle>
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>

	<div class="site-header__mobile-nav" data-mobile-nav>
		<a href="<?php echo esc_url( home_url( '/agenda/' ) ); ?>">Agenda</a>
		<a href="<?php echo esc_url( home_url( '/musica/' ) ); ?>">Música</a>
		<a href="<?php echo esc_url( home_url( '/humor/' ) ); ?>">Humor</a>
		<a href="<?php echo esc_url( home_url( '/escena/' ) ); ?>">Escena</a>
		<a href="<?php echo esc_url( home_url( '/la-sala/' ) ); ?>">La Sala</a>
		<a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a>
		<a class="btn btn--yellow" href="<?php echo esc_url( $entradas_url ); ?>">Entradas →</a>
	</div>
</header>
