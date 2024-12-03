<?php /* Template Name: about-blank template */ 
//  get_field('jumbotron1') 
// get_field('about_title')
// get_field('about_description') 
 get_header(); ?>


        <div id="blank-about" class="about-description width-in-about h-screen">
            <div class="blank-about-wrapper">
                <div class="blank-header-description">
                    <h1>
                        <?= get_field('about_header') ?>
                    </h1>    
                </div>
                <div class="blank-description font-montserrat">
                    <?= get_field('about_description') ?>    
                </div>
            </div>
      
        </div>



<?php get_footer(); ?>