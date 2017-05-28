<?php
use Alfred\Workflows\Workflow;

require_once('vendor/Workflow.php');
require_once('vendor/Result.php');
require_once('util/request.php');

$wf = new Workflow;

$response = request( "https://api.bilibili.cn/suggest?term=".urlencode( $query ) );
$json = json_decode( $response, true );

foreach( $json as $key => $value ):
	$data = $value['name'];
	$wf->result()
		->title("$data")
		->subtitle('Search 哔哩哔哩 for '.$data)
		->arg("$data")
		->icon('AE15F1F6-37B0-4A47-BEE1-975354A81227.png')
		->autocomplete("$data");
endforeach;

echo $wf->output();