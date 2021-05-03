( function ( $ ) {

    "use strict";

    window.BuddyBossThemeJm = {
        init: function () {
            this.jobFilter();
            this.jobManager();
            this.jmRelatedSlider();
            this.jmScaleTable();
        },

        jobFilter: function() {
            $( document ).on( 'click', '.bb-job-filter .job-filter-heading', function ( e ) {
                var $this = $( this );
                var $filterBlock = $this.closest( '.bb-job-filter' );
                $filterBlock.toggleClass( 'bbj-state' );
            } );
        },

        jobManager: function() {

            $( '.single-job-sidebar .application_button' ).magnificPopup( {
                fixedBgPos: true,
                fixedContentPos: true,
                items: {
                    src: '.single-job-sidebar .bb_application_details',
                    type: 'inline'
                }
            } );

            $( '.single_job_listing .application_button' ).magnificPopup( {
                fixedBgPos: true,
                fixedContentPos: true,
                items: {
                    src: '.single_job_listing .bb_application_details',
                    type: 'inline'
                }
            } );

            $( 'p.resume_submit_wrap input.button' ).val( function ( index, value ) {
                return value.replace( /[^a-z0-9\s]/gi, '' );
            } );

            if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
                $( '#submit-job-form #job_deadline' ).prop( 'readonly', true );
                $( '#submit-job-form .fieldset-job_deadline .field' ).append( '<span class="jm-clear">x</span>' );

                $( document ).on( 'click', '.jm-clear', function ( e ) {
                    $( '#submit-job-form .fieldset-job_deadline .field #job_deadline' ).val( '' );
                } );
            }

            function showingJobsFilters() {
                $( 'form.job_filters .showing_jobs a' ).each( function () {
                    if( $(this).find('span').length === 0 ) {
                        var self = $( this );
                        var str = self.text();

                        self.wrapInner( '<span></span>' );
                        self.attr( 'data-balloon-pos', 'up' );
                        self.attr( 'data-balloon', str );
                    }
                } );
            }

            $( document ).ajaxComplete( function () {
                showingJobsFilters();
            } );

        },

        jmRelatedSlider: function() {

            jm_related_slider();

        },
        
        jmScaleTable: function() {

            $( '#job-manager-alerts table.job-manager-alerts' ).wrap('<div class="wrap-job-manager-alerts"></div>');
            $( '#job-manager-job-dashboard table.job-manager-jobs' ).wrap('<div class="wrap-job-manager-jobs"></div>');

        },

    };

    $( document ).on( 'ready', function () {
        BuddyBossThemeJm.init();
    } );

    function jm_related_slider() {
        var $jm_slick_slider = $( '.post-related-jobs .job_listings_grid' );

        var settings = {
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            adaptiveHeight: true,
            arrows: true,
            prevArrow: '<a class="bb-slide-prev"><i class="bb-icon-angle-right"></i></a>',
            nextArrow: '<a class="bb-slide-next"><i class="bb-icon-angle-right"></i></a>',
        }

        $jm_slick_slider.slick( settings );

        if ( $( window ).width() < 1280 ) {
            if ( $jm_slick_slider.hasClass( 'slick-initialized' ) ) {
                $jm_slick_slider.slick( 'unslick' );
            }
            return;
        }

        $( window ).on( 'resize', function () {
            if ( $( window ).width() < 1280 ) {
                if ( $jm_slick_slider.hasClass( 'slick-initialized' ) ) {
                    $jm_slick_slider.slick( 'unslick' );
                }
                return
            }

            if ( !$jm_slick_slider.hasClass( 'slick-initialized' ) ) {
                return $jm_slick_slider.slick( settings );
            }
        } );
    }

} )( jQuery );
