<?php
/** 
 * Plugin Name: WooCommerce Multistep Checkout by BoostPlugins
 * Plugin URI:  https://boostplugins.com/woocheckoutplugin
 * Description: The plugin allows you to easily set your checkout page to increase sale and best user experience in a few minutes. Fully customizable and allow you to set it best fit with your theme.
 * Version:     1.0.1
 * Author:      BoostPlugins
 * Author URI:  https://woocheckoutplugin.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woo-multistep-checkout-by-boostplugins
 * Domain Path: /languages/
 */

defined( 'ABSPATH' ) || exit;
define( "BPWCMSC_VER", "1.0.1" );
define( 'BPWCMSC_TEXT_DOMIAN', "woo-multistep-checkout-by-boostplugins" );
define( 'BPWCMSC_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'BPWCMSC_DIR_URL' , plugin_dir_url ( __FILE__ ) );
define( 'BPWCMSC_BASENAME', plugin_basename( __FILE__ ) );
$dir_name = substr( BPWCMSC_BASENAME, 0, strpos( BPWCMSC_BASENAME, '/') );
define( 'BPWCMSC_DIR_NAME', $dir_name );
/**
 * Check if WC is installed and activated or not.
 */
register_activation_hook( __FILE__, 'boostpluigns_is_woocommerce_active' );

function boostpluigns_is_woocommerce_active() {
	if ( ! in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

		// If WC is not activated, deactivate this plugins.
    	deactivate_plugins( BPWCMSC_BASENAME );
        die( 'To activate <strong>WooCommerce Multistep Checkout by Boostplugins</strong> requires WooCommerce to be installed and activated. Install <a target="_blank" href="http://wordpress.org/plugins/woocommerce/">WooCommerce</a>' );
	}	
}

include( untrailingslashit( BPWCMSC_DIR_PATH . '/inc/class-boostplugins-WooCommerce-Multistep-Checkout.php' ) );

BoostPlugins_WooCommerce_Multistep_Checkout::instantiate();