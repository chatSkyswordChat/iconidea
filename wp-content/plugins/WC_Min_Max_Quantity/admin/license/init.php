<?php
namespace WC_MMQ_PRO\Admin\License;

class Init {

    use \WC_MMQ_PRO\Admin\License\Singleton;

    public function init() {

        define( 'WC_MMQ_EDD_STORE_URL', 'https://codeastrology.com/' );
        define( 'WC_MMQ_EDD_PRODUCT_ID', 6557 );
        define( 'WC_MMQ_EDD_PLUGIN_NAME', __( 'Min Max Quantity & Step Control for WooCommerce', 'wcmmq_pro' ) );
        define( 'WC_MMQ_EDD_AUTHOR_NAME', 'codeastrology' );
        define( 'WC_MMQ_EDD_LICENCE_HELP_URL', 'https://wooproducttable.com/docs/doc/license/where-is-my-license-key/' );


        //Plugin Base Details
        define( 'WC_MMQ_EDD_BASE_FILE', WC_MMQ_PRO_PATH . 'wcmmq.php' ); //It should be plugin based File path link
        
        define( 'WC_MMQ_EDD_CURRENT_VERSION', WC_MMQ_PRO_VERSION ); //It should be plugin based File path link

        //Menu/link
        define( 'WC_MMQ_EDD_PARENT_MENU', '' ); //There will be parent menu slug if already available.
        define( 'WC_MMQ_EDD_LICENSE_PAGE', 'wcmmq-license' );
        define( 'WC_MMQ_EDD_LICENSE_PAGE_TITLE', __( 'Min Max License', 'wcmmq_pro' ) );
        

        //Key Status
        define( 'WC_MMQ_EDD_LICENSE_KEY', 'wcmmq_license_key' );
        define( 'WC_MMQ_EDD_LICENSE_STATUS', 'wcmmq_license_status' );

        //Permission
        define( 'WC_MMQ_EDD_PERMISSION', 'manage_options' );


        define( 'WC_MMQ_EDD_LICENSE_PAGE_LINK', admin_url( 'admin.php?page=wcmmq-license' ) );

        

        //if ( current_user_can( WC_MMQ_EDD_PERMISSION ) ) {

            //add submenu for license
            add_action( "admin_menu", [$this, "add_submenu_for_license"], 99 );

            //handle license notice
            $this->manage_license_notice();

            //fire up edd update module
            Updater\Init::instance()->init();
        //}
        return 'licence_init';
    }

    /**
     * Add admin submenu page for license
     */
    public function add_submenu_for_license() {
        add_submenu_page(
            WC_MMQ_EDD_PARENT_MENU,
            WC_MMQ_EDD_LICENSE_PAGE_TITLE . ' ' . WC_MMQ_EDD_PLUGIN_NAME,
            WC_MMQ_EDD_LICENSE_PAGE_TITLE,
            WC_MMQ_EDD_PERMISSION,
            WC_MMQ_EDD_LICENSE_PAGE,
            [$this, 'license_page_template']
        );
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function license_page_template() {
        $file_path = plugin_dir_path( __FILE__ ) . "/template/license-view.php";

        if ( file_exists( $file_path ) ) {
            include_once $file_path;
        }

    }
    
    public function manage_license_notice() {

        // Register license module
        $license = new \WC_MMQ_PRO\Admin\License\License();

        if ( $license->status() != 'valid' ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_activate_license' ] );
        }

    }

    public function admin_notice_activate_license(){
        
        $link_label = __( 'Activate License', 'wcmmq_pro' );
        $link = WC_MMQ_EDD_LICENSE_PAGE_LINK;
		$message = esc_html__( 'Please activate ', 'wcmmq_pro' ) . '<strong>' . esc_html__( WC_MMQ_EDD_PLUGIN_NAME ) . '</strong>' . esc_html__( ' license to get automatic updates.', 'wcmmq_pro' ) . '</strong>';
        printf( '<div class="error error-warning is-dismissible"><p>%1$s <a href="%2$s">%3$s</a></p></div>', $message, $link, $link_label );

    }

}
