<?php
function initDownloadDir($clear) {
    global $download_dir;

    if (!file_exists($download_dir)) {
        mkdir($download_dir, 0777, true);
    }
    
    $files = glob($download_dir.'/*');
    if ($clear) {
        foreach ($files as $file) {
        if (is_file($file))
            unlink($file);
        }
    }
}

function saveAndReturnFile($fileUrl) {
    global $download_dir;

    $filenameIn = $fileUrl;
    $baseName = uniqid();
    $filenameOut = $download_dir.'/'.$baseName;

    file_put_contents($filenameOut, file_get_contents($filenameIn));

    return $filenameOut;
}