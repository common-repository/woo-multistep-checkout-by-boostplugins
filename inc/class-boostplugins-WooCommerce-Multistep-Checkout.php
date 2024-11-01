<?php
 /**
  *
  * Main class that handles plugins operations and options
  *
  */
defined( 'ABSPATH' ) || exit;

class BoostPlugins_WooCommerce_Multistep_Checkout {

	private static $options = array();

	public static function getDefaultOptions() {
		return self::$options = array(
			'boostpluigns_skip_login_label'				=> __( 'Skip Login', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_next_button_lable'			=> __( 'Next', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_prev_button_lable'			=> __( 'Previous', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_place_order'					=> __( 'Place Order', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_required_error'				=> __( 'This field is required', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_email_error'					=> __( 'Invalid Email address', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_phone_error'					=> __( 'Invalild phone number', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_postcode_error'				=> __( 'Invalid Postcode', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_tnc_error'					=> __( 'Please check Terms and Condition', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_login_label' 					=> __( 'Login', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_login_page_title' 			=> sanitize_text_field(''),
			'boostpluigns_login_page_text' 				=> sanitize_text_field(''),			
			'boostpluigns_login_form'					=> sanitize_text_field('false'),
			'boostpluigns_coupon_label' 				=> __( 'Coupon', 'woo-multistep-checkout-by-boostplugins' ),
			'boostpluigns_coupon_page_title' 			=> sanitize_text_field(''),
			'boostpluigns_coupon_page_text' 			=> sanitize_text_field(''),
	        'boostpluigns_coupon_form'					=> sanitize_text_field('false'),
	        'boostpluigns_billing_label' 				=> __( 'Billing', 'woo-multistep-checkout-by-boostplugins' ),
	        'boostpluigns_billing_page_title' 			=> sanitize_text_field(''),
	        'boostpluigns_billing_page_text' 			=> sanitize_text_field(''),
	        'boostpluigns_shipping_label' 				=> __( 'Shipping', 'woo-multistep-checkout-by-boostplugins' ),
	        'boostpluigns_shipping_page_title' 			=> sanitize_text_field(''),
	        'boostpluigns_shipping_page_text' 			=> sanitize_text_field(''),
	        'boostpluigns_billing_shipping_label' 		=> __( 'Billing & Shipping', 'woo-multistep-checkout-by-boostplugins' ),
	        'boostpluigns_billing_shipping_page_title' 	=>sanitize_text_field(''),
	        'boostpluigns_billing_shipping_page_text' 	=> sanitize_text_field(''),
	        'boostpluigns_billing_shipping'				=> sanitize_text_field('no'),
	        'boostpluigns_order_label' 					=> __( 'Order details', 'woo-multistep-checkout-by-boostplugins' ),
	        'boostpluigns_order_details_page_title' 	=>sanitize_text_field(''),
	        'boostpluigns_order_details_page_text' 		=> sanitize_text_field(''),
	        'boostpluigns_order_detail'					=> sanitize_text_field('true'),
	        'boostpluigns_payment_label' 				=> __( 'Payment', 'woo-multistep-checkout-by-boostplugins' ),
	        'boostpluigns_payment_page_title' 			=>sanitize_text_field(''),
	        'boostpluigns_payment_page_text' 			=> sanitize_text_field(''),
	        'boostpluigns_order_payment_label' 			=> __( 'Order & Payment', 'woo-multistep-checkout-by-boostplugins' ),
	        'boostpluigns_order_payment_page_title' 	=> sanitize_text_field(''),
	        'boostpluigns_order_payment_page_text' 		=> sanitize_text_field(''),
	        'boostpluigns_order_payment_tabs'			=> sanitize_text_field('no'),
	        'boostpluigns_review_order_label' 			=> __( 'Review order', 'woo-multistep-checkout-by-boostplugins' ),
	        'boostpluigns_order_review_page_title' 		=> sanitize_text_field(''),
	        'boostpluigns_order_review_page_text' 		=> sanitize_text_field(''),
	        'boostpluigns_review_order'					=> sanitize_text_field('true'),
	        'boostpluigns_register_page_title' 			=> __( 'I am new to store', 'woo-multistep-checkout-by-boostplugins' ),
	        'boostpluigns_register_page_text' 			=> sanitize_text_field(''),
	        'boostpluigns_registration_form'			=> sanitize_text_field('false'),
	        'boostpluigns_coupon_placement'				=> sanitize_text_field('default'),
	        'boostpluigns_show_thumbnail'				=> sanitize_text_field('false'),
	        'boostpluigns_additional_details'			=> sanitize_text_field('true'),
	        'boostpluigns_animation'					=> sanitize_text_field('fade'),
	        'boostpluigns_orientation'					=> sanitize_text_field('horizontal'),
	        'boostpluigns_number_hide_show'				=> sanitize_text_field('no'),
	        'boostpluigns_postcode_validation'			=> sanitize_text_field('no'),
        	'boostpluigns_steps_style'					=> sanitize_text_field('style1'),
        	'boostpluigns_color_active'					=> sanitize_hex_color ( '#2BA813' ),
        	'boostpluigns_color_number' 				=> sanitize_hex_color ( '#1E7E0B' ),  	
        	'boostpluigns_color_inactive' 				=> sanitize_hex_color ( '#999999' ),
        	'boostpluigns_color_completed' 				=> sanitize_hex_color ( '#2BA813' ),
        	'boostpluigns_color_font' 					=> sanitize_hex_color ( '#2BA813' ),
        	'boostpluigns_color_buttons' 				=> sanitize_hex_color ( '#2BA813' ),
        	'boostpluigns_color_buttons_font' 			=> sanitize_hex_color ( '#fff' ),
		);
	}
	/**
	* Main Instance
	**/
	public static function instantiate() {
		self::BPWCMSC_basicSetup();
 		self::BPWCMSC_setHooks();
	}
	
 	public static function BPWCMSC_basicSetup() {
 		
		// Multilanguage support
	
		load_plugin_textdomain( 'woo-multistep-checkout-by-boostplugins', false, BPWCMSC_BASENAME . '/languages/' );
 	}

 	public static function BPWCMSC_setHooks() {
 		$self = new self();
		// Add setting link on plugins page
		 
		add_filter('plugin_action_links_' . BPWCMSC_BASENAME, array( $self, 'boostpluigns_setting_on_plugin' ) );
		
		// Add necessary scripts and style sheet
		 
		add_action('wp_enqueue_scripts', array( $self, 'boostpluigns_enqueue_scripts' ) );

		// Plugins option Page as a submenu of WooCommerce menu
		 
		add_action( 'admin_menu', array( $self, 'boostpluigns_menu_page' ) );

		// Add Color Picker at Admin
		
		add_action('admin_enqueue_scripts', array( $self, 'boostpluigns_enqueue_color_picker' ) );

		// WooCommerce Hooks		

		// Alter template load location

		add_filter( 'woocommerce_locate_template', array( $self, 'boostpluigns_wc_locate_template' ), 999999, 3 );

		// Avada theme
		
		add_action( 'after_setup_theme', array( $self, 'boostpluigns_avada' ) );

		// Manipulate additional details
		add_action( 'after_setup_theme', array( $self, 'boostpluigns_additional_details_hide' ) );

		add_action( 'after_setup_theme', array( $self, 'boostpluigns_removeHooks' ) );

		// Stripe Apple Pay button
		
		add_action( 'init', array( $self, 'boostpluigns_apple_pay_btn' ), 20 );

		add_action( 'init', array( $self, 'boostpluigns_set_default_options' ), 10 );

		// User registeration
		
		add_action( 'wp_ajax_boostpluigns_registration', array( $self, 'boostpluigns_registration' ) );
		add_action( 'wp_ajax_nopriv_boostpluigns_registration', array( $self, 'boostpluigns_registration' ) );
		
		// Login
		
		add_action('wp_ajax_boostpluigns_login', array( $self, 'boostpluigns_user_login' ) );
		add_action('wp_ajax_nopriv_boostpluigns_login', array( $self, 'boostpluigns_user_login' ) );
		
		// Zip/Post code validation
		
		add_action('wp_ajax_zip_validation', array( $self, 'boostpluigns_zip_validation' ) );
		add_action('wp_ajax_nopriv_zip_validation', array( $self, 'boostpluigns_zip_validation' ) );

		// Order review & Customer reivew
		
		add_action( 'boostpluigns_order_customer_review', array( $self, 'boostpluigns_order_customer_review' ) );

		// Preview changes hook
		add_action('parse_request', array( $self, 'boostpluigns_parse_request' ) );
 	}

 	public static function boostpluigns_setting_on_plugin($links) {
	    if ( class_exists( 'WooCommerce' ) ) {
	        return array_merge(array('settings' => '<a href="' . admin_url('admin.php?page=boostpluigns') . '">' . __( 'Settings', 'woo-multistep-checkout-by-boostplugins' ) . '</a>'), $links);
	    } else {
	        return $links;
	    }
	}

	public static function boostpluigns_menu_page() {
	    add_submenu_page( 'woocommerce', 'WooCommerce Multistep Checkout', 'WooCommerce Multistep Checkout', 'manage_options', 'boostpluigns', array('BoostPlugins_WooCommerce_Multistep_Checkout', 'boostpluigns_options' ) );
	}

	public static function boostpluigns_options() {
		
		// Save settings
		if ( isset( $_POST['posted_data'] ) && wp_verify_nonce( $_POST['posted_data'], 'bpwcmsc_push_setting') && isset( $_POST['submit'] ) ) {	    	
	    	$posts = wp_unslash( $_POST );
	    	$defaultOpts = self::getDefaultOptions();	    	
	    	foreach ( $posts as $option_name => $option_value ) {
	        	if ( array_key_exists( $option_name, $defaultOpts ) ) {	
	        		update_option( sanitize_text_field( $option_name ), sanitize_text_field( $option_value ) );
	        	}
	    	}
	    	echo apply_filters( 'settings_saved_message', '<div class="updated"><p><strong>' . __( 'Settings saved', 'woo-multistep-checkout-by-boostplugins' ). '</strong></p></div>' );
	    }
    	// If restore to default
	    if ( isset( $_POST['bpwcmsc_restore_default'] ) && wp_verify_nonce( $_POST['bpwcmsc_restore_default'], 'bpwcmsc_default_setting') && isset( $_POST['default'] ) ) {
	    	$defaultOpts = self::getDefaultOptions();
	        $posts = wp_unslash( $_POST );
	        foreach ( $posts as $option_name => $option_value ) {
	            if ( array_key_exists( $option_name, $defaultOpts ) ) {
	            	update_option( sanitize_text_field( $option_name ), sanitize_text_field( $defaultOpts[ $option_name ] ) );
	            }
	        }
	        echo apply_filters( 'settings_saved_message', '<div class="updated"><p><strong>' . __( 'Settings saved', 'woo-multistep-checkout-by-boostplugins' ). '</strong></p></div>' );  
	    }
	    require_once( untrailingslashit( BPWCMSC_DIR_PATH . '/inc/bpwcmsc_options.php' ) );
	}

	public function boostpluigns_enqueue_scripts() {
	    $steps_type = get_option( 'boostpluigns_steps_style' );
	    wp_register_script('jquery-steps', BPWCMSC_DIR_URL . 'js/steps.js', array('jquery'), BPWCMSC_VER, true);
	    wp_register_style('jquery-steps', BPWCMSC_DIR_URL . 'css/' . $steps_type . '.css', null, BPWCMSC_VER);
	    wp_register_style('jquery-steps-main', BPWCMSC_DIR_URL . 'css/main.css', null, BPWCMSC_VER);
	    
	    $vars = array( 
	        'error_msg' => get_option( 'boostpluigns_required_error' ) ? __( get_option( 'boostpluigns_required_error' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'This field is required', 'woo-multistep-checkout-by-boostplugins' ),
	        'email_error_msg' => get_option( 'boostpluigns_email_error' ),
	        'phone_error_msg' => get_option( 'boostpluigns_phone_error' ),
	        'terms_error' => get_option( 'boostpluigns_tnc_error' ),
	        'zipcode_validation' => get_option( 'boostpluigns_postcode_validation' ),
	        'zipcode_error_msg' => get_option( 'boostpluigns_postcode_error' ),
	        'bpwcmsc_login_nonce' => wp_create_nonce( 'bpwcmsc-login-nonce' ),
	        'bpwcmsc_register_nonce' => wp_create_nonce( 'bpwcmsc-register-nonce' ),
	        'ajaxurl' => admin_url( 'admin-ajax.php' ),
	    );

	    require_once( untrailingslashit ( BPWCMSC_DIR_PATH . '/inc/bpwcmsc_dynamic_style.php' ) );
	        
	    // Enqueue scripts and styles on WooCommerce checkout page 
	    
	    if ( is_checkout() ) {
	        wp_enqueue_script('jquery-steps');
	        wp_localize_script( 'jquery-steps', 'bpwcmsc_steps', $vars );
	        wp_enqueue_style('jquery-steps');
	        wp_enqueue_style('jquery-steps-main');
	    }
	}

	public static function boostpluigns_enqueue_color_picker() {
	    wp_enqueue_style('wp-color-picker');
	    wp_enqueue_script('wp-color-picker-script', BPWCMSC_DIR_URL . 'js/admin/script.js', array('wp-color-picker'), false, true);
	    
	    wp_register_style('wp-backend-styles', BPWCMSC_DIR_URL . 'css/back-styles.css', null, BPWCMSC_VER);
	    wp_enqueue_style( 'wp-backend-styles');
	}
	
	function boostpluigns_wc_locate_template($template, $template_name, $template_path) {

	    $child_path = untrailingslashit( get_stylesheet_directory() . '/' . BPWCMSC_DIR_NAME . '/' . $template_path . $template_name );
	    $theme_path = untrailingslashit( get_template_directory() . '/' . BPWCMSC_DIR_NAME . '/' . $template_path . $template_name );
	    $plugin_path = untrailingslashit( BPWCMSC_DIR_PATH . $template_path . $template_name );
	    if ( file_exists( $child_path ) ) {
	        return $child_path;
	    } elseif ( file_exists( $theme_path ) ) {
	        return $theme_path;
	    } elseif ( file_exists( $plugin_path ) ) {
	        return $plugin_path;
	    } else {
	        return $template;
	    }
	}

	/*public static function boostpluigns_dynamic_style_options() {
	    require_once( untrailingslashit ( BPWCMSC_DIR_PATH . '/inc/bpwcmsc_dynamic_style.php' ) );
	}*/

	public static function boostpluigns_avada() {
	    if ( function_exists( 'avada_woocommerce_checkout_after_customer_details' ) ) {
	        remove_action( 'woocommerce_checkout_after_customer_details', 'avada_woocommerce_checkout_after_customer_details' );
	    }

	    if ( function_exists( 'avada_woocommerce_checkout_before_customer_details' ) ) {
	        remove_action( 'woocommerce_checkout_before_customer_details', 'avada_woocommerce_checkout_before_customer_details' );
	    }

	    if ( class_exists( 'Avada_Woocommerce' ) ) {
	        global $avada_woocommerce;
	        remove_action( 'woocommerce_checkout_before_customer_details', array( $avada_woocommerce, 'checkout_before_customer_details' ) );
	        remove_action( 'woocommerce_checkout_after_customer_details', array( $avada_woocommerce, 'checkout_after_customer_details' ) );
	        remove_action( 'woocommerce_before_checkout_form', array( $avada_woocommerce, 'before_checkout_form' ) );
	        remove_action( 'woocommerce_after_checkout_form', array( $avada_woocommerce, 'after_checkout_form' ) );
	    }
	}

	public static function boostpluigns_removeHooks() {
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
	}

	public static function boostpluigns_additional_details_hide() {
		if ( 'false' == get_option('boostpluigns_additional_details') ) {
		    add_filter('woocommerce_enable_order_notes_field', '__return_false');
		}
	}

	public static function boostpluigns_apple_pay_btn() {
	    if ( class_exists( 'WC_Stripe_Apple_Pay' ) ) {
	        remove_action( 'woocommerce_checkout_before_customer_details', array( WC_Stripe_Apple_Pay::instance(), 'display_apple_pay_button' ), 1 );
	        remove_action( 'woocommerce_checkout_before_customer_details', array( WC_Stripe_Apple_Pay::instance(), 'display_apple_pay_separator_html' ), 1 );

	        add_action( 'woocommerce_before_checkout_form', array( WC_Stripe_Apple_Pay::instance(), 'display_apple_pay_button' ), 1 );
	        add_action( 'woocommerce_before_checkout_form', array( WC_Stripe_Apple_Pay::instance(), 'display_apple_pay_separator_html' ), 1 );
	    }
	}

	public static function boostpluigns_set_default_options() {
		$defaultOpts = self::getDefaultOptions();
		foreach ( $defaultOpts as $option_name => $option_value ) {
	        add_option( sanitize_text_field( $option_name ), sanitize_text_field( $option_value ) );
	    }
	}

	public static function boostpluigns_parse_request() {	    
    	if( isset( $_REQUEST['action'] ) && wp_verify_nonce( $_REQUEST['action'], 'preview' ) ){
       		@header("Content-Type: text/html; charset=utf-8");
        	@header("Cache-Control: no-cache, must-revalidate, max-age=0");
        	require( untrailingslashit( WP_PLUGIN_DIR . '/' . BPWCMSC_DIR_NAME .'/view/boostplugins_step_preveiw.php' ) );
        	exit;	    
    	}
	}
	
	public static function boostpluigns_registration() {

		check_ajax_referer( 'bpwcmsc-register-nonce', 'security' );
		$username = sanitize_email( $_POST['email'] );
	    $password = trim( $_POST['password'] );

	    if ( is_user_logged_in() ){
	    	echo "Logged";
	    	exit();
	    } 
	    
	    if ( empty( $username ) ) {
	    	echo "User required";
	    	exit();
	    }

	    if ( empty( $password ) ) {
	    	echo "password required";
	    	exit();
	    }

	    if ( ! is_email( $username ) ) {
	    	echo "Invalid User";
	    	exit();
	    }

	    if ( email_exists( $username ) ) {
	        echo 'user exist';
	        exit();
	    }
	    
	    if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) || ! empty( $username ) ) {
	        if ( empty( $username ) || ! validate_username( $username ) ) {
	            echo 'Invalid User';
	            exit();
	        }

	        if ( username_exists( $username ) ) {
	            echo 'user exist';
	            exit();
	        }
	    }
	    
        wc_create_new_customer( $username, $username, $password );
        $user_detail = array();

        $user_detail['user_login'] = $username;
        $user_detail['user_password'] = $password;
        $user_detail['remember'] = true;
        $secure_cookie = is_ssl() ? true : false;
        
        $usr = wp_signon( apply_filters( 'woocommerce_login_credentials', $user_detail ), $secure_cookie );
        if( ! is_wp_error( $usr ) ) {
			global $woocommerce;
		    $checkout_url = $woocommerce->cart->get_checkout_url();
		    $get_reffer = wp_get_raw_referer();

		    if ( preg_match( '#' . $get_reffer . '#', $checkout_url ) ) {
		        $checkout_url = $checkout_url;
		    } else {
		        $checkout_url = wp_get_referer() ? wp_get_referer() : wc_get_page_permalink( 'myaccount' );
		    }
		    echo "success-".$checkout_url;
        } else {
        	echo 'error';
        }        
        exit();	    
	}

	public static function boostpluigns_user_login() {		
	    check_ajax_referer( 'bpwcmsc-login-nonce', 'security' );

	    $username = sanitize_user( $_POST['user'] );
	    $password = trim( $_POST['password'] );
	    if ( is_user_logged_in() ){
	    	echo "Logged";
	    	exit();
	    } 
	    
	    if ( empty( $username ) ) {
	    	echo "User required";
	    	exit();
	    }
	    if ( empty( $password ) ) {
	    	echo "password required";
	    	exit();
	    }
	    if ( is_email( $username ) && apply_filters( 'woocommerce_get_username_from_email', true ) ) {
	        $user = get_user_by( 'email', sanitize_email( $username ) );

	        if ( isset( $user->user_login ) ) {
	            $user_detail['user_login'] = $user->user_login;
	        }
	    } else {
	        $user_detail['user_login'] = $username;
	    }

	    $user_detail['user_password'] = trim( $password );
	    $user_detail['remember'] = $_POST['rememberme'];
	    $secure_cookie = is_ssl() ? true : false;
	    $user = wp_signon( apply_filters( 'woocommerce_login_credentials', $user_detail ), $secure_cookie );

	    if ( is_wp_error( $user ) ) {
	    	echo 'error';
	    } else {
	        echo 'success';
	    }
	    exit();
	}

	function boostpluigns_zip_validation() {
    	$country = trim( $_POST['country'] );
    	$postcode = strtoupper( str_replace( ' ', '', trim( $_POST['postcode'] ) ) );
    	echo WC_Validation::is_postcode( sanitize_text_field( $postcode ), sanitize_text_field( $country ) );
    	exit();
	}

	public static function boostpluigns_order_customer_review() {
	    ?>
	    <div class="bpwcmsc-order-review-step">
	        <div class="bpwcmsc-customer-review">
				<h2><?php _e('Customer Details', 'woo-multistep-checkout-by-boostplugins'); ?></h2>
				<hr />
	            <div class="bpwcmsc-customer-addresses">
	                <div class = "bpwcmsc-billing-details">
	                    <h3><?php _e('Billing Address', 'woo-multistep-checkout-by-boostplugins'); ?></h3>
	                    <div class="bpwcmsc-billing-address"></div>
	                    <div class="bpwcmsc-customer-details">
			                <div class="bpwcmsc-customer-phone-email">
			                	<div class="customer-email">
			                		<label class="email-lable"><?php _e('Email:', 'woo-multistep-checkout-by-boostplugins'); ?></label>
				                	<p class="bpwcmsc-customer-email"></p>
			                	</div>
			                	<div class="customer-phone">
			                		<label class="phone-lable"><?php _e('Phone:', 'woo-multistep-checkout-by-boostplugins'); ?></label>
				                	<p class="bpwcmsc-customer-phone"></p>
			                	</div>
			                </div>
			            </div>
	                </div>
	                <div class = "bpwcmsc-shipping-details">
	                    <h3><?php _e('Shipping Address', 'woo-multistep-checkout-by-boostplugins'); ?></h3>
	                    <div class="bpwcmsc-shipping-address"></div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php 
	}

} // End of class