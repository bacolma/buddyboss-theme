( function ( $ ) {

    "use strict";

    window.BuddyBossThemeTec = {
        init: function () {
            this.eventsCalendar();
        },

        eventsCalendar: function() {
            function iCalBtnText() {
                var iCal = $( '#tribe-events-content a.tribe-events-ical' );
                var newiCal = iCal.text().replace( '+', '' );
                iCal.text( newiCal );
            }
            function igCalBtnText() {
                var iCal = $( 'a.tribe-events-gcal' );
                var newiCal = iCal.text().replace( '+', '' );
                iCal.text( newiCal );
            }
            iCalBtnText();
            igCalBtnText();

            $( document ).ajaxComplete( function () {
                iCalBtnText();
            } );

            $( '.bs-week-header span' ).html( function ( i, v ) {
                return $.trim( v ).replace( /(\w+)/g, '<span class="br-week-title">$1</span>' );
            } );

            var last_visible_filter = $( '.tribe-events-filters-vertical #tribe_events_filters_form > div:visible:last' );
            last_visible_filter.addClass( 'bs-last-filter' );

            function filterBarCheckboxes() {
                $( '#tribe_events_filters_form input[type=checkbox]' ).iCheck( 'destroy' );
                // Checkbox Styling
                $( '#tribe_events_filters_form input[type=checkbox]' ).each( function () {
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

                    $( document ).on( 'click', '#tribe_events_filters_reset', function ( e ) {
                        $this.next( 'span.checkbox' ).removeClass( 'on' );
                        $this.closest( 'li' ).removeClass( 'on' );
                    } );
                } );
            }
            filterBarCheckboxes();

            function organizerImgHeight() {
                var fiHeight = $( '.bs-organize-sq-fi' ).height();
                var wrHeight = $( '.bs-organize-sq-wr' ).height();

                if ( fiHeight > wrHeight ) {
                    $( '.bs-organize-sq-fi' ).css( {
                        'margin-bottom': '0'
                    } );
                } else {
                    $( '.bs-organize-sq-fi' ).css( {
                        'margin-bottom': '20px'
                    } );
                }
            }
            organizerImgHeight();

            $( window ).on( 'resize', function () {
                organizerImgHeight();
            } );

            function prevNextSingleText() {
                var sNext = $( '.tribe-events-single #tribe-events-footer .tribe-events-nav-next a' );
                var sPrev = $( '.tribe-events-single #tribe-events-footer .tribe-events-nav-previous a' );
                sNext.text( 'Next Event' );
                sPrev.text( 'Previous Event' );
            }
            prevNextSingleText();

            function checkForNotice() {
                if ( $( '#tribe-events-content h2.tribe-events-page-title' ).next().is( '.tribe-events-notices' ) ) {
                    $( '#tribe-events-content h2.tribe-events-page-title' ).addClass( 'has-notice' );
                } else {
                    $( '#tribe-events-content h2.tribe-events-page-title' ).removeClass( 'has-notice' );
                }
            }
            checkForNotice();

            $( document ).ajaxComplete( function () {
                checkForNotice();
            } );

            $( '#tribe-bar-date' ).attr( 'autocomplete', 'off' );
        },

    };

    $( document ).on( 'ready', function () {
        BuddyBossThemeTec.init();
    } );

} )( jQuery );
