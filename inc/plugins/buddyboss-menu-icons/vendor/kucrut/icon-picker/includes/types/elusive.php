<?php
/**
 * Elusive Icons
 *
 * @package Icon_Picker
 * @author  Dzikri Aziz <kvcrvt@gmail.com>
 */
class Icon_Picker_Type_Elusive extends Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $id = 'elusive';

	/**
	 * Icon type name
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $name = 'Elusive';

	/**
	 * Icon type version
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $version = '2.0';


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
				'id'   => 'currency',
				'name' => __( 'Currency', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'media',
				'name' => __( 'Media', 'buddyboss-theme' ),
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
				'id'    => 'el-icon-adjust',
				'name'  => __( 'Adjust', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-adjust-alt',
				'name'  => __( 'Adjust', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-left',
				'name'  => __( 'Align Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-center',
				'name'  => __( 'Align Center', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-right',
				'name'  => __( 'Align Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-align-justify',
				'name'  => __( 'Justify', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-up',
				'name'  => __( 'Arrow Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-down',
				'name'  => __( 'Arrow Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-left',
				'name'  => __( 'Arrow Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-arrow-right',
				'name'  => __( 'Arrow Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fast-backward',
				'name'  => __( 'Fast Backward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-step-backward',
				'name'  => __( 'Step Backward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-backward',
				'name'  => __( 'Backward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-forward',
				'name'  => __( 'Forward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-forward-alt',
				'name'  => __( 'Forward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-step-forward',
				'name'  => __( 'Step Forward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fast-forward',
				'name'  => __( 'Fast Forward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-bold',
				'name'  => __( 'Bold', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-italic',
				'name'  => __( 'Italic', 'buddyboss-theme' ),
			),
			array(
				'group' => 'c',
				'id'    => 'el-icon-link',
				'name'  => __( 'Link', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-up',
				'name'  => __( 'Caret Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-down',
				'name'  => __( 'Caret Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-left',
				'name'  => __( 'Caret Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-caret-right',
				'name'  => __( 'Caret Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-check',
				'name'  => __( 'Check', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-check-empty',
				'name'  => __( 'Check Empty', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-up',
				'name'  => __( 'Chevron Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-down',
				'name'  => __( 'Chevron Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-left',
				'name'  => __( 'Chevron Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-chevron-right',
				'name'  => __( 'Chevron Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-up',
				'name'  => __( 'Circle Arrow Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-down',
				'name'  => __( 'Circle Arrow Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-left',
				'name'  => __( 'Circle Arrow Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-circle-arrow-right',
				'name'  => __( 'Circle Arrow Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-download',
				'name'  => __( 'Download', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-download-alt',
				'name'  => __( 'Download', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-edit',
				'name'  => __( 'Edit', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-eject',
				'name'  => __( 'Eject', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-new',
				'name'  => __( 'File New', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-new-alt',
				'name'  => __( 'File New', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-edit',
				'name'  => __( 'File Edit', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-file-edit-alt',
				'name'  => __( 'File Edit', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fork',
				'name'  => __( 'Fork', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-fullscreen',
				'name'  => __( 'Fullscreen', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-indent-left',
				'name'  => __( 'Indent Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-indent-right',
				'name'  => __( 'Indent Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-list',
				'name'  => __( 'List', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-list-alt',
				'name'  => __( 'List', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-lock',
				'name'  => __( 'Lock', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-lock-alt',
				'name'  => __( 'Lock', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-unlock',
				'name'  => __( 'Unlock', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-unlock-alt',
				'name'  => __( 'Unlock', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-map-marker',
				'name'  => __( 'Map Marker', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-map-marker-alt',
				'name'  => __( 'Map Marker', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-minus',
				'name'  => __( 'Minus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-minus-sign',
				'name'  => __( 'Minus Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-move',
				'name'  => __( 'Move', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-off',
				'name'  => __( 'Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok',
				'name'  => __( 'OK', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok-circle',
				'name'  => __( 'OK Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-ok-sign',
				'name'  => __( 'OK Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-play',
				'name'  => __( 'Play', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-play-alt',
				'name'  => __( 'Play', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-pause',
				'name'  => __( 'Pause', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-pause-alt',
				'name'  => __( 'Pause', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-stop',
				'name'  => __( 'Stop', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-stop-alt',
				'name'  => __( 'Stop', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-plus',
				'name'  => __( 'Plus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-plus-sign',
				'name'  => __( 'Plus Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-print',
				'name'  => __( 'Print', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-question',
				'name'  => __( 'Question', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-question-sign',
				'name'  => __( 'Question Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-record',
				'name'  => __( 'Record', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-refresh',
				'name'  => __( 'Refresh', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-remove',
				'name'  => __( 'Remove', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-repeat',
				'name'  => __( 'Repeat', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-repeat-alt',
				'name'  => __( 'Repeat', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-vertical',
				'name'  => __( 'Resize Vertical', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-horizontal',
				'name'  => __( 'Resize Horizontal', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-full',
				'name'  => __( 'Resize Full', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-resize-small',
				'name'  => __( 'Resize Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-return-key',
				'name'  => __( 'Return', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-retweet',
				'name'  => __( 'Retweet', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-reverse-alt',
				'name'  => __( 'Reverse', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-search',
				'name'  => __( 'Search', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-search-alt',
				'name'  => __( 'Search', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-share',
				'name'  => __( 'Share', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-share-alt',
				'name'  => __( 'Share', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tag',
				'name'  => __( 'Tag', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tasks',
				'name'  => __( 'Tasks', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-text-height',
				'name'  => __( 'Text Height', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-text-width',
				'name'  => __( 'Text Width', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-thumbs-up',
				'name'  => __( 'Thumbs Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-thumbs-down',
				'name'  => __( 'Thumbs Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-tint',
				'name'  => __( 'Tint', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-trash',
				'name'  => __( 'Trash', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-trash-alt',
				'name'  => __( 'Trash', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-upload',
				'name'  => __( 'Upload', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-view-mode',
				'name'  => __( 'View Mode', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-up',
				'name'  => __( 'Volume Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-down',
				'name'  => __( 'Volume Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-volume-off',
				'name'  => __( 'Mute', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-warning-sign',
				'name'  => __( 'Warning Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-zoom-in',
				'name'  => __( 'Zoom In', 'buddyboss-theme' ),
			),
			array(
				'group' => 'actions',
				'id'    => 'el-icon-zoom-out',
				'name'  => __( 'Zoom Out', 'buddyboss-theme' ),
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-eur',
				'name'  => 'EUR',
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-gbp',
				'name'  => 'GBP',
			),
			array(
				'group' => 'currency',
				'id'    => 'el-icon-usd',
				'name'  => 'USD',
			),
			array(
				'group' => 'media',
				'id'    => 'el-icon-video',
				'name'  => __( 'Video', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'el-icon-video-alt',
				'name'  => __( 'Video', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-adult',
				'name'  => __( 'Adult', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-address-book',
				'name'  => __( 'Address Book', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-address-book-alt',
				'name'  => __( 'Address Book', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-asl',
				'name'  => __( 'ASL', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-asterisk',
				'name'  => __( 'Asterisk', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-ban-circle',
				'name'  => __( 'Ban Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-barcode',
				'name'  => __( 'Barcode', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bell',
				'name'  => __( 'Bell', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-blind',
				'name'  => __( 'Blind', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-book',
				'name'  => __( 'Book', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-braille',
				'name'  => __( 'Braille', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-briefcase',
				'name'  => __( 'Briefcase', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-broom',
				'name'  => __( 'Broom', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-brush',
				'name'  => __( 'Brush', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bulb',
				'name'  => __( 'Bulb', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-bullhorn',
				'name'  => __( 'Bullhorn', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-calendar',
				'name'  => __( 'Calendar', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-calendar-sign',
				'name'  => __( 'Calendar Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-camera',
				'name'  => __( 'Camera', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-car',
				'name'  => __( 'Car', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cc',
				'name'  => __( 'CC', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-certificate',
				'name'  => __( 'Certificate', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-child',
				'name'  => __( 'Child', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cog',
				'name'  => __( 'Cog', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cog-alt',
				'name'  => __( 'Cog', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-cogs',
				'name'  => __( 'Cogs', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-comment',
				'name'  => __( 'Comment', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-comment-alt',
				'name'  => __( 'Comment', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-compass',
				'name'  => __( 'Compass', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-compass-alt',
				'name'  => __( 'Compass', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-credit-card',
				'name'  => __( 'Credit Card', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-css',
				'name'  => 'CSS',
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-envelope',
				'name'  => __( 'Envelope', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-envelope-alt',
				'name'  => __( 'Envelope', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-error',
				'name'  => __( 'Error', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-error-alt',
				'name'  => __( 'Error', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-exclamation-sign',
				'name'  => __( 'Exclamation Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-eye-close',
				'name'  => __( 'Eye Close', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-eye-open',
				'name'  => __( 'Eye Open', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-male',
				'name'  => __( 'Male', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-female',
				'name'  => __( 'Female', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-file',
				'name'  => __( 'File', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-file-alt',
				'name'  => __( 'File', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-film',
				'name'  => __( 'Film', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-filter',
				'name'  => __( 'Filter', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-fire',
				'name'  => __( 'Fire', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-flag',
				'name'  => __( 'Flag', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-flag-alt',
				'name'  => __( 'Flag', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder',
				'name'  => __( 'Folder', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-open',
				'name'  => __( 'Folder Open', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-close',
				'name'  => __( 'Folder Close', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-folder-sign',
				'name'  => __( 'Folder Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-font',
				'name'  => __( 'Font', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-fontsize',
				'name'  => __( 'Font Size', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-gift',
				'name'  => __( 'Gift', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-glass',
				'name'  => __( 'Glass', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-glasses',
				'name'  => __( 'Glasses', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-globe',
				'name'  => __( 'Globe', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-globe-alt',
				'name'  => __( 'Globe', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-graph',
				'name'  => __( 'Graph', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-graph-alt',
				'name'  => __( 'Graph', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-group',
				'name'  => __( 'Group', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-group-alt',
				'name'  => __( 'Group', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-guidedog',
				'name'  => __( 'Guide Dog', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-up',
				'name'  => __( 'Hand Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-down',
				'name'  => __( 'Hand Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-left',
				'name'  => __( 'Hand Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hand-right',
				'name'  => __( 'Hand Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hdd',
				'name'  => __( 'HDD', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-headphones',
				'name'  => __( 'Headphones', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hearing-impaired',
				'name'  => __( 'Hearing Impaired', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart',
				'name'  => __( 'Heart', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart-alt',
				'name'  => __( 'Heart', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-heart-empty',
				'name'  => __( 'Heart Empty', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-hourglass',
				'name'  => __( 'Hourglass', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-idea',
				'name'  => __( 'Idea', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-idea-alt',
				'name'  => __( 'Idea', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox',
				'name'  => __( 'Inbox', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox-alt',
				'name'  => __( 'Inbox', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-inbox-box',
				'name'  => __( 'Inbox', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-info-sign',
				'name'  => __( 'Info', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-key',
				'name'  => __( 'Key', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-laptop',
				'name'  => __( 'Laptop', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-laptop-alt',
				'name'  => __( 'Laptop', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-leaf',
				'name'  => __( 'Leaf', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-lines',
				'name'  => __( 'Lines', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-magic',
				'name'  => __( 'Magic', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-magnet',
				'name'  => __( 'Magnet', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-mic',
				'name'  => __( 'Mic', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-music',
				'name'  => __( 'Music', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-paper-clip',
				'name'  => __( 'Paper Clip', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-paper-clip-alt',
				'name'  => __( 'Paper Clip', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-pencil',
				'name'  => __( 'Pencil', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-pencil-alt',
				'name'  => __( 'Pencil', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-person',
				'name'  => __( 'Person', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-phone',
				'name'  => __( 'Phone', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-phone-alt',
				'name'  => __( 'Phone', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-photo',
				'name'  => __( 'Photo', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-photo-alt',
				'name'  => __( 'Photo', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-picture',
				'name'  => __( 'Picture', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-plane',
				'name'  => __( 'Plane', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-podcast',
				'name'  => __( 'Podcast', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-puzzle',
				'name'  => __( 'Puzzle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-qrcode',
				'name'  => __( 'QR Code', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-quotes',
				'name'  => __( 'Quotes', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-quotes-alt',
				'name'  => __( 'Quotes', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-random',
				'name'  => __( 'Random', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-scissors',
				'name'  => __( 'Scissors', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screen',
				'name'  => __( 'Screen', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screen-alt',
				'name'  => __( 'Screen', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-screenshot',
				'name'  => __( 'Screenshot', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-shopping-cart',
				'name'  => __( 'Shopping Cart', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-shopping-cart-sign',
				'name'  => __( 'Shopping Cart Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-signal',
				'name'  => __( 'Signal', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-smiley',
				'name'  => __( 'Smiley', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-smiley-alt',
				'name'  => __( 'Smiley', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-speaker',
				'name'  => __( 'Speaker', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-user',
				'name'  => __( 'User', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th',
				'name'  => __( 'Thumbnails', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th-large',
				'name'  => __( 'Thumbnails (Large)', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-th-list',
				'name'  => __( 'Thumbnails (List)', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-time',
				'name'  => __( 'Time', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-time-alt',
				'name'  => __( 'Time', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-torso',
				'name'  => __( 'Torso', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wheelchair',
				'name'  => __( 'Wheelchair', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wrench',
				'name'  => __( 'Wrench', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-wrench-alt',
				'name'  => __( 'Wrench', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'el-icon-universal-access',
				'name'  => __( 'Universal Access', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-bookmark',
				'name'  => __( 'Bookmark', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-bookmark-empty',
				'name'  => __( 'Bookmark Empty', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-dashboard',
				'name'  => __( 'Dashboard', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-home',
				'name'  => __( 'Home', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-home-alt',
				'name'  => __( 'Home', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-iphone-home',
				'name'  => __( 'Home (iPhone)', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-network',
				'name'  => __( 'Network', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-tags',
				'name'  => __( 'Tags', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-website',
				'name'  => __( 'Website', 'buddyboss-theme' ),
			),
			array(
				'group' => 'places',
				'id'    => 'el-icon-website-alt',
				'name'  => __( 'Website', 'buddyboss-theme' ),
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-behance',
				'name'  => 'Behance',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-blogger',
				'name'  => 'Blogger',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-cloud',
				'name'  => __( 'Cloud', 'buddyboss-theme' ),
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-cloud-alt',
				'name'  => __( 'Cloud', 'buddyboss-theme' ),
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-delicious',
				'name'  => 'Delicious',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-deviantart',
				'name'  => 'DeviantArt',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-digg',
				'name'  => 'Digg',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-dribbble',
				'name'  => 'Dribbble',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-facebook',
				'name'  => 'Facebook',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-facetime-video',
				'name'  => 'Facetime Video',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-flickr',
				'name'  => 'Flickr',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-foursquare',
				'name'  => 'Foursquare',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-friendfeed',
				'name'  => 'FriendFeed',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-friendfeed-rect',
				'name'  => 'FriendFeed',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-github',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-github-text',
				'name'  => 'GitHub',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-googleplus',
				'name'  => 'Google+',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-instagram',
				'name'  => 'Instagram',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-lastfm',
				'name'  => 'Last.fm',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-linkedin',
				'name'  => 'LinkedIn',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-livejournal',
				'name'  => 'LiveJournal',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-myspace',
				'name'  => 'MySpace',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-opensource',
				'name'  => __( 'Open Source', 'buddyboss-theme' ),
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-path',
				'name'  => 'path',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-picasa',
				'name'  => 'Picasa',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-pinterest',
				'name'  => 'Pinterest',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-rss',
				'name'  => 'RSS',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-reddit',
				'name'  => 'Reddit',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-skype',
				'name'  => 'Skype',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-slideshare',
				'name'  => 'Slideshare',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-soundcloud',
				'name'  => 'SoundCloud',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-spotify',
				'name'  => 'Spotify',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-stackoverflow',
				'name'  => 'Stack Overflow',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-stumbleupon',
				'name'  => 'StumbleUpon',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-twitter',
				'name'  => 'Twitter',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-tumblr',
				'name'  => 'Tumblr',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-viadeo',
				'name'  => 'Viadeo',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-vimeo',
				'name'  => 'Vimeo',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-vkontakte',
				'name'  => 'VKontakte',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-w3c',
				'name'  => 'W3C',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-wordpress',
				'name'  => 'WordPress',
			),
			array(
				'group' => 'social',
				'id'    => 'el-icon-youtube',
				'name'  => 'YouTube',
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
