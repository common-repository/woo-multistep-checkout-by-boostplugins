<?php
/**
 * Page is adding options to WP back end.
 */
defined( 'ABSPATH' ) || exit;

if ( !current_user_can( 'manage_options' ) ) {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}

$tab        = filter_input( INPUT_GET, 'tab' );
$tabs       = array( 'basic', 'opts', 'layout' );
$the_tab    = ( ! empty( $tab ) && in_array( $tab, $tabs ) ) ? $tab : 'basic';
?>
<div class="wrapper boostpluigns">
    <!-- Main left start -->
    <div class="bpwcmscleftmain">
        <div class="maincheckrow">
            <div class="leftnavbox">
                <div class="logobox"><img src="<?php echo BPWCMSC_DIR_URL . '/images/bpwcmsc_logo.svg'; ?>" alt=""></div>
                <div class="nav-tab-wrapper BPWCMSC-tab-wrapper">
                    <a href="?page=boostpluigns&tab=basic" class="nav-tab <?php echo $the_tab == 'basic' ? ' nav-tab-active' : ''; ?>"><?php _e('General Settings', 'woo-multistep-checkout-by-boostplugins'); ?></a>
                    <a href="?page=boostpluigns&tab=opts" class="nav-tab <?php echo $the_tab == 'opts' ? ' nav-tab-active' : ''; ?>"><?php _e('Step Options', 'woo-multistep-checkout-by-boostplugins'); ?></a>
                    <a href="?page=boostpluigns&tab=layout" class="nav-tab <?php echo $the_tab == 'layout' ? ' nav-tab-active' : ''; ?>"><?php _e('Step layout', 'woo-multistep-checkout-by-boostplugins'); ?></a>
                </div>
            </div>
            <div class="rightpartbox">
                <div class="titlebox"><h2><?php _e('WooCommerce Multistep Checkout', 'woo-multistep-checkout-by-boostplugins') ?></h2></div>
                    <div class="formbox">
                        <form name="bpwcmsc_options" method="post" id="options_form" action="">
                            <?php
                            if ( 'basic' == $the_tab ) {
                            ?>
                            <table class="form-table">
                                <tr>
                                    <td colspan="2"><h3><?php _e('Buttons Text', 'woo-multistep-checkout-by-boostplugins') ?></h3></td>
                                </tr>
                                <tr>
                                    <td><?php _e('Skip Login button label', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_skip_login_label" value="<?php echo get_option('boostpluigns_skip_login_label') ? esc_attr_e(get_option('boostpluigns_skip_login_label')) : "Skip Login" ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Next Button label', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_next_button_lable" value="<?php echo get_option('boostpluigns_next_button_lable') ? esc_attr_e(get_option('boostpluigns_next_button_lable')) : "Next" ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Previous Button label', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_prev_button_lable" value="<?php echo get_option('boostpluigns_prev_button_lable') ? esc_attr_e(get_option('boostpluigns_prev_button_lable')) : "Previous" ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Place Order Button label', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_place_order" value="<?php echo get_option('boostpluigns_place_order') ? esc_attr_e(get_option('boostpluigns_place_order')) : "Place Order" ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><h3><?php _e('Validation Error Messages', 'woo-multistep-checkout-by-boostplugins') ?></h3></td>
                                </tr>
                                <tr>
                                    <td><?php _e('Required Field', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_required_error" value="<?php echo get_option('boostpluigns_required_error') ? esc_attr_e(get_option('boostpluigns_required_error')) : "This field is required" ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Invalid Email', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_email_error" value="<?php echo get_option('boostpluigns_email_error') ? esc_attr_e(get_option('boostpluigns_email_error')) : "Invalid Email address" ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Invalid Phone', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_phone_error" value="<?php echo get_option('boostpluigns_phone_error') ? esc_attr_e(get_option('boostpluigns_phone_error')) : "Invalild phone number" ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Invalid Postcode', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_postcode_error" value="<?php echo get_option('boostpluigns_postcode_error') ? esc_attr_e(get_option('boostpluigns_postcode_error')) : "Invalid zip/pincode" ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Terms and condition', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <input class="input_text" type="text" name="boostpluigns_tnc_error" value="<?php echo get_option('boostpluigns_tnc_error') ? esc_attr_e(get_option('boostpluigns_tnc_error')) : "Please check Terms and Condition." ?>" />
                                    </td>
                                </tr>
                            </table>
                            <?php
                            } else if ( 'opts' == $the_tab ) {
                            ?>
                            <table class="form-table form-table1">
                                <tr>
                                    <td colspan="4"><h3><?php _e('Steps customization options', 'woo-multistep-checkout-by-boostplugins') ?></h3>
                                        <span class="description"><?php _e( 'Various options for your checkout steps.','woo-multistep-checkout-by-boostplugins' ) ?></span>
                                    </td>
                                </tr>
                                <tr class="titlerow">
                                    <td><h4><?php _e('Step Titles', 'woo-multistep-checkout-by-boostplugins') ?></h4></td>
                                    <td><h4><?php _e('Page Title', 'woo-multistep-checkout-by-boostplugins') ?></h4></td>
                                    <td><h4><?php _e('Page Text', 'woo-multistep-checkout-by-boostplugins') ?></h4></td>
                                    <td><h4><?php _e('Step Option', 'woo-multistep-checkout-by-boostplugins') ?></h4></td>
                                </tr>
                                <!-- Login/Registration -->
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_login_label" value="<?php echo get_option('boostpluigns_login_label') ? esc_attr_e(get_option('boostpluigns_login_label')) : "Login" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_login_page_title" value="<?php echo get_option('boostpluigns_login_page_title') ? esc_attr_e(get_option('boostpluigns_login_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_login_page_text" value="<?php echo get_option('boostpluigns_login_page_text') ? esc_attr_e(get_option('boostpluigns_login_page_text')) : "" ?>" />
                                    </td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="show-login" class="input-radio-button" type="radio" name="boostpluigns_login_form" value="true" <?php checked(sanitize_text_field(get_option('boostpluigns_login_form')), 'true', true); ?> >
                                            <label class="input-label-button label-button-left" for="show-login">
                                                <span class="label-button-text"><?php _e('Show', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="hide-login" class="input-radio-button" type="radio" name="boostpluigns_login_form" value="false" <?php checked(sanitize_text_field(get_option('boostpluigns_login_form')), 'false', true); ?>>
                                            <label class="input-label-button label-button-right" for="hide-login">
                                                <span class="label-button-text"><?php _e('Hide', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_coupon_label" value="<?php echo get_option('boostpluigns_coupon_label') ? esc_attr_e(get_option('boostpluigns_coupon_label')) : "Coupon" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_coupon_page_title" value="<?php echo get_option('boostpluigns_coupon_page_title') ? esc_attr_e(get_option('boostpluigns_coupon_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_coupon_page_text" value="<?php echo get_option('boostpluigns_coupon_page_text') ? esc_attr_e(get_option('boostpluigns_coupon_page_text')) : "" ?>" />
                                    </td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="show-coupon" class="input-radio-button" type="radio" name="boostpluigns_coupon_form" value="true" <?php checked(sanitize_text_field(get_option('boostpluigns_coupon_form')), 'true', true); ?> >
                                            <label class="input-label-button label-button-left" for="show-coupon">
                                                <span class="label-button-text"><?php _e('Show', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="hide-coupon" class="input-radio-button" type="radio" name="boostpluigns_coupon_form" value="false" <?php checked(sanitize_text_field(get_option('boostpluigns_coupon_form')), 'false', true); ?>>
                                            <label class="input-label-button label-button-right" for="hide-coupon">
                                                <span class="label-button-text"><?php _e('Hide', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_billing_label" value="<?php echo get_option('boostpluigns_billing_label') ? esc_attr_e(get_option('boostpluigns_billing_label')) : "Billing" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_billing_page_title" value="<?php echo get_option('boostpluigns_billing_page_title') ? esc_attr_e(get_option('boostpluigns_billing_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_billing_page_text" value="<?php echo get_option('boostpluigns_billing_page_text') ? esc_attr_e(get_option('boostpluigns_billing_page_text')) : "" ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_shipping_label" value="<?php echo get_option('boostpluigns_shipping_label') ? esc_attr_e(get_option('boostpluigns_shipping_label')) : "Shipping" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_shipping_page_title" value="<?php echo get_option('boostpluigns_shipping_page_title') ? esc_attr_e(get_option('boostpluigns_shipping_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_shipping_page_text" value="<?php echo get_option('boostpluigns_shipping_page_text') ? esc_attr_e(get_option('boostpluigns_shipping_page_text')) : "" ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_billing_shipping_label" value="<?php echo get_option('boostpluigns_billing_shipping_label') ? esc_attr_e(get_option('boostpluigns_billing_shipping_label')) : "Billing & Shipping" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_billing_shipping_page_title" value="<?php echo get_option('boostpluigns_billing_shipping_page_title') ? esc_attr_e(get_option('boostpluigns_billing_shipping_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_billing_shipping_page_text" value="<?php echo get_option('boostpluigns_billing_shipping_page_text') ? esc_attr_e(get_option('boostpluigns_billing_shipping_page_text')) : "" ?>" />
                                    </td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="combine-bs-y" class="input-radio-button" type="radio" name="boostpluigns_billing_shipping" value="yes" <?php checked(sanitize_text_field(get_option('boostpluigns_billing_shipping')), 'yes', true); ?> >
                                            <label class="input-label-button label-button-left" for="combine-bs-y">
                                                <span class="label-button-text"><?php _e('Yes', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="combine-bs-n" class="input-radio-button" type="radio" name="boostpluigns_billing_shipping" value="no" <?php checked(sanitize_text_field(get_option('boostpluigns_billing_shipping')), 'no', true); ?> >
                                            <label class="input-label-button label-button-right" for="combine-bs-n">
                                                <span class="label-button-text"><?php _e('No', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <span class="description"><?php _e('If you want to combine Billing & Shipping?', 'woo-multistep-checkout-by-boostplugins') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_order_label" value="<?php echo get_option('boostpluigns_order_label') ? esc_attr_e(get_option('boostpluigns_order_label')) : "Order Details" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_order_details_page_title" value="<?php echo get_option('boostpluigns_order_details_page_title') ? esc_attr_e(get_option('boostpluigns_order_details_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_order_details_page_text" value="<?php echo get_option('boostpluigns_order_details_page_text') ? esc_attr_e(get_option('boostpluigns_order_details_page_text')) : "" ?>" />
                                    </td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="show-order" class="input-radio-button" type="radio" name="boostpluigns_order_detail" value="true" <?php checked(sanitize_text_field(get_option('boostpluigns_order_detail')), 'true', true); ?> >
                                            <label class="input-label-button label-button-left" for="show-order">
                                                <span class="label-button-text"><?php _e('Show', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="hide-order" class="input-radio-button" type="radio" name="boostpluigns_order_detail" value="false" <?php checked(sanitize_text_field(get_option('boostpluigns_order_detail')), 'false', true); ?>>
                                            <label class="input-label-button label-button-right" for="hide-order">
                                                <span class="label-button-text"><?php _e('Hide', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_payment_label" value="<?php echo get_option('boostpluigns_payment_label') ? esc_attr_e(get_option('boostpluigns_payment_label')) : "Payment" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_payment_page_title" value="<?php echo get_option('boostpluigns_payment_page_title') ? esc_attr_e(get_option('boostpluigns_payment_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_payment_page_text" value="<?php echo get_option('boostpluigns_payment_page_text') ? esc_attr_e(get_option('boostpluigns_payment_page_text')) : "" ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_order_payment_label" value="<?php echo get_option('boostpluigns_order_payment_label') ? esc_attr_e(get_option('boostpluigns_order_payment_label')) : "Order & Payment" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_order_payment_page_title" value="<?php echo get_option('boostpluigns_order_payment_page_title') ? esc_attr_e(get_option('boostpluigns_order_payment_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_order_payment_page_text" value="<?php echo get_option('boostpluigns_order_payment_page_text') ? esc_attr_e(get_option('boostpluigns_order_payment_page_text')) : "" ?>" />
                                    </td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="combine-op-y" class="input-radio-button" type="radio" name="boostpluigns_order_payment_tabs" value="yes" <?php checked(sanitize_text_field(get_option('boostpluigns_order_payment_tabs')), 'yes', true); ?> >
                                            <label class="input-label-button label-button-left" for="combine-op-y">
                                                <span class="label-button-text"><?php _e('Yes', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="combine-op-n" class="input-radio-button" type="radio" name="boostpluigns_order_payment_tabs" value="no" <?php checked(sanitize_text_field(get_option('boostpluigns_order_payment_tabs')), 'no', true); ?> >
                                            <label class="input-label-button label-button-right" for="combine-op-n">
                                                <span class="label-button-text"><?php _e('No', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <span class="description"><?php _e('If you want to combine Order & Payment?', 'woo-multistep-checkout-by-boostplugins') ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_review_order_label" value="<?php echo get_option('boostpluigns_review_order_label') ? esc_attr_e(get_option('boostpluigns_review_order_label')) : "Review order" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_order_review_page_title" value="<?php echo get_option('boostpluigns_order_review_page_title') ? esc_attr_e(get_option('boostpluigns_order_review_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_order_review_page_text" value="<?php echo get_option('boostpluigns_order_review_page_text') ? esc_attr_e(get_option('boostpluigns_order_review_page_text')) : "" ?>" />
                                    </td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="show-review" class="input-radio-button" type="radio" name="boostpluigns_review_order" value="true" <?php checked(sanitize_text_field(get_option('boostpluigns_review_order')), 'true', true); ?> >
                                            <label class="input-label-button label-button-left" for="show-review">
                                                <span class="label-button-text"><?php _e('Show', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="hide-review" class="input-radio-button" type="radio" name="boostpluigns_review_order" value="false" <?php checked(sanitize_text_field(get_option('boostpluigns_review_order')), 'false', true); ?>>
                                            <label class="input-label-button label-button-right" for="hide-review">
                                                <span class="label-button-text"><?php _e('Hide', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Show/Hide Registration in steps', 'woo-multistep-checkout-by-boostplugins') ?><br />
                                        <span class="description"><?php _e('Enable customer registration on the "My account" page from WooCommerce Settings.', 'woo-multistep-checkout-by-boostplugins') ?></span>
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_register_page_title" value="<?php echo get_option('boostpluigns_register_page_title') ? esc_attr_e(get_option('boostpluigns_register_page_title')) : "" ?>" />
                                    </td>
                                    <td>
                                        <input class="input_text1" type="text" name="boostpluigns_register_page_text" value="<?php echo get_option('boostpluigns_register_page_text') ? esc_attr_e(get_option('boostpluigns_register_page_text')) : "" ?>" />
                                    </td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="show-registraion" class="input-radio-button" type="radio" name="boostpluigns_registration_form" value="true" <?php checked(sanitize_text_field(get_option('boostpluigns_registration_form')), 'true', true); ?> >
                                            <label class="input-label-button label-button-left" for="show-registraion">
                                                <span class="label-button-text"><?php _e('Show', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup registration-radio-btn">
                                            <input id="hide-registraion" class="input-radio-button" type="radio" name="boostpluigns_registration_form" value="false" <?php checked(sanitize_text_field(get_option('boostpluigns_registration_form')), 'false', true); ?>>
                                            <label class="input-label-button label-button-right" for="hide-registraion">
                                                <span class="label-button-text"><?php _e('Hide', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <span class="description"><?php _e('Works only if Login step is shown.', 'woo-multistep-checkout-by-boostplugins') ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Change coupon form placement', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td colspan="3">
                                        <div class="radiogroup">
                                            <input id="before-order-review-table" class="input-radio-button" type="radio" name="boostpluigns_coupon_placement" value="before-order-review-table" <?php checked(sanitize_text_field(get_option('boostpluigns_coupon_placement')), 'before-order-review-table', true); ?> >
                                            <label class="input-label-button label-button-left" for="before-order-review-table">
                                                <span class="label-button-text"><?php _e('Before order details Table', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="after-order-review-table" class="input-radio-button" type="radio" name="boostpluigns_coupon_placement" value="after-order-review-table" <?php checked(sanitize_text_field(get_option('boostpluigns_coupon_placement')), 'after-order-review-table', true); ?>>
                                            <label class="input-label-button label-button-right" for="after-order-review-table">
                                                <span class="label-button-text"><?php _e('After order details Table', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="review-order-page" class="input-radio-button" type="radio" name="boostpluigns_coupon_placement" value="review-order-page" <?php checked(sanitize_text_field(get_option('boostpluigns_coupon_placement')), 'review-order-page', true); ?>>
                                            <label class="input-label-button label-button-right" for="review-order-page">
                                                <span class="label-button-text"><?php _e('Review Order Page', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="default" class="input-radio-button" type="radio" name="boostpluigns_coupon_placement" value="default" <?php checked(sanitize_text_field(get_option('boostpluigns_coupon_placement')), 'default', true); ?>>
                                            <label class="input-label-button label-button-right" for="default">
                                                <span class="label-button-text"><?php _e('None (Hide Coupon form from every step.)', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Show/Hide Product Thumbnail', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td colspan="2">
                                        <div class="radiogroup">
                                            <input id="show-thumbnail" class="input-radio-button" type="radio" name="boostpluigns_show_thumbnail" value="true" <?php checked(sanitize_text_field(get_option('boostpluigns_show_thumbnail')), 'true', true); ?> >
                                            <label class="input-label-button label-button-left" for="show-thumbnail">
                                                <span class="label-button-text"><?php _e('Show', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="hide-thumbnail" class="input-radio-button" type="radio" name="boostpluigns_show_thumbnail" value="false" <?php checked(sanitize_text_field(get_option('boostpluigns_show_thumbnail')), 'false', true); ?>>
                                            <label class="input-label-button label-button-right" for="hide-thumbnail">
                                                <span class="label-button-text"><?php _e('Hide', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php _e('Show/Hide Additional Details', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td colspan="3">
                                        <div class="radiogroup">
                                            <input id="show-additional" class="input-radio-button" type="radio" name="boostpluigns_additional_details" value="true" <?php checked(sanitize_text_field(get_option('boostpluigns_additional_details')), 'true', true); ?> >
                                            <label class="input-label-button label-button-left" for="show-additional">
                                                <span class="label-button-text"><?php _e('Show', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="hide-additional" class="input-radio-button" type="radio" name="boostpluigns_additional_details" value="false" <?php checked(sanitize_text_field(get_option('boostpluigns_additional_details')), 'false', true); ?>>
                                            <label class="input-label-button label-button-right" for="hide-additional">
                                                <span class="label-button-text"><?php _e('Hide', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Animation', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td colspan="3">
                                        <div class="radiogroup">
                                            <input id="fade" class="input-radio-button" type="radio" name="boostpluigns_animation" value="fade" <?php checked(sanitize_text_field(get_option('boostpluigns_animation')), 'fade', true); ?> >
                                            <label class="input-label-button label-button-left" for="fade">
                                                <span class="label-button-text"><?php _e('Fade', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="slide" class="input-radio-button" type="radio" name="boostpluigns_animation" value="slide" <?php checked(sanitize_text_field(get_option('boostpluigns_animation')), 'slide', true); ?> >
                                            <label class="input-label-button label-button-right" for="slide">
                                                <span class="label-button-text"><?php _e('Slide', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="zoom" class="input-radio-button" type="radio" name="boostpluigns_animation" value="zoom" <?php checked(sanitize_text_field(get_option('boostpluigns_animation')), 'zoom', true); ?> >
                                            <label class="input-label-button label-button-right" for="zoom">
                                                <span class="label-button-text"><?php _e('Zoom', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Steps orientation', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td colspan="2">
                                        <div class="radiogroup">
                                            <input id="horizontal" class="input-radio-button" type="radio" name="boostpluigns_orientation" value="horizontal" <?php checked(sanitize_text_field(get_option('boostpluigns_orientation')), 'horizontal', true); ?> >
                                            <label class="input-label-button label-button-left" for="horizontal">
                                                <span class="label-button-text"><?php _e('Horizontal', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="vertical" class="input-radio-button" type="radio" name="boostpluigns_orientation" value="vertical" <?php checked(sanitize_text_field(get_option('boostpluigns_orientation')), 'vertical', true); ?> >
                                            <label class="input-label-button label-button-right" for="vertical">
                                                <span class="label-button-text"><?php _e('Vertical', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php _e('Remove Numbers', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="number-show" class="input-radio-button" type="radio" name="boostpluigns_number_hide_show" value="yes" <?php checked(sanitize_text_field(get_option('boostpluigns_number_hide_show')), 'yes', true); ?> >
                                            <label class="input-label-button label-button-left" for="number-show">
                                                <span class="label-button-text"><?php _e('Yes', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="number-hide" class="input-radio-button" type="radio" name="boostpluigns_number_hide_show" value="no" <?php checked(sanitize_text_field(get_option('boostpluigns_number_hide_show')), 'no', true); ?> >
                                            <label class="input-label-button label-button-right" for="number-hide">
                                                <span class="label-button-text"><?php _e('No', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <td></td>
                                        <td></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Zip/Postcode Validation', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td>
                                        <div class="radiogroup">
                                            <input id="postcode-yes" class="input-radio-button" type="radio" name="boostpluigns_postcode_validation" value="yes" <?php checked(sanitize_text_field(get_option('boostpluigns_postcode_validation')), 'yes', true); ?> >
                                            <label class="input-label-button label-button-left" for="postcode-yes">
                                                <span class="label-button-text"><?php _e('Yes', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                        <div class="radiogroup">
                                            <input id="postcode-no" class="input-radio-button" type="radio" name="boostpluigns_postcode_validation" value="no" <?php checked(sanitize_text_field(get_option('boostpluigns_postcode_validation')), 'no', true); ?> >
                                            <label class="input-label-button label-button-right" for="postcode-no">
                                                <span class="label-button-text"><?php _e('No', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                            <?php
                            } else if ( 'layout' == $the_tab ) {
                            ?>
                            <table class="form-table">
                                <input type="hidden" name="orientation" value="<?php echo esc_attr_e( get_option('boostpluigns_orientation') ) ?>" />
                                <tr>

                                    <td><?php _e('Steps Layout', 'woo-multistep-checkout-by-boostplugins') ?><br /><span class="description"><?php _e('Select the step layouts', 'woo-multistep-checkout-by-boostplugins') ?></span></td>
                                    <td>
                                        <input id="layout-style1" class="input-radio-button" type="radio" name="boostpluigns_steps_style" value="style1" <?php checked(sanitize_text_field(get_option('boostpluigns_steps_style')), 'style1', true); ?> >
                                        <label class="input-label-button label-button-right" for="layout-style1">
                                            <img src="<?php echo BPWCMSC_DIR_URL . '/images/style1.png'; ?>">
                                        </label><br />
                                        <input id="layout-style2" class="input-radio-button" type="radio" name="boostpluigns_steps_style" value="style2" <?php checked(sanitize_text_field(get_option('boostpluigns_steps_style')), 'style2', true); ?> >
                                        <label class="input-label-button label-button-right" for="layout-style2">
                                            <img src="<?php echo BPWCMSC_DIR_URL . '/images/style2.png'; ?>">
                                        </label><br />
                                        <input id="layout-style3" class="input-radio-button" type="radio" name="boostpluigns_steps_style" value="style3" <?php checked(sanitize_text_field(get_option('boostpluigns_steps_style')), 'style3', true); ?> >
                                        <label class="input-label-button label-button-right" for="layout-style3">
                                            <img src="<?php echo BPWCMSC_DIR_URL . '/images/style3.png'; ?>">
                                        </label><br />
                                        <input id="layout-style4" class="input-radio-button" type="radio" name="boostpluigns_steps_style" value="style4" <?php checked(sanitize_text_field(get_option('boostpluigns_steps_style')), 'style4', true); ?> >
                                        <label class="input-label-button label-button-right" for="layout-style4">
                                            <img src="<?php echo BPWCMSC_DIR_URL . '/images/style4.png'; ?>">
                                        </label><br />
                                        <input id="layout-style5" class="input-radio-button" type="radio" name="boostpluigns_steps_style" value="style5" <?php checked(sanitize_text_field(get_option('boostpluigns_steps_style')), 'style5', true); ?> >
                                    <label class="input-label-button label-button-right" for="layout-style5">
                                        <img src="<?php echo BPWCMSC_DIR_URL . '/images/style5.png'; ?>">
                                    </label><br />
                                    <input id="layout-style6" class="input-radio-button" type="radio" name="boostpluigns_steps_style" value="style6" <?php checked(sanitize_text_field(get_option('boostpluigns_steps_style')), 'style6', true); ?> >
                                    <label class="input-label-button label-button-right" for="layout-style6">
                                        <img src="<?php echo BPWCMSC_DIR_URL . '/images/style6.png'; ?>">
                                    </label><br />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="200"><?php _e('Background color for active steps', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td><input name="boostpluigns_color_active" id="boostpluigns_color_active" type="text" value="<?php echo esc_attr_e(get_option('boostpluigns_color_active')) ?>" class="regular-text" />
                                    </td>
                                </tr>
                                <tr id="number-bgcolor">
                                    <td><?php _e('Number Background color for steps', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td><input name="boostpluigns_color_number" id="boostpluigns_color_number" type="text" value="<?php echo esc_attr_e(get_option('boostpluigns_color_number')) ?>" class="regular-text" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Background color for inactive steps', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td><input name="boostpluigns_color_inactive" id="boostpluigns_color_inactive" type="text" value="<?php echo esc_attr_e(get_option('boostpluigns_color_inactive')) ?>" class="regular-text" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Background color for completed steps', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td><input name="boostpluigns_color_completed" id="boostpluigns_color_completed" type="text" value="<?php echo esc_attr_e(get_option('boostpluigns_color_completed')) ?>" class="regular-text" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Step font color', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td><input name="boostpluigns_color_font" id="boostpluigns_color_font" type="text" value="<?php echo esc_attr_e(get_option('boostpluigns_color_font')) ?>" class="regular-text" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Buttons Color', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td><input name="boostpluigns_color_buttons" id="boostpluigns_color_buttons" type="text" value="<?php echo esc_attr_e(get_option('boostpluigns_color_buttons')) ?>" class="regular-text" />
                                </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Buttons Font color', 'woo-multistep-checkout-by-boostplugins') ?></td>
                                    <td><input name="boostpluigns_color_buttons_font" id="boostpluigns_color_buttons_font" type="text" value="<?php echo esc_attr_e(get_option('boostpluigns_color_buttons_font')) ?>" class="regular-text" />
                                    </td>
                                </tr>
                            </table>
                            <div class="preview-window" >
                                <!-- <p>Preview Changes</p> -->
                                <iframe class="b-iframe" scrolling="yes" src="<?php echo esc_url( home_url('/index.php?plugin='.BPWCMSC_DIR_NAME.'&action=') ) . wp_create_nonce('preview'); ?>"></iframe>
                            </div>
                            <?php
                            }
                        ?>
                        <p class="submit bpwcmscsubmit">
                            <?php wp_nonce_field( 'bpwcmsc_push_setting', 'posted_data', false ); ?>
                            <input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
                        </p>
                        <p class="submit bpwcmscsubmit" style="margin-left: 10px;">
                            <?php wp_nonce_field( 'bpwcmsc_default_setting', 'bpwcmsc_restore_default', false ); ?>
                            <input type="submit" name="default" class="button-primary" value="<?php esc_attr_e('Set Default') ?>" />
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
