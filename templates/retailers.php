<?php 
/* Template Name: retailers */ 
?>

<?php get_header(); ?>
<div class="wrapper-retailers">
    <div class="retailers-headers">
        <h1 class="text-start font-bold text-black"><?= the_title();?></h1>
        <?= get_field('description_retailers')?>
    </div>
    <div class="retailers-grid">
            <h6 class="text-3xl header-country">
                <?= get_field('country')?>
            </h6>
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <?php if (get_field('region_'.$i)): ?>
                    <div class="row-retailers-region">
                        <h6 class="text-2xl text-black"><?=get_field('region_'.$i)?></h6>
                        <p class="normal"><?=get_field('description_region_'.$i)?></p>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
</div>




<?php get_footer(); ?>
