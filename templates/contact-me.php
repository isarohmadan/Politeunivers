<?php 
/* Template Name: Contact Page */
get_header(); 
?>

<div class="page-wrapper">
    <!-- Background Image -->
    <div class="background-wrapper">
        <?php 
        // Get featured image from the current page
        if (has_post_thumbnail()) {
            $background_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
        } else {
            // Fallback image if no featured image is set
            $background_image = get_template_directory_uri() . '/assets/images/default-background.jpg';
        }
        ?>
        <img src="<?=wp_get_attachment_image_src( get_post_thumbnail_id( wc_get_page_id( 'shop' ) ), 'full' )[0]?>" class="contact-background" data-skip-lazy alt="">
    </div>  

    <!-- Contact Form Container -->
    <div id="content-contact">
        <div class="header">
            Politeunivers
        </div>
        <?php echo do_shortcode('[contact-form-7 id="1234" title="Contact form 1"]'); ?>
    </div>
</div>

<?php get_footer(); ?>