<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package politeunivers
 */
use Log1x\Navi\Navi;
global $woocommerce;

$navigation = new Navi();
$primary_menu = $navigation->build('menu-1', [
    'theme_location' => 'menu-1',
]); 

?>

<header id="masthead" class="fixed w-full z-50">
    <nav id="site-navigation" aria-label="<?php esc_attr_e('Main Navigation', 'politeunivers'); ?>" class="">
        <div id="navigation-wrapper-main" class="md:w-[95%] mx-auto flex justify-between items-center md:h-24">
				<button class="openbtn  w-14 md:w-24" onclick="openNav()">☰</button>
            <div class="nav-brand text-xl text-black flex items-center">
                <a href="<?= get_site_url(); ?>" class="font-bembo_regular">
                    Politeunivers
                </a>
            </div>

			<?php if ( $navigation->isNotEmpty() ) : ?>
		<ul id="primary-menu"style="display:flex;">
					<?php foreach ( $navigation->all() as $item ) : ?>
						<li class="list-items-parents text-black hover:underline <?=  ($item->children) ? 'dropdown-menu-shop' : '' ?> mx-3">
							<a href="<?php echo esc_url($item->url); ?>" class="hover:underline font-bembo_regular">
								<?php echo $item->label; ?>
							</a>
						</li>
					<?php endforeach; ?>
		</ul>
	<?php endif; ?>
        <div class="nav-tool w-14 md:w-24 flex items-center justify-end">
                <a class="cart-icon relative px-2 py-2" href="<?= wc_get_cart_url(); ?>">
                    <img width="20px" class="style-svg" src="https://politeunivers.com/wp-content/uploads/2024/11/grocery-store.png" alt="Cart" data-skip-lazy />
                    <span class="badge badge-cart absolute top-0 right-0">
                        <?= ($woocommerce->cart->cart_contents_count != 0 ? $woocommerce->cart->cart_contents_count : ''); ?>
                    </span>
                </a>
            </div>
        </div>

		<?php if ( $navigation->isNotEmpty() ) : ?>
				<ul id="primary-menu-overlay" class="w-full grid grid-rows-4 grid-cols-12 hidden transition-all">
					<?php foreach ( $navigation->all() as $item ) : ?>
							<?php if ( $item->children ) : ?>
								<ul class="row-span-2 overlay-left-menu-items col-span-3 grid grid-rows-4 grid-cols-2 text-black">
									<?php foreach ( $item->children as $child ) : ?>
										<li class="hover:underline font-bembo_regular">
											<a href="<?php echo esc_url($child->url); ?>">
												<?php echo $child->label; ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
								
							<?php endif; ?>
					<?php endforeach; ?>
					<ul class="col-span-9 row-span-4 text-end flex flex-row w-full"><?php
						$args = array(
							'taxonomy' => 'product_cat',
							'number' => 5, // Limit to 5 categories
						);

						$product_categories = get_terms($args);

						if (!empty($product_categories)) {
							foreach ($product_categories as $category) {
								$category_image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
								$category_image_url = wp_get_attachment_url($category_image_id);

								?>
								<a href="<?php echo esc_url(home_url('/product-category/' . $category->slug)); ?>"  class=" contents w-full">
									<div class="category-item grid grid-rows-9  h-full">
										<div class="wrapper-image flex items-center row-span-6 overflow-hidden border border-black">
											<img class="h-full w-full object-cover bg-center" data-skip-lazy src="<?= esc_url($category_image_url)?>" alt="<?= esc_html($category->name) ?>" loading="lazy">
										</div>
										<h2 class=" text-left text-black font-bembo_regular"> <?=$category->name?></h2>
									</div>
								</a>
								<?php 
							}
						} else {
							echo 'No product categories found.';
						}
						?>
						</ul>
				</ul>
	<?php endif; ?>
    </nav>
			<div id="mobile-menu-overlay">

			<?php if ( $navigation->isNotEmpty() ) : ?>
				<ul id="mobile-menu-overlay-wrapper">
					<?php foreach ( $navigation->all() as $item ) : ?>
						<li class="list-items-parents text-white hover:underline mx-3 font-bembo_regular">
							<a href="<?php echo $item->url; ?>" class="hover:underline">
								<?php echo $item->label; ?>
							</a>
						</li>
						<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<!-- exit button  -->
				<div class="exit-btn text-white text-3xl">
					<button class="closebtn" onclick="closeNav()">×</button>
				</div>

			</div>
</header>
