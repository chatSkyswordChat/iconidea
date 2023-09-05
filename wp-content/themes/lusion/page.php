<?php
get_header();
$cols = Lusion_Global::get_page_sidebar();
?>
<?php get_sidebar('left'); ?>
    <div class="<?php echo esc_attr( $cols );?>">
        <div id="primary" class="content-area">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'templates/content', 'page' ); ?>
                <?php	if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>
            <?php endwhile; // End of the loop. ?>
        </div><!-- End primary -->
    </div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>