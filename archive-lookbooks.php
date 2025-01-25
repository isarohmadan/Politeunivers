<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package politeunivers
 */

get_header();
?>

	<section id="primary">
		
		<main id="main">
		<?php if ( have_posts() ) : ?>
		<div class="featured-lookbook-wrapper w-full flex items-center justify-center">
			<div class="featured-lookbook flex justify-center gap-6">
				<img src="http://politeunivers.local/wp-content/uploads/2024/11/BERSEMI-KEMBALI-LB-BANNER.jpg" alt="">
				<div class="caption flex justify-center flex-col gap-6">
					<h1 class="text-black text-3xl font-bold">BERSEMI KEMBALI VOL II</h1>
					<a href="">Show More</a>
				</div>
			</div>	
		</div>
	

		<div class="title-lookbooks">
			<h1 class="text-center font-bold text-3xl text-black underline">Previous Seasson</h1>
		</div>


		<div class="article-wrapper">
			<?php
		
			// Start the Loop.
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'excerpt' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			politeunivers_the_posts_navigation();

		else :

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
					
		</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
