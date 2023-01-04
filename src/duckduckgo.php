<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '471DBE2A-EC46-474C-9309-B78272DF472E.png';

$wf = new Workflow;

$response = request('https://duckduckgo.com/ac/?q='.urlencode($query), $opt);
$json = json_decode($response);

foreach ($json as $sugg) {
    $key = $sugg->phrase;
    $wf->result()
        ->title($key)
        ->subtitle('DuckDuckGo for '.$key)
        ->arg($key)
        ->icon(ICON)
        ->autocomplete($key);
}

echo $wf->output();
