<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<?php
$mepr_options = get_option('mepr_options');
$current_page_id = get_the_ID();
$account_page_id = $mepr_options['account_page_id'];
?>

<div class="mp_wrapper mp_wrapper_home">
  <?php if(!empty($welcome_message)): ?>
    <div id="mepr-account-welcome-message">
      <?php echo MeprHooks::apply_filters('mepr-account-welcome-message', do_shortcode($welcome_message), $mepr_current_user); ?>
    </div>
  <?php endif; ?>

  <?php if( !empty($mepr_current_user->user_message) ): ?>
    <div id="mepr-account-user-message">
      <?php echo MeprHooks::apply_filters('mepr-user-message', wpautop(do_shortcode($mepr_current_user->user_message)), $mepr_current_user); ?>
    </div>
  <?php endif; ?>

  <?php MeprView::render('/shared/errors', get_defined_vars()); ?>

  <form class="mepr-account-form mepr-form" id="mepr_account_form" action="" method="post" novalidate>
    <input type="hidden" name="mepr-process-account" value="Y" />
    <?php wp_nonce_field( 'update_account', 'mepr_account_nonce' ); ?>

    <?php MeprHooks::do_action('mepr-account-home-before-name', $mepr_current_user); ?>

	  <?php if ( isset( $mepr_options->show_fname_lname ) && $mepr_options->show_fname_lname ): ?>
      <div class="mp-form-row mepr_first_name">
        <div class="mp-form-label">
          <label for="user_first_name"><?php _ex('First Name:', 'ui', 'buddyboss-theme'); echo ($mepr_options->require_fname_lname)?'*':''; ?></label>
          <span class="cc-error"><?php _ex('First Name Required', 'ui', 'buddyboss-theme'); ?></span>
        </div>
        <input type="text" name="user_first_name" id="user_first_name" class="mepr-form-input" value="<?php echo $mepr_current_user->first_name; ?>" <?php echo ($mepr_options->require_fname_lname)?'required':''; ?> />
      </div>
      <div class="mp-form-row mepr_last_name">
        <div class="mp-form-label">
          <label for="user_last_name"><?php _ex('Last Name:', 'ui', 'buddyboss-theme'); echo ($mepr_options->require_fname_lname)?'*':''; ?></label>
          <span class="cc-error"><?php _ex('Last Name Required', 'ui', 'buddyboss-theme'); ?></span>
        </div>
        <input type="text" id="user_last_name" name="user_last_name" class="mepr-form-input" value="<?php echo $mepr_current_user->last_name; ?>" <?php echo ($mepr_options->require_fname_lname)?'required':''; ?> />
      </div>
    <?php else: ?>
      <input type="hidden" name="user_first_name" value="<?php echo $mepr_current_user->first_name; ?>" />
      <input type="hidden" name="user_last_name" value="<?php echo $mepr_current_user->last_name; ?>" />
    <?php endif; ?>
    <div class="mp-form-row mepr_email">
      <div class="mp-form-label">
        <label for="user_email"><?php _ex('Email:*', 'ui', 'buddyboss-theme');  ?></label>
        <span class="cc-error"><?php _ex('Invalid Email', 'ui', 'buddyboss-theme'); ?></span>
      </div>
      <input type="email" id="user_email" name="user_email" class="mepr-form-input" value="<?php echo $mepr_current_user->user_email; ?>" required />
    </div>
    <?php
      MeprUsersHelper::render_custom_fields(null, 'account');
      MeprHooks::do_action('mepr-account-home-fields', $mepr_current_user);
    ?>

    <div class="mepr_spacer">&nbsp;</div>

    <input type="submit" name="mepr-account-form" value="<?php _ex('Save Profile', 'ui', 'buddyboss-theme'); ?>" class="mepr-submit mepr-share-button" />
    <img src="<?php echo admin_url('images/loading.gif'); ?>" style="display: none;" class="mepr-loading-gif" />
    <?php MeprView::render('/shared/has_errors', get_defined_vars()); ?>
  </form>

  <div class="mepr_spacer">&nbsp;</div>

  <span class="mepr-account-change-password">
    <a href="<?php echo $account_url.$delim.'action=newpassword'; ?>"><?php _ex('Change Password', 'ui', 'buddyboss-theme'); ?></a>
  </span>

  <?php MeprHooks::do_action('mepr_account_home', $mepr_current_user); ?>
</div>

<?php
// Close '.bb-mp-account-settings' opened in nav.php
if( $current_page_id == $account_page_id ) {
	echo '</div>';
}