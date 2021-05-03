//import learndash_sidebar from "./learndash-sidebar";

( function ( $ ) {

    "use strict";

    window.BBLMS = {
        init: function () {
            this.toggleTheme();
            this.learnDashSidePanel();
            this.lms_user_profile_js();
            //this.lms_course_single_js();
            this.lms_single_course();
            this.course_archive_js();
            //this.quiz_progress();
            this.quizDetails();
            this.ajaxCompleteProcess();
            this.quizUpload();
            this.setElementorSpacing();
            this.courseViewCookie();
            this.bbStickyLdSidebar();
            this.StyleInputQuestion();
            this.singleLesson();
            this.singleTopic();
            this.singleQuiz();
            this.showMoreParticipants();
        },

        showMoreParticipants: function() {

          var total  = $( '.lms-course-members-list .lms-course-sidebar-heading .lms-count' ).text();
          var paged  = 2;
          var course  = $( '.lms-course-members-list #buddyboss_theme_learndash_course_participants_course_id' ).val();

          $( '.lms-course-members-list .bb-course-member-wrap .lme-more' ).click( function () {

            $( '.lms-course-members-list .bb-course-member-wrap .lme-less' ).hide();
            $.ajax({
              method  : 'GET',
              url     : bs_data.ajaxurl,
              data    : 'action=buddyboss_lms_get_course_participants&_wpnonce=' + bs_data.learndash.nonce_get_courses + '&total=' + total + '&page=' + paged + '&course=' + course,
              success : function ( response ) {
                $( '.lms-course-members-list .bb-course-member-wrap .course-members-list.course-members-list-extra' ).show();

                $( '.lms-course-members-list .bb-course-member-wrap .course-members-list-extra' ).append( response.data.html );

                $(window).trigger('resize');
                //$(".bb-sticky-sidebar").stick_in_parent({recalc_every: 1});

                if ( 'false' === response.data.show_more ) {
                  $( '.lms-course-members-list .bb-course-member-wrap .lme-more' ).remove();
                }

                paged = response.data.page;

                $( 'html, body' ).animate({ scrollTop: $(document).height() }, 1000);
              }
            });
          } );

        },

        fetchCourses: function() {
            var $form = $( '#bb-courses-directory-form' );

            var reset_pagination = false;

            //reset pagintion if categories or instructor filters are changed.
            //reset pagination if search term has changed
            var resetting_fields = [ 'filter-categories', 'filter-instructors', 'search' ];
            for ( var i = 0; i < resetting_fields.length; i++ ) {
                var prev_val = BBGetUrlParameter( window.location.search, resetting_fields[ i ] );
                var new_val = $form.find('[name="'+ resetting_fields[ i ] +'"]').val();

                if ( prev_val !== new_val ) {

                    switch ( resetting_fields[ i ] ) {
                        case 'filter-categories':
                        case 'filter-instructors':
                            if ( !prev_val && new_val === 'all' ) {
                                //hasn't really changed
                            } else {
                                reset_pagination = true;
                            }
                            break;
                        default:
                            reset_pagination = true;
                            break;
                    }

                }

                if ( reset_pagination ) {
                    break;
                }
            }

            if ( reset_pagination ) {
                $form.find( '[name="current_page"]' ).val(1);
            }

            var data = $form.serialize();

            //view
            var view = 'grid';
            if ( $form.find( '.layout-list-view' ).hasClass( 'active' ) ) {
                view = 'list';
            }
            data += '&view=' + view;

            $.ajax({
                method  : 'GET',
                url     : bs_data.ajaxurl,
                data    : data + '&action=buddyboss_lms_get_courses&_wpnonce=' + bs_data.learndash.nonce_get_courses,
                success : function ( response ) {
                    //update url
                    var new_url = bs_data.learndash.course_archive_url;

                    var current_page = $form.find( '[name="current_page"]' ).val();
                    if ( isNaN( current_page ) ) {
                        current_page = 1;
                    }
                    if ( current_page > 1 ) {
                        new_url += 'page/' + current_page + '/';
                    }

                    new_url += '?' + data;

                    window.history.pushState( { 'bblms_has_changes' : true, 'courses_html' : response.data.html, 'type' : $form.find( '[name="type"]' ).val() }, "", new_url );

                    //update html
                    $form.find('.bs-dir-list').html( response.data.html );
                    //update count
                    $form.find('li.selected a span').text( response.data.count );

                    if ( response.data.scopes ) {
                    	for (var i in response.data.scopes) {
							$form.find('li#courses-' + i + ' a span').text( response.data.scopes[i] ).show();
						}
                    }

                    $('.courses-nav').find('.bb-icon-loader').remove();
                }
            });

            return false;
            //$( '#bb-courses-directory-form' ).submit();
        },

        fetchCoursesPagination: function() {
            var $form = $( '#bb-courses-directory-form' );
            var data = $form.serialize();

            //view
            var view = 'list';
            if ( $form.find( '.layout-grid-view' ).hasClass( 'active' ) ) {
                view = 'grid';
            }
            data += '&view=' + view;

            $.ajax({
                method  : 'GET',
                url     : bs_data.ajaxurl,
                data    : data + '&action=buddyboss_lms_get_courses&_wpnonce=' + bs_data.learndash.nonce_get_courses,
                success : function ( response ) {
                    //update url
                    var new_url = bs_data.learndash.course_archive_url;

                    var current_page = $form.find( '[name="current_page"]' ).val();
                    if ( isNaN( current_page ) ) {
                        current_page = 1;
                    }
                    if ( current_page > 1 ) {
                        new_url += 'page/' + current_page + '/';
                    }

                    new_url += '?' + data;

                    window.history.pushState( { 'bblms_has_changes' : true, 'courses_html' : response.data.html, 'type' : $form.find( '[name="type"]' ).val() }, "", new_url );

                    //update html
                    $form.find('.bs-dir-list').html( response.data.html );

                    //update count
                    $form.find('li.selected a span').text( response.data.count );

                    if ( response.data.scopes ) {
                    	for (var i in response.data.scopes) {
							$form.find('li#courses-' + i + ' a span').text( response.data.scopes[i] ).show();
						}
                    }
                    $('.courses-nav').find('.bb-icon-loader').remove();
                }
            });

            return false;
            //$( '#bb-courses-directory-form' ).submit();
        },

        course_archive_js: function() {

            $( document ).on( 'change', '#bb-courses-directory-form input[type=checkbox]', function ( e ) {
                e.preventDefault();
	            window.BBLMS.fetchCourses();
            } );

            window.onpopstate = function(e) {
                if ( !e.state ) {
                    return;
                }

                var has_changes = e.state.hasOwnProperty( 'bblms_has_changes' ) ? e.state.bblms_has_changes : false;
                if ( has_changes ) {
                    var $form = $('#bb-courses-directory-form');

                    //update courses html
                    $form.find( '.bs-dir-list' ).html( e.state.courses_html );

                    //highlight correct nav
                    $form.find( '[name="type"]' ).val( e.state.type );

                    $form.find( '.component-navigation > li').each(function(){
                        $(this).removeClass('selected');
                        var type = BBGetUrlParameter( $(this).find(' > a').attr('href'), 'type' );
                        if ( type === e.state.type ) {
                            $(this).addClass('selected');
                        }
                    });
                }
            };

            $( document ).on( 'change', '#bb-courses-directory-form [name=\'orderby\'], #bb-courses-directory-form [name=\'filter-categories\'], #bb-courses-directory-form [name=\'filter-instructors\']', function ( e ) {
                e.preventDefault();
                window.BBLMS.fetchCourses();
            } );

            $( document ).on( 'click', '#bb-courses-directory-form .grid-filters a', function ( e ) {
                e.preventDefault();
                $( '#bb-courses-directory-form .grid-filters a' ).removeClass( 'active' );
                $( e.currentTarget ).addClass( 'active' );
                var view = $( e.currentTarget ).data( 'view' );
                if ( view == 'grid' ) {
                    $( '.bb-course-items.grid-view' ).removeClass( 'hide' );
                    $( '.bb-course-items.list-view' ).addClass( 'hide' );
                } else {
                    $( '.bb-course-items.grid-view' ).addClass( 'hide' );
                    $( '.bb-course-items.list-view' ).removeClass( 'hide' );
                }
            } );

            $( document ).on( 'click', '#bb-course-list-grid-filters .grid-filters a', function ( e ) {
                e.preventDefault();
                $( '#bb-course-list-grid-filters .grid-filters a' ).removeClass( 'active' );
                $( e.currentTarget ).addClass( 'active' );
                var view = $( e.currentTarget ).data( 'view' );
                var selector = $('.ld-course-list-content');
                if ( selector.hasClass('list-view') ) {
                    selector.removeClass('list-view');
                }

                if ( selector.hasClass('grid-view') ) {
                    selector.removeClass('grid-view');
                }

                selector.addClass( view + '-view');

            } );

            $( document ).ready(function() {
                if ( $('body #bb-course-list-grid-filters').length ) {
                    var active = '';
                    if ($('#bb-course-list-grid-filters .grid-filters .layout-grid-view').hasClass('active')) {
                        active = 'grid-view';
                    } else {
                        active = 'list-view';
                    }
                    $('.ld-course-list-content').addClass(active);
                }
            });

            $( document ).on( 'click', '#bb-courses-directory-form .bs-sort-button', function ( e ) {
                e.preventDefault();
                e.currentTarget.classList.toggle( 'active' );
                $( '#bs-courses-order-by' ).toggleClass( 'open' );
            } );

            $( document ).on( 'click', '#bb-courses-directory-form .bb-lms-pagination a.page-numbers', function ( e ) {
                e.preventDefault();
                var page_number = 1;
                var url_parts = $(this).attr('href').split('/');
                if ( url_parts.length > 0 ) {
                    for ( var i = 0; i < url_parts.length; i++ ) {
                        if ( 'page' === url_parts[i] ) {
                            page_number = url_parts[ i + 1 ];
                            break;
                        }
                    }
                }

                $(this).closest( 'form' ).find( '[name="current_page"]' ).val( page_number );
                window.BBLMS.fetchCoursesPagination();
            } );

            $( document ).on( 'click', '#bb-courses-directory-form .component-navigation a', function ( e ) {
                e.preventDefault();

                $(this).closest( '.component-navigation').find( '> li' ).removeClass('selected');
                $(this).closest( '.component-navigation').find( '> li a span' ).hide();
                $(this).closest( '.component-navigation').find( '> li a span' ).text('');
                $(this).closest('li').addClass('selected').append('<i class="bb-icon-loader animate-spin"></i>');
                $(this).closest('li').find( '> a span' ).text('');
                $(this).closest('li').find( '> a span' ).show();

                var type = BBGetUrlParameter( $(this).attr('href'), 'type' );
                $(this).closest( 'form' ).find( '[name="type"]' ).val( type );

                //resetting the page number if important, as sometimes 'all courses' can have more items than 'my courses'
                $(this).closest( 'form' ).find( '[name="current_page"]' ).val( 1 );
                window.BBLMS.fetchCourses();
            } );

            document.addEventListener( 'click', function ( e ) {
                var openFilterDropdown = $( '#course-order-dropdown' );
                var target = e.target;
                if ( openFilterDropdown === target && openFilterDropdown.contains( target ) ) {
                    return false;
                }

                var dropdowns = $( '#bb-courses-directory-form .bs-dropdown' );
                var download_link = $( '#bb-courses-directory-form .bs-dropdown-link' );

                for ( var i = 0; i < download_link.length; i++ ) {
                    if ( download_link[i] !== target && !download_link[i].contains( target ) ) {
                        download_link[i].classList.remove( 'active' );
                    }
                }

                for ( var i = 0; i < dropdowns.length; i++ ) {
                    if ( dropdowns[i] != target.parentElement.nextElementSibling ) {
                        dropdowns[i].classList.remove( 'open' );
                    }
                }
            } );

            $('#bb-courses-directory-form').on( 'submit', function(e){
                window.BBLMS.fetchCourses();
                return false;
            } );

        },

        toggleTheme: function() {

            $( document ).on( 'click', '#bb-toggle-theme', function ( e ) {
                e.preventDefault();
                var color = '';
                if ( !$( 'body' ).hasClass( 'bb-dark-theme' ) ) {
                    $.cookie( 'bbtheme', 'dark', { path: '/' });
                    $( 'body' ).addClass( 'bb-dark-theme' );
                    color = 'dark';
                } else {
                    $.removeCookie('bbtheme', { path: '/' });
                    $( 'body' ).removeClass( 'bb-dark-theme' );
                }

                if ( typeof( toggle_theme_ajax ) != 'undefined' && toggle_theme_ajax != null ) {
                    toggle_theme_ajax.abort();
                }

                var data = {
                    'action': 'buddyboss_lms_toggle_theme_color',
                    'color': color
                };

                // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                if ( typeof( toggle_theme_ajax ) != 'undefined' && toggle_theme_ajax != null ) {
                    toggle_theme_ajax = $.post( ajaxurl, data, function ( response ) {} );
                }
            } );
        },

        learnDashSidePanel: function() {

            $( document ).on( 'click', '.header-maximize-link', function ( e ) {
                e.preventDefault();
                $( 'body' ).addClass( 'lms-side-panel-close' );
                $( '.lms-topic-sidebar-wrapper' ).addClass( 'lms-topic-sidebar-close' );
                $.cookie( 'lessonpanel', 'closed', { path: '/' });
            } );

            $( document ).on( 'click', '.header-minimize-link', function ( e ) {
                e.preventDefault();
                $( 'body' ).removeClass( 'lms-side-panel-close' );
                $( '.lms-topic-sidebar-wrapper' ).removeClass( 'lms-topic-sidebar-close' );
                $.removeCookie('lessonpanel', { path: '/' });
            } );

            if ( $( window ).width() < 768 ) {
                $( 'body' ).addClass( 'lms-side-panel-close' );
                $( '.lms-topic-sidebar-wrapper' ).addClass( 'lms-topic-sidebar-close' );

                $( document ).on( 'click', '.header-minimize-link', function ( e ) {
                    e.preventDefault();
                    $( 'body' ).addClass( 'lms-side-panel-close-sm' );
                } );

                $( document ).click( function(e) {
                    var container = $( '.header-minimize-link' );
                    if ( !container.is( e.target ) && container.has( e.target ).length === 0 ) {
                        $( 'body' ).removeClass( 'lms-side-panel-close-sm' );
                    }
                } );
            }

            $( window ).on( 'resize', function () {
                if ( $( window ).width() < 768 ) {
                    $( document ).click( function(e) {
                        var container = $( '.header-minimize-link' );
                        if ( !container.is( e.target ) && container.has( e.target ).length === 0 ) {
                            $( 'body' ).removeClass( 'lms-side-panel-close-sm' );
                        }
                    } );
                }
            } );
        },

        lms_course_single_js: function() {
            $( document ).on( 'click', '.learndash-course-single-nav', function ( e ) {
                e.preventDefault();
                $( 'ul.learndash-course-single-main-nav' ).find( 'li.current.selected' ).removeClass( 'current' ).removeClass( 'selected' );

                var li = $( e.currentTarget ).closest( 'li' );
                li.addClass( 'current' );
                li.addClass( 'selected' );

                var currentTab = $( e.currentTarget );
                var tab_to_change = currentTab.data( 'tab' );

                var content_elems = $( '.learndash-course-single-tab-content' );
                $.each( content_elems, function ( elem ) {
                    var _this = $( this );
                    if ( _this.data( 'tab' ) == tab_to_change ) {
                        _this.removeClass( 'hide' );
                    } else {
                        _this.addClass( 'hide' );
                    }
                } );

            } );
        },

        lms_single_course: function() {
            $( '.bb-course-video-overlay' ).magnificPopup( {
                fixedBgPos: true,
                fixedContentPos: true,
                items: {
                    src: '.bb_course_video_details',
                    type: 'inline'
                },
                callbacks: {
                    open: function () {
                        // Pause the video if someone click on the close button of the magnificPopup.
                        $.magnificPopup.instance.close = function () {
                            if ($('.mfp-container .mfp-content .bb_course_video_details video'.length)) {
                                $('video').trigger('pause');
                                $.magnificPopup.proto.close.call(this);
                            }
                        };
                    }
                }
            } );

            function sideBarPosition() {
                var courseBannerHeight = $( '.bb-learndash-banner' ).height();
                var courseBannerVideo = $( '.bb-thumbnail-preview .bb-preview-course-link-wrap' );
                if ( courseBannerVideo.length ) {
                    var thumbnailContainerHeight = courseBannerVideo.height();
                } else {
                    var thumbnailContainerHeight = 0;
                }
                var sidebarOffset = ( courseBannerHeight/2 ) + ( thumbnailContainerHeight/2 );
                if ( $(window).width() > 820 ) {
                    $( '.bb-single-course-sidebar.bb-preview-wrap' ).css( { 'margin-top' : '-' + sidebarOffset + 'px' } );
                }
            }

            function courseBanner() {
                var mainWidth = $( '#main' ).width();
                $( '.bb-learndash-banner .bb-course-banner-info.container' ).width( mainWidth );
            }

            sideBarPosition();
            courseBanner();

            $( window ).on( 'resize', function () {
                courseBanner();
                sideBarPosition();
            } );

            $( '.bb-toggle-panel' ).on( 'click', function(e) {
                e.preventDefault();

                setTimeout(function(){
                    courseBanner();
                },300);
                setTimeout(function(){
                    courseBanner();
                },600);
            } );
        },

        lms_user_profile_js: function() {
            $( document ).on( 'click', '.bb-lms-user-profile-tab', function ( e ) {
                e.preventDefault();
                $( 'ul.bb-lms-user-profile-tabs' ).find( 'li.current.selected' ).removeClass( 'current' ).removeClass( 'selected' );

                var li = $( e.currentTarget ).closest( 'li' );
                li.addClass( 'current' );
                li.addClass( 'selected' );

                var currentTab = $( e.currentTarget );
                var tab_to_change = currentTab.data( 'tab' );

                var content_elems = $( '.bb-lms-user-profile-tab-content' );
                $.each( content_elems, function ( elem ) {
                    var _this = $( this );
                    if ( _this.data( 'tab' ) == tab_to_change ) {
                        _this.removeClass( 'hide' );
                    } else {
                        _this.addClass( 'hide' );
                    }
                } );

            } );
        },

        quizDetails: function() {

        	if ( $( '#bb-lms-quiz-id' ).length ) {
		        var quiz_id = $('#bb-lms-quiz-id').val();

		        $( 'div.quiz_progress_container' ).insertBefore( $( '.wpProQuiz_results .wpProQuiz_resultTable' ) );

		        $('#wpProQuiz_' + quiz_id).on('learndash-quiz-init', function () {
			        // $( document ).find( 'input[name="startQuiz"]' ).click( function () {
			        //     BBLMS.showQuizNavigation();
			        // } );
			        //
			        // $( document ).on( 'click', '.bb-lms-quiz-questions', function ( e ) {
			        //     e.preventDefault();
			        //     var index = $( e.currentTarget ).data( 'index' );
			        //     if ( typeof index !== 'undefined' ) {
			        //         $( '#wpProQuiz_' + quiz_id ).data( "wpProQuizFront" ).methode.showQuestion( index );
			        //     }
			        // } );
		        });
	        }
        },

        ajaxCompleteProcess: function() {
	        $( document ).ajaxComplete(function( event, request, settings ) {
		        if (settings.data && settings.data != '') {
			        var splitted = settings.data.split('&');
			        var action = '';
			        for (var i in splitted) {
				        if (splitted[i].indexOf('action') != -1) {
					        action = splitted[i].split('=');
					        action = typeof action[1] !== 'undefined' ? action[1] : '';
					        break;
				        }
			        }
			        if (action != '' && action == 'wp_pro_quiz_load_quiz_data') {
				        if( $( '.wpProQuiz_resultTable' ).length ) {
					        $( '.bb_avg_progress' ).show();

					        var pathAvg = new ProgressBar.Path("#bb_avg_shape", {
						        duration: 3000,
						        from: {
							        color: "#ECCBFF",
							        width: 8
						        },
						        to: {
							        color: "#ECCBFF",
							        width: 8
						        },
						        easing: "easeInOut",
						        step: function(state, shape) {
							        shape.path.setAttribute("stroke", state.color);
							        shape.path.setAttribute("stroke-width", state.width);
						        }
					        });

					        var avarage = request.responseJSON.averageResult;
					        if( avarage > 0 ) {
						        avarage = -avarage/100;
                            } else {
						        avarage = 0;
                            }
					        pathAvg.animate(avarage);
				        }
			        }
			        if (action != '' && action == 'wp_pro_quiz_completed_quiz') {
				        if( $( '.wpProQuiz_resultTable' ).length ) {

				            var data = decodeURIComponent(settings.data);
					        var splitted = data.split('&');
					        var result = '';
					        for (var i in splitted) {
						        if (splitted[i].indexOf('results') != -1) {
							        result = splitted[i].split('=');
							        result = typeof result[1] !== 'undefined' ? result[1] : '';
							        result = JSON.parse(result);
							        break;
						        }
					        }

					        if ( typeof result.comp.result !== 'undefined' ) {
						        result = result.comp.result;
					        }

					        var path = new ProgressBar.Path("#quiz_shape_progress", {
						        duration: 3000,
						        from: {
							        color: "#00A2FF",
							        width: 8
						        },
						        to: {
							        color: "#7FE0FF",
							        width: 8
						        },
						        easing: "easeInOut",
						        step: function(state, shape) {
							        shape.path.setAttribute("stroke", state.color);
							        shape.path.setAttribute("stroke-width", state.width);
						        }
					        });

					        jQuery('.bb_progressbar_label').text(result+'%');
					        jQuery('.bb_progressbar_points').text(jQuery('.wpProQuiz_points').text());

					        if( result > 0 ) {
						        result = -result/100;
					        }

					        path.animate(result);
                        }
                    }
		        }
	        });
        },

        quizUpload: function() {
            function inputFileStyle() {
                $( 'input.wpProQuiz_upload_essay[type=file]:not(.styled)' ).each( function () {
                    var $fileInput = $( this );
                    var $fileInputFor = $fileInput.attr( 'id' );
                    $fileInput.addClass('styled');
                    $fileInput.after( '<label for="' + $fileInputFor + '">Choose a file</label>' );
                } );

                $( 'input.wpProQuiz_upload_essay[type=file]' ).change( function ( e ) {
                    var $in = $( this );
                    var $inval = $in.next().html( $in.val() );
                    if ( $in.val().length === 0 ) {
                        $in.next().html( 'Choose a file' );
                    } else {
                        $in.next().html( $in.val().replace( /C:\\fakepath\\/i, '' ) );
                    }
                } );
            }

            inputFileStyle();
            $( document ).ajaxComplete(function() {
                inputFileStyle();
            });
        },

        courseViewCookie: function () {
                $( '#bb-courses-directory-form .layout-grid-view' ).click( function () {
                        $.cookie( 'courseview', 'grid' );
                } );

                $( '#bb-courses-directory-form .layout-list-view' ).click( function () {
                        $.cookie( 'courseview', 'list' );
                } );
        },

        bbStickyLdSidebar: function () {
            function stickLdSideBar() {
                var bbHeaderHeight = $('#masthead').outerHeight();
                $('.bb-ld-sticky-sidebar').stick_in_parent({offset_top: bbHeaderHeight + 45});

                if ( $( window ).width() < 820 ) {
                    $(".bb-ld-sticky-sidebar").trigger("sticky_kit:detach");
                    $('.lms-topic-sidebar-data').trigger("sticky_kit:detach");
                }

                if( $('body').hasClass('sticky-header') ) {
                    $('.lms-topic-sidebar-data').stick_in_parent({offset_top: bbHeaderHeight + 30 });
                } else {
                    $('.lms-topic-sidebar-data').stick_in_parent({offset_top: 30});
                }
            }

            stickLdSideBar();

            $(window).on('resize', function () {
                stickLdSideBar();
            });

            if ($('.wpProQuiz_matrixSortString').length > 0) {
                $('html').addClass('quiz-sort');
            }
        },

        setElementorSpacing: function() {
            if ( $('.elementor-location-header').length > 0 ) {
                var setHeight = $('.elementor-location-header').outerHeight();
                $('.lms-topic-sidebar-wrapper, #learndash-page-content').css({'min-height': 'calc(100vh - '+setHeight+'px)'});
            }
        },

        showQuizNavigation: function() {
            var question_list = $( '.wpProQuiz_list' ).find( '.wpProQuiz_listItem' );
            var nav_wrapper = $( '#bb-lms-quiz-navigation' );
            if ( question_list.length && nav_wrapper.length ) {
                var str = '<ul>';
                for ( var i = 1; i <= question_list.length; i++ ) {
                    str += '<li><a href="#" class="bb-lms-quiz-questions" data-index="' + ( i - 1 ) + '">' + i + '</a></li>';
                }
                str += '</ul>';
                nav_wrapper.html( str );
            }
        },

        StyleInputQuestion: function() {
            function styleInputs() {
                $( '.wpProQuiz_questionInput:not([type="text"]):not([type="email"]):not([type="tel"]):not([type="date"])' ).each(function() {
                    if( ! $(this).hasClass('bbstyled') ) {
                        $(this).addClass('bbstyled').after('<span class="input-style"></span>');
                    }
                });
            }

            styleInputs();

            $( document ).ajaxComplete( function() {
                styleInputs();
            });
        },

        singleLesson: function() {
            var lsPageContent = document.getElementById('learndash-page-content');
            if( lsPageContent ) {
                $( '#learndash-page-content' ).scroll(function() {
                    $( window ).trigger('resize');
                });
            }
        },

        singleTopic: function() {
            var lsPageContent = $( 'body.single-sfwd-topic .lms-topic-item.current' );
            if( lsPageContent.length ) {
                lsPageContent.closest( 'div' ).show();
                lsPageContent.parents().closest( 'li' ).removeClass( 'lms-lesson-turnover' );
            }
             //Remove comment system added by shortcodes
            var learndash_pages = ['.sfwd-lessons-template-default', '.sfwd-topic-template-default', '.sfwd-quiz-template-default'];
            for(var i=0; i<learndash_pages.length; i++){
                if($(learndash_pages[i]+' #learndash-page-content #learndash-content #learndash-page-content .learndash_content_wrap #comments.comments-area').length > 0){
                    $(learndash_pages[i]+' #learndash-page-content #learndash-content #learndash-page-content .learndash_content_wrap #comments.comments-area').remove();
                }
                if($(learndash_pages[i]+' #learndash-page-content #learndash-content #learndash-page-content .learndash_content_wrap .ld-focus-comments').length > 0){
                    $(learndash_pages[i]+' #learndash-page-content #learndash-content #learndash-page-content .learndash_content_wrap .ld-focus-comments').remove();
                }
            }
        },

        singleQuiz: function() {
            var lsPageContent = $( 'body.single-sfwd-quiz .lms-quiz-item.current' );
            if( lsPageContent.length ) {
                lsPageContent.closest( 'div' ).show();
                lsPageContent.parents().closest( 'li' ).removeClass( 'lms-lesson-turnover' );
            }
        }

    };

    $( document ).ready( function () {
	    window.BBLMS.init();
    } );

} )( jQuery );
