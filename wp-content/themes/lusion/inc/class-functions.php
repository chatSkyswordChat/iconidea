<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Lusion_Functions' ) ) {
	class Lusion_Functions {
		protected static $instance = null;

		public function __construct() {
			add_action( 'wp_footer', array( $this, 'scroll_top' ) );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Scroll to top JS
		 */
		public function scroll_top() {
			?>
			<?php if ( Lusion::setting( 'scroll_top_enable' ) && ! is_page_template( 'coming-soon.php' ) && ! is_404() ) : ?>
				<a class="scroll-to-top"><i class="theme-icon-upload"></i><i class="fas fa-square-full"></i><i
						class="fas fa-square-full"></i><i class="fas fa-square-full"></i></a>
			<?php endif; ?>
			<div class="overlay"></div>
			<?php
		}

		/* Preloader */
		public static function lusion_pre_loader() {
			$show_preloader   = Lusion::setting( 'preloader' );
			$preloader        = '';
			$lusion_preloader = get_post_meta( get_the_ID(), 'preload', true );
			if ( ( $lusion_preloader != '' ) && ( $lusion_preloader != 'default' ) ) {
				$preloader = $lusion_preloader;
			} else {
				$preloader = Lusion::setting( 'preloader-image' );
			}
			if ( $show_preloader === '1' || ( $lusion_preloader != '' ) && ( $lusion_preloader != 'default' ) ): ?>
				<div class="preloader">
					<?php if ( $preloader === 'preload-1' ) : ?>
						<div id="loading">
							<div class="loader-dot"></div>
						</div>
					<?php elseif ( $preloader === 'preload-2' ): ?>
						<div id="loading-2">
							<div class="lds-dual-ring"></div>
						</div>
					<?php elseif ( $preloader === 'preload-3' ): ?>
						<div id="loading-3">
							<div id="loading-center-3">
								<div id="loading-center-absolute-3">
									<div class="object-3" id="object_four_3"></div>
									<div class="object-3" id="object_three_3"></div>
									<div class="object-3" id="object_two_3"></div>
									<div class="object-3" id="object_one_3"></div>
								</div>
							</div>
						</div>
					<?php elseif ( $preloader === 'preload-4' ): ?>
						<div class="preloader-4">
							<div class="busy-loader">
								<div class="w-ball-wrapper ball-1">
									<div class="w-ball">
									</div>
								</div>
								<div class="w-ball-wrapper ball-2">
									<div class="w-ball">
									</div>
								</div>
								<div class="w-ball-wrapper ball-3">
									<div class="w-ball">
									</div>
								</div>
								<div class="w-ball-wrapper ball-4">
									<div class="w-ball">
									</div>
								</div>
								<div class="w-ball-wrapper ball-5">
									<div class=" w-ball">
									</div>
								</div>
							</div>
						</div>
					<?php elseif ( $preloader === 'preload-5' ): ?>
						<div class="preloader-5">
							<div class="lds-ripple">
								<div></div>
								<div></div>
							</div>
						</div>
					<?php elseif ( $preloader === 'preload-6' ): ?>
						<div id="loading-6">
							<div class="bubblingG">
							<span id="bubblingG_1">
							</span>
								<span id="bubblingG_2">
							</span>
								<span id="bubblingG_3">
							</span>
							</div>
						</div>
					<?php elseif ( $preloader === 'preload-7' ): ?>
						<div id="loading-7">
							<div id="loading-center-7">
								<div id="loading-center-absolute-7">
									<div id="object-7"></div>
								</div>
							</div>
						</div>
					<?php elseif ( $preloader === 'preload-8' ): ?>
						<div class="loader-8">
							<div class="loader-inner pacman">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
						</div>
					<?php elseif ( $preloader === 'preload-9' ): ?>
						<div id="loading-9">
							<div class="preloader8">
								<span></span>
								<span></span>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php
			endif;
		}

		/**
		 * Pass a PHP string to Javasript variable
		 **/
		public function esc_js( $string ) {
			return str_replace( "\n", '\n', str_replace( '"', '\"', addcslashes( str_replace( "\r", '', (string) $string ), "\0..\37" ) ) );
		}
	}

	new Lusion_Functions();
}
