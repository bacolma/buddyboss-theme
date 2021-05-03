jQuery(function($) {
	function bbp_reply_ajax_call( action, nonce, form_data, form ) {
		var $data = {
			action : action,
			nonce  : nonce
		};

		$.each(form_data, function(i, field){
			if ( field.name === 'action' ) {
				$data.bbp_reply_form_action = field.value;
			} else {
				$data[field.name] = field.value;
			}
		});

		var $bbpress_forums_element = form.closest('#bbpress-forums')

		$.post( window.bbpReplyAjaxJS.bbp_ajaxurl, $data, function ( response ) {
			if ( response.success ) {

				$bbpress_forums_element.find( '.bbp-reply-form form' ).removeClass('submitting');

				var reply_list_item = '';

				if ( 'edit' === response.reply_type ) {
					reply_list_item = '<li class="highlight">' + response.content + '</li>';
					// in-place editing doesn't work yet, but could (and should) eventually
					$('#post-' + response.reply_id).parent('li').replaceWith(reply_list_item);
				} else {
					if ( window.bbpReplyAjaxJS.threaded_reply && response.reply_parent && response.reply_parent !== response.reply_id ) {
						// threaded comment
						var $parent = null;
						var reply_list_item_depth = '1';
						if ( $('#post-' + response.reply_parent).parent('li').data('depth') == window.bbpReplyAjaxJS.threaded_reply_depth ) {
							var depth = parseInt(window.bbpReplyAjaxJS.threaded_reply_depth)-1;
							$parent = $('#post-' + response.reply_parent).closest('li.depth-'+depth);
							reply_list_item_depth = window.bbpReplyAjaxJS.threaded_reply_depth;
						} else {
							$parent = $('#post-' + response.reply_parent).parent('li');
							reply_list_item_depth = parseInt($parent.data('depth'))+1;
						}
						var list_type = 'ul';
						if ( $bbpress_forums_element.find('.bb-single-reply-list').is('ol') ) {
							list_type = 'ol';
						}
						if ( ! $parent.find('>'+list_type+'.bbp-threaded-replies').length ) {
							$parent.append('<' + list_type + ' class="bbp-threaded-replies"></' + list_type + '>');
						}
						reply_list_item = '<li class="highlight depth-'+reply_list_item_depth+'" data-depth="'+reply_list_item_depth+'">' + response.content + '</li>';
						$parent.find('>'+list_type+'.bbp-threaded-replies').append(reply_list_item);
					} else {
						reply_list_item = '<li class="highlight depth-1" data-depth="1">' + response.content + '</li>';
						$bbpress_forums_element.find('.bb-single-reply-list').append(reply_list_item);
					}
				}

				// Get all the tags without page reload.
				if ( response.tags !== '' ){
					var tagsDivSelector   = $( 'body .item-tags' );
					var tagsDivUlSelector = $( 'body .item-tags ul' );
					if ( tagsDivSelector.css( 'display' ) === 'none' ) {
						tagsDivSelector.append( response.tags );
						tagsDivSelector.show();
					} else {
						tagsDivUlSelector.remove();
						tagsDivSelector.append( response.tags );
					}
				}

				if ( reply_list_item != '' ) {
					$('body').animate({
						scrollTop: $(reply_list_item).offset().top
					}, 500);
					setTimeout(function () {
						$(reply_list_item).removeClass('highlight');
					}, 2000);
				}

				var media_element_key = $bbpress_forums_element.find( '.bbp-reply-form form' ).find( '#forums-post-media-uploader' ).data('key');
				var media = false;
				if ( typeof bp !== 'undefined' &&
					typeof bp.Nouveau !== 'undefined' &&
					typeof bp.Nouveau.Media !== 'undefined' &&
					typeof bp.Nouveau.Media.dropzone_media !== 'undefined' &&
					typeof bp.Nouveau.Media.dropzone_media[media_element_key] !== 'undefined' &&
					bp.Nouveau.Media.dropzone_media[media_element_key].length
				) {
					media = true;
					for( var i = 0; i < bp.Nouveau.Media.dropzone_media[media_element_key].length; i++ ) {
						bp.Nouveau.Media.dropzone_media[media_element_key][i].saved = true;
					}
				}

				var editor_element_key = $bbpress_forums_element.find( '.bbp-reply-form form' ).find( '.bbp-the-content' ).data('key');

				if ( typeof window.forums_medium_reply_editor !== 'undefined' && typeof window.forums_medium_reply_editor[editor_element_key] !== 'undefined' ) {
					window.forums_medium_reply_editor[editor_element_key].resetContent();
				}
				$bbpress_forums_element.find( '.bbp-reply-form form' ).find('.bbp-the-content').removeClass('error');
				$bbpress_forums_element.find('#bbp-close-btn').trigger('click');
				$bbpress_forums_element.find('#bbp_reply_content').val('');

				if ( typeof bp !== 'undefined' &&
					typeof bp.Nouveau !== 'undefined' &&
					typeof bp.Nouveau.Media !== 'undefined'
				) {
					if ( media ) {
						$bbpress_forums_element.find( '.bbp-reply-form form' ).find('#forums-media-button').trigger('click');
					} else {
						$bbpress_forums_element.find( '.bbp-reply-form form' ).find('#forums-gif-button').trigger('click');
					}
				}

				var scrubberposts = $bbpress_forums_element.find('.scrubberpost');
				for( var k in scrubberposts ) {
					if ( $(scrubberposts[k]).hasClass('post-'+response.reply_id) ) {
						window.BuddyBossThemeBbpScrubber.goToPost(parseInt(k,10)+1,'');
						break;
					}
				}
			} else {
				console.log(response);
				if ( !response.content ) {
					response.content = window.bbpReplyAjaxJS.generic_ajax_error;
				}
				console.log( response.content );
			}
			$bbpress_forums_element.find( '.bbp-reply-form form' ).removeClass('submitting');
		} );
	}

	function reset_reply_form() {
	}

	if ( ! $('body').hasClass('reply-edit') ) {
		$('.bbp-reply-form form').on('submit', function (e) {
			e.preventDefault();

			if ($(this).hasClass('submitting')) {
				return false;
			}

			$(this).addClass('submitting');

			var valid = true;
			var media_valid = true;
			var editor_key = $(e.target).find('.bbp-the-content').data('key');

			var editor = false;
			if (typeof window.forums_medium_reply_editor !== 'undefined' && typeof window.forums_medium_reply_editor[editor_key] !== 'undefined') {
				editor = window.forums_medium_reply_editor[editor_key];
			}

			if (
				(
					$(this).find('#bbp_media').length > 0
					&& $(this).find('#bbp_media_gif').length > 0
					&& $(this).find('#bbp_media').val() == ''
					&& $(this).find('#bbp_media_gif').val() == ''
				)
				|| (
					$(this).find('#bbp_media').length > 0
					&& $(this).find('#bbp_media_gif').length <= 0
					&& $(this).find('#bbp_media').val() == ''
				)
				|| (
					$(this).find('#bbp_media_gif').length > 0
					&& $(this).find('#bbp_media').length <= 0
					&& $(this).find('#bbp_media_gif').val() == ''
				)
			) {
				media_valid = false;
			}

			if (
				( editor && $.trim( editor.getContent().replace('<p><br></p>', '') ) === '' )
				&& media_valid == false
			) {
				$(this).find('.bbp-the-content').addClass('error');
				valid = false;
			} else if (
				( !editor && $.trim( $(this).find('#bbp_reply_content').val() ) === '' )
				&& media_valid == false
			) {
				$(this).find('#bbp_reply_content').addClass('error');
				valid = false;
			} else {
				if (editor) {
					$(this).find('.bbp-the-content').removeClass('error');
				}
				$(this).find('#bbp_reply_content').removeClass('error');
			}

			if (valid) {
				bbp_reply_ajax_call('reply', window.bbpReplyAjaxJS.reply_nonce, $(this).serializeArray(),$(this));
			} else {
				$(this).removeClass('submitting');
			}

		});
	}
});
