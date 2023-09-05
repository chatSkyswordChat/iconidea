<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Lusion_Post' ) ) {
	class Lusion_Post {
		public function __construct() {
		}

		public static function blog_layout() {

			if ( is_category() ) {
				$blog_layout = lusion_get_meta_value( 'blog_layout', false );
			} else {
				$blog_layout = Lusion::setting( 'blog_archive_layout' );
			}
			$style = '';
			if ( $blog_layout === 'grid' ) {
				$style = 'blog-grid';
			} elseif ( $blog_layout === 'masonry' ) {
				$style = 'blog-masonry';
			} elseif ( $blog_layout === 'list' ) {
				$style = 'blog-list';
			} else {
				$blog_layout = Lusion::setting( 'blog_archive_layout' );
				$style       = 'blog-' . $blog_layout . '';
			}

			return $style;
		}

		public static function blog_columns() {
			if ( is_category() ) {
				$blog_layout = lusion_get_meta_value( 'blog_layout', false );
				if ( $blog_layout !== '' ) {
					$blog_layout = lusion_get_meta_value( 'blog_layout', false );
				} else {
					$blog_layout = Lusion::setting( 'blog_archive_layout' );
				}
			} else {
				$blog_layout = Lusion::setting( 'blog_archive_layout' );
			}
			if ( $blog_layout === 'masonry' ) {
				if ( is_category() ) {
					$blog_columns = lusion_get_meta_value( 'blog_columns', false );
					if ( $blog_columns !== '' ) {
						$blog_columns = lusion_get_meta_value( 'blog_columns', false );
					} else {
						$blog_columns = Lusion::setting( 'blog_archive_columns_masonry' );
					}
				} else {
					$blog_columns = Lusion::setting( 'blog_archive_columns_masonry' );
				}

			} elseif ( $blog_layout === 'grid' ) {
				if ( is_category() ) {
					$blog_columns = lusion_get_meta_value( 'blog_columns', false );
					if ( $blog_columns !== '' ) {
						$blog_columns = lusion_get_meta_value( 'blog_columns', false );
					} else {
						$blog_columns = Lusion::setting( 'blog_archive_columns_grid' );
					}
				} else {
					$blog_columns = Lusion::setting( 'blog_archive_columns_grid' );
				}

			} else {
				$blog_columns = '1';
			}

			if ( $blog_columns === '4' ) {
				$column = 'col-xl-3 col-md-3 col-sm-6 col-xs-12 blog-col-4';
			} elseif ( $blog_columns === '2' ) {
				if ( $blog_layout === 'list' ) {
					$column = 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 blog-col-2 ';
				} else {
					$column = 'col-xl-6 col-md-6 col-sm-6 col-xs-12 blog-col-2 ';
				}
			} elseif ( $blog_columns === '3' ) {
				$column = 'col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 blog-col-3';
			} else {
				$column = 'col-xl-12 col-md-12 col-sm-12 col-xs-12 blog-col-1';
			}

			return $column;
		}
	}

	new Lusion_Post();
}
