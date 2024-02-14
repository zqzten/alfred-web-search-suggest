<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');

const ICON = 'reddit_logo.png';

$wf = new Workflow;

$query = trim($query);

function get_subreddits_data($query) {
    $params = [
        'query' => urlencode($query),
        'include_over_18' => false,
        'include_profiles' => false,
        'limit' => 7,
    ];
    $reddit_url = "https://www.reddit.com/api/subreddit_autocomplete_v2.json";
    $api_call = $reddit_url . '?' . http_build_query($params);
    $headers = array("User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3; charset=utf-8");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_call);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
        return []; // Return an empty array on error
    }
    curl_close($ch);
    $data = json_decode($response);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'JSON Decoding Error: ' . json_last_error_msg();
        return []; // Return an empty array on JSON decoding error
    }
    if (!isset($data->data->children)) {
        return []; // Return an empty array if the expected data structure is not present
    }
    $subbreddits_data = $data->data->children;
    return $subbreddits_data;
}
$subreddits_data = get_subreddits_data($query);


if (isset($subreddits_data)) {
    foreach ($subreddits_data as $child) {
        $kind = $child->kind;
        if ($kind == "t5") {
            $subreddit_data = $child->data;
            $title = $subreddit_data->display_name;
            $display_name_prefixed = $subreddit_data->display_name_prefixed;
            $description = $subreddit_data->public_description;
            $url = "https://www.reddit.com/" . $display_name_prefixed;
            $subscribers = $subreddit_data->subscribers;
            
            $wf->result()
                ->title($title)
                ->subtitle($description)
                ->arg($url)
                ->icon(ICON)
                ->autocomplete($title)
                ->copy($title)
                ->quicklookurl($url);
        }
    }
} else {
    $wf->result()
        ->title('No Subreddits')
        ->subtitle('No subreddits found for '.$query)
        ->arg("https://www.reddit.com/r/$query")
        ->icon(ICON)
        ->copy($query);
}

echo $wf->output();
?>
