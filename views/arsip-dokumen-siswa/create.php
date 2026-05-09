<?php
/* @var $this yii\web\View */
/* @var $model app\models\ArsipDokumenSiswa */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/arsip-dokumen-siswa/create', [
    'model' => $model,
]);
