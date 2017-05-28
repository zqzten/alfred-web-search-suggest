<?php
use Alfred\Workflows\Workflow;

require_once('vendor/Workflow.php');
require_once('vendor/Result.php');
require_once('util/request.php');
require_once('util/image.php');

$wf = new Workflow;

$thumbnail_dir = getenv('alfred_workflow_cache').'/zhihu/thumbnail';
initThumbnailDir();

$response = request( "https://www.zhihu.com/autocomplete?token=".urlencode( $query ) );
$json = json_decode( mb_convert_encoding($response, 'UTF-8', 'HTML-ENTITIES') )[0];

foreach( $json as $sugg ):
	if( is_array($sugg) ):
		$type = $sugg[0];
		switch( $type ):
			case 'topic':
				$title = $sugg[1];
				$subtitle = '【话题】'.$sugg[6].' 个精华问答';
				$arg = $type.'/'.$sugg[2];
				$icon = saveAndReturnImg( str_replace('_s', '_m', $sugg[3]) );
				break;
			case 'people':
				$title = $sugg[1];
				$subtitle = '【用户】'.$sugg[5];
				$arg = $type.'/'.$sugg[2];
				$icon = saveAndReturnImg( str_replace('_s', '_m', $sugg[3]) );
				break;
			case 'question':
				$title = $sugg[1];
				$subtitle = '【内容】'.$sugg[4].' 个回答';
				$arg = $type.'/'.$sugg[3];
				$icon = '861BE674-55FF-4779-A44A-A02FF66440B0.png';
				break;
		endswitch;
		
		$wf->result()
			->title("$title")
			->subtitle("$subtitle")
			->arg("$arg")
			->icon("$icon")
			->autocomplete("$title")
			->text('copy', "$title")
			->quicklookurl("https://www.zhihu.com/".$arg);
	endif;
endforeach;

echo $wf->output();