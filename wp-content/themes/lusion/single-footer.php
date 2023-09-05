<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="page" <?php lusion_page_class();?>>
        <div id="primary" class="content-area">
            <?php
            /* Start the Loop */
            while (have_posts()) : the_post();
                the_content();
            endwhile; // End of the loop.
            ?>
        </div> <!-- End primary -->
    </div>
</body>

<?php wp_footer(); ?>
</html>
