<?php
/* @var $this yii\web\View */
/* @var $model app\models\Guru */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/guru/create', [
    'model' => $model,
]);
