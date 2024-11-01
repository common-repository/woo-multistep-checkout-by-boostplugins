<?php
/**
 * Login form
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
    return;
}

?>
<div style="display: none;">
    <form id="hiden"><input type="hidden" name="txt"></form>
</div>
<!-- If Login form selected from back end -->
<?php if ( 'true' == get_option( 'boostpluigns_login_form' ) && 'false' == get_option( 'boostpluigns_registration_form' ) || 'false' == get_option( 'boostpluigns_login_form' ) ) { ?>
    <form class="woocommerce-form woocommerce-form-login login" method="post"   <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?> >
        <?php do_action( 'woocommerce_login_form_start' ); ?>
        <?php 
            if ( get_option('boostpluigns_login_page_text') ) {
            ?>
            <p><?php _e( get_option('boostpluigns_login_page_text') ); ?> </p>
            <?php 
            } else { 
                echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; 
            }
            ?>
        <p class="form-row form-row-first">
            <label for="username"><?php _e( 'Username or email', 'woo-multistep-checkout-by-boostplugins' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="username" id="username" />
        </p>
        <p class="form-row form-row-last">
            <label for="password"><?php _e( 'Password', 'woo-multistep-checkout-by-boostplugins' ); ?> <span class="required">*</span></label>
            <input class="input-text" type="password" name="password" id="password" />
        </p>
        <div class="clear"></div>
        <?php do_action( 'woocommerce_login_form' ); ?>
        <p class="form-row">
            <?php wp_nonce_field( 'woocommerce-login' ); ?>
            <input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'woo-multistep-checkout-by-boostplugins' ); ?>" />
            <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php _e( 'Remember me', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
            </label>
        </p>
        <p class="lost_password">
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woo-multistep-checkout-by-boostplugins' ); ?></a>
        </p>
        <div class="clear"></div>
        <?php do_action( 'woocommerce_login_form_end' ); ?>
    </form>
    <?php
} ?>

<?php if ( 'true' == get_option( 'boostpluigns_login_form' ) && 'true' == get_option( 'boostpluigns_registration_form' ) && get_option('woocommerce_enable_myaccount_registration') === 'no' ) { ?>
    <form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?> >

        <?php if ( get_option( 'boostpluigns_login_page_title' ) ) { 
            ?>
            <h2><?php _e( get_option( 'boostpluigns_login_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
            <?php
        } 
        ?>
        <!-- <hr /> -->

        <?php do_action( 'woocommerce_login_form_start' ); ?>
        <?php 
            if ( get_option('boostpluigns_login_page_text') ) {
            ?>
            <p><?php _e( get_option('boostpluigns_login_page_text') ); ?> </p>
            <?php 
            } else { 
                echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; 
            }
            ?>

        <p class="form-row form-row-first">
            <label for="username"><?php _e( 'Username or email', 'woo-multistep-checkout-by-boostplugins' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="username" id="username" />
        </p>
        <p class="form-row form-row-last">
            <label for="password"><?php _e( 'Password', 'woo-multistep-checkout-by-boostplugins' ); ?> <span class="required">*</span></label>
            <input class="input-text" type="password" name="password" id="password" />
        </p>
        <div class="clear"></div>

        <?php do_action( 'woocommerce_login_form' ); ?>

        <p class="form-row">
            <?php wp_nonce_field( 'woocommerce-login' ); ?>
            <input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'woo-multistep-checkout-by-boostplugins' ); ?>" />
            <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php _e( 'Remember me', 'woo-multistep-checkout-by-boostplugins' ); ?></span>
            </label>
        </p>
        <p class="lost_password">
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woo-multistep-checkout-by-boostplugins' ); ?></a>
        </p>
        <div class="clear"></div>
        <?php do_action( 'woocommerce_login_form_end' ); ?>
    </form>
<?php
}
?>

<!-- If login and Registration form selected from back end -->
<?php if ( 'true' == get_option( 'boostpluigns_login_form' ) && 'true' == get_option( 'boostpluigns_registration_form' ) && get_option('woocommerce_enable_myaccount_registration') === 'yes' ) { ?>
    <?php wc_print_notices(); ?>

    <?php do_action('woocommerce_before_customer_login_form'); ?>

    <?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') : ?>

        <div class="u-columns col2-set" id="customer_login">
                
            <div class="u-column1 col-1">

    <?php endif; ?>

    <?php if ( get_option( 'boostpluigns_login_page_title' ) ) { ?>
        <h2><?php _e( get_option( 'boostpluigns_login_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
        <?php
            } 
            ?>
        <hr />

        <button class="" id="bpwcmsc-login" name="bpwcmsc-login" type="button"><?php _e('Login', 'woo-multistep-checkout-by-boostplugins'); ?></button>
        <div class="" id="hide-login">
            <?php if ( get_option('boostpluigns_login_page_text') ) { ?>
            <p><?php _e( get_option('boostpluigns_login_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
            <?php
                } ?>
            <form class="woocomerce-form woocommerce-form-login login" method="post">
                <?php do_action('woocommerce_login_form_start'); ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="username"><?php _e('Username or email address', 'woo-multistep-checkout-by-boostplugins'); ?> <span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty($_POST['username']) ) ? esc_attr($_POST['username']) : ''; ?>" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password"><?php _e('Password', 'woo-multistep-checkout-by-boostplugins'); ?> <span class="required">*</span></label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
                </p>

                <?php do_action('woocommerce_login_form'); ?>

                <p class="form-row">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                    <input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e('Login', 'woo-multistep-checkout-by-boostplugins'); ?>" />
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php _e('Remember me', 'woo-multistep-checkout-by-boostplugins'); ?></span>
                    </label>
                </p>
                <p class="woocommerce-LostPassword lost_password">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php _e('Lost your password?', 'woo-multistep-checkout-by-boostplugins'); ?></a>
                </p>

                <?php do_action('woocommerce_login_form_end'); ?>
            </form>

            <?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') : ?>
        </div>

            </div>               

            <div class="u-column2 col-2">
                <?php if ( get_option( 'boostpluigns_register_page_title' ) ) { 
                        ?>
                <h2><?php _e( get_option( 'boostpluigns_register_page_title' ), 'woo-multistep-checkout-by-boostplugins' ); ?></h2>
                        <?php
                } 
                ?>
                <hr />
                <button class="" id="bpwcmsc-register" name="bpwcmsc-register" type="button"><?php _e('Register', 'woo-multistep-checkout-by-boostplugins'); ?></button>
                    <div class="" id="hide-register">
                        <?php if ( get_option('boostpluigns_register_page_text') ) {
                            ?>
                            <p><?php _e( get_option('boostpluigns_register_page_text'), 'woo-multistep-checkout-by-boostplugins' ); ?></p>
                            <?php
                        } ?>
                        
                        <form method="post" class="register">

                            <?php do_action('woocommerce_register_form_start'); ?>

                            <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="reg_username"><?php _e('Username', 'woo-multistep-checkout-by-boostplugins'); ?> <span class="required">*</span></label>
                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo ( ! empty($_POST['username']) ) ? esc_attr($_POST['username']) : ''; ?>" />
                                </p>

                            <?php endif; ?>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="reg_email"><?php _e('Email address', 'woo-multistep-checkout-by-boostplugins'); ?> <span class="required">*</span></label>
                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty($_POST['email']) ) ? esc_attr($_POST['email']) : ''; ?>" />
                                </p>

                            <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="reg_password"><?php _e('Password', 'woo-multistep-checkout-by-boostplugins'); ?> <span class="required">*</span></label>
                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
                                </p>

                            <?php endif; ?>

                            <?php do_action('woocommerce_register_form'); ?>

                                <p class="woocomerce-FormRow form-row">
                                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                                    <input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e('Register', 'woo-multistep-checkout-by-boostplugins'); ?>" />
                                </p>

                            <?php do_action('woocommerce_register_form_end'); ?>

                        </form>
                    </div>
            </div>

        </div>
        <?php endif; ?>

    <?php do_action('woocommerce_after_customer_login_form'); ?>
<?php } 