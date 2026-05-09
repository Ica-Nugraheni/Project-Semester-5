<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\models\ArsipDokumenGuru;
use app\models\ArsipDokumenSiswa;

/**
 * FileController handles file downloads and views
 */
class FileController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Semua user yang login bisa akses file
                    ],
                ],
            ],
        ];
    }
    /**
     * Download file from arsip dokumen guru
     * @param string $filename
     * @return mixed
     */
    public function actionDownloadGuru($filename)
    {
        // Security check: prevent path traversal
        if (strpos($filename, '..') !== false || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
            throw new NotFoundHttpException('Invalid filename.');
        }

        $filePath = Yii::getAlias('@webroot') . '/uploads/arsip-dokumen-guru/' . $filename;

        // Fallback to direct path if alias doesn't work
        if (!file_exists($filePath)) {
            $filePath = dirname(Yii::getAlias('@app')) . '/web/uploads/arsip-dokumen-guru/' . $filename;
        }

        if (!file_exists($filePath)) {
            throw new NotFoundHttpException('File tidak ditemukan: ' . $filename);
        }

        // Set headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Clear output buffer
        ob_clean();
        flush();

        // Read and output file
        readfile($filePath);
        exit;
    }

    /**
     * Download file from arsip dokumen siswa
     * @param string $filename
     * @return mixed
     */
    public function actionDownloadSiswa($filename)
    {
        // Security check: prevent path traversal
        if (strpos($filename, '..') !== false || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
            throw new NotFoundHttpException('Invalid filename.');
        }

        $filePath = Yii::getAlias('@webroot') . '/uploads/arsip-dokumen-siswa/' . $filename;

        // Fallback to direct path if alias doesn't work
        if (!file_exists($filePath)) {
            $filePath = dirname(Yii::getAlias('@app')) . '/web/uploads/arsip-dokumen-siswa/' . $filename;
        }

        if (!file_exists($filePath)) {
            throw new NotFoundHttpException('File tidak ditemukan: ' . $filename);
        }

        // Set headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Clear output buffer
        ob_clean();
        flush();

        // Read and output file
        readfile($filePath);
        exit;
    }

    /**
     * View file from arsip dokumen guru (inline)
     * @param string $filename
     * @return mixed
     */
    public function actionViewGuru($filename)
    {
        // Security check: prevent path traversal
        if (strpos($filename, '..') !== false || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
            throw new NotFoundHttpException('Invalid filename.');
        }

        $filePath = Yii::getAlias('@webroot') . '/uploads/arsip-dokumen-guru/' . $filename;

        // Fallback to direct path if alias doesn't work
        if (!file_exists($filePath)) {
            $filePath = dirname(Yii::getAlias('@app')) . '/web/uploads/arsip-dokumen-guru/' . $filename;
        }

        if (!file_exists($filePath)) {
            throw new NotFoundHttpException('File tidak ditemukan: ' . $filename);
        }

        // Get MIME type
        $mimeType = 'application/octet-stream'; // default
        $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        // MIME type mapping
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
            $mimeType = $mimeTypes[$fileExt];
        } elseif (function_exists('mime_content_type')) {
            $detected = mime_content_type($filePath);
            if ($detected) {
                $mimeType = $detected;
            }
        }

        // Set headers for inline view
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: inline; filename="' . basename($filename) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Clear output buffer
        ob_clean();
        flush();

        // Read and output file
        readfile($filePath);
        exit;
    }

    /**
     * View file from arsip dokumen siswa (inline)
     * @param string $filename
     * @return mixed
     */
    public function actionViewSiswa($filename)
    {
        // Security check: prevent path traversal
        if (strpos($filename, '..') !== false || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
            throw new NotFoundHttpException('Invalid filename.');
        }

        $filePath = Yii::getAlias('@webroot') . '/uploads/arsip-dokumen-siswa/' . $filename;

        // Fallback to direct path if alias doesn't work
        if (!file_exists($filePath)) {
            $filePath = dirname(Yii::getAlias('@app')) . '/web/uploads/arsip-dokumen-siswa/' . $filename;
        }

        if (!file_exists($filePath)) {
            throw new NotFoundHttpException('File tidak ditemukan: ' . $filename);
        }

        // Get MIME type
        $mimeType = 'application/octet-stream'; // default
        $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        // MIME type mapping
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
            $mimeType = $mimeTypes[$fileExt];
        } elseif (function_exists('mime_content_type')) {
            $detected = mime_content_type($filePath);
            if ($detected) {
                $mimeType = $detected;
            }
        }

        // Set headers for inline view
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: inline; filename="' . basename($filename) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // Clear output buffer
        ob_clean();
        flush();

        // Read and output file
        readfile($filePath);
        exit;
    }
}