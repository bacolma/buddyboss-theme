<?php
/**
 * Icon type handler
 *
 * @package Buddyboss_Menu_Icons
 * @version 0.1.0
 * @author Dzikri Aziz <kvcrvt@gmail.com>
 * @author BuddyBoss
 */


/**
 * Generic handler for icon type
 *
 * @since 0.1.0
 */
abstract class Menu_Icons_Type {

	/**
	 * Holds icon type
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $type;

	/**
	 * Holds icon label
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $label;

	/**
	 * Holds icon stylesheet URL
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $stylesheet;

	/**
	 * Custom stylesheet ID
	 *
	 * @since Menu Icons 0.8.0
	 * @access protected
	 * @var    string
	 */
	protected $stylesheet_id;

	/**
	 * Holds icon version
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $version;

	/**
	 * Holds array key for icon value
	 *
	 * @since Menu Icons 0.1.0
	 * @access protected
	 * @var    string
	 */
	protected $key;

	/**
	 * Holds menu settings
	 *
	 * @since Menu Icons 0.3.0
	 * @access protected
	 * @var    array
	 */
	protected $menu_setttings = array();


	/**
	 * Class constructor
	 *
	 * This simply sets $key
	 *
	 * @since Menu Icons 0.1.0
	 * @since Menu Icons 0.9.0 Deprecated.
	 */
	function __construct() {
		_deprecated_function( __CLASS__, '0.9.0', 'Icon_Picker_Type' );
	}


	/**
	 * Register our type
	 *
	 * @since Menu Icons 0.1.0
	 * @since Menu Icons 0.9.0 Deprecated. This simply returns the $types.
	 * @param  array $types Icon Types
	 * @uses   apply_filters() Calls 'menu_icons_{type}_props' on type properties.
	 * @return array
	 */
	public function register( $types ) {
		return $types;
	}
}
