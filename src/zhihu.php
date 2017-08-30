<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');
require_once('util/download.php');

const ICON = '861BE674-55FF-4779-A44A-A02FF66440B0.png';

$wf = new Workflow;

$download_dir = getenv('alfred_workflow_cache').'/zhihu';
initDownloadDir(TRUE);

$response = request('https://www.zhihu.com/autocomplete?token='.urlencode($query));
$json = json_decode(mb_convert_encoding($response, 'UTF-8', 'HTML-ENTITIES'))[0];

foreach ($json as $sugg) {
    if (is_array($sugg)) {
        $matched = TRUE;
        $type = $sugg[0];
        switch ($type) {
            case 'topic':
                $title = $sugg[1];
                $subtitle = '【话题】'.$sugg[6].' 个精选回答';
                $arg = 'https://www.zhihu.com/'.$type.'/'.$sugg[2];
                $icon = saveAndReturnFile(str_replace('_s', '_m', $sugg[3]));
                break;
            case 'people':
                $title = $sugg[1];
                $subtitle = '【用户】'.$sugg[5];
                $arg = 'https://www.zhihu.com/'.$type.'/'.$sugg[2];
                $icon = saveAndReturnFile(str_replace('_s', '_m', $sugg[3]));
                break;
            case 'question':
                $title = $sugg[1];
                $subtitle = '【问题】'.$sugg[4].' 个回答';
                $arg = 'https://www.zhihu.com/'.$type.'/'.$sugg[3];
                $icon = ICON;
                break;
            case 'article':
                $title = $sugg[1];
                $subtitle = '【文章】'.$sugg[4].' 个赞';
                $arg = 'https://zhuanlan.zhihu.com/p/'.$sugg[3];
                $icon = ICON;
                break;
            default:
                $matched = FALSE;
                break;
        }

        if ($matched) {
            $wf->result()
                ->title("$title")
                ->subtitle("$subtitle")
                ->arg("$arg")
                ->icon("$icon")
                ->autocomplete("$title")
                ->copy("$title")
                ->quicklookurl("$arg");
        }
    }
}

echo $wf->output();