( function ( $ ) {

    "use strict";

    window.BuddyBossThemeWc = {
        init: function () {
            this.wcShop();
            this.wcProductSlider();
        },
        
        wcShop: function() {

            $( '.wc-widget-area .widget_product_categories ul.product-categories .cat-item.cat-parent' ).each( function () {
                var self = $( this );

                self.prepend( '<span class="expand-parent"><i class="bb-icon-angle-right"></i></span>' );
                if ( self.is( '.current-cat, .current-cat-parent' ) ) {
                    self.find( '.expand-parent' ).first().addClass( 'active' );
                    self.addClass( 'cat-expanded' );
                }
            } );

            $( document ).on( 'click', 'ul.product-categories li span.expand-parent', function ( e ) {
                var self = $( this ),
                    catParent = self.closest( 'li.cat-parent' ),
                    catChildrent = catParent.find( 'ul.children' ).first();

                self.toggleClass( 'active' );
                catChildrent.slideToggle( '200' );
            } );

            $( '.wc-widget-area .widget_product_categories ul.product-categories li .count' ).text( function ( _, text ) {
                return text.replace( /\(|\)/g, '' );
            } );

            $( '#tab-title-reviews a' ).html( function ( i, h ) {
                return h.replace( /\(/g, '<span>' ).replace( /\)/, '</span>' );
            } );

            function wcProductQty() {
                $( 'form.cart .bs-quantity' ).each( function () {
                    var spinner = $( this ),
                        input = spinner.find( 'input[type="number"]' ),
                        btnUp = spinner.find( '.quantity-up' ),
                        btnDown = spinner.find( '.quantity-down' ),
                        min = input.attr( 'min' ),
                        max = input.attr( 'max' );

                    btnUp.click( function () {
                        var oldValue = parseFloat( input.val() );
                        if ( max.length === 0 ) {
                            var newVal = oldValue + 1;
                        } else {
                            if ( oldValue >= max ) {
                                var newVal = oldValue;
                            } else {
                                var newVal = oldValue + 1;
                            }
                        }
                        spinner.find( "input" ).val( newVal );
                        spinner.find( "input" ).trigger( "change" );
                    } );

                    btnDown.click( function () {
                        var oldValue = parseFloat( input.val() );
                        if ( oldValue <= min ) {
                            var newVal = oldValue;
                        } else {
                            var newVal = oldValue - 1;
                        }
                        spinner.find( "input" ).val( newVal );
                        spinner.find( "input" ).trigger( "change" );
                    } );

                } );
            }

            function wcCartQty() {
                $( '.woocommerce-cart-form .bs-quantity' ).each( function () {
                    var spinner = $( this ),
                        input = spinner.find( 'input[type="number"]' ),
                        btnUp = spinner.find( '.quantity-up' ),
                        btnDown = spinner.find( '.quantity-down' ),
                        min = input.attr( 'min' ),
                        max = input.attr( 'max' ),
                        curValue = parseFloat( input.val() );
                    if ( curValue == 0 ) {
                        btnDown.addClass( 'limit' );
                    }

                    btnUp.click( function () {
                        var oldValue = parseFloat( input.val() );
                        btnDown.removeClass( 'limit' );
                        if ( oldValue == max - 1 ) {
                            btnUp.addClass( 'limit' );
                        }
                        if ( max.length === 0 ) {
                            var newVal = oldValue + 1;
                        } else {
                            if ( oldValue >= max ) {
                                var newVal = oldValue;
                            } else {
                                var newVal = oldValue + 1;
                            }
                        }
                        spinner.find( "input" ).val( newVal );
                        spinner.find( "input" ).trigger( "change" );
                    } );

                    btnDown.click( function () {
                        var oldValue = parseFloat( input.val() );
                        if ( oldValue == min + 1 ) {
                            btnDown.addClass( 'limit' );
                        }
                        if ( oldValue <= min ) {
                            var newVal = oldValue;
                        } else {
                            var newVal = oldValue - 1;
                            btnUp.removeClass( 'limit' );
                        }
                        spinner.find( "input" ).val( newVal );
                        spinner.find( "input" ).trigger( "change" );
                    } );

                } );
            }

            wcProductQty();
            wcCartQty();

            $( document ).on( "change", "form[name='checkout'] input[name='payment_method']", function () {
                if ( $( this ).is( ':checked' ) ) {
                    $( this ).addClass( "selected_payment_method" );
                } else {
                    removeClass( "selected_payment_method" );
                }
            } );

            $( document ).on( 'click', 'a.push-my-account-nav', function ( event ) {
                event.preventDefault();

                var self = $( this );
                var navContainer = $( this ).closest( '.woocommerce-MyAccount-navigation' );
                navContainer.find( 'ul.woocommerce-MyAccount-menu' ).slideToggle();
            } );

            $( document ).on( 'click', 'span.wc-widget-area-expand', function ( event ) {
                var self = $( this );
                var widgetsContainer = $( this ).closest( '#secondary' );
                widgetsContainer.find( '.wc-widget-area-expandable' ).slideToggle();
                widgetsContainer.find( '.widget.widgets_expand' ).toggleClass( 'active' );
            } );

            if ( $( '.widget_layered_nav' ).length > 0 ) {
                $( '.widget_layered_nav' ).on( "click", "li input[type='checkbox']", function () {
                    window.location.href = $( this ).data( 'href' );
                } );
            }

            if ( $( '.widget_price_filter' ).length > 0 ) {
                $( '.price_slider' ).on( "slidestop", function ( event, ui ) {
                    $( '.price_slider' ).parent().parent().submit();
                } );
            }

            function filterCheckboxes() {
                // Checkbox Styling
                $( '.woocommerce-widget-layered-attribute input[type=checkbox].bb-input-switch' ).each( function () {
                    var $this = $( this );
                    $this.addClass( 'checkbox' );
                    if ( $this.is( ':checked' ) ) {
                        $this.next( 'span.checkbox' ).addClass( 'on' );
                        $this.closest( 'li.woocommerce-widget-layered-nav-list__item' ).addClass( 'on' );
                    }
                    ;
                    $this.fadeTo( 0, 0 );
                    $this.change( function () {
                        $this.next( 'span.checkbox' ).toggleClass( 'on' );
                    } );
                } );
            }
            filterCheckboxes();

            var $couponCode = $( 'form.woocommerce-cart-form .coupon #coupon_code' );
            var $couponCodeBtn = $( 'form.woocommerce-cart-form .coupon .button' );
            $couponCode.keyup( function () {

                var empty = false;
                $couponCode.each( function () {
                    if ( $( this ).val() == '' ) {
                        empty = true;
                    }
                } );

                if ( empty ) {
                    $couponCodeBtn.removeClass( 'bp-coupon-btn-active' );
                } else {
                    $couponCodeBtn.addClass( 'bp-coupon-btn-active' );
                }
            } );

            $( document ).on( 'click', function ( e ) {
                if ( $( e.target ).closest( '.woocommerce-shipping-calculator .shipping-calculator-form' ).length === 0 ) {
                    $( '.woocommerce-shipping-calculator .shipping-calculator-form' ).hide();
                }
            } );

        },
        
        wcProductSlider: function() {
            function wcProductGallery() {
                var wcGallery = {
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                    arrows: true,
                    prevArrow: '<span class="bb-slide-prev"><i class="bb-icon-angle-right"></i></span>',
                    nextArrow: '<span class="bb-slide-next"><i class="bb-icon-angle-right"></i></span>',
                }

                $( '.woocommerce-product-gallery .flex-control-thumbs' ).slick( wcGallery );
            }

            wcProductGallery();
        },

    };
    
    $( document ).on( 'ready', function () {
        BuddyBossThemeWc.init();
    } );

} )( jQuery );
