<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = 'A66D4C48-6D6D-4531-AF51-8463E488EEB2.png';

$wf = new Workflow;

$opt[CURLOPT_HTTPHEADER] = ['Referer: https://www.pixiv.net/'];
$response = request('https://www.pixiv.net/rpc/cps.php?keyword='.urlencode($query), $opt);
$json = json_decode($response);
$results = $json->candidates;

foreach ($results as $sugg) {
    $key = $sugg->tag_name;
    $count = $sugg->access_count;
    $wf->result()
        ->title("$key")
        ->subtitle($count.' results')
        ->arg("$key")
        ->icon(ICON)
        ->autocomplete("$key");
}

echo $wf->output();