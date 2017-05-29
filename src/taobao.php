<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

$wf = new Workflow;

$response = request( "https://suggest.taobao.com/sug?q=".urlencode( $query ) );
$json = json_decode( $response );
$result = $json->result;

foreach( $result as $sugg ):
	$key = $sugg[0];
	$count = $sugg[1];
	$wf->result()
		->title("$key")
		->subtitle($count.' results')
		->arg("$key")
		->icon('186480B7-9F2F-43AD-9994-A9B8E053ADE5.png')
		->autocomplete("$key");
endforeach;

echo $wf->output();