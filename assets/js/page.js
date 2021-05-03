/**
 * Page implementation
 *
 * @since BuddyBoss 1.0.0
 */
(function( $ ) {

	$( function() {

		// Classic editor
		if ( null !== document.getElementById( 'tmpl-classic-editor-page-padding' ) ) {
			var classicEdiorTemplate = wp.template( 'classic-editor-page-padding' );

			$( '#page_template' ).on( 'change', function() {
				if ( this.value === 'page-fullscreen.php' && null === document.querySelector( '#page-padding-label-wrapper' ) ) {
					this.insertAdjacentHTML( 'afterend', classicEdiorTemplate() );
				} else {
					$( '#page-padding-label-wrapper' ).remove();
				}
			} ).change();
		}

		// Gutenberg editor
		if ( null !== document.getElementById( 'tmpl-block-editor-page-padding' ) ) {
			var observer = new MutationObserver( function( mutations ) {
				// using jQuery to optimize code
				$.each( mutations, function( i, mutation ) {
					var addedNodes = $( mutation.addedNodes );
					var selector = '.editor-page-attributes__template select';
					var filteredEls = addedNodes.find( selector ).addBack( selector ); // finds either added alone or as tree
					filteredEls.each( function() { // can use jQuery select to filter addedNodes
						$( this ).trigger( 'change' );
					} );
				} );

			} );

			var blockEditorEl = document.querySelector( '.block-editor__container' );

			if ( null !== blockEditorEl ) {
				observer.observe( blockEditorEl, { childList: true, subtree: true } );
			}

			var blockEditorTemplate = wp.template( 'block-editor-page-padding' );

			$( document ).on( 'change', '.editor-page-attributes__template select', function() {
				if ( this.value === 'page-fullscreen.php' ) {
					if ( null === document.querySelector( '#page-padding-label-wrapper' ) ) {
						document.querySelector( '.editor-page-attributes__template' ).insertAdjacentHTML( 'beforeend', blockEditorTemplate() );
						document.getElementById( '_wp_page_padding' ).value = document.getElementById( 'page_padding' ).value;
					}
				} else {
					$( '#page-padding-label-wrapper' ).remove();
					$( '#page_padding' ).val( '' );
				}
			} );

			// Copy padding value into metabox
			$( document ).on( 'input', '#_wp_page_padding', function() {
				$( '#page_padding' ).val( this.value );
			} );
		}

	} );

})( jQuery );
