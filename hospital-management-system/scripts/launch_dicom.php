<?php
// scripts/launch_dicom.php

// Make sure only authenticated users can call this
require_once __DIR__ . '/../includes/auth.php';
if (!isLoggedIn()) {
    header('Location: /fiche-patient/index.php');
    exit;
}

$fileParam = $_GET['file'] ?? '';
// Prevent path traversal
$fileParam = basename($fileParam);

$fullPath = realpath(__DIR__ . '/../' . $fileParam);
if (!$fullPath || !file_exists($fullPath)) {
    http_response_code(404);
    exit('Fichier DICOM introuvable');
}

// Build a temporary .bat content
$batContent = <<<EOT
@echo off
start "" "C:\Program Files\RadiAntViewer\RadiAntViewer.exe" "{$fullPath}"
EOT;

// Send headers to download as a .bat
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="open_dicom.bat"');
header('Content-Length: ' . strlen($batContent));

// Output the .bat
echo $batContent;
exit;











