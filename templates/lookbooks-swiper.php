<?php
/*
Template Name: Swiper Template
Template Post Type: lookbooks
*/
?>

<?php get_header(); ?>

<div class="wrapper-new-arrival h-screen flex items-center my-3">
<div class="new-arrival w-[96%] max-h-[100vh] py-6 mx-auto">
            <!-- Slider main container -->
        <div class="swiper h-full">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
            <?php for ($i = 1; $i <= 21; $i++): ?> 
                <?php if (get_field('image_url_' . $i)): ?>
                <div class="swiper-slide bg-center bg-cover">
                        <div class="product-image-wrapper h-full">
                            <img class="main-image w-full h-full object-cover" src="<?= get_field('image_url_' . $i); ?>" alt="Product Image" data-skip-lazy>
                        </div>
                </div>
                <?php endif; ?>
            <?php endfor; ?>
			</div>

        <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <div class="bg-black h-12 w-full mx-auto text-white font-montserrat flex items-center px-6">
            <a class="text-xl text-white" href="#">
                BERSEMI KEMBALI VOL II
            </a>
        </div>
        </div> 
        </div>

    </div>



<?php get_footer(); ?>