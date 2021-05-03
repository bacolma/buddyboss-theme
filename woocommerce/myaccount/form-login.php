<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php wc_print_notices(); ?>

<div class="bsMyAccount">

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'no' ) : ?>
    <div class="woocommerce-MyAccount-content">
        <div class="wc-MyAccount-sub-heading">
            <h2><?php esc_html_e( 'Login', 'buddyboss-theme' ); ?></h2>
        </div>

<?php endif; ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

        <div class="bb_customer_login">

    		<h2><?php esc_html_e( 'Login', 'buddyboss-theme' ); ?></h2>
    
    		<form class="woocommerce-form woocommerce-form-login login" method="post">
    
    			<?php do_action( 'woocommerce_login_form_start' ); ?>
    
    			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    				<label for="username"><?php esc_html_e( 'Username or email address', 'buddyboss-theme' ); ?> <span class="required">*</span></label>
    				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    			</p>
    			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    				<label for="password"><?php esc_html_e( 'Password', 'buddyboss-theme' ); ?> <span class="required">*</span></label>
    				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
    			</p>
    
    			<?php do_action( 'woocommerce_login_form' ); ?>
                
    			<p class="woocommerce-LostPassword lost_password">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
    					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'buddyboss-theme' ); ?></span>
    				</label>
    				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'buddyboss-theme' ); ?></a>
    			</p>
                <p class="form-row woocommerce-LoginBtn">
    				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
    				<button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'buddyboss-theme' ); ?>"><?php esc_html_e( 'Login', 'buddyboss-theme' ); ?></button>
    			</p>
    
    			<?php do_action( 'woocommerce_login_form_end' ); ?>
    
    		</form>
        
        </div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="u-column2 col-2">
    
        <div class="bb_customer_register">

    		<h2><?php esc_html_e( 'Register', 'buddyboss-theme' ); ?></h2>
    
    		<form method="post" class="register">
    
    			<?php do_action( 'woocommerce_register_form_start' ); ?>
    
    			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
    
    				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    					<label for="reg_username"><?php esc_html_e( 'Username', 'buddyboss-theme' ); ?> <span class="required">*</span></label>
    					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    				</p>
    
    			<?php endif; ?>
    
    			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    				<label for="reg_email"><?php esc_html_e( 'Email address', 'buddyboss-theme' ); ?> <span class="required">*</span></label>
    				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    			</p>
    
    			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
    
    				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    					<label for="reg_password"><?php esc_html_e( 'Password', 'buddyboss-theme' ); ?> <span class="required">*</span></label>
    					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
    				</p>
    
    			<?php endif; ?>
    
    			<?php do_action( 'woocommerce_register_form' ); ?>
    
    			<p class="woocommerce-FormRow form-row woocommerce-RegisterBtn">
    				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
    				<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'buddyboss-theme' ); ?>"><?php esc_html_e( 'Register', 'buddyboss-theme' ); ?></button>
    			</p>
    
    			<?php do_action( 'woocommerce_register_form_end' ); ?>
    
    		</form>
        
        </div>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'no' ) : ?>
    </div> <?php // woocommerce-MyAccount-content ?>
<?php endif; ?>

</div>
