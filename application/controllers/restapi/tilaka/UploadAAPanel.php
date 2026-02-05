<?php
header("Content-Type: application/json");

// Cek file
if (!isset($_FILES['file'])) {
    echo json_encode([
        "success" => false,
        "message" => "FILE NOT RECEIVED",
        "files"   => $_FILES
    ]);
    exit;
}

$targetDir = __DIR__ . "/file_tte/output/";

$filename = basename($_FILES['file']['name']);
$target   = $targetDir . $filename;

if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
    echo json_encode([
        "success" => true,
        "message" => "UPLOAD OK",
        "path"    => $target
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "UPLOAD FAILED",
        "target"  => $target
    ]);
}
