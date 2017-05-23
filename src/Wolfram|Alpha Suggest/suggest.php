<?php
use Alfred\Workflows\Workflow;

require_once('vendor/Workflow.php');
require_once('vendor/Result.php');
require_once('request.php');

$wf = new Workflow;

$response = request( "https://www.wolframalpha.com/input/autocomplete.jsp?i=".urlencode( $query ), $opt );
$json = json_decode( $response );
$results = $json->results;

foreach( $results as $sugg ):
	$key = $sugg->input;
	$description = $sugg->description;
	$wf->result()
		->title("$key")
		->subtitle("$description")
		->arg("$key")
		->icon('icon.png')
		->autocomplete("$key");
endforeach;

echo $wf->output();