(function ($) {

	'use strict';

	window.BuddyBossThemeBbpScrubber = {

		scrubbers : [],

		init: function () {
			var self = window.BuddyBossThemeBbpScrubber;
			var $scrubbers = $('.scrubber');

			$scrubbers.each(function(i,scrubber){
				var scrubber_key = $(scrubber).data('key');
				var $bbpress_forums_elem = $(scrubber).closest('#bbpress-forums');
				var scrubber_height = $(scrubber).find('#reply-timeline-container').outerHeight();
				self.scrubbers[scrubber_key] = {
					total: $bbpress_forums_elem.find('.scrubberpost').length,
					onscroll_update: true,
					scrubber_height_usable: scrubber_height - $(scrubber).find('#handle').outerHeight(),
					scrubber_height: scrubber_height,
					currentnum: 1,
					scrolltimer: null,
					handleani: null, // keep handle any end event.
					draggie: null,
				};

				if ( self.scrubbers[scrubber_key].total < 3 ) {
					$(scrubber).addClass( 'light' );
				}

				self.init_draggabilly(scrubber_key);
			});

			window.addEventListener('scroll', self.onScrubberScroll);

			$('.scrubber').on('click', '.firstpostbtn', function (e) {
				e.preventDefault();
				var scrubber_key = $(e.target).closest('.scrubber').data('key');
				self.goToPost(1, 'first',scrubber_key);
			});

			$('.scrubber').on('click', '.lastpostbtn', function (e) {
				e.preventDefault();
				var scrubber_key = $(e.target).closest('.scrubber').data('key');
				self.goToPost(self.scrubbers[scrubber_key].total, 'last',scrubber_key);
			});
		},

		init_draggabilly: function (scrubber_key) {
			var self = window.BuddyBossThemeBbpScrubber;
			var $scrubber = $('.scrubber[data-key="'+scrubber_key+'"]');

			if ( ! $scrubber.length ) {
				return false;
			}

			self.scrubbers[scrubber_key].draggie = $scrubber.find('#handle').draggabilly({
				axis: 'y',
				grid: [1, 1],
				containment: $scrubber.find('#reply-timeline-container')
			});

			self.scrubbers[scrubber_key].draggie.on('dragEnd', function () {
				// make sure handle is not in animate mode.
				$scrubber.find('#handle').removeClass('animate');

				var index = '';
				if (self.scrubbers[scrubber_key].currentnum === 1) {
					index = 'first';
				} else if (self.scrubbers[scrubber_key].currentnum === self.scrubbers[scrubber_key].total) {
					index = 'last';
				}
				self.goToPost(self.scrubbers[scrubber_key].currentnum, index,scrubber_key);

			});

			self.scrubbers[scrubber_key].draggie.on('dragMove', function () {
				self.update_move(scrubber_key);
			});

			self.scrubbers[scrubber_key].draggie.on('scroll', function () {
				self.update_move(scrubber_key);
			});

			self.updateDataOnFront(scrubber_key);
		},

		updateDataOnFront: function (scrubber_key) {
			var self = window.BuddyBossThemeBbpScrubber;
			var $scrubber = $('.scrubber[data-key="'+scrubber_key+'"]');

			if ( ! $scrubber.length ) {
				return false;
			}

			self.scrubbers[scrubber_key].total = $scrubber.closest('#bbpress-forums').find('.scrubberpost').length;
			$scrubber.find('#currentpost').text(self.scrubbers[scrubber_key].currentnum);
			$scrubber.find('#totalposts').text(self.scrubbers[scrubber_key].total);

			var $current_element = $scrubber.closest('#bbpress-forums').find('.scrubberpost').eq(self.scrubbers[scrubber_key].currentnum-1);
			$scrubber.find('#date').text($current_element.data('date'));
		},

		goToPost: function (post, index, scrubber_key) {
			var self = window.BuddyBossThemeBbpScrubber;

			var $scrubber = $('.scrubber[data-key="'+scrubber_key+'"]');

			if ( ! $scrubber.length ) {
				return false;
			}

			var elements = $scrubber.closest('#bbpress-forums').find('.scrubberpost');

			if (!elements.length) {
				return false;
			}

			self.scrubbers[scrubber_key].total = elements.length;
			self.scrubbers[scrubber_key].currentnum = post;

			if ((post > elements.length) || self.scrubbers[scrubber_key].total !== 1 && post === self.scrubbers[scrubber_key].total) {
				post = self.scrubbers[scrubber_key].total - 1;
				index = 'last';
			} else if (post === 1 && index !== 'last') {
				post = 0;
				index = 'first';
			} else if (post === 1 && index === 'last') {
				post = 0;
			} else {
				post = post - 1;
			}

			if (post === 0) {
				self.scrubbers[scrubber_key].currentnum = post + 1; // update the num depending on last one index.
			} else if (post === self.total) {
				self.scrubbers[scrubber_key].currentnum = self.scrubbers[scrubber_key].total;
			}

			var force = false;
			if (index === 'last') {
				post = self.scrubbers[scrubber_key].total - 1;
			} else if (index === 'first') {
				post = 0;
				force = true;
			}

			self.scrubbers[scrubber_key].onscroll_update = false; // disable on scroll update

			var ele = 0;
			if (typeof elements[post] === 'undefined') {
				ele = elements[elements.length];
			} else {
				ele = elements[post];

				// Highlight Post
				$(ele).parent().addClass('highlight');
			}

			self.update_handle(force,scrubber_key);

			$('html, body').animate({
				scrollTop: $(ele).offset().top - (window.innerHeight / 2)
			}, 600, function () {

				// Remove Post Highlight
				setTimeout(function () {
					$(ele).parent().removeClass('highlight');
					self.scrubbers[scrubber_key].onscroll_update = true; // enable on scroll update
				}, 200);

			});

		},

		update_move: function (scrubber_key) {
			var self = window.BuddyBossThemeBbpScrubber;

			var $scrubber = $('.scrubber[data-key="'+scrubber_key+'"]');

			if ( ! $scrubber.length ) {
				return false;
			}

			self.scrubbers[scrubber_key].total = $scrubber.closest('#bbpress-forums').find('.scrubberpost').length;
			self.scrubbers[scrubber_key].scrubber_height_usable = self.scrubbers[scrubber_key].scrubber_height - $scrubber.find('#handle').outerHeight();

			// calculating correct y pos of handler.
			var total_val = self.scrubbers[scrubber_key].scrubber_height_usable;
			var transform_top = $scrubber.find('#handle')[0].style.transform.split(',')[1];
			transform_top = typeof transform_top !== 'undefined' ? transform_top : 0;
			var correct_y = parseFloat($scrubber.find('#handle')[0].style.top) + parseFloat(transform_top);
			var each_row_size = parseFloat(total_val / self.scrubbers[scrubber_key].total);

			for (var i = 1; i <= self.scrubbers[scrubber_key].total; i++) {

				if (
					(each_row_size * i) > correct_y &&
					(each_row_size * (i - 1)) < correct_y
				) {
					self.scrubbers[scrubber_key].currentnum = i; // update current screen.
					self.updateDataOnFront(scrubber_key);
				}

			}

		},

		/**
		 * update position of handle depending on current num.
		 */
		update_handle: function (force,scrubber_key) {

			var self = window.BuddyBossThemeBbpScrubber;
			var $scrubber = $('.scrubber[data-key="'+scrubber_key+'"]');

			if ( ! $scrubber.length ) {
				return false;
			}

			var handle = $scrubber.find('#handle');

			if (!handle.length) {
				return false;
			}

			self.updateDataOnFront(scrubber_key);
			self.scrubbers[scrubber_key].scrubber_height_usable = self.scrubbers[scrubber_key].scrubber_height - handle.outerHeight();

			var total_val = self.scrubbers[scrubber_key].scrubber_height_usable;
			var each_row_size = total_val / self.scrubbers[scrubber_key].total;
			if (self.scrubbers[scrubber_key].currentnum === 1 && (self.scrubbers[scrubber_key].total !== 1 || force)) {
				each_row_size = 0;
			}

			handle.addClass('animate');
			handle.css('top', each_row_size * (self.scrubbers[scrubber_key].currentnum) + 'px');

			clearTimeout(self.scrubbers[scrubber_key].handleani);
			self.scrubbers[scrubber_key].handleani = setTimeout(function () {
				if (!handle.length) {
					handle.removeClass('animate');
				}
			}, 2000);

		},

		onScrubberScroll: function () {
			var self = window.BuddyBossThemeBbpScrubber;

			var $scrubbers = $('.scrubber');

			$scrubbers.each(function(j,scrubber){
				var scrubber_key = $(scrubber).data('key');

				// if scroll update if false by force then don't do anything
				if (!self.scrubbers[scrubber_key].onscroll_update) {
					return false;
				}

				var elements = $(scrubber).closest('#bbpress-forums').find('.scrubberpost');

				if (!elements.length) {
					return false;
				}

				// check if scroll is less than first element, set to first element
				if ((window.scrollY + window.innerHeight.height / 2) < elements[0].getBoundingClientRect().y || window.scrollY === 0) {
					self.scrubbers[scrubber_key].currentnum = 1;
					self.update_handle(true,scrubber_key);
					return false;
				}

				// check if document scroll height is matched with current scroll, set to last element
				if ((window.scrollY + window.innerHeight) >= document.body.scrollHeight ) {
					self.scrubbers[scrubber_key].currentnum = self.scrubbers[scrubber_key].total;
					var force = self.scrubbers[scrubber_key].total === 1 ? false : true;
					self.update_handle(force,scrubber_key);
					return false;
				}

				// check all elements top position and return element which has top less than half of window height
				var inViewLast = self.scrubbers[scrubber_key].currentnum;
				var update = false;
				for (var i = 0; i < elements.length; i++) {
					if (elements[i].getBoundingClientRect().y < (window.innerHeight / 2)) {
						update = true;
						inViewLast = i; // always overwrite so store last.
					}
				}

				// if return number is more than total element on page, return last
				if ((inViewLast + 1) > self.scrubbers[scrubber_key].total) {
					inViewLast = self.scrubbers[scrubber_key].total - 1;
				}

				if (update) {
					self.scrubbers[scrubber_key].currentnum = inViewLast + 1; // update the num depending on last one index.
					self.update_handle(false,scrubber_key);
				}
			});
		}

	};

	$(document).on('ready', function () {
		window.BuddyBossThemeBbpScrubber.init();
	});

})(jQuery);
