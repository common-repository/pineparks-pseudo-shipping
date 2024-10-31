<?php
/**
 * Plugin Name: Pineparks Pseudo Shipping for Woocommerce
 * Description: Preview shipping methods, reduce checkout confusion and lower checkout abandonment.
 * Author: Pineparks.com
 * Author URI: https://www.pineparks.com
 * Version: 1.0.1
 * Text Domain: woo-pseudo-shipping
 * Domain Path: /languages/
 * Requires at least: 5.0
 * Tested up to: 6.1
 * WC requires at least: 6.0
 * WC tested up to: 7.3
 */
if ( ! defined( 'ABSPATH' ) ){
    die();
}

if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option('active_plugins')), true) ) {
    define('PINEPARKS_PWS_PATH', plugin_dir_path( __FILE__ ));
    define('PINEPARKS_PWS_URL', plugin_dir_url(__FILE__));

    include_once('shipping-method.php');
    include_once('functions.php');

    // init plugin
    new Woo_Pseudo_Shipping();
}