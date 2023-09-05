<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Lusion_Portfolio' ) ) {
	class Lusion_Portfolio {
		public static function portfolio_columns(){
            $portfolio_columns = Lusion::setting( 'portfolio_columns' );
            if ($portfolio_columns === '1'){
                $column = 'col-xl-12';
            }elseif ($portfolio_columns === '2'){
                $column = 'col-xl-6 col-md-6 col-sm-6 col-xs-12';
            }elseif ($portfolio_columns === '3'){
                $column = 'col-xl-4 col-md-4 col-sm-6 col-xs-12';
            }else{
                $column = 'col-xl-3 col-md-4 col-sm-6 col-xs-12';
            }
            return $column;
        }
	}
	new Lusion_Portfolio();
}