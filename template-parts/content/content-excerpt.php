<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="post-type-logbooks">
    <a href="<?= get_permalink() ?>" class="contents">
		<div class="logbooks-achieve-image-wrapper overflow-hidden">
        <img src="<?= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0] ?>" class="bg-center w-full object-cover" data-skip-lazy alt="">
		</div>
    <header class="entry-header">
        <?php
        if (is_sticky() && is_home() && !is_paged()) {
            printf('%s', esc_html_x('Featured', 'post', 'politeunivers'));
        }
        the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        ?>
    </header>
		    </a>
</article>
