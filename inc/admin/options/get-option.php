<?php

/**
 * Get BuddyBoss_Theme options
 *
 * @param string $id Option ID.
 * @param string $param Option type.
 * @param bool   $default default value.
 *
 * @return $output False on failure, Option.
 */
if ( !function_exists( 'buddyboss_theme_get_option' ) ) {

	function buddyboss_theme_get_option( $id, $param = null, $default = false ) {

		global $buddyboss_theme_options;

		/* Check if options are set */
		if ( !isset( $buddyboss_theme_options ) ) {
			$buddyboss_theme_options = get_option( 'buddyboss_theme_options', array() );
		}

		/* Check if array subscript exist in options */
		if ( empty( $buddyboss_theme_options[ $id ] ) ) {
			if ( array_key_exists( $id, $buddyboss_theme_options ) ) {
				return false;
			} else {
				// Return true if default passed to true and key not exists into the buddyboss_theme_options array.
				return ( $default ) ? true : false;
			}
		}

		/**
		 * If $param exists,  then
		 * 1. It should be 'string'.
		 * 2. '$buddyboss_theme_options[ $id ]' should be array.
		 * 3. '$param' array key exists.
		 */
		if ( !empty( $param ) && is_string( $param ) && (!is_array( $buddyboss_theme_options[ $id ] ) || !array_key_exists( $param, $buddyboss_theme_options[ $id ] ) ) ) {
			return false;
		}

		return empty( $param ) ? $buddyboss_theme_options[ $id ] : $buddyboss_theme_options[ $id ][ $param ];
	}
}
