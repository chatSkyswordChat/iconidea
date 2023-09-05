<?php
class Apr_Core_Active_Theme_Settings {

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
		add_action('admin_notices', array($this, 'general_admin_notice'));
    }

    /**
     * Add options page
     */
    public function add_plugin_page() {
        // This page will be under "Settings"
        add_options_page(
            'Active Theme', 'Activate Theme', 'manage_options', 'active-theme', array($this, 'create_admin_page')
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option('arrowpress_active');
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('arrowpress_active_theme');
                do_settings_sections('active-theme');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {
        register_setting(
            'arrowpress_active_theme', // Option group
            'arrowpress_active' // Option name
        );

        add_settings_section(
            'general_setting', // ID
            'General Settings', // Title
            array($this, 'check_license_key'), // Callback
            'active-theme' // Page
        );

        add_settings_field(
            'license_key', 'License key', array($this, 'license_key_id_callback'), 'active-theme', 'general_setting'
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function license_key_id_callback() {
        printf(
            '<input type="text" id="license_key" size="100" name="arrowpress_active[license_key]" value="%s" />', isset($this->options['license_key']) ? esc_attr($this->options['license_key']) : ''
        );
		printf('<p>You need to enter the purchase code to use the theme.</p>');
		printf('<p class="note"><span>Purchase Code. <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">How to get it ?</a></span></p>');
    }
	
	public function isLocalhost() {
        $whitelist = array(
            '127.0.0.1',
            '127.0.0.1:8080',
			'localhost',
			'localhost:8080',
            '::1'
        );
        
        return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
    }
	
	public function general_admin_notice(){
		$options = get_option('arrowpress_active');
		$license_key = isset($options['license_key']) ? $options['license_key'] : '';
		if($this->isLocalhost() && $license_key == ''){
			echo '';
		}
		if($license_key == '' && !$this->isLocalhost()){
			echo '<div class="notice notice-error is-dismissible">
				 <p>Please <a href="/wp-admin/options-general.php?page=active-theme">activate</a> for Lusion theme. So you can use the full features of the theme.</p>
			</div>';
		}
		
	}
	
	
	public function check_license_key(){
		global $wpdb;
		$options = get_option('arrowpress_active');
		$keyValue = isset($options['license_key']) ? $options['license_key'] : '';
		if($keyValue != ''){
			$baseUrl = get_site_url();
			$domain = str_replace('http://','',$baseUrl);
			$domain = str_replace('https://','',$domain);
			
			$domain = trim(preg_replace('/^.*?\\/\\/(.*)?\\//', '$1', $domain));

			if(strpos($domain, "/")){
				$domain = substr($domain, 0, strpos($domain, "/"));
			}
			
			$theme =  wp_get_theme();
			$themeVersion = $theme['Version'];
				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://shop.magesolution.com/licensekey/index/activate/item/27657550/theme/Lusion/key/$keyValue/domain/$domain/version/$themeVersion");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'ACTIVATE-THEMEFOREST-THEME');

			$result = curl_exec($ch);
			
			if($result=='Activated'){
				print 'Lusion theme has been successfully activated.';
			}else{
				$table_name = 'wp_options';
				$wpdb->update( $table_name, array( 'option_value' => null), array('option_name' => 'arrowpress_active'));
				print $result;
			}
		}
	}
	
}

new Apr_Core_Active_Theme_Settings();
