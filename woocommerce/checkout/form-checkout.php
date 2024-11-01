<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

// do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woo-multistep-checkout-by-boostplugins' ) );
	return;
}

$is_login_form = sanitize_text_field( get_option( 'boostpluigns_login_form' ) );
$is_registration_form = sanitize_text_field( get_option( 'boostpluigns_registration_form' ) );
$coupon_form = sanitize_text_field( get_option( 'boostpluigns_coupon_form' ) );
$coupon_place = sanitize_text_field( get_option( 'boostpluigns_coupon_placement' ) );
$orientation = get_option( 'boostpluigns_orientation' ) ? sanitize_text_field( get_option( 'boostpluigns_orientation' ) ) : sanitize_text_field( 'horizontal' );
$hide_number = get_option( 'boostpluigns_number_hide_show' ) ? sanitize_text_field( get_option( 'boostpluigns_number_hide_show' ) ) : sanitize_text_field( 'yes' );
$num_hide = ( 'yes' != $hide_number ) ? "number" : "checkmark";
$anim = sanitize_text_field( get_option('boostpluigns_animation') ); 
$anim = "bpwcmsc-".$anim;
?>
<div class="bpwcmscPageLoader"></div>
<!-- Add Steps here -->
<div class="steps-section clearfix  <?php echo esc_attr($orientation) ?>" id="bpwcmscSteps">
	<!-- Steps Inner -->
	<div class="steps">
		<ul class="nav nav-tabs" role="tablist" id="myTab">
			<?php
				$i = 1;
				if ( 'true' == $is_login_form ) {
					if ( ! is_user_logged_in() ) {
				?>
			<li role="presentation" class="">
				<a href="#login-step" data-toggle="tab" aria-controls="login-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php get_option('boostpluigns_login_label') ? _e( get_option('boostpluigns_login_label'), 'woo-multistep-checkout-by-boostplugins' ) : _e( 'Login', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>
			<?php } } ?>
			<?php
			    if ( 'true' == $coupon_form ) { 
			    	if ( 'yes' == get_option( 'woocommerce_enable_coupons' ) ) {
		    	?>
			<li role="presentation" class="disabled">
				<a href="#coupon-step" data-toggle="tab" aria-controls="coupon-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php echo get_option( 'boostpluigns_coupon_label' ) ? __( get_option( 'boostpluigns_coupon_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Coupon', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>
			<?php } } ?>
			<?php 
			if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() || 'yes' == get_option( 'boostpluigns_billing_shipping' ) ) { 
				?>
			<li role="presentation" class="disabled">
				<a href="#shipping-billing-step" data-toggle="tab" aria-controls="shipping-billing-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php echo get_option( 'boostpluigns_billing_shipping_label' ) ? __( get_option( 'boostpluigns_billing_shipping_label' ), 'woo-multistep-checkout-by-boostplugins' ) :  __( 'Billing & Shipping', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>
			<?php } else { ?>
			<li role="presentation" class="disabled">
				<a href="#billing-step" data-toggle="tab" aria-controls="billing-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php echo get_option( 'boostpluigns_billing_label' ) ? __( get_option( 'boostpluigns_billing_label' ), 'woo-multistep-checkout-by-boostplugins' ) :  __( 'Billing', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>
			<?php if ( ! wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) { 
                    do_action('boostpluigns_before_shipping', $checkout); 
                ?>
			<li role="presentation" class="disabled">
				<a href="#shipping-step" data-toggle="tab" aria-controls="shipping-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php echo get_option( 'boostpluigns_shipping_label' ) ? __( get_option( 'boostpluigns_shipping_label' ), 'woo-multistep-checkout-by-boostplugins' ) :  __( 'Shipping', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>			
			<?php } } ?>
			<?php if ( 'no' == get_option( 'boostpluigns_order_payment_tabs' ) ) { ?>
			<li role="presentation" class="disabled">
				<a href="#order-step" data-toggle="tab" aria-controls="order-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php echo get_option( 'boostpluigns_order_label' ) ? __( get_option( 'boostpluigns_order_label' ), 'woo-multistep-checkout-by-boostplugins' ) :  __( 'Order details', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>

			<li role="presentation" class="disabled">
				<a href="#payment-step" data-toggle="tab" aria-controls="payment-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php echo get_option( 'boostpluigns_payment_label' ) ? __( get_option( 'boostpluigns_payment_label' ), 'woo-multistep-checkout-by-boostplugins' ) :  __( 'Payment', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>
			<?php } else { ?>
			<li role="presentation" class="disabled">
				<a href="#payment-order-step" data-toggle="tab" aria-controls="payment-order-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php echo get_option( 'boostpluigns_order_payment_label' ) ? __( get_option( 'boostpluigns_order_payment_label' ), 'woo-multistep-checkout-by-boostplugins' ) :  __( 'Order & Payment', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>
			<?php } ?>
			<?php
				if ( 'true' == get_option( 'boostpluigns_review_order' ) ) {
				?>
			<li role="presentation" class="disabled">
				<a href="#review-order-step" data-toggle="tab" aria-controls="review-order-step" role="tab">
                    <span class="<?php echo esc_attr( $num_hide ); ?>"><?php if( 'yes' != $hide_number ) { echo $i++ . '.'; } ?></span>
                    <span class="namebox"><?php echo get_option( 'boostpluigns_review_order_label' ) ? __( get_option( 'boostpluigns_review_order_label' ), 'woo-multistep-checkout-by-boostplugins' ) :  __( 'Review order', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
                </a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<!-- Steps Inner -->

		
	<form name="checkout" method="post" class="checkout woocommerce-checkout content clearfix" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
		<!-- Tab Content -->
		<div class="tab-content" id="content">

		<?php
			if ( 'true' == $is_login_form ) {
				if ( ! is_user_logged_in() ) {
			?>
			<div class="tab-pane <?php echo esc_attr($anim); ?>" role="tabpanel" id="login-step">
	            <h1 class="title-login-bpwcmscSteps"><?php get_option('boostpluigns_login_label') ? _e( get_option('boostpluigns_login_label') ) : _e( 'Login', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>

	            <div class="login-step">
	                <?php add_action('woocommerce_checkout_login_form', 'woocommerce_checkout_login_form', 10); ?>
					<?php do_action('woocommerce_checkout_login_form', $checkout); ?>
	            </div>
	        </div>
	    	<?php } } ?>
	    	<?php
	    		if ( 'true' == $coupon_form ) { 
	    			if ( 'yes' == get_option( 'woocommerce_enable_coupons' ) ) {
    			?>
	        <div class="tab-pane <?php echo esc_attr($anim); ?>" role="tabpanel" id="coupon-step">
	        	<?php if ( 'true' != $is_login_form || is_user_logged_in() ) { ?>
	        	<div style="display: none;">
				    <form id="hiden"><input type="hidden" name="txt"></form>
				</div>
			<?php } ?>
	            <h1 class="title-coupon-bpwcmscSteps"><?php echo get_option( 'boostpluigns_coupon_label' ) ? __( get_option( 'boostpluigns_coupon_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Coupon', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>
	            <?php if ( get_option( 'boostpluigns_order_details_page_title' ) ) { 
	                        ?>
	                        <h2><?php _e( get_option( 'boostpluigns_coupon_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
	                        <hr />
	                        <?php
	                    } 
	                    ?>
	                    <?php if ( get_option('boostpluigns_coupon_page_text') ) {
	                        ?>
	                        <p><?php _e( get_option('boostpluigns_coupon_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
	                        <?php
	                    } ?>
	            <div class="coupon-step">
	                <?php add_action('woocommerce_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10); ?>
					<?php do_action('woocommerce_checkout_coupon_form', $checkout); ?>
	            </div>
	        </div>
		    <?php } 
			} ?>
        
        	<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() || 'yes' == get_option( 'boostpluigns_billing_shipping' ) ) { 
				?>                
                <div class="tab-pane" role="tabpanel" id="shipping-billing-step">
                	<h1 class="title-billing-shipping"><?php echo get_option( 'boostpluigns_billing_shipping_label' ) ? __( get_option('boostpluigns_billing_shipping_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Billing &amp; Shipping', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>
	                <div class="shipping-billing-step">
	                    <?php if ( get_option( 'boostpluigns_billing_shipping_page_title' ) ) { 
	                        ?>
	                        <h2><?php _e( get_option( 'boostpluigns_billing_shipping_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
	                        <hr />
	                        <?php
	                    } 
	                    ?>
	                    <?php if ( get_option('boostpluigns_billing_shipping_page_text') ) {
	                        ?>
	                        <p><?php _e( get_option('boostpluigns_billing_shipping_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
	                        <?php
	                    } ?>

	                    <?php
	                    do_action( 'woocommerce_checkout_billing' );
	                    do_action( 'woocommerce_checkout_shipping' );
	                    do_action( 'woocommerce_checkout_after_customer_details' );
	                    ?>
	                </div>
	            </div>
        		<?php } else { ?>
        		<div class="tab-pane <?php echo esc_attr($anim); ?>" role="tabpanel" id="billing-step">
                	<h1><?php echo get_option( 'boostpluigns_billing_label' ) ? __( get_option( 'boostpluigns_billing_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Billing', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>
		            <div class="billing-step">                 
	                    <?php if ( get_option( 'boostpluigns_billing_page_title' ) ) { 
	                        ?>
	                        <h2><?php _e( get_option( 'boostpluigns_billing_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2><hr />
	                        <?php
	                    } 
	                    ?>
	                    <?php if ( get_option('boostpluigns_billing_page_text') ) {
	                        ?>
	                        <p><?php _e( get_option('boostpluigns_billing_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>                        
	                        <?php
	                    } ?>
	                    <?php
	                    do_action( 'woocommerce_checkout_billing' );

	                    //If cart don't needs shipping
	                    if ( ! WC()->cart->needs_shipping_address() ) {
	                        do_action( 'woocommerce_checkout_after_customer_details' );
	                        do_action( 'woocommerce_before_order_notes', $checkout );

	                        if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) {

	                            if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) {
	                    		?>
	                    			<h3><?php _e( 'Additional Information', 'woo-multistep-checkout-by-boostplugins' ); ?></h3>

	                    		<?php } ?>

	                    		<?php foreach ( $checkout->checkout_fields['order'] as $key => $field ) {
	                    			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); 
	                    		}
	                        } 
	                        do_action( 'woocommerce_after_order_notes', $checkout ); 
	                    } ?>
	                </div>
	            </div>
                <?php if ( ! wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) { 
                    do_action('boostpluigns_before_shipping', $checkout); 
                ?>
                <div class="tab-pane <?php echo esc_attr($anim); ?>" role="tabpanel" id="shipping-step">
                    <h1 class="title-shipping"><?php echo get_option( 'boostpluigns_shipping_label' ) ? __( get_option( 'boostpluigns_shipping_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Shipping', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>
                    <div class="shipping-step">
	                    <?php if ( get_option( 'boostpluigns_shipping_page_title' ) ) { 
	                        ?>
	                        <h2><?php _e( get_option( 'boostpluigns_shipping_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
	                        <hr />
	                        <?php
	                    } 
	                    ?>
	                    <?php if ( get_option('boostpluigns_shipping_page_text') ) {
	                        ?>
	                        <p><?php _e( get_option('boostpluigns_shipping_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
	                        <?php
	                    } ?>
	                    <?php 
	                    	do_action( 'woocommerce_checkout_shipping' );
	                    	do_action( 'woocommerce_checkout_after_customer_details' ); 
	                    ?>
                    </div>
                </div>
                <?php do_action( 'boostpluigns_after_shipping', $checkout); ?>
            	<?php } 
            	} ?>
            <?php endif; ?>

			<?php do_action('boostpluigns_before_order_info', $checkout); ?>
			<!-- If order details and Payment tabs are not combined -->
			<?php if ( 'no' == get_option( 'boostpluigns_order_payment_tabs' ) ) { ?>
            <!-- Order Details Tab -->
            <div class="tab-pane <?php echo esc_attr($anim); ?>" role="tabpanel" id="order-step">
            	<h1 class="title-order-info"><?php echo get_option( 'boostpluigns_order_label' ) ? __( get_option( 'boostpluigns_order_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Order Details', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>
	            <div class="order-step">	            
	                <?php 
	                if ( 'true' != get_option( 'boostpluigns_coupon_form' ) && 'default' != get_option( 'boostpluigns_coupon_placement' ) && 'before-order-review-table' == get_option( 'boostpluigns_coupon_placement' ) ) { 
	                    ?>
	                    <div class="coupon-step">
	                    	<?php if ( 'true' != $is_login_form || is_user_logged_in() ) { ?>
					        	<div style="display: none;">
								    <form id="hiden"><input type="hidden" name="txt"></form>
								</div>
							<?php } ?>
	                    	<?php add_action('woocommerce_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10); ?>
							<?php do_action('woocommerce_checkout_coupon_form', $checkout); ?>
	                    </div>
	                    <?php
	                }
	                ?>
	                <?php if ( get_option( 'boostpluigns_order_details_page_title' ) ) { 
	                        ?>
	                        <h2><?php _e( get_option( 'boostpluigns_order_details_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
	                        <hr />
	                        <?php
	                    } 
	                    ?>
	                    <?php if ( get_option('boostpluigns_order_details_page_text') ) {
	                        ?>
	                        <p><?php _e( get_option('boostpluigns_order_details_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
	                        <?php
	                    } ?>
	                <?php do_action( 'boostpluigns_before_order_contents', $checkout ); ?>
	                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	                <div id="orders_review" class="woocommerce-checkout-review-order">
	                    <?php remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20); ?>
	                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
	                </div>
	                <?php 
	                    if ( 'after-order-review-table' == get_option( 'boostpluigns_coupon_placement' ) && 'true' != get_option( 'boostpluigns_coupon_form' ) ) { 
	                        ?>                    
	                        <div class="coupon-step">
	                        	<?php if ( 'true' != $is_login_form || is_user_logged_in() ) { ?>
						        	<div style="display: none;">
									    <form id="hiden"><input type="hidden" name="txt"></form>
									</div>
								<?php } ?>
	                        	<?php add_action('woocommerce_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10); ?>
								<?php do_action('woocommerce_checkout_coupon_form', $checkout); ?>
	                        </div>
	                    <?php
	                    }
	                ?>
	                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>	                        
	            </div>
	        </div>
            <?php do_action( 'boostpluigns_after_order_info', $checkout ); ?>
            <?php do_action( 'boostpluigns_before_payment', $checkout ); ?>
            <!-- Payment Tab (Only Payment options) -->
            <div class="tab-pane <?php echo esc_attr($anim); ?>" role="tabpanel" id="payment-step">
            	<h1 class="title-payment"><?php echo get_option( 'boostpluigns_payment_label' ) ? __( get_option( 'boostpluigns_payment_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Payment', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>

	            <div class="payment-step"> 
	                
	                <?php if ( get_option( 'boostpluigns_payment_page_title' ) ) { 
	                        ?>
	                        <h2><?php _e( get_option( 'boostpluigns_payment_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
	                        <hr />
	                        <?php
	                    } 
	                    ?>
	                    <?php if ( get_option('boostpluigns_payment_page_text') ) {
	                        ?>
	                        <p><?php _e( get_option('boostpluigns_payment_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
	                        <?php
	                    } ?>
	                <div id="order_review" class="woocommerce-checkout-review-order">
	                    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
	                    <?php add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20); ?>

	                    <?php remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10); ?>
	                    
	                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
	                </div>
	            </div>
			</div>
	        <?php } else { ?> 
	        <!-- If Payment & order review are combained or Order review hide -->	        
	        <?php do_action( 'boostpluigns_after_order_info', $checkout ); ?>
	        <?php do_action( 'boostpluigns_before_payment', $checkout ); ?>
	        <div class="tab-pane <?php echo esc_attr($anim); ?>" role="tabpanel" id="payment-order-step">
	        	<?php if ( 'yes' == get_option( 'boostpluigns_order_payment_tabs' ) ) { ?>
	        	<h1 class="title-payment"><?php echo get_option( 'boostpluigns_order_payment_label' ) ? __( get_option( 'boostpluigns_order_payment_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Order & Payment', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>
	        	<?php } else { ?>
	        	<h1 class="title-payment"><?php echo get_option( 'boostpluigns_payment_label' ) ? __( get_option( 'boostpluigns_payment_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Payment', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>
	        	<?php } ?>        
		        <div class="payment-order-step">
		            <?php 
		                if ( 'true' != get_option( 'boostpluigns_coupon_form' ) && 'default' != get_option( 'boostpluigns_coupon_placement' ) && 'before-order-review-table' == get_option( 'boostpluigns_coupon_placement' ) ) { 
		                    ?>                    
		                    <div class="coupon-step">
		                    	<?php if ( 'true' != $is_login_form || is_user_logged_in() ) { ?>
						        	<div style="display: none;">
									    <form id="hiden"><input type="hidden" name="txt"></form>
									</div>
								<?php } ?>
		                    	<?php add_action('woocommerce_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10); ?>
								<?php do_action('woocommerce_checkout_coupon_form', $checkout); ?>
		                    </div>
		                <?php
		                }
		            ?>
		            <?php if ( get_option( 'boostpluigns_order_payment_page_title' ) ) { 
		                ?>
		                <h2><?php _e( get_option( 'boostpluigns_order_payment_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
		                <hr />
		                <?php
		            } 
		            ?>
		            <?php if ( get_option('boostpluigns_order_payment_page_text') ) {
		                ?>
		                <p><?php _e( get_option('boostpluigns_order_payment_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
		                <?php
		            } ?>
		            <div id="order_review" class="woocommerce-checkout-review-order">
		            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
		            <?php 
		                if ( 'true' != get_option( 'boostpluigns_coupon_form' ) && 'default' != get_option( 'boostpluigns_coupon_placement' ) && 'after-order-review-table' == get_option( 'boostpluigns_coupon_placement' ) ) { 
		                    ?>                    
		                    
		                    <?php 
		                    remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
		                    do_action( 'woocommerce_checkout_order_review' ); 
		                    ?>
		                    <div class="coupon-step">
		                    	<?php if ( 'true' != $is_login_form || is_user_logged_in() ) { ?>
						        	<div style="display: none;">
									    <form id="hiden"><input type="hidden" name="txt"></form>
									</div>
								<?php } ?>
		                    	<?php add_action('woocommerce_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10); ?>
								<?php do_action('woocommerce_checkout_coupon_form', $checkout); ?>
		                    </div>
		                    <?php
		                    add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20); 

		                    remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10); 
		                    
		                    do_action( 'woocommerce_checkout_order_review' );
		                } else {
		                    do_action( 'woocommerce_checkout_order_review' );
		                } 
		                ?>
		            </div>
		        </div>
		    </div>
        	<?php } ?>

        	<?php if ( 'true' == get_option( 'boostpluigns_review_order' ) ) { ?>
	        <div class="tab-pane <?php echo esc_attr($anim); ?>" role="tabpanel" id="review-order-step">
	            <h1 class="title-review-order"><?php echo get_option( 'boostpluigns_review_order_label' ) ? __( get_option( 'boostpluigns_review_order_label' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Review order', 'woo-multistep-checkout-by-boostplugins' ); ?></h1>	        
		        <div class="review-order-step">
		            <?php if ( get_option( 'boostpluigns_order_review_page_title' ) ) { 
		                ?>
		                <h2><?php _e( get_option( 'boostpluigns_order_review_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
		                <hr />
		                <?php
		            } 
		            ?>
		            <?php if ( get_option('boostpluigns_order_review_page_text') ) {
		                ?>
		                <p><?php _e( get_option('boostpluigns_order_review_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
		                <?php
		            } ?>
		            <?php if ( 'true' != get_option( 'boostpluigns_coupon_form' ) && 'default' != get_option('boostpluigns_coupon_placement') && 'review-order-page' == get_option('boostpluigns_coupon_placement') ) {
		                ?>
		                <div class="coupon-step" id="coupon-on-review">
		                	<?php if ( 'true' != $is_login_form || is_user_logged_in() ) { ?>
					        	<div style="display: none;">
								    <form id="hiden"><input type="hidden" name="txt"></form>
								</div>
							<?php } ?>
		                	<?php add_action('woocommerce_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10); ?>
							<?php do_action('woocommerce_checkout_coupon_form', $checkout); ?>
		                </div>
		                <?php
		            }
		            ?>
		            <div class="bpwcmsc-review-order-details"></div>
		            <?php do_action( 'boostpluigns_order_customer_review' ); ?>
		        </div>
		    </div>
        	<?php } ?>
        	<div class="clearfix"></div>
        	<?php do_action( 'boostpluigns_after', $checkout ); ?>
        </div>
		<!-- Tab Content -->
    </form>
	
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	<div class="actions">
		<ul id="pagination">
			<li id="skip"><a href="#skip"><?php echo get_option( 'boostpluigns_skip_login_label' ) ? __( stripslashes( get_option( 'boostpluigns_skip_login_label' ) ), 'woo-multistep-checkout-by-boostplugins' ) : __( "Skip Login", 'woo-multistep-checkout-by-boostplugins' ) ?></a></li>
			<li id="prev"><a href="#prev"><?php echo get_option( 'boostpluigns_prev_button_lable' ) ? __( get_option('boostpluigns_prev_button_lable' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Previous', 'woo-multistep-checkout-by-boostplugins' ) ?></a></li>
			<li id="next"><a href="#next"><?php echo get_option( 'boostpluigns_next_button_lable' ) ? __( get_option( 'boostpluigns_next_button_lable' ), 'woo-multistep-checkout-by-boostplugins' ) : __('Next', 'woo-multistep-checkout-by-boostplugins') ?></a></li>
			<li id="last"><a href="#last"><?php echo get_option( 'boostpluigns_place_order' ) ? __(get_option( 'boostpluigns_place_order' ), 'woo-multistep-checkout-by-boostplugins' ) : __( 'Place Order', 'woo-multistep-checkout-by-boostplugins' ) ?></a></li>
		</ul>
	</div>
</div>
<!-- Steps -->
