<?php
/**
 * Genericons
 *
 * @package Icon_Picker
 * @author  Dzikri Aziz <kvcrvt@gmail.com>
 */
class Icon_Picker_Type_Genericons extends Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $id = 'genericon';

	/**
	 * Icon type name
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $name = 'Genericons';

	/**
	 * Icon type version
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $version = '3.4';

	/**
	 * Stylesheet ID
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $stylesheet_id = 'genericons';


	/**
	 * Get icon groups
	 *
	 * @since Menu Icons 0.1.0
	 * @return array
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'actions',
				'name' => __( 'Actions', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'media-player',
				'name' => __( 'Media Player', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'meta',
				'name' => __( 'Meta', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'misc',
				'name' => __( 'Misc.', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'places',
				'name' => __( 'Places', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'post-formats',
				'name' => __( 'Post Formats', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'text-editor',
				'name' => __( 'Text Editor', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'social',
				'name' => __( 'Social', 'buddyboss-theme' ),
			),
		);

		/**
		 * Filter genericon groups
		 *
		 * @since 0.1.0
		 * @param array $groups Icon groups.
		 */
		$groups = apply_filters( 'icon_picker_genericon_groups', $groups );

		return $groups;
	}


	/**
	 * Get icon names
	 *
	 * @since Menu Icons 0.1.0
	 * @return array
	 */
	public function get_items() {
		$items = array(
			array(
				'group' => 'actions',
				'id'    => 'genericon-checkmark',
				'name'  => __( 'Checkmark', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-close',
				'name'  => __( 'Close', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-close-alt',
				'name'  => __( 'Close', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-dropdown',
				'name'  => __( 'Dropdown', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-dropdown-left',
				'name'  => __( 'Dropdown left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-collapse',
				'name'  => __( 'Collapse', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-expand',
				'name'  => __( 'Expand', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-help',
				'name'  => __( 'Help', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-info',
				'name'  => __( 'Info', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-lock',
				'name'  => __( 'Lock', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-maximize',
				'name'  => __( 'Maximize', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-minimize',
				'name'  => __( 'Minimize', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-plus',
				'name'  => __( 'Plus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-minus',
				'name'  => __( 'Minus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-previous',
				'name'  => __( 'Previous', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-next',
				'name'  => __( 'Next', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-move',
				'name'  => __( 'Move', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-hide',
				'name'  => __( 'Hide', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-show',
				'name'  => __( 'Show', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-print',
				'name'  => __( 'Print', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-empty',
				'name'  => __( 'Rating: Empty', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-half',
				'name'  => __( 'Rating: Half', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-rating-full',
				'name'  => __( 'Rating: Full', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-refresh',
				'name'  => __( 'Refresh', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply',
				'name'  => __( 'Reply', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply-alt',
				'name'  => __( 'Reply alt', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-reply-single',
				'name'  => __( 'Reply single', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-search',
				'name'  => __( 'Search', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-send-to-phone',
				'name'  => __( 'Send to', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-send-to-tablet',
				'name'  => __( 'Send to', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-share',
				'name'  => __( 'Share', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-shuffle',
				'name'  => __( 'Shuffle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-spam',
				'name'  => __( 'Spam', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-subscribe',
				'name'  => __( 'Subscribe', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-subscribed',
				'name'  => __( 'Subscribed', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unsubscribe',
				'name'  => __( 'Unsubscribe', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-top',
				'name'  => __( 'Top', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unapprove',
				'name'  => __( 'Unapprove', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-zoom',
				'name'  => __( 'Zoom', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-unzoom',
				'name'  => __( 'Unzoom', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'genericon-xpost',
				'name'  => __( 'X-Post', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-skip-back',
				'name'  => __( 'Skip back', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-rewind',
				'name'  => __( 'Rewind', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-play',
				'name'  => __( 'Play', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-pause',
				'name'  => __( 'Pause', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-stop',
				'name'  => __( 'Stop', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-fastforward',
				'name'  => __( 'Fast Forward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media-player',
				'id'    => 'genericon-skip-ahead',
				'name'  => __( 'Skip ahead', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-comment',
				'name'  => __( 'Comment', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-category',
				'name'  => __( 'Category', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-hierarchy',
				'name'  => __( 'Hierarchy', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-tag',
				'name'  => __( 'Tag', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-time',
				'name'  => __( 'Time', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-user',
				'name'  => __( 'User', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-day',
				'name'  => __( 'Day', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-week',
				'name'  => __( 'Week', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-month',
				'name'  => __( 'Month', 'buddyboss-theme' ),
			),
			array(
				'group' => 'meta',
				'id'    => 'genericon-pinned',
				'name'  => __( 'Pinned', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-uparrow',
				'name'  => __( 'Arrow Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-downarrow',
				'name'  => __( 'Arrow Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-leftarrow',
				'name'  => __( 'Arrow Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-rightarrow',
				'name'  => __( 'Arrow Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-activity',
				'name'  => __( 'Activity', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-bug',
				'name'  => __( 'Bug', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-book',
				'name'  => __( 'Book', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cart',
				'name'  => __( 'Cart', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cloud-download',
				'name'  => __( 'Cloud Download', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cloud-upload',
				'name'  => __( 'Cloud Upload', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-cog',
				'name'  => __( 'Cog', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-document',
				'name'  => __( 'Document', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-dot',
				'name'  => __( 'Dot', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-download',
				'name'  => __( 'Download', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-draggable',
				'name'  => __( 'Draggable', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-ellipsis',
				'name'  => __( 'Ellipsis', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-external',
				'name'  => __( 'External', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-feed',
				'name'  => __( 'Feed', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-flag',
				'name'  => __( 'Flag', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-fullscreen',
				'name'  => __( 'Fullscreen', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-handset',
				'name'  => __( 'Handset', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-heart',
				'name'  => __( 'Heart', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-key',
				'name'  => __( 'Key', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-mail',
				'name'  => __( 'Mail', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-menu',
				'name'  => __( 'Menu', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-microphone',
				'name'  => __( 'Microphone', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-notice',
				'name'  => __( 'Notice', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-paintbrush',
				'name'  => __( 'Paint Brush', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-phone',
				'name'  => __( 'Phone', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-picture',
				'name'  => __( 'Picture', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-plugin',
				'name'  => __( 'Plugin', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-portfolio',
				'name'  => __( 'Portfolio', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-star',
				'name'  => __( 'Star', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-summary',
				'name'  => __( 'Summary', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-tablet',
				'name'  => __( 'Tablet', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-videocamera',
				'name'  => __( 'Video Camera', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'genericon-warning',
				'name'  => __( 'Warning', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-404',
				'name'  => __( '404', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-trash',
				'name'  => __( 'Trash', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-cloud',
				'name'  => __( 'Cloud', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-home',
				'name'  => __( 'Home', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-location',
				'name'  => __( 'Location', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-sitemap',
				'name'  => __( 'Sitemap', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'genericon-website',
				'name'  => __( 'Website', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-standard',
				'name'  => __( 'Standard', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-aside',
				'name'  => __( 'Aside', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-image',
				'name'  => __( 'Image', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-gallery',
				'name'  => __( 'Gallery', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-video',
				'name'  => __( 'Video', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-status',
				'name'  => __( 'Status', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-quote',
				'name'  => __( 'Quote', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-link',
				'name'  => __( 'Link', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-chat',
				'name'  => __( 'Chat', 'buddyboss-theme' ),
			),
			array(
				'group' => 'post-formats',
				'id'    => 'genericon-audio',
				'name'  => __( 'Audio', 'buddyboss-theme' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-anchor',
				'name'  => __( 'Anchor', 'buddyboss-theme' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-attachment',
				'name'  => __( 'Attachment', 'buddyboss-theme' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-edit',
				'name'  => __( 'Edit', 'buddyboss-theme' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-code',
				'name'  => __( 'Code', 'buddyboss-theme' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-bold',
				'name'  => __( 'Bold', 'buddyboss-theme' ),
			),
			array(
				'group' => 'text-editor',
				'id'    => 'genericon-italic',
				'name'  => __( 'Italic', 'buddyboss-theme' ),
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-codepen',
				'name'  => 'CodePen',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-dribbble',
				'name'  => 'Dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-dropbox',
				'name'  => 'DropBox',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-facebook-alt',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-flickr',
				'name'  => 'Flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-googleplus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-googleplus-alt',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-linkedin-alt',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-path',
				'name'  => 'Path',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pinterest-alt',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-pocket',
				'name'  => 'Pocket',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-polldaddy',
				'name'  => 'PollDaddy',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-reddit',
				'name'  => 'Reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-twitch',
				'name'  => 'Twitch',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-vimeo',
				'name'  => 'Vimeo',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-wordpress',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'social',
				'id'    => 'genericon-youtube',
				'name'  => 'Youtube',
			),
		);

		/**
		 * Filter genericon items
		 *
		 * @since 0.1.0
		 * @param array $items Icon names.
		 */
		$items = apply_filters( 'icon_picker_genericon_items', $items );

		return $items;
	}
}
