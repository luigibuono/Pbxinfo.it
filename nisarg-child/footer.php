<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Nisarg
 */
?>
	</div><!-- #content -->
	<footer id="colophon" class="site-footer bg-dark text-white py-4" role="contentinfo">
		<div class="container">
			<div class="row">
				<!-- Sezione Articoli Recenti -->
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Articoli Recenti', 'nisarg' ); ?></h3>
					<ul class="list-unstyled">
						<?php
						$recent_posts = wp_get_recent_posts(array(
							'numberposts' => 5, // Numero di articoli da mostrare
							'post_status' => 'publish', // Solo articoli pubblicati
						));
						foreach ($recent_posts as $post) :
						?>
							<li>
								<a href="<?php echo esc_url(get_permalink($post['ID'])); ?>" class="text-white">
									<?php echo esc_html($post['post_title']); ?>
								</a>
							</li>
						<?php endforeach; wp_reset_query(); ?>
					</ul>
				</div>

				<!-- Sezione Pagine del Sito -->
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Pagine del Sito', 'nisarg' ); ?></h3>
					<ul class="list-unstyled">
						<?php
						// Escludi la pagina Privacy Policy usando l'ID della pagina
						$pages = get_pages( array(
							'exclude' => 3 // Sostituisci 123 con l'ID della tua pagina Privacy Policy
						) );
						
						foreach ($pages as $page) :
						?>
							<li>
								<a href="<?php echo esc_url(get_permalink($page->ID)); ?>" class="text-white">
									<?php echo esc_html($page->post_title); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>


				<!-- Sezione Sedi Legali -->
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Sedi Legali', 'nisarg' ); ?></h3>
					<ul class="list-unstyled">
						<li>Via Roma 1, Milano</li>
						<li>Corso Italia 20, Torino</li>
						<li>Viale Europa 15, Napoli</li>
						<li>Piazza Duomo 10, Firenze</li>
					</ul>
				</div>

				<!-- Sezione Area Clienti -->
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Area Clienti', 'nisarg' ); ?></h3>
					<ul class="list-unstyled">
						<li><a href="/privacy-policy" class="text-white">Privacy Policy</a></li>
						<li><a href="/support" class="text-white fs-2;">Supporto</a></li>
						<li><a href="/faq" class="text-white">FAQ</a></li>
					</ul>
				</div>
			</div><!-- .row -->

			<!-- Copyright -->
			<div class="row">
				<div class="col-12 text-center mt-4">
					<p class="mb-0">&copy; <?php echo esc_html(date("Y")); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Tutti i diritti riservati.', 'nisarg'); ?></p>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>

<style>
    @media (min-width: 992px) {
    .col-md-3 {
        width: 25%;
    }
}

a:hover, a:focus {
    color: #007bff;
    text-decoration: underline;
}

.site-footer a{
    font-size:1.5rem;
    line-height: 1.2;
}

li{
    margin-bottom:0.5rem;
}
</style>