<?php
// Test script for file download functionality
$filename = '1765092021_1629.pdf';
$filePath = __DIR__ . '/web/uploads/arsip-dokumen-guru/' . $filename;

echo "Testing file: $filename\n";
echo "File path: $filePath\n";
echo "File exists: " . (file_exists($filePath) ? 'YES' : 'NO') . "\n";

if (file_exists($filePath)) {
    echo "File size: " . filesize($filePath) . " bytes\n";
    echo "MIME type (extension): " . mime_content_type($filePath) . "\n";

    // Test MIME type mapping
    $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $mimeTypes = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'txt' => 'text/plain',
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
    ];

    if (isset($mimeTypes[$fileExt])) {
        echo "Mapped MIME type: " . $mimeTypes[$fileExt] . "\n";
    } else {
        echo "No MIME mapping found for extension: $fileExt\n";
    }
}

echo "\nTest completed.\n";
?>