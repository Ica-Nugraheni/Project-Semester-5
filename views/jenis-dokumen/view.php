<?php
/* @var $this yii\web\View */
/* @var $model app\models\JenisDokumen */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/jenis-dokumen/view', [
    'model' => $model,
]);
