<?php
/**
* Description:
* Read data from a remote file/url, essentially a shortcut for curl
*
* @param $url - URL to request
* @param $options - Array of curl options
* @return result from curl_exec
*/
function request($url = null, $options = null) {
    if (is_null($url))
        return false;

    $defaults = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $url,
        CURLOPT_FRESH_CONNECT => true
    );

    if ($options)
        foreach ($options as $k => $v)
            $defaults[$k] = $v;

    array_filter($defaults, function($a) { return !empty($a); });

    $ch = curl_init();
    curl_setopt_array($ch, $defaults);
    $out = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err)
        return $err;
    else
        return $out;
}
