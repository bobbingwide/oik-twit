<?php 
/**
Plugin Name: oik-twit
Depends: oik base plugin
Plugin URI: https://www.bobbingwide.com/blog/oik_plugins/oik-twit
Description: Today's word is this.
Version: 0.0.0
Author: bobbingwide
Author URI: https://bobbingwide.com/about-bobbing-wide
Text Domain: oik_twit
Domain Path: /languages/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

    Copyright 2024 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/


/**
 * Register the additional taxonomies for oik_twit
 *
 * - Depends on oik-a2z for the "letters" taxonomy.
 * - Depends on oik-shortcodes-a2z for the "oik_letters" taxonomy. 
 * - oik-a2z automatically registers the filter that will set the taxonomy term from the title or content. 
 *
 */ 
function oik_twit_loaded() {
	add_action( 'oik_loaded', 'oik_twit_oik_loaded' );
	add_action( 'oik_add_shortcodes', 'oik_twit_add_shortcodes' );
}

function oik_twit_add_shortcodes() {
	$path = oik_path( "shortcodes/oik-twit.php", "oik-twit" );
	bw_add_shortcode( "twit", "oik_twit_shortcode", $path , false );

}

/**
 * Implements 'oik_loaded'
 * 
 */ 
function oik_twit_oik_loaded() {

}

oik_twit_loaded();
