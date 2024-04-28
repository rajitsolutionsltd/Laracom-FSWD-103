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

function getPaymentStatus($paymentStatus)
{
    $status = [
        'Pending' => '<span class="bg-danger badge">Pending</span>',
        'Paid' => '<span class="bg-success badge">Paid</span>',
    ];

    return $status[$paymentStatus];
}

function getPaymentOptions()
{
    return $status = [
        'Pending',
        'Paid',
    ];
}

function getDeliveryStatus($deliveryStatus)
{
    $status = [
        'Pending' => '<span class="bg-warning badge">Pending</span>',
        'Processing' => '<span class="bg-info badge">Processing</span>',
        'Delivered' => '<span class="bg-success badge">Delivered</span>',
        'Cancelled' => '<span class="bg-danger badge">Cancelled</span>',
    ];

    return $status[$deliveryStatus];
}

function getDeliveryOptions()
{
    $status = [
        'Pending',
        'Processing',
        'Delivered',
        'Cancelled'
    ];
    return $status;
}
