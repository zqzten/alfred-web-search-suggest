<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '67D1CDF9-CA40-4D8E-B66C-E0FF18FCE3CE.png';

$wf = new Workflow;

$response = request('https://www.wolframalpha.com/n/v1/api/autocomplete/?i='.urlencode($query), $opt);
$json = json_decode($response);
$results = $json->results;

foreach ($results as $sugg) {
    $key = $sugg->input;
    $description = $sugg->parseType;
    $wf->result()
        ->title($key)
        ->subtitle($description)
        ->arg($key)
        ->icon(ICON)
        ->autocomplete($key);
}

echo $wf->output();
