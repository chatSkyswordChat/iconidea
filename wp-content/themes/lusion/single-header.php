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
    <div id="page" class="show-template-header">
        <div id="primary" class="content-area">
            <?php
            $choose_header_builder = Lusion::setting('choose_header_builder');
            $header_type = lusion_get_meta_value('header_type');
            $header_class ='';
            if (!empty($header_type) && $header_type !=='default'){
                $header_class=$header_type;
            }else{
                $header_class=$choose_header_builder;
            }
            ?>
            <header class="site-header header-builder <?php echo esc_attr($header_class);?>">
                <?php
                /* Start the Loop */
                while (have_posts()) : the_post();
                    the_content();
                endwhile; // End of the loop.
                ?>
            </header> <!-- End header -->
        </div> <!-- End primary -->
    </div> <!-- End page -->
</body>
<?php wp_footer(); ?>
</html>
