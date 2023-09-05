<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
//remove wpml language selector style
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
class Lusion_WPML{
	//show currency switcher dropdown list
	public static function show_currencies_dropdown($arg = array()){
		?>
			<div class="currency_custom">
				<div class="dib header-currencies dropdown-menu">
					<div id="currencyHolder">
						<?php echo(do_shortcode('[currency_switcher]')); ?>
					</div>
				</div>
			</div>
		<?php
	}
	//show language switcher dropdown list
	public static function show_language_dropdown($arg = array()){
		global $sitepress;
		?>
		<?php if((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id') ): 
		if( !defined( 'ICL_LANGUAGE_CODE' ) && !isset( $sitepress )) {
			return false;
		}
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		$language_text = esc_html__('Come see us', 'lusion');
		if(defined('ICL_LANGUAGE_CODE')) {
			$language_text = ICL_LANGUAGE_CODE;
		}
		?>
			<div class="languges-flags site-header-lang">
				<?php 
				if(!empty($languages)){
					foreach ($languages as $l_active) {
						if ($l_active['active'] == 1) {
							echo '<div class="lang-'.$l_active['active'].'">';
							//echo '<i class = "theme-icon-settings"></i>' ;
							echo '<a class="link-language" href="'.$l_active['url'].'">'.$l_active['translated_name'].'<i class = "theme-icon-settings"></i></a>';
							echo '</div>';
						}
					}
					echo '<div class="language-content">';
						echo '<h4 class = "title-lang"> ' . esc_html__('Come see us','lusion') . '</h4>';
						echo '<ul class="content-filter languges ">';
						foreach($languages as $l){
							if ($l['active'] == 0) {
								echo '<li><a class="lang-'.$l['active'].'" href="'.$l['url'].'">';
								echo '<span>'.$l['translated_name'].'</span>';
								echo '</a></li>';
							}
						}
						echo '</ul>';
					echo '</div>';

                    echo '<div class="language-content__text">';
                        echo '<div  class="content-filter languges ">';
                            echo '<ul>';
                            foreach($languages as $l){
                                if ($l['active'] == 0) {
                                    echo '<li><a class="lang-'.$l['active'].'" href="'.$l['url'].'">';
                                    echo '<img src="'.$l['country_flag_url'].'" alt="'.$l['translated_name'].'">';
                                    echo '<span>'.$l['translated_name'].'</span>';
                                    echo '</a></li>';
                                }
                            }
                            echo '</ul>';
                        echo '</div>';
				    echo '</div>';
				}
				?>
			</div>
		<?php elseif((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && unction_exists('is_plugin_active') ):?>
			<?php if(function_exists('pll_the_languages') && function_exists('pll_current_language')): ?>
			<div class="languges-flags site-header-lang">
				<div class="lang-1">
                    <i class = " language-icon  theme-icon-settings"></i>
                    <a class="link-language" href="#"><?php echo esc_html__('EN', 'lusion') ?> <i class = "theme-icon-download"></i></a>
                </div>
				<div class="language-content">
					<h4 class = "title-lang"> 
						<?php echo esc_html__('Come see us','lusion');?>
					</h4>
					<div  class="content-filter languges ">
						<ul><?php pll_the_languages(array('show_flags'=>1,'show_names'=>1));?></ul>
			            <?php if (is_active_sidebar('info_header')) { ?>
		                	<div class="text-content-language">
								<?php dynamic_sidebar('info_header'); ?>	
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="language-content__text">
                    <h4> <?php echo esc_html__('Come see us','lusion');?> </h4>
					<div  class="content-filter languges ">
						<ul><?php pll_the_languages(array('show_flags'=>1,'show_names'=>1));?></ul>
					</div>
				</div>
			</div>
			<?php endif;?>                
		<?php endif;?>
		<?php
	}
	//demo
	public static function show_language_dropdown_demo($arg = array()){
		?>
			<div class="languges-flags languges-flags-demo site-header-lang">
                <div class="lang-1">
                    <i class = " language-icon theme-icon-settings"></i>
                   	<a class="link-language" href="#"><?php echo esc_html__('English', 'lusion') ?> <i class = "theme-icon-download"></i></a>
                </div>
                <div class="language-content">
					<h4 class = "title-lang"> 
						<?php echo esc_html__('Languages','lusion');?>
					</h4>
	                <div  class="content-filter languges">
	                	<ul>
		                    <li class="icl-en"><a href="#"><?php echo esc_html__('En', 'lusion') ?></a></li>
		                    <li class="icl-en"><a href="#"><?php echo esc_html__('Fr', 'lusion') ?></a></li>
		                    <li class="icl-en"><a href="#"><?php echo esc_html__('De', 'lusion') ?></a></li>
		                </ul>
		                <?php if (is_active_sidebar('info_header')) { ?>
		                	 <div class="text-content-language">
								<?php dynamic_sidebar('info_header'); ?>	
							</div>
						<?php } ?>
						
	                </div>
	            </div>
	            <div class="language-content__text">
	                <div  class="content-filter languges">
	                	<ul>
		                    <li class="icl-en"><a href="#"><?php echo esc_html__('English', 'lusion') ?></a></li>
		                    <li class="icl-en"><a href="#"><?php echo esc_html__('France', 'lusion') ?></a></li>
		                    <li class="icl-en"><a href="#"><?php echo esc_html__('Germany', 'lusion') ?></a></li>
		                </ul>
	                </div>
	            </div>
			</div>  
		<?php
	}
}
