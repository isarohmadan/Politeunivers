<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package politeunivers
 */

get_header();
?>

	<section id="primary">
		<main id="main">

			<div class="h-screen relative">
				<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
					<h1 class="page-title text-center text-6xl">404</h1>
					<h1 class="page-title text-center"><?php esc_html_e( 'Page Not Found', 'politeunivers' ); ?></h1>
					<p class="text-center"><?php esc_html_e( 'This page could not be found. It might have been removed or renamed, or it may never have existed.', 'politeunivers' ); ?></p>
				</div><!-- .page-content -->
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
