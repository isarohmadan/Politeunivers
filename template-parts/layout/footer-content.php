<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *>
 * @package politeunivers
 */

?>

<footer id="colophon">
	<div class="bg-black text-white relative h-64 grid md:grid-cols-2 md:px-6">
		<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'footer-menu',
							'container' => 'ul',
							'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
						)
					);
					?>
		<div class="polite-logo absolute top-0 flex w-full justify-center md:static md:justify-end items-center">
			<img class="w-44 p-0" src="<?= get_template_directory_uri().'/asset/icons/P.png'; ?>" alt="Cart" />
		</div>
	</div>

</footer><!-- #colophon -->
