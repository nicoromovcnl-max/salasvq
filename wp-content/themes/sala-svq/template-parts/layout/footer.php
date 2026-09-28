<?php
/**
 * Componente: Footer.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dir1     = salasvq_option( 'direccion_linea1', 'C. Aniceto Sáenz, 1' );
$dir2     = salasvq_option( 'direccion_linea2', '41003 Sevilla' );
$dir3     = salasvq_option( 'direccion_referencia', 'Junto a la Plaza del Pumarejo' );
$ig       = salasvq_option( 'url_instagram', '#' );
$tiktok   = salasvq_option( 'url_tiktok', '#' );
$spotify  = salasvq_option( 'url_spotify', '#' );
$youtube  = salasvq_option( 'url_youtube', '#' );
?>
<footer class="site-footer" data-component="footer">
	<div class="site-footer__top">
		<div class="site-footer__brand">
			<span>SALA</span>
			<span>SVQ</span>
		</div>

		<address class="site-footer__address">
			<?php echo esc_html( $dir1 ); ?><br>
			<?php echo esc_html( $dir2 ); ?><br>
			<?php echo esc_html( $dir3 ); ?>
		</address>

		<nav class="site-footer__nav" aria-label="Navegación footer">
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
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

		<div class="site-footer__newsletter">
			<p>Suscríbete a la newsletter</p>
			<form class="newsletter-form" action="#" method="post">
				<label class="sr-only" for="newsletter-email">Tu email</label>
				<input type="email" id="newsletter-email" name="email" placeholder="Tu email" required>
				<button type="submit" aria-label="Suscribirse">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5"/></svg>
				</button>
			</form>
		</div>
	</div>

	<div class="site-footer__bottom">
		<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Sala SVQ. Todos los derechos reservados.</p>

		<div class="site-footer__social">
			<a href="<?php echo esc_url( $ig ); ?>" aria-label="Instagram" target="_blank" rel="noopener">IG</a>
			<a href="<?php echo esc_url( $tiktok ); ?>" aria-label="TikTok" target="_blank" rel="noopener">TT</a>
			<a href="<?php echo esc_url( $spotify ); ?>" aria-label="Spotify" target="_blank" rel="noopener">SP</a>
			<a href="<?php echo esc_url( $youtube ); ?>" aria-label="YouTube" target="_blank" rel="noopener">YT</a>
		</div>
	</div>
</footer>
