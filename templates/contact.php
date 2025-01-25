<?php /* Template Name: About Us */ ?>

<?php get_header(); ?>
<div class="main-about-jumbotron width-in-about h-full">
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


	<div class="banner-about width-in-about">
		<div class="main-image">
			<img class="w-full h-full object-cover" src="<?= get_field('banner_about_2')?>" alt="">
		</div>
		<div class="inline-description">
			<h1 class="text-2xl">
					<?= get_field('banner_slogan') ?>
			</h1>
		</div>
	</div>  


    <div class="cards-gallery flex m-9 flex-col border border-black mx-auto md:flex-row width-in-about">
        <div class="img-about-1 border border-black">
            <img src="<?= get_field('image_1') ?>" alt="" data-skip-lazy>
        </div>
        <div class="img-about-2 border border-black">
            <img src="<?= get_field('image_2') ?>" alt="" data-skip-lazy>
        </div>
        <div class="img-about-3 border border-black">
            <img src="<?= get_field('image_3') ?>" alt="" data-skip-lazy>
        </div>
    </div>


    <!-- main jumbotron video -->
    <div class="main-jumbotron-video width-in-about md:mb-0 h-screen relative ">
        <div class="h-screen w-full absolute top-0 md:static">
            <video class="bg-center w-full h-full object-cover main-jumbotron-video-image" autoplay muted loop playsinline data-skip-lazy>
                <source src="<?= get_field('mp4_campaign_video') ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="description absolute w-full md:top-0 md:left-0 md:-translate-x-0  md:-translate-y-0  md:static md:border-t border-black mt-6 pt-3">
            <h2 class="capitalize  text-center md:text-left text-3xl font-bold text-white font-bembo_regular ">
                politeunivers
            </h2>
        </div>
    </div>


<?php get_footer(); ?>