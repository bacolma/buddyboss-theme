( function ( $ ) {

    "use strict";

    window.ByddyBossThemeAdmin = {
        init: function () {
            this.setLayout();
            this.importExportInfo();
            this.thumbScale();

            if ( BOSS_CUSTOM_ADMIN.elementor_pro_active == '1' ) {
                $('#customize-control-custom_logo').attr('style','display: block !important;');
            }
        },
        setLayout: function () {
            $( '.boss-support-area' ).parents( '.form-table' ).find( 'th' ).css( { 'padding': '0', 'width': '0' } );
        },
        importExportInfo: function () {
            $( '#redux-import-code-button' ).parent().before( '<p class="bb-description">Please click "Reset All" at the top, before doing an import in order for your changes to take effect.</p>' );
        },
        thumbScale: function () {
            
            $( '.upload_button_div' ).on( 'click', function(e) {
                var $this = $( this );
                $( 'fieldset.redux-field-container.redux-container-media' ).removeClass( 'bbActive' );
                $this.closest( 'fieldset.redux-field-container.redux-container-media' ).addClass( 'bbActive' );
            } );
            
            function scaleActiveContainerMedia() {
                $( '.redux-container-media.bbActive' ).each( function () {
                    var $this = $( this );
                    var $optionImage = $this.find( 'div.screenshot img.redux-option-image' );
                    var optionImageSrc = $optionImage.attr('src');
                    
                    if ( optionImageSrc !== undefined ) {
                        var thumbDimensionStr = optionImageSrc.substring(
                            optionImageSrc.lastIndexOf( '-' ), 
                            optionImageSrc.lastIndexOf( '.' )
                        );
                        var newOptionImageSrc = optionImageSrc.replace( thumbDimensionStr, '' );
    
                        $optionImage.attr('src', newOptionImageSrc);
                    }
                } );
            }
            
            function switchUrlMedia() {
                $( '.redux-container-media' ).each( function () {
                    var $this = $( this );
                    var $optionImage = $this.find( 'div.screenshot img.redux-option-image' );
                    var $optionUrl = $this.find( 'div.screenshot a.of-uploaded-image' );
                    
                    if ( $optionUrl.length ) {
                        var optionImageSrc = $optionImage.attr('src');
                        var optionImageUrl = $optionUrl.attr('href');
    
                        $optionImage.attr('src', optionImageUrl);
                    }
                } );
            }
            
            wp.media.view.Modal.prototype.on('open', function() { 
                $( '.media-button' ).on( 'click', function(e) {
                    scaleActiveContainerMedia();
                    $( 'fieldset.redux-field-container' ).removeClass( 'bbActive' );
                } );  
            });
            
            switchUrlMedia();
            
            // Scale redux thumbs
            function thumbRxImgSize( selector ) {
                var $this = selector;
                var $thumbSizeVal = $this.val();
                var $thumbImage = $this.closest( 'tr.bbThumbSlide' ).prev( '.bbThumbScale' ).find( 'img.redux-option-image' );
                
                if( $thumbSizeVal != 0 ) {
                    $thumbImage.addClass( 'custom-logo-size' );
                    $thumbImage.css( 'cssText', 'width:' + $thumbSizeVal + 'px !important;' );
                } else {
                    $thumbImage.removeClass( 'custom-logo-size' );
                    $thumbImage.css( 'cssText', 'width: auto !important;' );
                }
            }
            
            $( '.bbThumbSlide input.redux-slider-input' ).on( 'change paste keyup', function() {
                thumbRxImgSize( $(this) );
            });
            
            $( '.bbThumbSlide input.redux-slider-input' ).each( function () {
                thumbRxImgSize( $(this) );
            });
            
            var observerLr = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutationRecord) {
                    
                    $( '.bbThumbSlideLr input.redux-slider-input' ).each( function () {
                        thumbRxImgSize( $(this) );
                    });
                    
                });    
            });
            
            function checkIfImgNodeAvailableLr() {
                var target = document.querySelector( '.bbThumbSlideLr .noUi-origin' );
                
                if( !target ) {
                    window.setTimeout(checkIfImgNodeAvailableLr,500);
                    return;
                }
                observerLr.observe(target, { attributes : true, attributeFilter : ['style'] });
            }
            checkIfImgNodeAvailableLr();
            
            var observerLi = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutationRecord) {
                    
                    $( '.bbThumbSlideLi input.redux-slider-input' ).each( function () {
                        thumbRxImgSize( $(this) );
                    });
                    
                });    
            });
            
            function checkIfImgNodeAvailableLi() {
                var target = document.querySelector( '.bbThumbSlideLi .noUi-origin' );
                
                if( !target ) {
                    window.setTimeout(checkIfImgNodeAvailableLi,500);
                    return;
                }
                observerLi.observe(target, { attributes : true, attributeFilter : ['style'] });
            }
            checkIfImgNodeAvailableLi();
            
            var observerLim = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutationRecord) {
                    
                    $( '.bbThumbSlideLim input.redux-slider-input' ).each( function () {
                        thumbRxImgSize( $(this) );
                    });
                    
                });    
            });
            
            function checkIfImgNodeAvailableLim() {
                var target = document.querySelector( '.bbThumbSlideLim .noUi-origin' );
                
                if( !target ) {
                    window.setTimeout(checkIfImgNodeAvailableLim,500);
                    return;
                }
                observerLim.observe(target, { attributes : true, attributeFilter : ['style'] });
            }
            checkIfImgNodeAvailableLim();
            
            
            /* Footer Logo observer */
            var observerFl = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutationRecord) {
                    
                    $( '.bbThumbSlideFl input.redux-slider-input' ).each( function () {
                        thumbRxImgSize( $(this) );
                    });
                    
                });    
            });
            
            function checkIfImgNodeAvailableFl() {
                var target = document.querySelector( '.bbThumbSlideFl .noUi-origin' );
                
                if( !target ) {
                    window.setTimeout(checkIfImgNodeAvailableFl,500);
                    return;
                }
                observerFl.observe(target, { attributes : true, attributeFilter : ['style'] });
            }
            checkIfImgNodeAvailableFl();
            
        }
    };

    $( document ).on( 'ready', function () {
        ByddyBossThemeAdmin.init();
    } );

} )( jQuery );