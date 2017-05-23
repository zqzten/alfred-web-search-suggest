<?php
use Alfred\Workflows\Workflow;

require_once('vendor/Workflow.php');
require_once('vendor/Result.php');
require_once('request.php');

$wf = new Workflow;

$xml = request( "http://google.com/complete/search?output=toolbar&q=".urlencode( $query ), $opt );
$xml = simplexml_load_string( utf8_encode($xml) );

foreach( $xml as $sugg ):
	$data = $sugg->suggestion->attributes()->data;
	$wf->result()
		->title("$data")
		->subtitle('Search Google for '.$data)
		->arg("$data")
		->icon('icon.png')
		->autocomplete("$data");
endforeach;

echo $wf->output();