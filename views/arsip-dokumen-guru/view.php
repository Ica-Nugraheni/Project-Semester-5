<?php
/* @var $this yii\web\View */
/* @var $model app\models\ArsipDokumenGuru */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/arsip-dokumen-guru/view', [
    'model' => $model,
]);
