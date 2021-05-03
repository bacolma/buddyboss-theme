<?php

require_once dirname( __FILE__ ) . '/font.php';

/**
 * BuddyBoss Icons
 *
 * @package Icon_Picker
 * @author  Dzikri Aziz <kvcrvt@gmail.com>
 */
class Icon_Picker_Type_BuddyBoss extends Icon_Picker_Type_Font {

	/**
	 * Icon type ID
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $id = 'buddyboss';

	/**
	 * Icon type name
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $name = 'BuddyBoss';

	/**
	 * Icon type version
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $version = '1.0';

	/**
	 * Get icon groups
	 *
	 * @since Menu Icons 0.1.0
	 * @return array
	 */
	public function get_groups() {
		$groups = array(
			array(
				'id'   => 'alert',
				'name' => __( 'Alerts', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'arrow',
				'name' => __( 'Arrows', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'brand',
				'name' => __( 'Brands', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'chart',
				'name' => __( 'Charts', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'cloud',
				'name' => __( 'Cloud', 'buddyboss-theme' ),
			),
            array(
				'id'   => 'courses',
				'name' => __( 'Courses', 'buddyboss-theme' ),
			),
            array(
				'id'   => 'device',
				'name' => __( 'Devices', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'file',
				'name' => __( 'File Types', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'format',
				'name' => __( 'Formatting', 'buddyboss-theme' ),
			),
            array(
				'id'   => 'control',
				'name' => __( 'Form Controls', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'map',
				'name' => __( 'Maps', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'media',
				'name' => __( 'Media Player', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'misc',
				'name' => __( 'Misc.', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'nature',
				'name' => __( 'Nature', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'phone',
				'name' => __( 'Phone Calls', 'buddyboss-theme' ),
			),
			array(
				'id'   => 'web',
				'name' => __( 'Web Application', 'buddyboss-theme' ),
			)
		);

		/**
		 * Filter buddyboss groups
		 *
		 * @since 0.1.0
		 *
		 * @param array $groups Icon groups.
		 */
		$groups = apply_filters( 'icon_picker_buddyboss_groups', $groups );

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
				'group' => 'web',
				'id'    => 'bb-icon-activity',
				'name'  => __( 'Activity', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-airplay',
				'name'  => __( 'Airplay', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-alert-exclamation',
				'name'  => __( 'Alert: Exclamation', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-alert-octagon',
				'name'  => __( 'Alert: Octagon', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-alert-question',
				'name'  => __( 'Alert: Question', 'buddyboss-theme' ),
			),
            array(
				'group' => 'alert',
				'id'    => 'bb-icon-alert-thin',
				'name'  => __( 'Alert: Thin', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-alert-triangle',
				'name'  => __( 'Alert: Triangle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-align-center',
				'name'  => __( 'Align: Center', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-align-justify',
				'name'  => __( 'Align: Justify', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-align-left',
				'name'  => __( 'Align: Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-align-right',
				'name'  => __( 'Align: Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-anchor',
				'name'  => __( 'Anchor', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-angle-down',
				'name'  => __( 'Angle: Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-angle-left',
				'name'  => __( 'Angle: Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-angle-right',
				'name'  => __( 'Angle: Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-aperture',
				'name'  => __( 'Aperture', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-up-square',
				'name'  => __( 'Arrow Up: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-circle',
				'name'  => __( 'Arrow: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-down-left',
				'name'  => __( 'Arrow: Down Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-down-right',
				'name'  => __( 'Arrow: Down Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-down',
				'name'  => __( 'Arrow: Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-left',
				'name'  => __( 'Arrow: Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-right',
				'name'  => __( 'Arrow: Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-up-left',
				'name'  => __( 'Arrow: Up Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-up-right',
				'name'  => __( 'Arrow: Up Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-arrow-up',
				'name'  => __( 'Arrow: Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-at-sign',
				'name'  => __( 'At Sign', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-award',
				'name'  => __( 'Award', 'buddyboss-theme' ),
			),
            array(
				'group' => 'courses',
				'id'    => 'bb-icon-badge',
				'name'  => __( 'Badge', 'buddyboss-theme' ),
			),
            array(
				'group' => 'misc',
				'id'    => 'bb-icon-badge-tall',
				'name'  => __( 'Badge: Tall', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-ball-soccer',
				'name'  => __( 'Ball: Soccer', 'buddyboss-theme' ),
			),
			array(
				'group' => 'chart',
				'id'    => 'bb-icon-bar-chart',
				'name'  => __( 'Bar Chart', 'buddyboss-theme' ),
			),
			array(
				'group' => 'chart',
				'id'    => 'bb-icon-bar-chart-square',
				'name'  => __( 'Bar Chart: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'chart',
				'id'    => 'bb-icon-bar-chart-up',
				'name'  => __( 'Bar Chart: Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-battery',
				'name'  => __( 'Battery', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-battery-charging',
				'name'  => __( 'Battery: Charging', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-bell',
				'name'  => __( 'Bell', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-bell-off',
				'name'  => __( 'Bell: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-bell-plus',
				'name'  => __( 'Bell: Plus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-bell-small',
				'name'  => __( 'Bell: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-bluetooth',
				'name'  => __( 'Bluetooth', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-board',
				'name'  => __( 'Board', 'buddyboss-theme' ),
			),
            array(
				'group' => 'misc',
				'id'    => 'bb-icon-board-list',
				'name'  => __( 'Board: List', 'buddyboss-theme' ),
			),
            array(
				'group' => 'misc',
				'id'    => 'bb-icon-board-box',
				'name'  => __( 'Board: Box', 'buddyboss-theme' ),
			),
            array(
				'group' => 'misc',
				'id'    => 'bb-icon-board-code',
				'name'  => __( 'Board: Code', 'buddyboss-theme' ),
			),
            array(
				'group' => 'misc',
				'id'    => 'bb-icon-board-list',
				'name'  => __( 'Board: List', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-bold',
				'name'  => __( 'Bold', 'buddyboss-theme' ),
			),
			array(
				'group' => 'courses',
				'id'    => 'bb-icon-book',
				'name'  => __( 'Book', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-book-open',
				'name'  => __( 'Book: Open', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-book-round',
				'name'  => __( 'Book: Round', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-bookmark',
				'name'  => __( 'Bookmark', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-bookmark-small-fill',
				'name'  => __( 'Bookmark: Small-Fill', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-bookmark-small',
				'name'  => __( 'Bookmark: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-box',
				'name'  => __( 'Box', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-briefcase',
				'name'  => __( 'Briefcase', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-bulb',
				'name'  => __( 'Bulb', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-list-view',
				'name'  => __( 'Bulleted List', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-calendar',
				'name'  => __( 'Calendar', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-calendar-small',
				'name'  => __( 'Calendar: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-camera',
				'name'  => __( 'Camera', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-camera-off',
				'name'  => __( 'Camera: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-camera-small',
				'name'  => __( 'Camera: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-car-small',
				'name'  => __( 'Car: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-cast',
				'name'  => __( 'Cast', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-chat',
				'name'  => __( 'Chat', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-check',
				'name'  => __( 'Check', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-check-square-small',
				'name'  => __( 'Check: Square-Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-check-circle',
				'name'  => __( 'Check: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-check-small',
				'name'  => __( 'Check: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-check-square',
				'name'  => __( 'Check: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-chevron-down',
				'name'  => __( 'Chevron: Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-chevron-left',
				'name'  => __( 'Chevron: Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-chevron-right',
				'name'  => __( 'Chevron: Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-chevron-up',
				'name'  => __( 'Chevron: Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-chevrons-down',
				'name'  => __( 'Chevrons: Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-chevrons-left',
				'name'  => __( 'Chevrons: Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-chevrons-right',
				'name'  => __( 'Chevrons: Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-chevrons-up',
				'name'  => __( 'Chevrons: Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-chrome',
				'name'  => __( 'Chrome', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-circle',
				'name'  => __( 'Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-clipboard',
				'name'  => __( 'Clipboard', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-clock',
				'name'  => __( 'Clock', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-clock-small',
				'name'  => __( 'Clock: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-close',
				'name'  => __( 'Close', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-close-circle',
				'name'  => __( 'Close: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'cloud',
				'id'    => 'bb-icon-cloud',
				'name'  => __( 'Cloud', 'buddyboss-theme' ),
			),
			array(
				'group' => 'cloud',
				'id'    => 'bb-icon-cloud-download',
				'name'  => __( 'Cloud: Download', 'buddyboss-theme' ),
			),
			array(
				'group' => 'cloud',
				'id'    => 'bb-icon-cloud-drizzle',
				'name'  => __( 'Cloud: Drizzle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'cloud',
				'id'    => 'bb-icon-cloud-lightning',
				'name'  => __( 'Cloud: Lightning', 'buddyboss-theme' ),
			),
			array(
				'group' => 'cloud',
				'id'    => 'bb-icon-cloud-off',
				'name'  => __( 'Cloud: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'cloud',
				'id'    => 'bb-icon-cloud-rain',
				'name'  => __( 'Cloud: Rain', 'buddyboss-theme' ),
			),
			array(
				'group' => 'cloud',
				'id'    => 'bb-icon-cloud-snow',
				'name'  => __( 'Cloud: Snow', 'buddyboss-theme' ),
			),
			array(
				'group' => 'cloud',
				'id'    => 'bb-icon-cloud-upload',
				'name'  => __( 'Cloud: Upload', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-codepen',
				'name'  => __( 'Codepen', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-command',
				'name'  => __( 'Command', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-comment',
				'name'  => __( 'Comment', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-activity-comment',
				'name'  => __( 'Comment: Activity', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-comment-circle',
				'name'  => __( 'Comment: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-comment-square',
				'name'  => __( 'Comment: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'map',
				'id'    => 'bb-icon-compass',
				'name'  => __( 'Compass', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-connections',
				'name'  => __( 'Connections', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-connection-minus',
				'name'  => __( 'Connection: Minus', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-connection-waiting',
				'name'  => __( 'Connection: Pending', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-connection-remove',
				'name'  => __( 'Connection: Remove', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-connection-request',
				'name'  => __( 'Connection: Request', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-copy',
				'name'  => __( 'Copy', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-corner-down-left',
				'name'  => __( 'Corner: Down Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-corner-down-right',
				'name'  => __( 'Corner: Down Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-corner-left-down',
				'name'  => __( 'Corner: Left Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-corner-left-up',
				'name'  => __( 'Corner: Left Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-corner-right-down',
				'name'  => __( 'Corner: Right Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-corner-right-up',
				'name'  => __( 'Corner: Right Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-corner-up-left',
				'name'  => __( 'Corner: Up Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-corner-up-right',
				'name'  => __( 'Corner: Up Right', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-cpu',
				'name'  => __( 'CPU', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-credit-card',
				'name'  => __( 'Credit Card', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-crop',
				'name'  => __( 'Crop', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-crosshair',
				'name'  => __( 'Crosshair', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-cube',
				'name'  => __( 'Cube', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-delete',
				'name'  => __( 'Delete', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-disc',
				'name'  => __( 'Disc', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-discussion',
				'name'  => __( 'Discussion', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-download',
				'name'  => __( 'Download', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-dribbble',
				'name'  => __( 'Dribbble: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-droplet',
				'name'  => __( 'Droplet', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-edit',
				'name'  => __( 'Edit', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-edit-square-small',
				'name'  => __( 'Edit: Square-Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-edit-square',
				'name'  => __( 'Edit: Square', 'buddyboss-theme' ),
			),
            array(
				'group' => 'format',
				'id'    => 'bb-icon-edit-thin',
				'name'  => __( 'Edit: Thin', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-eye',
				'name'  => __( 'Eye', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-eye-off',
				'name'  => __( 'Eye: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-eye-small',
				'name'  => __( 'Eye: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-facebook',
				'name'  => __( 'Facebook', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-facebook',
				'name'  => __( 'Facebook: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-facebook-small',
				'name'  => __( 'Facebook: Small', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-facebook',
				'name'  => __( 'Facebook: Round', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-fast-forward',
				'name'  => __( 'Fast Forward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-feather',
				'name'  => __( 'Feather', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-file',
				'name'  => __( 'File', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-file-minus',
				'name'  => __( 'File: Minus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-file-plus',
				'name'  => __( 'File: Plus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-file-text',
				'name'  => __( 'File: Text', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-film',
				'name'  => __( 'Film', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-filter',
				'name'  => __( 'Filter', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-flag',
				'name'  => __( 'Flag', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-flickr',
				'name'  => __( 'Flickr: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-flag-small',
				'name'  => __( 'Flag: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-folder',
				'name'  => __( 'Folder', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-forest',
				'name'  => __( 'Forest', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-gear',
				'name'  => __( 'Gear', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-generic',
				'name'  => __( 'Generic', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-gif',
				'name'  => __( 'Gif', 'buddyboss-theme' ),
			),
			array(
				'group' => 'social',
				'id'    => 'bb-icon-github',
				'name'  => __( 'Github', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-gitlab',
				'name'  => __( 'Gitlab', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-globe',
				'name'  => __( 'Globe', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-google-plus',
				'name'  => __( 'Google Plus: Circle', 'buddyboss-theme' ),
			),
			 array(
				'group' => 'courses',
				'id'    => 'bb-icon-graduation-cap',
				'name'  => __( 'Graduation Cap', 'buddyboss-theme' ),
			),
            array(
				'group' => 'format',
				'id'    => 'bb-icon-grid-round',
				'name'  => __( 'Grid Round', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-grid-view-small',
				'name'  => __( 'Grid View: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-grid-view',
				'name'  => __( 'Grid View', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-groups',
				'name'  => __( 'Groups', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-hash',
				'name'  => __( 'Hash', 'buddyboss-theme' ),
			),
			array(
				'group' => 'device',
				'id'    => 'bb-icon-headphones',
				'name'  => __( 'Headphones', 'buddyboss-theme' ),
			),
			array(
				'group' => 'device',
				'id'    => 'bb-icon-headphones-small',
				'name'  => __( 'Headphones: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-heart',
				'name'  => __( 'Heart', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-heart-fill',
				'name'  => __( 'Heart: Fill', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-heart-small',
				'name'  => __( 'Heart: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-help-circle',
				'name'  => __( 'Help: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-home',
				'name'  => __( 'Home', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-home-small',
				'name'  => __( 'Home: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-id-card',
				'name'  => __( 'ID Card', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-image',
				'name'  => __( 'Image', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-image-square',
				'name'  => __( 'Image: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-inbox',
				'name'  => __( 'Inbox', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-inbox-o',
				'name'  => __( 'Inbox: Outline', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-inbox-small',
				'name'  => __( 'Inbox: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-info',
				'name'  => __( 'Info', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-info-circle',
				'name'  => __( 'Info: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-instagram',
				'name'  => __( 'Instagram', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-instagram',
				'name'  => __( 'Instagram: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-italic',
				'name'  => __( 'Italic', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-key',
				'name'  => __( 'Key', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-laugh',
				'name'  => __( 'Laugh', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-layers',
				'name'  => __( 'Layers', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-layout',
				'name'  => __( 'Layout', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-life-buoy',
				'name'  => __( 'Life Buoy', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-like',
				'name'  => __( 'Like', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-link',
				'name'  => __( 'Link', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-link-1',
				'name'  => __( 'Link: 1', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-link-2',
				'name'  => __( 'Link: 2', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-link-3',
				'name'  => __( 'Link: 3', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-external-link',
				'name'  => __( 'Link: External', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-linkedin',
				'name'  => __( 'Linkedin: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-list-view-small',
				'name'  => __( 'List View', 'buddyboss-theme' ),
			),
            array(
				'group' => 'format',
				'id'    => 'bb-icon-list-bookmark',
				'name'  => __( 'List: Bookmark', 'buddyboss-theme' ),
			),
            array(
				'group' => 'format',
				'id'    => 'bb-icon-all-results',
				'name'  => __( 'List: Bullets', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-list-doc',
				'name'  => __( 'List: Doc', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-loader',
				'name'  => __( 'Loader', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-loader-small',
				'name'  => __( 'Loader: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-lock',
				'name'  => __( 'Lock', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-lock-fill',
				'name'  => __( 'Lock: Fill', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-lock-small',
				'name'  => __( 'Lock: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-log-in',
				'name'  => __( 'Log In', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-log-out',
				'name'  => __( 'Log Out', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-mail',
				'name'  => __( 'Mail', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-mail-open',
				'name'  => __( 'Mail: Open', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-mail-small',
				'name'  => __( 'Mail: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'map',
				'id'    => 'bb-icon-map',
				'name'  => __( 'Map', 'buddyboss-theme' ),
			),
			array(
				'group' => 'map',
				'id'    => 'bb-icon-map-pin',
				'name'  => __( 'Map Pin', 'buddyboss-theme' ),
			),
			array(
				'group' => 'map',
				'id'    => 'bb-icon-map-pin-small',
				'name'  => __( 'Map Pin: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-maximize',
				'name'  => __( 'Maximize', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-maximize-square',
				'name'  => __( 'Maximize: Square', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-medium',
				'name'  => __( 'Medium', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-meetup',
				'name'  => __( 'Meetup', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-members',
				'name'  => __( 'Members', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-membership',
				'name'  => __( 'Membership', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-menu-dots-h',
				'name'  => __( 'Menu Dots: Horz', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-menu-dots-v',
				'name'  => __( 'Menu Dots: Vert', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-menu',
				'name'  => __( 'Menu', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-menu-left',
				'name'  => __( 'Menu: Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-mic',
				'name'  => __( 'Mic', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-mic-off',
				'name'  => __( 'Mic: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-minimize',
				'name'  => __( 'Minimize', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-minimize-square',
				'name'  => __( 'Minimize: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-minus',
				'name'  => __( 'Minus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-minus-circle',
				'name'  => __( 'Minus: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-minus-square',
				'name'  => __( 'Minus: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'device',
				'id'    => 'bb-icon-monitor',
				'name'  => __( 'Monitor', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-moon',
				'name'  => __( 'Moon', 'buddyboss-theme' ),
			),
            array(
				'group' => 'nature',
				'id'    => 'bb-icon-moon-circle',
				'name'  => __( 'Moon: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-more-h',
				'name'  => __( 'More: Horz', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-more-v',
				'name'  => __( 'More: Vert', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-move',
				'name'  => __( 'Move', 'buddyboss-theme' ),
			),
			array(
				'group' => 'file',
				'id'    => 'bb-icon-music',
				'name'  => __( 'Music', 'buddyboss-theme' ),
			),
			array(
				'group' => 'map',
				'id'    => 'bb-icon-navigation',
				'name'  => __( 'Navigation', 'buddyboss-theme' ),
			),
			array(
				'group' => 'map',
				'id'    => 'bb-icon-navigation-up',
				'name'  => __( 'Navigation: Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-octagon',
				'name'  => __( 'Octagon', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-package',
				'name'  => __( 'Package', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-paperclip',
				'name'  => __( 'Paperclip', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-pause',
				'name'  => __( 'Pause', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-pause-circle',
				'name'  => __( 'Pause: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-pencil',
				'name'  => __( 'Pencil', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-percent',
				'name'  => __( 'Percent', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-phone',
				'name'  => __( 'Phone', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-phone-call',
				'name'  => __( 'Phone: Call', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-phone-forwarded',
				'name'  => __( 'Phone: Forwarded', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-phone-incoming',
				'name'  => __( 'Phone: Incoming', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-phone-missed',
				'name'  => __( 'Phone: Missed', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-phone-off',
				'name'  => __( 'Phone: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-phone-outgoing',
				'name'  => __( 'Phone: Outgoing', 'buddyboss-theme' ),
			),
			array(
				'group' => 'chart',
				'id'    => 'bb-icon-pie-chart',
				'name'  => __( 'Pie Chart', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-pinterest',
				'name'  => __( 'Pinterest: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-pizza-slice',
				'name'  => __( 'Pizza Slice', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-plane',
				'name'  => __( 'Plane', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-play',
				'name'  => __( 'Play', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-play-square',
				'name'  => __( 'Play: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-play-circle',
				'name'  => __( 'Play: Circle', 'buddyboss-theme' ),
			),
            array(
				'group' => 'media',
				'id'    => 'bb-icon-play-circle-fill',
				'name'  => __( 'Play: Fill', 'buddyboss-theme' ),
			),
            array(
				'group' => 'courses',
				'id'    => 'bb-icon-play-thin',
				'name'  => __( 'Play: Thin', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-plus',
				'name'  => __( 'Plus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-plus-circle',
				'name'  => __( 'Plus: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-plus-square',
				'name'  => __( 'Plus: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-pocket',
				'name'  => __( 'Pocket', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-power',
				'name'  => __( 'Power', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-power-small',
				'name'  => __( 'Power: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-print',
				'name'  => __( 'Print', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-print-fill',
				'name'  => __( 'Print: Fill', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-profile',
				'name'  => __( 'Profile', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-profile-info',
				'name'  => __( 'Profile: Info', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-profile-types',
				'name'  => __( 'Profile: Type', 'buddyboss-theme' ),
			),
            array(
				'group' => 'courses',
				'id'    => 'bb-icon-question-thin',
				'name'  => __( 'Question: Thin', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-quora',
				'name'  => __( 'Quora', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-quote',
				'name'  => __( 'Quote', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-radio',
				'name'  => __( 'Radio', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-reddit',
				'name'  => __( 'Reddit: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-refresh-ccw',
				'name'  => __( 'Refresh: CCW', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-refresh-cw',
				'name'  => __( 'Refresh: CW', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-repeat',
				'name'  => __( 'Repeat', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-reply',
				'name'  => __( 'Reply', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-forum-replies',
				'name'  => __( 'Replies', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-rewind',
				'name'  => __( 'Rewind', 'buddyboss-theme' ),
			),
            array(
				'group' => 'misc',
				'id'    => 'bb-icon-rocket',
				'name'  => __( 'Rocket', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-rotate-ccw',
				'name'  => __( 'Rotate: CCW', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-rotate-cw',
				'name'  => __( 'Rotate: CW', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-rss-square',
				'name'  => __( 'RSS: Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-save',
				'name'  => __( 'Save', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-scissors',
				'name'  => __( 'Scissors', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-search',
				'name'  => __( 'Search', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-search-small',
				'name'  => __( 'Search: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-select',
				'name'  => __( 'Select', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-server',
				'name'  => __( 'Server', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-settings',
				'name'  => __( 'Settings', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-settings-small',
				'name'  => __( 'Settings: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-share',
				'name'  => __( 'Share', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-share-small',
				'name'  => __( 'Share: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-shield',
				'name'  => __( 'Shield', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-shopping-cart',
				'name'  => __( 'Shopping Cart', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-shuffle',
				'name'  => __( 'Shuffle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-sidebar',
				'name'  => __( 'Sidebar', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-skip-back',
				'name'  => __( 'Skip: Backward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-skip-forward',
				'name'  => __( 'Skip: Forward', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-slack',
				'name'  => __( 'Slack', 'buddyboss-theme' ),
			),
			array(
				'group' => 'alert',
				'id'    => 'bb-icon-slash',
				'name'  => __( 'Slash', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-sliders',
				'name'  => __( 'Sliders', 'buddyboss-theme' ),
			),
			array(
				'group' => 'device',
				'id'    => 'bb-icon-smartphone',
				'name'  => __( 'Smartphone', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-smile',
				'name'  => __( 'Smile', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-sort-desc',
				'name'  => __( 'Sort: Desc', 'buddyboss-theme' ),
			),
			array(
				'group' => 'device',
				'id'    => 'bb-icon-speaker',
				'name'  => __( 'Speaker', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-spin',
				'name'  => __( 'Spin', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-spin-small',
				'name'  => __( 'Spin: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-square',
				'name'  => __( 'Square', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-star',
				'name'  => __( 'Star', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-star-small-fill',
				'name'  => __( 'Star: Small-Fill', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-star-fill',
				'name'  => __( 'Star: Fill', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-star-small',
				'name'  => __( 'Star: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-stop-circle',
				'name'  => __( 'Stop: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-sun',
				'name'  => __( 'Sun', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-sunrise',
				'name'  => __( 'Sunrise', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-swap',
				'name'  => __( 'Swap', 'buddyboss-theme' ),
			),
			array(
				'group' => 'device',
				'id'    => 'bb-icon-tablet',
				'name'  => __( 'Tablet', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-tag',
				'name'  => __( 'Tag', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-target',
				'name'  => __( 'Target', 'buddyboss-theme' ),
			),
            array(
				'group' => 'courses',
				'id'    => 'bb-icon-text',
				'name'  => __( 'Text', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-thermometer',
				'name'  => __( 'Thermometer', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-thumbs-down',
				'name'  => __( 'Thumbs: Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-thumbs-up',
				'name'  => __( 'Thumbs: Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-toggle-left',
				'name'  => __( 'Toggle: Left', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-toggle-right',
				'name'  => __( 'Toggle: Right', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-tools',
				'name'  => __( 'Tools', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-trash',
				'name'  => __( 'Trash', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-trash-empty',
				'name'  => __( 'Trash: Empty', 'buddyboss-theme' ),
			),
            array(
				'group' => 'web',
				'id'    => 'bb-icon-trash-small',
				'name'  => __( 'Trash: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-trending-down',
				'name'  => __( 'Trending: Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'arrow',
				'id'    => 'bb-icon-trending-up',
				'name'  => __( 'Trending: Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-triangle',
				'name'  => __( 'Triangle', 'buddyboss-theme' ),
			),
            array(
				'group' => 'misc',
				'id'    => 'bb-icon-triangle-fill',
				'name'  => __( 'Triangle: Fill', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-tumblr',
				'name'  => __( 'Tumblr: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'mics',
				'id'    => 'bb-icon-tv',
				'name'  => __( 'TV', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-twitter',
				'name'  => __( 'Twitter', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-twitter',
				'name'  => __( 'Twitter: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'brand',
				'id'    => 'bb-icon-twitter-small',
				'name'  => __( 'Twitter: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-type',
				'name'  => __( 'Type', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-umbrella',
				'name'  => __( 'Umbrella', 'buddyboss-theme' ),
			),
			array(
				'group' => 'format',
				'id'    => 'bb-icon-underline',
				'name'  => __( 'Underline', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-unlock',
				'name'  => __( 'Unlock', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-upload',
				'name'  => __( 'Upload', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user',
				'name'  => __( 'User', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-small-minus',
				'name'  => __( 'User: Small-Minus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-small-plus',
				'name'  => __( 'User: Small-Plus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-alt',
				'name'  => __( 'User: Alt', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-check',
				'name'  => __( 'User: Check', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-circle',
				'name'  => __( 'User: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-doc',
				'name'  => __( 'User: Doc', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-minus',
				'name'  => __( 'User: Minus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-plus',
				'name'  => __( 'User: Plus', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-small',
				'name'  => __( 'User: Small', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-user-x',
				'name'  => __( 'User: X', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-users',
				'name'  => __( 'Users', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-video',
				'name'  => __( 'Video', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-video-off',
				'name'  => __( 'Video: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-visibility',
				'name'  => __( 'Visibility', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-visibility-hidden',
				'name'  => __( 'Visibility: Hidden', 'buddyboss-theme' ),
			),
			array(
				'group' => 'phone',
				'id'    => 'bb-icon-voicemail',
				'name'  => __( 'Voicemail', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-volume-down',
				'name'  => __( 'Volume: Down', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-volume-mute',
				'name'  => __( 'Volume: Mute', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-volume-off',
				'name'  => __( 'Volume: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'media',
				'id'    => 'bb-icon-volume-up',
				'name'  => __( 'Volume: Up', 'buddyboss-theme' ),
			),
			array(
				'group' => 'misc',
				'id'    => 'bb-icon-watch',
				'name'  => __( 'Watch', 'buddyboss-theme' ),
			),
            array(
				'group' => 'courses',
				'id'    => 'bb-icon-watch-alarm',
				'name'  => __( 'Watch Alarm', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-wifi',
				'name'  => __( 'WiFi', 'buddyboss-theme' ),
			),
			array(
				'group' => 'web',
				'id'    => 'bb-icon-wifi-off',
				'name'  => __( 'WiFi: Off', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-wind',
				'name'  => __( 'Wind', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-x',
				'name'  => __( 'X', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-x-circle',
				'name'  => __( 'X: Circle', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-x-square',
				'name'  => __( 'X: Square', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-rounded-youtube',
				'name'  => __( 'Youtube: Circle', 'buddyboss-theme' ),
			),
            array(
				'group' => 'brand',
				'id'    => 'bb-icon-youtube-logo',
				'name'  => __( 'Youtube: Logo', 'buddyboss-theme' ),
			),
			array(
				'group' => 'nature',
				'id'    => 'bb-icon-zap',
				'name'  => __( 'Zap', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-zoom-in',
				'name'  => __( 'Zoom: In', 'buddyboss-theme' ),
			),
			array(
				'group' => 'control',
				'id'    => 'bb-icon-zoom-out',
				'name'  => __( 'Zoom: Out', 'buddyboss-theme' ),
			),
		);

		/**
		 * Filter BuddyBoss items
		 *
		 * @since 0.1.0
		 *
		 * @param array $items Icon names.
		 */
		$items = apply_filters( 'icon_picker_buddyboss_items', $items );

		return $items;
	}
}
