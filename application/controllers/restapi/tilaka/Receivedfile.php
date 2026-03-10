<?php
header("Content-Type: application/json");

// Folder tujuan: sama dengan folder receivedfile.php
$targetDir = __DIR__ . '/';

// Cek file
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode([
        "success" => false,
        "message" => "File not received or upload error",
        "error_code" => $_FILES['file']['error'] ?? null
    ]);
    exit;
}

// Ambil nama asli dan ekstensi
$originalName = basename($_FILES['file']['name']);
$ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

// Hanya izinkan PDF
if ($ext !== 'pdf') {
    echo json_encode([
        "success" => false,
        "message" => "Only PDF files are allowed"
    ]);
    exit;
}

// Path lengkap
$targetPath = $targetDir . $originalName;

// Pindahkan file dari temporary ke folder tujuan
if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
    echo json_encode([
        "success" => true,
        "message" => "Upload successful",
        "filename" => $originalName,
        "path" => $originalName // path relatif di folder script
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Failed to move uploaded file",
        "target" => $targetPath
    ]);
}