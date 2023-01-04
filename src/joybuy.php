<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = 'B1C4E5F1-FE5D-4505-9AD6-3F12A4F4ACC8.png';

$wf = new Workflow;

$opt[CURLOPT_HTTPHEADER] = ['Referer: https://www.jd.com/'];
$response = request('https://dd-search.jd.com/?ver=2&key='.urlencode($query), $opt);
$json = json_decode($response);

foreach ($json as $sugg) {
    $key = $sugg->keyword ?? null;
    if (is_null($key)) continue;
    $wf->result()
        ->title($key)
        ->subtitle('Search 京东 for '.$key)
        ->arg($key)
        ->icon(ICON)
        ->autocomplete($key);
}

echo $wf->output();
