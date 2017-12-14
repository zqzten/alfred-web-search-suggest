<?php
function initDownloadDir($clear) {
    global $download_dir;

    if (!file_exists($download_dir))
        mkdir($download_dir, 0777, true);

    $files = glob($download_dir.'/*');
    if ($clear) {
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }
    }
}

function saveAndReturnFile($url, $name = null) {
    global $download_dir;

    if (is_null($name)) $name = uniqid();
    $path = $download_dir.'/'.$name;

    file_put_contents($path, file_get_contents($url));

    return $path;
}

function returnFile($url, $name) {
    global $download_dir;

    $path = $download_dir.'/'.$name;

    if (file_exists($path))
        return $path;
    else
        return saveAndReturnFile($url, $name);
}
