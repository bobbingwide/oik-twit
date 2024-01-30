<?php

/**
 * Implements the twit shortcode.
 * @param $atts
 * @param $content
 * @param $tag
 *
 * @return string
 */
function oik_twit_shortcode( $atts, $content, $tag ) {
	oik_require( 'classes/class-twit.php', 'oik-twit');
	$twit = new Twit();
	$html = $twit->twit( $atts, $content, $tag );
	return $html;
}