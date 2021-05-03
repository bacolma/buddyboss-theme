<div class="container site-header-container flex header-2">
    <a href="#" class="bb-toggle-panel"><i class="bb-icon-menu-left"></i></a>
    <?php
    if ( buddyboss_is_learndash_inner() && !buddyboss_theme_ld_focus_mode() ) {
        get_template_part( 'template-parts/site-navigation' );
        get_template_part( 'template-parts/site-logo' );
    } elseif ( buddyboss_is_learndash_inner() && buddyboss_theme_ld_focus_mode() ) { ?>
        <nav id="site-navigation" class="main-navigation" data-menu-space="120"><div id="primary-navbar"></div></nav>
        <?php if ( buddyboss_is_learndash_brand_logo() ) { ?>
            <div class="site-branding ld-brand-logo"><img src="<?php echo esc_url(wp_get_attachment_url(buddyboss_is_learndash_brand_logo())); ?>" alt="<?php echo esc_attr(get_post_meta(buddyboss_is_learndash_brand_logo() , '_wp_attachment_image_alt', true)); ?>"></div>  
        <?php } else {
            get_template_part( 'template-parts/site-logo' );   
        }
    } elseif ( !buddyboss_is_learndash_inner() ) {
        get_template_part( 'template-parts/site-navigation' );
        get_template_part( 'template-parts/site-logo' );
    }
    ?>
	<?php get_template_part( 'template-parts/header-aside' ); ?>
</div>