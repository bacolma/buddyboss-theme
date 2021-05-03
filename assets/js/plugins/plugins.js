( function ( $ ) {

    "use strict";

    window.BuddyBossThemePlugins = {
        init: function () {
            //this.bpgl_search();
            this.exchange();
            this.wpForms();
        },

        bpgl_search: function() {

            var $slick_slider = $( '.bp-search-results-wrapper .search_filters ul' ).not( '.slick-initialized' ),
                settings = {
                    infinite: false,
                    variableWidth: true,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                    arrows: true,
                    //appendArrows: $( '.bp-search-results-wrapper .search_filters' ),
                    prevArrow: '<span class="bb-slide-prev"><i class="bb-icon-angle-left"></i></span>',
                    nextArrow: '<span class="bb-slide-next"><i class="bb-icon-angle-right"></i></span>',
                    responsive: [
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 1180,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 1000,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 660,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 540,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 360,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            }
                        }
                    ]
                },
                currentSlideIndex = 0;

            $slick_slider.slick( settings );

            $( window ).on( 'resize', function () {
                if ( !$( '.bp-search-results-wrapper .search_filters ul' ).hasClass( 'slick-initialized' ) ) {
                    return $( '.bp-search-results-wrapper .search_filters ul' ).slick( settings );
                }
            } );

            $( document ).ajaxComplete( function () {
                $( '.bp-search-results-wrapper .search_filters ul' ).slick( settings );
            } );

            $( '#buddypress' ).on( 'init', '.bp-search-results-wrapper .search_filters ul', function() {
                $( '.bp-search-results-wrapper .search_filters ul' ).css({ opacity: 0 });
                setTimeout( function() {
                    $( '.bp-search-results-wrapper .search_filters ul' ).slick( 'slickGoTo', currentSlideIndex, true );
                    $( '.bp-search-results-wrapper .search_filters ul' ).css({ opacity: 1 });
                }, 500 );
            } );

            $( '#buddypress' ).on( 'afterChange', '.bp-search-results-wrapper .search_filters ul', function(event, slick, currentSlide) {
                currentSlideIndex = currentSlide;
            } );
        },

        exchange: function() {
            if ( $( '.it-exchange-customer-info .it-exchange-customer-welcome' ).length > 0 ) {
                $( 'ul.it-exchange-customer-menu li' ).first().addClass( 'current' );
            }
        },

        wpForms: function() {
            $( '.wpforms-form input[type=file]' ).each( function () {
                var $fileInput = $( this );
                var $fileInputFor = $fileInput.attr( 'id' );
                $fileInput.after( '<label for="' + $fileInputFor + '">Choose File</label>' );
            } );

            $( '.wpforms-form input[type=file]' ).change( function ( e ) {
                var $in = $( this );
                var $inval = $in.next().html( $in.val() );
                if ( $in.val().length === 0 ) {
                    $in.next().html( 'Choose File' );
                } else {
                    $in.next().html( $in.val().replace( /C:\\fakepath\\/i, '' ) );
                }
            } );
        },

    };

    $( document ).on( 'ready', function () {
        BuddyBossThemePlugins.init();
    } );

    $( document ).on( 'nfFormReady', function ( e, layoutView ) {
        function ninjaCheckboxes() {
            $( '.checkbox-wrap .nf-field-element input[type=checkbox], .list-checkbox-wrap .nf-field-element input[type=checkbox]' ).each( function () {
                var $this = $( this );
                $( '<span class="checkbox"></span>' ).insertAfter( $this );
                $this.addClass( 'checkbox' );
                if ( $this.is( ':checked' ) ) {
                    $this.next( 'span.checkbox' ).addClass( 'on' );
                    $this.closest( 'li' ).addClass( 'on' );
                }

                $this.fadeTo( 0, 0 );
                $this.change( function () {
                    $this.next( 'span.checkbox' ).toggleClass( 'on' );
                } );
            } );
        }
        ninjaCheckboxes();

        function ninjaRadio() {
            $( '.list-radio-wrap .nf-field-element input[type=radio]' ).each( function () {
                var $this = $( this );
                $( '<span class="bs-radio"></span>' ).insertAfter( $this );
                $this.addClass( 'bs-radio' );
                if ( $this.is( ':checked' ) ) {
                    $this.next( 'span.bs-radio' ).addClass( 'on' );
                    $this.closest( 'li' ).addClass( 'on' );
                }

                $this.change( function () {
                    $this.closest( '.nf-field-element' ).find( 'span.bs-radio' ).removeClass( 'on' );
                    $this.closest( '.nf-field-element' ).find( 'li' ).removeClass( 'on' );
                    $this.next( 'span.bs-radio' ).addClass( 'on' );
                    $this.closest( 'li' ).addClass( 'on' );
                } );
            } );
        }
        ninjaRadio();
    } );

    //Wc Vendor Table Responsive
    if($('.entry-content .table.table-vendor-sales-report').length > 0){
        $('.entry-content .table.table-vendor-sales-report').wrap( "<div class='table-vendor-sales-report-wrap'></div>" );
    }
    if($('.entry-content form[name="export_orders"] + h2 + table.table').length > 0 ){
        $('.entry-content form[name="export_orders"] + h2 + table.table').addClass('wc_table-export_orders').wrap('<div class="wc_table-export_orders_wrap"></div>')
    }

} )( jQuery );
