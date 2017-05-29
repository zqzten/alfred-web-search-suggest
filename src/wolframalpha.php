<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

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
		->icon('67D1CDF9-CA40-4D8E-B66C-E0FF18FCE3CE.png')
		->autocomplete("$key");
endforeach;

echo $wf->output();