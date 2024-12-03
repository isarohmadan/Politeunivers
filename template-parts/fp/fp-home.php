

<div class="main-jumbotron mb-6 md:p-5 md:mb-0 relative md:h-full">
        <div class="h-full">
            <!-- Gambar untuk layar kecil -->
            <img id="banner_promotion_1" class="banner-image large-screen" src="<?= get_field('banner_promotion_2') ?>" alt="Promotion Image 1">

            <!-- Gambar untuk layar sedang ke atas -->
            <img id="banner_promotion_2" class="banner-image small-screen" src="<?= get_field('banner-promotion') ?>" alt="Promotion Image 2">
        </div>
        <div class="description hidden md:block w-[70%] md:w-full text-white md:text-black absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:top-0 md:left-0 md:-translate-x-0  md:-translate-y-0  md:static md:border-t border-black mt-6 pt-3">
            <h6 class="capitalize hidden md:block text-center  md:text-left font-montserrat text-xl font-light">
                Now available
            </h6>
            <h2 class="capitalize  text-center md:text-left text-3xl">
                <?= get_field('content_sections_first_header_promo') ?>
            </h2>
        </div>
    </div>


    <?php
    // Fetch WooCommerce products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 6, // Number of products to display
        'orderby' => 'date',
        'order' => 'DESC',
    );
    
    $loop = new WP_Query($args);
    
        if ($loop->have_posts()) { ?>

        <div class="new-arrival w-[96%] py-6 mx-auto">
            <!-- Slider main container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                
            <?php
            while ($loop->have_posts()) : $loop->the_post();
                global $product; 

                // Get main product image
                $main_image_id = $product->get_image_id();
                $main_image_url = wp_get_attachment_url($main_image_id);

                // Get product gallery images
                $gallery_image_ids = $product->get_gallery_image_ids();
                $hover_image_url = !empty($gallery_image_ids) ? wp_get_attachment_url($gallery_image_ids[0]) : $main_image_url;
                ?>
                <div class="swiper-slide bg-center bg-cover">
                    <a class="" href="<?php echo get_permalink($product->get_id()); ?>">
                        <div class="product-image-wrapper relative">
                            <img class="main-image w-full object-cover" src="<?php echo esc_url($main_image_url); ?>" alt="Product Image">
                            <img class="hover-image w-full object-cover absolute top-0 left-0 opacity-0 transition-opacity duration-300 hover:opacity-100" src="<?php echo esc_url($hover_image_url); ?>" alt="Hover Image">
                        </div>
                    </a>
                </div>
            <?php endwhile;
            ?>
                </div>

        <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <div class="bg-black h-12 w-full mx-auto text-white font-montserrat flex items-center px-6">
            <a class="text-m text-white" href="#">
                New Arrival !
            </a>
        </div>
        </div> 
        <?php
        } else {
        // No products found
        echo '';
        }
        wp_reset_postdata();
        ?>

    <!-- Jumbotron Union -->
    <div class="jumbotron-union overflow-hidden w-full grid gap-3 grid-cols-1 md:grid-cols-2 p-3 mt-6 border-black ">
            <a href="<?= get_field('link_page_category_shop_1') ?>" class="w-full contents">
                <div class="mini-jumbotron grid grid-rows-12 gap-3 overflow-hidden my-3 md:my-0">
                    <div class="flex items-center row-span-10 md:row-span-11">
                        <img src="<?= get_field('category_banner_2')?>" class="bg-center w-full w-full object-contain main-jumbotron-image " alt="">
                    </div>
                    <div class="description flex justify-between mt-3 md:mt-0 py-2 md:py-0 mx-1 border-t border-black">
                        <p class="text-2xl max-w-[65%] text-black"><?= get_field('category_shop_1') ?></p>
                        <a href="<?= get_field('link_page_category_shop_1') ?>" class="text-s md:text-m font-montserrat">Shop Now !</a>
                    </div>
                </div>
            </a>
                <a href="<?= get_field('link_category_shop_2') ?>" class="w-full contents">
                <div class="mini-jumbotron grid grid-rows-12 gap-3 overflow-hidden my-3 md:my-0">
                <div class="flex items-center row-span-10 md:row-span-11">
                    <img src="<?= get_field('category_banner_2')?>" class="bg-center w-full w-full object-contain main-jumbotron-image " alt="">
                </div>
                    <div class="description flex justify-between mt-3 md:mt-0 py-2 md:py-0 mx-1 border-t border-black">
                        <p class="text-2xl max-w-[65%] text-black "><?= get_field('category_shop_2') ?></p>
                        <a href="<?= get_field('link_category_shop_2') ?>" class="text-s md:text-m font-montserrat">Shop Now !</a>
                    </div>
                </div>
            </a>
    </div>


    <!-- Blog Info! -->
    <div class="jumbotron-blog-info w-full grid grid-rows-2 md:grid-rows-1 md:grid-cols-12 overflow-hidden grid-flow-col">
        <div class="mini-jumbotron h-full col-span-8">
            <img src="<?= get_field('blog_banner') ?>" class="mini-jumbotron-image object-center object-cover w-full h-full" alt="">
        </div>
        <div class="caption w-full col-span-4 bg-black text-white flex justify-center flex-col gap-2 px-2">
            <h3 class="header-description text-4xl"><?= get_field('header_blog') ?></h3>
                <p class="brief-description text-sm font-montserrat"><?= get_field('description_blog') ?></p>
            <a href="#" class="text-sm font-montserrat  underline decoration-1">Read More</a>
        </div>
    </div>


<!-- main jumbotron video -->
    <div class="main-jumbotron-video mb-6 md:p-5 md:mb-0 h-screen relative md:h-full ">
        <div class="h-full absolute top-0 md:static">
            <video class="bg-center w-full h-full object-cover main-jumbotron-video-image" autoplay muted loop>
                <source src="<?= get_field('mp4_campaign_video') ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="description absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:top-0 md:left-0 md:-translate-x-0  md:-translate-y-0  md:static md:border-t border-black mt-6 pt-3">
            <h2 class="capitalize  text-center md:text-left text-3xl font-bold text-white">
                politeunivers
            </h2>
        </div>
    </div>




