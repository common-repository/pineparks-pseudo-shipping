<?php
if ( ! defined( 'ABSPATH' ) ){
    die();
}

class Woo_Pseudo_Shipping{

    public function __construct(){
        add_action( 'woocommerce_shipping_init', [$this, 'shipping_init'], 2000 );
        add_filter( 'woocommerce_shipping_methods', [$this, 'shipping_methods'], 2000 );

        add_filter( 'woocommerce_after_shipping_rate', [$this, 'output_shipping_method_tooltips'], PHP_INT_MAX, 2 );
    }

    public function shipping_init(){
        include_once(PINEPARKS_PWS_PATH.'shipping/abstract-woo-pseudo-shipping.php');
        
        include_once(PINEPARKS_PWS_PATH.'shipping/pseudo-shipping.php');
    }

    public function shipping_methods($methods){
        $methods['woo-pseudo-1'] = 'Woo_Pseudo_Shipping_Method_1';
        return $methods;
    }

    function output_shipping_method_tooltips($method){
        $meta_data = $method->get_meta_data();
        
        //print_r( $method );

        if ( array_key_exists( 'description', $meta_data ) ) {
            
            switch ( $method->method_id ) {
                case 'woo-pseudo-1':
                    $description = apply_filters( 'woo_pseudo_shipping_description_output', html_entity_decode( $meta_data['description'] ), $method );
                    if ($description) {
                        $html = '<div class="method-description">'. wp_kses( $description, wp_kses_allowed_html( 'post' ) ) .'</div>';
                        echo apply_filters( 'woo_pseudo_shipping_description_output_html', $html, $description, $method  );
                    }
                    break;
            }
            
        }    
        
    }
}