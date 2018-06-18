<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');
require_once('util/download.php');

const ICON = '7C5A1AA4-8766-42A7-ADC5-6B91963B3CD9.png';

$wf = new Workflow;

$download_dir = getenv('alfred_workflow_cache').'/bangumi';
initDownloadDir(true);

if (strpos($query, ' ') !== false) {
    $parts = explode(' ', $query);
    $type = array_shift($parts);
    $query = implode(' ', $parts);

    $typeIdDict = array(
        'all' => 0,
        'book' => 1,
        'anime' => 2,
        'music' => 3,
        'game' => 4,
        'real' => 6
    );
    $typeId = $typeIdDict[$type];

    $response = request('https://api.bgm.tv/search/subject/'.urlencode($query)."?responseGroup=large&type=$typeId");
    $json = json_decode($response);
    $results = $json->list;

    $typeNameDict = array(
        0 => '全部',
        1 => '书籍',
        2 => '动画',
        3 => '音乐',
        4 => '游戏',
        6 => '三次元'
    );

    if ($results) {
        foreach ($results as $sugg) {
            $name = html_entity_decode($sugg->name, ENT_QUOTES | ENT_HTML5);
            $nameCN = html_entity_decode($sugg->name_cn, ENT_QUOTES | ENT_HTML5);
            $url = $sugg->url;
            $icon = $sugg->images === null ? ICON : $sugg->images->small;
            $rank = $sugg->rank;
            $score = $sugg->rating->score;
            $wf->result()
                ->title($name)
                ->subtitle(($type === 'all' ? '【'.$typeNameDict[$sugg->type].'】' : '').$nameCN)
                ->arg($url)
                ->icon(saveAndReturnFile($icon))
                ->autocomplete($name)
                ->cmd(str_replace("\r\n", '', html_entity_decode($sugg->summary, ENT_QUOTES | ENT_HTML5)), $url)
                ->ctrl(($rank === 0 ? '' : "Rank: $rank ").($score === 0 ? '' : "Score: $score"), $url)
                ->copy($name)
                ->quicklookurl($url);
        }
    }

    $wf->result()
        ->title("Search 番组计划 for '$query'")
        ->subtitle($typeNameDict[$typeId].'条目')
        ->arg('http://bgm.tv/subject_search/'.urlencode($query)."?cat=$typeId")
        ->icon(ICON)
        ->copy($query);
}

echo $wf->output();
