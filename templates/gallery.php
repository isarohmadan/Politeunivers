<?php
/**
 * Template Name: gallery
 */

get_header();


?>
    <div class="img-container">
        
    </div>

<div class="swiper mySwiper max-h-100">
        <div class="swiper-wrapper">
            <?php for ($i = 1; $i <= 21; $i++): ?>
                <?php if (get_field('image_url_' . $i)): ?>
                    <div class="swiper-slide">
                        <img class="image-swiper" src="<?= get_field('image_url_' . $i) ; ?>"alt="">
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
    </div>
</div>


<?php
get_footer();
