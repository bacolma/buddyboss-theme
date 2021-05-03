<?php

/*
 * Chat
 */
if ( !function_exists( 'bb_chat' ) ) {

	function bb_chat( $atts, $content = null ) {
		$content = do_shortcode( shortcode_unautop( $content ) );
		if ( '</p>' == substr( $content, 0, 4 ) and '<p>' == substr( $content, strlen( $content ) - 3 ) ) {
			$content = substr( $content, 4, strlen( $content ) - 7 );
		}
		return '<div class="bb-chat-container">' . $content . '</div>';
	}

	add_shortcode( 'chat', 'bb_chat' );
}


/* Change attributes of wp gallery to modify image sizes for your needs */
if ( !function_exists( 'bs_gallery_atts' ) ) {

	function bs_gallery_atts( $output, $pairs, $atts ) {
		/* You can use these sizes:
		  - thumbnail
		  - medium
		  - large
		  - full
		  or, if your theme/plugin generate additional custom sizes you can use them as well
		 */

		$output[ 'size' ] = 'large'; //i.e. This will change all your gallery images to "medium" size

		return $output;
	}

	add_filter( 'shortcode_atts_gallery', 'bs_gallery_atts', 10, 3 );
}

if ( ! function_exists( 'bb_theme_current_year_display' ) ) {

	function bb_theme_current_year_display( $atts, $content = null ) {

		return date_i18n( 'Y' );
	}

	add_shortcode( 'boss_current_year', 'bb_theme_current_year_display' );

}