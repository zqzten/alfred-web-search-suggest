<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '7999A242-8DB6-41F9-BAD7-78C3E4CC0C41.png';

$wf = new Workflow;

$response = request("https://zh.moegirl.org/api.php?action=opensearch&search=".urlencode($query));
$json = json_decode($response);

for ($i = 0; $i < count($json[1]); $i++) {
    $key = $json[1][$i];
    $description = $json[2][$i];
    $url = $json[3][$i];
    $wf->result()
        ->title("$key")
        ->subtitle("$description")
        ->arg("$url")
        ->icon(ICON)
        ->autocomplete("$key")
        ->copy("$key")
        ->quicklookurl("$url");
}

echo $wf->output();