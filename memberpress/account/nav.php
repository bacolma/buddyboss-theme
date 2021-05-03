<?php if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');} ?>

<?php
$mepr_options = get_option('mepr_options');
$current_page_id = get_the_ID();
$account_page_id = $mepr_options['account_page_id'];

if( $current_page_id == $account_page_id ) {
	echo '<div class="bb-mp-account-settings">';
}
?>

<div class="mp_wrapper mp_wrapper_nav">
  <div id="mepr-account-nav">
    <span class="mepr-nav-item <?php MeprAccountHelper::active_nav('home'); ?>">
      <a href="<?php echo MeprHooks::apply_filters('mepr-account-nav-home-link',$account_url.$delim.'action=home'); ?>" id="mepr-account-home"><?php echo MeprHooks::apply_filters('mepr-account-nav-home-label',_x('Home', 'ui', 'buddyboss-theme')); ?></a>
    </span>
    <span class="mepr-nav-item <?php MeprAccountHelper::active_nav('subscriptions'); ?>">
      <a href="<?php echo MeprHooks::apply_filters('mepr-account-nav-subscriptions-link',$account_url.$delim.'action=subscriptions'); ?>" id="mepr-account-subscriptions"><?php echo MeprHooks::apply_filters('mepr-account-nav-subscriptions-label',_x('Subscriptions', 'ui', 'buddyboss-theme')); ?></a></span>
    <span class="mepr-nav-item <?php MeprAccountHelper::active_nav('payments'); ?>">
      <a href="<?php echo MeprHooks::apply_filters('mepr-account-nav-payments-link',$account_url.$delim.'action=payments'); ?>" id="mepr-account-payments"><?php echo MeprHooks::apply_filters('mepr-account-nav-payments-label',_x('Payments', 'ui', 'buddyboss-theme')); ?></a>
    </span>
    <?php MeprHooks::do_action('mepr_account_nav', $mepr_current_user); ?>
    <span class="mepr-nav-item"><a href="<?php echo MeprUtils::logout_url(); ?>" id="mepr-account-logout"><?php _ex('Logout', 'ui', 'buddyboss-theme'); ?></a></span>
  </div>
</div>

<?php
if(isset($expired_subs) and !empty($expired_subs)) {
  $account_url = MeprUtils::get_permalink(); // $mepr_options->account_page_url();
  $sub_label = MeprHooks::apply_filters('mepr-account-nav-subscriptions-label',_x('Subscriptions', 'ui', 'buddyboss-theme'));
  $delim = preg_match('#\?#',$account_url) ? '&' : '?';
  $errors = array(sprintf(_x('You have a problem with one or more of your %1$s. To prevent any lapses in your %1$s please visit your %2$s%3$s%4$s page to update them.', 'ui', 'buddyboss-theme'),strtolower($sub_label),'<a href="'.$account_url.$delim.'action=subscriptions">',$sub_label,'</a>'));
  MeprView::render('/shared/errors', get_defined_vars());
}
