<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = 'youtube.png';

$wf = new Workflow;

// Update with your YouTube API key
// Use this tutorial to get your API key: https://blog.hubspot.com/website/how-to-get-youtube-api-key#:~:text=step%2Dby%2Dstep.-,How%20to%20Get%20a%20YouTube%20API%20Key,-Log%20in%20to
$youtubeApiKey = 'PUT_YOUR_API_KEY_HERE';

$youtubeApiUrl = 'https://www.googleapis.com/youtube/v3/search';

// See following link for YouTube API quotas
// https://developers.google.com/youtube/v3/determine_quota_cost?hl=fr

$cacheDir = __DIR__ . '/icon-cache/';

// Check if the directory exists
if (!file_exists($cacheDir) || !is_dir($cacheDir)) {
    // Create the directory
    if (!mkdir($cacheDir, 0777, true)) {
        die('Failed to create directory');
    }
} else {
}

if ($query === 'erase_cache') {
    $files = glob($cacheDir . '*.png');
    foreach ($files as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }
    echo "Cache cleared successfully.";
    exit;
}


$params = [
    'key' => $youtubeApiKey,
    'part' => 'snippet',
    'maxResults' => 10,
    'q' => urlencode($query),
    'type' => 'video',
    'order' => 'relevance',
];

$api_call = $youtubeApiUrl . '?' . http_build_query($params);
$response = request($api_call, $opt);
$data = json_decode($response, true);



// Fetch search results
if (isset($data['items'])) {
    foreach ($data['items'] as $item) {
        $title = $item['snippet']['title'];
        $decodedTitle = html_entity_decode($title, ENT_COMPAT | ENT_HTML5, 'UTF-8');

        $channel = $item['snippet']['channelTitle'];
        $description = $item['snippet']['description'];
        $videoId = $item['id']['videoId'];
        $thumbnailUrl = $item['snippet']['thumbnails']['default']['url'];

        // Generate a unique filename for the cached image
        $filename = md5($videoId) . '.png';
        $cachePath = __DIR__ . '/icon-cache/' . $filename;

        if (!file_exists($cachePath)) {
            try {
                $ch = curl_init($thumbnailUrl);
                $fp = fopen($cachePath, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
            } catch (Exception $e) {
                // Handle any errors that might occur during the image download
            }
        }

        $wf->result()
            ->title($decodedTitle)
            ->subtitle($channel . ' - ' . $description)
            ->arg('https://www.youtube.com/watch?v=' . $videoId)
            ->icon($cachePath)
            ->autocomplete($title)
            ->data(['cachePath' => $cachePath]); // Store the cache path in the result data
    }
}

// Output search results immediately
echo $wf->output();
?>
