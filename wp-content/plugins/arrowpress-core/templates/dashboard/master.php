<?php
$theme_data   = Arrowpress_Theme_Manager::get_metadata();
$current_page = Arrowpress_Dashboard::get_current_page_key();
$sub_pages    = Arrowpress_Dashboard::get_sub_pages();
$class        = 'arrowpress-wrapper';
if ( $current_page == 'importer' ) {
	$class = "arrowpress-wrapper wrapper-import-demo";
}
?>

<?php do_action( 'tc_before_dashboard_wrapper' ); ?>

<div class="<?php echo esc_attr( $class ); ?>">
	<header class="tc-header">
		<div class="title">
			<h1 class="name"><?php echo esc_html( $theme_data['name'] . ' Theme Dashboard' ); ?></h1>
			<span class="version"><?php echo esc_html( $theme_data['version'] ); ?></span>
		</div>

		<nav class="nav-tab-wrapper tc-nav-tab-wrapper">
			<?php
			foreach ( $sub_pages as $key => $sub_page ) :
				$prefix = Arrowpress_Dashboard::$prefix_slug;
				$link = admin_url( 'admin.php?page=' . $prefix . $key );
				$menu_title = apply_filters( 'arrowpress_core_tab_' . $key . '_menu_title', $sub_page['title'] );
				?>
				<a id="tc-nav-tag-<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( $link ); ?>"
				   class="nav-tab<?php echo ( $key === $current_page ) ? ' nav-tab-active' : ''; ?>"
				   title="<?php echo esc_attr( $sub_page['title'] ); ?>"><?php echo( $menu_title ); ?></a>
			<?php endforeach; ?>
		</nav>
	</header>

	<div class="notifications" id="tc-notifications">
		<?php do_action( 'arrowpress_dashboard_notifications', $current_page ); ?>
	</div>

	<div class="tc-main">
		<?php
		do_action( "arrowpress_dashboard_before_page_$current_page" );
		?>

		<?php
		do_action( "arrowpress_dashboard_main_page_$current_page" );
		?>

		<?php
		do_action( "arrowpress_dashboard_after_page_$current_page" );
		?>
	</div>
</div>

<?php do_action( 'tc_after_dashboard_wrapper' ); ?>
