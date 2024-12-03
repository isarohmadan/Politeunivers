<?php
/*
Template Name: Gallery Polite Template
Template Post Type: lookbooks
*/
?>
<?php get_header(); ?>


<!-- http://politeuniversnewest.local/wp-content/uploads/2024/10/output-onlinepngtools.png -->
<div class="title-page-lookbooks-gallery-2">
    <h1 class="text-center font-bold text-black"><?= the_title();?></h1>
</div>
<div class="grid-lookbooks-gallery-2">
    <div class="logo-image">
        <img src="http://politeuniversnewest.local/wp-content/uploads/2024/10/output-onlinepngtools.png" alt="">
    </div>
    <?php for ($i = 1; $i <= 12; $i++): ?>
        <?php if (get_field('image_url_'.$i)): ?>
        <div class="<?= get_field('select_'.$i)?>">
            <img src="<?= get_field('image_url_'. $i) ?>" alt="">
        </div>
        <?php endif; ?>
    <?php endfor; ?>
</div>


<?php get_footer(); ?>