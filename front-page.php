<?php 
get_header();  

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package politeunivers
 */

?>
   <?php 
        if(is_front_page(  )){ ?>
            <!-- get template of the front-page -->
            <?php get_template_part('template-parts/fp/fp' , 'home' ); ?>
        <?php } ?>
<?php
get_footer();?>