<?php
/* @var $this yii\web\View */
/* @var $model app\models\ArsipDokumenGuruSearch */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/arsip-dokumen-guru/_search', [
    'model' => $model,
]);
