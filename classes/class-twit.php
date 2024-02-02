<?php
/**
 * @copyright (C) Copyright Bobbing Wide 2024
 * @package oik-twit
 *
*/
class Twit {

private $files=[];
private $sequence;

function __construct() {
	$this->load_sequences();
}

function load_sequences() {
	$this->files=[ 'sequences/daysoftheweek.json' ];
}

function get_class_for_sequence( $sequence ) {
	$classes = [ 'food-le.com' => 'wordle',
		'foodlewordle.io' => 'wordle'];
	$class = bw_array_get( $classes, $sequence, '');
	return $class;
}

function twit( $atts, $content, $tag ) {
	$this->maybe_clear_cache();
	$sequence = bw_array_get_from( $atts, 'sequence,0', 'daysoftheweek');
	$date = bw_array_get_from( $atts, 'date,1', null);
	if ( null === $date ) {
		$date = date( 'Y-m-d' );
	} else {
		$date = date( 'Y-m-d', strtotime( $date) );
	}
	$class = bw_array_get( $atts, 'class', $sequence );
	//if ( $class ) {
		$class = $this->get_class_for_sequence( $class );
	//}
	span( 'twit ' . $class );
	//e( "twit $sequence $date" );
	$this->load_sequence( $sequence );
	$value = $this->get_sequence_value_for_date( $date );
	if ( 'wordle' === $class ) {
		$value = $this->letter_split( $value );
	}
	e( $value );
	epan();
	return bw_ret();
}

	/**
	 * Loads the sequence file.
	 *
	 * @param $sequence
	 *
	 * @return void
	 */
function load_sequence( $sequence ) {
	$file = file_get_contents( dirname( __DIR__ ) . '/sequences/' . $sequence . '.json');
	//e( $file );
	$this->sequence = json_decode( $file, true );
	//print_r( $this->sequence );
}

	/**
	 * Returns the sequence value for the given date.
	 *
	 * @param $date
	 *
	 * @return mixed
	 */

function get_sequence_value_for_date( $date ) {
	$words = $this->sequence['words'];
	$count = count( $words );
	$date_diff = $this->get_date_diff( $date, $this->sequence['startdate'] );
	$offset = $date_diff %  $count;
	return $this->sequence['words'][$offset];
}

function get_date_diff( $new_date, $startdate ) {
	$origin = date_create($startdate);
	$target = date_create($new_date );
	$interval = date_diff($origin, $target);
	//print_r( $interval);
	$date_diff = $interval->days;
	//echo $interval->format('%R%a days');
	return $date_diff;
}

function letter_split( $value ) {
	$letters = '';
	$length = strlen( $value );
	for ( $i = 0; $i < $length; $i++ ) {
		$letters .= '<span>';
		$letters .= $value[$i];
		$letters .= '</span>';
	}
	return $letters;
 }

	/**
	 * Clears the cache if it's a new day.
	 *
	 * Note: We call it's a new day first just to test the transient logic.
	 * That might be a reasonable thing to do if there were multiple different cacheing solutions
	 * to test for.
	 *
	 * @return void
	 */
 function maybe_clear_cache() {
	 global $wp;
	 /*
	 $current_url = home_url( $wp->request );
	 bw_trace2( $current_url, "current URL wp->request", false );
	 */
	if ( $this->its_a_new_day() ) {
		if ( function_exists('sg_cachepress_purge_cache' ) ) {

			sg_cachepress_purge_cache( get_home_url() );
			$current_url = home_url( $wp->request );
			bw_trace2( $current_url, "current URL", false );
			sg_cachepress_purge_cache( $current_url );
		}
	}

 }

 function its_a_new_day() {
	 $its_a_new_day = false;
	 $cached_date = get_transient( 'oik-twit' );
	 if ( false === $cached_date ) {
		 $its_a_new_day = true;
		 //$secs = bw_time_of_day_secs();
		 extract( localtime( time(), true ));
		 $secs = ((($tm_hour * 60) + $tm_min) * 60) + $tm_sec;
		 $secs = 86400 - $secs;
		 set_transient( 'oik-twit', date( 'Y-m-d'), $secs );
	 }

	return $its_a_new_day;
 }


}