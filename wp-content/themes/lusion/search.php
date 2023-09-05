<?php 
get_header(); 
$cols = Lusion_Global::get_page_sidebar();
?>
<?php get_sidebar('left'); ?> 
	<div class="<?php echo esc_attr($cols);?>">
		<div id="primary" class="content-area">
            <?php if (have_posts()): ?>   
               <?php get_template_part( 'templates/content', 'blog-archive' ); ?>
             <?php else: ?> 
			    <article id="post-0" class="post no-results not-found">
		            <h1 class="entry-title not-found-title"><?php echo esc_html__('Nothing Found', 'lusion'); ?></h1>
                    <div class="entry-content">
                        <p><?php echo esc_html__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'lusion'); ?></p>
                        <div class="widget widget_search">
                        <?php get_search_form(); ?>
                        </div>                       
                    </div><!-- .entry-content -->		            
			    </article><!-- #post-0 -->
             <?php endif; ?>
		</div> <!-- End primary -->
	</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?>