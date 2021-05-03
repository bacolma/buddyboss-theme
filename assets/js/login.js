/* eslint-env jquery,document */

(function (jQuery) {

	'use strict';

	const $ = jQuery;

	class BossSocial {

		constructor() {
            
            //this.login_placeholder();
			//this.show_pass();

		}
        
        login_placeholder() {
            var $labelUserNameEmail = $('label[for=user_login]');
            var $labelUserPass = $('label[for=user_pass]');
            var $labelUserEmail = $('label[for=user_email]');
            var $labelUserName = $('#registerform label[for=user_login]');
            $labelUserNameEmail.html($labelUserNameEmail.find('input').attr("placeholder", "Email Address"));
            $labelUserPass.html($labelUserPass.find('input').attr("placeholder", "Password"));
            $labelUserEmail.html($labelUserEmail.find('input').attr("placeholder", "Email"));
            $labelUserName.html($labelUserName.find('input').attr("placeholder", "Username"));
        }

		show_pass() {
		  
            $('.login form label[for="user_pass"]').append("<span class='label-switch'></span>");

			$(document).on('click', '.login .label-switch', function (e) {
                var $this = $( this );
                var $input = $this.closest('label').find('input#user_pass');
                $this.toggleClass("bb-eye");
                if ( $this.hasClass('bb-eye') ) {
                    $input.attr("type", "text");
                } else {
                    $input.attr("type", "password");
                }
			});

		}

	}

	$(document).on('ready', () => {

		window.BossSocial = new BossSocial();

	});

})(jQuery);