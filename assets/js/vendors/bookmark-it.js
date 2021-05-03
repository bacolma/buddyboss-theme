jQuery( document ).ready( function ( $ ) {

    $( document ).on( 'click', '.bookmark-it', function ( e ) {
        e.preventDefault();

        var self = $( this );

        if ( self.hasClass( 'loading' ) ) {
            return false;
        }

        self.addClass( 'loading' ).find( '.bb-bookmark' ).addClass( 'bb-icon-loader animate-spin' );

        var post_id = self.attr( 'data-post-id' ),
            user_id = self.attr( 'data-user-id' ),
            user_action = self.attr( 'data-action' );

        $.ajax( {
            url: bookmark_it_vars.ajaxurl,
            type: 'post',
            data: {
                action: 'bookmark_it',
                item_id: post_id,
                user_id: user_id,
                user_action: user_action,
                bookmark_it_nonce: bookmark_it_vars.nonce
            },
            success: function ( html ) {
                //console.log( self );
                self.removeClass( 'loading' ).find( '.bb-bookmark' ).removeClass( 'bb-icon-loader animate-spin' );

                if ( 'add-bookmark' === user_action ) {
                    self.attr( 'data-action', 'remove-bookmark' ).addClass( 'bookmarked' ).find( '.bb-bookmark' ).toggleClass( 'bb-icon-bookmark-small bb-icon-bookmark-small-fill' );
                } else {
                    self.attr( 'data-action', 'add-bookmark' ).removeClass( 'bookmarked' ).find( '.bb-bookmark' ).toggleClass( 'bb-icon-bookmark-small-fill bb-icon-bookmark-small' );
                }
            }
        } );
    } );
} );