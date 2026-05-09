<?php
/* @var $this yii\web\View */
/* @var $model app\models\Siswa */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/siswa/create', [
    'model' => $model,
]);
