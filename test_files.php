<?php
// Simple test to check file paths
$filename = '1765092021_1629.pdf';

// Test guru path
$guruPath = __DIR__ . '/web/uploads/arsip-dokumen-guru/' . $filename;
echo "Guru file path: $guruPath\n";
echo "Guru file exists: " . (file_exists($guruPath) ? 'YES' : 'NO') . "\n";

if (file_exists($guruPath)) {
    echo "Guru file size: " . filesize($guruPath) . " bytes\n";
    echo "Guru file readable: " . (is_readable($guruPath) ? 'YES' : 'NO') . "\n";
    $mime = mime_content_type($guruPath);
    echo "Guru MIME type: $mime\n";
}

// Test siswa path
$siswaPath = __DIR__ . '/web/uploads/arsip-dokumen-siswa/' . $filename;
echo "\nSiswa file path: $siswaPath\n";
echo "Siswa file exists: " . (file_exists($siswaPath) ? 'YES' : 'NO') . "\n";

if (file_exists($siswaPath)) {
    echo "Siswa file size: " . filesize($siswaPath) . " bytes\n";
    echo "Siswa file readable: " . (is_readable($siswaPath) ? 'YES' : 'NO') . "\n";
    $mime = mime_content_type($siswaPath);
    echo "Siswa MIME type: $mime\n";
}

echo "\nTest completed.\n";
?>