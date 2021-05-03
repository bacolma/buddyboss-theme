<?php

function buddyboss_is_login_page() {
	return in_array( $GLOBALS[ 'pagenow' ], array( 'wp-login.php', 'wp-register.php' ) );
}

$rx_custom_login = buddyboss_theme_get_option( 'boss_custom_login' );
if ( $rx_custom_login ) {
    add_action( 'login_enqueue_scripts', 'buddyboss_login_enqueue_scripts' );
}

function buddyboss_login_enqueue_scripts() {
    $rtl_css = is_rtl() ? '-rtl' : '';
    $minified_css = buddyboss_theme_get_option( 'boss_minified_css' );
    $mincss = $minified_css ? '.min' : '';

	$enable_private_network = '1'; // Default NO i.e. 1

	// Check if Platform plugin is active.
	if( function_exists( 'bp_get_option' ) ){
		$enable_private_network = bp_get_option( 'bp-enable-private-network' );
	}

    wp_enqueue_style( 'buddyboss-theme-login', get_template_directory_uri() . '/assets/css' . $rtl_css . '/login' . $mincss . '.css', '', buddyboss_theme()->version() );

    wp_enqueue_style( 'buddyboss-theme-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', '', buddyboss_theme()->version() );

    if ( '0' === $enable_private_network ) {
        wp_enqueue_style( 'buddyboss-theme-login-magnific-popup', get_template_directory_uri() . '/assets/css/vendors/magnific-popup.min.css', '', buddyboss_theme()->version() );
    }
    //wp_enqueue_script( 'buddyboss-theme-login-js', get_template_directory_uri() . '/assets/js/login.js', array( 'jquery' ), buddyboss_theme()->version(), true );
}

add_filter( 'login_redirect', 'buddyboss_redirect_previous_page', 10, 3 );

function buddyboss_redirect_previous_page( $redirect_to, $request, $user ) {
	if ( buddyboss_theme()->buddypress_helper()->is_active() ) {

		$bp_pages = false;

		// Check if Platform plugin is active.
		if( function_exists('bp_get_option') ){
			$bp_pages = bp_get_option( 'bp-pages' );
		}

		$activate_page_id = !empty( $bp_pages ) && isset( $bp_pages[ 'activate' ] ) ? $bp_pages[ 'activate' ] : null;

		if ( (int) $activate_page_id <= 0 ) {
			return $redirect_to;
		}

		$activate_page = get_post( $activate_page_id );

		if ( empty( $activate_page ) || empty( $activate_page->post_name ) ) {
			return $redirect_to;
		}

		$activate_page_slug = $activate_page->post_name;

		if ( strpos( $request, '/' . $activate_page_slug ) !== false ) {
			$redirect_to = home_url();
		}
	}

	$request = isset( $_SERVER[ "HTTP_REFERER" ] ) && !empty( $_SERVER[ "HTTP_REFERER" ] ) ? $_SERVER[ "HTTP_REFERER" ] : false;

	if ( !$request ) {
		return $redirect_to;
	}

	// redirect for native mobile app
	if ( ! is_user_logged_in() && wp_is_mobile() ) {
		$path = wp_parse_url($request);

		if ( isset( $path['query'] ) && ! empty( $path['query'] ) ) {
			parse_str($path['query'], $output);

			return $output['redirect_to'];
		}
    }

	$req_parts	      = explode( '/', $request );
	$req_part	      = array_pop( $req_parts );
    $url_arr          = [];
	$url_query_string = [];
	if ( substr( $req_part, 0, 3 ) == 'wp-' ) {
	    $url_query_string = parse_url( $request );
		parse_str( $url_query_string['query'], $url_arr );
		$redirect_to = ( isset( $url_arr ) && isset( $url_arr['redirect_to'] ) && '' !== $url_arr['redirect_to'] ) ? $url_arr['redirect_to'] : $redirect_to;
		return $redirect_to;
	}

	$request = str_replace( array( '?loggedout=true', '&loggedout=true' ), '', $request );

	return $request;
}

/**
 * Register page - change register message text
 */
function change_register_message( $message ) {
	$confirm_admin_email_page = FALSE;
	if ( $GLOBALS['pagenow'] === 'wp-login.php' && ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] === 'confirm_admin_email' ) {
		$confirm_admin_email_page = TRUE;
	}

    if( strpos($message, 'Register For This Site') !== FALSE && $confirm_admin_email_page === FALSE ) {
        $newMessage = __("Create an account", 'buddyboss-theme');
        $login_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_login_url() ), __( 'Log in', 'buddyboss-theme' ) );
        return '<div class="login-heading"><p class="message register bs-register-message">' . $newMessage . '</p><span>'. $login_url .'</span></div>';
    } else {
        return $message;
    }
}

add_action( 'login_message', 'change_register_message' );

/**
 * Login page - login scripts
 */
function buddyboss_login_scripts() {
	$rx_logoimg = buddyboss_theme_get_option( 'admin_logo_media' );
	$rx_title   = get_bloginfo();
    ?>
	<script>
		jQuery( document ).ready( function () {
			jQuery( '#loginform label[for="user_login"]' ).attr( 'id', 'user_label' );
			jQuery( '#loginform label[for="user_pass"]' ).attr( 'id', 'pass_label' );
			jQuery( '#registerform label[for="user_login"]' ).attr( 'id', 'user_label_register' );
			jQuery( '#registerform label[for="user_email"]' ).attr( 'id', 'email_label_register' );
			jQuery( '#lostpasswordform label[for="user_login"]' ).attr( 'id', 'user_label_lost' );

			var $label_user_login = jQuery( 'label#user_label' );
			$label_user_login.html( $label_user_login.find( 'input' ) );

			var $label_user_pass = jQuery( 'label#pass_label' );
			$label_user_pass.html( $label_user_pass.find( 'input' ) );

			var $label_user_register = jQuery( 'label#user_label_register' );
			$label_user_register.html( $label_user_register.find( 'input' ) );

			var $label_email_register = jQuery( 'label#email_label_register' );
			$label_email_register.html( $label_email_register.find( 'input' ) );

			var $label_user_lost = jQuery( 'label#user_label_lost' );
			$label_user_lost.html( $label_user_lost.find( 'input' ) );


			jQuery( '#loginform #user_login' ).attr( 'placeholder', '<?php _e( 'Email Address', 'buddyboss-theme' ); ?>' );
			jQuery( '#loginform #user_pass' ).attr( 'placeholder', '<?php _e( 'Password', 'buddyboss-theme' ); ?>' );
			jQuery( '#registerform #user_login' ).attr( 'placeholder', '<?php _e( 'Username', 'buddyboss-theme' ); ?>' );
			jQuery( '#registerform #user_email' ).attr( 'placeholder', '<?php _e( 'Email', 'buddyboss-theme' ); ?>' );
			jQuery( '#lostpasswordform #user_login' ).attr( 'placeholder', '<?php _e( 'Email Address', 'buddyboss-theme' ); ?>' );
            jQuery( '#resetpassform #pass1' ).attr( 'placeholder', '<?php echo apply_filters( THEME_HOOK_PREFIX . 'password_field_text_placeholder', __( 'Add new password', 'buddyboss-theme' ) ); ?>' );
            jQuery( '#resetpassform #bs-pass2' ).attr( 'placeholder', '<?php echo apply_filters( THEME_HOOK_PREFIX . 're_type_password_field_text_placeholder', __( 'Retype new password', 'buddyboss-theme' ) ); ?>' );

            jQuery( '.login.bb-login p.message.reset-pass' ).text( "<?php _e( 'Reset Password', 'buddyboss-theme' ); ?>" );
            jQuery( '.login.login-action-lostpassword.bb-login #login > p.message' ).html( '<?php _e( '<div>Forgot your password?</div><p class="message">Enter your email address. You will receive a link to create a new password via email.</p>', 'buddyboss-theme' ); ?>' );

            jQuery( '.login.login-action-lostpassword.bb-login #lostpasswordform input#wp-submit' ).attr( 'value', '<?php _e( 'Request resend link', 'buddyboss-theme' ); ?>' );
            jQuery( '.login.login-action-rp.bb-login #resetpassform input#wp-submit' ).attr( 'value', '<?php _e( 'Save', 'buddyboss-theme' ); ?>' );
            if(!jQuery('#resetpassform').length) {
                jQuery( '.login.login-action-resetpass.bb-login p#backtoblog' ).prepend( "<span class='bs-pass-update-msg'><?php _e( 'Password has been updated', 'buddyboss-theme' ); ?></span>" );
            }

            var $signIn = jQuery( '.login.login-action-lostpassword.bb-login #login > p#nav > a' ).first().addClass('bs-sign-in').text('<?php _e( 'Back to sign in', 'buddyboss-theme' ); ?>');
            jQuery( 'form#lostpasswordform' ).append( $signIn );

			jQuery( '.login #loginform label#pass_label' ).append( "<span class='label-switch'></span>" );

            var $forgetMeNot = jQuery( '.login.bb-login p.forgetmenot' );
            var $lostMeNot = jQuery( '.login.bb-login p.lostmenot' );
            jQuery( $lostMeNot ).before( $forgetMeNot );

			jQuery( document ).on( 'click', '.login .label-switch', function ( e ) {
				var $this = jQuery( this );
				var $input = $this.closest( 'label' ).find( 'input#user_pass' );
				$this.toggleClass( "bb-eye" );
				if ( $this.hasClass( 'bb-eye' ) ) {
					$input.attr( "type", "text" );
				} else {
					$input.attr( "type", "password" );
				}
			} );

            var signinCheckboxes = function() {
                // Checkbox Styling
                jQuery('input[type=checkbox]#rememberme').each(function() {
                    var $this = jQuery(this);
                    $this.addClass('checkbox');
                    jQuery('<span class="checkbox"></span>').insertAfter($this);
                    if ($this.is(':checked')) {
                        $this.next('span.checkbox').addClass('on');
                    };
                    $this.fadeTo(0,0);
                    $this.change(function(){
                        $this.next('span.checkbox').toggleClass('on');
                    });
                });
            };
            signinCheckboxes();

            var loginLogoImage = function() {
                jQuery('.login.bb-login #login > h1 > a').each(function() {
                    var $this = jQuery(this);
                    var bg = $this.css('background-image');
                    bgLogo = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
                    <?php
                    if ( function_exists('buddypress') && isset(buddypress()->buddyboss )) {
                        $enable_private_network = bp_get_option( 'bp-enable-private-network' );
                        if ( '0' === $enable_private_network ) {
                            ?>
                            $this.append( '<img class="bs-cs-login-logo private-on" src="' + bgLogo + '" />' );
                            jQuery('#login h1 a img').unwrap();
                            <?php
                        } else {
                            ?>$this.append( '<img class="bs-cs-login-logo" src="' + bgLogo + '" />' ); <?php
                        }
                    } else {
                        ?>$this.append( '<img class="bs-cs-login-logo" src="' + bgLogo + '" />' ); <?php
                    }
                    ?>
                });
            };

            var loginLogoTitle = function() {
                jQuery('.login.bb-login #login > h1 > a').each(function() {
                    var $this = jQuery(this);
	                <?php
	                if ( function_exists('buddypress') && isset(buddypress()->buddyboss )) {
                        $enable_private_network = bp_get_option( 'bp-enable-private-network' );
                        if ( '0' === $enable_private_network ) {
                            ?>
                            $this.addClass('bb-login-title').append( '<span class="bs-cs-login-title private-on"><?php echo $rx_title; ?></span>' );
                            jQuery('#login h1 a span').unwrap();
                            <?php
                        } else {
                            ?>$this.addClass('bb-login-title').append( '<span class="bs-cs-login-title"><?php echo $rx_title; ?></span>' );<?php
                        }
	                } else {
	                    ?>$this.addClass('bb-login-title').append( '<span class="bs-cs-login-title"><?php echo $rx_title; ?></span>' );<?php
	                }
	                ?>

                });
            };
            <?php if ( !empty( $rx_logoimg['url'] ) ) { ?>
                loginLogoImage();
            <?php } else { ?>
                loginLogoTitle();
            <?php } ?>

            var loginHeight = function() {

                jQuery( 'body.login.login-split-page #login' ).each(function() {
                    var $loginH = jQuery( 'body.login.login-split-page #login' ).height();
                    var $winH = jQuery( window ).height();

                    if ( $loginH > $winH ) {
                        jQuery( 'body.login.login-split-page' ).addClass('login-exh');
                    } else {
                        jQuery( 'body.login.login-split-page' ).removeClass('login-exh');
                    }
                });
            };
            loginHeight();
            jQuery( window ).on( 'resize', function () {
                loginHeight();
            } );

		} )
	</script>
	<?php
}


/**
 * Custom Login Link
 *
 * @since Boss 1.0.0
 */
function change_wp_login_url() {

	if ( function_exists('buddypress') && isset(buddypress()->buddyboss )) {
		$enable_private_network = bp_get_option( 'bp-enable-private-network' );

		if ( '0' === $enable_private_network ) {
			return '#';
		}
    }
	return home_url();
}

function change_wp_login_title() {
	get_option( 'blogname' );
}

add_filter( 'login_headerurl', 'change_wp_login_url' );
add_filter( 'login_headertext', 'change_wp_login_title' );


/**
 * Login page - heading and register link
 */
if ( !function_exists( 'signin_login_message' ) ) {

	function signin_login_message( $message ) {
		$home_url = get_bloginfo( 'url' );
		$confirm_admin_email_page = FALSE;
		if ( $GLOBALS['pagenow'] === 'wp-login.php' && ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] === 'confirm_admin_email' ) {
			$confirm_admin_email_page = TRUE;
		}

		if ( buddyboss_theme_get_option( 'boss_custom_login' ) && $confirm_admin_email_page === FALSE ) {
			if ( empty( $message ) ) {
				if ( get_option( 'users_can_register' ) ) {
					$registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Create an Account', 'buddyboss-theme' ) );
					return sprintf(
						'<div class="login-heading"><h2>%s</h2><span>%s</span></div>',
						__('Sign in', 'buddyboss-theme'),
						apply_filters( 'register', $registration_url )
					);
				} else {
					return sprintf(
						'<div class="login-heading"><h2>%s</h2></div>',
						__('Sign in', 'buddyboss-theme')
					);
				}
			} else {
				return $message;
			}
		} else {
		    return $message;
        }
	}

	add_filter( 'login_message', 'signin_login_message' );
}


/**
 * Login page - custom classes
 */
if ( !function_exists( 'custom_login_classes' ) ) {

	add_filter( 'login_body_class', 'custom_login_classes' );

	function custom_login_classes( $classes ) {
        $rx_custom_login = buddyboss_theme_get_option( 'boss_custom_login' );

        $rx_admin_background = buddyboss_theme_get_option( 'admin_login_background_switch' );

		if ( $rx_custom_login ) {
			if ( ( $GLOBALS[ 'pagenow' ] === 'wp-login.php' ) && $rx_admin_background ) {
    			$classes[] = 'login-split-page bb-login';
    			return $classes;
    		} else {
    			$classes[] = 'bb-login';
    			return $classes;
    		}
		} else {
			$classes[] = '';
			return $classes;
		}
	}

}

/**
 * Login page - custom styling
 */
if ( !function_exists( 'login_custom_head' ) ) {

	function login_custom_head() {
        $rx_admin_login_background_switch = buddyboss_theme_get_option( 'admin_login_background_switch' );
        $rx_admin_login_heading_position = buddyboss_theme_get_option( 'admin_login_heading_position' );
        $rx_admin_login_background_text = buddyboss_theme_get_option( 'admin_login_background_text' );
        $rx_admin_login_background_textarea = buddyboss_theme_get_option( 'admin_login_background_textarea' );
        $rx_admin_login_heading_color = buddyboss_theme_get_option( 'admin_login_heading_color' );
        $rx_admin_login_overlay_opacity = buddyboss_theme_get_option( 'admin_login_overlay_opacity' );

		if ( $rx_admin_login_background_switch ) {
            if ( $rx_admin_login_heading_position ) {
                $heading_postion_style = 'padding-top: ' . $rx_admin_login_heading_position . '%;';
            } else {
                $heading_postion_style = 'padding-top: 8%;';
            }
			echo '<div class="login-split"><div style="' . $heading_postion_style . '">';
            if ( $rx_admin_login_background_text ) {
                echo wp_kses_post( sprintf( esc_html__( '%s', 'buddyboss-theme' ), $rx_admin_login_background_text ) );
            }
            if ( $rx_admin_login_background_textarea ) {
                echo '<span>';
                echo stripslashes($rx_admin_login_background_textarea);
                echo '</span>';
            }
            echo '</div><div class="split-overlay"></div></div>';
		}

        $rx_logoimg = buddyboss_theme_get_option( 'admin_logo_media' );
		$rx_logowidth = buddyboss_theme_get_option( 'admin_logo_width' );
        $rx_login_background_media = buddyboss_theme_get_option( 'admin_login_background_media' );

		$rx_admin_screen_background = buddyboss_theme_get_option( 'admin_screen_bgr_color' );
        $rx_admin_screen_txt = buddyboss_theme_get_option( 'admin_screen_txt_color' );
        $rx_admin_screen_links = buddyboss_theme_get_option( 'admin_screen_links_color' );
        $rx_admin_screen_links_hover = buddyboss_theme_get_option( 'admin_screen_links_hover_color' );

        $rx_body_txt_color = buddyboss_theme_get_option( 'body_text_color' );
        $rx_heading_color = buddyboss_theme_get_option( 'heading_text_color' );

		echo '<style>';
		if ( !empty( $rx_logoimg['url'] ) ) {
			?>
			.login h1 a {
			background-image: url(<?php echo $rx_logoimg['url']; ?>);
			background-size: contain;
			<?php
			if ( $rx_logowidth ) {
				echo "width:" . $rx_logowidth . "px;";
			}
			?>
			}
			<?php

			?>
            .login #login h1 img.bs-cs-login-logo.private-on {
			<?php
			if ( $rx_logowidth ) {
				echo "width:" . $rx_logowidth . "px;";
			}
			?>
            }
			<?php
		}
		if ( $rx_admin_login_background_switch && $rx_login_background_media ) {
			?>
			.login-split {
				background-image: url(<?php echo $rx_login_background_media['url']; ?>);
				background-size: cover;
				background-position: 50% 50%;
			}
			<?php
		}
		if ( $rx_admin_screen_background ) {
			?>
			body.login {
                background-color: <?php echo $rx_admin_screen_background; ?>;
			}
			<?php
		}
		if ( $rx_admin_screen_txt ) {
			?>
			body.login #login,
            body.login p.forgetmenot label {
                color: <?php echo $rx_admin_screen_txt; ?>;
			}
			<?php
		}
        if ( $rx_body_txt_color ) {
			?>
            body.login .login-popup.bb-modal {
    			color: <?php echo $rx_body_txt_color; ?>;
    		}
            <?php
		}
        if ( $rx_heading_color ) {
			?>
            body.login .login-popup.bb-modal h1 {
    			color: <?php echo $rx_heading_color; ?>;
    		}
            <?php
		}
		if ( $rx_admin_screen_links ) {
			?>
			body.login .login-heading a,
			.login a,
            .login h1 a.bb-login-title,
            .login form .lostmenot a,
            .login a.privacy-policy-link,
            form#lostpasswordform a.bs-sign-in {
                color: <?php echo $rx_admin_screen_links; ?>;
			}
			.login.wp-core-ui .button-primary {
                background-color: <?php echo $rx_admin_screen_links; ?>;
                border-color: <?php echo $rx_admin_screen_links; ?>;
			}
			.admin-email__actions .admin-email__actions-primary a.button {
                color: <?php echo $rx_admin_screen_links; ?>;
                border-color: <?php echo $rx_admin_screen_links; ?>;
			}
			<?php
		}
        if ( $rx_admin_screen_links_hover ) {
			?>
			body.login .login-heading a:hover,
			.login a:hover,
            .login h1 a.bb-login-title:hover,
            .login form .lostmenot a:hover,
            .login a.privacy-policy-link:hover,
            form#lostpasswordform a.bs-sign-in:hover {
                color: <?php echo $rx_admin_screen_links_hover; ?>;
			}
			.login.wp-core-ui .button-primary:hover {
                background-color: <?php echo $rx_admin_screen_links_hover; ?>;
                border-color: <?php echo $rx_admin_screen_links_hover; ?>;
			}
			.admin-email__actions .admin-email__actions-primary a.button:hover {
                color: <?php echo $rx_admin_screen_links_hover; ?>;
                border-color: <?php echo $rx_admin_screen_links_hover; ?>;
			}
			<?php
		}
        if ( $rx_admin_login_overlay_opacity ) {
			?>
            @media( min-width: 992px ) {
                body.login.login-split-page .login-split .split-overlay {
                    opacity: <?php echo $rx_admin_login_overlay_opacity / 100; ?>;
    			}
            }
			<?php
		}
        if ( $rx_admin_login_heading_color ) {
			?>
            @media( min-width: 992px ) {
                body.login.login-split-page .login-split div {
                    color: <?php echo $rx_admin_login_heading_color; ?>;
    			}
            }
			<?php
		}
		echo '</style>';
	}
}


/**
 * Login page - custom forget password link
 */
if ( !function_exists( 'login_custom_form' ) ) {

	add_action( 'login_form', 'login_custom_form' );

	function login_custom_form() {
        $rx_custom_login = buddyboss_theme_get_option( 'boss_custom_login' );

		if ( $rx_custom_login ) {
			?>
			<p class="lostmenot"><a href="<?php echo wp_lostpassword_url(); ?>"><?php _e('Forgot Password?', 'buddyboss-theme'); ?></a></p>
			<?php
		}
	}

}


function buddyboss_theme_login_load(){
    $rx_custom_login = buddyboss_theme_get_option( 'boss_custom_login' );

	if ( $rx_custom_login ) {
		add_action( 'login_head', 'buddyboss_login_scripts', 150 );
		add_action( 'login_head', 'login_custom_head', 150 );

		/**
		 * Confirm New Login Password
		 */
		add_action( 'resetpass_form', function( $user )
		{ ?> <div class="user-bs-pass2-wrap">
            <p><label for="bs-pass2"><?php _e( 'Retype new password', 'buddyboss-theme' ) ?></label></p>
            <input type="password" name="bs-pass2" id="bs-pass2" class="input"
                   size="20" value="" autocomplete="off" />
        </div> <?php
		} );

		add_action( 'validate_password_reset', function( $errors )
		{
			if ( isset( $_POST['pass1'] ) && $_POST['pass1'] != $_POST['bs-pass2'] )
				$errors->add( 'password_reset_mismatch', __( 'The passwords do not match.', 'buddyboss-theme' ) );
		} );

		add_action( 'login_enqueue_scripts', function ()
		{
			if ( ! wp_script_is( 'jquery', 'done' ) ) {
				wp_enqueue_script( 'jquery' );
			}
			wp_add_inline_script( 'jquery-migrate', 'jQuery(document).ready(function(){ jQuery( "#pass1" ).data( "reveal", 0 ); });' );
		}, 1 );

	}
}
add_action( 'init', 'buddyboss_theme_login_load' );
