<?php
use Alfred\Workflows\Workflow;

require_once('vendor/Workflow.php');
require_once('vendor/Result.php');
require_once('request.php');

$wf = new Workflow;

$response = request( "https://s.weibo.com/ajax/suggestion?where=gs_weibo&key=".urlencode( $query ) );
$json = json_decode( $response );
$data = $json->data;

foreach( $data as $sugg ):
	$key = $sugg->key;
	$count = $sugg->count;
	$wf->result()
		->title("$key")
		->subtitle($count.' results')
		->arg("$key")
		->icon('icon.png')
		->autocomplete("$key");
endforeach;

echo $wf->output();