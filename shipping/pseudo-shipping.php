<?php
if ( ! defined( 'ABSPATH' ) ){
    die();
}

if (!class_exists('Woo_Pseudo_Shipping_Method_1')) {
    class Woo_Pseudo_Shipping_Method_1 extends Abstracts_Woo_Pseudo_Shipping{

        public function __construct( $instance_id = 0 ){
            $this->id                   = 'woo-pseudo-1';

            parent::__construct( $instance_id );

            $this->enabled              = $this->get_option( 'enabled' );

            $this->method_title         = __('Pseudo method', 'woo-pseudo-shipping');
            $this->method_description   = '';
            
        }

    }
}