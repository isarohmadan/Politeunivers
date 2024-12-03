<?php /* Template Name: about */ 
//  get_field('jumbotron1') 
// get_field('about_title')
// get_field('about_description') 
 get_header(); ?>

<!-- Jumbotron -->

<div class="main-about-jumbotron h-full">
    <div class="image-about-jumbotron ">
        <img src="<?= get_field('jumbotron_image') ?>" alt="">
    </div>
    <div class="description-about-jumbotron flex flex-row justify-center">
        <h1 id="about_title" class=" text-3xl w-full">
            <?= get_field('about_title') ?>
        </h1>
        <div id="about-description-wrapper" class="wrapper-about-description font-montserrat text-short">
            <?= get_field('banner_about_description') ?>    

        </div>
        <button id="read-more-btn">Read More</button>
    </div>
</div>


<div class="banner-about">
    <div class="main-image">
        <img class="w-full h-full object-cover" src="<?= get_field('banner_about_2')?>" alt="">
    </div>
    <div class="inline-description">
        <h1 class="text-2xl">
                <?= get_field('banner_slogan') ?>
        </h1>
    </div>
</div>  

<!-- cards gallery -->


    <div class="cards-gallery flex w-full m-9 flex-col border border-black mx-auto md:flex-row md:w-[80%] ">
        <div class="img-about-1 border border-black">
            <img src="<?= get_field('image_1') ?>" alt="">
        </div>
        <div class="img-about-2 border border-black">
            <img src="<?= get_field('image_2') ?>" alt="">
        </div>
        <div class="img-about-3 border border-black">
            <img src="<?= get_field('image_3') ?>" alt="">
        </div>
    </div>


    <!-- main jumbotron video -->
    <div class="main-jumbotron-video mb-6 md:px-5 md:mb-0 h-screen relative md:h-full ">
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


<?php get_footer(); ?>