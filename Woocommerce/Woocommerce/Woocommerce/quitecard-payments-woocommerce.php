<?php
/**
 * Plugin Name: quitecard Payment Gateway
 * Plugin URI: https://quitecard.com
 * Author: quitecard
 * Author URI: https://quitecard.com
 * Description: quitecard Neobanking Payment Gateway.
 * Version: 1.1.0
 * License: GPL2
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: quitecard-payments-woo
 * 
 * Class WC_Gateway_quitecard file.
 *
 * @package WooCommerce\PayLeo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

add_action( 'plugins_loaded', 'quitecard_payment_init', 11 );
add_filter( 'woocommerce_currencies', 'techiepress_add_ugx_currencies' );
add_filter( 'woocommerce_currency_symbol', 'techiepress_add_ugx_currencies_symbol', 10, 2 );
add_filter( 'woocommerce_payment_gateways', 'add_to_woo_quitecard_payment_gateway');

function quitecard_payment_init() {
    if( class_exists( 'WC_Payment_Gateway' ) ) {
		require_once plugin_dir_path( __FILE__ ) . '/includes/class-wc-payment-gateway-quitecard.php';
		require_once plugin_dir_path( __FILE__ ) . '/includes/quitecard-order-statuses.php';
    #	require_once plugin_dir_path( __FILE__ ) . '/includes/quitecard-checkout-description-fields.php';
	}
}

function add_to_woo_quitecard_payment_gateway( $gateways ) {
    $gateways[] = 'WC_Gateway_Payleo';
    return $gateways;
}

function techiepress_add_ugx_currencies( $currencies ) {
	$currencies['EUR'] = __( 'EUR', 'quitecard-payments-woo' );
	return $currencies;
}

function techiepress_add_ugx_currencies_symbol( $currency_symbol, $currency ) {
	switch ( $currency ) {
		case 'EUR': 
			$currency_symbol = 'EUR'; 
		break;
	}
	return $currency_symbol;
}