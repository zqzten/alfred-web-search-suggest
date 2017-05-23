<?php
use Alfred\Workflows\Workflow;

require_once('vendor/Workflow.php');
require_once('vendor/Result.php');
require_once('request.php');

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
		->icon('icon.png')
		->autocomplete("$key");
endforeach;

echo $wf->output();