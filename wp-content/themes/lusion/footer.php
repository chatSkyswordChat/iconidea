					</div><!-- End row-->
				</div><!-- End container-->
			</div> <!-- End main-->

			<?php
				$lusion_footer_type = Lusion_Global::instance()->set_footer_type();
				$lusion_hide_footer = get_post_meta(get_the_ID(), 'hide_footer', true);
				$lusion_pagination_type = Lusion::setting('pagination_type');
				if(is_category() || is_tax()){
				    $lusion_hide_footer_cat = lusion_get_meta_value('hide_footer', true);
				    if (!$lusion_hide_footer_cat) {
				        $lusion_hide_footer = true;
				    }
				}
				if(!$lusion_hide_footer && $lusion_footer_type != 'none' && !is_404()) {
					Lusion::get_footer_type();
				}
				lusion_purchase_theme_button(); 
				if($lusion_pagination_type == 'infinite_scrolling' && (class_exists('WooCommerce') && (is_shop() || is_tax('product_cat')))){	
				}else{
					Lusion_Templates::recommended_products();
				}
				if(class_exists('WooCommerce') && !is_singular('product')){
					Lusion_Templates::sale_popup();
				}
				wp_deregister_style( 'font-awesome' );
			?>
			<?php do_action('lusion_render_footer'); ?>
        </div> <!-- End page-->
        
        <?php wp_footer(); ?>
    </body>
</html>


