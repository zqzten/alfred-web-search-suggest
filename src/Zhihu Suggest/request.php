<?php
/**
* Description:
* Read data from a remote file/url, essentially a shortcut for curl
*
* @param $url - URL to request
* @param $options - Array of curl options
* @return result from curl_exec
*/
function request( $url=null, $options=null )
{
	if ( is_null( $url ) ):
		return false;
	endif;

	$defaults = array(									// Create a list of default curl options
		CURLOPT_RETURNTRANSFER => true,					// Returns the result as a string
		CURLOPT_URL => $url,							// Sets the url to request
		CURLOPT_FRESH_CONNECT => true
	);

	if ( $options ):
		foreach( $options as $k => $v ):
			$defaults[$k] = $v;
		endforeach;
	endif;

	array_filter( $defaults, 							// Filter out empty options from the array
		function( $a ) {
			if ( $a == '' || $a == null ):				// if $a is empty or null
				return false;							// return false, else, return true
			else:
				return true;
			endif;
	} );

	$ch  = curl_init();									// Init new curl object
	curl_setopt_array( $ch, $defaults );				// Set curl options
	$out = curl_exec( $ch );							// Request remote data
	$err = curl_error( $ch );
	curl_close( $ch );									// End curl request

	if ( $err ):
		return $err;
	else:
		return $out;
	endif;
}