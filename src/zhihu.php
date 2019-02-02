<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '861BE674-55FF-4779-A44A-A02FF66440B0.png';

$wf = new Workflow;

$response = request('https://www.zhihu.com/api/v4/search/suggest?q='.urlencode($query));
$json = json_decode($response);
$suggest = $json->suggest;

foreach ($suggest as $sugg) {
    $query = $sugg->query;
    $wf->result()
        ->title($query)
        ->subtitle('Search 知乎 for '.$query)
        ->arg($query)
        ->icon(ICON)
        ->autocomplete($query);
}

echo $wf->output();
