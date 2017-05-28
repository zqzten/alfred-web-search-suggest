<?php
use Alfred\Workflows\Workflow;

require_once('vendor/Workflow.php');
require_once('vendor/Result.php');
require_once('util/request.php');

$wf = new Workflow;

if (strpos($query, " ") !== false):
	$parts = explode(" ", $query);
	$code = array_shift($parts);
	$query = implode(" ", $parts);

	$response = request( "https://$code.wikipedia.org/w/api.php?action=opensearch&search=".urlencode( $query ), $opt );
	$json = json_decode( $response );

	for( $i = 0; $i < count($json[1]); $i++ ):
		$key = $json[1][$i];
		$description = $json[2][$i];
		$url = $json[3][$i];
		$wf->result()
			->title("$key")
			->subtitle("$description")
			->arg("$url")
			->icon('80FCED49-07AA-4C15-9B49-24A52B3AF5D6.png')
			->autocomplete("$key")
			->text('copy', "$key")
			->quicklookurl("$url");
	endfor;

	if( count($json[1]) == 0 ):
		$wf->result()
			->title('No Suggestions')
			->subtitle('No search suggestions found. Search Wikipedia.'.$code.' for '.$query)
			->arg("https://$code.wikipedia.org/w/index.php?search=".urlencode( $query ))
			->icon('80FCED49-07AA-4C15-9B49-24A52B3AF5D6.png')
			->text('copy', "$query");
	endif;
endif;

echo $wf->output();