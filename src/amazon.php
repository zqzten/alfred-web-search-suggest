<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '3444F1D5-FE79-4B5F-A37D-DAA45D7D02F0.png';

$wf = new Workflow;

$response = request('https://completion.amazon.com/search/complete?mkt=1&search-alias=aps&q='.urlencode($query), $opt);
$json = json_decode($response)[1];

foreach ($json as $data) {
    $wf->result()
        ->title($data)
        ->subtitle('Search Amazon for '.$data)
        ->arg($data)
        ->icon(ICON)
        ->autocomplete($data);
}

echo $wf->output();
