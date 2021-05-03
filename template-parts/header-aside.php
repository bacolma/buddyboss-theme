<?php
$show_search = buddyboss_theme_get_option( 'header_search' );
$show_messages = buddyboss_theme_get_option( 'messages' ) && is_user_logged_in();
$show_notifications = buddyboss_theme_get_option( 'notifications' ) && is_user_logged_in();
$show_shopping_cart = buddyboss_theme_get_option( 'shopping_cart' );
?>

<div id="header-aside" class="header-aside">
	<div class="header-aside-inner">
		<?php if ( is_user_logged_in() ) : ?>
			<div class="user-wrap user-wrap-container menu-item-has-children">
				<?php
				$current_user = wp_get_current_user();
                $user_link    = function_exists( 'bp_core_get_user_domain' ) ? bp_core_get_user_domain( $current_user->ID ) : get_author_posts_url( $current_user->ID );
				$display_name =  function_exists( 'bp_core_get_user_displayname' ) ? bp_core_get_user_displayname( $current_user->ID ) : $current_user->display_name;
				?>

				<a class="user-link" href="<?php echo $user_link; ?>">
					<span class="user-name"><?php echo $display_name; ?></span><i class="bb-icon-angle-down"></i>
					<?php echo get_avatar( get_current_user_id(), 100 ); ?>
				</a>

				<div class="sub-menu">
					<div class="wrapper">
						<ul class="sub-menu-inner">
							<li>
								<a class="user-link" href="<?php echo $user_link; ?>">
									<?php echo get_avatar( get_current_user_id(), 100 ); ?>
									<span>
										<span class="user-name"><?php echo $display_name; ?></span>
										<?php if( function_exists( 'bp_is_active' ) ) : ?>
											<span class="user-mention"><?php echo '@' . bp_activity_get_user_mentionname( $current_user->ID ); ?></span>
										<?php else : ?>
											<span class="user-mention"><?php echo '@' . $current_user->user_login; ?></span>
										<?php endif; ?>
									</span>
								</a>
							</li>

							<?php do_action( THEME_HOOK_PREFIX . 'header_user_menu_items' ); ?>
						</ul>
					</div>
				</div>
			</div>


            <?php if ( class_exists( 'SFWD_LMS' ) && buddyboss_is_learndash_inner() ) : ?>
            
                <span class="bb-separator"></span>
                <a href="#" id="bb-toggle-theme">
                    <span class="sfwd-dark-mode" data-balloon-pos="down" data-balloon="<?php _e( 'Dark Mode', 'buddyboss-theme' ); ?>"><i class="bb-icon-moon-circle"></i></span>
                    <span class="sfwd-light-mode" data-balloon-pos="down" data-balloon="<?php _e( 'Light Mode', 'buddyboss-theme' ); ?>"><i class="bb-icon-sun"></i></span>
                </a>
                <a href="#" class="header-maximize-link course-toggle-view" data-balloon-pos="down" data-balloon="<?php _e( 'Maximize', 'buddyboss-theme' ); ?>"><i class="bb-icon-maximize"></i></a>
                <a href="#" class="header-minimize-link course-toggle-view" data-balloon-pos="down" data-balloon="<?php _e( 'Minimize', 'buddyboss-theme' ); ?>"><i class="bb-icon-minimize"></i></a>
                
            <?php else : ?>
            
                <?php if( $show_search || $show_messages || $show_notifications || $show_shopping_cart ) : ?>
    				<span class="bb-separator"></span>
    			<?php endif; ?>
    
    			<?php if( $show_search ) : ?>
    				<a href="#" class="header-search-link" data-balloon-pos="down" data-balloon="<?php _e( 'Search', 'buddyboss-theme' ); ?>"><i class="bb-icon-search"></i></a>
    			<?php endif; ?>
    
    			<?php if( $show_messages && function_exists( 'bp_is_active' ) && bp_is_active( 'messages' )  ) : ?>
    				<?php get_template_part( 'template-parts/messages-dropdown' ); ?>
    			<?php endif; ?>
    
    			<?php if( $show_notifications && function_exists( 'bp_is_active' ) && bp_is_active( 'notifications' ) ) : ?>
    				<?php get_template_part( 'template-parts/notification-dropdown' ); ?>
    			<?php endif; ?>

    			<?php if( $show_shopping_cart && class_exists( 'WooCommerce' ) ) : ?>
		            <?php get_template_part( 'template-parts/cart-dropdown' ); ?>
				<?php endif; ?>
                
            <?php endif; ?>

		<?php else : ?>

			<?php if( $show_search ) : ?>
				<a href="#" class="header-search-link" data-balloon-pos="down" data-balloon="<?php _e( 'Search', 'buddyboss-theme' ); ?>"><i class="bb-icon-search"></i></a>
			<?php endif; ?>

			<?php if( $show_shopping_cart && class_exists( 'WooCommerce' ) ) : ?>
	            <?php get_template_part( 'template-parts/cart-dropdown' ); ?>
			<?php endif; ?>
			<span class="search-separator bb-separator"></span>
			<div class="bb-header-buttons">
				<a href="<?php echo wp_login_url(); ?>" class="button small outline signin-button link"><?php _e( 'Sign in', 'buddyboss-theme' ); ?></a>
				
				<?php if ( get_option( 'users_can_register' ) ) : ?>
					<a href="<?php echo wp_registration_url(); ?>" class="button small singup"><?php _e( 'Sign up', 'buddyboss-theme' ); ?></a>
				<?php endif; ?>
			</div>

		<?php endif; ?>

        <?php $header = buddyboss_theme_get_option( 'buddyboss_header' ); ?>
    
        <?php if ( $header == '3' || ( class_exists( 'SFWD_LMS' ) && buddyboss_is_learndash_inner() ) ) : ?>
            <?php echo buddypanel_position_right(); ?>
    	<?php endif; ?>
	</div>
</div>
<div class="HelpCrisis">
      <br><br><br><span class="button small singup" style="background-color:#D6234A;">Help in Crisis</span>
</div>

