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
                <a href="<?= get_site_url(); ?>">
                    Politeunivers
                </a>
            </div>

			<?php if ( $navigation->isNotEmpty() ) : ?>
		<ul id="primary-menu"style="display:flex;">
					<?php foreach ( $navigation->all() as $item ) : ?>
						<li class="list-items-parents text-black hover:underline <?=  ($item->children) ? 'dropdown-menu-shop' : '' ?> mx-3">
							<a href="<?php echo $item->url; ?>" class="hover:underline">
								<?php echo $item->label; ?>
							</a>
						</li>
					<?php endforeach; ?>
		</ul>
	<?php endif; ?>
        <div class="nav-tool w-14 md:w-24 flex items-center justify-end">
                <a class="cart-icon relative px-2 py-2" href="<?= wc_get_cart_url(); ?>">
                    <img class="style-svg" src="<?= get_template_directory_uri() . '/asset/icons/cart.svg'; ?>" alt="Cart" />
                    <span class="badge badge-cart absolute top-0 right-0">
                        <?= ($woocommerce->cart->cart_contents_count != 0 ? $woocommerce->cart->cart_contents_count : ''); ?>
                    </span>
                </a>
            </div>
        </div>

		<?php if ( $navigation->isNotEmpty() ) : ?>
				<ul id="primary-menu-overlay" class="w-full grid grid-rows-4 grid-cols-12 h-72 hidden transition-all">
					<?php foreach ( $navigation->all() as $item ) : ?>
							<?php if ( $item->children ) : ?>
								<ul class="row-span-2 col-span-3 grid grid-rows-4 grid-cols-2 text-black p-6">
									<?php foreach ( $item->children as $child ) : ?>
										<li class="hover:underline">
											<a href="<?php echo $child->url; ?>">
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
							'exclude'  => array( get_term_by('slug', 'all-category', 'product_cat')->term_id ), // Exclude "Uncategorized"
						);

						$product_categories = get_terms($args);

						if (!empty($product_categories)) {
							foreach ($product_categories as $category) {
								$category_image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
								$category_image_url = wp_get_attachment_url($category_image_id);

								?>
								<a href="<?php echo esc_url(home_url('/product-category/' . $category->slug)); ?>"  class=" contents w-full">
									<div class="category-item grid grid-rows-8 h-full">
										<div class="wrapper-image row-span-7 overflow-hidden">
											<img class="h-full w-full object-cover bg-center" src="<?= $category_image_url?>" alt="<?= $category->name ?>">
										</div>
										<h2 class=" text-left text-black text-montserrat"> <?=$category->name?></h2>
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
						<li class="list-items-parents text-white hover:underline mx-3">
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
