<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '702E9582-5E02-4094-9889-0C4A575F7DAF.png';

$wf = new Workflow;

$response = request('http://suggestion.baidu.com/su?&wd='.urlencode($query));
preg_match('/s:(\[.*\])\}\);/', stripslashes(iconv('GB2312', 'UTF-8', $response)), $match);
$json = json_decode($match[1]);

foreach ($json as $data) {
    $wf->result()
        ->title($data)
        ->subtitle('百度一下 '.$data)
        ->arg($data)
        ->icon(ICON)
        ->autocomplete($data);
}

echo $wf->output();
