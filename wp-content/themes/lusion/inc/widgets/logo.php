<?php
if ( ! class_exists( 'Apr_Core_Logo_Widget' ) ) {
    class Apr_Core_Logo_Widget extends Apr_Widget {
        function __construct() {
            $this->widget_cssclass    = 'tm-logo-widget';
            $this->widget_description = esc_html__( 'Get logo info.', 'apr-core' );
            $this->widget_id          = 'tm-logo-widget';
            $this->widget_name        = esc_html__( '[APR] Logo', 'apr-core' );
            parent::__construct();
        }
        public function widget( $args, $instance ){
            $before_widget = '<div id="tm-logo-widget" class="widget tm-logo-widget">';
            $after_widget  = '</div>';
            $before_title  = '<h2 class="widget-title">';
            $after_title   ='</h2>';
            $logo_footer_url = Lusion::setting( 'logo_footer' );
            $logo_footer_page_url = lusion_get_meta_value('logo_footer_page');
            $lusion_name   = get_option('blogname');
            $lusion_description = get_option('blogdescription');
            $des_site = isset( $instance['des_site'] ) ? $instance['des_site'] : $this->settings['des_site']['std'];
            ?>
             <?php
            echo wp_kses_post($args['before_widget']);
                echo '<div class="f-logo">';
                    echo '<a href="'.esc_url( home_url( '/' ) ).'">';
                        if ( $logo_footer_page_url !== '' ) {
                            echo '<img src="'. esc_url($logo_footer_page_url) . '" alt="' . esc_attr(get_bloginfo('blogname', 'display')) . '">';
                        } elseif ($logo_footer_url !== '') {
                            echo '<img src="'. esc_url($logo_footer_url) . '" alt="' . esc_attr(get_bloginfo('blogname', 'display')) . '">';
                        }
                    echo '</a>';
                    if ( $des_site !='' ) {
                        echo '<div class="text">'. esc_html($des_site) .'</div>';
                    }
                echo '</div>';
            echo wp_kses_post($args['after_widget']);
        }
        public function update( $new_instance, $old_instance){
            $instance = $old_instance;
            $instance['show_logo'] = $new_instance['show_logo'];
            $instance['des_site'] = $new_instance['des_site'];
            return $instance;
        }
        public function form( $instance){
            $show_logo  = isset( $instance['show_logo'] ) ? esc_attr( $instance['show_logo'] ) : '';
            $des_site  = isset( $instance['des_site'] ) ? esc_attr( $instance['des_site'] ) : '';
            ?>
            <p>
                <input type="checkbox" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'show_logo' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_logo' )); ?>" value="show" <?php checked( $show_logo, 'show' ); ?>/>
                <label for="<?php echo esc_attr($this->get_field_id( 'show_logo' )); ?>"><?php  esc_html_e( 'Show Logo','apr-core' ); ?></label>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'des_site' )); ?>"><?php  esc_html_e( 'Text Description','apr-core' ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'des_site' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'des_site' )); ?>" value="<?php echo  esc_attr($des_site); ?>"/>

            </p>
            <?php
        }
    }
}