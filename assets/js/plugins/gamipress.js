( function ( $ ) {

    "use strict";

    window.BuddyBossThemeGami = {
        init: function () {
            this.wpautopFix();
        },

        wpautopFix: function() {
            $( '.gamipress-rank-excerpt p:empty' ).remove();
            $( '.gamipress-achievement-excerpt p:empty' ).remove();
        },

    };

    $( document ).on( 'ready', function () {
        BuddyBossThemeGami.init();
    } );

} )( jQuery );
