<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '66A123A9-2115-4480-BAA7-19F66300097C.png';

$wf = new Workflow;

$response = request('https://s.weibo.com/Ajax_Search/suggest?key='.urlencode('#'.$query));
$json = json_decode($response);
$data = $json->data;

foreach ($data as $sugg) {
    $word = $sugg->word;
    $wf->result()
        ->title($word)
        ->subtitle('Search 新浪微博 for '.$word)
        ->arg($word)
        ->icon(ICON)
        ->autocomplete($word);
}

echo $wf->output();
