<div class="container site-header-container flex default-header header-3">
    <a href="#" class="bb-toggle-panel"><i class="bb-icon-menu-left"></i></a>
    <?php 
    $menu = is_user_logged_in() ? 'buddypanel-loggedin' : 'buddypanel-loggedout';
    if ( ! has_nav_menu( $menu ) ) {
        get_template_part( 'template-parts/site-logo' );
    } ?>
	<?php 
    if ( buddyboss_is_learndash_inner() && !buddyboss_theme_ld_focus_mode() ) {
        get_template_part( 'template-parts/site-navigation' );
    } elseif ( !buddyboss_is_learndash_inner() ) {
        get_template_part( 'template-parts/site-navigation' );
    }
    ?>
	<?php get_template_part( 'template-parts/header-aside' ); ?>
</div>