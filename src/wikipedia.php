<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = '80FCED49-07AA-4C15-9B49-24A52B3AF5D6.png';

$wf = new Workflow;

if (strpos($query, ' ') !== FALSE) {
    $parts = explode(' ', $query);
    $code = array_shift($parts);
    $query = implode(' ', $parts);

    $response = request("https://$code.wikipedia.org/w/api.php?action=opensearch&search=".urlencode($query), $opt);
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

    if (count($json[1]) == 0) {
        $wf->result()
            ->title('No Suggestions')
            ->subtitle('No search suggestions found. Search Wikipedia.'.$code.' for '.$query)
            ->arg("https://$code.wikipedia.org/w/index.php?search=".urlencode($query))
            ->icon(ICON)
            ->copy("$query");
    }
}

echo $wf->output();