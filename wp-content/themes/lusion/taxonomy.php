<?php 
get_header(); 
$lusion_class = lusion_get_layout_class();
?>
<?php get_sidebar('left'); ?> 
	<div class="<?php echo esc_attr($lusion_class);?>">			
		<div id="primary" class="content-area col-md-12 col-xs-12 col-sm-12">
			<?php if(is_tax('portfolio_cat')):?>
				<?php if (have_posts()): ?>
	                <?php get_template_part( 'templates/content', 'portfolio-archive' ); ?>
	            <?php else: ?>
	                <?php get_template_part('content', 'none'); ?>
	            <?php endif; ?>
			<?php else:?>
				 <?php if (have_posts()): ?>
	                <?php get_template_part( 'templates/content', 'blog-archive' ); ?>
	            <?php else: ?>
	                <?php get_template_part('content', 'none'); ?>
	            <?php endif; ?>
			<?php endif;?>
		</div> <!-- End primary -->
	</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?>