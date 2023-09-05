<?php
$choose_header_builder = Lusion::setting('choose_header_builder');
$enable_header_custom = lusion_get_meta_value('enable_header_custom');
$header_type = lusion_get_meta_value('header_type');
if (class_exists( 'Apr_Core' )):
    if (isset($header_type) && $header_type == 'default' || is_post_type_archive()=='portfolio') {
        if (Lusion::setting('enable_header_builder') == '1') {
            echo '<div class="header-content">';
            echo \Elementor\Plugin::$instance->frontend->get_builder_content(lusion_get_id_by_slug($choose_header_builder,'header'), true);
            echo '</div>';
        } else {
            get_template_part('templates/header/header-default');
        }
    } else {
        if ($header_type !==''){
            echo '<div class="header-content">';
            echo \Elementor\Plugin::$instance->frontend->get_builder_content(lusion_get_id_by_slug($header_type,'header'), true);
            echo '</div>';
        }else{
            get_template_part('templates/header/header-default');
        }
    }

else:
    get_template_part('templates/header/header-default');
endif;