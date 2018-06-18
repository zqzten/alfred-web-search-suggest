<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');
require_once('util/download.php');

const ICON = '861BE674-55FF-4779-A44A-A02FF66440B0.png';

$wf = new Workflow;

$download_dir = getenv('alfred_workflow_cache').'/zhihu';
initDownloadDir(true);

$response = request('https://www.zhihu.com/autocomplete?token='.urlencode($query));
$json = json_decode($response)[0];

foreach ($json as $sugg) {
    if (is_array($sugg)) {
        $matched = true;
        $type = $sugg[0];
        $title = html_entity_decode($sugg[1], ENT_QUOTES | ENT_HTML5);
        switch ($type) {
            case 'topic':
                $subtitle = '【话题】'.$sugg[6].' 个精选回答';
                $arg = 'https://www.zhihu.com/'.$type.'/'.$sugg[2];
                $icon = saveAndReturnFile(str_replace('_s', '_m', $sugg[3]));
                break;
            case 'people':
                $subtitle = '【用户】'.html_entity_decode($sugg[5], ENT_QUOTES | ENT_HTML5);
                $arg = 'https://www.zhihu.com/'.$type.'/'.$sugg[2];
                $icon = saveAndReturnFile(str_replace('_s', '_m', $sugg[3]));
                break;
            case 'question':
                $subtitle = '【问题】'.$sugg[4].' 个回答';
                $arg = 'https://www.zhihu.com/'.$type.'/'.$sugg[3];
                $icon = ICON;
                break;
            case 'article':
                $subtitle = '【文章】'.$sugg[4].' 个赞';
                $arg = 'https://zhuanlan.zhihu.com/p/'.$sugg[3];
                $icon = ICON;
                break;
            default:
                $matched = false;
                break;
        }

        if ($matched) {
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
}

echo $wf->output();
