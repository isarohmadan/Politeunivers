<?php 
/* Template Name: Contact Page */
get_header(); 
?>

<div class="page-wrapper">
    <!-- Background Image -->
    <!-- Contact Form Container -->
    <div id="content-contact">
        <div class="header">
            Politeunivers
        </div>
        <?php echo do_shortcode('[contact-form-7 id="1234" title="Contact form 1"]'); ?>
    </div>
</div>

<?php get_footer(); ?>