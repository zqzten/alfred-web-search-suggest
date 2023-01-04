<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '09DA712F-72B1-49D8-ADC6-F11C4DDB9B8C.png';

$wf = new Workflow;

$response = request('https://search.brave.com/api/suggest?q='.urlencode($query), $opt);
$json = json_decode($response);
$data = $json[1];

foreach ($data as $sugg) {
    $wf->result()
        ->title($sugg)
        ->subtitle('Brave Search for '.$sugg)
        ->arg($sugg)
        ->icon(ICON)
        ->autocomplete($sugg);
}

echo $wf->output();
