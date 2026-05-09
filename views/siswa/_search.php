<?php
/* @var $this yii\web\View */
/* @var $model app\models\SiswaSearch */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/siswa/_search', [
    'model' => $model,
]);
