<?php
function initThumbnailDir() {
    global $thumbnail_dir;

    if (!file_exists($thumbnail_dir)) {
        mkdir($thumbnail_dir, 0777, true);
    }
    
    $files = glob($thumbnail_dir.'/*');
    foreach ($files as $file) {
        if (is_file($file))
            unlink($file);
    }
}

function saveAndReturnImg($imgUrl) {
    global $thumbnail_dir;

    $filenameIn = $imgUrl;
    $baseName = uniqid();
    $filenameOut = $thumbnail_dir.'/'.$baseName;

    file_put_contents($filenameOut, file_get_contents($filenameIn));

    return $filenameOut;
}