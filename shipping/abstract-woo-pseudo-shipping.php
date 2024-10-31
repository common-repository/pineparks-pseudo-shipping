<?php
if ( ! defined( 'ABSPATH' ) ){
    die();
}

abstract class Abstracts_Woo_Pseudo_Shipping extends WC_Shipping_Method{

    public function __construct( $instance_id = 0 ){
        $this->instance_id          = absint( $instance_id );
        $this->method_title         = __('Pseudo method', 'woo-pseudo-shipping');
        $this->method_description   = __('Pseudo shipping method', 'woo-pseudo-shipping');

        $this->supports             = array(
            'shipping-zones',
            'instance-settings',
        );
        // Contreis availability
        //$this->availability         = 'including';

        $this->init_form_fields();

        $this->enabled = $this->get_option( 'enabled' );
        $this->title = $this->get_option( 'title' );


        add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
    }

    function init_form_fields(){
        $this->instance_form_fields = array(
            'enabled' => array(
                'title' => __('Enable'),
                'type' => 'checkbox',
                'default' => 'yes'
            ),
            'title' => array(
                'title' => __('Method title'),
                'type' => 'text',
                'default' => $this->method_title
            ),
            'description' => array(
                'title' => __('Description'),
                'type' => 'text',
                'default' => $this->method_description
            )
        );
    }
    
    /**
     * calculate_shipping function.
     *
     * @access public
     * @param mixed $package
     * @return void
     */
    public function calculate_shipping( $package = array() ) {

        $country        = $package["destination"]["country"];
        $city           = $package["destination"]["city"];
        $state          = $package["destination"]["state"];

        $cart_subtotal  = $package['cart_subtotal'];

        if( !$city ){

            $rate = array(
                'id' => $this->get_instance_id(),
                'label' => $this->title,
                'cost' => 0,
                'meta_data' => [
                    'description' => $this->get_option( 'description' )
                ]
            );

            $this->add_rate($rate);
        }
    }


    public function get_instance_id(){
        return $this->id .':'. $this->instance_id;
    }
}