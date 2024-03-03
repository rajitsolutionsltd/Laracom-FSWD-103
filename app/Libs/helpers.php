<?php

use Illuminate\Support\Facades\Storage;

function fileUpdate($databaseFile, $file, $destination)
{
    $fileName = "";

    if ($file) {
        $fileName = fileUpload($file, $destination);
        fileDelete($databaseFile);
    } elseif (!$file && $databaseFile) {
        $fileName = $databaseFile;
    }

    return $fileName;
}

function fileUpload($file, $destination)
{
    $fileName = "";
    if (!$file) {
        return '';
    }

    if (in_array($file->getClientOriginalExtension(), ['php', 'asp', 'jsp', 'py', 'rb', 'cs', 'java', 'c', 'cpp', 'js'])) {
        $extension = 'bad';
    } else {
        $extension = $file->getClientOriginalExtension();
    }

    $fileName = md5($file->getClientOriginalName() . time()) . "." . $extension;

    try {
        $fileName =  $destination . $fileName;
        $fileName = Storage::disk('public')->putFileAs($file, $fileName);
        return $fileName;
    } catch (Exception $e) {
        return '';
    }
}

function fileDelete()
{
    foreach (func_get_args() as $filePath) {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
