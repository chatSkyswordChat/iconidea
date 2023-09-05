<?php
if ( ! class_exists( 'Apr_Core_Elementor_Template_Widget' ) ) {
    class Apr_Core_Elementor_Template_Widget extends Apr_Widget {
        function __construct() {
            $this->widget_cssclass    = 'elementor-template-widget';
            $this->widget_description = esc_html__( 'Get elementor template.', 'apr-core' );
            $this->widget_id          = 'elementor-template-widget';
            $this->widget_name        = esc_html__( '[APR] Elementor Template', 'apr-core' );
            parent::__construct();
        }
        public function widget( $args, $instance ){
            if (isset($instance['elementor_template'])) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($instance['elementor_template'], true);
            } else {
                echo esc_html__('Template dies or has not been selected','apr-core');
            }
        }
        public function update( $new_instance, $old_instance){
            $instance = $old_instance;
            $instance['elementor_template'] = strip_tags($new_instance['elementor_template']);
            return $instance;
        }
        public function form( $instance){
            $page_templates = get_posts( array(
                'post_type'         => 'elementor_library',
                'posts_per_page'    => -1
            ));
    
            $options = array();
            
            $selected = isset($instance['elementor_template']);
    
            if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
                foreach ( $page_templates as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            }          
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'elementor_template' ); ?>"><?php _e( 'Select a Template:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'elementor_template' ); ?>" name="<?php echo $this->get_field_name( 'elementor_template' ); ?>">
                    <option <?php echo isset($selected) ? '' : 'selected'; ?> value="1"><?php _e( '&mdash; Select &mdash;' ); ?></option>
                    <?php foreach ($options as $key => $value) { ?>
                        <option <?php echo $selected==$key ? 'selected' : ''; ?> value="<?php echo $key; ?>"><?php _e( $value ); ?></option>
                    <?php } ?>
                </select>
            </p>
            <?php
        }
    }
}