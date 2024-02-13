<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = 'AE15F1F6-37B0-4A47-BEE1-975354A81227.png';

$wf = new Workflow;

$response = request('https://s.search.bilibili.com/main/suggest?term='.urlencode($query).'&userid='.getenv('bilibili_uid'));
$json = json_decode($response);
$results = $json->result->tag;

foreach ($results as $sugg) {
    $data = $sugg->value;
    $wf->result()
        ->title($data)
        ->subtitle('Search 哔哩哔哩 for '.$data)
        ->arg($data)
        ->icon(ICON)
        ->autocomplete($data);
}

echo $wf->output();
