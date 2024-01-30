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

function twit( $atts, $content, $tag ) {
	$sequence = bw_array_get_from( $atts, 'sequence,0', 'daysoftheweek');
	$date = bw_array_get_from( $atts, 'date,1', null);
	if ( null === $date ) {
		$date = date( 'Y-m-d' );
	} else {

		$date = date( 'Y-m-d', strtotime( $date) );
	}
	span( 'twit' );
	//e( "twit $sequence $date" );
	$this->load_sequence( $sequence );
	$value = $this->get_sequence_value_for_date( $date );
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


}