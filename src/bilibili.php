<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = 'AE15F1F6-37B0-4A47-BEE1-975354A81227.png';

$wf = new Workflow;

$response = request( "https://api.bilibili.cn/suggest?term=".urlencode( $query ) );
$json = json_decode( $response, true );

foreach( $json as $key => $value ):
	$data = $value['name'];
	$wf->result()
		->title("$data")
		->subtitle('Search 哔哩哔哩 for '.$data)
		->arg("$data")
		->icon(ICON)
		->autocomplete("$data");
endforeach;

echo $wf->output();