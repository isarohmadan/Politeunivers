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
	<div class="bg-black text-white relative md:grid-cols-2 font-bembo_regular flex items-center width-in-fp">
		<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'footer-menu',
							'container' => 'ul',
							'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
						)
					);
					?>
		<div class="polite-logo flex w-full justify-center md:static md:justify-end items-center">
			<img class="w-44 p-0" src="https://politeunivers.com/wp-content/uploads/2024/11/output-onlinepngtools-2.png" alt="Cart" />
		</div>
	</div>

</footer><!-- #colophon -->
