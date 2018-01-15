<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '66A123A9-2115-4480-BAA7-19F66300097C.png';

$wf = new Workflow;

$response = request('https://s.weibo.com/ajax/suggestion?where=gs_weibo&key='.urlencode($query));
$json = json_decode($response);
$data = $json->data;

foreach ($data as $sugg) {
    $key = $sugg->key;
    $count = $sugg->count;
    $wf->result()
        ->title($key)
        ->subtitle($count.' results')
        ->arg($key)
        ->icon(ICON)
        ->autocomplete($key);
}

echo $wf->output();
