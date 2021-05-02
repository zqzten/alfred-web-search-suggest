<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');
require_once('util/download.php');

const ICON = '66323B0D-F24D-4F0C-BCB2-42D2BFA92C0F.png';

$wf = new Workflow;

$download_dir = getenv('alfred_workflow_cache').'/imdb';
initDownloadDir(true);

$response = request('https://v2.sg.media-imdb.com/suggestion/'.$query[0].'/'.urlencode($query).'.json', $opt);
$json = json_decode($response);
$data = $json->d;

if (is_array($data)) {
    foreach ($data as $sugg) {
        $title = $sugg->l;
        $subtitle = $sugg->s;
        $icon = saveAndReturnFile(str_replace('_V1_', '_V1_UY100', $sugg->i->imageUrl)); // try to fetch a small sized icon
        $subpath = $sugg->id;
        $prefix = substr($subpath, 0, 2);
        switch ($prefix) {
            case 'tt':
                $subpath = '/title/'.$subpath;
                break;
            case 'nm':
                $subpath = '/name/'.$subpath;
                break;
            default:
                break;
        }
        $arg = 'https://www.imdb.com'.$subpath;
    
        $wf->result()
            ->title($title)
            ->subtitle($subtitle)
            ->arg($arg)
            ->icon($icon)
            ->autocomplete($title)
            ->copy($title)
            ->quicklookurl($arg);
    }
}

echo $wf->output();