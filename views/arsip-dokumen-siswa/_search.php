<?php
/* @var $this yii\web\View */
/* @var $model app\models\ArsipDokumenSiswaSearch */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/arsip-dokumen-siswa/_search', [
    'model' => $model,
]);
