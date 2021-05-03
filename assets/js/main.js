(function ($) {

	"use strict";

	window.BuddyBossTheme = {
		init: function () {
			this.add_Class();
			this.header_search();
			this.header_notifications();
			this.Menu();
			this.setCounters();
			this.inputStyles();
			this.sidePanel();
			this.bbMasonry();
			//this.bbSlider();
			this.stickySidebars();
			this.bbFitVideo();
			this.LoadMorePosts();
			this.jsSocial();
			this.beforeLogIn();
			this.bbRelatedSlider();
			this.BuddyPanel_Dropdown();
			this.fileUpload();
			this.commentsValidate();
			this.messageScroll();
      if ( $( '.ld-in-focus-mode' ).length <= 0  ) {
        this.ajax_comment();
      }
			this.favoriteToggle();
			this.photoCommentFocus();
			this.bpRegRequired();
			this.inputFileStyle();
			this.primaryNavBar();
			this.forumsTopic();
			this.heartbeat();
		},

		ajax_comment: function () {

			$(document).on("submit", "#commentform", function (e) {

				e.preventDefault();
				var form = $("#commentform");

				var do_comment = $.post(form.attr("action"), form.serialize());

				var ori_btn_val = $("#commentform").find("[type='submit']").val();
				$("#comment").prop("disabled", true);
				$("#commentform").find("[type='submit']").prop("disabled", true).val(bs_data.translation.comment_btn_loading);

				do_comment.success(function (data, status, request) {

					var body = $("<div></div>");
					body.append(data);
					var comments = body.find("#comments");

					var commentslists = comments.find("li");

					var new_comment_id = false;

					// catch the new comment id by comparing to old dom.
					commentslists.each(function (index) {
						var _this = $(commentslists[index]);
						if ($("#" + _this.attr("id")).length == 0) {
							new_comment_id = _this.attr("id");
						}
					});

					$("#comments").replaceWith(comments);

					var commentTop = $("#" + new_comment_id).offset().top;

					if ($('body').hasClass('sticky-header')) {
						commentTop = $("#" + new_comment_id).offset().top - $('#masthead').height();
					}

					if ($('body').hasClass('admin-bar')) {
						commentTop = commentTop - $('#wpadminbar').height();
					}

					// scroll to comment
					if (new_comment_id) {
						$("body, html").animate({
							scrollTop: commentTop
						}, 600);
					}
				});

				do_comment.fail(function (data) {
					var body = $("<div></div>");
					body.append(data.responseText);
					body.find("style,meta,title,a").remove();
					body = body.text(); //clean text
					if (typeof bb_vue_loader == 'object' &&
						typeof bb_vue_loader.common == 'object' &&
						typeof bb_vue_loader.common.showSnackbar != 'undefined') {
						bb_vue_loader.common.showSnackbar(body)
					} else {
						alert(body);
					}
				});

				do_comment.always(function () {
					;
					$("#comment").prop("disabled", false);
					$("#commentform").find("[type='submit']").prop("disabled", false).val(ori_btn_val);
				});

			});

		},

		add_Class: function () {

			// Page load class
			if (document.readyState === 'complete' || document.readyState === 'interactive') {
				document.getElementsByTagName('body')[0].className += ' bb-page-loaded';
			}

			function classToggle(e) {
				e.preventDefault();
				var elemPanelWrapper = document.querySelector('.bb-mobile-panel-wrapper');
				elemPanelWrapper.classList.toggle('closed');
			}

			var elemPanel = document.querySelector('.bb-left-panel-mobile');

			if (elemPanel) {
				elemPanel.addEventListener('click', classToggle);
			}

			$('.bb-close-panel').on('click', function (e) {
				e.preventDefault();
				$('.bb-mobile-panel-wrapper').addClass('closed');
			});

			$('.bp-template-notice.bp-sitewide-notice').insertAfter('#masthead');

                        // learndash single page issues
                        var ldContent = document.getElementById('learndash-page-content');
                        if( ldContent ) {
                            $('.bp-template-notice.bp-sitewide-notice').prependTo('#learndash-page-content');
                        }

                        if ( $('.btn-new-topic').attr('data-modal-id') === 'bbp-topic-form' ) {
                            $('body').addClass('forum');
                        }

                        if( $('.bb-sfwd-aside #masthead').hasClass('elementor-header') ) {
                            $('.bb-toggle-panel').prependTo('.ld-course-navigation');
                            $('.bb-elementor-header-items').prependTo('.learndash-content-body');
                        }

                        if( $('.bb-sfwd-aside #masthead').hasClass('beaver-header') ) {
                            $('.bb-toggle-panel').prependTo('.ld-course-navigation');
                            $('.bb-elementor-header-items').prependTo('.learndash-content-body');
                        }

                        if( $('.beaver-header > header').attr('data-sticky') === '1' ) {
                            $('body').addClass('beaver-sticky-header');
                        }

                        $(document).on('click','#members-list.item-list:not(.grid) li .has_hook_content .more-action-button', function(e) {
                            $(this).parents('li.item-entry').toggleClass('active').siblings('li').removeClass('active');
                            e.preventDefault();
			});
		},

		Menu: function () {
			var $width = 150;
			//$( '#primary-menu' ).BossSocialMenu( $width );
			$('#activity-sub-nav').BossSocialMenu(90);
			$('#object-nav:not(.vertical) > ul').BossSocialMenu(35);
			//$( '.widget_bp_groups_widget #alphabetical-groups' ).after( '<div class="bb-widget-dropdown"><a class="bb-toggle-dropdown"><i class="bb-icon-menu-dots-v"></i></a><div class="bb-dropdown"></div></div>' ).appendTo( '.bb-widget-dropdown .bb-dropdown' );
			$('.toggle-button').panelslider({bodyClass: 'ps-active', clickClose: true, onOpen: null});

			$(document).on('click', '.more-button', function (e) {
				e.preventDefault();
				$(this).toggleClass('active').next().toggleClass('active');
			});

			$(document).on('click', '.hideshow .sub-menu a', function (e) {
				//e.preventDefault();
				$('body').trigger('click');

				// add 'current' and 'selected' class
				var currentLI = $(this).parent();
				currentLI.parent('.sub-menu').find('li').removeClass('current selected');
				currentLI.addClass('current selected');
			});

			$(document).on('click', '.bb-share', function (e) {
				e.preventDefault();
			});

			$(document).click(function (e) {
				var container = $('.more-button, .sub-menu');
				if (!container.is(e.target) && container.has(e.target).length === 0) {
					$('.more-button').removeClass('active').next().removeClass('active');
				}
			});

			var headerHeight = $('#masthead').height();
			var headerHeightExt = headerHeight + 55;
			$('.site-content-grid > .bb-share-container').stick_in_parent({offset_top: headerHeightExt});

			var $document = $(document),
				$elementHeader = $('.sticky-header .site-header'),
				$elementPanel = $('.bb-sfwd-aside .buddypanel'),
				className = 'has-scrolled';

			$document.scroll(function () {
				$elementHeader.toggleClass(className, $document.scrollTop() >= 1);
				$elementPanel.toggleClass(className, $document.scrollTop() >= 5);
			});

			$(document).on('click', '.header-aside div.menu-item-has-children > a', function (e) {
				e.preventDefault();
				var current = $(this).closest('div.menu-item-has-children');
				current.siblings('.selected').removeClass('selected');
				current.toggleClass('selected');
			});

			$('body').mouseup(function (e) {
				var container = $('.header-aside div.menu-item-has-children *');
				if (!container.is(e.target)) {
					$('.header-aside div.menu-item-has-children').removeClass('selected');
				}
			});
		},

		inputStyles: function () {
            function generateInputsUI() {
            	if ( $('.gform_wrapper').length <= 0 && $('#payment').length <= 0 && $('#mepr-payment-methods-wrapper').length <= 0 && $('.mepr-payment-methods-wrapper').length <= 0 && $('.bookly-form').length <= 0 && $('#am-service-booking').length <= 0 && $('.quform-form').length <= 0 && $('body.elementor-page').length <= 0 && $('.fluentform').length <= 0 && $('.frm-fluent-form').length <= 0 ) { // do not implement to woocommerce and other payment methods - causing an issue
            		/**
            		* :not(#cliSettingsPopup .cli-user-preference-checkbox) - This is for GDPR Cookie Consent plugin Because of conflict with the theme
            		*/
            		
            		/**
					 * Add Condition .noicheck
					 * [fix-improve-code] For not apply iCheck checkbox (Review and refactory: for not laod by default)
            		*/
            		$('input:not(.bb-input-switch):not(.noicheck):not(.bpxcftr-tos-checkbox):not(.bb-custom-check):not(#delete-group-understand):not(.notification-check):not(#select-all-notifications):not(.wpProQuiz_questionInput):not(.bookly-payment):not(.ginput_container input):not(#cliSettingsPopup .cli-user-preference-checkbox)').iCheck({
                        labelHover: false,
                        cursor: true,
                        checkboxClass: 'icheckbox_minimal',
                        radioClass: 'iradio_minimal',
	                }).on('ifChanged', function (e) {
	                    $(e.currentTarget).trigger('change');
	                });

					if (
						typeof bp !== 'undefined' &&
						typeof bp.Nouveau !== 'undefined' &&
						typeof bp.Nouveau.toggleDisabledInput !== 'undefined'
					) {
						$('input[data-bp-disable-input]:not(.bb-input-switch):not(.bpxcftr-tos-checkbox):not(.bb-custom-check):not(#delete-group-understand):not(.notification-check):not(#select-all-notifications):not(.wpProQuiz_questionInput):not(.bookly-payment)').on('ifChanged',  bp.Nouveau.toggleDisabledInput );
					}
            	}
            }

            generateInputsUI();

            $( window ).on('load', function() {
                generateInputsUI();
            });

            /*Run on WC Vendor Dashboard Pages only*/
            if($('.wcv-pro-dashboard').length>0){
				$('input:not(.bb-input-switch):not(.bpxcftr-tos-checkbox):not(.bb-custom-check):not(#delete-group-understand):not(.notification-check):not(#select-all-notifications):not(.wpProQuiz_questionInput):not(.bookly-payment)').iCheck({
						labelHover: false,
						cursor: true,
						checkboxClass: 'icheckbox_minimal',
						radioClass: 'iradio_minimal',
					}).on('ifChanged', function (e) {
						$(e.currentTarget).trigger('change');
					}).on('ifClicked', function (e) {
						$(e.currentTarget).trigger('click');
					});
				$('.wcv-pro-dashboard #add-work-hours, div.wcv-grid .wcv_shipping_rates #wcv_shipping_rates_table tr .insert').on('click',function(){
					setTimeout(function(){
						$('.wcv-opening-hours-wrapper input, div.wcv-grid .wcv_shipping_rates #wcv_shipping_rates_table td.override input').iCheck({
							labelHover: false,
							cursor: true,
							checkboxClass: 'icheckbox_minimal',
							radioClass: 'iradio_minimal',
						}).on('ifChanged', function (e) {
							$(e.currentTarget).trigger('change');
						}).on('ifClicked', function (e) {
							$(e.currentTarget).trigger('click');
						});
					},10);
				});
            }

            $( document ).ajaxComplete(function( event, request, settings ) {
                // Generate markup for ajax loaded content.
                generateInputsUI();
            });

			$('.bps-radio input[type="radio"]').change(function () {
				var is_checked = $(this).is(':checked');
				if (is_checked) {
					$(this).closest('.iradio_minimal').addClass('checked');
				} else {
					$(this).closest('.iradio_minimal').removeClass('checked');
				}
			});

			$('.bs-bp-container-reg .field-visibility-settings input[type=radio]').iCheck('destroy');

			var submitButton = $('.mc4wp-form-fields input[type="submit"]');
			submitButton.attr('disabled', true);

			$('.mc4wp-form-fields input[type="email"]').keyup(function () {
				if ($(this).val().length != 0)
					submitButton.attr('disabled', false);
				else
					submitButton.attr('disabled', true);
			});

			function customRegRadio() {
				$('.bs-bp-container-reg .field-visibility-settings input[type=radio]').each(function () {
					var $this = $(this);
					$('<span class="bs-radio"></span>').insertAfter($this);
					$this.addClass('bs-radio');
					if ($this.is(':checked')) {
						$this.next('span.bs-radio').addClass('on');
						$this.closest('label').addClass('on');
					}

					$this.change(function () {
						$this.closest('div.radio').find('span.bs-radio').removeClass('on');
						$this.closest('div.radio').find('label').removeClass('on');
						$this.next('span.bs-radio').addClass('on');
						$this.closest('label').addClass('on');
					});
				});
			}

			customRegRadio();
		},

		header_search: function () {
			// Toggle Search
			$('.header-search-link').on('click', function (e) {
				e.preventDefault();
				$('body').toggleClass('search-visible');
				if ( ! navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					setTimeout(function () {
						$('body').find('.header-search-wrap .search-field-top').focus();
					}, 90);
				}
			});

			$('.header-search-wrap .search-field-top').focus(function () {
				if ( ! navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					var $input = this;
					setTimeout(function () {
						$input.selectionStart = $input.selectionEnd = 10000;
					}, 0);
				}
			});

			// Hide Search
			$('.close-search').on('click', function (e) {
				e.preventDefault();
				$('body').removeClass('search-visible');
				$('.header-search-wrap input.search-field-top').val('');
			});

			$(document).click(function (e) {
				var container = $('.header-search-wrap, .header-search-link');
				if (!container.is(e.target) && container.has(e.target).length === 0) {
					$('body').removeClass('search-visible');
				}
			});

			$(document).keyup(function (e) {

				if (e.keyCode === 27) {
					$('body').removeClass('search-visible');
				}
			});
		},

		header_notifications: function () {
			if ( $('#header-notifications-dropdown-elem').length ) {
				setTimeout( function() {
					$('#header-notifications-dropdown-elem ul.notification-list').html('<i class="bb-notification-loader"><i></i><i></i><i></i></i>');
					$.get(ajaxurl, { action: 'buddyboss_theme_get_header_notifications' }, function (response, status, e) {
						if ( response.success && typeof response.data !== 'undefined' && typeof response.data.contents !== 'undefined' && $('#header-notifications-dropdown-elem ul.notification-list').length ) {
							$('#header-notifications-dropdown-elem ul.notification-list').html(response.data.contents);
						}
					});
				}, 3000 );
			}
			if ( $('#header-messages-dropdown-elem').length ) {
				setTimeout( function() {
					$('#header-messages-dropdown-elem ul.notification-list').html('<i class="bb-notification-loader"><i></i><i></i><i></i></i>');
					$.get(ajaxurl, { action: 'buddyboss_theme_get_header_unread_messages' }, function (response, status, e) {
						if ( response.success && typeof response.data !== 'undefined' && typeof response.data.contents !== 'undefined' && $('#header-messages-dropdown-elem ul.notification-list').length ) {
							$('#header-messages-dropdown-elem ul.notification-list').html(response.data.contents);
						}
					});
				}, 3000 );
			}
		},

		sidePanel: function () {
			var toggle_buddypanel_ajax = null,
				status = '';

			$('.bb-toggle-panel').on('click', function (e) {
				e.preventDefault();

				$('body').addClass('buddypanel-transtioned');

				$('.buddypanel').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
					setTimeout(function () {
						$('body').removeClass('buddypanel-transtioned');
					}, 200);
				});

				if ($('body').hasClass('buddypanel-open')) {
					$('body').removeClass('buddypanel-open');
					status = 'closed';
				} else {
					$('body').addClass('buddypanel-open');
					status = 'open';
				}

				$('.bs-submenu-toggle').removeClass('bs-submenu-open');
				$('.sub-menu').removeClass('bb-open');

				if (toggle_buddypanel_ajax !== null) {
					toggle_buddypanel_ajax.abort();
				}

				var data = {
					'action': 'buddyboss_toggle_buddypanel',
					'buddypanelStatus': status
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				toggle_buddypanel_ajax = $.post(ajaxurl, data, function (response) {
				});
			});

			function sidePanelHeight() {
				if ($('body').hasClass('buddypanel-header')) {
					var bbPanelBranding = $('.buddypanel .site-branding').outerHeight();
					var bbPanelHead = $('.buddypanel .panel-head').outerHeight();
					$('.side-panel-inner').css('height', '100%').css('height', '-=' + (bbPanelBranding + bbPanelHead + 40) + 'px');
				}
			}

			sidePanelHeight();

			$(window).on('resize', function () {
				sidePanelHeight();
			});

			$('.bb-toggle-panel').on('click', function (e) {
				e.preventDefault();
				sidePanelHeight();

				setTimeout(function () {
					sidePanelHeight();
				}, 300);
				setTimeout(function () {
					sidePanelHeight();
				}, 600);
			});

			$('.side-panel-inner').mousewheel(function (event) {
				event.preventDefault();
				var scrollTop = this.scrollTop;
				this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));

				$('#buddypanel-menu').addClass('side-panel-scroll');
				$('#buddypanel-menu li a').css('margin-top', '-' + this.scrollTop + 'px');
				$('#buddypanel-menu li a:after', '#buddypanel-menu li a:before').css('display', 'none');

				clearTimeout($.data(this, 'scrollTimer'));
				$.data(this, 'scrollTimer', setTimeout(function () {
					$('#buddypanel-menu').removeClass('side-panel-scroll');
				}, 250));
			});

                        // Add class wrapper if absent
                        $('.sub-menu-inner > li').each(function(){
                            if( $(this).find('.ab-sub-wrapper').length !== 0) {
                                $(this).addClass('parent');
                                $(this).find('.ab-sub-wrapper').addClass('wrapper');
                            }
                        });

                        // whenever we hover over a menu item that has a submenu
                        $('.user-wrap li.parent, .user-wrap .menu-item-has-children').on('mouseover', function() {
                            var $menuItem = $(this),
                                $submenuWrapper = $('> .wrapper', $menuItem);

                            // grab the menu item's position relative to its positioned parent
                            var menuItemPos = $menuItem.position();

                            // place the submenu in the correct position relevant to the menu item
                            $submenuWrapper.css({
                                top: menuItemPos.top
                            });
                        });
		},

		favoriteToggle: function () {
			$(document).on('click', '.favorite-toggle', function (e) {
				e.preventDefault();

				if ($('#favorite-toggle').find('.is-favorite').length !== 0) {
					var tooltip = $('.bb-favorite-wrap').attr('data-fav');
				} else {
					tooltip = $('.bb-favorite-wrap').attr('data-unfav');
				}

				$('.bb-favorite-status').toggleClass('favorited unfavorited');
				$('.bb-favorite-wrap').attr('data-balloon', tooltip);
			});

			jQuery(document).on('click', 'a.bs-dropdown-link.bb-reply-actions-button', function (e) {
				e.preventDefault();
				$('.bb-reply-actions-dropdown').removeClass('open');
				$('a.bs-dropdown-link.bb-reply-actions-button').removeClass('active');

				jQuery(this).toggleClass('active');
				jQuery(this).next('.bb-reply-actions-dropdown').toggleClass('open');
			});

			$(document).click(function (e) {
				var container = $('.bb-reply-actions-dropdown, a.bs-dropdown-link.bb-reply-actions-button');
				if (!container.is(e.target) && container.has(e.target).length === 0) {
					$('.bb-reply-actions-dropdown').removeClass('open');
					$('a.bs-dropdown-link.bb-reply-actions-button').removeClass('active');
				}
			});

			$(document).on('click', '.bb-reply-actions-dropdown .bbp-reply-to-link', function (e) {
				$('.bb-reply-actions-dropdown').removeClass('open');
				$('a.bs-dropdown-link.bb-reply-actions-button').removeClass('active');
			});
		},

		bbMasonry: function () {
			$('.bb-masonry').css("visibility", "visible").masonry({
				itemSelector: '.bb-masonry .hentry',
				columnWidth: '.bb-masonry-sizer',
			});
		},

		bbSlider: function () {
			//bs_gallery_slider();
		},

		stickySidebars: function () {
			var bbHeaderHeight = $('#masthead').outerHeight(),
                            offsetTop = 30;

                        if( $('body').hasClass('sticky-header') && $('body').hasClass('admin-bar') ) {
                            offsetTop = bbHeaderHeight + 62;
                        } else if( $('body').hasClass('sticky-header') ) {
                            offsetTop = bbHeaderHeight + 30;
                        } else if( $('body').hasClass('admin-bar') ) {
                            offsetTop = 62;
                        }

			$('.bb-sticky-sidebar').stick_in_parent({offset_top: offsetTop});

			if ($('#header-cover-image.width-full').length > 0) {
				$(window).scrollTop(120);
			}
		},

		bbFitVideo: function () {
			var doFitVids = function () {
				setTimeout(function () {
					$('iframe[src*="youtube"], iframe[src*="vimeo"]').parent().fitVids();
				}, 300);
			};
			doFitVids();
			$(document).ajaxComplete(doFitVids);

			var doFitVidsOnLazyLoad = function(event,data) {
				if ( typeof data !== 'undefined' && typeof data.element !== 'undefined' ) {
					//load iframe in correct dimension
					if(data.element.getAttribute('data-lazy-type') == 'iframe'){
						doFitVids();
					}
				}
			};
			$(document).on('bp_nouveau_lazy_load',doFitVidsOnLazyLoad);
		},

		LoadMorePosts: function () {
			$(document).on('click', '.button-load-more-posts', function (event) {
				event.preventDefault();

				var self = $(this),
					href = self.attr('href'),
					container = $('.post-grid');

				self.addClass('loading');

				$.get(href, function (response) {
					$('.pagination-below').remove(); // remove old pagination.

					$(response).find('article.status-publish').each(function (i, e) {

						var elem = $(e);

						if (container.hasClass('bb-masonry')) {
							container.append(elem).masonry('appended', elem).masonry();
						} else {
							container.append(elem);
						}

					});

					$('.post-grid').after($(response).find('.pagination-below'));

					if ($('.post-grid').hasClass('bb-masonry')) {
						$('.bb-masonry').masonry({});
					}

					//scripts to execute?
					var $script_tags = $(response).filter('script.bb_bookmarks_bootstrap');
					if ($script_tags.length > 0) {
						$script_tags.each(function () {
							$('body').append($(this));
						});
					}

//					setTimeout(function () {
//						bs_gallery_slider();
//					}, 600);

				});
			});

			$(document).on('scroll', function () {
				var load_more_posts = $('.post-infinite-scroll');
				if (load_more_posts.length) {
					var pos = load_more_posts.offset();
					if ($(window).scrollTop() + $(window).height() > pos.top) {
						if (!load_more_posts.hasClass('loading')) {
							load_more_posts.trigger('click');
						}
					}
				}
			});
		},

		/**
		 * Generates the sample for loader purpose for post grids.
		 */
		postGridLoader: function () {

			var loading = $('article.type-post').not(".first").first().clone();

			// remove not needed elements.
			loading.removeClass("format-quote");
			loading.find(".entry-meta").remove();
			loading.find(".mejs-offscreen").remove();
			loading.find(".mejs-container").remove();
			loading.find("img").remove();
			loading.find(".post-format-icon").remove();
			loading.find(".post-main-link").remove();
			loading.find(".bb-gallery-slider").replaceWith('<a href="" class="entry-media entry-img"></a>');

			if (!loading.find(".entry-img").length) {
				loading.prepend('<a href="" class="entry-media entry-img"></a>');
			}

			// Append Dummy Data,

			var spaces = '';
			for (var i = 0; i <= 60; i++)
				spaces += '&nbsp; ';

			loading.find('.entry-content').html("<span>" + spaces + "</span>");

			spaces = '';
			for (var i = 0; i <= 20; i++)
				spaces += '&nbsp; ';

			loading.find('.entry-title > a').html(spaces);

			// add loading class

			loading.addClass("loading");


			return loading;

		},

		jsSocial: function () {
			$('.bb-shareIcons').jsSocials({
				showLabel: true,
				showCount: false,
				shares: [
					{share: "facebook", label: "Share on Facebook"},
					{share: "twitter", label: "Tweet"},
				]
			});

			$('.jssocials-share-link').each(function () {
				$(this).attr('data-balloon-pos', 'right');
				$(this).attr('data-balloon', $(this).find('.jssocials-share-label').html());
			});

			$('.post-related-posts').find('a[data-balloon-pos]').attr('data-balloon-pos', 'left');
		},

		beforeLogIn: function () {
			var $loginUserName = '#bp-login-widget-user-login';
			var $loginUserPass = '#bp-login-widget-user-pass';
			var $loginUserBtn = $('#bp-login-widget-submit');

			function checkLogIn() {
				var empty = false;
				$($loginUserName + ',' + $loginUserPass).each(function () {
					if ($(this).val() == '') {
						empty = true;
					}
				});

				if (empty) {
					$loginUserBtn.removeClass('bp-login-btn-active');
				} else {
					$loginUserBtn.addClass('bp-login-btn-active');
				}
			}

			checkLogIn();

			$($loginUserName + ', ' + $loginUserPass).keyup(function () {
				checkLogIn();
			});

			setTimeout(function () {
				$('#bp-login-widget-user-pass').each(function (i, element) {
					var el = $(this);

					if (el.is("*:-webkit-autofill")) {
						$loginUserBtn.addClass('bp-login-btn-active');
					}
				});
			}, 200);

			var $bbpLoginUserName = '.bbp-login-form #user_login';
			var $bbpLoginUserPass = '.bbp-login-form #user_pass';
			var $bbpLoginUserBtn = $('.bbp-login-form #user-submit');

			function checkbbpLogIn() {
				var empty = false;
				$($bbpLoginUserName + ',' + $bbpLoginUserPass).each(function () {
					if ($(this).val() == '') {
						empty = true;
					}
				});

				if (empty) {
					$bbpLoginUserBtn.removeClass('bp-login-btn-active');
				} else {
					$bbpLoginUserBtn.addClass('bp-login-btn-active');
				}
			}

			checkbbpLogIn();

			$($bbpLoginUserName + ', ' + $bbpLoginUserPass).keyup(function () {
				checkbbpLogIn();
			});

			$('form.bbp-login-form label[for="user_pass"]').append("<span class='label-switch'></span>");

			$(document).on('click', 'form.bbp-login-form .label-switch', function (e) {
				var $this = $(this);
				var $input = $this.closest('.bbp-password').find('input#user_pass');
				$this.toggleClass("bb-eye");
				if ($this.hasClass('bb-eye')) {
					$input.attr("type", "text");
				} else {
					$input.attr("type", "password");
				}
			});

			$('form#bp-login-widget-form label[for="bp-login-widget-user-pass"]').append("<span class='label-switch'></span>");

			$(document).on('click', 'form#bp-login-widget-form .label-switch', function (e) {
				var $this = $(this);
				var $input = $this.closest('form').find('input#bp-login-widget-user-pass');
				$this.toggleClass("bb-eye");
				if ($this.hasClass('bb-eye')) {
					$input.attr("type", "text");
				} else {
					$input.attr("type", "password");
				}
			});
		},

		bbRelatedSlider: function () {
			if ($('body').hasClass('has-sidebar')) {
				var $break = 900;
			} else {
				var $break = 544;
			}

			function runSlickRelated() {
				var slickRelated = {
					infinite: false,
					slidesToShow: 2,
					slidesToScroll: 2,
					adaptiveHeight: true,
					arrows: true,
					prevArrow: '<a class="bb-slide-prev"><i class="bb-icon-angle-right"></i></a>',
					nextArrow: '<a class="bb-slide-next"><i class="bb-icon-angle-right"></i></a>',
					appendArrows: '.post-related-posts h4',
					responsive: [
						{
							breakpoint: $break,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1,
							}
						}
					]
				}

				$('.post-related-posts .post-grid').not('.slick-initialized').slick(slickRelated);
			}

			function slickGalleryReinit() {
				$('.post-related-posts .slick-slider').slick('reinit');
				/*$( '.slick-slider' ).on( 'reInit', function ( event, slick ) {
				 $( '.slick-slider' ).slick( 'slickSetOption', { arrows: false, dots: false } );
				 } );*/
				$('.post-related-posts .slick-slider').slick('resize');
				$('.post-related-posts .slick-slider').slick('refresh');
			}

			runSlickRelated();

			//slickGalleryReinit();

			$(window).on('resize', function () {
				runSlickRelated();
				slickGalleryReinit();
			});

			$('.bb-more-courses-list').slick({
				infinite: true,
				slidesToShow: 4,
				slidesToScroll: 1,
				prevArrow: '<a class="bb-slide-prev"><i class="bb-icon-angle-right"></i></a>',
				nextArrow: '<a class="bb-slide-next"><i class="bb-icon-angle-right"></i></a>',
				responsive: [
					{
						breakpoint: 1180,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
						}
					},
					{
						breakpoint: 900,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}]
			});
		},

		BuddyPanel_Dropdown: function () {
			$('.buddypanel-menu .sub-menu').each(function () {
				$(this).closest('li.menu-item-has-children').find('a:first').append('<i class="bb-icon-angle-down bs-submenu-toggle"></i>');
			});

			$(document).on('click', '.bs-submenu-toggle', function (e) {
				e.preventDefault();
				$(this).toggleClass('bs-submenu-open').closest('a').next('.sub-menu').toggleClass('bb-open');
				$(this).parent('.menu-item-has-children').toggleClass('bb-open-parent');
			});
			/**
			 * when we select sub menu it will be expand sub menu when page load
			 */

			$( 'aside.buddypanel .buddypanel-menu .current-menu-parent' ).find('ul.sub-menu').addClass('bb-open');
		},

		fileUpload: function () {
			$('.job-manager-form fieldset input[type=file], .ginput_container_fileupload > input[type=file], .ginput_container_post_image input[type=file]').each(function () {
				var $fileInput = $(this);
				var $fileInputFor = $fileInput.attr('id');
				$fileInput.after('<label for="' + $fileInputFor + '">Choose a file</label>');
			});

			$('.job-manager-form fieldset input[type=file], .ginput_container_fileupload > input[type=file], .ginput_container_post_image input[type=file]').change(function (e) {
				var $in = $(this);
				var $inval = $in.next().html($in.val());
				if ($in.val().length === 0) {
					$in.next().html('Choose a file');
				} else {
					$in.next().html($in.val().replace(/C:\\fakepath\\/i, ''));
				}
			});
		},

		commentsValidate: function () {
			function resetForm() {
				$('#commentform').reset();
				validator.resetForm();
			}

			function validateForm() {
				if (validator.form()) {
					$('#commentform').submit();
				}
			}

			var validator = $("#commentform").validate({
				rules: {
					author: {
						required: true,
						normalizer: function (value) {
							return $.trim(value);
						}
					},
					email: {
						required: true,
						email: true
					},
					url: {
						url: true
					},
					comment: {
						required: true,
						normalizer: function (value) {
							return $.trim(value);
						}
					}

				},
				messages: {
					author: "Please enter your name",
					email: {
						required: "Please enter an email address",
						email: "Please enter a valid email address"
					},
					url: "Please enter a valid URL e.g. http://www.mysite.com",
					comment: "Please fill the required field"
				},
				errorElement: "div",
				errorPlacement: function (error, element) {
					element.after(error);
				}
			});

			$('#comment').focus(function () {
				$(this).parents('#respond').addClass('bb-active');
			});

			$('#comment').blur(function () {
				$(this).parents('#respond').removeClass('bb-active');
			});
		},

		messageScroll: function () {

		},

		photoCommentFocus: function () {
			$(document).on('click', '.bb-media-model-wrapper .bs-comment-textarea', function (e) {
				e.preventDefault();

				$('.bb-media-model-wrapper').animate({
					scrollTop: $('.bb-media-model-wrapper')[0].scrollHeight
				}, "slow");
			});
		},

		bpRegRequired: function () {
			$('.bs-bp-container-reg .signup-form input').removeAttr('required');
		},

		setCounters: function () {
			$('.user-wrap > .sub-menu').find('li').each(function () {
				var $this = $(this),
					$count = $this.children('a').children('.count'),
					id,
					$target;

				if ($count.length != 0) {
					id = $this.attr('id');
					$target = $('.side-panel-menu .bp-menu.bp-' + id.replace(/wp-admin-bar-my-account-/, '') + '-nav');
					if ($target.find('.count').length == 0) {
						$target.find('a').append('<span class="count">' + $count.html() + '</span>');
					}
				}
			});
		},

		inputFileStyle: function () {
			var inputs = document.querySelectorAll('.bb-inputfile');
			Array.prototype.forEach.call(inputs, function (input) {
				var label = input.nextElementSibling,
					labelVal = label.innerHTML;

				input.addEventListener('change', function (e) {
					var fileName = '';
					if (this.files && this.files.length > 1)
						fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
					else
						fileName = e.target.value.split('\\').pop();

					if (fileName)
						label.querySelector('span').innerHTML = fileName;
					else
						label.innerHTML = labelVal;
				});
			});
		},

		primaryNavBar: function () {
			/*
			* Allow use of Array.from in implementations that don't natively support it
			function conNavArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }
			*/

			function conNavArray(arr) {
				if (Array.isArray(arr)) {
					for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
						arr2[i] = arr[i];
					}
					return arr2;
				} else {
					return [].slice.call(arr);
				}
			}

			var primaryWrap = document.getElementById('primary-navbar'),
				primaryNav = document.getElementById('primary-menu'),
				extendNav = document.getElementById('navbar-extend'),
				navCollapse = document.getElementById('navbar-collapse');

			function navListOrder() {
				var eChildren = extendNav.children;
				var numW = 0;

				[].concat(conNavArray(eChildren)).forEach(function (item) {
					item.outHTML = '';
					primaryNav.appendChild(item);
				});

				var primaryWrapWidth = primaryWrap.offsetWidth,
					navCollapseWidth = navCollapse.offsetWidth + 30,
					primaryWrapCalc = primaryWrapWidth - navCollapseWidth,
					primaryNavWidth = primaryNav.offsetWidth,
					pChildren = primaryNav.children;

				[].concat(conNavArray(pChildren)).forEach(function (item) {
					numW += item.offsetWidth + 5;

					if (numW > primaryWrapCalc) {
						item.outHTML = '';
						extendNav.appendChild(item);
					}

				});

				if (extendNav.getElementsByTagName('li').length >= 1) {
					navCollapse.classList.add('hasItems');
				} else {
					navCollapse.classList.remove('hasItems');
				}

				primaryNav.classList.remove('bb-primary-overflow');
			}

			if (typeof (primaryNav) != 'undefined' && primaryNav != null) {
				window.onresize = navListOrder;
				navListOrder();

				setTimeout(function () {
					navListOrder();
				}, 300);
				setTimeout(function () {
					navListOrder();
				}, 900);

				$('.bb-toggle-panel').on('click', function (e) {
					e.preventDefault();
					navListOrder();

					setTimeout(function () {
						navListOrder();
					}, 300);

					setTimeout(function () {
						navListOrder();
					}, 600);
				});
			}
		},

		forumsTopic: function () {
			var bbHeaderHeight = $('#masthead').outerHeight();
			$('#bbpress-forums .bs-topic-sidebar-inner').stick_in_parent({offset_top: bbHeaderHeight + 45});

			if ($('body .bbp-topic-form').length) {

				$(document).on('keyup', '.bbp-topic-form #new-post #bbp_topic_title', function (e) {
					if (e.which == 9 && !e.shiftKey) {
						e.preventDefault();
						$(e.target).closest('.bbp-topic-form #new-post .bbp-editor-content').focus();
					}
				});

				$(document).on('keyup', '.bbp-topic-form #new-post .bbp-editor-content', function (e) {
					if (e.which == 9 && e.shiftKey) {
						e.preventDefault();
						$(e.target).closest('.bbp-topic-form #new-post #bbp_topic_title').focus();
					}
				});

				$(document).on('keyup', '.bbp-topic-form #new-post #bbp_topic_tags', function (e) {
					if (e.which == 9 && e.shiftKey) {
						e.preventDefault();
						$(e.target).closest('.bbp-topic-form #new-post #bbp_editor_topic_content').focus();
					}
				});
			}

			if ($('body .bbp-reply-form').length) {

				$(document).on('keyup', '.bbp-reply-form #new-post #bbp_topic_tags', function (e) {
					if (e.which == 9 && e.shiftKey) {
						e.preventDefault();
						$(e.target).closest('.bbp-reply-form #new-post .bbp-editor-content').focus();
					}
				});
			}

			var appendthis = ('<div class="bb-modal-overlay js-modal-close"></div>');

			$(document).on('click', 'a[data-modal-id]', function (e) {
				e.preventDefault();
				$('body').append(appendthis);
				$('.bb-modal-overlay').fadeTo(500, 0.7);
				//$(".js-modalbox").fadeIn(500);
				var $bbpress_forums_element = $(e.target).closest('#content').find('#bbpress-forums');
				var modalBox = $(this).attr('data-modal-id');
				$bbpress_forums_element.find('.' + modalBox).fadeIn($(this).data());

				if ( $bbpress_forums_element.find('.bbp-reply-form').length ) {
					$bbpress_forums_element.find('.bbp-reply-form').find('#bbp_reply_to').val(0);
					$bbpress_forums_element.find('.bbp-reply-form').find('#bbp-reply-to-user').html($bbpress_forums_element.find($bbpress_forums_element.find('.bs-reply-list-item').get(0)).find('.bbp-author-name').text());
					var reply_exerpt = $bbpress_forums_element.find($bbpress_forums_element.find('.bs-reply-list-item').get(0)).find('>.bbp-reply-content>p').text().substring(0, 50);
					if (reply_exerpt != '') {
						reply_exerpt = '&quot;' + reply_exerpt + '...&quot;';
						$bbpress_forums_element.find('.bbp-reply-form').find('#bbp-reply-exerpt').html(reply_exerpt);
					}

					var editor_key = $bbpress_forums_element.find('.bbp-the-content').data('key');

					if (typeof window.forums_medium_reply_editor !== 'undefined' && typeof window.forums_medium_reply_editor[editor_key] !== 'undefined') {
						window.forums_medium_reply_editor[editor_key].subscribe('editableInput', function () {
							if ($.trim(window.forums_medium_reply_editor[editor_key].getContent()).replace('<p><br></p>', '') != '') {
								$bbpress_forums_element.find('.bbp-the-content').removeClass('error');
							} else {
								$bbpress_forums_element.find('.bbp-the-content').addClass('error');
							}
						});
					}
				}

				if ( typeof window.forums_medium_topic_editor !== 'undefined' && typeof window.forums_medium_topic_editor[editor_key] !== 'undefined') {
					window.forums_medium_topic_editor[editor_key].subscribe('editableInput', function () {
						if ( $.trim(window.forums_medium_topic_editor[editor_key].getContent()).replace('<p><br></p>','') != '' ) {
							$bbpress_forums_element.find('.bbp-the-content').removeClass('error');
						} else {
							$bbpress_forums_element.find('.bbp-the-content').addClass('error');
						}
					});
				}

			});

			$(document).on('click', 'a[data-modal-id-inline]', function (e) {
				e.preventDefault();
				$('body').append(appendthis);
				$('.bb-modal-overlay').fadeTo(500, 0.7);
				//$(".js-modalbox").fadeIn(500);
				var modalBox = $(this).attr('data-modal-id-inline');
				$('#' + modalBox).fadeIn($(this).data());

				var $bbpress_forums_element = $(e.target).closest('#bbpress-forums');

				if ( $bbpress_forums_element.find('.bbp-reply-form').length ) {
					$bbpress_forums_element.find('.bbp-reply-form').find('#bbp-reply-to-user').html($(this).closest('.bs-reply-list-item').find('.bbp-author-name').text());
					var reply_exerpt = $(this).closest('.bs-reply-list-item').find('>.bbp-reply-content>p').text().substring(0, 50);
					if (reply_exerpt != '') {
						reply_exerpt = '&quot;' + reply_exerpt + '...&quot;';
						$bbpress_forums_element.find('.bbp-reply-form').find('#bbp-reply-exerpt').html(reply_exerpt);
					}
					var editor_key = $bbpress_forums_element.find('.bbp-the-content').data('key');
					if (typeof window.forums_medium_reply_editor !== 'undefined' && typeof window.forums_medium_reply_editor[editor_key] !== 'undefined') {
						window.forums_medium_reply_editor[editor_key].subscribe('editableInput', function () {
							if ($.trim(window.forums_medium_reply_editor[editor_key].getContent()).replace('<p><br></p>', '') != '') {
								$bbpress_forums_element.find('.bbp-the-content').removeClass('error');
							} else {
								$bbpress_forums_element.find('.bbp-the-content').addClass('error');
							}
						});
					}
				}
			});

			$(document).on('click', '.js-modal-close', function (e) {
				e.preventDefault();
				$('.bb-modal-box, .bb-modal-overlay').fadeOut(500, function () {
					$('.bb-modal-overlay').remove();
				});
				$( 'body' ).removeClass( 'popup-modal-reply' );
			});

			$(document).on('click', '.bb-modal-overlay', function (e) {
				e.preventDefault();
				$('.bb-modal-box, .bb-modal-overlay').fadeOut(500, function () {
					$('.bb-modal-overlay').remove();
				});

			});

			if (bs_getUrlParameter('bbp_reply_to')) {
				$('.bbp-topic-reply-link').trigger('click');
			}

			if ($('.bbp-topic-form form').length && $('.bbp-topic-form form').find('.bp-feedback.error').length) {
				$('.btn-new-topic').trigger('click');
			}

			$('.bbp-topic-form form').on('keyup', '#bbp_topic_title,#bbp_anonymous_author,#bbp_anonymous_email', function (e) {
				e.preventDefault();
				if ($.trim($(this).val()) === '') {
					$(this).addClass('error');
				} else {
					$(this).removeClass('error');
				}
			});

			$(document).on('click', '.bbp-topic-form form #bbp_topic_submit', function (e) {
				e.preventDefault();

				var valid = true;
				var media_valid = true;
				var $topicForm = $(e.target).closest('form');

				if ($topicForm.find('.bbp-form-anonymous').length) {
					if ($.trim($topicForm.find('#bbp_anonymous_author').val()) === '') {
						$topicForm.find('#bbp_anonymous_author').addClass('error');
						valid = false;
					} else {
						$topicForm.find('#bbp_anonymous_author').removeClass('error');
					}

					if ($.trim($topicForm.find('#bbp_anonymous_email').val()) === '') {
						$topicForm.find('#bbp_anonymous_email').addClass('error');
						valid = false;
					} else {
						$topicForm.find('#bbp_anonymous_email').removeClass('error');
					}
				}

				if ($.trim($topicForm.find('#bbp_topic_title').val()) === '') {
					$topicForm.find('#bbp_topic_title').addClass('error');
					valid = false;
				} else {
					$topicForm.find('#bbp_topic_title').removeClass('error');
				}

				// if (typeof window.tinyMCE !== 'undefined' && typeof window.tinyMCE.get('bbp_topic_content') !== 'undefined' && $.trim(window.tinyMCE.get('bbp_topic_content').getContent()) === '') {
				// 	jQuery(window.tinyMCE.get('bbp_topic_content').contentAreaContainer).addClass('error');
				// 	valid = false;
				// } else if (typeof window.tinyMCE === 'undefined' && $.trim($('.bbp-topic-form form').find('#bbp_topic_content').val()) === '') {
				// 	$('.bbp-topic-form form').find('#bbp_topic_content').addClass('error');
				// 	valid = false;
				// } else {
				// 	if (typeof window.tinyMCE !== 'undefined' && typeof window.tinyMCE.get('bbp_topic_content') !== 'undefined') {
				// 		jQuery(window.tinyMCE.get('bbp_topic_content').contentAreaContainer).removeClass('error');
				// 	}
				// 	$topicForm.find('#bbp_topic_content').removeClass('error');
				// }

				var editor_key = $topicForm.find('.bbp_editor_topic_content').data('key');

				var editor = false;
				if ( typeof window.forums_medium_topic_editor !== 'undefined' && typeof window.forums_medium_topic_editor[editor_key] !== 'undefined' ) {
					editor = window.forums_medium_topic_editor[editor_key];
				}

				if (
					(
						$topicForm.find('#bbp_media').length > 0
						&& $topicForm.find('#bbp_media_gif').length > 0
						&& $topicForm.find('#bbp_media').val() == ''
						&& $topicForm.find('#bbp_media_gif').val() == ''
					)
					|| (
						$topicForm.find('#bbp_media').length > 0
						&& $topicForm.find('#bbp_media_gif').length <= 0
						&& $topicForm.find('#bbp_media').val() == ''
					)
					|| (
						$topicForm.find('#bbp_media_gif').length > 0
						&& $topicForm.find('#bbp_media').length <= 0
						&& $topicForm.find('#bbp_media_gif').val() == ''
					)
				) {
					media_valid = false;
				}

				if (
					( editor && $.trim( editor.getContent().replace('<p><br></p>', '') ) === '' )
					&& media_valid == false
				) {
					$topicForm.find('#bbp_editor_topic_content').addClass('error');
					valid = false;
				} else if (
					( ! editor && $.trim( $topicForm.find('#bbp_topic_content').val() ) === '' )
					&& media_valid == false
				) {
					$topicForm.find('#bbp_topic_content').addClass('error');
					valid = false;
				} else {
					if ( editor ) {
						$topicForm.find('#bbp_editor_topic_content').removeClass('error');
					}
					$topicForm.find('#bbp_topic_content').removeClass('error');
				}

				if (valid) {
					$topicForm.submit();
				}
			});

			$('.bbp-reply-form form #bbp_reply_submit').on('click', function (e) {
				e.preventDefault();

				var valid = true;
				var $replyForm = $(e.target).closest('form');

				if ($replyForm.find('.bbp-form-anonymous').length) {
					if ($.trim($replyForm.find('#bbp_anonymous_author').val()) === '') {
						$replyForm.find('#bbp_anonymous_author').addClass('error');
						valid = false;
					} else {
						$replyForm.find('#bbp_anonymous_author').removeClass('error');
					}

					if ($.trim($replyForm.find('#bbp_anonymous_email').val()) === '') {
						$replyForm.find('#bbp_anonymous_email').addClass('error');
						valid = false;
					} else {
						$replyForm.find('#bbp_anonymous_email').removeClass('error');
					}
				}

				if (valid) {
					$replyForm.submit();
				}
				$( 'body' ).removeClass( 'popup-modal-reply' );
				$replyForm.find( '.bbp_topic_tags_wrapper tags tag' ).remove();
			});
			$( document ).keydown( function (e) {
				if ( e.ctrlKey && 13 === e.keyCode ) {
					var bb_topic = $( '.bbp-topic-form form' ),
						bb_reply = $( '.bbp-reply-form form' );
					if( bb_reply.length ){
						bb_reply.find( '#bbp_reply_submit' ).trigger( 'click' );
					}
					if( bb_topic.length ){
						bb_topic.find( '#bbp_topic_submit' ).trigger( 'click' );
					}
				}
			});
			window.addReply = {
				moveForm: function (replyId, parentId, respondId, postId) {
					$('.bbp-reply-form').find('#bbp_reply_to').val(parentId);
					var t = this, div, reply = t.I(replyId), respond = t.I(respondId),
						cancel = t.I('bbp-cancel-reply-to-link'), parent = t.I('bbp_reply_to'),
						post = t.I('bbp_topic_id');

					if (!reply || !respond || !cancel || !parent) {
						return;
					}

					t.respondId = respondId;
					postId = postId || false;

					if (!t.I('bbp-temp-form-div')) {
						div = document.createElement('div');
						div.id = 'bbp-temp-form-div';
						div.style.display = 'none';
						respond.parentNode.insertBefore(div, respond);
					}

					respond.classList.remove('mfp-hide');
					reply.parentNode.appendChild(respond);

					if (typeof tinyMCE !== 'undefined') {

						// Remove existing instances of tinyMCE.
						tinyMCE.remove();

						// magnificPopup reinitialize tinyMCE.
						tinyMCE.init({
							selector: 'textarea.bbp-the-content',
							menubar: false,
							branding: false,
							plugins: "image,lists,link",
							toolbar: "bold italic bullist numlist blockquote link",
						});
					}

					if (post && postId) {
						post.value = postId;
					}
					parent.value = parentId;
					cancel.style.display = '';

					cancel.onclick = function () {
						var t = addReply, temp = t.I('bbp-temp-form-div'), respond = t.I(t.respondId);

						if (!temp || !respond) {
							return;
						}

						t.I('bbp_reply_to').value = '0';
						respond.classList.add('mfp-hide');
						temp.parentNode.insertBefore(respond, temp);
						temp.parentNode.removeChild(temp);
						this.style.display = 'none';
						this.onclick = null;
						return false;
					};

					try {
						t.I('bbp_reply_content').focus();
					} catch (e) {
					}

					return false;
				},

				I: function (e) {
					return document.getElementById(e);
				}
			};

		},

		heartbeat: function() {
			if ( ( typeof bs_data.show_notifications !== 'undefined' && bs_data.show_notifications == '1' ) || ( typeof bs_data.show_messages !== 'undefined' && bs_data.show_messages == '1' ) ) {
				// HeartBeat Send and Receive
				$(document).on('heartbeat-send', this.bpHeartbeatSend.bind(this));
				$(document).on('heartbeat-tick', this.bpHeartbeatTick.bind(this));
			}
		},

		/**
		 * [heartbeatSend description]
		 * @param  {[type]} event [description]
		 * @param  {[type]} data  [description]
		 * @return {[type]}       [description]
		 */
		bpHeartbeatSend: function( event, data ) {
			data.customfield = '';

			// Add an heartbeat send event to possibly any BuddyPress pages
			$( '#buddypress' ).trigger( 'bp_heartbeat_send', data );
		},

		/**
		 * [heartbeatTick description]
		 * @param  {[type]} event [description]
		 * @param  {[type]} data  [description]
		 * @return {[type]}       [description]
		 */
		bpHeartbeatTick: function( event, data ) {
			this.bpInjectNotifications(event, data);

			// Add an heartbeat send event to possibly any BuddyPress pages
			$( '#buddypress' ).trigger( 'bp_heartbeat_tick', data );
		},

		/**
		 * Injects all unread notifications
		 */
		bpInjectNotifications: function(event, data) {
			if ( typeof data.unread_notifications !== 'undefined' && data.unread_notifications !== '') {
				$('#header-notifications-dropdown-elem .notification-dropdown .notification-list').empty().html(data.unread_notifications);
			}

			// inject all unread messages notifications
			if ( typeof data.unread_messages !== 'undefined' && data.unread_messages !== '') {
				$('#header-messages-dropdown-elem .notification-dropdown .notification-list').empty().html(data.unread_messages);
			}

			if ( typeof data.total_notifications !== 'undefined' && data.total_notifications > 0 ) {
				var notifs = $('.bb-icon-bell-small');
				var notif_icons = $(notifs).parent().children('.count');

				if ( notif_icons.length > 0 ) {
					$(notif_icons).text(data.total_notifications);
				} else {
					$(notifs).parent().append( '<span class="count"> ' + data.total_notifications + ' </span>' );
				}
			}

			if ( typeof data.total_unread_messages !== 'undefined' && data.total_unread_messages > 0) {
				var msg = $('.bb-icon-inbox-small');
				var msg_icons = $(msg).parent().children('.count');

				if ( msg_icons.length > 0 ) {
					$(msg_icons).text(data.total_unread_messages);
				} else {
					$(msg).parent().append( '<span class="count"> ' + data.total_unread_messages + ' </span>' );
				}
			}
		},

	};

	$(document).on('ready', function () {
            BuddyBossTheme.init();

            $('.bp-personal-sub-tab #compose').on('click', function () {
                $(this).parent().toggleClass('current selected');
            });
	});

	function bs_gallery_slider() {
		if ($('body').hasClass('has-sidebar')) {
			var $break = 900;
		} else {
			var $break = 544;
		}

		var index = 0;
		$('.gallery').each(function () {
			if (!$(this).hasClass('slick-initialized')) { // Prevent error on loading more posts
				index++;
				$(this).attr('data-slider', index);
				$(this).slick({
					arrows: true,
					prevArrow: '<a class="bb-slide-prev"><i class="bb-icon-angle-right"></i></a>',
					nextArrow: '<a class="bb-slide-next"><i class="bb-icon-angle-right"></i></a>',
					dots: true,
					fade: true,
					slidesToShow: 1,
					slidesToScroll: 1,
					// customPaging: function ( slider, i ) { // example
					customPaging: function () {
						return '<span></span>'; // Remove button, customize content of "li"
					},
					mobileFirst: true,
					responsive: [
						{
							breakpoint: $break,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1,
							}
						}
					]
				});
			}
		});
	}

	function bs_getUrlParameter(sParam) {
		var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
	}

	/**
	 * Learndash Gutenberg
	 */

	$(".ld-entry-content > .entry-content-wrap .entry-content").addClass("ld-gb-content");

	/**
	 * LifterLMS
	 */

	$(".llms-notice > a").click(function () {

		if ($(".llms-person-login-form-wrapper").hasClass("llms-person-login-aktif")) {
			$(".llms-login").css("display", "none");
			$(".llms-person-login-form-wrapper").removeClass("llms-person-login-aktif");
		} else {
			$(".llms-person-login-form-wrapper").addClass("llms-person-login-aktif");
		}
	});

	$.fn.wrapStart = function (numWords) {
		var node = this.contents().filter(function () {
				return this.nodeType == 3
			}).first(),
			text = node.text().replace(/\s+/g, " ").replace(/^\s|\s$/g, ""),
			first = text.split(" ", numWords).join(" ");

		if (!node.length)
			return;

		node[0].nodeValue = text.slice(first.length);
		node.before('<span>' + first + '</span>');
	};

	$('.mepr-price-box-price').each(function () {
		$(this).wrapStart(1)
	});

	$('#modal-help-crisis').css("display", "none");

const initModalCrisis = () => {
	$('.HelpCrisis').on('click', function () {
	  ///console.log("levantando modal crisis");
		$('#modal-help-crisis').css("display", "block");
	});
  }
  
  initModalCrisis();

  const $crisisButton = $('#modal-crisis-cancel');

  $crisisButton.on('click', function (event) {
    $('#modal-help-crisis').css("display", "none");
  });

})(jQuery);

/**
 *
 * @param {String} query
 * @param {String} variable
 * @returns {String|Boolean}
 */
var BBGetQueryVariable = BBGetQueryVariable || function (query, variable) {
	if (typeof query !== 'string' || query == '' || typeof variable == 'undefined' || variable == '')
		return '';

	var vars = query.split("&");

	for (var i = 0; i < vars.length; i++) {
		var pair = vars[i].split("=");

		if (pair[0] == variable) {
			return pair[1];
		}
	}
	return (false);
};

var BBGetUrlParameter = BBGetUrlParameter || function (url, parameter_name) {
	parameter_name = parameter_name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
	var regex = new RegExp('[\\?&]' + parameter_name + '=([^&#]*)');
	var results = regex.exec(url);
	return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};



